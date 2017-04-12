<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'judge';
	public $timestamps = false;

	protected $fillable = [ 
			'first_name',
			'last_name',
			'profession',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active'
	];

}
