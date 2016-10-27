<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('test', function(){
    \Auth::loginUsingId(1);
    dd(App\User::find(3)->bans);
    // \App\Ban::apply(\App\User::find(3), \App\Enums\BanType::ThreadBan, 'Cause I can', \Carbon\Carbon::parse('last week'));
    dd(\App\Enums\BanType::ThreadBan, \App\User::find(3)->bans, \App\User::find(3)->bans->pluck('bannable_type'));
    return 'test';
});

// Login Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail')->name('auth.confirm');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Forum Controllers
Route::resource('thread', 'ThreadController');
Route::get('thread/{thread}/like', 'ThreadController@like')->name('thread.like');
Route::post('thread/{thread}/restore', 'ThreadController@restore')->name('thread.restore');
Route::post('thread/{thread}/pin', 'ThreadController@pin')->name('thread.pin');
Route::post('thread/{thread}/lock', 'ThreadController@lock')->name('thread.lock');
Route::post('thread/{thread}/block', 'ThreadController@block')->name('thread.block');
Route::resource('post', 'PostController', ['except' => ['index', 'create']]);

// User Controller
Route::get('users/edit', 'UserController@edit')->name('user.edit');
Route::get('users/{username}', 'UserController@show')->name('user.show');

Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'can:view_admin'], 'namespace' => 'Admin'], function(){

    Route::resource('ban', 'BanController');
    Route::resource('badge', 'BadgeController');
    Route::resource('flag', 'FlagController', ['only' => ['index', 'update']]);
    Route::group(['as'=>'admin.'], function(){
        Route::post('/{user}/assume', 'AdminController@assume')->name('assume');
        Route::get('/announce', 'AdminController@announce')->name('announce');
        Route::post('/announce', 'AdminController@storeAnnounce')->name('announce.store');
        Route::get('/', 'AdminController@index')->name('home');
    });
});

// Root Routes
Route::post('/announce/{announcement}/dismiss', 'HomeController@dismiss')->name('dismiss');
Route::get('tags', 'HomeController@tags')->name('home.tags');
Route::get('about', 'HomeController@about')->name('home.about');
Route::get('/', 'HomeController@index')->name('home');
