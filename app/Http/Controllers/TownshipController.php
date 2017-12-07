<?php

namespace App\Http\Controllers;

use App\Companies;
use App\States;
use App\Townships;
use Auth;
use Illuminate\Http\Request;
use Session;

class TownshipController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$company     = Companies::find(Auth::user()->company_id);
		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}
		$townshipIds    = $company->states;
		$townshipIdList = array();
		foreach ($townshipIds as $townshipId) {
			$townshipIdList[] = $townshipId->id;
		}

		$states = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$townships   = Townships::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->paginate(10);
		$total       = $townships->total();
		$perPage     = $townships->perPage();
		$currentPage = $townships->currentPage();
		$lastPage    = $townships->lastPage();
		$lastItem    = $townships->lastItem();

		return view('townships.index', ['townships' => $townships, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'states' => $states])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$company     = Companies::find(Auth::user()->company_id);
		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}
		$states = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		return view('townships.create', ['states' => $states]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'state_id'      => 'required',
			'township_name' => 'required|unique:townships,township_name',
			'code'          => 'required|unique:townships,code',
			'description'   => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$township = Townships::create($data);

		$company = Companies::find(Auth::user()->company_id);
		$company->townships()->attach($township);

		// States::find($request->state_id)->increment('total_townships');

		return redirect()->route('townships.index')
			->with('success', 'Township created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$company     = Companies::find(Auth::user()->company_id);
		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}

		$states = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$township = Townships::find($id);

		return view('townships.show', ['states' => $states, 'township' => $township]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$company     = Companies::find(Auth::user()->company_id);
		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		}

		$states = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$township = Townships::find($id);

		return view('townships.edit', ['states' => $states, 'township' => $township]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'state_id'      => 'required',
			'township_name' => 'required',
			'code'          => 'required',
			'description'   => 'required',
		]);

		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;
		$township           = Townships::find($id);
		$township->update($data);

		// $company = Companies::find(Auth::user()->company_id);
		// $company->townships()->attach($township);

		return redirect()->route('townships.index')
			->with('success', 'Township updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$township = Townships::find($id);
		States::find($township->state_id)->decrement('total_townships');

		$township->update(['deleted' => 'Y']);

		Session::flash('success', 'Township deleted successfully');
		$response = array('status' => 'success', 'url' => 'townships');

		return response()->json($response);
	}
}
