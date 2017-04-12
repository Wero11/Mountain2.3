<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;

class Acting extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'acting';
	public $timestamps = false;

	protected $fillable = [ 
			'user_id',
			'agencies',
			'shortflims',
			'tvshows',
			'musicvideos',
			'radio',
			'feauturesfilms',
			'entertainers',
			'theatre',
			'representation',
			'experience',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active'
	];

}
