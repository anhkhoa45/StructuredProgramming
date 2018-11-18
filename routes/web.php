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

Route::redirect('/logout', '/');

// Customer routes
Route::namespace('Customer')->group(function() {
    Route::namespace('Auth')->group(function() {
        // Authentication Routes
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::post('logout', 'LoginController@logout')->name('logout');

        // Registration Routes
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register')->name('register.post');

        // Password Reset Routes
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset.post');
    });

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/product/detail/{prod_id}', 'ProductController@detail')->name('product_detail');

    // Authorization required routes
    Route::middleware('auth')->group(function() {
        Route::get('/user/profile', 'UserController@profile')->name('profile');
        Route::post('/user/update', 'UserController@update')->name('profile.update');
    });
});


//Admin routes
Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Admin'], function () {
    Route::namespace('Auth')->group(function() {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.post');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });

    Route::middleware('admin')->group(function() {
        Route::get('/', 'IndexController@index')->name('home');
        Route::resource('/setting/user', 'UserController', ['as' => 'setting']);
        Route::resource('/setting/product', 'ProductController', ['as' => 'setting']);
    });
});

