<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	//
	//
	/*public function users()
	{
		return $this->hasMany('App\User');
	}

	public function permissions()
	{
		return $this->belongsToMany('App\Permission');
	}

	public function givePermissions(Permission $permission)
	{
		return $this->permissions()->save($permission);
	}*/
}
