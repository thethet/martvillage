<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\Member;
use App\MemberOffer;
use App\NricCodes;
use App\NricTownships;
use App\States;
use App\Townships;
use Auth;
use Illuminate\Http\Request;
use Session;

class MemberController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$companyList = Companies::where('deleted', 'N')->lists('company_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$members   = Member::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
			$offerList = MemberOffer::where('deleted', 'N')->lists('type', 'id');
		} else {
			$members   = Member::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
			$offerList = MemberOffer::where('deleted', 'N')->where('company_id', Auth::user()->company_id)->lists('type', 'id');
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

		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}
		$townshipIds    = $company->states;
		$townshipIdList = array();
		foreach ($townshipIds as $townshipId) {
			$townshipIdList[] = $townshipId->id;
		}

		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$states    = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townships = Townships::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		$companies     = Companies::where('deleted', 'N')->lists('company_name', 'id');
		$nricCodes     = NricCodes::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownships = NricTownships::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$offerList = MemberOffer::where('deleted', 'N')->lists('type', 'id');
		} else {
			$offerList = MemberOffer::where('deleted', 'N')->where('company_id', Auth::user()->company_id)->lists('type', 'id');
		}

		return view('members.create', ['companies' => $companies, 'countries' => $countries, 'states' => $states, 'townships' => $townships, 'nricCodes' => $nricCodes, 'nricTownships' => $nricTownships, 'memberNo' => $memberNo, 'offerList' => $offerList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'name'           => 'required',
			'contact_no'     => 'required|unique:members,contact_no',
			'dob'            => 'required|before:' . date('Y-m-d') . '|date_format:Y-m-d',
			'email'          => 'required|email|unique:members,email',
			'member_no'      => 'required|unique:members,member_no',
			'gender'         => 'required',
			'marital_status' => 'required',
			'company_id'     => 'required',
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
		//
	}

	/**
	 * Redirect Route Using Ajax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editAjax($userId, Request $request) {
		$id       = $request->id;
		$response = array('status' => 'success', 'url' => 'members/' . $id . '/edit');
		return response()->json($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request) {
		$member = Member::find($id);

		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}
		$townshipIds    = $company->states;
		$townshipIdList = array();
		foreach ($townshipIds as $townshipId) {
			$townshipIdList[] = $townshipId->id;
		}

		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$states    = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townships = Townships::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		$companies     = Companies::where('deleted', 'N')->lists('company_name', 'id');
		$nricCodes     = NricCodes::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownships = NricTownships::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');
		return view('members.edit', ['member' => $member, 'companies' => $companies, 'countries' => $countries, 'states' => $states, 'townships' => $townships, 'nricCodes' => $nricCodes, 'nricTownships' => $nricTownships]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'name'           => 'required',
			// 'contact_no'     => 'required|unique:members,contact_no',
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
		Member::find($id)->update(['deleted' => 'Y']);
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
		$companyId = $request->get('companyId');
		$company   = Companies::find($companyId);
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
