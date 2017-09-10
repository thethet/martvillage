<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'companies';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_name',
		'short_code',
		'contact_no',
		'fax',
		'email',
		'logo',
		'unit_number',
		'building_name',
		'street',
		'country_id',
		'state_id',
		'township_id',
		'address',
		'location',
		'expiry_date',
		'deleted',
		'created_by',
		'updated_by',
	];
}
