<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NricTownship extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'nric_townships';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nric_code_id',
		'township',
		'short_name',
		'serial_no',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
