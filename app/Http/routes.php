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
Route::group(['middleware' => 'web'], function () {
	/*
	|--------------------------------------------------------------------------
	| Authentication Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Authentication
	|
	 */
	Route::auth();
	Route::get('/', 'HomeController@index');

	Route::get('404', function () {
		return view('errors.404');
	});

	Route::get('401', function () {
		return view('errors.401');
	});

	Route::get('test', function () {
		dd(Config::get('mail'));
	});

	Route::get('send_test_email', function () {
		$company = App\Companies::find(1);
		Mail::send('emails.company-creation-mail', ['company' => $company], function ($message) use ($company) {
			$message->from('martvillageprj@gmail.com');
			$message->to('thetthetaye2709@gmail.com', '')->subject('Your company has been created');
		});
	});

	/*
	|--------------------------------------------------------------------------
	| AJAX
	|--------------------------------------------------------------------------
	|
	 */
	Route::get('nrictownships/nric-township', ['as' => 'nrictownships.search.nriccode', 'uses' => 'NricTownshipController@searchByNricCode']);

	Route::get('states/search-state-country', ['as' => 'states.search.statecountry', 'uses' => 'StateController@searchByCountry']);

	Route::get('townships/search-township-state', ['as' => 'townships.search.townshipstate', 'uses' => 'TownshipController@searchByState']);
});

Route::group(['middleware' => ['auth']], function () {

	Route::get('/home', 'HomeController@index');

	Route::get('/dashboard', 'HomeController@index');

	Route::get('settings', function () {
		return view('dashboard.setting');
	});

	// Route::resource('users', 'UserController');

	/*
	|--------------------------------------------------------------------------
	| Roles Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Role Model CRUD
	|
	 */
	Route::get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
	Route::post('roles/create', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);
	Route::get('roles/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
	Route::get('roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy', 'middleware' => ['permission:role-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Permissions Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Permission Model CRUD
	|
	 */
	Route::get('permissions', ['as' => 'permissions.index', 'uses' => 'PermissionController@index', 'middleware' => ['permission:permission-list|permission-create|permission-edit|permission-delete']]);
	Route::get('permissions/create', ['as' => 'permissions.create', 'uses' => 'PermissionController@create', 'middleware' => ['permission:permission-create']]);
	Route::post('permissions/create', ['as' => 'permissions.store', 'uses' => 'PermissionController@store', 'middleware' => ['permission:permission-create']]);
	Route::get('permissions/{id}', ['as' => 'permissions.show', 'uses' => 'PermissionController@show']);
	Route::get('permissions/{id}/edit', ['as' => 'permissions.edit', 'uses' => 'PermissionController@edit', 'middleware' => ['permission:permission-edit']]);
	Route::patch('permissions/{id}', ['as' => 'permissions.update', 'uses' => 'PermissionController@update', 'middleware' => ['permission:permission-edit']]);
	Route::delete('permissions/{id}', ['as' => 'permissions.destroy', 'uses' => 'PermissionController@destroy', 'middleware' => ['permission:permission-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Permissions Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Permission Model CRUD
	|
	 */
	Route::get('companies', ['as' => 'companies.index', 'uses' => 'CompanyController@index', 'middleware' => ['permission:company-list|company-create|company-edit|company-delete']]);
	Route::get('companies/create', ['as' => 'companies.create', 'uses' => 'CompanyController@create', 'middleware' => ['permission:company-create']]);
	Route::post('companies/create', ['as' => 'companies.store', 'uses' => 'CompanyController@store', 'middleware' => ['permission:company-create']]);
	Route::get('companies/{id}', ['as' => 'companies.show', 'uses' => 'CompanyController@show']);
	Route::get('companies/{id}/edit', ['as' => 'companies.edit', 'uses' => 'CompanyController@edit', 'middleware' => ['permission:company-edit']]);
	Route::patch('companies/{id}', ['as' => 'companies.update', 'uses' => 'CompanyController@update', 'middleware' => ['permission:company-edit']]);
	Route::delete('companies/{id}', ['as' => 'companies.destroy', 'uses' => 'CompanyController@destroy', 'middleware' => ['permission:company-delete']]);

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for User Model CRUD
	|
	 */
	Route::get('users', ['as' => 'users.index', 'uses' => 'UserController@index', 'middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);
	Route::get('users/create', ['as' => 'users.create', 'uses' => 'UserController@create', 'middleware' => ['permission:user-create']]);
	Route::post('users/create', ['as' => 'users.store', 'uses' => 'UserController@store', 'middleware' => ['permission:user-create']]);
	Route::get('users/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
	Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit', 'middleware' => ['permission:user-edit']]);
	Route::patch('users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update', 'middleware' => ['permission:user-edit']]);
	Route::delete('users/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['permission:user-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Nric Township Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Nric Township Model CRUD
	|
	 */
	Route::get('nrictownships', ['as' => 'nrictownships.index', 'uses' => 'NricTownshipController@index', 'middleware' => ['permission:nrictownship-list|nrictownship-create|nrictownship-edit|nrictownship-delete']]);
	Route::get('nrictownships/create', ['as' => 'nrictownships.create', 'uses' => 'NricTownshipController@create', 'middleware' => ['permission:nrictownship-create']]);
	Route::post('nrictownships/create', ['as' => 'nrictownships.store', 'uses' => 'NricTownshipController@store', 'middleware' => ['permission:nrictownship-create']]);
	Route::get('nrictownships/{id}', ['as' => 'nrictownships.show', 'uses' => 'NricTownshipController@show']);
	Route::get('nrictownships/{id}/edit', ['as' => 'nrictownships.edit', 'uses' => 'NricTownshipController@edit', 'middleware' => ['permission:nrictownship-edit']]);
	Route::patch('nrictownships/{id}', ['as' => 'nrictownships.update', 'uses' => 'NricTownshipController@update', 'middleware' => ['permission:nrictownship-edit']]);
	Route::delete('nrictownships/{id}', ['as' => 'nrictownships.destroy', 'uses' => 'NricTownshipController@destroy', 'middleware' => ['permission:nrictownship-delete']]);

});
