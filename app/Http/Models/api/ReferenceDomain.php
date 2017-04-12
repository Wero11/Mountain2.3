<?php namespace App\Http\Models\api;



use Illuminate\Database\Eloquent\Model;

use DB;

class ReferenceDomain extends Model {



	/**

	 * The database table used by the model.

	 *

	 * @var string

	 */

	protected $table = 'reference_domain';

	public $timestamps = false;



	protected $fillable = [ 

			'code',

			'created_by',

			'updated_by',

			'created_dttm',

			'updated_dttm',

			'is_active'

	];





	public static function getReferenceValuesByCode($code){

	  $SQL = " SELECT rv.id,rv.value FROM reference_domain rd 
	  		   INNER JOIN reference_value rv ON rv.reference_id = rd.id
	           WHERE rd.code ='". $code. "' AND rv.is_active = 1 ORDER BY rv.id ASC";

	  $data = DB::select($SQL);
	  return $data;
	}





}

