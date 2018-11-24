<?php

namespace Tests\Feature\Drive;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Feature\LoginTest;

use Google_Client;

class OperationTest extends LoginTest
{
    /**
     * セットアップ
     * @return void
     */
    public function setUp() {
        parent::setUp();
    }
    /**
     * auth url.
     * @return void
     */
    public function testAuthUrl() {
        $response = $this
            ->withHeaders($this->headersWithToken)
            ->post('/api/drive/auth', ['cli' => true]);
        
        // echo var_dump($response->content(), false) . "\n";
        $response->assertStatus(200);
        $response->assertJson(['auth' => true]);

        printf("Open the following link in your browser:\n%s\n", $response->json()['authUrl']);
    }
    /**
     * show token.
     * @return void
     */
    public function testShowToken() {
        echo 'Enter verification code > '; $this->assertTrue(true);
    }
    /**
     * auth token.
     * @return void
     */
    public function testAuthToken() {
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
        $this->assertTrue(true);
    }
    /**
     * store.
     * @return void
     */
    public function testStore() {
        $response = $this->withHeaders($this->headersWithToken)->post('/api/drive')->assertStatus(200);
    }
    /**
     * index.
     * @return void
     */
    public function testIndex() {
        $response = $this->withHeaders($this->headersWithToken)->get('/api/drive')->assertStatus(200);
    }
    /**
     * create.
     * @return void
     */
    public function testCreate() {
        $response = $this->withHeaders($this->headersWithToken)->get('/api/drive/create')->assertStatus(200);
    }
    /**
     * destroy.
     * @return void
     */
    public function testDestroy() {
        $response = $this->withHeaders($this->headersWithToken)->delete('/api/drive/1')->assertStatus(200);
    }
    /**
     * update.
     * @return void
     */
    public function testUpdate() {
        $response = $this->withHeaders($this->headersWithToken)->put('/api/drive/1')->assertStatus(200);
        $response = $this->withHeaders($this->headersWithToken)->patch('/api/drive/1')->assertStatus(200);
    }
    /**
     * show.
     * @return void
     */
    public function testShow() {
        $response = $this->withHeaders($this->headersWithToken)->get('/api/drive/1')->assertStatus(200);
    }
    /**
     * edit.
     * @return void
     */
    public function testEdit() {
        $response = $this->withHeaders($this->headersWithToken)->get('/api/drive/1/edit')->assertStatus(200);
    }
}
