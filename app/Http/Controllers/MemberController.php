<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\Member;
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
		if (Auth::user()->hasRole('administrator')) {
			$members = Member::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$members = Member::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		}

		return view('members.index', ['members' => $members])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$companies     = Companies::where('deleted', 'N')->lists('company_name', 'id');
		$countries     = Countries::where('deleted', 'N')->lists('country_name', 'id');
		$states        = States::where('deleted', 'N')->lists('state_name', 'id');
		$townships     = Townships::where('deleted', 'N')->lists('township_name', 'id');
		$nricCodes     = NricCodes::where('deleted', 'N')->orderBy('id', 'asc')->lists('nric_code', 'id');
		$nricTownships = NricTownships::where('deleted', 'N')->orderBy('serial_no', 'asc')->lists('short_name', 'id');
		return view('members.create', ['companies' => $companies, 'countries' => $countries, 'states' => $states, 'townships' => $townships, 'nricCodes' => $nricCodes, 'nricTownships' => $nricTownships]);
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

		$companies     = Companies::where('deleted', 'N')->lists('company_name', 'id');
		$countries     = Countries::lists('country_name', 'id');
		$states        = States::lists('state_name', 'id');
		$townships     = Townships::lists('township_name', 'id');
		$nricCodes     = NricCodes::orderBy('id', 'asc')->lists('nric_code', 'id');
		$nricTownships = NricTownships::orderBy('serial_no', 'asc')->lists('short_name', 'id');
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
}
