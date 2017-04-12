<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class FeedsView extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feeds_viewed';
	public $timestamps = false;

	protected $fillable = [ 
			'feed_id',
			'user_id',
			'viewed_dttm',
			'is_active'
	];

}
