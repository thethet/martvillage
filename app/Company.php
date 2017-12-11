<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'companies';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_name',
		'short_code',
		'contact_no',
		'fax',
		'email',
		'logo',
		'unit_number',
		'building_name',
		'street',
		'country_id',
		'state_id',
		'township_id',
		'address',
		'location',
		'expiry_date',
		'return_period',
		'gst_rate',
		'service_rate',
		'deleted',
		'created_by',
		'updated_by',
	];

	public function country() {
		return $this->belongsToMany('App\Country', 'companies_countries', 'companies_id', 'countries_id');
	}

	// public function getCountryList() {
	// 	return $this->countries->lists('countries_id');
	// }

	public function state() {
		return $this->belongsToMany('App\State', 'companies_states', 'companies_id', 'states_id');
	}

	public function township() {
		return $this->belongsToMany('App\Township', 'companies_townships', 'companies_id', 'townships_id');
	}
}
