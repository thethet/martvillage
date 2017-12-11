<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
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
		if (Auth::user()->hasRole('administrator')) {
			$companies = Company::count();
			$users     = User::count();
			$members   = Member::count();
			$countries = Country::count();
			$cities    = State::count();
			$townships = Township::count();
		} else {
			$companies = Company::count();
			$users     = User::count();
			$members   = Member::count();
			$countries = Country::count();
			$cities    = State::count();
			$townships = Township::count();
		}

		return view('dashboard.dashboard', ['companies' => $companies, 'users' => $users, 'members' => $members, 'countries' => $countries, 'cities' => $cities]);
	}
}
