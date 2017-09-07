<?php

namespace App\Http\Controllers;

use App\Category;
use App\Countries;
use App\Currency;
use App\Price;
use App\States;
use Auth;
use Illuminate\Http\Request;

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

		return view('pricings.index', ['categories' => $categories, 'stateList' => $stateList, 'categoryList' => $categoryList, 'countryList' => $countryList, 'currencyList' => $currencyList])->with('i', ($request->get('page', 1) - 1) * 10);
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
			'type'       => 'required',
			'from_state' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		Currency::create($data);

		return redirect()->route('prices.index')
			->with('success', 'Country created successfully');
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
			->with('success', 'Country created successfully');
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Request $request) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}
}
