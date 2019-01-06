<?php

namespace App\Http\Controllers\Drive;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Tasks;
use Google_Service_Drive_DriveFile;

class OperationController extends Controller {
    
    private $stdOptKeys = array('alt', 'fields', 'prettyPrint', 'quotaUser', 'userIp' );

    /**
     * get google client.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Google_Client
     */
    private function getClient(Request $request): Google_Client {
        $credentialsFilePath = base_path('credentials.json');
        $tokenFilePath = base_path('token.json');

        // Google_Clientの生成
        $client = new Google_Client();
        $client->setApplicationName('kght6123/MiraiNotes');
        $client->addScope(Google_Service_Drive::DRIVE_APPDATA/*DRIVE*/);
        //$client->addScope(Google_Service_Tasks::TASKS);
        $client->setIncludeGrantedScopes(true);
        $client->setAuthConfig($credentialsFilePath);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        // set redirect url
        if (!$request->has('cli') && !$request->has('web')) {
            $client->setRedirectUri((empty($_SERVER['HTTPS']) ? 'http://' : 'https://')
                . $_SERVER['HTTP_HOST'] // . ':' . $_SERVER['SERVER_PORT']
                . strtok($_SERVER["REQUEST_URI"],'?'));
        }
        // set code and accessToken
        if (file_exists($tokenFilePath) && $request->has('cli')) {
            $accessToken = json_decode(file_get_contents($tokenFilePath), true);
            $client->setAccessToken($accessToken);
        } else if ($request->has('code')) {
            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->input('code'));
            // set gtoken.
            $client->setAccessToken($accessToken);
            // update gtoken
            $user = Auth::User();
            $user->gtoken = json_encode($accessToken);
            $user->save();
        } else if (!empty(Auth::User()->gtoken)) {
            // set user gtoken.
            $client->setAccessToken(json_decode(Auth::User()->gtoken, true));
        }
        return $client;
    }

    /**
     * check google access token.
     */
    private function checkToken(Google_Client $client): ?String {

        if ($client->isAccessTokenExpired()) {
            // expired AccessToken.
            $refreshToken = $client->getRefreshToken();
            if ($refreshToken) {
                // refresh AccessToken.
                $client->fetchAccessTokenWithRefreshToken($refreshToken);
            } else {
                // create AuthUrl.
                return $client->createAuthUrl();
            }
        }
        return null;
    }

    /**
     * get google drive client.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Google_Service_Drive
     */
    private function getDrive(Request $request): Google_Service_Drive {
        $client = $this->getClient($request);
        $this->checkToken($client);
        return new Google_Service_Drive($client);
    }
    /**
     * get google drive file.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Google_Service_Drive_DriveFile
     */
    private function getDriveFile(Request $request): Google_Service_Drive_DriveFile {
        $driveFileOptKeys = array('name', 'mimeType', 'parents', 'description');
        $driveFileOpts = $this->getParamArrayString($request, $driveFileOptKeys);// リクエストパラメータから、DriveFileのパラメータだけ取り出す。
        return new Google_Service_Drive_DriveFile($driveFileOpts);
    }
    /**
     * get param array string.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  array $keys
     * @return array
     */
    private function getParamArrayString(Request $request, array $keys) {
        return array_intersect_key($request->all(), array_flip($keys));
    }
    /**
     * get array string for Google_Service_Drive_DriveFile.
     * 
     * @param  Google_Service_Drive_DriveFile $file
     * @return array
     */
    private function toArray(Google_Service_Drive_DriveFile $file): array {
        $result = [
            'id' => $file->id,
            'name' => $file->name,
            'parents' => $file->parents,
            'kind' => $file->kind,
            'webViewLink' => $file->webViewLink,
            'mimeType' => $file->mimeType,
            'description' => $file->description,
            'iconLink' => $file->iconLink,
            'size' => $file->size,
            'thumbnailLink' => $file->thumbnailLink,
            'webContentLink' => $file->webContentLink,
        ];
        return $result;
    }
    /**
     * auth.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request) {

        $result = [];
        
        if (file_exists(base_path('credentials.json'))) {
            // exits credentials file.
            $client = $this->getClient($request);

            // check token and create AuthUrl.
            $result['authUrl'] = $this->checkToken($client);

            // auth ok.
            $result['auth'] = true;
            $result['gtoken'] = Auth::User()->gtoken;
        } else {
            // auth ng.
            $result['auth'] = false;
        }
        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // index drive
        $service = $this->getDrive($request);
        
        // GETリクエストパラメータから、listFilesのパラメータだけ取り出す。
        // https://developers.google.com/resources/api-libraries/documentation/drive/v3/php/latest/class-Google_Service_Drive_Files_Resource.html#_listFiles
        $optParamKeys = array('corpora', 'corpus', 'includeTeamDriveItems', 'orderBy', 'pageSize', 'pageToken', 'q', 'spaces', 'supportsTeamDrives',  'teamDriveId');
        $optParams = $this->getParamArrayString($request, array_merge($this->stdOptKeys, $optParamKeys));
        
        // qパラメータの詳細
        // https://developers.google.com/drive/api/v3/reference/query-ref
        
        // listFilesの実行
        // https://developers.google.com/resources/api-libraries/documentation/drive/v3/php/latest/class-Google_Service_Drive_Files_Resource.html
        // https://developers.google.com/resources/api-libraries/documentation/drive/v3/php/latest/class-Google_Service_Drive_FileList.html
        // https://developers.google.com/resources/api-libraries/documentation/drive/v3/php/latest/class-Google_Service_Drive_DriveFile.html
        $filelist = $service->files->listFiles($optParams);
        $files = $filelist->getFiles();

        // listFilesの連想配列化
        $filelistArray = [];
        $filesArray = [];
        foreach ($files as $file) {
            $filesArray[] = $this->toArray($file);
        }
        $filelistArray['listfiles'] = $filesArray;
        $filelistArray['incompleteSearch'] = $filelist->incompleteSearch;
        $filelistArray['kind'] = $filelist->kind;
        $filelistArray['nextPageToken'] = $filelist->nextPageToken;
        return $filelistArray;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        // put Drive.
        $service = $this->getDrive($request);

        // リクエストパラメータから、createのパラメータを取り出す
        $createOptKeys = array('ignoreDefaultVisibility', 'keepRevisionForever', 'ocrLanguage', 'supportsTeamDrives', 'useContentAsIndexableText', 'data');
        $createOpts = $this->getParamArrayString($request, array_merge($this->stdOptKeys, $createOptKeys));

        // createを実行
        $file = $service->files->create($this->getDriveFile($request), $createOpts);

        return $this->toArray($file);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        // show file
        $service = $this->getDrive($request);
        
        // リクエストパラメータから、getのパラメータを取り出す
        $getOptKeys = array('acknowledgeAbuse', 'supportsTeamDrives');
        $getOpts = $this->getParamArrayString($request, array_merge($this->stdOptKeys, $getOptKeys));

        // get -> ファイルの内容は「webContentLink」からダウンロード？
        $file = $service->files->get($id, $getOpts);

        return $this->toArray($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // post Drive.
        $service = $this->getDrive($request);

        // リクエストパラメータから、updateのパラメータを取り出す
        $updateOptKeys = array('addParents', 'keepRevisionForever', 'ocrLanguage', 'removeParents', 'supportsTeamDrives', 'useContentAsIndexableText', 'data');
        $updateOpts = $this->getParamArrayString($request, array_merge($this->stdOptKeys, $updateOptKeys));

        // updateを実行
        $file = $service->files->update($id, $this->getDriveFile($request), $updateOpts);

        return $this->toArray($file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        // delete Drive.
        $service = $this->getDrive($request);

        // リクエストパラメータから、deleteのパラメータを取り出す
        $deleteOptKeys = array('supportsTeamDrives');
        $deleteOpts = $this->getParamArrayString($request, array_merge($this->stdOptKeys, $deleteOptKeys));

        // delete
        $service->files->delete($id, $deleteOpts);
        
        return ['delete' => true];
    }
}
