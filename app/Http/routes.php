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

Route::get('/', function () {
	return view('admin.login');
});

Route::get('/dashboard', function () {
	return view('admin.dashboard');
});

Route::post('/dashboard', function () {
	return view('admin.dashboard');
});

Route::get('setting', function () {
	return view('admin.setting');
});

// Route::post('/addjoininnomaid', ['as' => 'welcome.addjoininnomaid', 'uses' => 'WelcomeController@addjoininnomaid']);
