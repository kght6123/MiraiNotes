<?php
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
Route::group(['middleware' => 'api'], function() {
  // curl -X POST -H 'Accept: application/json' "http://localhost:8000/api/login?email=test@kght6123.work&password=test"
  Route::post('/login', 'Auth\Rest\RestLoginController@login');
  // curl -X POST -H 'Accept: application/json' "http://localhost:8000/api/register?name=test&email=test@kght6123.work&password=test"
  Route::post('/register', 'Auth\Rest\RestRegisterController@register');
  // curl -X POST -H 'Accept: application/json' "http://localhost:8000/api/sendResetLinkEmail?email=admin@kght6123.work"
  Route::post('/sendResetLinkEmail', 'Auth\Rest\RestResetPasswordController@sendRestResetLinkEmail');
});
Route::group(['middleware' => 'auth:api'], function() {
  Route::post('/user', 'Auth\Rest\RestLoginController@user');
  // curl -X POST -H 'X-CSRF-TOKEN: 〜' -H 'Accept: application/json' "http://localhost:8000/api/logout"
  Route::post('/logout', 'Auth\Rest\RestLoginController@logout');// function(Request $request) { return ['check' => Auth::check(), 'user' => Auth::user()]; }
  // curl -X POST -H 'X-CSRF-TOKEN: 〜' -H 'Accept: application/json' "http://localhost:8000/api/unregister"
  Route::post('/unregister', 'Auth\Rest\RestRegisterController@unregister');

  Route::resource('/drive', 'Drive\OperationController');
  Route::post('/drive/auth', 'Drive\OperationController@auth');
});