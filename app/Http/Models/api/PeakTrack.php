<?php namespace App\Http\Models\api;



use Illuminate\Database\Eloquent\Model;

use DB;

class PeakTrack extends Model {



	/**

	 * The database table used by the model.

	 *

	 * @var string

	 */

	protected $table = 'peak_track';

	public $timestamps = false;



	protected $fillable = [ 

			'feed_id',

			'user_id',

			'peak_id',

			'rank',

			'created_dttm'

	];

	

	public static function getUserPeaks($user_id){

		

		$sql = "SELECT 	m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,			

				u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,

				f.description as feed_description,f.video_name as feed_video,f.id as feed_id,f.created_dttm,pt.rank as Rank,

				mp.start_dttm as PeakStart,mp.end_dttm as PeakEnd,mp.peak_index,m.no_of_peaks,m.image_path,m.id as mountain_id 

				FROM peak_track pt

				LEFT JOIN feeds f ON f.id = pt.feed_id AND f.is_active = 1

				LEFT JOIN mountain_peak mp ON mp.id = pt.peak_id AND mp.is_active = 1

				LEFT JOIN mountain m ON m.id = mp.mountain_id 			

				LEFT JOIN user u ON u.id = pt.user_id AND u.is_active = 1

				LEFT JOIN user_image ui ON ui.user_id=u.id

				WHERe pt.user_id = $user_id

				ORDER BY pt.created_dttm DESC" ;

				  

		$data = DB::select ($sql );

		

		return $data;           		        

	}

}

