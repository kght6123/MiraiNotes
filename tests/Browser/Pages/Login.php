<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Login extends Page
{
    /**
     * このページのURL取得
     *
     * @return string
     */
    public function url() {
        return '/login';
    }

    /**
     * ブラウザがこのページにやって来たときのアサート
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser) {
        $browser->assertPathIs($this->url());
    }

    /**
     * ページ要素の短縮形を取得
     *
     * @return array
     */
    public function elements() {
        return [
            '@email'    => '#email',
            '@password' => '#password',
            '@login'    => '#login',
        ];
    }

    // public function login(Browser $browser, $email)
    // {
    //     $browser->type('@email', $email)
    //             ->type('@password', 'secret')
    //             ->click('@login');
    // }
}
