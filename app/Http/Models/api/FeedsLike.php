<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class FeedsLike extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feeds_like';
	public $timestamps = false;

	protected $fillable = [ 
			'feed_id',
			'user_id',
			'like_dttm',
			'is_active'
	];

}
