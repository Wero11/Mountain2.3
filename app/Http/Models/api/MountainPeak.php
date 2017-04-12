<?php namespace App\Http\Models\api;



use Illuminate\Database\Eloquent\Model;

use DB;

class MountainPeak extends Model {



	/**

	 * The database table used by the model.

	 *

	 * @var string

	 */

	protected $table = 'mountain_peak';

	public $timestamps = false;



	protected $fillable = [ 

			'mountain_id',

			'peak_index',

			'is_finished',

			'start_dttm',

			'end_dttm',

			'created_by',

			'is_active'

	];

	

	public static function getPeakWeek($mountain_id){



		$sql = "SELECT m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,

				GROUP_CONCAT(hm.hash_tag SEPARATOR ', ') as feed_hash,

				u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,

				f.description as feed_description,f.video_name as feed_video,f.id as feed_id,f.created_dttm,mp.peak_index

				FROM mountain m

				LEFT JOIN  mountain_peak mp ON mp.mountain_id = m.id AND m.id = $mountain_id

				LEFT JOIN  feeds f ON f.peak_id = mp.id AND f.is_active = 1

				INNER JOIN  user u ON u.id = f.user_id AND u.is_active = 1

				LEFT JOIN user_image ui ON ui.user_id=u.id

				LEFT JOIN hash_tag_master hm ON f.id = hm.feed_id  AND hm.is_active = 1

				WHERE (mp.start_dttm <= NOW() AND mp.end_dttm >= NOW())			

				AND m.is_active = 2

				GROUP BY hm.feed_id,mp.id

				ORDER BY f.created_dttm" ;

							  

		$data = DB::select ($sql);



		return $data;           

	}





	



}

