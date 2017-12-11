<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'currencies';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'type',
		'from_location',
		'deleted',
		'created_by',
		'updated_by',
	];

	public function location() {
		return $this->belongsTo('App\Country', 'from_location');
	}
}
