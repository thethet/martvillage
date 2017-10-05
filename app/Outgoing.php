<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'outgoings';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'lotin_id',
		'item_id',
		'passenger_name',
		'carrier_name',
		'contact_no',
		'shipping_line',
		'vessel_no',
		'dept_date',
		'time',
		'weight',
		'other_weight',
		'box',
		'from_country',
		'from_city',
		'to_country',
		'to_city',
		'packing_list',
		'deleted',
		'created_by',
		'updated_by',
	];
}
