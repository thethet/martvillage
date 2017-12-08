<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use Auth;
use Illuminate\Http\Request;
use Session;

class CountryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}

		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->paginate(10);

		$total       = $countries->total();
		$perPage     = $countries->perPage();
		$currentPage = $countries->currentPage();
		$lastPage    = $countries->lastPage();
		$lastItem    = $countries->lastItem();

		$allCountries   = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->paginate(10, ['*'], 'apage');
		$allTotal       = $allCountries->total();
		$allPerPage     = $allCountries->perPage();
		$allCurrentPage = $allCountries->currentPage();
		$allLastPage    = $allCountries->lastPage();
		$allLastItem    = $allCountries->lastItem();

		return view('countries.index', ['countries' => $countries, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'allCountries' => $allCountries, 'allTotal' => $allTotal, 'allPerPage' => $allPerPage, 'allCurrentPage' => $allCurrentPage, 'allLastPage' => $allLastPage, 'allLastItem' => $allLastItem, 'countryIdList' => $countryIdList])->with('i', ($request->get('page', 1) - 1) * 10)->with('a', ($request->get('apage', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('countries.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'country_name' => 'required|unique:countries,country_name',
			'country_code' => 'required|unique:countries,country_code',
			'description'  => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$country = Countries::create($data);

		$company = Companies::find(Auth::user()->company_id);
		$company->countries()->attach($country);

		return redirect()->route('countries.index')
			->with('success', 'Country created successfully');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeByCompany($id) {
		$country = Countries::find($id);

		$company = Companies::find(Auth::user()->company_id);
		$company->countries()->attach($country);

		return redirect()->route('countries.index')
			->with('success', 'Country created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$country = Countries::find($id);

		return view('countries.show', ['country' => $country]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$country = Countries::find($id);

		return view('countries.edit', ['country' => $country]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'country_name' => 'required',
			'country_code' => 'required',
			'description'  => 'required',
		]);

		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;
		$country            = Countries::find($id);
		$country->update($data);

		// $company = Companies::find(Auth::user()->company_id);
		// $company->countries()->attach($country);

		return redirect()->route('countries.index')
			->with('success', 'Country updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$country = Countries::find($id);

		if ($country->total_cities == 0) {
			$country->update(['deleted' => 'Y']);
			Session::flash('success', 'Country deleted successfully');
			$response = array('status' => 'success', 'url' => 'countries');
		} else {
			Session::flash('unsuccess', 'Country deleted unsuccessfully');
			$response = array('status' => 'success', 'url' => 'countries');
		}

		return response()->json($response);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyByCompany($id) {
		$company = Companies::find(Auth::user()->company_id);
		$company->countries()->detach($id);

		Session::flash('success', 'Country deleted successfully');
		$response = array('status' => 'success', 'url' => 'countries');

		return response()->json($response);
	}
}
