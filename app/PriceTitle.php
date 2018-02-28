<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceTitle extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'price_titles';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'title_name',
		'total_price',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
