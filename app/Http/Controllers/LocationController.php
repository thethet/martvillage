<?php

namespace App\Http\Controllers;

use App\Countries;
use App\States;
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
			$countries   = Countries::where('deleted', 'N')->get();
			$countryList = Countries::where('deleted', 'N')->lists('country_name', 'id');

			$countriesLists = Countries::where('deleted', 'N')->get();
		} else {
			$countries   = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$countryList = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('country_name', 'id');

			$countriesLists = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
		}

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
			$states = States::where('country_id', $cList->id)->where('deleted', 'N')->get();

			$j = 0;
			foreach ($states as $state) {
				$citiesLists[$j][$cList->country_name]['id']         = $state->id;
				$citiesLists[$j][$cList->country_name]['state_name'] = $state->state_name;
				$j++;
			}
		}

		return view('locations.index', ['countries' => $countries, 'countryList' => $countryList, 'countriesLists' => $countriesLists, 'citiesLists' => $citiesLists])->with('i', ($request->get('page', 1) - 1) * 10);
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
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		Countries::create($data);

		return redirect()->route('locations.index')
			->with('success', 'Country created successfully');

	}

/**
 * Store a newly created resource in storage.
 *
 * @return Response
 */
	public function storeCity(Request $request) {
		$this->validate($request, [
			'state_name' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		States::create($data);

		Countries::find($request->country_id)->increment('total_cities');

		return redirect()->route('locations.index')
			->with('success', 'City created successfully');
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
			$countries   = Countries::where('deleted', 'N')->get();
			$countryList = Countries::where('deleted', 'N')->lists('country_name', 'id');

			$countriesLists = Countries::where('deleted', 'N')->get();
		} else {
			$countries   = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$countryList = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('country_name', 'id');

			$countriesLists = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
		}

		$count = DB::table('states as s')->select(DB::raw('count(s.id) as count'))
			->groupBy('s.country_id')
			->orderBy('count', 'DESC')
			->first();
		$size = $count->count;

		$citiesLists = array();
		foreach ($countriesLists as $cList) {
			$states = States::where('country_id', $cList->id)->where('deleted', 'N')->get();

			$j = 0;
			foreach ($states as $state) {
				$citiesLists[$j][$cList->country_name]['id']         = $state->id;
				$citiesLists[$j][$cList->country_name]['state_name'] = $state->state_name;
				$j++;
			}
		}

		return view('locations.edit', ['countries' => $countries, 'countryList' => $countryList, 'countriesLists' => $countriesLists, 'citiesLists' => $citiesLists, 'countryCity' => $countryCity])->with('i', ($request->get('page', 1) - 1) * 10);
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
		Countries::find($countryId)->decrement('total_cities');
		States::find($id)->update(['deleted' => 'Y']);

		Session::flash('success', 'State deleted successfully');
		$response = array('status' => 'success', 'url' => 'locations');
		return response()->json($response);
	}
}
