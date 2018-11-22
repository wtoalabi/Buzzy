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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/github', 'Auth\LoginController@redirectToGithub');
Route::get('auth/github/callback', 'Auth\LoginController@handleGithubCallback');

Route::get('auth/twitter', 'Auth\LoginController@redirectToTwitter');
Route::get('auth/twitter/callback', 'Auth\LoginController@handleTwitterCallback');