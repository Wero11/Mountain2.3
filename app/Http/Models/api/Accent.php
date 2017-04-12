<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class Accent extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'accent';
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
