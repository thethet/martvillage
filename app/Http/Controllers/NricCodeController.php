<?php

namespace App\Http\Controllers;

use App\NricCode;
use Auth;
use Illuminate\Http\Request;
use Session;

class NricCodeController extends Controller {
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

		$codes       = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->paginate(10);
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
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$this->validate($request, [
			'nric_code'   => 'required',
			'description' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;
		NricCode::create($data);

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
		$code = NricCode::find($id);
		return view('nric-codes.show', ['code' => $code]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$code = NricCode::find($id);
		return view('nric-codes.edit', ['code' => $code]);
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
			'description' => 'required',
		]);

		$code               = NricCode::find($id);
		$data               = $request->all();
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
		NricCode::find($id)->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);
		Session::flash('success', 'NRIC Code deleted successfully');
		$response = array('status' => 'success', 'url' => 'nric-codes');

		return response()->json($response);
	}
}
