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

	Route::get('405', function () {
		return view('errors.405');
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

	Route::get('states/search-state-country', ['as' => 'states.search.statecountry', 'uses' => 'LocationController@searchByCountry']);

	Route::get('townships/search-township-state', ['as' => 'townships.search.townshipstate', 'uses' => 'LocationController@searchByState']);

	Route::get('receivers/search-address', ['as' => 'receivers.search.address', 'uses' => 'LotInController@searchAddressBySender']);

	Route::get('receivers/search-address-member', ['as' => 'receivers.search.address.member', 'uses' => 'LotInController@searchAddressByMember']);

	Route::get('members/generate-member-number', ['as' => 'members.generate.member.number', 'uses' => 'MemberController@generateMemberNumber']);

	Route::get('lotins/search-unitprice', ['as' => 'lotins.search.unitprice', 'uses' => 'LotInController@searchUnitPrices']);

	Route::get('lotins/search-receiver', ['as' => 'lotins.search.receiver', 'uses' => 'LotInController@searchReceiverByAddress']);

	Route::get('lotins/search-price-list', ['as' => 'lotins.search.price.list', 'uses' => 'LotInController@searchPriceList']);

	Route::get('members/search-member', ['as' => 'receivers.search.address.member', 'uses' => 'LotInController@searchMember']);
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
	Route::get('roles/ajax/{id}/edit', ['as' => 'roles.ajax.edit', 'uses' => 'RoleController@editAjax', 'middleware' => ['permission:role-edit']]);
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
	Route::get('permissions/ajax/{id}/edit', ['as' => 'permissions.ajax.edit', 'uses' => 'PermissionController@editAjax', 'middleware' => ['permission:permission-edit']]);
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
	Route::get('companies/ajax/{id}/edit', ['as' => 'companies.ajax.edit', 'uses' => 'CompanyController@editAjax', 'middleware' => ['permission:company-edit']]);
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
	Route::get('users/ajax/{id}/edit', ['as' => 'users.ajax.edit', 'uses' => 'UserController@editAjax', 'middleware' => ['permission:user-edit']]);
	Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit', 'middleware' => ['permission:user-edit']]);
	Route::patch('users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update', 'middleware' => ['permission:user-edit']]);
	Route::delete('users/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['permission:user-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Location Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Country, States and Township Models CRUD
	|
	 */
	Route::get('locations', ['as' => 'locations.index', 'uses' => 'LocationController@index', 'middleware' => ['permission:location-list|location-create|location-edit|location-delete']]);
	// Route::get('locations/create', ['as' => 'locations.create', 'uses' => 'LocationController@create', 'middleware' => ['permission:location-create']]);
	Route::post('locations/country/create', ['as' => 'locations.country.store', 'uses' => 'LocationController@storeCountry', 'middleware' => ['permission:location-create']]);
	Route::post('locations/city/create', ['as' => 'locations.city.store', 'uses' => 'LocationController@storeCity', 'middleware' => ['permission:location-create']]);
	// Route::get('locations/{id}', ['as' => 'locations.show', 'uses' => 'LocationController@show']);
	Route::get('locations/ajax/{id}/edit', ['as' => 'locations.ajax.edit', 'uses' => 'LocationController@editAjax', 'middleware' => ['permission:location-edit']]);
	Route::get('locations/{id}/edit', ['as' => 'locations.edit', 'uses' => 'LocationController@edit', 'middleware' => ['permission:location-edit']]);
	Route::patch('locations/{id}', ['as' => 'locations.update', 'uses' => 'LocationController@update', 'middleware' => ['permission:location-edit']]);
	Route::delete('locations/{id}', ['as' => 'nrictownships.destroy', 'uses' => 'LocationController@destroy', 'middleware' => ['permission:location-delete']]);

	Route::get('locations/ajax/id/custom-country', ['as' => 'locations.ajax.custom.country.store', 'uses' => 'LocationController@storeCountryByCompany', 'middleware' => ['permission:location-create']]);
	Route::get('locations/ajax/id/custom-city', ['as' => 'locations.ajax.custom.city.store', 'uses' => 'LocationController@storeCityByCompany', 'middleware' => ['permission:location-create']]);

	/*
	|--------------------------------------------------------------------------
	| Pricing Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Country, States and Township Models CRUD
	|
	 */
	Route::get('prices', ['as' => 'prices.index', 'uses' => 'PricingController@index', 'middleware' => ['permission:price-list|price-create|price-edit|price-delete']]);
	// Route::get('prices/create', ['as' => 'prices.create', 'uses' => 'PricingController@create', 'middleware' => ['permission:price-create']]);
	Route::post('prices/currency/create', ['as' => 'prices.currency.store', 'uses' => 'PricingController@storeCurrency', 'middleware' => ['permission:price-create']]);
	Route::post('prices/price/create', ['as' => 'prices.price.store', 'uses' => 'PricingController@storePrice', 'middleware' => ['permission:price-create']]);

	// Route::get('prices/{id}', ['as' => 'prices.show', 'uses' => 'PricingController@show']);
	Route::get('prices/ajax/{id}/edit', ['as' => 'prices.ajax.edit', 'uses' => 'PricingController@editAjax', 'middleware' => ['permission:price-edit']]);
	Route::get('prices/{id}/edit', ['as' => 'prices.edit', 'uses' => 'PricingController@edit', 'middleware' => ['permission:price-edit']]);
	Route::patch('prices/{id}', ['as' => 'prices.update', 'uses' => 'PricingController@update', 'middleware' => ['permission:price-edit']]);
	Route::delete('prices/{id}', ['as' => 'nrictownships.destroy', 'uses' => 'PricingController@destroy', 'middleware' => ['permission:price-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Member Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Member Model CRUD
	|
	 */
	Route::get('members', ['as' => 'members.index', 'uses' => 'MemberController@index', 'middleware' => ['permission:member-list|member-create|member-edit|member-delete']]);
	Route::get('members/create', ['as' => 'members.create', 'uses' => 'MemberController@create', 'middleware' => ['permission:member-create']]);
	Route::post('members/create', ['as' => 'members.store', 'uses' => 'MemberController@store', 'middleware' => ['permission:member-create']]);
	Route::get('members/{id}', ['as' => 'members.show', 'uses' => 'MemberController@show']);
	Route::get('members/ajax/{id}/edit', ['as' => 'members.ajax.edit', 'uses' => 'MemberController@editAjax', 'middleware' => ['permission:member-edit']]);
	Route::get('members/{id}/edit', ['as' => 'members.edit', 'uses' => 'MemberController@edit', 'middleware' => ['permission:member-edit']]);
	Route::patch('members/{id}', ['as' => 'members.update', 'uses' => 'MemberController@update', 'middleware' => ['permission:member-edit']]);
	Route::delete('members/{id}', ['as' => 'members.destroy', 'uses' => 'MemberController@destroy', 'middleware' => ['permission:member-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Lot-in Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Lot-in Model CRUD
	|
	 */
	Route::get('lotins', ['as' => 'lotins.index', 'uses' => 'LotInController@index', 'middleware' => ['permission:lotin-list|lotin-create|lotin-edit|lotin-delete']]);
	Route::get('lotins/create', ['as' => 'lotins.create', 'uses' => 'LotInController@create', 'middleware' => ['permission:lotin-create']]);
	Route::post('lotins/create', ['as' => 'lotins.store', 'uses' => 'LotInController@store', 'middleware' => ['permission:lotin-create']]);
	Route::get('lotins/{id}', ['as' => 'lotins.show', 'uses' => 'LotInController@show']);
	Route::get('lotins/ajax/{id}/edit', ['as' => 'lotins.ajax.edit', 'uses' => 'LotInController@editAjax', 'middleware' => ['permission:lotin-edit']]);
	Route::get('lotins/{id}/edit', ['as' => 'lotins.edit', 'uses' => 'LotInController@edit', 'middleware' => ['permission:lotin-edit']]);
	Route::patch('lotins/{id}', ['as' => 'lotins.update', 'uses' => 'LotInController@update', 'middleware' => ['permission:lotin-edit']]);
	Route::delete('lotins/{id}', ['as' => 'lotins.destroy', 'uses' => 'LotInController@destroy', 'middleware' => ['permission:lotin-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Tracking Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Tracking Model CRUD
	|
	 */
	Route::get('trackings', ['as' => 'trackings.index', 'uses' => 'TrackingController@index', 'middleware' => ['permission:tracking-list|tracking-create|tracking-edit|tracking-delete']]);
	Route::get('trackings/create', ['as' => 'trackings.create', 'uses' => 'TrackingController@create', 'middleware' => ['permission:tracking-create']]);
	Route::post('trackings/create', ['as' => 'trackings.store', 'uses' => 'TrackingController@store', 'middleware' => ['permission:tracking-create']]);
	Route::get('trackings/{id}', ['as' => 'trackings.show', 'uses' => 'TrackingController@show'])->where('id', '[1-9]+');;
	Route::get('trackings/ajax/{id}/edit', ['as' => 'trackings.ajax.edit', 'uses' => 'TrackingController@editAjax', 'middleware' => ['permission:tracking-edit']]);
	Route::get('trackings/{id}/edit', ['as' => 'trackings.edit', 'uses' => 'TrackingController@edit', 'middleware' => ['permission:tracking-edit']]);
	Route::patch('trackings/{id}', ['as' => 'trackings.update', 'uses' => 'TrackingController@update', 'middleware' => ['permission:tracking-edit']]);
	Route::delete('trackings/{id}', ['as' => 'trackings.destroy', 'uses' => 'TrackingController@destroy', 'middleware' => ['permission:tracking-delete']]);
	Route::post('trackings', ['as' => 'trackings.search', 'uses' => 'TrackingController@search']);

	/*
	|--------------------------------------------------------------------------
	| Outgoing Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Outgoing Model CRUD
	|
	 */
	Route::get('outgoings', ['as' => 'outgoings.index', 'uses' => 'OutgoingController@index', 'middleware' => ['permission:outgoing-list|outgoing-create|outgoing-edit|outgoing-delete']]);
	Route::get('outgoings/calendar', ['as' => 'outgoings.calendar', 'uses' => 'OutgoingController@indexCalendar', 'middleware' => ['permission:outgoing-list|outgoing-create|outgoing-edit|outgoing-delete']]);
	Route::get('outgoings/create', ['as' => 'outgoings.create', 'uses' => 'OutgoingController@create', 'middleware' => ['permission:outgoing-create']]);
	Route::post('outgoings/create', ['as' => 'outgoings.store', 'uses' => 'OutgoingController@store', 'middleware' => ['permission:outgoing-create']]);
	Route::get('outgoings/{id}', ['as' => 'outgoings.show', 'uses' => 'OutgoingController@show']);
	Route::get('outgoings/ajax/{id}/edit', ['as' => 'outgoings.ajax.edit', 'uses' => 'OutgoingController@editAjax', 'middleware' => ['permission:outgoing-edit']]);
	Route::get('outgoings/{id}/edit', ['as' => 'outgoings.edit', 'uses' => 'OutgoingController@edit', 'middleware' => ['permission:outgoing-edit']]);
	Route::patch('outgoings/{id}', ['as' => 'outgoings.update', 'uses' => 'OutgoingController@update', 'middleware' => ['permission:outgoing-edit']]);
	Route::delete('outgoings/{id}', ['as' => 'outgoings.destroy', 'uses' => 'OutgoingController@destroy', 'middleware' => ['permission:outgoing-delete']]);

	Route::get('outgoings/{id}/packing-list', ['as' => 'outgoings.packing.lsit', 'uses' => 'OutgoingController@packingList', 'middleware' => ['permission:outgoing-list|outgoing-create|outgoing-edit|outgoing-delete']]);
	Route::post('outgoings/packinglist/create', ['as' => 'outgoings.packinglist.store', 'uses' => 'OutgoingController@packingListStore', 'middleware' => ['permission:outgoing-create']]);


	/*
	|--------------------------------------------------------------------------
	| Incoming Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Incoming Model CRUD
	|
	 */
	Route::get('incomings', ['as' => 'incomings.index', 'uses' => 'IncomingController@index', 'middleware' => ['permission:incoming-list|incoming-create|incoming-edit|incoming-delete']]);
	Route::get('incomings/create', ['as' => 'incomings.create', 'uses' => 'IncomingController@create', 'middleware' => ['permission:incoming-create']]);
	Route::post('incomings/create', ['as' => 'incomings.store', 'uses' => 'IncomingController@store', 'middleware' => ['permission:incoming-create']]);
	Route::get('incomings/{id}', ['as' => 'incomings.show', 'uses' => 'IncomingController@show']);
	Route::get('incomings/ajax/{id}/edit', ['as' => 'incomings.ajax.edit', 'uses' => 'IncomingController@editAjax', 'middleware' => ['permission:incoming-edit']]);
	Route::get('incomings/{id}/edit', ['as' => 'incomings.edit', 'uses' => 'IncomingController@edit', 'middleware' => ['permission:incoming-edit']]);
	Route::patch('incomings/{id}', ['as' => 'incomings.update', 'uses' => 'IncomingController@update', 'middleware' => ['permission:incoming-edit']]);
	Route::delete('incomings/{id}', ['as' => 'incomings.destroy', 'uses' => 'IncomingController@destroy', 'middleware' => ['permission:incoming-delete']]);


});
