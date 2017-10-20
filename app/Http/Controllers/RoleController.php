<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$roles = Role::orderBy('id', 'DESC')->paginate(10);

		foreach($roles as $role) {
			$roleUser = DB::table('role_user')->select( DB::raw('count(user_id) as users_count'))->where('role_id', $role->id)->first();
			$role->users_count = $roleUser->users_count;
		}

		return view('roles.index', ['roles' => $roles])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::user()->hasRole('administrator')) {
			$permission = Permission::get();
		} else {
			$permission = Permission::whereNotIn('id', [5, 6, 7, 8])->get();
		}
		return view('roles.create', ['permission' => $permission]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'         => 'required|unique:roles,name',
			'display_name' => 'required',
			'description'  => 'required',
			'permission'   => 'required',
		]);

		$role               = new Role();
		$role->company_id   = $request->input('company_id');
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
	public function show($id)
	{
		$role            = Role::find($id);
		$rolePermissions = Permission::join("permission_role", "permission_role.permission_id", "=", "permissions.id")
			->where("permission_role.role_id", $id)
			->get();

		return view('roles.show', ['role' => $role, 'rolePermissions' => $rolePermissions]);
	}

	/**
	 * Redirect Route Using Ajax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editAjax($userId, Request $request)
	{
		$id       = $request->id;
		$response = array('status' => 'success', 'url' => 'roles/' . $id . '/edit');
		return response()->json($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);

		if (Auth::user()->hasRole('administrator')) {
			$permission = Permission::get();
		} else {
			$permission = Permission::whereNotIn('id', [5, 6, 7, 8])->get();
		}
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
	public function update($id, Request $request)
	{
		$this->validate($request, [
			'display_name' => 'required',
			'description'  => 'required',
			'permission'   => 'required',
		]);

		$role               = Role::find($id);
		$role->company_id   = $request->input('company_id');
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
	public function destroy($id)
	{
		DB::table('roles')->where('id', $id)->delete();

		DB::table('permission_role')->where('role_id', $id)->delete();
		// foreach ($permissions as $permission) {
		// 	// $role->detachPermission($permission);
		// 	// $role->detachPermission($permission);
		// }

		// $role->delete();


		// return redirect()->route('roles.index')
		//     ->with('success', 'Role deleted successfully');
		Session::flash('success', 'Role deleted successfully');
		$response = array('status' => 'success', 'url' => 'roles');
		return response()->json($response);
	}
}
