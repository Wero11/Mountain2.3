<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;

class SocialMapping extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'social_mapping';
	public $timestamps = false;

	protected $fillable = [ 
			'user_id',
			'source_id',
			'source_type',
			'created_dttm',
			'is_active'
	];




	

}
