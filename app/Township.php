<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'townships';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'state_id',
		'township_name',
		'description',
		'code',
		'deleted',
		'created_by',
		'updated_by',
	];
}
