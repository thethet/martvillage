<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model {
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
		'item_name',
		'barcode',
		'price_id',
		'category_id',
		'unit',
		'unit_price',
		'quantity',
		'amount',
		'deleted',
		'created_by',
		'updated_by',
	];

	public function LotIn() {
		return $this->belongsTo('App\Lotin', 'lotin_id');
	}
}
