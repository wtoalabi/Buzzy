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

//Auth::routes();
auth()->loginUsingId(2);
  
  Route::get('test', function () {
    return view('test');
});
  
  Route::group(['prefix' => 'api'],function (){
    Route::get('get-content', 'Words\WordsController@index');
    Route::get('get-logged-in-user', function () {
      return auth()->user();
    });
    Route::get('get-tags','Tags\TagsController@index');
    Route::get('details/{item}', 'Words\WordsController@show');
    Route::post('search', 'Words\WordsSearchController@index');
    Route::post('save-audio/{name}','Audio\AudioController@store');
    Route::delete('delete-audio/{id}','Audio\AudioController@destroy');
    Route::post('save-new-word','Words\WordsController@store');
    Route::post('save-new-description','Descriptions\DescriptionsController@store');
    Route::post('logout', 'Auth\LoginController@logout');
  });
  
  Route::get('/', 'HomeController@index');
  
  Route::get('auth/github', 'Auth\LoginController@redirectToGithub');
  Route::get('auth/github/callback', 'Auth\LoginController@handleGithubCallback');
  
  Route::get('auth/twitter', 'Auth\LoginController@redirectToTwitter');
  Route::get('auth/twitter/callback', 'Auth\LoginController@handleTwitterCallback');