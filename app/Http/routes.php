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
});
