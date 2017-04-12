<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserBlock extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_block';
	public $timestamps = false;

	protected $fillable = [ 
			'blockedtype',
			'blockeddays',
			'description',
			'user_id',
			'created_by',
			'created_dttm',
			'updated_by',
			'updated_dttm',
			'adminnote',
	];

	public static function unblocknotifyuser($userid){
		$sql =  "DELETE FROM user_block WHERE user_id='".$userid."' ";
		$data = DB::select ($sql);
		return $data;           
	}

}
