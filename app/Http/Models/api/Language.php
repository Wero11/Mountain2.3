<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'language';
	public $timestamps = false;

	protected $fillable = [ 
			'user_id',
			'value',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active'
	];

}
