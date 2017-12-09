<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\States;
use Auth;
use Illuminate\Http\Request;
use Session;

class StateController extends Controller {
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
		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}

		$countries = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		$query = States::whereIn('id', $stateIdList)->where('deleted', 'N');
		if ($request->country_id) {
			$states = $query->where('country_id', $request->country_id)->orderBy('state_name', 'ASC')->paginate(10);
		} else {
			$states = $query->orderBy('state_name', 'ASC')->paginate(10);
		}
		$total       = $states->total();
		$perPage     = $states->perPage();
		$currentPage = $states->currentPage();
		$lastPage    = $states->lastPage();
		$lastItem    = $states->lastItem();

		$allQuery = States::where('deleted', 'N');
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

		return view('states.index', ['states' => $states, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'countries' => $countries, 'allStates' => $allStates, 'allTotal' => $allTotal, 'allPerPage' => $allPerPage, 'allCurrentPage' => $allCurrentPage, 'allLastPage' => $allLastPage, 'allLastItem' => $allLastItem, 'countryIdList' => $countryIdList, 'stateIdList' => $stateIdList])->with('i', ($request->get('page', 1) - 1) * 10)->with('a', ($request->get('apage', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		return view('states.create', ['countries' => $countries]);
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

		$state = States::create($data);

		$company = Companies::find(Auth::user()->company_id);
		$company->states()->attach($state);

		Countries::find($request->country_id)->increment('total_cities');

		return redirect()->route('states.index')
			->with('success', 'State created successfully');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeByCompany($id) {
		$state = States::find($id);

		$company = Companies::find(Auth::user()->company_id);
		$company->states()->attach($state);

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
		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		$state = States::find($id);

		return view('states.show', ['countries' => $countries, 'state' => $state]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$company       = Companies::find(Auth::user()->company_id);
		$countryIds    = $company->countries;
		$countryIdList = array();
		foreach ($countryIds as $country) {
			$countryIdList[] = $country->id;
		}
		$countries = Countries::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

		$state = States::find($id);

		return view('states.edit', ['countries' => $countries, 'state' => $state]);
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
		$state              = States::find($id);
		$state->update($data);

		// $company = Companies::find(Auth::user()->company_id);
		// $company->states()->attach($state);

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
		$state = States::find($id);

		if ($state->total_township != 0) {
			Countries::find($state->country_id)->decrement('total_cities');
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
		$company = Companies::find(Auth::user()->company_id);
		$company->states()->detach($id);

		Session::flash('success', 'State deleted successfully');
		$response = array('status' => 'success', 'url' => 'states');

		return response()->json($response);
	}
}
