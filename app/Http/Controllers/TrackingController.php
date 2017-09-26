<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Item;
use App\Lotin;
use App\NricCodes;
use App\NricTownships;
use App\Receiver;
use App\Sender;
use App\States;
use Auth;
use Illuminate\Http\Request;

class TrackingController extends Controller {
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

		$countries = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$states    = States::where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$nricCodes     = NricCodes::where('deleted', 'N')->orderBy('id', 'asc')->lists('nric_code', 'id');
		$nricTownships = NricTownships::where('deleted', 'N')->orderBy('serial_no', 'asc')->lists('short_name', 'id');

		$receivers     = Receiver::where('company_id', Auth::user()->company_id)->get();
		$receiverCount = count($receivers);

		$items = Item::where('lotin_id', $id)->get();

		return view('trackings.show', ['lotinData' => $lotinData, 'sender' => $sender, 'receiver' => $receiver, 'countries' => $countries, 'states' => $states, 'nricCodes' => $nricCodes, 'nricTownships' => $nricTownships, 'receiverCount' => $receiverCount, 'items' => $items]);
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

		$sender   = Sender::find($lotinData->sender_id);
		$receiver = Receiver::find($lotinData->receiver_id);

		$countries = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$states    = States::where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$nricCodes     = NricCodes::where('deleted', 'N')->orderBy('id', 'asc')->lists('nric_code', 'id');
		$nricTownships = NricTownships::where('deleted', 'N')->orderBy('serial_no', 'asc')->lists('short_name', 'id');

		$receivers     = Receiver::where('company_id', Auth::user()->company_id)->get();
		$receiverCount = count($receivers);

		// dd($lotinData);
		return view('trackings.search', ['lotinData' => $lotinData, 'sender' => $sender, 'receiver' => $receiver, 'countries' => $countries, 'states' => $states, 'nricCodes' => $nricCodes, 'nricTownships' => $nricTownships, 'receiverCount' => $receiverCount]);
	}
}
