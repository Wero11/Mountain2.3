<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'state';
	public $timestamps = false;

	protected $fillable = [ 
			'county_id',
			'name',
			'is_active'
	];

}
