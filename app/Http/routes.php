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

Route::group(['domain' => config('custom.admin_domain')], function () {

	Route::get('/', 'Admin\IndexController@index');

	Route::get('/user', 'Admin\UsersController@index');
	Route::post('/user/table', 'Admin\UsersController@table');
	Route::get('/user/create/{id?}', 'Admin\UsersController@create');
	Route::post('/user/insert', 'Admin\UsersController@insert');

});

Route::group(['domain' => config('custom.home_domain')], function () {
	Route::get('/', function () {
		return view('welcome');
	});
});
