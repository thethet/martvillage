<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Country;
use App\Currency;
use App\Item;
use App\Lotin;
use App\NricCode;
use App\NricTownship;
use App\Price;
use App\Receiver;
use App\Sender;
use App\State;
use Auth;
use Illuminate\Http\Request;

class TrackingController extends Controller {
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
		return view('trackings.index');
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
		$lotinData = Lotin::find($id);

		$sender   = Sender::find($lotinData->sender_id);
		$receiver = Receiver::find($lotinData->receiver_id);

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

		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$receivers = Receiver::get();
		} else {
			$receivers = Receiver::where('company_id', Auth::user()->company_id)->get();
		}
		$receiverCount = count($receivers);

		$itemList = Item::where('lotin_id', $id)->get();

		if (Auth::user()->hasRole('administrator')) {
			$priceList    = Price::where('deleted', 'N')->lists('title_name', 'id');
			$currencyList = Currency::where('deleted', 'N')->orderBy('id', 'ASC')->lists('type', 'id');
		} else {
			$priceList    = Price::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('title_name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'ASC')->lists('type', 'id');
		}
		$categoryList = Category::where('deleted', 'N')->orderBy('id', 'ASC')->lists('unit', 'id');

		return view('trackings.show', ['lotinData' => $lotinData, 'sender' => $sender, 'receiver' => $receiver, 'countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'receiverCount' => $receiverCount, 'itemList' => $itemList, 'priceList' => $priceList, 'categoryList' => $categoryList, 'currencyList' => $currencyList]);
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

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function search(Request $request) {
		$lotinData = Lotin::where('lot_no', $request->lot_no)->first();

		if ($lotinData) {
			$sender   = Sender::find($lotinData->sender_id);
			$receiver = Receiver::find($lotinData->receiver_id);
		} else {
			return redirect()->route('trackings.index')
				->with('error', 'Your Lot Number does not exist.');
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

		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$receivers = Receiver::get();
		} else {
			$receivers = Receiver::where('company_id', Auth::user()->company_id)->get();
		}
		$receiverCount = count($receivers);

		return view('trackings.search', ['lotinData' => $lotinData, 'sender' => $sender, 'receiver' => $receiver, 'countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'receiverCount' => $receiverCount]);
	}
}
