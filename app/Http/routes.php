<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(array('prefix' => 'v1'), function() {

    Route::get('getsubscribablecategories', 'CategoriesController@getSubscribableCategories');

    Route::post('registerappuser', 'UserController@registerUser');

    Route::post('subscribeCategories', 'CategoriesController@subscribeCategories');

    Route::get('fetchPosts', 'PostsController@fetchPosts');

    Route::post('showNotifications', 'UserController@showNotifications');

    Route::post('feedback', 'FeedBackController@feedback');

    Route::get('shareapp', 'AppController@shareApp');

    Route::get('latestappversion', 'AppController@getLatestAppVersion');

});




Route::group(['middleware' => ['web']], function () {
    //
});
