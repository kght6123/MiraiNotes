<?php

namespace Tests\Feature\Drive;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Feature\LoginTest;

use Google_Client;

class OperationTest extends LoginTest
{
    private $tokenFile;
    private $fields;
    private $date;

    /**
     * セットアップ
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->tokenFile = file_exists(base_path('token.json'));
        $this->fields = 'id,name,parents,webContentLink,webViewLink,description,mimeType';
        $this->date = date("Y-m-d H:i:s");
    }
    /**
     * auth url.
     * @return void
     */
    public function testAuthUrl() {
        if (!$this->tokenFile) {
            $response = $this
                ->withHeaders($this->headersWithToken)
                ->post('/api/drive/auth', ['cli' => true]);
            
            // echo var_dump($response->content(), false) . "\n";
            $response->assertStatus(200);
            $response->assertJson(['auth' => true]);

            printf("Open the following link in your browser:\n%s\n", $response->json()['authUrl']);
        }
        $this->assertTrue(true);
    }
    /**
     * show token.
     * @return void
     */
    public function testShowToken() {
        if (!$this->tokenFile) {
            echo 'Enter verification code > '; $this->assertTrue(true);
        }
        $this->assertTrue(true);
    }
    /**
     * auth token.
     * @return void
     */
    public function testAuthToken() {
        if (!$this->tokenFile) {
            if ($code = trim(fgets(STDIN))) {
                $response = $this
                    ->withHeaders($this->headersWithToken)
                    ->post('/api/drive/auth', ['code' => $code, 'cli' => true]);
                
                // echo var_dump($response->content(), false) . "\n";
                // output file
                file_put_contents(base_path('token.json'), $response->json()['gtoken']);// $gtoken = file_get_contents(base_path('token.json'));

                $response->assertStatus(200);
                $response->assertJson(['auth' => true]);
            }
        }
        $this->assertTrue(true);
    }
    /**
     * index.
     * @return void
     */
    public function testIndex() {
        $response = $this
            ->withHeaders($this->headersWithToken)
            ->get('/api/drive?cli=true&q='.urlencode('\'root\' in parents').'&pageSize=10');// fieldsが指定できない
        //echo var_dump($response->content(), false) . "\n";
        $response->assertStatus(200);
    }
    /**
     * create file.
     * @return void
     */
    public function testCreateFile() {
        $response = $this
            ->withHeaders($this->headersWithToken)
            ->get('/api/drive/create'
                .'?cli=true&name=sample.md&mimeType='.urlencode('text/markdown').'&parents=root&description=&fields='.urlencode($this->fields).'&data='.urlencode('MiraiEditor:'.$this->date).'&uploadType=multipart&useContentAsIndexableText=true');
        //echo var_dump($response->content(), false) . "\n";
        file_put_contents(base_path('id.json'), $response->json()['id']);
        $response->assertStatus(200);
    }
    /**
     * create file.
     * @return void
     */
    public function testCreateDir() {
        $response = $this
            ->withHeaders($this->headersWithToken)
            ->get('/api/drive/create'
                .'?cli=true&name=folder&mimeType='.urlencode('application/vnd.google-apps.folder').'&parents=root&description=&fields='.urlencode($this->fields).'&useContentAsIndexableText=true');
        //echo var_dump($response->content(), false) . "\n";
        $response->assertStatus(200);
    }
    /**
     * show.
     * @return void
     */
    public function testShow() {
        $id = file_get_contents(base_path('id.json'));
        $response = $this
            ->withHeaders($this->headersWithToken)
            ->get('/api/drive/'.$id
                .'?cli=true&fields='.urlencode($this->fields));
        //echo var_dump($response->content(), false) . "\n";
        $response->assertStatus(200);
    }
    /**
     * update.
     * @return void
     */
    public function testUpdate() {
        $id = file_get_contents(base_path('id.json'));
        $param = ['cli' => true, 'fields' => $this->fields, 'data' => 'MiraiEditor2:'.$this->date];

        $response = $this
            ->withHeaders($this->headersWithToken)
            ->put('/api/drive/'.$id, $param);
        //echo var_dump($response->content(), false) . "\n";
        $response->assertStatus(200);

        $response = $this
            ->withHeaders($this->headersWithToken)
            ->patch('/api/drive/'.$id, $param);
        //echo var_dump($response->content(), false) . "\n";
        $response->assertStatus(200);
    }
    /**
     * destroy.
     * @return void
     */
    public function testDestroy() {
        $id = file_get_contents(base_path('id.json'));
        $param = ['cli' => true, 'fields' => $this->fields];

        $response = $this
            ->withHeaders($this->headersWithToken)
            ->delete('/api/drive/'.$id, $param);
        //echo var_dump($response->content(), false) . "\n";
        $response->assertStatus(200);
    }
    // /**
    //  * store.
    //  * @return void
    //  */
    // public function testStore() {
    //     $response = $this->withHeaders($this->headersWithToken)->post('/api/drive')->assertStatus(200);
    // }
    // /**
    //  * edit.
    //  * @return void
    //  */
    // public function testEdit() {
    //     $response = $this->withHeaders($this->headersWithToken)->get('/api/drive/1/edit')->assertStatus(200);
    // }
}
