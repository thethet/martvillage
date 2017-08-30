<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use DB;
use Illuminate\Http\Request;

class RoleController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$roles = Role::orderBy('id', 'DESC')->paginate(8);
		return view('roles.index', ['roles' => $roles])->with('i', ($request->get('page', 1) - 1) * 8);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$permission = Permission::get();
		return view('roles.create', ['permission' => $permission]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'name'         => 'required|unique:roles,name',
			'display_name' => 'required',
			'description'  => 'required',
			'permission'   => 'required',
		]);

		$role               = new Role();
		$role->name         = $request->input('name');
		$role->display_name = $request->input('display_name');
		$role->description  = $request->input('description');
		$role->save();

		foreach ($request->get('permission') as $key => $value) {
			$role->attachPermission($value);
		}

		return redirect()->route('roles.index')
			->with('success', 'Role created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$role            = Role::find($id);
		$rolePermissions = Permission::join("permission_role", "permission_role.permission_id", "=", "permissions.id")
			->where("permission_role.role_id", $id)
			->get();

		return view('roles.show', ['role' => $role, 'rolePermissions' => $rolePermissions]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$role            = Role::find($id);
		$permission      = Permission::get();
		$rolePermissions = DB::table("permission_role")->where("permission_role.role_id", $id)
			->lists('permission_role.permission_id', 'permission_role.permission_id');

		return view('roles.edit', ['role' => $role, 'permission' => $permission, 'rolePermissions' => $rolePermissions]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$this->validate($request, [
			'display_name' => 'required',
			'description'  => 'required',
			'permission'   => 'required',
		]);

		$role               = Role::find($id);
		$role->display_name = $request->input('display_name');
		$role->description  = $request->input('description');
		$role->save();

		DB::table("permission_role")->where("permission_role.role_id", $id)
			->delete();

		foreach ($request->input('permission') as $key => $value) {
			$role->attachPermission($value);
		}

		return redirect()->route('roles.index')
			->with('success', 'Role updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// DB::table("roles")->where('id', $id)->update(['deleted' => 'Y']);
		// return redirect()->route('roles.index')
		// 	->with('success', 'Role deleted successfully');
	}
}
