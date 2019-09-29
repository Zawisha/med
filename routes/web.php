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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', 'SpaController@index')->name('main');

Route::get('/admin' ,['uses'=>'SpaController@admin_index','as'=>'admin_panel']);
