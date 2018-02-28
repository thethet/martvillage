<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';
	// public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'tags_id',
		'post_name',
		'content',
		'post_img',
		'deleted',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
