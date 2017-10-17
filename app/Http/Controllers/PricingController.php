<?php

namespace App\Http\Controllers;

use App\Category;
use App\Companies;
use App\Countries;
use App\Currency;
use App\Price;
use App\PriceTitles;
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

		$countryList = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('deleted', 'N')->lists('type', 'id');

			$currencyTitle  = Currency::where('deleted', 'N')->get();
			$pricingLists   = Price::where('deleted', 'N')->get();
			$priceTitleList = PriceTitles::where('deleted', 'N')->get();
		} else {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('type', 'id');

			$currencyTitle  = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$pricingLists   = Price::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$priceTitleList = PriceTitles::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
		}

		$currencyTitleList = array();
		$subTitleList      = array();
		$priceLists        = array();
		$i                 = 0;
		$totalCol          = 0;
		foreach ($currencyTitle as $key => $value) {
			$company_name                               = Companies::where('id', $value->company_id)->first()->short_code;
			$currencyTitleList[$i]['type']              = $value->type;
			$currencyTitleList[$i]['country']           = $value->location->country_code;
			$currencyTitleList[$i]['company_name']      = $company_name;
			$currencyTitleList[$key]['total_sub_title'] = 1;
			$i++;
		}

		foreach ($currencyTitle as $keys => $val) {
			$states = Price::where('company_id', $value->company_id)->where('deleted', 'N')->where('from_country', $val->from_location)->get();

			$j = 0;
			foreach ($states as $key => $state) {
				$from_state                                     = States::where('id', $state->from_state)->first()->state_code;
				$to_state                                       = States::where('id', $state->to_state)->first()->state_code;
				$stateCode                                      = $from_state . ' - ' . $to_state;
				$subTitleList[$val->location->country_code][$j] = $stateCode;

				$subTitleList[$val->location->country_code] = array_map("unserialize", array_unique(array_map("serialize", $subTitleList[$val->location->country_code])));
				$j++;

				$pCount                                      = count($subTitleList[$val->location->country_code]);
				$currencyTitleList[$keys]['total_sub_title'] = ($pCount == 0) ? 1 : $pCount;
				$totalCol += $currencyTitleList[$keys]['total_sub_title'];
			}
			if (!array_key_exists($val->location->country_code, $subTitleList)) {
				$subTitleList[$val->location->country_code][$j] = '';
			}

		}

		foreach ($priceTitleList as $key => $title) {

			$k = 0;
			foreach ($currencyTitle as $key => $val) {
				$states = Price::where('company_id', $val->company_id)->where('deleted', 'N')->where('from_country', $val->from_location)->get();

				foreach ($states as $key => $state) {
					$from_state = States::where('id', $state->from_state)->first()->state_code;
					$to_state   = States::where('id', $state->to_state)->first()->state_code;

					foreach ($pricingLists as $key => $ptl) {

						if (!isset($priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state])) {
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['id']         = 0;
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['unit_price'] = '';
						}

						if ($ptl->from_state == $state->from_state && $ptl->to_state == $state->to_state && $title->title_name == $ptl->title_name) {
							// dd($ptl);
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['id']         = $ptl->id;
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['unit_price'] = $ptl->unit_price;
						}

					}
				}

				if (!isset($priceLists[$title->title_name][$val->location->country_code])) {
					$priceLists[$title->title_name][$val->location->country_code] = array();
				}
				$k++;
			}

		}
		$totalCol += 2 + count($currencyTitle);

		return view('pricings.index', ['categories' => $categories, 'stateList' => $stateList, 'categoryList' => $categoryList, 'countryList' => $countryList, 'currencyList' => $currencyList, 'currencyTitle' => $currencyTitle, 'pricingLists' => $pricingLists, 'currencyTitleList' => $currencyTitleList, 'subTitleList' => $subTitleList, 'priceLists' => $priceLists, 'totalCol' => $totalCol])->with('i', ($request->get('page', 1) - 1) * 10);
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

		$titleData['company_id'] = $request->company_id;
		$titleData['title_name'] = $request->title_name;
		$titleData['created_by'] = Auth::user()->id;
		$title                   = PriceTitles::where('company_id', $request->company_id)->where('title_name', $request->title_name)->first();
		if (!$title) {
			$title = PriceTitles::create($titleData);
		}

		$data['title_id'] = $title->id;
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

		$countryList = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('deleted', 'N')->lists('type', 'id');

			$currencyTitle  = Currency::where('deleted', 'N')->get();
			$pricingLists   = Price::where('deleted', 'N')->get();
			$priceTitleList = PriceTitles::where('deleted', 'N')->get();
		} else {
			$categoryList = Category::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('type', 'id');

			$currencyTitle  = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$pricingLists   = Price::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$priceTitleList = PriceTitles::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
		}

		$currencyTitleList = array();
		$subTitleList      = array();
		$priceLists        = array();
		$i                 = 0;
		$totalCol          = 0;
		foreach ($currencyTitle as $key => $value) {
			$company_name                               = Companies::where('id', $value->company_id)->first()->short_code;
			$currencyTitleList[$i]['type']              = $value->type;
			$currencyTitleList[$i]['country']           = $value->location->country_code;
			$currencyTitleList[$i]['company_name']      = $company_name;
			$currencyTitleList[$key]['total_sub_title'] = 1;
			$i++;
		}

		foreach ($currencyTitle as $keys => $val) {
			$states = Price::where('company_id', $val->company_id)->where('deleted', 'N')->where('from_country', $val->from_location)->get();

			$j = 0;
			foreach ($states as $key => $state) {
				$from_state                                     = States::where('id', $state->from_state)->first()->state_code;
				$to_state                                       = States::where('id', $state->to_state)->first()->state_code;
				$stateCode                                      = $from_state . ' - ' . $to_state;
				$subTitleList[$val->location->country_code][$j] = $stateCode;

				$subTitleList[$val->location->country_code] = array_map("unserialize", array_unique(array_map("serialize", $subTitleList[$val->location->country_code])));
				$j++;

				$pCount                                      = count($subTitleList[$val->location->country_code]);
				$currencyTitleList[$keys]['total_sub_title'] = ($pCount == 0) ? 1 : $pCount;
				$totalCol += $currencyTitleList[$keys]['total_sub_title'];
			}
			if (!array_key_exists($val->location->country_code, $subTitleList)) {
				$subTitleList[$val->location->country_code][$j] = '';
			}

		}

		foreach ($priceTitleList as $key => $title) {

			$k = 0;
			foreach ($currencyTitle as $key => $val) {
				$states = Price::where('company_id', $val->company_id)->where('deleted', 'N')->where('from_country', $val->from_location)->get();

				foreach ($states as $key => $state) {
					$from_state = States::where('id', $state->from_state)->first()->state_code;
					$to_state   = States::where('id', $state->to_state)->first()->state_code;

					foreach ($pricingLists as $key => $ptl) {

						if (!isset($priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state])) {
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['id']         = 0;
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['unit_price'] = '';
						}

						if ($ptl->from_state == $state->from_state && $ptl->to_state == $state->to_state && $title->title_name == $ptl->title_name) {
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['id']         = $ptl->id;
							$priceLists[$title->title_name][$val->location->country_code][$from_state . ' - ' . $to_state]['unit_price'] = $ptl->unit_price;
						}

					}
				}

				if (!isset($priceLists[$title->title_name][$val->location->country_code])) {
					$priceLists[$title->title_name][$val->location->country_code] = array();
				}
				$k++;
			}

		}
		$totalCol += 2 + count($currencyTitle);

		return view('pricings.edit', ['prices' => $prices, 'categories' => $categories, 'stateList' => $stateList, 'categoryList' => $categoryList, 'countryList' => $countryList, 'currencyList' => $currencyList, 'currencyTitle' => $currencyTitle, 'pricingLists' => $pricingLists, 'currencyTitleList' => $currencyTitleList, 'subTitleList' => $subTitleList, 'priceLists' => $priceLists, 'totalCol' => $totalCol])->with('i', ($request->get('page', 1) - 1) * 10);
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
