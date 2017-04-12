<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;

class Country extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'country';
	public $timestamps = false;

	protected $fillable = [ 
			'code',
			'name',
			'time_zone',
			'is_active'
	];

	/**
	 * Create By Karthiga
	 *
	 * Created Date : 19 October 2015
	 *
	 * To Get User Country
	 *
	 * @return Response
	 */


	public static function getUserCountryId($user_id){

		$data =  DB::table('user')
                    ->join('country', 'user.country', '=', 'country.id')
                    ->select('country.id')
                    ->where('user.id', $user_id)
                    ->first();

		return $data->id; 
	}
}
