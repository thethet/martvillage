<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\NricCodes;
use Session;

class NricCodeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$codes = NricCodes::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
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
		return view('nric-codes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'nric_code' => 'required',
			'description'  => 'required',
		]);

		$data    = $request->all();
		$data['created_by'] = Auth::user()->id;
		NricCodes::create($data);

		return redirect()->route('nric-codes.index')
			->with('success', 'NRIC Code created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$code = NricCodes::find($id);
		return view('nric-codes.show', ['code' => $code]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$code = NricCodes::find($id);
		return view('nric-codes.edit', ['code' => $code]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'description'  => 'required',
		]);

		$code  = NricCodes::find($id);
		$data    = $request->all();
		$data['updated_by'] = Auth::user()->id;
		$code->update($data);

		return redirect()->route('nric-codes.index')
			->with('success', 'NRIC Code updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		NricCodes::find($id)->update(['deleted' => 'Y']);
		Session::flash('success', 'NRIC Code deleted successfully');
		$response = array('status' => 'success', 'url' => 'nric-codes');

		return response()->json($response);
	}
}
