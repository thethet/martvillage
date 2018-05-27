<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Country;
use App\Currency;
use App\Price;
use App\PriceTitle;
use App\State;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as Collect;
use Session;

class PriceController extends Controller {
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

		if (Auth::user()->hasRole('administrator')) {
			$currencyTitle  = Currency::where('deleted', 'N')->get();
			$pricingLists   = Price::where('deleted', 'N')->get();
			$priceTitleList = PriceTitle::where('deleted', 'N')->get();
		} else {
			$currencyTitle  = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$pricingLists   = Price::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
			$priceTitleList = PriceTitle::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
		}

		$currencyTitleList = array();
		$subTitleList      = array();
		$priceLists        = array();
		$i                 = 0;
		$totalCol          = 0;
		foreach ($currencyTitle as $key => $value) {
			$company_name                               = Company::where('id', $value->company_id)->first()->short_code;
			$currencyTitleList[$i]['type']              = $value->type;
			$currencyTitleList[$i]['country']           = $value->getFromCountry->country_code;
			$currencyTitleList[$i]['company_name']      = $company_name;
			$currencyTitleList[$key]['total_sub_title'] = 1;
			$i++;
		}

		foreach ($currencyTitle as $keys => $val) {
			$states = Price::where('company_id', $value->company_id)->where('deleted', 'N')->where('from_country', $val->from_location)->get();

			$j = 0;
			foreach ($states as $key => $state) {
				$from_state                                           = State::where('id', $state->from_state)->first()->state_code;
				$to_state                                             = State::where('id', $state->to_state)->first()->state_code;
				$stateCode                                            = $from_state . ' - ' . $to_state;
				$subTitleList[$val->getFromCountry->country_code][$j] = $stateCode;

				$subTitleList[$val->getFromCountry->country_code] = array_map("unserialize", array_unique(array_map("serialize", $subTitleList[$val->getFromCountry->country_code])));
				$j++;

				$pCount                                      = count($subTitleList[$val->getFromCountry->country_code]);
				$currencyTitleList[$keys]['total_sub_title'] = ($pCount == 0) ? 1 : $pCount;
				$totalCol += $currencyTitleList[$keys]['total_sub_title'];
			}
			if (!array_key_exists($val->getFromCountry->country_code, $subTitleList)) {
				$subTitleList[$val->getFromCountry->country_code][$j] = '';
			}
		}

		foreach ($priceTitleList as $key => $title) {
			$k = 0;
			foreach ($currencyTitle as $key => $val) {
				$states = Price::where('company_id', $val->company_id)->where('deleted', 'N')->where('from_country', $val->from_location)->get();

				foreach ($states as $key => $state) {
					$from_state = State::where('id', $state->from_state)->first()->state_code;
					$to_state   = State::where('id', $state->to_state)->first()->state_code;

					foreach ($pricingLists as $key => $ptl) {

						if (!isset($priceLists[$title->title_name][$val->getFromCountry->country_code][$from_state . ' - ' . $to_state])) {
							$priceLists[$title->title_name][$val->getFromCountry->country_code][$from_state . ' - ' . $to_state]['id']         = 0;
							$priceLists[$title->title_name][$val->getFromCountry->country_code][$from_state . ' - ' . $to_state]['unit_price'] = '';
						}

						if ($ptl->from_state == $state->from_state && $ptl->to_state == $state->to_state && $title->title_name == $ptl->title_name) {
							$priceLists[$title->title_name][$val->getFromCountry->country_code][$from_state . ' - ' . $to_state]['id']         = $ptl->id;
							$priceLists[$title->title_name][$val->getFromCountry->country_code][$from_state . ' - ' . $to_state]['unit_price'] = $ptl->unit_price;
						}

					}
				}

				if (!isset($priceLists[$title->title_name][$val->getFromCountry->country_code])) {
					$priceLists[$title->title_name][$val->getFromCountry->country_code] = array();
				}
				$k++;
			}
		}
		$totalCol += 2 + count($currencyTitle);

		$currentPage = LengthAwarePaginator::resolveCurrentPage();

		$col                      = new Collect($priceLists);
		$perPage                  = 10;
		$currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
		$priceLists               = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);

		$priceLists->setPath(url('prices'));
		$total       = $priceLists->total();
		$perPage     = $priceLists->perPage();
		$currentPage = $priceLists->currentPage();
		$lastPage    = $priceLists->lastPage();
		$lastItem    = $priceLists->lastItem();

		return view('prices.index', ['currencyTitle' => $currencyTitle, 'pricingLists' => $pricingLists, 'currencyTitleList' => $currencyTitleList, 'subTitleList' => $subTitleList, 'priceLists' => $priceLists, 'totalCol' => $totalCol, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		if (Auth::user()->hasRole('administrator')) {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('deleted', 'N')->lists('type', 'id');
		} else {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('type', 'id');
		}

		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		$stateIdList   = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
		}

		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('prices.create', ['categoryList' => $categoryList, 'currencyList' => $currencyList, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList]);
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
			'company_id'   => 'required',
			'category_id'  => 'required',
			'currency_id'  => 'required',
			'title_name'   => 'required',
			'unit_price'   => 'required|numeric',
			'from_country' => 'required',
			'from_state'   => 'required',
			'to_country'   => 'required',
			'to_state'     => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$titleData['company_id'] = $request->company_id;
		$titleData['title_name'] = $request->title_name;
		$titleData['created_by'] = Auth::user()->id;
		$title                   = PriceTitle::where('company_id', $request->company_id)->where('title_name', $request->title_name)->first();
		if (!$title) {
			$titleData['total_price'] = 1;
			$title                    = PriceTitle::create($titleData);
		} else {
			$title->update(['deleted', 'N']);
			$title->increment('total_price');
		}

		$price = Price::where('company_id', $request->company_id)->where('title_name', $request->title_name)
			->where('from_country', $request->from_country)->where('from_state', $request->from_state)
			->where('to_country', $request->to_country)->where('to_state', $request->to_state)
			->first();
		if (!$price) {
			$data['title_id'] = $title->id;
			$price            = Price::create($data);
		} else {
			$price->update($data);
		}

		return redirect()->route('prices.index')
			->with('success', 'Price created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$price = Price::find($id);

		if (Auth::user()->hasRole('administrator')) {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('deleted', 'N')->lists('type', 'id');
		} else {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('type', 'id');
		}

		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		$stateIdList   = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
		}

		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('prices.show', ['price' => $price, 'categoryList' => $categoryList, 'currencyList' => $currencyList, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$price = Price::find($id);

		if (Auth::user()->hasRole('administrator')) {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('deleted', 'N')->lists('type', 'id');
		} else {
			$categoryList = Category::where('deleted', 'N')->lists('name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('type', 'id');
		}

		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		$stateIdList   = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
		}

		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('prices.edit', ['price' => $price, 'categoryList' => $categoryList, 'currencyList' => $currencyList, 'companyList' => $companyList, 'countryList' => $countryList, 'stateList' => $stateList]);
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
			'company_id'   => 'required',
			'category_id'  => 'required',
			'currency_id'  => 'required',
			'title_name'   => 'required',
			'unit_price'   => 'required',
			'from_country' => 'required',
			'from_state'   => 'required',
			'to_country'   => 'required',
			'to_state'     => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$titleData['company_id'] = $request->company_id;
		$titleData['title_name'] = $request->title_name;
		$titleData['updated_by'] = Auth::user()->id;
		$title                   = PriceTitle::where('company_id', $request->company_id)->where('title_name', $request->title_name)->first();
		if (!$title) {
			$title->update(['deleted', 'N']);

			$title = PriceTitle::create($titleData);
		} else {
			$title->update($titleData);
		}

		$data['title_id']   = $title->id;
		$data['updated_by'] = Auth::user()->id;
		$price              = Price::find($id);
		$price->update($data);

		return redirect()->route('prices.index')
			->with('success', 'Price updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$price = Price::find($id);
		$price->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);

		$priceTitle = PriceTitle::find($price->title_id);

		if ($priceTitle->total_price == 0) {
			$priceTitle->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);
		} else {
			$priceTitle->decrement('total_price');
		}

		Session::flash('success', 'Price deleted successfully');
		$response = array('status' => 'success', 'url' => 'prices');
		return response()->json($response);
	}
}
