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
    return redirect()->route('home');
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

// ForumControllers
Route::resource('thread', 'ThreadController');
Route::get('thread/restore/{thread}', 'ThreadController@restore')->name('thread.restore');
Route::get('thread/{thread}/like', 'ThreadController@like')->name('thread.like');
Route::get('thread/{thread}/pin', 'ThreadController@pin')->name('thread.pin');
Route::get('thread/{thread}/lock', 'ThreadController@lock')->name('thread.lock');
Route::get('thread/{thread}/block', 'ThreadController@block')->name('thread.block');
Route::resource('post', 'PostController', ['except' => ['index', 'create']]);

// User Controller
Route::get('users/edit', 'UserController@edit')->name('user.edit');
Route::get('users/{username}', 'UserController@show')->name('user.show');

Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'can:view_admin'], 'as'=>'admin.', 'namespace' => 'Admin'], function(){

    Route::get('/announce', 'AdminController@announce')->name('announce');
    Route::post('/announce', 'AdminController@storeAnnounce');
    Route::get('/', 'AdminController@index')->name('home');
});

// Root Pages
Route::get('/', 'HomeController@index')->name('home');