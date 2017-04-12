<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class FeedTrendingTag extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feed_trending_tag';
	public $timestamps = false;

	protected $fillable = [ 
			'feed_id',
			'user_id',
			'hash_tag_id',
			'trending_dttm',
			'is_active'
	];

}
