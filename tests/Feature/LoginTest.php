<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample() {
        // $response = $this->json('POST', '/api/register', ['name' => 'test', 'password' => 'test', 'email' => 'test@kght6123.work', ]);
        // echo var_dump($response->content(), false);
        // $response
        //     ->assertStatus(200)
        //     ->assertJson([
        //         'check' => true,
        //     ]);
        
        $response = $this
            ->withHeaders(['Accept' => 'application/json',])
            ->post(
                "/api/register", [
                    'name' => 'test',
                    'password' => 'test00',
                    'password_confirmation' => 'test00',
                    'email' => 'test@kght6123.work',
                ]
            );
        
        //echo var_dump($response->content(), false);
        $response
            ->assertJson(['register' => true]);
        
        $api_token = $response->json()['user']['api_token'];
        echo var_dump($api_token, false);

        $response = $this
            ->withHeaders(['Accept' => 'application/json', 'Authorization' => ('Bearer ' . $api_token)])
            ->post(
                "/api/unregister", []
            );
        echo var_dump($response->content(), false);
        $response
            ->assertJson(['unregister' => true]);
        
    }
}
