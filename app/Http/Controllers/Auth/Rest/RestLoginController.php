<?php

namespace App\Http\Controllers\Auth\Rest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class RestLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * login.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        $auth = false;
        if ($request->has('email') && $request->has('password')) {
            // Eメールとパスワードが指定されているとき、ユーザ認証を実行
            $auth = Auth::attempt(
                ['email' => $request->input('email'),
                 'password' => $request->input('password')]/*, true*//* $remember */);
        }
        return ['check' => Auth::check(), 'user' => Auth::user(), 'auth' => $auth];
    }

    /**
     * logout.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        // ログアウトする
        //Auth::guard()->logout();
        // セッションを無効化する
        //$request->session()->invalidate();
        // 結果を返す
        return ['check' => Auth::check(), 'user' => Auth::user()];
    }

    /**
     * user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request) {
        // 認証ユーザ情報を返す
        return ['check' => Auth::check(), 'user' => Auth::user()];
    }
}
