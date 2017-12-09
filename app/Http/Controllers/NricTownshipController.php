<?php

namespace App\Http\Controllers;

use App\NricCodes;
use App\NricTownships;
use Auth;
use Illuminate\Http\Request;
use Session;

class NricTownshipController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$query = NricTownships::where('deleted', 'N');

		if ($request->nric_code_id) {
			$townships = $query->where('nric_code_id', $request->nric_code_id)->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->paginate(10);
		} else {
			$townships = $query->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->paginate(10);
		}
		$total       = $townships->total();
		$perPage     = $townships->perPage();
		$currentPage = $townships->currentPage();
		$lastPage    = $townships->lastPage();
		$lastItem    = $townships->lastItem();

		$nricCodes = NricCodes::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('description', 'nric_code');

		return view('nric-townships.index', ['townships' => $townships, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'nricCodes' => $nricCodes])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$nricCodes = NricCodes::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'nric_code');

		return view('nric-townships.create', ['nricCodes' => $nricCodes]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'nric_code_id' => 'required',
			'township'     => 'required',
			'short_name'   => 'required',
			'serial_no'    => 'required|integer',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		NricTownships::create($data);

		return redirect()->route('nric-townships.index')
			->with('success', 'NRIC Township created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$nricCodes = NricCodes::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'nric_code');

		$nricTownship = NricTownships::find($id);
		return view('nric-townships.show', ['nricTownship' => $nricTownship, 'nricCodes' => $nricCodes]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$nricCodes = NricCodes::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'nric_code');

		$nricTownship = NricTownships::find($id);
		return view('nric-townships.edit', ['nricTownship' => $nricTownship, 'nricCodes' => $nricCodes]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'nric_code_id' => 'required',
			'township'     => 'required',
			'short_name'   => 'required',
			'serial_no'    => 'required|integer',
		]);

		$nricTownship       = NricTownships::find($id);
		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;
		$nricTownship->update($data);

		return redirect()->route('nric-townships.index')
			->with('success', 'NRIC Township updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		NricTownships::find($id)->update(['deleted' => 'Y']);
		Session::flash('success', 'NRIC Township deleted successfully');
		$response = array('status' => 'success', 'url' => 'nric-townships');

		return response()->json($response);
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
			$items = NricTownships::select(\DB::raw('id as id, short_name as text'))->where('nric_code_id', $nricCodeId)->where('short_name', 'like', "{$search}%")->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->get();
		} else {
			$items = NricTownships::select(\DB::raw('id as id, short_name as text'))->where('short_name', 'like', "{$search}%")->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->get();
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);
		return response()->json(['items' => $items], 200, $header, JSON_UNESCAPED_UNICODE);
	}
}
