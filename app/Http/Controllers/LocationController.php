<?php

namespace App\Http\Controllers;

use App\Countries;
use App\States;
use Auth;
use Illuminate\Http\Request;

class LocationController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		if (Auth::user()->hasRole('administrator')) {
			$countries = Countries::where('deleted', 'N')->paginate(10);

			$countryList = Countries::where('deleted', 'N')->lists('country_name', 'id');
		} else {
			$countries = Countries::where('id', Auth::user()->company_id)->where('deleted', 'N')->paginate(10);

			$countryList = Countries::where('id', Auth::user()->company_id)->where('deleted', 'N')->lists('country_name', 'id');
		}

		return view('locations.index', ['countries' => $countries, 'countryList' => $countryList])->with('i', ($request->get('page', 1) - 1) * 10);
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

		$country = Countries::find($request->country_id);
		$total   = $country->total_cities;
		$total += 1;
		$country->update(['total_cities' => $total]);

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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}
}
