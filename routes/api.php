<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// あとでコントローラをクラス分けして整理する

Route::group(['middleware' => 'api'], function() {
  // curl -H 'Accept: application/json' "http://localhost:8000/api/login?email=test@kght6123.work&password=test"
  Route::get('/login',  function(Request $request) {
    $auth = false;
    if ($request->has('email') && $request->has('password')) {
      // Eメールとパスワードが指定されているとき、ユーザ認証を実行
      $auth = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
    }
    return ['check' => Auth::check(), 'user' => Auth::user(), 'auth' => $auth];
  });
  // curl -H 'Accept: application/json' "http://localhost:8000/api/register?name=test&email=test@kght6123.work&password=test"
  Route::post('/register',  'Auth\Rest\RestRegisterController@register');
  // curl -H 'Accept: application/json' "http://localhost:8000/api/sendResetLinkEmail?email=admin@kght6123.work"
  Route::get('/sendResetLinkEmail',  'Auth\Rest\RestResetPasswordController@sendResetLinkEmail');
});

Route::group(['middleware' => 'auth:api'], function() {
  Route::get('/user',  function(Request $request) {
    // 認証ユーザ情報を返す
    return ['check' => Auth::check(), 'user' => Auth::user()];
  });
  // curl -H 'X-CSRF-TOKEN: 〜' -H 'Accept: application/json' "http://localhost:8000/api/logout"
  Route::get('/logout',  function(Request $request) {
    // ログアウトする
    Auth::guard()->logout();
    // セッションを無効化する
    $request->session()->invalidate();
    // 結果を返す
    return ['check' => Auth::check(), 'user' => Auth::user()];
  });
  // curl -H 'X-CSRF-TOKEN: 〜' -H 'Accept: application/json' "http://localhost:8000/api/unregister"
  Route::post('/unregister',  function(Request $request) {
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
  });
});