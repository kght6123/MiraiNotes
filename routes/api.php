<?php

use Illuminate\Http\Request;
//use App\Models\User;

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

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user',  function(Request $request) {
        // $users = User::all()->take(5);
        // return $users;
        // return $request->user();
        // return Auth::user();
        return ['api' => 'test', 'check' => Auth::check(), 'user' => Auth::user()];
    });

    // Route::get('/user',  'UserController@index'); コントローラのクラス分け
});

// auth:apiと書くと、config/auth.phpのguardsのapiの認証が必要になる
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     // curl -H 'Accept: application/json' http://localhost:8000/api/user
//     return $request->user(); // Auth::user()と同じ
//     // $users = User::all()->take(5);
//     // return $users;
// });
