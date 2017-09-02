<?php

namespace App\Http\Controllers;

use App\NricTownships;
use Illuminate\Http\Request;

class NricTownshipController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchByNricCode(Request $request) {
		$search     = $request->get('search');
		$nricCodeId = $request->get('nricCodeId');
		if ($nricCodeId) {
			$items = NricTownships::select(\DB::raw('id as id, short_name as text'))->where('nric_code_id', $nricCodeId)->where('short_name', 'like', "{$search}%")->get();
		} else {
			$items = NricTownships::select(\DB::raw('id as id, short_name as text'))->where('short_name', 'like', "{$search}%")->get();
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);
		return response()->json(['items' => $items], 200, $header, JSON_UNESCAPED_UNICODE);
	}
}
