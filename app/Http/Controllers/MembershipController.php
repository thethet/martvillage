<?php

namespace App\Http\Controllers;

use App\Company;
use App\MemberOffer;
use Auth;
use Illuminate\Http\Request;
use Session;

class MembershipController extends Controller {
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
		$request->merge(array_map('trim', $request->all()));

		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$offers = MemberOffer::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$offers = MemberOffer::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		}
		$total       = $offers->total();
		$perPage     = $offers->perPage();
		$currentPage = $offers->currentPage();
		$lastPage    = $offers->lastPage();
		$lastItem    = $offers->lastItem();

		return view('memberships.index', ['offers' => $offers, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'companyList' => $companyList])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');

		return view('memberships.create', ['companyList' => $companyList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$request->merge(array_map('trim', $request->all()));

		$this->validate($request, [
			'company_id' => 'required',
			'type'       => 'required',
			'rate'       => 'required|numeric',
		]);
		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		MemberOffer::create($data);

		return redirect()->route('memberships.index')
			->with('success', 'Member Offer created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$offer       = MemberOffer::find($id);

		return view('memberships.show', ['offer' => $offer, 'companyList' => $companyList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$offer       = MemberOffer::find($id);

		return view('memberships.edit', ['offer' => $offer, 'companyList' => $companyList]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$request->merge(array_map('trim', $request->all()));

		$this->validate($request, [
			'company_id' => 'required',
			'type'       => 'required',
			'rate'       => 'required|numeric',
		]);
		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;
		$offer              = MemberOffer::find($id);
		$offer->update($data);

		return redirect()->route('memberships.index')
			->with('success', 'Member Offer updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		MemberOffer::find($id)->update(['deleted' => 'Y']);
		Session::flash('success', 'Member Offer deleted successfully');
		$response = array('status' => 'success', 'url' => 'memberships');
		return response()->json($response);
	}
}
