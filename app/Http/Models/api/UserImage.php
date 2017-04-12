<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_image';
	public $timestamps = false;

	protected $fillable = [ 
			'user_id',
			'image_path',
			'description',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active'
	];

}
