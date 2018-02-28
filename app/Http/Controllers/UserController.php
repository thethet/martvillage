<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\NricCode;
use App\NricTownship;
use App\Role;
use App\State;
use App\Township;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller {
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
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$users = User::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$users = User::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		}
		$total       = $users->total();
		$perPage     = $users->perPage();
		$currentPage = $users->currentPage();
		$lastPage    = $users->lastPage();
		$lastItem    = $users->lastItem();

		return view('users.index', ['users' => $users, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'companyList' => $companyList])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
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

		$countryList  = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$roleList = Role::lists('display_name', 'id');
		} else {
			if (Auth::user()->hasRole('owner')) {
				$roleList = Role::where('id', '!=', 1)->lists('display_name', 'id');
			} else {
				$roleList = Role::whereNotIn('id', [1, 2])->lists('display_name', 'id');
			}
		}

		$companyList      = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		return view('users.create', ['roleList' => $roleList, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$this->validate($request, [
			// 'name'           => 'required|regex:/^[\pL\s\-]+$/u',
			'name'           => 'required',
			'contact_no'     => 'required|numeric',
			'dob'            => 'required|before:' . date('Y-m-d') . '|date_format:Y-m-d',
			'email'          => 'required|email|unique:users,email',
			'username'       => 'required|unique:users,username',
			'password'       => 'required|same:confirm_password',
			'image'          => 'mimes:jpeg,jpg,bmp,png',
			'gender'         => 'required',
			'marital_status' => 'required',
			'role'           => 'required',
			'company_id'     => 'required',
			'country_id'     => 'required',
			'state_id'       => 'required',
		]);

		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['photo'] = $imageName;
		}

		$data    = $request->all();
		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . ', ') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street) : '';
		$data['address']    = $address;
		$data['password']   = bcrypt($request->password);
		$data['created_by'] = Auth::user()->id;

		$user = User::create($data);
		$user->attachRole($request->role);

		return redirect()->route('users.index')
			->with('success', 'User created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$user     = User::find($id);
		$userRole = $user->roles[0]->id;

		if (Auth::user()->hasRole('administrator')) {
			$roleList = Role::lists('display_name', 'id');

		} else {
			if (Auth::user()->hasRole('owner')) {
				$roleList = Role::where('id', '!=', 1)->lists('display_name', 'id');
			} else {
				$roleList = Role::whereNotIn('id', [1, 2])->lists('display_name', 'id');
			}
		}

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

		$countryList  = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		$companyList      = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		return view('users.show', ['user' => $user, 'userRole' => $userRole, 'roleList' => $roleList, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$user     = User::find($id);
		$userRole = $user->roles[0]->id;

		if (Auth::user()->hasRole('administrator')) {
			$roleList = Role::lists('display_name', 'id');

		} else {
			if (Auth::user()->hasRole('owner')) {
				$roleList = Role::where('id', '!=', 1)->lists('display_name', 'id');
			} else {
				$roleList = Role::whereNotIn('id', [1, 2])->lists('display_name', 'id');
			}
		}

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

		$countryList  = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		$companyList      = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		return view('users.edit', ['user' => $user, 'userRole' => $userRole, 'roleList' => $roleList, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$this->validate($request, [
			'name'           => 'required',
			'contact_no'     => 'required|numeric',
			'dob'            => 'required|before:' . date('Y-m-d') . '|date_format:Y-m-d',
			// 'email'          => 'required|email|unique:users,email',
			// 'username'       => 'required|unique:users,username',
			'password'       => 'same:confirm_password',
			'image'          => 'mimes:jpeg,jpg,bmp,png',
			'gender'         => 'required',
			'marital_status' => 'required',
			'role'           => 'required',
			'company_id'     => 'required',
			'country_id'     => 'required',
			'state_id'       => 'required',
		]);
		$data      = $request->all();
		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['photo'] = $imageName;
		}

		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . ', ') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street) : '';
		$data['address'] = $address;

		if (array_key_exists('email', $data)) {
			$data['username'] = $data['email'];
		}

		$data['updated_by'] = Auth::user()->id;

		if (!empty($request->password)) {
			$data['password'] = bcrypt($request->password);
		} else {
			$data = array_except($data, array('password'));
		}

		$user     = User::find($id);
		$oldImage = $user->photo;
		$user->update($data);
		DB::table('role_user')->where('user_id', $id)->delete();
		$user->attachRole($request->role);

		if ($imageName) {
			$this->destroyFile($oldImage);
		}

		return redirect()->route('users.index')
			->with('success', 'User updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		User::find($id)->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);
		Session::flash('success', 'User deleted successfully');
		$response = array('status' => 'success', 'url' => 'users');
		return response()->json($response);
	}

	/**
	 * File upload
	 *
	 * @param ConsultantRequest $request
	 * @return static
	 */
	private function fileUpload($request) {
		if ($request->hasFile('image') && $request->file('image')->getError() == 0) {
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = rand(11111, 99999) . '.' . $extension;
			$path      = 'uploads/profile';
			$request->file('image')->move($path, $imageName);
			return $imageName;
		} else {
			// sending back with error message.
			\Session::flash('error', 'uploaded file is not valid');
		}
	}

	/**
	 * File Destroy
	 *
	 * @param ConsultantRequest $request
	 * @return static
	 */
	private function destroyFile($file) {
		$fileName = 'uploads/profile/' . $file;
		if (file_exists($fileName)) {
			@unlink($fileName);
		}
	}
}
