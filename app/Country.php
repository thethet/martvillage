<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'countries';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'country_name',
		'description',
		'country_code',
		'total_cities',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public function companies() {
		return $this->belongsToMany('App\Company');
	}

	public function getCreatedUser() {
		return $this->belongsTo('App\User', 'created_by');
	}

	public function getUpdatedUser() {
		return $this->belongsTo('App\User', 'updated_by');
	}

	public function getDeletedUser() {
		return $this->belongsTo('App\User', 'deleted_by');
	}
}
