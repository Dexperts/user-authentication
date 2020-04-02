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
Route::group(['namespace' => 'Dexperts\Authentication\Controllers'], function() {
	Route::get('login', 'AuthenticationController@login')->name('login');
	Route::post('login', 'AuthenticationController@authenticate');
});