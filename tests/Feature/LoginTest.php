<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $headersWithToken = [];
    protected $headersWithoutToken = [];
    protected $scopes = [];
    protected $user;

    /**
     * セットアップ
     * @return void
     */
    public function setUp() {
        parent::setUp();

        // リクエストのヘッダーを設定
        $this->headersWithToken['Accept'] = 'application/json';
        $this->headersWithoutToken['Accept'] = 'application/json';

        // ユーザ情報を作成
        $password = Hash::make('test00');
        $this->user = [
            'name' => 'test',
            'password' => $password,
            'password_confirmation' => $password,
            'email' => 'admin@kght6123.work',
        ];
        // ユーザ登録
        $response = $this->withHeaders($this->headersWithoutToken)->post("/api/register", $this->user);
        
        // 認証情報を設定
        $api_token = $response->json()['user']['api_token'];
        //echo var_dump("api_token=" . $api_token, false);
        $this->headersWithToken['Authorization'] = 'Bearer ' . $api_token;
    }

    /**
     * 更新
     * @return void
     */
    public function testUpdate() {
        $this->user['name'] = 'update';
        $this->user['markdown'] = '# AAA';
        $response = $this->withHeaders($this->headersWithToken)->post("/api/update", $this->user);
        //echo var_dump($response->content(), false);
        $response
           ->assertJson(['update' => true]);
    }

    /**
     * ユーザ情報を取得
     * @return void
     */
    public function testUser() {
        $response = $this->withHeaders($this->headersWithToken)->post("/api/user");
        $response
            ->assertJson(['check' => true]);
    }

    /**
     * ログアウト
     * @return void
     */
    public function testLogout() {
        $response = $this->withHeaders($this->headersWithToken)->post("/api/logout");
        //echo var_dump($response->content(), false);
        $response
           ->assertJson(['check' => true]);
    }

    /**
     * パスワードリセットのURLを返す
     * @return void
     */
    public function testSendPasswordReset() {
        $response = $this->withHeaders($this->headersWithoutToken)->post("/api/sendResetLinkEmail", [
                'email' => $this->user['email'],
            ]);
        //echo var_dump($response->content(), false);
        $response
            ->assertJson(['sent' => true]);
    }

    /**
     * ログイン
     * @return void
     */
    public function testLogin() {
        $response = $this->withHeaders($this->headersWithoutToken)->post("/api/login", [
                    'password' => $this->user['password'],
                    'email' => $this->user['email'],
                ]
            );
        //echo var_dump($response->content(), false);
        $response
            ->assertJson(['auth' => true]);
    }

    /**
     * ユーザ情報を削除
     * @return void
     */
    public function testUnregister() {
        $response = $this->withHeaders($this->headersWithToken)->post("/api/unregister");
        //echo var_dump($response->content(), false);
        $response
            ->assertJson(['unregister' => true]);
    }
}
