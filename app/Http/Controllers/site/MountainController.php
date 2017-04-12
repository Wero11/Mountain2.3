<?php 
namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Models\api\Mountain;
use App\Http\Models\api\Country;
use Request;
use Route;
use Input;
use DB;
use Session;
use App\Http\Models\api\Users;
use Illuminate\Support\Facades\Redirect;
class MountainController extends Controller {

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

	public function mountainList()
	{
	
$data['component'] = 'components.'.$this->component;
		$data['breadcrumb'] = 'breadcrumb.'.$this->component.'breadcrumb';
		$data['popup']     = array('popup.createMountain','popup.assignJudge','popup.pushNotification','popup.deleteAbusedFeed','popup.notifyAlert','popup.changePassword','popup.deleteMountainDetails');
		return view('layout.content')->with($data);
	}
	public function logout()
	{
		$user_id = Session::get('user_detail.0')->user_id;
		//echo"";print_r($user_id);die;
		$updateUser = Users::find($user_id)->update(array('last_login'=>date("Y-m-d H:i:s")));
		Session::flush();
		return Redirect::to('login')->with('message', 'Your are now logged out!');
	}

}
