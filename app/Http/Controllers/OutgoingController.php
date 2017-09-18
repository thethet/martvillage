<?php

namespace App\Http\Controllers;

use App\States;
use Auth;

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
	public function store() {
		//
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
