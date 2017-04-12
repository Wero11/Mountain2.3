<?php 

namespace App\Http\Controllers\site;



use App\Http\Controllers\Controller;

use App\Http\Models\api\ReferenceDomain;

use App\Http\Models\api\ReferenceValue;

use App\Http\Models\api\Role;

use Request;



class UserController extends Controller {



	/*

	 * Show the application dashboard to the user.

	 *

	 * @return Response

	 */



	 public function __construct() {



        $this->component = Request::segment(1);

    }

	

	/**

	 * Show the application dashboard to the user.

	 *

	 * @return Response

	 */



	public function userlist()

	{

		$data['component']  = 'components.'.$this->component;

		$data['breadcrumb'] = 'breadcrumb.'.$this->component.'breadcrumb';

		$data['popup']      = array('popup.addUser','popup.blockUser','popup.userDetailsforBlock','popup.deleteUser','popup.notifyAlert','popup.changePassword');

		$data['profession'] = ReferenceDomain::getReferenceValuesByCode('Profession');

		$data['role'] = Role::getRoles();

		

		return view('layout.content')->with($data);

	}

	

}

