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
    $b = \App\Badge::find(1);
    dd($b->path);
    return view('test')->withBadge($b);
});

// Login Routes...
Route::get('login', 'Auth\AuthController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout')->name('auth.logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('auth.register');
Route::post('register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

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
Route::get('tags', 'HomeController@tags')->name('tags');
Route::get('/', 'HomeController@index')->name('home');