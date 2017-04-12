<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;
class Feeds extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feeds';
	public $timestamps = false;

	protected $fillable = [ 
			'mountain_id',
			'user_id',
			'peak_id',
			'country_id',
			'description',
			'video_name',
			'is_reposted',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active',
			'is_overwrite'
	];


	public static function getUserFeeds($user_id,$start,$end){
		
		$sql = "SELECT sum(fd.feed_count) as Count, m.id as mountain_id,m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
			  	u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,u.phone_number,u.website,
			  	f.description as feed_description,f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm,mp.peak_index
			  	FROM mountain m 
				INNER JOIN mountain_peak mp ON m.id = mp.mountain_id 
				INNER JOIN feeds f ON f.peak_id = mp.id 
				LEFT JOIN ( SELECT count(*) feed_count , feed_id from feeds_like fl GROUP BY feed_id
				            UNION 
				            SELECT count(*) feed_count, feed_id from feeds_viewed fv GROUP BY feed_id )  fd ON fd.feed_id = f.id
				INNER JOIN  user u ON u.id = f.user_id
			  	LEFT JOIN   user_image ui ON ui.user_id=u.id
				WHERE f.is_active = 1 AND f.user_id=$user_id 
			  	GROUP BY f.id ORDER BY Count DESC LIMIT $start,$end";

		$data = DB::select ( $sql );		
		return $data;		
	}

	public static function getFeed($feed_id){

		$sql = "SELECT REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
						f.description as feed_description,f.video_name as feed_video,
						f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm,ui.image_path as ProfileImage,
					   u.first_name,u.family_name,u.user_name,mp.peak_index,f.user_id
				FROM feeds f
				LEFT JOIN mountain_peak mp ON mp.id = f.peak_id
				LEFT JOIN mountain m ON m.id = mp.mountain_id
				LEFT JOIN  user u ON u.id = f.user_id 
			  	LEFT JOIN user_image ui ON ui.user_id=u.id
				WHERE f.id='".$feed_id."' AND f.is_active = 1";
		$data = DB::select ( $sql );		
		return $data;		
	}

    public static function getUserFeedsWithAbused($user_id,$start,$end){

		$sql = "SELECT f.id as feed_id,f.peak_id,mp.mountain_id,m.name as mountain_name,m.hash_tag as mountain_hash,
					   f.user_id,f.description,f.video_name as feed_video,ui.image_path as ProfileImage,
					   u.first_name,u.family_name,u.last_name
				FROM feeds f
				LEFT JOIN mountain_peak mp ON mp.id = f.peak_id
				LEFT JOIN mountain m ON m.id = mp.mountain_id
				LEFT JOIN  user u ON u.id = f.user_id 
			  	LEFT JOIN user_image ui ON ui.user_id=u.id 

				WHERE f.user_id='".$user_id."' AND f.is_active = 1 ORDER BY f.updated_dttm DESC LIMIT $start,$end";
		$data = DB::select ( $sql );		
		return $data;		
	}


	public static function getUploadStatus($user_id,$mountain_id){

		$sql = "SELECT mp.id as peak_id,f.id as id,m.country_id
				FROM mountain m
				INNER JOIN mountain_peak mp ON mp.mountain_id = m.id AND mp.is_finished = 0 AND mp.is_active = 1
				LEFT JOIN feeds f ON f.peak_id = mp.id AND f.is_active = 1
				WHERE m.id = $mountain_id AND f.user_id=$user_id ";
		
		$data = DB::select ( $sql );		
		if($data)
			return $data[0];
		else
			return FALSE;
		
	}



}
