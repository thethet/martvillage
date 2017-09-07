<?php

namespace App\Http\Controllers;

use App\Category;
use App\Countries;
use App\Currency;
use App\Price;
use App\States;
use Auth;
use Illuminate\Http\Request;
use Session;

class PricingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$categories = Category::where('deleted', 'N')->get();

		if (Auth::user()->hasRole('administrator')) {
		} else {
		}
		$countryList  = Countries::where('deleted', 'N')->lists('country_name', 'id');
		$stateList    = States::where('deleted', 'N')->lists('state_name', 'id');
		$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
		$currencyList = Currency::where('deleted', 'N')->lists('type', 'id');

		$currencyTitle = Currency::where('deleted', 'N')->get();
		$pricingLists  = Price::where('deleted', 'N')->get();

		return view('pricings.index', ['categories' => $categories, 'stateList' => $stateList, 'categoryList' => $categoryList, 'countryList' => $countryList, 'currencyList' => $currencyList, 'currencyTitle' => $currencyTitle, 'pricingLists' => $pricingLists])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeCurrency(Request $request) {
		$this->validate($request, [
			'type'          => 'required',
			'from_location' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		Currency::create($data);

		return redirect()->route('prices.index')
			->with('success', 'Currency created successfully');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storePrice(Request $request) {
		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		Price::create($data);
		return redirect()->route('prices.index')
			->with('success', 'Pricing created successfully');
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
		$response = array('status' => 'success', 'url' => 'prices/' . $id . '/edit');
		return response()->json($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request) {
		$prices     = Price::find($id);
		$categories = Category::where('deleted', 'N')->get();

		if (Auth::user()->hasRole('administrator')) {
		} else {
		}
		$countryList  = Countries::where('deleted', 'N')->lists('country_name', 'id');
		$stateList    = States::where('deleted', 'N')->lists('state_name', 'id');
		$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
		$currencyList = Currency::where('deleted', 'N')->lists('type', 'id');

		$currencyTitle = Currency::where('deleted', 'N')->get();
		$pricingLists  = Price::where('deleted', 'N')->get();

		return view('pricings.edit', ['categories' => $categories, 'stateList' => $stateList, 'categoryList' => $categoryList, 'countryList' => $countryList, 'currencyList' => $currencyList, 'currencyTitle' => $currencyTitle, 'pricingLists' => $pricingLists, 'prices' => $prices])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;
		Price::find($id)->update($data);
		return redirect()->route('prices.index')
			->with('success', 'Pricing updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Price::find($id)->update(['deleted' => 'Y']);

		Session::flash('success', 'Pricing deleted successfully');
		$response = array('status' => 'success', 'url' => 'prices');
		return response()->json($response);
	}
}
