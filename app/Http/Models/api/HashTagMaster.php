<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class HashTagMaster extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'hash_tag_master';
	public $timestamps = false;

	protected $fillable = [ 
			'feed_id',
			'hash_tag',
			'created_dttm',
			'is_active'
	];

}
