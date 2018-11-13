<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/{any}', function () {
//    return view('welcome');
//})->where('any', '.*');

Route::get('/', function () {
   return view('welcome');
});

// 認証に必要な定義を一括で追加
// vendor/laravel/framework/src/Illuminate/Routing/Router.php の auth メソッドが呼ばれる
Auth::routes();

// 名前付きルートの設定（nameを呼んで設定すると名前付き、他のコントローラから呼べる）
Route::get('/home', 'HomeController@index')->name('home');
