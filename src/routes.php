<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['web']], function() {
	Route::get('login', '\Dexperts\Authentication\Controllers\AuthenticationController@login')->name('login');
	Route::post('login', '\Dexperts\Authentication\Controllers\AuthenticationController@authenticate');

	Route::get('/admin/logout', '\Dexperts\Authentication\Controllers\AuthenticationController@logout');

	Route::group(['middleware' => ['auth']], function() {

		Route::prefix('admin')->group(function() {
			Route::prefix('users')->group(function() {
				Route::get('/', '\Dexperts\Authentication\Controllers\UserController@index');
				Route::get( '/create', '\Dexperts\Authentication\Controllers\UserController@create');
				Route::get( '/{user}/edit', '\Dexperts\Authentication\Controllers\UserController@edit');
				Route::patch( '/{user}', '\Dexperts\Authentication\Controllers\UserController@update');
				Route::post( '/', '\Dexperts\Authentication\Controllers\UserController@store');
                Route::get( '/api-token', '\Dexperts\Authentication\Controllers\ApiTokenController@update');
			});

			Route::prefix('rights')->group(function() {
				Route::get('/', '\Dexperts\Authentication\Controllers\RightsController@index');
				Route::get('/create', '\Dexperts\Authentication\Controllers\RightsController@create');
				Route::post('/', '\Dexperts\Authentication\Controllers\RightsController@store');
				Route::get('/{rights}/edit', '\Dexperts\Authentication\Controllers\RightsController@edit');
				Route::get('/{rights}/delete', '\Dexperts\Authentication\Controllers\RightsController@delete');
				Route::patch( '/{rights}', '\Dexperts\Authentication\Controllers\RightsController@update');
			});
		});
	});
});
