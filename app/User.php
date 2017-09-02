<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {
	use EntrustUserTrait; // add this trait to your user model

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'name',
		'dob',
		'nric_no',
		'nric_code_id',
		'nric_township_id',
		'gender',
		'marital_status',
		'contact_no',
		'position',
		'nationality',
		'email',
		'username',
		'password',
		'unit_number',
		'building_name',
		'street',
		'country_id',
		'state_id',
		'township_id',
		'address',
		'photo',
		'deleted',
		'created_by',
		'updated_by',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function roles() {
		return $this->belongsToMany('App\Role');
	}

	public function company() {
		return $this->belongsTo('App\Companies', 'company_id');
	}
}
