<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'name',
		'unit',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
