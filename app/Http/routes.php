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
    // $thread = App\Thread::create([
    //     'name' => 'Best Thread ever',
    //     'nsfw' => true
    // ]);
    // $thread->posts()->create([
    //     'body' => 'omg omg omg **awesome**',
    //     'syntax' => 'm'
    // ]);
    $thread = App\Thread::find(2);
    dd($thread, $thread->posts);
});

// Login Routes...
Route::get('login', 'Auth\AuthController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout')->name('auth.logout');

// // Registration Routes...
Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('auth.register');
// Route::get('register', 'Auth\AuthController@showRegistrationForm');
// Route::post('register', 'Auth\AuthController@register');

// // Password Reset Routes...
// Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
// Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
// Route::post('password/reset', 'Auth\PasswordController@reset');

// ForumController
Route::resource('thread', 'ThreadController');
Route::resource('post', 'PostController', ['except' => ['index', 'show']]);

// User Controller
Route::get('users/{username}', 'UserController@show');
Route::get('users/edit', 'UserController@edit');

// Root Pages
Route::get('/', 'HomeController@index')->name('home');