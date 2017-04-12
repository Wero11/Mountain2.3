<?php namespace App\Http\Models\api;



use Illuminate\Database\Eloquent\Model;

use DB;


class ReferenceValue extends Model {



	/**

	 * The database table used by the model.

	 *

	 * @var string

	 */

	protected $table = 'reference_value';

	public $timestamps = false;



	protected $fillable = [ 

			'reference_id',

			'value',

			'code',

			'created_by',

			'updated_by',

			'created_dttm',

			'updated_dttm',

			'is_active'

	];


	public static function getReferenceValue($reference_id,$value){

	  $SQL = " SELECT * 
	  		   FROM reference_value rv 
	           WHERE rv.reference_id =$reference_id AND rv.value = '". $value. "' AND rv.is_active = 1 ";

	  $data = DB::select($SQL);
	  return $data;
	}

}

