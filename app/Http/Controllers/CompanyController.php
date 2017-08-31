<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\States;
use App\Townships;
use Illuminate\Http\Request;

class CompanyController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$companies = Companies::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(8);
		return view('companies.index', ['companies' => $companies])->with('i', ($request->get('page', 1) - 1) * 8);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$countries = Countries::get();
		$states    = States::get();
		$townships = Townships::get();
		return view('companies.create', ['countries' => $countries, 'states' => $states, 'townships' => $townships]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'company_name' => 'required',
			'contact_no'   => 'required',
			'email'        => 'required|email|unique:companies,email',
			'expiry_date'  => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
		]);

		$data            = $request->all();
		$data['address'] = $request->unit_number . ", " . $request->building_name . ", " . $request->street;
		$company         = Companies::create($data);

		return redirect()->route('companys.index')
			->with('success', 'Company created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$company = Companies::find($id);

		return view('companies.show', ['company' => $company]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$company   = Companies::find($id);
		$countries = Countries::get();
		$states    = States::get();
		$townships = Townships::get();
		return view('companies.edit', ['company' => $company, 'countries' => $countries, 'states' => $states, 'townships' => $townships]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'company_name' => 'required',
			'contact_no'   => 'required',
			'expiry_date'  => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
		]);
		$data            = $request->all();
		$data['address'] = $request->unit_number . ", " . $request->building_name . ", " . $request->street;

		$company = Companies::find($id)->update($data);

		return redirect()->route('companies.index')
			->with('success', 'Company updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Companies::find($id)->update(['deleted' => 'Y']);
		return redirect()->route('companies.index')
			->with('success', 'Company deleted successfully');
	}
}
