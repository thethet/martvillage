<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\States;
use Auth;
use DB;
use Illuminate\Http\Request;

class LotBalanceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$today = date('Y-m-d');
		$start = date("Y-m-d", strtotime($today . "-30 day"));
		$end   = date("Y-m-d", strtotime($today));

		$lotinList = array();
		for ($k = 0; $k < 31; $k++) {
			$startDate = date("Y-m-d", strtotime($start . "+" . $k . " day"));
			$query     = DB::table('lotins as l')
				->select('l.*', 's.name as sender_name', 'r.name as receiver_name', 'fst.state_name as fstate_name', 'tst.state_name as tstate_name', 'c.short_code')
				->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
				->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
				->leftJoin('states as fst', 'fst.id', '=', 'l.from_state')
				->leftJoin('states as tst', 'tst.id', '=', 'l.to_state')
				->leftJoin('companies as c', 'c.id', '=', 'l.company_id')
				->where('l.status', '0')
				->where('l.deleted', 'N')
				->where('l.date', $startDate);

			if (Auth::user()->hasRole('administrator')) {
				$lotin = $query->orderBy('l.date', 'ASC')->get();
			} elseif (Auth::user()->hasRole('owner')) {
				$lotin = $query->where('l.company_id', Auth::user()->company_id)
					->orderBy('l.date', 'ASC')->get();
			} else {
				$lotin = $query->where('l.from_state', Auth::user()->state_id)
					->where('l.company_id', Auth::user()->company_id)
					->orderBy('l.date', 'ASC')->get();
			}
			if (count($lotin) > 0) {
				$lotinList[$startDate] = $lotin;
			}
		}

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

		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$states    = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('lotbalances.index', ['lotinList' => $lotinList, 'countries' => $countries, 'states' => $states]);
	}

	/**
	 * Display a listing of the specific resource.
	 *
	 * @return Response
	 */
	public function search(Request $request) {
		$today = date('Y-m-d');
		$start = date("Y-m-d", strtotime($today . "-30 day"));
		$end   = date("Y-m-d", strtotime($today));

		$lotinList = array();
		for ($k = 0; $k < 31; $k++) {
			$startDate = date("Y-m-d", strtotime($start . "+" . $k . " day"));
			$query     = DB::table('lotins as l')
				->select('l.*', 's.name as sender_name', 'r.name as receiver_name', 'fst.state_name as fstate_name', 'tst.state_name as tstate_name', 'c.short_code')
				->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
				->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
				->leftJoin('states as fst', 'fst.id', '=', 'l.from_state')
				->leftJoin('states as tst', 'tst.id', '=', 'l.to_state')
				->leftJoin('companies as c', 'c.id', '=', 'l.company_id')
				->where('l.status', '0')
				->where('l.deleted', 'N')
				->where('l.date', $startDate);

			if ($request->from_state) {
				$query = $query->where('l.from_state', $request->from_state);
			}
			if ($request->to_state) {
				$query = $query->where('l.to_state', $request->to_state);
			}

			if (Auth::user()->hasRole('administrator')) {
				$lotin = $query->orderBy('l.date', 'ASC')->get();
			} elseif (Auth::user()->hasRole('owner')) {
				$lotin = $query->where('l.company_id', Auth::user()->company_id)
					->orderBy('l.date', 'ASC')->get();
			} else {
				$lotin = $query->where('l.from_state', Auth::user()->state_id)
					->where('l.company_id', Auth::user()->company_id)
					->orderBy('l.date', 'ASC')->get();
			}
			if (count($lotin) > 0) {
				$lotinList[$startDate] = $lotin;
			}
		}

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

		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$states    = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('lotbalances.index', ['lotinList' => $lotinList, 'countries' => $countries, 'states' => $states]);

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
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$outgoing = Outgoing::find($id);

		return view('incomings.show', ['outgoing' => $outgoing]);
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
