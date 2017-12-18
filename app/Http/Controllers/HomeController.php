<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\Lotin;
use App\Member;
use App\State;
use App\Township;
use App\User;
use Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$date = date('Y-m-d');

		if (Auth::user()->hasRole('administrator')) {
			$companies   = Company::count();
			$users       = User::count();
			$members     = Member::count();
			$countries   = Country::count();
			$cities      = State::count();
			$townships   = Township::count();
			$lotins      = Lotin::where('date', $date)->count();
			$outgoings   = Lotin::where('outgoing_date', $date)->where('status', 1)->count();
			$incomings   = Lotin::where('incoming_date', $date)->where('status', 2)->count();
			$collections = Lotin::where('collected_date', $date)->where('status', 3)->count();
		} else {
			$myCompany      = Company::find(Auth::user()->company_id);
			$countryIdList  = array();
			$stateIdList    = array();
			$townshipIdList = array();
			if (count($myCompany) > 0) {
				$countryIds = $myCompany->country;
				foreach ($countryIds as $country) {
					$countryIdList[] = $country->id;
				}
				$stateIds = $myCompany->state;
				foreach ($stateIds as $stateId) {
					$stateIdList[] = $stateId->id;
				}
				$townshipIds = $myCompany->township;
				foreach ($townshipIds as $townshipId) {
					$townshipIdList[] = $townshipId->id;
				}
			}

			$companies   = Company::where('id', Auth::user()->company_id)->count();
			$users       = User::where('company_id', Auth::user()->company_id)->count();
			$members     = Member::where('company_id', Auth::user()->company_id)->count();
			$countries   = Country::whereIn('id', $countryIdList)->count();
			$cities      = State::whereIn('id', $stateIdList)->count();
			$townships   = Township::whereIn('id', $townshipIdList)->count();
			$lotins      = Lotin::where('date', $date)->where('company_id', Auth::user()->company_id)->count();
			$outgoings   = Lotin::where('outgoing_date', $date)->where('status', 1)->where('company_id', Auth::user()->company_id)->count();
			$incomings   = Lotin::where('incoming_date', $date)->where('status', 2)->where('company_id', Auth::user()->company_id)->count();
			$collections = Lotin::where('collected_date', $date)->where('status', 3)->where('company_id', Auth::user()->company_id)->count();
		}

		return view('dashboard.dashboard', ['companies' => $companies, 'users' => $users, 'members' => $members, 'countries' => $countries, 'cities' => $cities, 'lotins' => $lotins, 'outgoings' => $outgoings, 'incomings' => $incomings, 'collections' => $collections]);
	}
}
