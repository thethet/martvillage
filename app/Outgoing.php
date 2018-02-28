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
		'passenger_name',
		'carrier_name',
		'contact_no',
		'shipping_line',
		'vessel_no',
		'dept_date',
		'dept_time',
		'arrival_date',
		'arrival_time',
		'weight',
		'other_weight',
		'box',
		'from_country',
		'from_city',
		'to_country',
		'to_city',
		'packing_list',
		'packing_id_list',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public function LotIn() {
		return $this->belongsTo('App\Lotin', 'lotin_id');
	}

	public function getItems() {
		return $this->belongsTo('App\Item', 'item_id');
	}

	public function fromCountry() {
		return $this->belongsTo('App\Country', 'from_country');
	}

	public function fromCity() {
		return $this->belongsTo('App\State', 'from_city');
	}

	public function toCountry() {
		return $this->belongsTo('App\Country', 'to_country');
	}

	public function toCity() {
		return $this->belongsTo('App\State', 'to_city');
	}
}
