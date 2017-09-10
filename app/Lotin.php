<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotin extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lotins';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'user_id',
		'sender_id',
		'receiver_id',
		'lot_no',
		'date',
		'time',
		'from_country',
		'from_state',
		'item_name',
		'barcode',
		'price_id',
		'category_id',
		'unit',
		'unit_price',
		'quantity',
		'amount',
		'member_discount',
		'member_discount_amt',
		'other_discount',
		'other_discount_amt',
		'gov_tax',
		'gov_tax_amt',
		'status',
		'deleted',
		'created_by',
		'updated_by',
	];
}
