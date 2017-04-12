<?php namespace App\Http\Models\api;



use Illuminate\Database\Eloquent\Model;



class UserAttributes extends Model {



	/**

	 * The database table used by the model.

	 *

	 * @var string

	 */

	protected $table = 'user_attributes';

	public $timestamps = false;



	protected $fillable = [ 

			'user_id',

			'height',

			'weight',

			'ethinicity',

			'skin_color',

			'eye_color',

			'chest',

			'waist',

			'hips',

			'shoe_size',

			'hair_length',

			'hair_color',

			'hair_type',

			'dress_size_low',

			'dress_size_high',

			'created_by',

			'updated_by',

			'created_dttm',

			'updated_dttm',

			'is_active'

	];





	



}

