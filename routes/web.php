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
auth()->loginUsingId(1);
  Route::group(['prefix' => 'api'],function (){
    Route::get('get-content', 'Words\WordsController@index');
    Route::get('get-logged-in-user','Users\UsersController@loggedInUser');
    Route::get('get-tags','Tags\TagsController@index');
    Route::get('details/{item}', 'Words\WordsController@show');
    Route::get('words-tag/{tag}', 'Tags\TagsController@show');
    Route::post('bookmark-word/{word}', 'Words\BookmarksController@store');
    Route::get('user-bookmarks', 'Words\BookmarksController@index');
    Route::get('get-user-details/{username}', 'Users\UsersController@show');
    Route::post('save-user-details', 'Users\UsersController@store');
    Route::post('save-social-profile/{network}', 'Users\SocialProfilesController@store');
    Route::post('search', 'Words\WordsSearchController@index');
    Route::post('save-audio/{name}','Audio\AudioController@store');
    Route::delete('delete-audio/{id}','Audio\AudioController@destroy');
    Route::post('save-avatar','Users\AvatarController@store');
    Route::post('save-profile/{network}','Users\SocialProfileController@store');
    Route::delete('delete-avatar','Users\AvatarController@destroy');
    Route::post('save-new-word','Words\WordsController@store');
    Route::post('save-new-description','Descriptions\DescriptionsController@store');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('likes/{descriptionID}', 'Likes\LikesController@toggleLikes');
    
  });
  
  Route::get('/', 'HomeController@index');
  
  Route::get('auth/github', 'Auth\LoginController@redirectToGithub');
  Route::get('auth/github/callback', 'Auth\LoginController@handleGithubCallback');
  
  Route::get('auth/twitter', 'Auth\LoginController@redirectToTwitter');
  Route::get('auth/twitter/callback', 'Auth\LoginController@handleTwitterCallback');