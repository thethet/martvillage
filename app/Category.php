<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id',
		'name',
		'unit',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public function getCompany() {
		return $this->belongsTo('App\Company', 'company_id');
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
