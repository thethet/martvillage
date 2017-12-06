<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Session;

class PermissionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$permissions = Permission::orderBy('id', 'DESC')->paginate(10);

		$total       = $permissions->total();
		$perPage     = $permissions->perPage();
		$currentPage = $permissions->currentPage();
		$lastPage    = $permissions->lastPage();
		$lastItem    = $permissions->lastItem();

		return view('permissions.index', ['permissions' => $permissions, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('permissions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'name'         => 'required|unique:permissions,name',
			'display_name' => 'required',
			'description'  => 'required',
		]);

		$permission               = new Permission();
		$permission->name         = $request->input('name');
		$permission->display_name = $request->input('display_name');
		$permission->description  = $request->input('description');
		$permission->save();

		return redirect()->route('permissions.index')
			->with('success', 'Permission created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$permission = Permission::find($id);

		return view('permissions.show', ['permission' => $permission]);
	}

	/**
	 * Redirect Route Using Ajax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editAjax($userId, Request $request) {
		$id       = $request->id;
		$response = array('status' => 'success', 'url' => 'permissions/' . $id . '/edit');
		return response()->json($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$permission = Permission::find($id);

		return view('permissions.edit', ['permission' => $permission]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'display_name' => 'required',
			'description'  => 'required',
		]);

		$permission               = Permission::find($id);
		$permission->display_name = $request->input('display_name');
		$permission->description  = $request->input('description');
		$permission->save();

		return redirect()->route('permissions.index')
			->with('success', 'Permission updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$permission = Permission::find($id);
		// $permission->delete();
		/*return redirect()->route('permissions.index')
		->with('success', 'Permission deleted successfully');*/
		Session::flash('success', 'Permission deleted successfully');
		$response = array('status' => 'success', 'url' => 'permissions');
		return response()->json($response);
	}
}
