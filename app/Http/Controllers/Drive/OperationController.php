<?php

namespace App\Http\Controllers\Drive;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Tasks;

class OperationController extends Controller {
    
    /**
     * get google client.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Google_Client
     */
    private function getClient(Request $request): Google_Client {

        $credentialsFilePath = base_path('credentials.json');

        $client = new Google_Client();
        $client->setApplicationName('kght6123/MiraiNotes');
        $client->addScope(Google_Service_Drive::DRIVE);
        $client->addScope(Google_Service_Tasks::TASKS);
        $client->setIncludeGrantedScopes(true);
        $client->setAuthConfig($credentialsFilePath);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        if (!$request->has('cli')) {
            // set redirect url
            $client->setRedirectUri((empty($_SERVER['HTTPS']) ? 'http://' : 'https://')
                . $_SERVER['HTTP_HOST'] // . ':' . $_SERVER['SERVER_PORT']
                . strtok($_SERVER["REQUEST_URI"],'?'));
        }

        $user = Auth::User();
        if ($request->has('code')) {
            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->input('code'));
            // set gtoken.
            $client->setAccessToken($accessToken);
            // update gtoken
            $user->gtoken = json_encode($accessToken);
            $user->save();

        } else if (!empty($user->gtoken)) {
            // set user gtoken.
            $client->setAccessToken(json_decode($user->gtoken, true));
        }
        return $client;
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

            if ($client->isAccessTokenExpired()) {
                // expired AccessToken.
                if ($client->getRefreshToken()) {
                    // refresh AccessToken.
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                } else {
                    // create AuthUrl.
                    $result['authUrl'] = $client->createAuthUrl();
                }
            }
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        //
    }
}
