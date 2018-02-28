<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'lotin_id',
		'outgoing_id',
		'packing_id',
		'item_name',
		'barcode',
		'price_id',
		'category_id',
		'currency_id',
		'unit',
		'unit_price',
		'quantity',
		'amount',
		'status',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
		'deleted_by',
	];

	public function LotIn() {
		return $this->belongsTo('App\Lotin', 'lotin_id');
	}
}
