<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sliders';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'slider_name',
		'slider_img',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
