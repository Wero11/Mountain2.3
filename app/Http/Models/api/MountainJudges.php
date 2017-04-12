<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;
class MountainJudges extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mountain_judges';
	public $timestamps = false;

	protected $fillable = [ 
			'mountain_id',
			'judge_id',
			'created_by',
			'created_dttm',
			'is_active'
	];


	public static function getMountainJudges($mountain_id){

		$sql = "SELECT u.id as judge_id,u.user_name,u.user_type,u.profession,u.description,u.first_name,u.family_name,u.email,u.gender,u.dob,
				IF(ui.image_path IS NULL, 'noimage.jpg',ui.image_path) as ProfileImage, c.name as country_name,s.name as state_name,c.id as country_id,s.id as state_id,
				m.id as mountain,m.name as mountain_name,m.description as mountain_description,m.hash_tag as moutain_hash,u.website,u.tags
				FROM mountain_judges mj 
				INNER JOIN user u ON  u.id=mj.judge_id AND u.is_active = 1 AND u.is_hide = 0
				LEFT JOIN mountain m ON  m.id=mj.mountain_id AND m.is_active = 2
				LEFT JOIN country c ON  c.id=u.country
				LEFT JOIN state s ON  s.id=u.state
				LEFT JOIN user_image ui ON ui.user_id=u.id AND ui.is_active = 1 
				WHERE mj.is_active = 1 AND mj.mountain_id = '".$mountain_id."' ORDER BY user_name ASC ";
		
		
		$data = DB::select ( $sql );

		return $data;
	}


	public static function getJudge($mountain_id){

		$sql = "SELECT u.id as judge_id,u.user_name,u.description,u.first_name,u.family_name,ui.image_path as ProfileImage,u.website,u.tags
				FROM mountain_judges mj 
				INNER JOIN user u ON  u.id=mj.judge_id AND u.is_active = 1 AND u.is_hide = 0
				LEFT JOIN user_image ui ON ui.user_id=u.id AND ui.is_active = 1
				WHERE mj.is_active = 1 AND mj.mountain_id = '".$mountain_id."' ORDER BY user_name ASC ";
		$data = DB::select ( $sql );

		return $data;
	}
	
	public static function getJudges($country_id,$start='',$end='',$mountain_id='',$search='',$type=''){
		$limit  = ''; 
		$not_in = '';
		$searchQuery = '';
		$typeQry='';
$country='';
		if($end)
			$limit = " LIMIT $start ,$end ";
		if($mountain_id)
			$not_in = " AND u.id NOT IN (SELECT mj.judge_id FROM mountain_judges mj WHERE mj.mountain_id=$mountain_id AND mj.is_active= 1)";

		if($search)
			$searchQuery = " AND  (u.tags LIKE '%$search%' OR u.user_name LIKE '%$search%' OR u.description LIKE '%$search%')";
		
		if($type)
			$typeQry = " AND  u.judge_type ='$type'";
if($country_id!=0)
				$country = " AND u.country = ".$country_id."";
		else 
			$country="";
		
		$sql = "SELECT u.id as judge_id,u.website,u.tags,u.is_hide,u.is_active,u.user_name,u.user_type,rv.value as profession,u.description,u.first_name,u.family_name,u.email,u.gender,u.dob,
				IF(ui.image_path IS NULL, 'noimage.png',ui.image_path) as ProfileImage, c.name as country_name,s.name as state_name,c.id as country_id,s.id as state_id,u.website,u.tags,c.code
				FROM user u 
				LEFT JOIN country c ON  c.id=u.country
				LEFT JOIN state s ON  s.id=u.state
				LEFT JOIN user_image ui ON ui.user_id=u.id AND ui.is_active = 1
				LEFT JOIN reference_value rv ON rv.id=u.profession AND rv.is_active = 1
				WHERE u.is_active = 1 $not_in $country $searchQuery $typeQry AND u.user_type = 'judge' ORDER BY user_name ASC $limit";
		
		$data = DB::select ( $sql );

		return $data;
	}
	
	public static function getJudgeMountains($userid){
	
		$sql = "SELECT GROUP_CONCAT(m.name)  as name
				FROM mountain_judges mj
				LEFT JOIN mountain m ON  m.id=mj.mountain_id 
				WHERE mj.is_active = 1 AND mj.judge_id = $userid 
				ORDER BY m.name ASC ";
	
	
		$data = DB::select ( $sql );
	
		return $data;
	}

	public static function getCountryAllJudges($country_id,$mountain_id){

		
		$sql = "SELECT * FROM(SELECT u.id as judge_id,u.user_name,u.user_type,u.profession,u.description,
								u.first_name,u.family_name,u.email,u.gender,u.dob,u.judge_type,
								REPLACE(REPLACE(REPLACE(REPLACE(u.website, 'http://', '') , 'http:://', '') , 'https://', ''),'https:://','')  as website,
								u.tags,u.phone_number,
								IF(ui.image_path IS NULL, 'noimage.jpg',ui.image_path) as ProfileImage, 
								c.name as country_name,s.name as state_name,c.id as country_id,s.id as state_id
				FROM mountain_judges mj 
				INNER JOIN user u ON  u.id=mj.judge_id AND u.is_active = 1 AND u.is_hide = 0
				LEFT JOIN mountain m ON  m.id=mj.mountain_id AND m.is_active = 2
				LEFT JOIN country c ON  c.id=u.country
				LEFT JOIN state s ON  s.id=u.state
				LEFT JOIN user_image ui ON ui.user_id=u.id AND ui.is_active = 1 
				WHERE mj.is_active = 1 AND mj.mountain_id = '".$mountain_id."' ORDER BY user_name ASC) cj

				UNION

				SELECT * FROM (SELECT u.id as judge_id,u.user_name,u.user_type,u.profession,u.description,
								u.first_name,u.family_name,u.email,u.gender,u.dob,u.judge_type,
								REPLACE(REPLACE(REPLACE(REPLACE(u.website, 'http://', '') , 'http:://', '') , 'https://', ''),'https:://','')  as website,
								u.tags,u.phone_number,
								IF(ui.image_path IS NULL, 'noimage.jpg',ui.image_path) as ProfileImage, 
								c.name as country_name,s.name as state_name,c.id as country_id,s.id as state_id
				FROM user u 
				LEFT JOIN mountain_judges mj ON  mj.judge_id=u.id AND mj.is_active = 1 AND u.id != mj.judge_id
				LEFT JOIN country c ON  c.id=u.country
				LEFT JOIN state s ON  s.id=u.state
				LEFT JOIN user_image ui ON ui.user_id=u.id AND ui.is_active = 1  
				WHERE  u.is_active = 1 AND u.is_hide = 0  AND user_type ='judge'
				AND u.country = ".$country_id." ORDER BY u.user_name ASC) aj";
		
		$data = DB::select ( $sql );

		return $data;
	}
}
