<?php namespace App\Http\Models\api;



use Illuminate\Database\Eloquent\Model;

use DB;



class RolePermission extends Model {



	/**

	 * The database table used by the model.

	 *

	 * @var string

	 */

	protected $table = 'role_permission';

	public $timestamps = false;



	protected $fillable = [ 

			'key',

			'value',

			'role_id'

	];



	

	public static function getRoleSettings($roleid)

	{

		$SQL = "SELECT * from role_permission where role_id='".$roleid."'";

		$data = DB::select($SQL);

		

		$output = array();

		$advMountainArray=array();

		$fameMountainArray=array();

		foreach ($data as $data) {

			$output[$data->key]=$data->value;

			$output['role_id']=$data->role_id;

			$advMountain=RolePermission::getAssignedAdvMoutainLists($data->role_id);

			$fameMountain=RolePermission::getAssignedFameMoutainLists($data->role_id);

		}

		if($data){

			foreach ($advMountain as $advMountain) {

				array_push($advMountainArray,$advMountain->id);

			}

			$output['ADV_MUTN_LIST']=$advMountainArray;



			foreach ($fameMountain as $fameMountain) {

				array_push($fameMountainArray,$fameMountain->id);

			}

			$output['FAM_MUTN_LIST']=$fameMountainArray;

		}

		

		

		return $output;

	}

	public static function getMoutainLists($country_id='',$mainflag){

	

		$where = " ";

		$sql =  "SELECT m.*, DATE_FORMAT(m.start_date,'%d %b %Y') as start_date,DATE_FORMAT(m.end_date,'%d %b %Y') as end_date

				FROM  mountain m 

				WHERE m.is_active IN (2,3,4)";

		if($country_id){

			$sql .= " AND (m.country_id = $country_id OR m.country_id = '')";

		}

		if($mainflag==0){

			$sql .= " AND m.is_main = 0";

		}

		if($mainflag==1){

			$sql .= " AND m.is_main = 1";

		}

		 $sql .= " ORDER BY m.start_date DESC" ;

		$data = DB::select ($sql);

		

		return $data;           

	}

	public static function getAssignedAdvMoutainLists($roleid){



		$sql =  "SELECT m.id FROM  role_permission_mountain p inner join mountain m on p.mountain_id=m.id

				WHERE p.role_id='".$roleid."' AND m.is_main=0 AND m.is_active IN (2,3,4) ORDER BY m.name ASC" ;



		$data = DB::select ($sql);

		

		return $data;           

	}

	public static function getAssignedFameMoutainLists($roleid){



		$sql =  "SELECT m.id FROM  role_permission_mountain p inner join mountain m on p.mountain_id=m.id

				WHERE p.role_id='".$roleid."' AND m.is_main=1 AND m.is_active IN (2,3,4) ORDER BY m.name ASC" ;



		$data = DB::select ($sql);

		

		return $data;           

	}

	public static function insertRoleSettings($roleid,$key,$value)

	{

		

		$SQL = "SELECT * from role_permission p where p.role_id='".$roleid."' AND p.key='".$key."'";

		$data = DB::select($SQL);

		if($data){

			if($key!='ADV_MUTN_LIST' && $key!='FAM_MUTN_LIST' ){

				$UPDSQL = "update role_permission p set p.value='".$value."' where p.role_id='".$roleid."' AND p.key='".$key."'";

				$upddata = DB::select($UPDSQL);

			}

		}else{

			if($key!='ADV_MUTN_LIST' && $key!='FAM_MUTN_LIST' ){

				$INSSQL = "insert into role_permission (`key`,`value`,`role_id`) values ('".$key."',$value,$roleid)";

				$insdata = DB::select($INSSQL);

			}

		}

		///insert mountain permission

		if($key=='ADV_MUTN_LIST' || $key=='FAM_MUTN_LIST'){

			if($key=='ADV_MUTN_LIST'){

				$mountaintype='adv';

				

			}

			if($key=='FAM_MUTN_LIST'){

				$mountaintype='fame';

				

			}

			

			

			$delMountainSQL = "delete from role_permission_mountain where role_id='".$roleid."' and mountain_type='".$mountaintype."'";

			$delMountainData = DB::select($delMountainSQL);



			///if User Selects 'ALL' mountain means

			if(isset($value[0]) && $value[0]!=''){

				if($value[0]=='0'){

					if($key=='ADV_MUTN_LIST'){

						$SQL = "select id from mountain m where m.is_active IN (2,3,4) and m.is_main=0";

						$advdata = DB::select($SQL);

						foreach ($advdata as $advdata) {

							$INSALLSQL = "insert into role_permission_mountain set mountain_id='".$advdata->id."',role_id='".$roleid."',mountain_type='adv'";

							$insdata = DB::select($INSALLSQL);

						}

					}

					if($key=='FAM_MUTN_LIST'){

						$SQL = "select id from mountain m where m.is_active IN (2,3,4) and m.is_main=1";

						$famedata = DB::select($SQL);

						foreach ($famedata as $famedata) {

							$INSALLSQL = "insert into role_permission_mountain set mountain_id='".$famedata->id."',role_id='".$roleid."',mountain_type='fame'";

							$insdata = DB::select($INSALLSQL);

						}



					

					}

				

				

				}else{

					foreach ($value as $value) {

				

						$INSSQL = "insert into role_permission_mountain (`mountain_id`,`role_id`,`mountain_type`) values ($value,$roleid,'".$mountaintype."')";

						$insdata = DB::select($INSSQL);

					}

				}

			}

		}

	}



}

