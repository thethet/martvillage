<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'packings';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'outgoing_id',
		'packing_name',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
