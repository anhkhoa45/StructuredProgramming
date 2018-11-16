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

Route::view('/', 'home');

Auth::routes();
Route::redirect('/logout', '/');

Route::get('/', 'IndexController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('product/detail/{prod_id}', 'ProductController@detail')->name('product_detail');
Route::get('/user/profile', 'UserController@profile');
Route::post('/user/update', 'UserController@update');

//Admin
Route::get('/admin', 'Admin\IndexController@index');