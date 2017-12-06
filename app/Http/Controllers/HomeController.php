<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\Member;
use App\States;
use App\Townships;
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
			$companies = Companies::count();
			$users     = User::count();
			$members   = Member::count();
			$countries = Countries::count();
			$cities    = States::count();
			$townships = Townships::count();
		} else {
			$companies = Companies::count();
			$users     = User::count();
			$members   = Member::count();
			$countries = Countries::count();
			$cities    = States::count();
			$townships = Townships::count();
		}

		return view('dashboard.dashboard', ['companies' => $companies, 'users' => $users, 'members' => $members, 'countries' => $countries, 'cities' => $cities]);
	}
}
