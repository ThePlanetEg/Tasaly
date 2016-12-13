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

//Authentication

Route::get('admin/login', 'Auth\AuthController@getLogin');
Route::post('admin/login', 'Auth\AuthController@postLogin');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('logout', 'Auth\AuthController@getLogout');

$router->group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

	Route::get('', 'Admin\UsersController@index');
	// Shows
	Route::get('shows', 'Admin\ShowsController@index');
	Route::get('shows/create', 'Admin\ShowsController@create');
	Route::post('shows/create', 'Admin\ShowsController@store');
	Route::get('shows/{id}/edit', 'Admin\ShowsController@edit');
	Route::get('shows/{id}/delete', 'Admin\ShowsController@destroy');
	Route::patch('shows/{id}', 'Admin\ShowsController@update');
	// Videos
	Route::get('videos', 'Admin\VideosController@index');
	Route::get('videos/create', 'Admin\VideosController@create');
	Route::post('videos/create', 'Admin\VideosController@store');
	Route::get('videos/{id}/edit', 'Admin\VideosController@edit');
	Route::patch('videos/{id}', 'Admin\VideosController@update');
	Route::get('videos/{id}/delete', 'Admin\VideosController@destroy');
	Route::post('videos/getSeasons', 'Admin\VideosController@getSeasons');
	Route::post('videos/saveFeatured', 'Admin\VideosController@saveFeatured');
	Route::post('videos/saveStaffPicks', 'Admin\VideosController@saveStaffPicks');
	Route::post('videos/saveTrending', 'Admin\VideosController@saveTrending');

});

Route::get('home', 'Website\HomeController@index');