<?php

namespace App\Http\Controllers;
use App\Company;
use App\Country;
use App\Lotin;
use App\NricCode;
use App\NricTownship;
use App\Receiver;
use App\Sender;
use App\State;
use Illuminate\Http\Request;

class FrontEndController extends Controller {
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$companies = Company::where('deleted', 'N')->get();
		return view('frontend.index', ['companies' => $companies]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function search(Request $request) {
		$lotinData = Lotin::where('lot_no', $request->q)->first();

		if ($lotinData) {
			$sender   = Sender::find($lotinData->sender_id);
			$receiver = Receiver::find($lotinData->receiver_id);
		} else {
			return redirect()->route('frontend.index');
		}

		$countryList = Country::where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		$receivers     = Receiver::get();
		$receiverCount = count($receivers);

		return view('frontend.search', ['lotinData' => $lotinData, 'sender' => $sender, 'receiver' => $receiver, 'countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'receiverCount' => $receiverCount]);
	}
}
