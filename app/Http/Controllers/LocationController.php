<?php

namespace App\Http\Controllers;

use App\Company;
use App\State;
use App\Township;
use Auth;
use DB;
use Illuminate\Http\Request;

class LocationController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		return view('dashboard.location');
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
	public function store(Request $request) {
		//

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
	public function edit($id, Request $request) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchByCountry(Request $request) {
		$search      = $request->get('search');
		$countryId   = $request->get('countryId');
		$fromStateId = $request->get('fromStateId');

		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		$stateIdList   = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}

			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
		}

		if ($countryId) {
			$items = State::select(\DB::raw('id as id, state_name as text'))->whereIn('id', $stateIdList)->where('country_id', $countryId)->where('state_name', 'like', "{$search}%")->where('id', '!=', $fromStateId)->orderBy('state_name', 'ASC')->where('deleted', 'N')->get();
		} else {
			$items = State::select(\DB::raw('id as id, state_name as text'))->whereIn('id', $stateIdList)->where('state_name', 'like', "{$search}%")->where('id', '!=', $fromStateId)->orderBy('state_name', 'ASC')->where('deleted', 'N')->get();
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

		$myCompany      = Company::find(Auth::user()->company_id);
		$townshipIdList = array();
		if (count($myCompany) > 0) {
			$townshipIds = $myCompany->township;
			foreach ($townshipIds as $townshipId) {
				$townshipIdList[] = $townshipId->id;
			}
		}

		if ($stateId) {
			$items = Township::select(\DB::raw('id as id, township_name as text'))->whereIn('id', $townshipIdList)->where('state_id', $stateId)->where('township_name', 'like', "{$search}%")->orderBy('township_name', 'ASC')->where('deleted', 'N')->get();
		} else {
			$items = Township::select(\DB::raw('id as id, township_name as text'))->whereIn('id', $townshipIdList)->where('township_name', 'like', "{$search}%")->orderBy('township_name', 'ASC')->where('deleted', 'N')->get();
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);
		return response()->json(['items' => $items], 200, $header, JSON_UNESCAPED_UNICODE);
	}
}
