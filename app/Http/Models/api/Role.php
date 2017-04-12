<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'role';
	public $timestamps = false;

	protected $fillable = [ 
			'name',
			'description',
        'is_active'
	];

	/**
	 * Create By Karthiga
	 *
	 * Created Date : 19 October 2015
	 *
	 * To Get User Country
	 *
	 * @return Response
	 */
	public static function getRoles()
	{
		$SQL = "SELECT id,name from role where is_active='1' and name!='Super Admin'";
		$data = DB::select($SQL);
		return $data;
	}
	public static function getRoleDetails($roleid)
	{
		
		$RoleSQL = "SELECT * from role where id='".$roleid."'";
		$roledata = DB::select($RoleSQL);
		return $roledata;
	}
	public static function updateRoleDescription($roleid,$description)
	{
		
		$RoleSQL = "update role set description='".$description."' where id='".$roleid."'";
		$roledata = DB::select($RoleSQL);
		return $roledata;
	}
public static function checkRoleAssigned($roleid)
	{
		$SQL = "SELECT count(*) as usrcount from role r inner join user u on r.id=u.role_id where r.id='".$roleid."' and u.is_active=1";
		$data = DB::select($SQL);
		return $data[0]->usrcount;
	}
}
