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
Route::post('delete', 'DBController@destroy');
Route::post('render', 'DBController@render');
Route::post('render_posts', 'DBController@render_posts');
Route::post('post_id', 'DBController@post_id');
Route::post('select_line', 'DBController@select_line');
Route::post('select_name', 'DBController@select_name');
Route::post('add_procedure', 'DBController@add_procedure');
Route::post('render_procedures', 'DBController@render_procedures');
Route::post('render_blocks', 'DBController@render_blocks');
Route::post('render_parents', 'DBController@render_parents');
Route::post('max_block_id', 'DBController@max_block_id');
