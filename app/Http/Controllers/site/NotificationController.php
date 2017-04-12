<?php 

namespace App\Http\Controllers\site;



use App\Http\Controllers\Controller;

use App\Http\Models\api\ReferenceDomain;

use App\Http\Models\api\ReferenceValue;

use Request;



class NotificationController extends Controller {



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



	public function notificationlist()

	{

		$data['component']  = 'components.'.$this->component;

		$data['breadcrumb'] = 'breadcrumb.'.$this->component.'breadcrumb';

		$data['popup']      = array('popup.blockUser','popup.userDetailsforBlock','popup.deleteNotification','popup.deleteAbusedFeed','popup.unblockNotificationUser','popup.notifyAlert','popup.changePassword');

		//$data['profession'] = ReferenceDomain::getReferenceValuesByCode('Profession');

		

		return view('layout.content')->with($data);

	}

	

}

