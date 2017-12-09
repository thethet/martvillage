<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\Currency;
use Auth;
use Illuminate\Http\Request;

class CurrencyController extends Controller {
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
		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$currencies = Currency::where('deleted', 'N')->paginate(10);
		} else {
			$currencies = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->paginate(10);
		}
		$total       = $currencies->total();
		$perPage     = $currencies->perPage();
		$currentPage = $currencies->currentPage();
		$lastPage    = $currencies->lastPage();
		$lastItem    = $currencies->lastItem();

		$companies = Companies::lists('company_name', 'id');

		return view('currencies.index', ['currencies' => $currencies, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'countries' => $countries, 'companies' => $companies])->with('i', ($request->get('page', 1) - 1) * 10);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$companies = Companies::lists('company_name', 'id');

		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		return view('currencies.create', ['companies' => $companies, 'countries' => $countries]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'company_id'    => 'required',
			'type'          => 'required',
			'from_location' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$currency = Currency::create($data);

		return redirect()->route('currencies.index')
			->with('success', 'Currency created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$companies = Companies::lists('company_name', 'id');

		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$currency  = Currency::find($id);

		return view('currencies.show', ['currency' => $currency, 'companies' => $companies, 'countries' => $countries]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$companies = Companies::lists('company_name', 'id');

		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$currency  = Currency::find($id);

		return view('currencies.edit', ['currency' => $currency, 'companies' => $companies, 'countries' => $countries]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'type'          => 'required',
			'from_location' => 'required',
		]);

		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;

		$currency = Currency::find($id);
		$currency->update($data);

		return redirect()->route('currencies.index')
			->with('success', 'Currencyupdatedsuccessfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Currency::find($id)->update(['deleted' => 'Y']);
		Session::flash('success', 'Currencydeletedsuccessfully');
		$response = array('status' => 'success', 'url' => 'currencies');

		return response()->json($response);
	}
}
