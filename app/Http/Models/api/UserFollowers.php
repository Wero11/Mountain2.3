<?php namespace App\Http\Models\api;



use Illuminate\Database\Eloquent\Model;

use DB;



class UserFollowers extends Model {



	/**

	 * The database table used by the model.

	 *

	 * @var string

	 */

	protected $table = 'user_followers';

	public $timestamps = false;



	protected $fillable = [ 

			'user_id',

			'follower_id',

			'description',

			'created_by',

			'updated_by',

			'created_dttm',

			'updated_dttm',

			'is_active'

	];





	public static function getFans($user_id){



		$data = DB::table('user_followers')

	            ->join('user', 'user.id', '=', 'user_followers.user_id')

	            ->join('user_image', 'user.id', '=', 'user_image.user_id','left')

	            ->where( 'user_followers.follower_id', $user_id)

	            ->where( 'user_followers.is_active', '1')

	            ->select('user.id as user_id','user.user_name','user.first_name','user.family_name','user_image.image_path as ProfileImage')

	            ->get();



	    return $data;        

	}



	public static function getIdols($user_id){



		$sql = "SELECT u.id as user_id,u.user_name,u.first_name,

						u.family_name,ui.image_path as ProfileImage,uf.created_dttm as idol_dttm

				FROM user_followers uf

				INNER JOIN user u ON u.id = uf.follower_id  AND u.is_active = 1  

				LEFT JOIN user_image ui ON u.id = ui.user_id 

				WHERE uf.user_id =$user_id aND uf.is_active = 1

				";

		$data = DB::select ($sql);

	    return $data;        

	}



	



	

}

