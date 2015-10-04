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

// Route::get('memebot', [
//     'as' => 'memebot',
//     'uses' => 'MemeBotController@scrapeMemes'
// ]);


Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::get('/', [
        'as' => 'admin.dashboard',
        'uses' => 'AdminController@index'
    ]);

});

Route::resource('posts', 'PostController');

Route::get('posts/{id}/share/{type}', [
    'as' => 'posts.share',
    'uses' => 'PostController@share',
]);

Route::get('random', [
    'as' => 'posts.random',
    'uses' => 'ContentController@getRandom'
]);

Route::get('principales', [
    'as' => 'top',
    'uses'  => 'ContentController@getTop'
]);

Route::get('populares', [
    'as' => 'hot',
    'uses'  => 'ContentController@getHot'
]);

Route::get('nuevos', [
    'as' => 'new',
    'uses'  => 'ContentController@getNew'
]);

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('register', 'Auth\AuthController@getRegister');
// Route::post('register', 'Auth\AuthController@postRegister');

Route::controller('password', 'Auth\PasswordController');