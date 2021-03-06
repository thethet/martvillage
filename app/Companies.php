<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model {
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
		'deleted',
		'created_by',
		'updated_by',
	];

	public function countries() {
		return $this->belongsToMany('App\Countries', 'companies_countries', 'companies_id', 'countries_id');
	}

	// public function getCountryList() {
	// 	return $this->countries->lists('countries_id');
	// }

	public function states() {
		return $this->belongsToMany('App\States', 'companies_states', 'companies_id', 'states_id');
	}

	public function townships() {
		return $this->belongsToMany('App\Townships', 'companies_townships', 'companies_id', 'townships_id');
	}
}
