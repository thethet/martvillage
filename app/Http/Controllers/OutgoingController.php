<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Country;
use App\Item;
use App\Lotin;
use App\Outgoing;
use App\Packing;
use App\Receiver;
use App\Sender;
use App\State;
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
		if (Session::has('month')) {
			$currentMonthYear = Session::get('month');

			$startDay    = date('w', strtotime($currentMonthYear));
			$daysInMonth = date('t', strtotime($currentMonthYear));
			$today       = date('d');

			$previousMonth = date('F Y', strtotime('-1 month', strtotime($currentMonthYear)));
			$nextMonth     = date('F Y', strtotime('+1 month', strtotime($currentMonthYear)));
		} else {
			$currentMonthYear = date('F Y');

			$startDay    = date('w', strtotime($currentMonthYear));
			$daysInMonth = date('t', strtotime($currentMonthYear));
			$today       = date('d');

			$previousMonth = date('F Y', strtotime('-1 month', strtotime($currentMonthYear)));
			$nextMonth     = date('F Y', strtotime('+1 month', strtotime($currentMonthYear)));
		}

		if (Session::has('searchYMD')) {
			$searchYMD = date('Y-m-d', strtotime(Session::get('searchYMD')));

			$year  = date('Y', strtotime($searchYMD));
			$month = date('m', strtotime($searchYMD));
			$day   = date('d', strtotime($searchYMD));

			Session::flash('theDate', $day);
		} else {
			$year  = date('Y', strtotime($currentMonthYear));
			$month = date('m', strtotime($currentMonthYear));
		}

		$query = Outgoing::where('deleted', 'N')
			->whereYear('dept_date', '=', $year)
			->whereMonth('dept_date', '=', $month);

		if (Session::has('searchYMD')) {
			$query = $query->whereDay('dept_date', '=', $day);
		}

		if (Auth::user()->hasRole('administrator')) {
			$outgoingList = $query->paginate(5);

		} elseif (Auth::user()->hasRole('owner')) {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)->paginate(5);
		} else {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)
				->where('from_city', Auth::user()->state_id)->paginate(5);
		}
		$total       = $outgoingList->total();
		$perPage     = $outgoingList->perPage();
		$currentPage = $outgoingList->currentPage();
		$lastPage    = $outgoingList->lastPage();
		$lastItem    = $outgoingList->lastItem();

		$dayHeader = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

		if (Auth::user()->hasRole('administrator')) {
			$packages = Outgoing::select(DB::raw('sum(packing_list) as packing_list'), 'dept_date', DB::raw('count(id) as total'), DB::raw('YEAR(dept_date) year, MONTH(dept_date) month, DAY(dept_date) day'))
				->groupby('year', 'month', 'day')
				->get();
		} else {
			$packages = Outgoing::select(DB::raw('sum(packing_list) as packing_list'), 'dept_date', DB::raw('count(id) as total'), DB::raw('YEAR(dept_date) year, MONTH(dept_date) month, DAY(dept_date) day'))
				->groupby('year', 'month', 'day')
				->where('company_id', Auth::user()->company_id)
				->get();
		}

		$outgoingPackingList = array();
		foreach ($packages as $package) {
			if (Auth::user()->hasRole('administrator')) {
				$noPacking = Outgoing::where('dept_date', $package->dept_date)->where('packing_list', 0)->count();
			} else {
				$noPacking = Outgoing::where('dept_date', $package->dept_date)->where('packing_list', 0)->where('company_id', Auth::user()->company_id)->count();
			}

			$yearMonth                                          = date('F Y', strtotime($package->dept_date));
			$outgoingPackingList[$package->day]['total']        = $package->total;
			$outgoingPackingList[$package->day]['package']      = $package->total - $noPacking;
			$outgoingPackingList[$package->day]['package_date'] = date('F Y', strtotime($package->dept_date));

		}

		Session::forget('month');
		Session::forget('searchYMD');

		return view('outgoings.index', ['dayHeader' => $dayHeader, 'currentMonthYear' => $currentMonthYear, 'outgoingList' => $outgoingList, 'outgoingPackingList' => $outgoingPackingList, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('p', ($request->get('page', 1) - 1) * 5);
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
	 * Redirect Route Using Ajax.
	 *
	 * @return Response
	 */
	public function searchByDay(Request $request) {

		$searchYMD = date('Y-m-d', strtotime($request->searchDay));
		$searchYM  = date('F Y', strtotime($request->searchDay));
		Session::flash('month', $searchYM);

		Session::flash('searchYMD', $searchYMD);
		$response = array('status' => 'success', 'url' => 'outgoings');
		return response()->json($response);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
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

		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('outgoings.create', ['companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList]);
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
			'dept_time'      => 'required',
			'arrival_date'   => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'arrival_time'   => 'required',
			'from_city'      => 'required',
			'to_city'        => 'required',
			'weight'         => 'required',
			// 'other'          => 'required',
			// 'carrier_name'        => 'required',
			// 'vessel_no'      => 'required',
		]);

		$data                 = $request->all();
		$data['dept_time']    = date('H:i A', strtotime($request->dept_time));
		$data['arrival_time'] = date('H:i A', strtotime($request->arrival_time));
		$data['created_by']   = Auth::user()->id;

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
		$outgoing = Outgoing::find($id);

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

		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('outgoings.show', ['outgoing' => $outgoing, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$outgoing = Outgoing::find($id);

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

		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('outgoings.edit', ['outgoing' => $outgoing, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'passenger_name' => 'required',
			'contact_no'     => 'required',
			'dept_date'      => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'dept_time'      => 'required',
			'arrival_date'   => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'arrival_time'   => 'required',
			'from_city'      => 'required',
			'to_city'        => 'required',
			'weight'         => 'required',
			// // 'other'          => 'required',
			// 'carrier_name'   => 'required',
			// 'vessel_no'      => 'required',
		]);

		$data                 = $request->all();
		$data['dept_time']    = date('H:i A', strtotime($request->dept_time));
		$data['arrival_time'] = date('H:i A', strtotime($request->arrival_time));
		$data['updated_by']   = Auth::user()->id;

		$outgoing = Outgoing::find($id);
		$outgoing->update($data);

		return redirect()->route('outgoings.index')
			->with('success', 'Passenger updated successfully');
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
			$lotin     = DB::table('lotins as l')
				->select('l.*', 's.name as sender_name', 'r.name as receiver_name')
				->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
				->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
				->where('l.status', '0')
				->where('l.deleted', 'N')
				->where('l.company_id', $outgoing->company_id)
				->where('l.date', $startDate)
				->where('l.from_country', $outgoing->from_country)
				->where('l.from_state', $outgoing->from_city)
				->where('l.to_country', $outgoing->to_country)
				->where('l.to_state', $outgoing->to_city)
				->orderBy('l.date', 'ASC')->get();
			if (count($lotin) > 0) {
				$lotinList[$startDate] = $lotin;
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
		$countryList       = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList         = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$senderList        = Sender::lists('name', 'id');
		$senderContactList = Sender::lists('contact_no', 'id');

		$receiverList        = Receiver::lists('name', 'id');
		$receiverContactList = Receiver::lists('contact_no', 'id');
		$categoryList        = Category::where('deleted', 'N')->orderBy('id', 'ASC')->lists('unit', 'id');
		$categories          = Category::where('deleted', 'N')->orderBy('id', 'ASC')->get();

		return view('outgoings.packing-list', ['outgoing' => $outgoing, 'lotinList' => $lotinList, 'countryList' => $countryList, 'stateList' => $stateList, 'senderList' => $senderList, 'senderContactList' => $senderContactList, 'receiverList' => $receiverList, 'receiverContactList' => $receiverContactList, 'categoryList' => $categoryList, 'categories' => $categories]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function packingListStore(Request $request) {
		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$outgoingId = $request->outgoing_id;
		Outgoing::find($outgoingId)->increment('packing_list');
		$outgoing    = Outgoing::find($outgoingId);
		$packinglist = $outgoing->packing_list + 1;

		$packingData['outgoing_id']  = $request->outgoing_id;
		$packingData['packing_name'] = 'Packing List' . $packinglist;
		$packingData['created_by']   = Auth::user()->id;
		$packing                     = Packing::create($packingData);
		$packingId                   = $packing->id;

		if ($outgoing->packing_id_list) {
			$outgoing->packing_id_list .= ', ' . $packingId;
		} else {
			$outgoing->packing_id_list = $packingId;
		}

		$itemIds = $request->itemIds;
		$size    = count($itemIds);

		$ItemData['outgoing_id'] = $outgoingId;
		$ItemData['packing_id']  = $packingId;
		$ItemData['status']      = 1;

		for ($i = 0; $i < $size; $i++) {
			$item = Item::find($itemIds[$i]);
			$item->update($ItemData);

			Lotin::find($item->lotin_id)->where('company_id', $outgoing->company_id)
				->where('status', 0)->decrement('total_items');
		}

		$lotins = Lotin::where('total_items', 0)->where('status', 0)
			->where('company_id', $outgoing->company_id)->where('outgoing_date', '0000-00-00')->get();

		$outgoingDate = date('Y-m-d', strtotime($outgoing->dept_date));
		foreach ($lotins as $lotin) {
			$updLotin = Lotin::find($lotin->id)->update(['status' => 1, 'outgoing_date' => $outgoingDate]);
		}

		return redirect()->route('outgoings.index')
			->with('success', 'Packe Adding is successfully');
	}

}
