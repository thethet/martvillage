<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'tag_name',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
