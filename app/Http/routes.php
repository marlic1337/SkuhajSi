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

Route::get('/', 'WelcomeController@index');

Route::get('/home', 'HomeController@index');

Route::get('/user/profile', 'UserController@get_profile');

Route::post('/user/profile/edit', 'UserController@edit_profile');

Route::get('/recept/add', 'ReceptController@new_recept');

Route::post('/recept/create', 'ReceptController@create_recept');

Route::get('/recept/get/{receptid}', 'ReceptController@get_recept');

Route::get('/recept/my', 'ReceptController@get_my');

Route::get('/recept/recept/get/{receptid}', 'ReceptController@edit_recept');

Route::post('/recept/delete/{receptid}', 'ReceptController@delete_recept');

Route::post('/recept/edit', 'ReceptController@put_edit');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::controllers([
    'recept/auth' => 'Auth\AuthController',
    'recept/password' => 'Auth\PasswordController',
]);