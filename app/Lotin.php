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
		'outgoing_id',
		'lot_no',
		'date',
		'time',
		'outgoing_date',
		'outgoing_arr_date',
		'incoming_date',
		'collected_date',
		'from_country',
		'from_state',
		'to_country',
		'to_state',
		'member_discount',
		'member_discount_amt',
		'other_discount_type',
		'other_discount',
		'other_discount_amt',
		'gov_tax',
		'gov_tax_amt',
		'service_charge',
		'service_charge_amt',
		'total_amt',
		'net_amt',
		'payment',
		'total_items',
		'remarks',
		'status',
		'deleted',
		'created_by',
		'updated_by',
	];

	public function fromCountry() {
		return $this->belongsTo('App\Country', 'from_country');
	}

	public function fromCity() {
		return $this->belongsTo('App\State', 'from_state');
	}

	public function toCountry() {
		return $this->belongsTo('App\Country', 'to_country');
	}

	public function toCity() {
		return $this->belongsTo('App\State', 'to_state');
	}
}
