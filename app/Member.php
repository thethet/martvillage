<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';
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
		'member_no',
		'email',
		'unit_number',
		'building_name',
		'street',
		'country_id',
		'state_id',
		'township_id',
		'address',
		'deleted',
		'created_by',
		'updated_by',
	];
}
