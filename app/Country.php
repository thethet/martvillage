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
	];

	public function companies() {
		return $this->belongsToMany('App\Company');
	}
}
