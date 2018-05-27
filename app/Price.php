<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'prices';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'category_id',
		'currency_id',
		'title_id',
		'title_name',
		'from_country',
		'from_state',
		'to_country',
		'to_state',
		'unit_price',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public function getCreatedUser() {
		return $this->belongsTo('App\User', 'created_by');
	}

	public function getUpdatedUser() {
		return $this->belongsTo('App\User', 'updated_by');
	}

	public function getDeletedUser() {
		return $this->belongsTo('App\User', 'deleted_by');
	}

	public function getCompany() {
		return $this->belongsTo('App\Company', 'company_id');
	}

	public function getCategory() {
		return $this->belongsTo('App\Category', 'category_id');
	}

	public function getCurrency() {
		return $this->belongsTo('App\Currency', 'currency_id');
	}

	public function Title() {
		return $this->belongsTo('App\PriceTitle', 'title_id');
	}

	public function fromCountry() {
		return $this->belongsTo('App\Country', 'from_country');
	}

	public function fromState() {
		return $this->belongsTo('App\State', 'from_state');
	}

	public function toCountry() {
		return $this->belongsTo('App\Country', 'to_country');
	}

	public function toState() {
		return $this->belongsTo('App\State', 'to_state');
	}
}
