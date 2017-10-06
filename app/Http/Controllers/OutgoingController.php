<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Lotin;
use App\Outgoing;
use App\States;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class OutgoingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		// dd(Session::get('month'));

		if (Auth::user()->hasRole('administrator')) {
			$countryList  = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
			$stateList    = States::where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
			$outgoingList = Outgoing::where('deleted', 'N')->get();
		} else {
			$countryList  = Countries::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
			$stateList    = States::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
			$outgoingList = Outgoing::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
		}

		$dayHeader = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		if (Session::has('month')) {
			$currentMonthYear = Session::get('month');

			$startDay    = date('w', strtotime($currentMonthYear));
			$daysInMonth = date('t', strtotime($currentMonthYear));
			$today       = date('d');

			$previousMonth = date('F Y', strtotime('-1 month', strtotime($currentMonthYear)));
			$nextMonth     = date('F Y', strtotime('+1 month', strtotime($currentMonthYear)));
		} else {
			$currentMonthYear = date('F Y');
		}
		Session::forget('month');

		$packages = Outgoing::select(DB::raw('sum(packing_list) as packing_list'), 'dept_date', DB::raw('count(id) as total'), DB::raw('YEAR(dept_date) year, MONTH(dept_date) month, DAY(dept_date) day'))
			->groupby('year', 'month', 'day')
			->get();

		foreach ($packages as $package) {
			$yearMonth                                          = date('F Y', strtotime($package->dept_date));
			$outgoingPackingList[$package->day]['total']        = $package->total;
			$outgoingPackingList[$package->day]['package']      = (int) $package->packing_list;
			$outgoingPackingList[$package->day]['package_date'] = date('F Y', strtotime($package->dept_date));
		}

		return view('outgoings.index', ['countryList' => $countryList, 'stateList' => $stateList, 'dayHeader' => $dayHeader, 'currentMonthYear' => $currentMonthYear, 'outgoingList' => $outgoingList, 'outgoingPackingList' => $outgoingPackingList]);
	}

	/**
	 * Redirect Route Using Ajax.
	 *
	 * @return Response
	 */
	public function indexCalendar(Request $request) {
		Session::flash('month', $request->calendarDate);
		$response = array('status' => 'success', 'url' => 'outgoings');
		return response()->json($response);

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
		$this->validate($request, [
			'passenger_name' => 'required',
			'contact_no'     => 'required',
			'dept_date'      => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'from_city'      => 'required',
			'to_city'        => 'required',
			'weight'         => 'required',
			// 'other'          => 'required',
			'carrier'        => 'required',
			// 'vessel_no'      => 'required',
			'time'           => 'required',
		]);

		$data               = $request->all();
		$data['time']       = date('H:i A', strtotime($request->time));
		$data['created_by'] = Auth::user()->id;

		$outgoing = Outgoing::create($data);

		return redirect()->route('outgoings.index')
			->with('success', 'Passenger created successfully');
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
		$response = array('status' => 'success', 'url' => 'outgoings/' . $id . '/edit');
		return response()->json($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		echo "In Edit";
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

	/**
	 * Store the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function packingList($id) {
		$outgoing = Outgoing::find($id);

		$start = date("Y-m-d", strtotime($outgoing->dept_date . "-30 day"));
		$end   = date("Y-m-d", strtotime($outgoing->dept_date));

		$lotinList = array();
		for ($k = 0; $k < 31; $k++) {
			$startDate = date("Y-m-d", strtotime($start . "+" . $k . " day"));
			$lotin     = Lotin::where('status', '0')->where('deleted', 'N')->where('date', $startDate)->orderBy('date', 'ASC')->get();
			if (count($lotin) > 0) {
				$lotinList[$startDate] = $lotin;
			}
		}

		// dd($lotinList);
		// dd($start);
		return view('outgoings.packing-list', ['outgoing' => $outgoing, 'lotinList' => $lotinList]);
	}
}
