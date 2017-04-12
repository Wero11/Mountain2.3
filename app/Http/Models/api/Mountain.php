<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;
class Mountain extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mountain';
	public $timestamps = false;

	protected $fillable = [ 
			'name',
			'url',
			'description',
			'image_path',
			'peak_duration',
			'is_main',
			'no_of_peaks',
			'hash_tag',
			'zone_id',
			'window_description',
			'country_id',
			'start_date',
			'end_date',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active'
	];


	public static function getLocalMountainList($mountain_id,$start='',$end='',$user_country_id){

		$limit = '';					
		if($end)
			$limit = " LIMIT $start,$end";     

		$sql = "SELECT sum(fd.feed_count) as Count, m.id as mountain_id,m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
			  	u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,u.phone_number,u.website,
			  	f.description as feed_description,f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm
			  	FROM mountain m 
				INNER JOIN mountain_peak mp ON m.id = mp.mountain_id AND mp.is_finished = 0
				INNER JOIN feeds f ON f.peak_id = mp.id 
				LEFT JOIN (
							SELECT count(*) feed_count , feed_id from feeds_like fl WHERE fl.is_active = 1 GROUP BY feed_id
				            UNION ALL
				            SELECT count(*) feed_count, feed_id from feeds_viewed fv WHERE fv.is_active = 1 GROUP BY feed_id  )  fd 
				ON fd.feed_id = f.id
				INNER JOIN  user u ON u.id = f.user_id  AND u.is_active = 1
			  	LEFT JOIN   user_image ui ON ui.user_id=u.id
				WHERE f.is_active = 1 AND mp.is_finished = 0 AND f.country_id = $user_country_id 
			  	AND m.is_main = 1  AND m.id = $mountain_id AND m.is_active = 2
			  	GROUP BY f.id ORDER BY Count DESC $limit";
		
		$data = DB::select ( $sql );
		
		return $data;           
	}

	public static function getGlobalMountainList($start='',$end='',$country_id){

		$limit = '';
		$country = '';
		if($end)
			$limit = " LIMIT $start,$end";

		if($country_id)
			$country = " AND f.country_id = $country_id ";


		$sql = "SELECT sum(fd.feed_count) as Count,fd.feed_id as uid, m.id as mountain_id,m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
			  	u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,u.phone_number,u.website,
			  	f.description as feed_description,f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm
			  	FROM mountain m 
				INNER JOIN mountain_peak mp ON m.id = mp.mountain_id AND mp.is_finished = 0
				INNER JOIN feeds f ON f.peak_id = mp.id 
				LEFT JOIN (
							SELECT count(*) feed_count , feed_id from feeds_like fl WHERE fl.is_active = 1 GROUP BY feed_id
				            UNION ALL
				            SELECT count(*) feed_count, feed_id from feeds_viewed fv WHERE fv.is_active = 1 GROUP BY feed_id )  fd 
				ON fd.feed_id = f.id
				INNER JOIN  user u ON u.id = f.user_id  AND u.is_active = 1
			  	LEFT JOIN   user_image ui ON ui.user_id=u.id
				WHERE f.is_active = 1 AND mp.is_finished = 0 
			  	AND m.is_main = 1  $country AND m.is_active = 2
			  	GROUP BY f.id ORDER BY Count DESC $limit";
	
		$data = DB::select ( $sql );

		return $data;           
	}


	public static function getCommercialMountainList($mountain_id,$start='',$end=''){

		$limit = '';
		if($end)
			$limit = " LIMIT $start,$end";

		$sql = "SELECT sum(fd.feed_count) as Count, m.id as mountain_id,m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
			  	u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,u.phone_number,u.website,
			  	f.description as feed_description,f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm
			  	FROM mountain m 
				INNER JOIN mountain_peak mp ON m.id = mp.mountain_id AND mp.is_finished = 0
				INNER JOIN feeds f ON f.peak_id = mp.id 
				LEFT JOIN (
							SELECT count(*) feed_count , feed_id from feeds_like fl WHERE fl.is_active = 1 GROUP BY feed_id
				            UNION ALL
				            SELECT count(*) feed_count, feed_id from feeds_viewed fv WHERE fv.is_active = 1 GROUP BY feed_id  )  fd 
				ON fd.feed_id = f.id
				INNER JOIN  user u ON u.id = f.user_id  AND u.is_active = 1
			  	LEFT JOIN   user_image ui ON ui.user_id=u.id
				WHERE f.is_active = 1 AND mp.is_finished = 0
			  	AND m.is_main = 0  AND m.id = $mountain_id 
			  	GROUP BY f.id ORDER BY Count DESC $limit";			  
										  
		$data = DB::select ( $sql );

		return $data;           
	}

	public static function getIdolsFeedList($start='',$end='',$user_id,$mountain_id){
	
		$limit = '';

		if($end)
			$limit = " LIMIT $start,$end";

		$sql = "SELECT sum(fd.feed_count) as Count, m.id as mountain_id,m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
			  	u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,u.phone_number,u.website,
			  	f.description as feed_description,f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm
			  	FROM mountain m 
				INNER JOIN mountain_peak mp ON m.id = mp.mountain_id AND mp.is_finished = 0
				INNER JOIN feeds f ON f.peak_id = mp.id 
				LEFT JOIN (
							SELECT count(*) feed_count , feed_id from feeds_like fl WHERE fl.is_active = 1 GROUP BY feed_id
				            UNION ALL
				            SELECT count(*) feed_count, feed_id from feeds_viewed fv WHERE fv.is_active = 1 GROUP BY feed_id  )  fd 
				ON fd.feed_id = f.id
				INNER JOIN  user_followers uf ON uf.follower_id=f.user_id and uf.is_active = 1  
				INNER JOIN  user u ON u.id = uf.follower_id  AND u.is_active = 1
			  	LEFT JOIN   user_image ui ON ui.user_id=u.id
				WHERE f.is_active = 1 AND  m.id IN($mountain_id) AND m.is_active = 2
				AND uf.user_id = $user_id				 
			  	GROUP BY f.id ORDER BY Count DESC $limit";	
		
		$data = DB::select ( $sql );
	
		return $data;
	}

	
	public static function getPeakWeek($mountain_id,$country_id,$user_id){

		
	    $sql = "SELECT sum(fd.feed_count) as Count, REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
				u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,
				f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm,
				mp.peak_index,m.no_of_peaks,m.id as mountain_id,mp.start_dttm,mp.end_dttm
				FROM feeds f							  
				INNER JOIN  mountain_peak mp ON f.peak_id = mp.id AND mp.is_active = 1  
				LEFT JOIN (
							SELECT count(*) feed_count , feed_id from feeds_like fl WHERE fl.is_active = 1 GROUP BY feed_id
				            UNION ALL
				            SELECT count(*) feed_count, feed_id from feeds_viewed fv WHERE fv.is_active = 1 GROUP BY feed_id  )  fd 
				ON fd.feed_id = f.id
				INNER JOIN  mountain m ON mp.mountain_id = m.id AND m.is_active = 2
				INNER JOIN  user u ON u.id = f.user_id  AND u.is_active = 1
				LEFT JOIN   user_image ui ON ui.user_id=u.id
				WHERE f.country_id = $country_id
				AND f.is_active = 1         
				AND m.id = $mountain_id                    
				GROUP BY f.id ORDER BY Count DESC";
			  
		$data = DB::select ( $sql );

		return $data;           
	}


	public static function getCurrentMountain($country_id){

		$sql =  "SELECT m.window_description,tz.time_zone,m.country_id,mp.id as peak_id,m.id as mountain_id,m.name as mountain_name,m.is_main,m.hash_tag,mp.peak_index,m.no_of_peaks,m.peak_duration,m.start_date,m.end_date						  
				  FROM mountain_peak mp
				  LEFT JOIN mountain m ON mp.mountain_id = m.id AND m.is_active = 2
				  INNER JOIN time_zone_country tz ON tz.id = m.zone_id 
				  WHERE 
				  	mp.is_finished = 0  
				  AND 
				  	mp.is_active = 1  AND m.country_id = $country_id 
				  AND m.is_main = 1  GROUP BY m.country_id" ;
	
		$data = DB::select ($sql);
		
		if($data)
			return $data[0];           
		else
			return FALSE;         
	}


	public static function getMountainListById($start='',$end='',$country_id,$mountain_id='',$peak_id='',$searchtag=''){

		$limit = '';
		$where = '';
		$wPeak = '';
		$search='';
		if($end)
			$limit = " LIMIT $start,$end";
		if($mountain_id)
			$where = " AND m.id=$mountain_id ";
		if($peak_id)
			$wPeak = " AND mp.id = $peak_id ";
		if($searchtag)
			$search="AND (u.user_name LIKE '%$searchtag%' OR u.first_name LIKE '%$searchtag%' OR u.family_name LIKE '%$searchtag%')";
		
		$sql = "SELECT sum(fd.feed_count) as Count, m.id as mountain_id,m.name as mountain_name,m.hash_tag as mountain_hash,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,							 
			  	u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,u.phone_number,u.website,
			  	f.description as feed_description,f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm
			  	FROM mountain m 
				INNER JOIN mountain_peak mp ON m.id = mp.mountain_id AND mp.is_finished in(0,1) 
				INNER JOIN feeds f ON f.peak_id = mp.id 
				LEFT JOIN (
							SELECT count(*) feed_count , feed_id from feeds_like fl WHERE fl.is_active = 1 GROUP BY feed_id
				            UNION ALL
				            SELECT count(*) feed_count, feed_id from feeds_viewed fv WHERE fv.is_active = 1 GROUP BY feed_id  )  fd 
				ON fd.feed_id = f.id
				INNER JOIN  user u ON u.id = f.user_id  AND u.is_active = 1
			  	LEFT JOIN   user_image ui ON ui.user_id=u.id
				WHERE f.is_active = 1  AND f.country_id = $country_id	
			  	$wPeak  $where $search
			  	GROUP BY f.id ORDER BY Count DESC $limit";		
		//echo"";print_r($sql);die;
		$data = DB::select ($sql);
		
		return $data;           
	}

	public static function getHashTag($feed_id){
		$sql = "SELECT GROUP_CONCAT(hm.hash_tag SEPARATOR ' ') as feed_hash
				FROM feeds f
				LEFT JOIN hash_tag_master hm ON f.id = hm.feed_id  AND hm.is_active = 1  
				WHERE f.id =$feed_id
				GROUP BY hm.feed_id";
		$data = DB::select ($sql);
		if($data[0]->feed_hash)
			return $data[0]->feed_hash;			 
		else
			return '';
	}


	public static function getHash($feed_id){
		$sql = "SELECT hm.hash_tag  as feed_hash
				FROM feeds f
				LEFT JOIN hash_tag_master hm ON f.id = hm.feed_id  AND hm.is_active = 1  
				WHERE f.id =$feed_id";
		$data = DB::select ($sql);
		return $data;			 
		
	}


	public static function getMoutainList($country_id='',$is_main,$role_id){

		if($country_id)
			$where = " m.country_id = $country_id AND";
		else
			$where = " ";
		$role='';
		if($role_id!=0 && $role_id!=1)
			$role="INNER JOIN role_permission_mountain rpm ON rpm.mountain_id=m.id AND rpm.role_id = '$role_id'";
		else
			$role='';
		
		$sql = "SELECT m.*, DATE_FORMAT(m.start_date,'%d %b %Y') as mstart_date,
							DATE_FORMAT(m.end_date,'%d %b %Y') as mend_date,
							REPLACE(REPLACE(REPLACE(REPLACE(m.url, 'http://', '') , 'http:://', '') , 'https://', ''),'https:://','')  as url,
							mp.is_finished
				FROM  mountain m $role
				INNER JOIN mountain_peak mp ON mp.mountain_id = m.id
				WHERE $where m.is_active IN (2,3) AND m.is_main = $is_main 	
				GROUP BY m.id 
				ORDER BY m.start_date ASC" ;
		$data = DB::select ($sql);
		
		return $data;           
	}

	public static function getMoutainByCountry($country_id){

		$sql =  "SELECT m.id as mountain_id,m.name as mountain_name,m.is_active,m.description as mountain_description,m.image_path, m.start_date,m.end_date
				FROM  mountain m 
				WHERE m.country_id = $country_id 
				AND m.is_main = 1 AND m.is_active IN (2,3)		
				ORDER BY m.id ASC" ;
			
		$data = DB::select ($sql);
		
		return $data;           
	}

	public static function getMoutains($country_id,$role_id,$start='',$end=''){
		$role='';
		$limit = '';
		if($role_id!=0 && $role_id!=1)
			$role="INNER JOIN role_permission_mountain rpm ON rpm.mountain_id=m.id AND rpm.role_id = '$role_id'";
		else 
			$role='';
		if($end)
			$limit = " LIMIT $start,$end";

		$sql =  "SELECT m.*,CONVERT_TZ(m.start_date,'+00:00',tz.offset) as start_date,
			    CONVERT_TZ(m.end_date,'+00:00',tz.offset) as end_date
				FROM  mountain m $role
				LEFT JOIN time_zone_country tz ON tz.id = m.zone_id
				WHERE 	(m.country_id = $country_id OR m.country_id = '') AND
				m.is_active IN(2,3,4) 			
				ORDER BY m.is_main DESC $limit" ;

		$data = DB::select ($sql);
		return $data;           
	}
        
        
	public static function idolsFeedCount($user_id){
		$sql = "SELECT m.name as mountain_name,u.first_name, u.family_name,u.user_name,u.id as user_id,u.phone_number,u.website,ui.image_path as ProfileImage,
				f.description as feed_description,f.video_name as feed_video,f.id as feed_id,if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm
				FROM mountain_peak mp
				LEFT JOIN  mountain m ON mp.mountain_id = m.id
				LEFT JOIN  feeds f ON f.peak_id = mp.id
				INNER JOIN  user u ON u.id = f.user_id
				INNER JOIN user_followers uf ON uf.follower_id=u.id and uf.user_id = $user_id and uf.is_active = 1
				LEFT JOIN user_image ui ON ui.user_id=u.id
				WHERE (mp.start_dttm <= NOW() AND mp.end_dttm >= NOW())
				AND m.is_active = 2
				GROUP BY f.user_id";

		$data = DB::select ($sql);
		
		return $data;
	}

	
	
	public static function searchFeedTagDetails($start='',$end='',$searchtag=''){
	
		$limit = '';
		if($end)
			$limit = " LIMIT $start,$end";

		$searchtag = "#$searchtag";
		
		$sql =  "SELECT m.name as mountain_name,m.hash_tag as mountain_hash,
				REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail,
				u.first_name, u.family_name,u.user_name,u.id as user_id,ui.image_path as ProfileImage,
				f.description as feed_description,f.video_name as feed_video,f.id as feed_id,
				if(f.updated_dttm IS NOT NULL,f.updated_dttm,f.created_dttm) as created_dttm
				FROM feeds f
				INNER JOIN mountain_peak mp ON mp.id = f.peak_id
				INNER JOIN mountain m ON m.id = mp.mountain_id
				INNER JOIN  user u ON u.id = f.user_id 
				LEFT JOIN user_image ui ON ui.user_id=u.id
				INNER JOIN hash_tag_master hm ON f.id = hm.feed_id  
				WHERE hm.hash_tag LIKE '%$searchtag%'
				ORDER BY f.updated_dttm DESC $limit" ;
		$data = DB::select ($sql);
	
		return $data;
	}
    
    public static function searchTagDetails($searchtag){
	
		$sql = "SELECT * FROM hash_tag_master hm
				WHERE hm.hash_tag LIKE '%$searchtag%' GROUP BY hm.hash_tag DESC" ;
		$data = DB::select ($sql);
	
		return $data;
	}

	public static function searchTrendingTagDetails($searchtag){
	
		$sql =  "SELECT hm.*
				FROM  hash_tag_master hm
				LEFT JOIN  feed_trending_tag frt ON  frt.hash_tag_id = hm.id
				WHERE hm.hash_tag LIKE '%$searchtag%' GROUP BY  hm.hash_tag DESC" ;
		$data = DB::select ($sql);
	
		return $data;
	}

	public static function convertTimeZone($date,$to_timezone){

		
		$sql = "SELECT CONVERT_TZ('".$date."','".$to_timezone."','+00:00') as timezone";
		
		$data = DB::select($sql);

		return $data[0]->timezone;
	}


	public static function getMountainPeak($mountain_id){

		$sql =  "SELECT mp.*, CONVERT_TZ(mp.start_dttm,'+00:00',tz.offset) as start_dttm,
						CONVERT_TZ(mp.end_dttm,'+00:00',tz.offset) as end_dttm,
						CONCAT(
							FLOOR(HOUR(TIMEDIFF(mp.end_dttm, CONVERT_TZ(NOW(),@@session.time_zone,'+00:00'))) / 24), ' days ',
							MOD(HOUR(TIMEDIFF(mp.end_dttm, CONVERT_TZ(NOW(),@@session.time_zone,'+00:00'))), 24), ' hours ',
							MINUTE(TIMEDIFF(mp.end_dttm, CONVERT_TZ(NOW(),@@session.time_zone,'+00:00'))), ' minutes') as Duration
				 FROM  mountain_peak mp 
				 LEFT JOIN  mountain m ON m.id = mp.mountain_id
				 LEFT JOIN time_zone_country tz ON tz.id = m.zone_id
				 WHERE mp.is_active = 1 AND mp.mountain_id = $mountain_id  
				 ORDER BY mp.is_finished ASC" ;
		$data = DB::select ($sql);
	
		return $data;

	}

	public static function getadminCurrentMountain($country_id,$role_id){
		
		$role='';
		if($role_id!=0 && $role_id!=1)
			$role="INNER JOIN role_permission_mountain rpm ON rpm.mountain_id=m.id AND rpm.role_id = '$role_id'";

		
		$sql =  " SELECT m.*
				  FROM  mountain m 
				  INNER JOIN time_zone_country tz ON tz.id = m.zone_id $role 
		          WHERE m.country_id = $country_id AND m.is_active IN (2,3) 
		          ORDER BY m.is_active ASC" ;
		
		$data = DB::select ($sql);
		return $data;
	}  


       
    public static function getMountainActivePeak($mountain_id){

		$sql =  "SELECT mp.id as peak_id,m.country_id
				 FROM  mountain m 
				 INNER JOIN  mountain_peak mp ON m.id = mp.mountain_id
				 WHERE m.is_active = 2 AND mp.mountain_id = $mountain_id  
				 AND  mp.is_finished = 0 " ;
		$data = DB::select ($sql);
		if($data)
			return $data[0];
		else
			return FALSE;

	}    


	public static function getMountainSetting($country_id){

		$sql =  "SELECT m.*,if(m2.peak_duration IS NOT NULL, m2.peak_duration, m1.peak_duration) as peak_duration, 
						if(m2.no_of_peaks IS NOT NULL, m2.no_of_peaks, m1.no_of_peaks) as no_of_peaks
			    FROM mountain m 
			    INNER JOIN mountain m1 on m1.id = m.id and m1.country_id = 15
			    LEFT JOIN mountain m2 on m2.id = m.id and m2.country_id = $country_id 
			    WHERE m.is_main = 1 AND m.is_active = 1" ;
		$data = DB::select ($sql);

		if($data)
			return $data[0];
		else
			return FALSE;
	}    

	public static function getMountainDetail($mountain_id){

	  $sql =  " SELECT m.*,CONVERT_TZ(m.start_date,'+00:00',tz.offset) as utc_start_date,
			    CONVERT_TZ(m.end_date,'+00:00',tz.offset) as utc_end_date
			    FROM mountain m
			    LEFT JOIN time_zone_country tz ON tz.id = m.zone_id
			    WHERE m.id = $mountain_id";
	  $data = DB::select ($sql);
	 
	 if($data)
			return $data[0];
		else
			return FALSE;

    }
public static function removeMountain($mountain_id)
    {
    	$id = $mountain_id;
    	$query = 'SET group_concat_max_len=100000';
        $datalen = DB::select ($query); 
    	$tables = array(
    	        "feeds_like"=>"feed_id",
				"feeds_viewed"=>"feed_id",
				"feeds_abused"=>"feed_id",
				//"feed_share"=>"feed_id",
				"feed_trending_tag"=>"feed_id",
				"hash_tag_master"=>"feed_id",
				"user_inbox"=>"feed_id",
				"feeds"=>"peak_id",
				"mountain_peak"=>"mountain_id",
				//"role_permission_mountain"=>"mountain_id",
				"mountain_judges"=>"mountain_id",
				"mountain"=>"id");
    	
    	
    	$sql =  "SELECT GROUP_CONCAT(mp.id) as peak_id
				 FROM  mountain_peak mp 
				 LEFT JOIN  mountain m ON m.id = mp.mountain_id
				 WHERE mp.mountain_id = $mountain_id " ;
		$data = DB::select ($sql);    	
		$peak_id = "";
		$feed_id = "";
 		
		if($data[0]->peak_id)
		{
	               $peak_id=$data[0]->peak_id;			
	    	       $sql =  "SELECT GROUP_CONCAT(fd.id) as feed_id,GROUP_CONCAT(fd.video_name) as video_name,GROUP_CONCAT(REPLACE (fd.video_name, '.mp4', '.jpeg') )as thumbnail
					 FROM  feeds fd 
					 WHERE fd.peak_id in($peak_id) " ;
		       $data = DB::select ($sql);
			  
			//echo"";print_r($data);die;
			
       		       if($data[0]->feed_id) {
				$response = Mountain::deleteSource('video',$data[0]->video_name);
				$response = Mountain::deleteSource('image',$data[0]->thumbnail);
				$feed_id = $data[0]->feed_id;	
			}	
		 }
		 
		if($id && $mountain_id && $peak_id)
		{
	    	foreach($tables as $t=>$ind)
	    	{ 
	    		$temp = $$ind;
	    		if($temp)
	    		{
		    		$where = "$ind in ($temp)";	    		     			
		    		$sql = "update $t set is_active=0 where $where";	    	 
	    			DB::update($sql);
	    		}
	    	}
	     
	    	return 1;
		}
    	else
    		return 0; 
    }
   
public static function deleteSource($path,$data)
    {
    	if($data) {
 			$source=explode(",",$data);
			if($path=='video')
			{
				$path=public_path ().'/feed/';
			}
			else {
				$path=public_path ().'/feed/thumbnail/';
			}
    	 	
			$destination = public_path ()."/archieve/";

			foreach ($source as $file) {
			
			  if (copy($path.$file, $destination.$file)) {
			    $delete[] = $path.$file;
			  }
			}
			// Delete all successfully-copied files
			foreach ($delete as $file) {
			  unlink($file);
			}
			
			return 1;	
		}
		else 
		return 0;	
    }
}