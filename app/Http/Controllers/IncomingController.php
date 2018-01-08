<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Country;
use App\Item;
use App\Lotin;
use App\Outgoing;
use App\Receiver;
use App\Sender;
use App\State;
use Auth;
use Illuminate\Http\Request;

class IncomingController extends Controller {
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
		if ($request->arrival_date) {
			$arrivalDate = date('Y-m-d', strtotime($request->arrival_date));
		} else {
			$arrivalDate = date('Y-m-d');
		}

		if ($request->arrival_time) {
			$currentTime = date('H:i A', strtotime($request->arrival_time));
		} else {
			$currentTime = date('H:i A');
		}

		$query = Outgoing::where('arrival_date', $arrivalDate)
		// ->where('arrival_time', '<=', $currentTime)
			->where('deleted', 'N');

		if (Auth::user()->hasRole('administrator')) {
			$outgoingList = $query->paginate(10);
		} elseif (Auth::user()->hasRole('owner')) {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)->paginate(10);
		} else {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)
				->where('to_city', Auth::user()->state_id)->paginate(10);
		}
		$total       = $outgoingList->total();
		$perPage     = $outgoingList->perPage();
		$currentPage = $outgoingList->currentPage();
		$lastPage    = $outgoingList->lastPage();
		$lastItem    = $outgoingList->lastItem();

		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');

		return view('incomings.index', ['outgoingList' => $outgoingList, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'companyList' => $companyList])->with('p', ($request->get('page', 1) - 1) * 5);
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
		$companyList       = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList       = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList         = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$senderList        = Sender::lists('name', 'id');
		$senderContactList = Sender::lists('contact_no', 'id');

		$receiverList        = Receiver::lists('name', 'id');
		$receiverContactList = Receiver::lists('contact_no', 'id');
		$categoryList        = Category::where('deleted', 'N')->orderBy('id', 'ASC')->lists('unit', 'id');
		$categories          = Category::where('deleted', 'N')->orderBy('id', 'ASC')->get();

		return view('incomings.show', ['outgoing' => $outgoing, 'countryList' => $countryList, 'stateList' => $stateList, 'senderList' => $senderList, 'senderContactList' => $senderContactList, 'receiverList' => $receiverList, 'receiverContactList' => $receiverContactList, 'categoryList' => $categoryList, 'categories' => $categories, 'companyList' => $companyList]);
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
		Item::find($id)->update(['status' => 2]);

		$item = Item::find($id);

		$allLotCount = Item::where('lotin_id', $item->lotin_id)->count();

		$arriveLotCount = Item::where('lotin_id', $item->lotin_id)->where('status', 2)->count();

		$incomingDate = date('Y-m-d');
		if ($allLotCount == $arriveLotCount) {
			Lotin::find($item->lotin_id)->update(['status' => 2, 'incoming_date' => $incomingDate]);
		}
		// return redirect()->back()->with('success', 'Item is successfully arrive');

		$response = array('status' => 'success', 'url' => $item->outgoing_id);
		return response()->json($response);
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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateArriveStatus($barcode) {
		Item::where('barcode', $barcode)->update(['status' => 2]);

		$item = Item::where('barcode', $barcode)->first();

		$allLotCount = Item::where('lotin_id', $item->lotin_id)->count();

		$arriveLotCount = Item::where('lotin_id', $item->lotin_id)->where('status', 2)->count();

		$incomingDate = date('Y-m-d');
		if ($allLotCount == $arriveLotCount) {
			Lotin::find($item->lotin_id)->update(['status' => 2, 'incoming_date' => $incomingDate]);
		}
		// return redirect()->back()->with('success', 'Item is successfully arrive');

		$response = array('status' => 'success', 'url' => $item->outgoing_id);
		return response()->json($response);
	}
}
