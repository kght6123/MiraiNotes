<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;

use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations; # DB更新をテスト後にロールバック

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // $this->browse(function (Browser $browser) {
        //     $browser->visit('/')
        //             ->assertSee('Laravel');
        // });
        $user = factory(\App\User::class)->create([
            'email' => 'admin@kght6123.jp',
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new Login)
                    ->type('@email', $user->email)
                    ->type('@password', 'secret')
                    ->click('@login')
                    ->assertPathIs('/home');
        });
    }
}
