<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\Member;
use App\MemberOffer;
use App\NricCode;
use App\NricTownship;
use App\State;
use App\Township;
use Auth;
use Illuminate\Http\Request;
use Session;

class MemberController extends Controller {
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
			$members   = Member::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
			$offerList = MemberOffer::lists('type', 'id');
		} else {
			$members   = Member::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
			$offerList = MemberOffer::where('company_id', Auth::user()->company_id)->lists('type', 'id');
		}
		$total       = $members->total();
		$perPage     = $members->perPage();
		$currentPage = $members->currentPage();
		$lastPage    = $members->lastPage();
		$lastItem    = $members->lastItem();

		return view('members.index', ['members' => $members, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'companyList' => $companyList, 'offerList' => $offerList])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {

		$lastId = Member::where('company_id', Auth::user()->company_id)->count();
		if ($lastId) {
			$lastId = $lastId;
		}
		$lastId += 1;
		$code     = Auth::user()->company->short_code;
		$memberNo = $code . date('Ym') . str_pad($lastId, 6, 0, STR_PAD_LEFT);

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

		if (Auth::user()->hasRole('administrator')) {
			$offerList = MemberOffer::where('deleted', 'N')->lists('type', 'id');
		} else {
			$offerList = MemberOffer::where('deleted', 'N')->where('company_id', Auth::user()->company_id)->lists('type', 'id');
		}

		return view('members.create', ['companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'memberNo' => $memberNo, 'offerList' => $offerList]);
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
			'company_id'     => 'required',
			'name'           => 'required',
			'contact_no'     => 'required|numeric|unique:members,contact_no',
			'dob'            => 'required|before:' . date('Y-m-d') . '|date_format:Y-m-d',
			'email'          => 'required|email|unique:members,email',
			'member_no'      => 'required|unique:members,member_no',
			'gender'         => 'required',
			'marital_status' => 'required',
			'country_id'     => 'required',
			'state_id'       => 'required',
		]);

		$data    = $request->all();
		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . ', ') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street) : '';
		$data['address']    = $address;
		$data['created_by'] = Auth::user()->id;

		$member = Member::create($data);

		return redirect()->route('members.index')
			->with('success', 'Member created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$member = Member::find($id);

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

		$countryList  = Country::whereIn('id', $countryIdList)->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		$companyList      = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$nricCodeList     = NricCode::orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$offerList = MemberOffer::lists('type', 'id');
		} else {
			$offerList = MemberOffer::where('company_id', Auth::user()->company_id)->lists('type', 'id');
		}

		return view('members.show', ['member' => $member, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'offerList' => $offerList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$member = Member::find($id);

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

		if (Auth::user()->hasRole('administrator')) {
			$offerList = MemberOffer::where('deleted', 'N')->lists('type', 'id');
		} else {
			$offerList = MemberOffer::where('deleted', 'N')->where('company_id', Auth::user()->company_id)->lists('type', 'id');
		}

		return view('members.edit', ['member' => $member, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'offerList' => $offerList]);
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
			// 'contact_no'     => 'required|numeric|unique:members,contact_no',
			'dob'            => 'required|before:' . date('Y-m-d') . '|date_format:Y-m-d',
			// 'email'          => 'required|email|unique:members,email',
			// 'member_no'      => 'required|unique:members,member_no',
			'gender'         => 'required',
			'marital_status' => 'required',
			'company_id'     => 'required',
		]);
		$data = $request->all();

		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . ', ') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street) : '';
		$data['address']    = $address;
		$data['updated_by'] = Auth::user()->id;

		$member = Member::find($id);
		$member->update($data);

		return redirect()->route('members.index')
			->with('success', 'Member updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Member::find($id)->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);
		Session::flash('success', 'Member deleted successfully');
		$response = array('status' => 'success', 'url' => 'members');
		return response()->json($response);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function generateMemberNumber(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$companyId = $request->get('companyId');
		$company   = Company::find($companyId);
		$code      = $company->short_code;

		$lastId = Member::latest('id')->first();
		if ($lastId) {
			$lastId = $lastId->id;
		}
		$lastId += 1;
		$memberNo = $code . date('Ym') . str_pad($lastId, 6, 0, STR_PAD_LEFT);

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);

		return json_encode($memberNo, JSON_UNESCAPED_UNICODE);
	}

}
