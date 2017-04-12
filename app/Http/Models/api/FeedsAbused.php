<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;
class FeedsAbused extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feeds_abused';
	public $timestamps = false;

	protected $fillable = [ 
			'feed_id',
			'user_id',
			'description',
			'reported_dttm',
			'is_active',
			'is_read'
	];
	
	public static function getnotificationlist($post){

		$sql =  "SELECT IF(b.user_id IS NULL OR b.is_active=0, 0, 1 ) as Isblocked,b.*,date_format(max(f.`created_dttm`),'%b %d %Y') as lastpost,a.id,a.description,u.id as user_id,
				UPPER(CONCAT_WS(' ', u.first_name,u.family_name)) AS contactname,u.tags,i.image_path,UPPER(CONCAT_WS(' ', us.first_name,us.family_name)) AS reportername";
		
		
				$sql.=" FROM feeds_abused a inner join feeds f on a.feed_id=f.id   
				inner join user u on f.user_id=u.id 
inner join user us on a.user_id=us.id 
				left join user_image i on u.id=i.user_id"; 
		if($post['notify_filter']==''){
			$sql.=" left join user_block b on u.id=b.user_id"; 
		}else if($post['notify_filter']!=''){
			if($post['notify_filter']=='N'){
				$sql.=" left join user_block b on u.id=b.user_id";
			}else{
				$sql.=" inner join user_block b on u.id=b.user_id";
			}
			

		}
		$sql.=" where a.is_active = 1 AND IFNULL(b.is_active,1)=1";
		if($post['notify_filter']!=''){
				if($post['notify_filter']=='T'){
					$sql.=" AND b.blockedtype='TEMP'";
				}else if($post['notify_filter']=='P'){
					$sql.=" AND b.blockedtype='PERM'";
				}else if($post['notify_filter']=='N'){
					$sql.=" AND a.is_read=0";
				}
		}
		if($post['searchuserkeyword']!=''){
			$sql.= " AND (u.first_name LIKE '%".$post['searchuserkeyword']."%' OR u.family_name LIKE '%".$post['searchuserkeyword']."%' )";
		}
		
		$sql.= " group by f.user_id" ;

		//echo $sql;
				
		$data = DB::select ($sql);
		
		return $data;           
	}

	public static function getFeedAbusedByUserDetails($feedid){
		$sql =  "SELECT UPPER(CONCAT_WS(' ', u.first_name,u.family_name)) AS abusedby,u.tags FROM feeds_abused a inner join user u on a.user_id=u.id where a.feed_id='".$feedid."'";
				
		$data = DB::select ($sql);
		
		return $data;           
	}


}
