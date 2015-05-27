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

Route::get('home', 'HomeController@index');

Route::get('recordings', 'RecordingsController@index');


Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() /* Admin only Routes*/
{
    /* Recording Routes */
	Route::get('recordings/create', 'RecordingsController@create');
	Route::post('recordings/create', 'RecordingsController@store');
	Route::get('recordings', 'RecordingsController@index');
	Route::delete('recordings/delete/{id}', 'RecordingsController@destroy');

	/* Designation Routes */
	Route::get('designations/create', 'DesignationsController@create');
	Route::post('designations/create', 'DesignationsController@store');
	Route::get('designations', 'DesignationsController@index');
	Route::delete('designations/delete/{id}','DesignationsController@destroy');

	/* Users Route */
	Route::get('users', 'UsersController@index');
	Route::put('users/activate/{id}', 'UsersController@activate');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
