<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$permissions = Permission::orderBy('id', 'DESC')->paginate(8);
		return view('permissions.index', ['permissions' => $permissions])->with('i', ($request->get('page', 1) - 1) * 8);
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
	public function store() {
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
