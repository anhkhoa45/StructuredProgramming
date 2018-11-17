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

Auth::routes();
Route::redirect('/logout', '/');

Route::get('/', 'Customer\IndexController@index')->name('index');
Route::get('/home', 'Customer\HomeController@index')->name('home');
Route::get('/product/detail/{prod_id}', 'Customer\ProductController@detail')->name('product_detail');
Route::get('/user/profile', 'Customer\UserController@profile');
Route::post('/user/update', 'Customer\UserController@update');

//Admin
Route::get('/admin', 'Admin\IndexController@index')->name('admin');
Route::resource('/admin/setting/user', 'Admin\UserController', ['as' => 'admin.setting']);
