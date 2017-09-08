<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'receivers';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'sender_id',
		'name',
		'nric_no',
		'nric_code_id',
		'nric_township_id',
		'contact_no',
		'member_no',
		'state_id',
		'address',
		'deleted',
		'created_by',
		'updated_by',
	];

	public function senders() {
		return $this->belongsTo('App\Sender', 'sender_id');
	}
}
