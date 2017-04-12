<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class TimeZoneCountry extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'time_zone_country';
	public $timestamps = false;

	protected $fillable = [ 
			'country_id',
			'time_zone'
	];

}
