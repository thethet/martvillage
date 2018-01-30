<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\Item;
use App\Lotin;
use App\State;
use Auth;
use DB;
use Illuminate\Http\Request;

class CollectionController extends Controller {
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
	public function index() {
		return view('collections.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function readyToCollect(Request $request) {
		$incomingDate = date('Y-m-d');
		$query        = DB::table('lotins as l')
			->select('l.*', 's.name as sender_name', 's.member_no', 's.contact_no as sender_contact', 'r.name as receiver_name', 'r.contact_no as receiver_contact')
			->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
			->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
			->where('l.status', 2);

		if ($request->incoming_date) {
			$incomingDate = date('Y-m-d', strtotime($request->incoming_date));
		}

		if ($request->date) {
			$date  = date('Y-m-d', strtotime($request->date));
			$query = $query->where('l.date', $date);
		}

		if ($request->lot_no) {
			$lotNo = $request->lot_no;
			$query = $query->where('l.lot_no', $lotNo);
		}

		if ($request->contact_no) {
			$contactNo = $request->contact_no;

			$query = $query->where('r.contact_no', $contactNo);

		}

		$query = $query->where('l.incoming_date', $incomingDate);

		if (Auth::user()->hasRole('administrator')) {
			$lotins = $query->orderBy('incoming_date', 'ASC')->paginate(10);
		} elseif (Auth::user()->hasRole('owner')) {
			$lotins = $query->where('l.company_id', Auth::user()->company_id)
				->orderBy('incoming_date', 'ASC')->paginate(10);
		} else {
			$lotins = $query->where('to_state', Auth::user()->state_id)
				->where('l.company_id', Auth::user()->company_id)
				->orderBy('incoming_date', 'ASC')->paginate(10);
		}
		$total       = $lotins->total();
		$perPage     = $lotins->perPage();
		$currentPage = $lotins->currentPage();
		$lastPage    = $lotins->lastPage();
		$lastItem    = $lotins->lastItem();

		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::where('deleted', 'N')->orderBy('country_code', 'ASC')->lists('country_code', 'id');
		$stateList   = State::where('deleted', 'N')->orderBy('state_code', 'ASC')->lists('state_code', 'id');
		$request->merge(['incoming_date' => $incomingDate]);

		return view('collections.collect', ['lotins' => $lotins, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'countryList' => $countryList, 'stateList' => $stateList, 'companyList' => $companyList])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateCollectionStatus($id) {
		$collectedDate = date('Y-m-d');
		$lotin         = Lotin::find($id)->update(['status' => 3, 'collected_date' => $collectedDate]);

		Item::where('lotin_id', $id)->update(['status' => 3]);

		return redirect()->route('collections.ready.collect')
			->with('success', 'Collected successfully');

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function returnLots(Request $request) {
		$myCompany    = Company::find(Auth::user()->company_id);
		$returnPeriod = $myCompany->return_period;
		$today        = date('Y-m-d');
		$start        = date("Y-m-d", strtotime($today . "-$returnPeriod day"));

		$query = DB::table('lotins as l')
			->select('l.*', 's.name as sender_name', 's.member_no', 's.contact_no as sender_contact', 'r.name as receiver_name', 'r.contact_no as receiver_contact')
			->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
			->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
			->where('l.status', 2)
			->where('incoming_date', '<=', $start);
		// ->whereBetween('incoming_date', [$start, $today]);

		if (Auth::user()->hasRole('administrator')) {
			$lotins = $query->orderBy('incoming_date', 'ASC')->paginate(10);
		} elseif (Auth::user()->hasRole('owner')) {
			$lotins = $query->where('l.company_id', Auth::user()->company_id)
				->orderBy('incoming_date', 'ASC')->paginate(10);
		} else {
			$lotins = $query->where('to_state', Auth::user()->state_id)
				->where('l.company_id', Auth::user()->company_id)
				->orderBy('incoming_date', 'ASC')->paginate(10);
		}
		$total       = $lotins->total();
		$perPage     = $lotins->perPage();
		$currentPage = $lotins->currentPage();
		$lastPage    = $lotins->lastPage();
		$lastItem    = $lotins->lastItem();

		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::where('deleted', 'N')->orderBy('country_code', 'ASC')->lists('country_code', 'id');
		$stateList   = State::where('deleted', 'N')->orderBy('state_code', 'ASC')->lists('state_code', 'id');

		return view('collections.return', ['lotins' => $lotins, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'countryList' => $countryList, 'stateList' => $stateList, 'companyList' => $companyList])->with('i', ($request->get('page', 1) - 1) * 10);
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
