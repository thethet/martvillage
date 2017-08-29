<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'nationality';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'deleted',
		'created_by',
		'updated_by',
	];
}
