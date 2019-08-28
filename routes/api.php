<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/auth/register', 'MyAuth\AuthController@register');
Route::post('auth/login', 'MyAuth\AuthController@login');
Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'MyAuth\AuthController@user');
    Route::post('auth/logout', 'MyAuth\AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'MyAuth\AuthController@refresh');
});
Route::post('confirm', 'MyAuth\AuthController@confirmToken');
Route::post('forget', 'MyAuth\AuthController@forgetPassword');
Route::post('ifexist', 'MyAuth\AuthController@if_exist');

Route::post('add_content', 'DBController@store');
Route::post('render', 'DBController@render');
