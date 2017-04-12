<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';
	public $timestamps = false;

	protected $fillable = [ 
			'user_name',
			'first_name',
			'last_name',
			'family_name',
			'password',
			'email',
			'gender',
			'dob',
			'country',
			'state',
			'user_type',
			'judge_type',
			'profession',
			'description',
			'website',
			'phone_number',
			'tags',
			'role_id',
			'agency_name',
			'agency_website',
			'agent_email',
			'agent_name',
			'agent_number',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active',
			'is_hide',
			'device_token',
			'last_login'
	];



	public static function getUserDetail($value,$email='',$user_type) {
               if($email)
			$mail= "OR u.email = '".$email."'";
                else
                     $mail= " ";
		$sql = "SELECT u.id as user_id,u.user_name,u.first_name,u.family_name,u.email,u.gender,u.dob,
				ui.image_path as ProfileImage, c.name as country_name,s.name as state_name,c.id as country_id,s.id as state_id
				FROM user u 
				LEFT JOIN country c ON  c.id=u.country
				LEFT JOIN state s ON  s.id=u.state
				LEFT JOIN user_image ui ON ui.user_id=u.id
				WHERE u.is_active = 1 AND (u.user_name = '" . $value . "' $mail)  AND u.user_type = '".$user_type."' GROUP BY u.id";
//echo"";print_r($sql);die;
		$data = DB::select ( $sql );
		
		return $data;
	}


	public static function getUserProfile($user_id) {
		$sql = "SELECT u.*,u.password,u.id as user_id,u.user_name,u.user_type,u.profession,u.description,u.first_name,u.family_name,u.email,u.gender,u.dob,
				ui.image_path as ProfileImage,u.website,u.phone_number,c.name as country_name,s.name as state_name,c.id as country_id,s.id as state_id,
				u.agency_name,u.agency_website,u.agent_name,u.agent_number,u.agent_email,c.code,
				(SELECT count(user_id) FROM user_followers uf WHERE uf.user_id=$user_id AND uf.is_active = 1) as countIdols,
				(SELECT count(follower_id) FROM user_followers uff WHERE uff.follower_id=$user_id AND uff.is_active = 1) as countFans
				FROM user u 
				LEFT JOIN country c ON  c.id=u.country
				LEFT JOIN state s ON  s.id=u.state
				LEFT JOIN user_image ui ON ui.user_id=u.id
				WHERE u.id = ".$user_id;
		
		$data = DB::select ( $sql );
		if($data)
			return $data[0];
		else
			return '';
		
	}

	public static function getUserCountryList() {
		$sql = "SELECT c.name as country_name,c.id as country_id,CONCAT(REPLACE( c.name, ' ', '-' ),'.','jpeg') as countryImage
				FROM user u 
				INNER JOIN country c ON  c.id=u.country
				WHERE u.is_active = 1 GROUP BY c.id";
		
		$data = DB::select ( $sql );		
		return $data;
	}
    
    public static function getSearchUserDetail($user_id,$value) {

		$sql = "SELECT u.id AS user_id, u.user_name, u.first_name, u.family_name, ui.image_path AS ProfileImage,uf.is_active 
				FROM user u 
				LEFT JOIN user_image ui ON ui.user_id = u.id 
				LEFT JOIN user_followers uf on u.id=uf.follower_id AND uf.user_id=$user_id
				WHERE u.is_active =1 
				AND (u.user_name  LIKE '".$value."%' OR u.first_name LIKE '".$value."%'  OR u.family_name LIKE '".$value."%'   ) 
				GROUP BY u.id ";
		$data = DB::select ( $sql );
	
		return $data;
	}

	public static function getFansActivityList($user_id) {

		$sql = " SELECT  ActivityDate, 'isLike' AS Type, lk.user_id, feed_id AS ref_id,
					lk.first_name,lk.family_name,lk.image_path as ProfileImage,lk.thumbnail,lk.user_name
					FROM	(SELECT * FROM
								(SELECT  like_dttm as ActivityDate, fl.user_id, feed_id,
									u.user_name,u.first_name,u.family_name,ui.image_path,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail 
							 		FROM 	feeds f 
							 		INNER JOIN feeds_like fl ON fl.feed_id = f.id
							 		INNER JOIN user u ON u.id = fl.user_id  AND u.is_active = 1
							 		LEFT JOIN user_image ui ON u.id = ui.user_id 
					         	WHERE 	f.user_id = $user_id AND fl.user_id NOT IN($user_id) AND fl.is_active = 1
					         	ORDER BY fl.user_id ASC)  l 
								ORDER BY ActivityDate DESC) lk
					UNION
					SELECT * 
						FROM (SELECT uf.created_dttm AS ActivityDate, 'isIdol' AS Type, uf.user_id, uf.user_id as ref_id,
									u.first_name,u.family_name,ui.image_path as ProfileImage,'null' AS thumbnail,u.user_name
									FROM	user_followers uf
									INNER JOIN user u ON u.id = uf.user_id  AND u.is_active = 1
									LEFT JOIN user_image ui ON u.id = ui.user_id 
								    WHERE	uf.follower_id = $user_id
									ORDER BY uf.created_dttm) fl					 
					ORDER BY ActivityDate  DESC";		
		
		$data = DB::select ( $sql );	
		return $data;
	}


	public static function getIdolsActivityList($follower_id,$startDate) {

		$sql = " SELECT  ActivityDate, 'isLike' AS Type,lk.user_id, feed_id AS ref_id,
					lk.first_name,lk.family_name,lk.image_path as ProfileImage,lk.thumbnail,lk.user_name
					FROM	(SELECT * FROM
								(SELECT  like_dttm as ActivityDate, fl.user_id, feed_id,
									u.user_name,u.first_name,u.family_name,ui.image_path,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail 
							 		FROM 	feeds_like fl 
							 		INNER JOIN feeds f ON fl.feed_id = f.id
							 		INNER JOIN user u ON u.id = fl.user_id  AND u.is_active = 1
							 		LEFT JOIN user_image ui ON u.id = ui.user_id 
					         	WHERE 	fl.user_id = $follower_id  AND f.is_active = 1 AND fl.is_active = 1
					         	AND fl.like_dttm >= '".$startDate."'
					         	ORDER BY fl.user_id ASC)  l 
								ORDER BY ActivityDate DESC) lk
					UNION
					SELECT * 
						FROM (SELECT uf.created_dttm AS ActivityDate, 'isIdol' AS Type,uf.user_id, uf.follower_id as ref_id,
									u.first_name,u.family_name,ui.image_path as ProfileImage,'null' AS thumbnail,u.user_name
									FROM	user_followers uf
									INNER JOIN user u ON u.id = uf.follower_id AND u.is_active = 1
									LEFT JOIN user_image ui ON u.id = ui.user_id  
								    WHERE	uf.user_id = $follower_id AND uf.is_active = 1
								    AND uf.created_dttm >= '".$startDate."'
									ORDER BY uf.created_dttm) fl					 
					ORDER BY ActivityDate  DESC";		
		
		$data = DB::select ( $sql );	
		return $data;
	}

	public static function getUserIdolsActivityList($follower_id) {

		$sql = " SELECT  ActivityDate, 'isLike' AS Type, lk.user_id, feed_id AS ref_id,
					lk.first_name,lk.family_name,lk.image_path as ProfileImage,lk.thumbnail,lk.user_name
					FROM	(SELECT * FROM
								(SELECT  like_dttm as ActivityDate, f.user_id, feed_id,
									u.user_name,u.first_name,u.family_name,ui.image_path,REPLACE (f.video_name, '.mp4', '.jpeg') as thumbnail 
							 		FROM 	feeds f 
							 		INNER JOIN feeds_like fl ON fl.feed_id = f.id AND fl.is_active = 1
							 		INNER JOIN user u ON u.id = f.user_id  AND u.is_active = 1
							 		LEFT JOIN user_image ui ON u.id = ui.user_id 
					         	WHERE 	fl.user_id = $follower_id 
					         	ORDER BY fl.user_id ASC)  l 
								ORDER BY ActivityDate DESC) lk
					UNION

					SELECT * 
						FROM (SELECT uf.created_dttm AS ActivityDate, 'isIdol' AS Type,u.id as user_id, uf.follower_id as ref_id,
									u.first_name,u.family_name,ui.image_path as ProfileImage,'null' AS thumbnail,u.user_name
									FROM	user_followers uf
									INNER JOIN user u ON u.id = uf.follower_id  AND u.is_active = 1
									LEFT JOIN user_image ui ON u.id = ui.user_id 
								    WHERE	uf.user_id = $follower_id AND uf.is_active = 1
									ORDER BY uf.created_dttm) fl					 
					ORDER BY ActivityDate  DESC";		
		
		$data = DB::select ( $sql );	
		return $data;
	}


	
	public static function getEmailContacts($emails,$phonenumbers,$user_id){
		

		if(isset($phonenumbers))  {
			$phonenumber = array();
			$phonenumbers = array_filter($phonenumbers);
			foreach ($phonenumbers as $val) {
			    $phonenumber[] = "'%".trim($val)."%'";
			}

			$string = implode(' OR u.email LIKE ', $phonenumber);				   
		}

		if(isset($emails)) {
			$email = array();
			$emails = array_filter($emails);
			foreach ($emails as $val) {
			    $email[] = "'%".trim($val)."%'";
			}
			$string1 = implode(' OR u.phone_number LIKE ', $email);
		}

		if($string && !$string1)
			$like_email = " u.email LIKE $string  ";

		if(!$string && $string1)
			$like_email = " u.phone_number LIKE $string1   ";

		if($string && $string1)
			$like_email = " u.email LIKE $string OR u.phone_number LIKE $string1  ";

		$sql = "SELECT id FROM user u  
		        WHERE $like_email
		        AND u.id NOT IN ($user_id) 
				AND u.is_active = 1 GROUP BY u.id  ORDER BY u.id DESC";	
		
		$data = DB::select ( $sql );	
		if($data)
			return $data[0]->id;
		else
			return '';
	}

	public static function getUserlist($country,$start='',$end='',$searchtag='') {
		$limit = '';
		$search='';
		if($end)
			$limit = " LIMIT $start,$end";
		if($searchtag)
			$search="AND (u.user_name LIKE '%$searchtag%' OR u.tags LIKE '%$searchtag%')";
		
		$sql = "SELECT u.id as user_id,u.user_name,u.first_name,u.family_name,u.email,u.gender,u.dob,u.role_id,ro.name,u.description,u.gender,u.tags,
				ui.image_path as ProfileImage, c.name as country_name,c.code,s.name as state_name,c.id as country_id,s.id as state_id
				FROM user u
				LEFT JOIN country c ON  c.id=u.country
				LEFT JOIN state s ON  s.id=u.state
				LEFT JOIN user_image ui ON ui.user_id=u.id
				LEFT JOIN role ro ON ro.id=u.role_id
				WHERE u.is_active = 1  $search AND u.role_id NOT IN (0,1)  GROUP BY u.id DESC
				$limit";
		
		$data = DB::select ( $sql );
	
		return $data;
	}
	
	public static function getUserRoles($role_id) {
		$sql = "SELECT rp.*
				FROM role_permission rp
				WHERE rp.value=1 and rp.role_id = ".$role_id;
		$data = DB::select ( $sql );
		return $data;
	
	}

	public static function getadminLogin($user_name,$password) {
		$sql = "SELECT u.*
				FROM user u 
				WHERE (u.user_name = '$user_name' OR u.email ='$user_name') 
				AND  u.password='$password' 
				AND u.is_active=1 AND u.role_id!=0";
		
		$data = DB::select ( $sql );
		if($data)
			return $data[0];
		else
			return '';
	
	}

}