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
	/*
	|--------------------------------------------------------------------------
	| NricTownship Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for NricTownship Model CRUD
	|
	 */
	Route::get('nrictownships/nric-township', ['as' => 'nrictownships.search.nriccode', 'uses' => 'NricTownshipController@searchByNricCode']);

	/*
	|--------------------------------------------------------------------------
	| Location Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Country, States and Township Models CRUD
	|
	 */
	Route::get('states/search-state-country', ['as' => 'states.search.statecountry', 'uses' => 'LocationController@searchByCountry']);

	Route::get('townships/search-township-state', ['as' => 'townships.search.townshipstate', 'uses' => 'LocationController@searchByState']);

	/*
	|--------------------------------------------------------------------------
	| Member Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Member Model CRUD
	|
	 */
	Route::get('members/generate-member-number', ['as' => 'members.generate.member.number', 'uses' => 'MemberController@generateMemberNumber']);

	/*
	|--------------------------------------------------------------------------
	| Lot-in Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Lot-in Model CRUD
	|
	 */
	Route::get('receivers/search-address', ['as' => 'receivers.search.address', 'uses' => 'LotInController@searchAddressBySender']);

	Route::get('receivers/search-address-member', ['as' => 'receivers.search.address.member', 'uses' => 'LotInController@searchAddressByMember']);

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

	// Route::get('roles/ajax/{id}/edit', ['as' => 'roles.ajax.edit', 'uses' => 'RoleController@editAjax', 'middleware' => ['permission:role-edit']]);
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

	// Route::get('permissions/ajax/{id}/edit', ['as' => 'permissions.ajax.edit', 'uses' => 'PermissionController@editAjax', 'middleware' => ['permission:permission-edit']]);
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

	// Route::get('companies/ajax/{id}/edit', ['as' => 'companies.ajax.edit', 'uses' => 'CompanyController@editAjax', 'middleware' => ['permission:company-edit']]);
	Route::get('companies/{id}/edit', ['as' => 'companies.edit', 'uses' => 'CompanyController@edit', 'middleware' => ['permission:company-edit']]);
	Route::patch('companies/{id}', ['as' => 'companies.update', 'uses' => 'CompanyController@update', 'middleware' => ['permission:company-edit']]);

	Route::delete('companies/{id}', ['as' => 'companies.destroy', 'uses' => 'CompanyController@destroy', 'middleware' => ['permission:company-delete']]);

	/*
	|--------------------------------------------------------------------------
	| NRIC Code Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for NRIC Code Model CRUD
	|
	 */
	Route::get('nric-codes', ['as' => 'nric-codes.index', 'uses' => 'NricCodeController@index', 'middleware' => ['permission:nric-code-list|nric-code-create|nric-code-edit|nric-code-delete']]);

	Route::get('nric-codes/create', ['as' => 'nric-codes.create', 'uses' => 'NricCodeController@create', 'middleware' => ['permission:nric-code-create']]);
	Route::post('nric-codes/create', ['as' => 'nric-codes.store', 'uses' => 'NricCodeController@store', 'middleware' => ['permission:nric-code-create']]);

	Route::get('nric-codes/{id}', ['as' => 'nric-codes.show', 'uses' => 'NricCodeController@show']);

	// Route::get('nric-codes/ajax/{id}/edit', ['as' => 'nric-codes.ajax.edit', 'uses' => 'NricCodeController@editAjax', 'middleware' => ['permission:nric-code-edit']]);
	Route::get('nric-codes/{id}/edit', ['as' => 'nric-codes.edit', 'uses' => 'NricCodeController@edit', 'middleware' => ['permission:nric-code-edit']]);
	Route::patch('nric-codes/{id}', ['as' => 'nric-codes.update', 'uses' => 'NricCodeController@update', 'middleware' => ['permission:nric-code-edit']]);

	Route::delete('nric-codes/{id}', ['as' => 'nric-codes.destroy', 'uses' => 'NricCodeController@destroy', 'middleware' => ['permission:nric-code-delete']]);

	/*
	|--------------------------------------------------------------------------
	| NRIC township Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for NRIC township Model CRUD
	|
	 */
	Route::get('nric-townships', ['as' => 'nric-townships.index', 'uses' => 'NricTownshipController@index', 'middleware' => ['permission:nric-township-list|nric-township-create|nric-township-edit|nric-township-delete']]);

	Route::get('nric-townships/create', ['as' => 'nric-townships.create', 'uses' => 'NricTownshipController@create', 'middleware' => ['permission:nric-township-create']]);
	Route::post('nric-townships/create', ['as' => 'nric-townships.store', 'uses' => 'NricTownshipController@store', 'middleware' => ['permission:nric-township-create']]);

	Route::get('nric-townships/{id}', ['as' => 'nric-townships.show', 'uses' => 'NricTownshipController@show']);

	// Route::get('nric-townships/ajax/{id}/edit', ['as' => 'nric-townships.ajax.edit', 'uses' => 'NricTownshipController@editAjax', 'middleware' => ['permission:nric-township-edit']]);
	Route::get('nric-townships/{id}/edit', ['as' => 'nric-townships.edit', 'uses' => 'NricTownshipController@edit', 'middleware' => ['permission:nric-township-edit']]);
	Route::patch('nric-townships/{id}', ['as' => 'nric-townships.update', 'uses' => 'NricTownshipController@update', 'middleware' => ['permission:nric-township-edit']]);

	Route::delete('nric-townships/{id}', ['as' => 'nric-townships.destroy', 'uses' => 'NricTownshipController@destroy', 'middleware' => ['permission:nric-township-delete']]);

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

	// Route::get('users/ajax/{id}/edit', ['as' => 'users.ajax.edit', 'uses' => 'UserController@editAjax', 'middleware' => ['permission:user-edit']]);
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

	Route::post('locations/country/create', ['as' => 'locations.country.store', 'uses' => 'LocationController@storeCountry', 'middleware' => ['permission:location-create']]);
	Route::get('locations/ajax/id/custom-country', ['as' => 'locations.ajax.custom.country.store', 'uses' => 'LocationController@storeCountryByCompany', 'middleware' => ['permission:location-create']]);

	Route::post('locations/city/create', ['as' => 'locations.city.store', 'uses' => 'LocationController@storeCity', 'middleware' => ['permission:location-create']]);
	Route::get('locations/ajax/id/custom-city', ['as' => 'locations.ajax.custom.city.store', 'uses' => 'LocationController@storeCityByCompany', 'middleware' => ['permission:location-create']]);

	Route::get('locations/ajax/{id}/edit', ['as' => 'locations.ajax.edit', 'uses' => 'LocationController@editAjax', 'middleware' => ['permission:location-edit']]);
	Route::get('locations/{id}/edit', ['as' => 'locations.edit', 'uses' => 'LocationController@edit', 'middleware' => ['permission:location-edit']]);
	Route::patch('locations/{id}', ['as' => 'locations.update', 'uses' => 'LocationController@update', 'middleware' => ['permission:location-edit']]);

	Route::delete('locations/{id}', ['as' => 'nrictownships.destroy', 'uses' => 'LocationController@destroy', 'middleware' => ['permission:location-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Pricing Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Country, States and Township Models CRUD
	|
	 */
	Route::get('prices', ['as' => 'prices.index', 'uses' => 'PricingController@index', 'middleware' => ['permission:price-list|price-create|price-edit|price-delete']]);

	Route::post('prices/currency/create', ['as' => 'prices.currency.store', 'uses' => 'PricingController@storeCurrency', 'middleware' => ['permission:price-create']]);
	Route::post('prices/price/create', ['as' => 'prices.price.store', 'uses' => 'PricingController@storePrice', 'middleware' => ['permission:price-create']]);

	Route::get('prices/ajax/{id}/edit', ['as' => 'prices.ajax.edit', 'uses' => 'PricingController@editAjax', 'middleware' => ['permission:price-edit']]);
	Route::get('prices/{id}/edit', ['as' => 'prices.edit', 'uses' => 'PricingController@edit', 'middleware' => ['permission:price-edit']]);
	Route::patch('prices/{id}', ['as' => 'prices.update', 'uses' => 'PricingController@update', 'middleware' => ['permission:price-edit']]);

	Route::delete('prices/{id}', ['as' => 'nrictownships.destroy', 'uses' => 'PricingController@destroy', 'middleware' => ['permission:price-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Member Offer Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Member Offer Model CRUD
	|
	 */
	Route::get('member-offers', ['as' => 'member-offers.index', 'uses' => 'MemberOfferController@index', 'middleware' => ['permission:member-offer-list|member-offer-create|member-offer-edit|member-offer-delete']]);

	Route::get('member-offers/create', ['as' => 'member-offers.create', 'uses' => 'MemberOfferController@create', 'middleware' => ['permission:member-offer-create']]);
	Route::post('member-offers/create', ['as' => 'member-offers.store', 'uses' => 'MemberOfferController@store', 'middleware' => ['permission:member-offer-create']]);

	Route::get('member-offers/{id}', ['as' => 'member-offers.show', 'uses' => 'MemberOfferController@show']);

	Route::get('member-offers/{id}/edit', ['as' => 'member-offers.edit', 'uses' => 'MemberOfferController@edit', 'middleware' => ['permission:member-offer-edit']]);
	Route::patch('member-offers/{id}', ['as' => 'member-offers.update', 'uses' => 'MemberOfferController@update', 'middleware' => ['permission:member-offer-edit']]);

	Route::delete('member-offers/{id}', ['as' => 'member-offers.destroy', 'uses' => 'MemberOfferController@destroy', 'middleware' => ['permission:member-offer-delete']]);

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

	/*
	|--------------------------------------------------------------------------
	| Tracking Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Tracking Model CRUD
	|
	 */
	Route::get('trackings', ['as' => 'trackings.index', 'uses' => 'TrackingController@index', 'middleware' => ['permission:tracking-list|tracking-create|tracking-edit|tracking-delete']]);

	Route::get('trackings/{id}', ['as' => 'trackings.show', 'uses' => 'TrackingController@show'])->where('id', '[1-9]+');;

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

	Route::get('outgoings/searchbyday', ['as' => 'outgoings.searchbyday', 'uses' => 'OutgoingController@searchByDay', 'middleware' => ['permission:outgoing-list|outgoing-create|outgoing-edit|outgoing-delete']]);

	Route::post('outgoings/create', ['as' => 'outgoings.store', 'uses' => 'OutgoingController@store', 'middleware' => ['permission:outgoing-create']]);

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

	Route::post('incomings', ['as' => 'incomings.search', 'uses' => 'IncomingController@search', 'middleware' => ['permission:incoming-list|incoming-create|incoming-edit|incoming-delete']]);

	Route::get('incomings/{id}', ['as' => 'incomings.show', 'uses' => 'IncomingController@show']);

	Route::get('incomings/{id}/edit', ['as' => 'incomings.edit', 'uses' => 'IncomingController@edit', 'middleware' => ['permission:incoming-edit']]);
	Route::patch('incomings/{id}', ['as' => 'incomings.update', 'uses' => 'IncomingController@update', 'middleware' => ['permission:incoming-edit']]);

	/*
	|--------------------------------------------------------------------------
	| LotBalance Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for LotBalance Model CRUD
	|
	 */
	Route::get('lotbalances', ['as' => 'lotbalances.index', 'uses' => 'LotBalanceController@index', 'middleware' => ['permission:lotbalance-list|lotbalance-create|lotbalance-edit|lotbalance-delete']]);

	Route::post('lotbalances', ['as' => 'lotbalances.search', 'uses' => 'LotBalanceController@search', 'middleware' => ['permission:lotbalance-list|lotbalance-create|lotbalance-edit|lotbalance-delete']]);

	Route::get('lotbalances/{id}', ['as' => 'lotbalances.show', 'uses' => 'LotBalanceController@show']);

	/*
	|--------------------------------------------------------------------------
	| Country Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Country Model CRUD
	|
	 */
	Route::get('countries', ['as' => 'countries.index', 'uses' => 'CountryController@index', 'middleware' => ['permission:country-list|country-create|country-edit|country-delete']]);

	Route::get('countries/create', ['as' => 'countries.create', 'uses' => 'CountryController@create', 'middleware' => ['permission:country-create']]);
	Route::post('countries/create', ['as' => 'countries.store', 'uses' => 'CountryController@store', 'middleware' => ['permission:country-create']]);

	Route::get('countries/{id}', ['as' => 'countries.show', 'uses' => 'CountryController@show']);

	Route::get('countries/{id}/edit', ['as' => 'countries.edit', 'uses' => 'CountryController@edit', 'middleware' => ['permission:country-edit']]);
	Route::patch('countries/{id}', ['as' => 'countries.update', 'uses' => 'CountryController@update', 'middleware' => ['permission:country-edit']]);

	Route::delete('countries/{id}', ['as' => 'countries.destroy', 'uses' => 'CountryController@destroy', 'middleware' => ['permission:country-delete']]);

	/*
	|--------------------------------------------------------------------------
	| State Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for State Model CRUD
	|
	 */
	Route::get('states', ['as' => 'states.index', 'uses' => 'StateController@index', 'middleware' => ['permission:state-list|state-create|state-edit|state-delete']]);

	Route::get('states/create', ['as' => 'states.create', 'uses' => 'StateController@create', 'middleware' => ['permission:state-create']]);
	Route::post('states/create', ['as' => 'states.store', 'uses' => 'StateController@store', 'middleware' => ['permission:state-create']]);

	Route::get('states/{id}', ['as' => 'states.show', 'uses' => 'StateController@show']);

	Route::get('states/{id}/edit', ['as' => 'states.edit', 'uses' => 'StateController@edit', 'middleware' => ['permission:state-edit']]);
	Route::patch('states/{id}', ['as' => 'states.update', 'uses' => 'StateController@update', 'middleware' => ['permission:state-edit']]);

	Route::delete('states/{id}', ['as' => 'states.destroy', 'uses' => 'StateController@destroy', 'middleware' => ['permission:state-delete']]);

	/*
	|--------------------------------------------------------------------------
	| Township Controller
	|--------------------------------------------------------------------------
	|
	| This is the route for Township Model CRUD
	|
	 */
	Route::get('townships', ['as' => 'townships.index', 'uses' => 'TownshipController@index', 'middleware' => ['permission:township-list|township-create|township-edit|township-delete']]);

	Route::get('townships/create', ['as' => 'townships.create', 'uses' => 'TownshipController@create', 'middleware' => ['permission:township-create']]);
	Route::post('townships/create', ['as' => 'townships.store', 'uses' => 'TownshipController@store', 'middleware' => ['permission:township-create']]);

	Route::get('townships/{id}', ['as' => 'townships.show', 'uses' => 'TownshipController@show']);

	Route::get('townships/{id}/edit', ['as' => 'townships.edit', 'uses' => 'TownshipController@edit', 'middleware' => ['permission:township-edit']]);
	Route::patch('townships/{id}', ['as' => 'townships.update', 'uses' => 'TownshipController@update', 'middleware' => ['permission:township-edit']]);

	Route::delete('townships/{id}', ['as' => 'townships.destroy', 'uses' => 'TownshipController@destroy', 'middleware' => ['permission:township-delete']]);

});
