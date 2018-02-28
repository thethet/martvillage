<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Country;
use App\Receiver;
use App\Sender;
use App\State;
use Auth;
use DB;
use Illuminate\Http\Request;

class LotBalanceController extends Controller {

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
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$today = date('Y-m-d');
		$start = date("Y-m-d", strtotime($today . "-30 day"));
		$end   = date("Y-m-d", strtotime($today));

		$itemCountList = DB::table('lotins as l')
			->leftJoin('items as i', 'i.lotin_id', '=', 'l.id')
			->where('i.status', 0)
			->groupBy('l.id')
			->lists(DB::raw("count(i.id) as count"), 'l.id');

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
				$count = 0;
				foreach ($lotin as $lot) {
					if (array_key_exists($lot->id, $itemCountList)) {
						$count += $itemCountList[$lot->id];
					}
				}
				$lotinList[$startDate]['data']  = $lotin;
				$lotinList[$startDate]['count'] = $count;
			}
		}

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

		$companyList       = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList       = Country::whereIn('id', $countryIdList)->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList         = State::whereIn('id', $stateIdList)->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$senderList        = Sender::lists('name', 'id');
		$senderContactList = Sender::lists('contact_no', 'id');

		$receiverList        = Receiver::lists('name', 'id');
		$receiverContactList = Receiver::lists('contact_no', 'id');
		$categoryList        = Category::orderBy('id', 'ASC')->lists('unit', 'id');

		return view('lotbalances.index', ['lotinList' => $lotinList, 'countryList' => $countryList, 'stateList' => $stateList, 'senderList' => $senderList, 'senderContactList' => $senderContactList, 'receiverList' => $receiverList, 'receiverContactList' => $receiverContactList, 'categoryList' => $categoryList, 'companyList' => $companyList, 'itemCountList' => $itemCountList]);
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
