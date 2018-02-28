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
use App\Township;
use Config;
use Illuminate\Http\Request;
use Mail;

class FrontEndController extends Controller {
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$companies   = Company::where('deleted', 'N')->orderBy('rating', 'DESC')->take(3)->get();
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->get();
		$totalRating = (int) Company::where('deleted', 'N')->sum('rating');
		return view('frontend.index', ['companies' => $companies, 'companyList' => $companyList, 'totalRating' => $totalRating]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function search(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$lotinData = Lotin::where('lot_no', trim($request->q))->first();

		if ($lotinData) {
			$sender   = Sender::find($lotinData->sender_id);
			$receiver = Receiver::find($lotinData->receiver_id);
		} else {
			return redirect()->route('frontend.index');
		}

		$countryList = Country::orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$nricCodeList     = NricCode::orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		$receivers     = Receiver::get();
		$receiverCount = count($receivers);

		$companyList = Company::orderBy('company_name', 'ASC')->get();

		return view('frontend.search', ['lotinData' => $lotinData, 'sender' => $sender, 'receiver' => $receiver, 'countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'receiverCount' => $receiverCount, 'companyList' => $companyList]);
	}

	/**
	 * Show the agent list.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function agentRating($id) {
		Company::find($id)->increment('rating');
		return redirect()->back();
	}

	/**
	 * Show the agent list.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function agentList() {
		$companies   = Company::where('deleted', 'N')->orderBy('rating', 'DESC')->paginate(9);
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->get();
		$totalRating = (int) Company::where('deleted', 'N')->sum('rating');
		return view('frontend.agent-list', ['companies' => $companies, 'companyList' => $companyList, 'totalRating' => $totalRating]);
	}

	/**
	 * Show the agent list.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function agentDetail($id) {
		$company      = Company::find($id);
		$companyList  = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->get();
		$countryList  = Country::orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::orderBy('township_name', 'ASC')->lists('township_name', 'id');

		return view('frontend.agent-detail', ['company' => $company, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList]);
	}

	/**
	 * Show Contact Us Form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showContactUs() {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->get();
		return view('frontend.contact-us', ['companyList' => $companyList]);
	}

	/**
	 * Contact Mail Sending
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function contactMailSending(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$data = $request->all();

		$fromName          = $data['first_name'] . ' ' . $data['last_name'];
		$data['from_name'] = $fromName;

		Config::set('mail.from.address', $data['email']);

		Mail::alwaysFrom($data['email'], $data['from_name']);
		Mail::send('emails.contact-us', ['data' => $data], function ($message) use ($data) {
			$message->from(Config::get('mail.from.address'), $data['from_name']);
			$message->replyTo($data['email'], $data['from_name']);
			$message->to('thetthetaye2709@gmail.com', 'ShweCargo')->subject($data['subject']);
		});

		return redirect()->back();
	}

	/**
	 * Show About Us Form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showAboutUs() {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->get();
		return view('frontend.about-us', ['companyList' => $companyList]);
	}

	/**
	 * Show How To Use Form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showHowToUse() {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->get();
		return view('frontend.how-to-use', ['companyList' => $companyList]);
	}
}
