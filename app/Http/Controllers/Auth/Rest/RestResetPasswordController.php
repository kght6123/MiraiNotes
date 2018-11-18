<?php

namespace App\Http\Controllers\Auth\Rest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\Auth\ForgotPasswordController;

class RestResetPasswordController extends ForgotPasswordController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function sendResetLinkEmail(Request $request)
    {
        // メールアドレスの検証
        parent::validateEmail($request);

        // リセットリンクをemailで送信する
        $response = parent::broker()->sendResetLink(
            $request->only('email')
        );
        // 送信結果を返す
        return ['sent' => $response == Password::RESET_LINK_SENT, 'response' => $response];
    }
}
