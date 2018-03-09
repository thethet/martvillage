<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Session;
use Validator;

class AuthController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	 */

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $loginPath           = '/login';
	protected $redirectTo          = '/admin/dashboard';
	protected $redirectAfterLogout = '/';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'name'     => 'required|max:255',
			'email'    => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		]);
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function postLogin(Request $request) {
		// Validate form data
		$this->validate($request, [
			'email'    => 'required|email',
			'password' => 'required',
		]);

		// Attempt to authenticate user
		// If successful, redirect to their intended location
		if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {

			$user = auth()->user();

			if ($user->deleted == 'N') {
				return redirect()->intended(route('home'));
			} else {
				\Auth::logout();
				Session::set('error', 'Your Account has not been activated yet!');
				return redirect()->intended('admin');
			}
		} else {
			Session::set('error', 'Your username and password are wrong.');
			return back();
		}
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data) {
		return User::create([
			'name'     => $data['name'],
			'email'    => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin() {
		return view('auth.login');
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout() {
		\Auth::logout();
		return redirect('admin');
	}
}
