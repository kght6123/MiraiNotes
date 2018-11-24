<?php

namespace App\Http\Controllers\Auth\Rest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;

class RestRegisterController extends RegisterController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {

        // パラメータの検証
        parent::validator($request->all())->validate();

        //event(new Registered($user = parent::create($request->all())));
        //$this->guard()->login($user);

        // ユーザ登録して、ログインする
        $this->guard()->login(parent::create($request->all()));

        // ログイン結果を返す
        return ['register' => Auth::check(), 'user' => Auth::user()];
    }

    /**
     * unregister.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unregister(Request $request) {

        // IDを取得する
        $id = Auth::user()->id;
        // ログアウトする
        //Auth::guard()->logout();
        // セッションを無効化する
        //$request->session()->invalidate();
        // ユーザを削除する
        $delete = User::destroy($id);
        // 結果を返す
        return ['check' => Auth::check(), 'user' => Auth::user(), 'unregister' => $delete, 'id' => $id];
    }
}
