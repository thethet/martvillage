<?php

namespace App\Http\Controllers;

use App\Outgoing;
use App\States;
use Auth;
use Illuminate\Http\Request;

class OutgoingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		if (Auth::user()->hasRole('administrator')) {
			$stateList = States::where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		} else {
			$stateList = States::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		}

		return view('outgoings.index', ['stateList' => $stateList]);
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
	public function store(Request $request) {
		$this->validate($request, [
			'passenger_name' => 'required',
			'contact_no'     => 'required',
			'dept_date'      => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'from_city'      => 'required',
			'to_city'        => 'required',
			'weight'         => 'required',
			// 'other'          => 'required',
			'carrier'        => 'required',
			// 'vessel_no'      => 'required',
			'time'           => 'required',
		]);
		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$outgoing = Outgoing::create($data);

		return redirect()->route('outgoings.index')
			->with('success', 'Passenger created successfully');
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
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
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
