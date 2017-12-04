<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\NricCodes;

class NricCodeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		if (Auth::user()->hasRole('administrator')) {
			$codes = NricCodes::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$codes = NricCodes::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		}
		$total       = $codes->total();
		$perPage     = $codes->perPage();
		$currentPage = $codes->currentPage();
		$lastPage    = $codes->lastPage();
		$lastItem    = $codes->lastItem();

		return view('nric-codes.index', ['codes' => $codes, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('i', ($request->get('page', 1) - 1) * 10);
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
