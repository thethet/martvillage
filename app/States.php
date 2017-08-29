<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'states';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'country_id',
		'state_name',
		'description',
		'code',
		'deleted',
		'created_by',
		'updated_by',
	];
}
