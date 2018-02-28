<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberOffer extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'member_offers';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'type',
		'rate',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
