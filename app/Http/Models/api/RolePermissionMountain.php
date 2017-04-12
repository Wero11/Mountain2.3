<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

use DB;
class RolePermissionMountain extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'role_permission_mountain';
	public $timestamps = false;

	protected $fillable = [ 
			'mountain_id',
			'role_id',
			'mountain_type',
			'is_active'
	];

}
