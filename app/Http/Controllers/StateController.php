<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\State;
use App\Township;
use Auth;
use Illuminate\Http\Request;
use Session;

class StateController extends Controller {
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
		$myCompany      = Company::find(Auth::user()->company_id);
		$countryIdList  = array();
		$stateIdList    = array();
		$townshipIdList = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}

			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}

			$townshipIds = $myCompany->township;
			foreach ($townshipIds as $townshipId) {
				$townshipIdList[] = $townshipId->id;
			}

		}
		$countryList   = Country::orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$myCountryList = Country::whereIn('id', $countryIdList)->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		$query = State::whereIn('id', $stateIdList)->where('deleted', 'N');
		if ($request->country_id) {
			$states = $query->where('country_id', $request->country_id)->orderBy('state_name', 'ASC')->paginate(10);
		} else {
			$states = $query->orderBy('state_name', 'ASC')->paginate(10);
		}

		$twnCountList = array();
		foreach ($states as $state) {
			$twnCount                 = Township::whereIn('id', $townshipIdList)->where('state_id', $state->id)->groupBy('state_id')->count();
			$twnCountList[$state->id] = $twnCount;
		}

		$total       = $states->total();
		$perPage     = $states->perPage();
		$currentPage = $states->currentPage();
		$lastPage    = $states->lastPage();
		$lastItem    = $states->lastItem();

		$allQuery = State::where('deleted', 'N');
		if (!Auth::user()->hasRole('administrator')) {
			$allQuery = $allQuery->whereIn('country_id', $countryIdList);
		}

		if ($request->all_country_id) {
			$allStates = $allQuery->where('country_id', $request->all_country_id)->orderBy('state_name', 'ASC')->paginate(10, ['*'], 'apage');
		} else {
			$allStates = $allQuery->orderBy('state_name', 'ASC')->paginate(10, ['*'], 'apage');
		}

		$allTotal       = $allStates->total();
		$allPerPage     = $allStates->perPage();
		$allCurrentPage = $allStates->currentPage();
		$allLastPage    = $allStates->lastPage();
		$allLastItem    = $allStates->lastItem();

		return view('states.index', ['states' => $states, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'countryList' => $countryList, 'myCountryList' => $myCountryList, 'allStates' => $allStates, 'allTotal' => $allTotal, 'allPerPage' => $allPerPage, 'allCurrentPage' => $allCurrentPage, 'allLastPage' => $allLastPage, 'allLastItem' => $allLastItem, 'countryIdList' => $countryIdList, 'stateIdList' => $stateIdList, 'twnCountList' => $twnCountList])->with('i', ($request->get('page', 1) - 1) * 10)->with('a', ($request->get('apage', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
		}
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		return view('states.create', ['countryList' => $countryList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'country_id'  => 'required',
			'state_name'  => 'required|unique:states,state_name',
			'state_code'  => 'required|unique:states,state_code',
			'description' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$state = State::create($data);

		$myCompany = Company::find(Auth::user()->company_id);
		$myCompany->state()->attach($state);

		Country::find($request->country_id)->increment('total_cities');

		return redirect()->route('states.index')
			->with('success', 'State created successfully');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeByCompany($id) {
		$state = State::find($id);

		$myCompany = Company::find(Auth::user()->company_id);
		$myCompany->state()->attach($state);

		return redirect()->route('states.index')
			->with('success', 'State created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
		}
		$countryList = Country::whereIn('id', $countryIdList)->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		$state = State::find($id);

		return view('states.show', ['countryList' => $countryList, 'state' => $state]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
		}
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		$state = State::find($id);

		return view('states.edit', ['countryList' => $countryList, 'state' => $state]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'country_id'  => 'required',
			'state_name'  => 'required',
			'state_code'  => 'required',
			'description' => 'required',
		]);

		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;
		$state              = State::find($id);
		$state->update($data);

		// $myCompany = Company::find(Auth::user()->company_id);
		// $myCompany->state()->attach($state);

		return redirect()->route('states.index')
			->with('success', 'State updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$state = State::find($id);

		if ($state->total_township == 0) {
			Country::find($state->country_id)->decrement('total_cities');
			$state->update(['deleted' => 'Y']);
			Session::flash('success', 'State deleted successfully');
			$response = array('status' => 'success', 'url' => 'states');
		} else {
			Session::flash('unsuccess', 'State deleted unsuccessfully');
			$response = array('status' => 'success', 'url' => 'states');
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
		$myCompany = Company::find(Auth::user()->company_id);
		$myCompany->state()->detach($id);

		Session::flash('success', 'State deleted successfully');
		$response = array('status' => 'success', 'url' => 'states');

		return response()->json($response);
	}
}
