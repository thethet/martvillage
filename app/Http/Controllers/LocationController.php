<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\States;
use App\Townships;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class LocationController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {

		if (Auth::user()->hasRole('administrator')) {
			$countries   = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->get();
			$countryList = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
			$stateLists  = States::where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

			$countriesLists = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->get();

			$count = DB::table('states as s')->select(DB::raw('count(s.id) as count'))
				->groupBy('s.country_id')
				->orderBy('count', 'DESC')
				->first();
			if ($count) {
				$size = $count->count;
			} else {
				$size = 0;
			}

			$citiesLists = array();
			foreach ($countriesLists as $cList) {
				$states = States::where('country_id', $cList->id)->where('deleted', 'N')->orderBy('state_name', 'ASC')->get();
				$j      = 0;
				foreach ($states as $state) {
					$citiesLists[$j][$cList->country_name]['id']           = $state->id;
					$citiesLists[$j][$cList->country_name]['state_name']   = $state->state_name;
					$citiesLists[$j][$cList->country_name]['state_code']   = $state->state_code;
					$citiesLists[$j][$cList->country_name]['company_name'] = $state->companies[0]->short_code;
					$j++;
				}
			}

			return view('locations.index', ['countries' => $countries, 'countryList' => $countryList, 'countriesLists' => $countriesLists, 'citiesLists' => $citiesLists, 'stateLists' => $stateLists])->with('i', ($request->get('page', 1) - 1) * 10);

		} else {
			$countries = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->get();

			$company       = Companies::find(Auth::user()->company_id);
			$countryIds    = $company->countries;
			$countryIdList = array();
			foreach ($countryIds as $countryId) {
				$countryIdList[] = $countryId->id;
			}

			$stateIds    = $company->states;
			$stateIdList = array();
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}

			$countriesLists = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->get();

			$citiesLists = array();
			foreach ($countriesLists as $cList) {
				$states = States::where('country_id', $cList->id)->where('deleted', 'N')->orderBy('state_name', 'ASC')->get();
				$j      = 0;
				foreach ($states as $state) {
					$citiesLists[$j][$cList->country_name]['id']           = $state->id;
					$citiesLists[$j][$cList->country_name]['state_name']   = $state->state_name;
					$citiesLists[$j][$cList->country_name]['state_code']   = $state->state_code;
					$citiesLists[$j][$cList->country_name]['company_name'] = $state->companies[0]->short_code;
					$j++;
				}
			}

			$mycountriesLists = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->get();

			$myCitiesLists = array();
			foreach ($mycountriesLists as $mycList) {
				$states = States::where('country_id', $mycList->id)->whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->get();
				$j      = 0;
				foreach ($states as $state) {
					$myCitiesLists[$j][$mycList->country_name]['id']           = $state->id;
					$myCitiesLists[$j][$mycList->country_name]['state_name']   = $state->state_name;
					$myCitiesLists[$j][$mycList->country_name]['state_code']   = $state->state_code;
					$myCitiesLists[$j][$mycList->country_name]['company_name'] = $state->companies[0]->short_code;
					$j++;
				}
			}

			return view('locations.list', ['countries' => $countries, 'countriesLists' => $countriesLists, 'citiesLists' => $citiesLists, 'mycountriesLists' => $mycountriesLists, 'myCitiesLists' => $myCitiesLists])->with('i', ($request->get('page', 1) - 1) * 10);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeCountry(Request $request) {
		$this->validate($request, [
			'country_name' => 'required',
			'country_code' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		$country            = Countries::create($data);
		$company            = Companies::find(Auth::user()->company_id);

		$company->countries()->attach($country);

		return redirect()->route('locations.index')
			->with('success', 'Country created successfully');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeCountryByCompany(Request $request) {
		$countryIdList = $request->countryIds;

		$company = Companies::find(Auth::user()->company_id);
		for ($i = 0; $i < count($countryIdList); $i++) {
			$country = Countries::find($countryIdList[$i]);
			$company->countries()->attach($country);
		}

		$response = array('status' => 'success', 'url' => 'locations');
		return response()->json($response);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeCity(Request $request) {
		$this->validate($request, [
			'state_name' => 'required',
			'state_code' => 'required',
			'country_id' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		$state              = States::create($data);
		$company            = Companies::find(Auth::user()->company_id);

		$company->states()->attach($state);

		Countries::find($request->country_id)->increment('total_cities');

		return redirect()->route('locations.index')
			->with('success', 'City created successfully');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeCityByCompany(Request $request) {
		$stateIdList = $request->stateIds;

		$company = Companies::find(Auth::user()->company_id);
		for ($i = 0; $i < count($stateIdList); $i++) {
			$state = Countries::find($stateIdList[$i]);
			$company->states()->attach($state);
		}

		$response = array('status' => 'success', 'url' => 'locations');
		return response()->json($response);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Redirect Route Using Ajax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editAjax($userId, Request $request) {
		$id       = $request->id;
		$response = array('status' => 'success', 'url' => 'locations/' . $id . '/edit');
		return response()->json($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request) {
		$countryCity = States::find($id);

		if (Auth::user()->hasRole('administrator')) {
			$countries   = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->get();
			$countryList = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
			$stateLists  = States::where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

			$countriesLists = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->get();
		} else {
			$countries   = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('country_name', 'ASC')->get();
			$countryList = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
			$stateLists  = States::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

			$countriesLists = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('country_name', 'ASC')->get();
		}

		$count = DB::table('states as s')->select(DB::raw('count(s.id) as count'))
			->groupBy('s.country_id')
			->orderBy('count', 'DESC')
			->first();
		$size = $count->count;

		$citiesLists = array();
		foreach ($countriesLists as $cList) {
			$states = States::where('country_id', $cList->id)->where('deleted', 'N')->orderBy('state_name', 'ASC')->get();

			$j = 0;
			foreach ($states as $state) {
				$citiesLists[$j][$cList->country_name]['id']           = $state->id;
				$citiesLists[$j][$cList->country_name]['state_name']   = $state->state_name;
				$citiesLists[$j][$cList->country_name]['state_code']   = $state->state_code;
				$citiesLists[$j][$cList->country_name]['company_name'] = $state->companies[0]->short_code;
				$j++;
			}
		}

		return view('locations.edit', ['countries' => $countries, 'countryList' => $countryList, 'countriesLists' => $countriesLists, 'citiesLists' => $citiesLists, 'countryCity' => $countryCity, 'stateLists' => $stateLists])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$data               = $request->all();
		$state              = States::find($id);
		$data['updated_by'] = Auth::user()->id;

		$oldCountryId = $state->country_id;
		$newCountryId = $request->country_id;
		if ($oldCountryId != $newCountryId) {
			Countries::find($oldCountryId)->decrement('total_cities');
			Countries::find($newCountryId)->increment('total_cities');
		}
		$state->update($data);

		return redirect()->route('locations.index')
			->with('success', 'City updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$countryId = States::where('id', $id)->pluck('country_id');
		$country   = Countries::find($countryId)->decrement('total_cities');
		if (Auth::user()->hasRole('administrator')) {
			$state = States::find($id)->update(['deleted' => 'Y']);
		}

		$company = Companies::find(Auth::user()->company_id);
		$company->states()->detach($id);

		Session::flash('success', 'State deleted successfully');
		$response = array('status' => 'success', 'url' => 'locations');
		return response()->json($response);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchByCountry(Request $request) {
		$search    = $request->get('search');
		$countryId = $request->get('countryId');

		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}

		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}

		if ($countryId) {
			$items = States::select(\DB::raw('id as id, state_name as text'))->whereIn('id', $stateIdList)->where('country_id', $countryId)->where('state_name', 'like', "{$search}%")->orderBy('state_name', 'ASC')->get();
		} else {
			$items = States::select(\DB::raw('id as id, state_name as text'))->whereIn('id', $stateIdList)->where('state_name', 'like', "{$search}%")->orderBy('state_name', 'ASC')->get();
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);
		return response()->json(['items' => $items], 200, $header, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchByState(Request $request) {
		$search  = $request->get('search');
		$stateId = $request->get('stateId');

		$company        = Companies::find(Auth::user()->company_id);
		$townshipIds    = $company->states;
		$townshipIdList = array();
		foreach ($townshipIds as $townshipId) {
			$townshipIdList[] = $townshipId->id;
		}

		if ($stateId) {
			$items = Townships::select(\DB::raw('id as id, township_name as text'))->whereIn('id', $townshipIdList)->where('state_id', $stateId)->where('township_name', 'like', "{$search}%")->orderBy('township_name', 'ASC')->get();
		} else {
			$items = Townships::select(\DB::raw('id as id, township_name as text'))->whereIn('id', $townshipIdList)->where('township_name', 'like', "{$search}%")->orderBy('township_name', 'ASC')->get();
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);
		return response()->json(['items' => $items], 200, $header, JSON_UNESCAPED_UNICODE);
	}
}
