<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class Modeling extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'modeling';
	public $timestamps = false;

	protected $fillable = [ 
			'user_id',
			'agenicies',
			'pageants',
			'fitting',
			'music_video',
			'print',
			'tvcommercial',
			'catwalk',
			'event_promotion',
			'hair_model',
			'presenters',
			'time_prints',
			'others',
			'website',
			'experience',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active'
	];

}
