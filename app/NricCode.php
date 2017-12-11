<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NricCode extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'nric_codes';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nric_code',
		'description',
		'deleted',
		'created_by',
		'updated_by',
	];
}
