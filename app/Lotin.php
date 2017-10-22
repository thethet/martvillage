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
		'to_country',
		'to_state',
		'member_discount',
		'member_discount_amt',
		'other_discount',
		'other_discount_amt',
		'gov_tax',
		'gov_tax_amt',
		'service_charge',
		'service_charge_amt',
		'total_amt',
		'payment',
		'total_items',
		'status',
		'deleted',
		'created_by',
		'updated_by',
	];

	public function fromCountry() {
		return $this->belongsTo('App\Countries', 'from_country');
	}

	public function fromCity() {
		return $this->belongsTo('App\States', 'from_state');
	}

	public function toCountry() {
		return $this->belongsTo('App\Countries', 'to_country');
	}

	public function toCity() {
		return $this->belongsTo('App\States', 'to_state');
	}
}
