<?php 

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;

use Request;

use Input;

use Route;

use Session;
use App\Http\Models\api\Users;

use Illuminate\Support\Facades\Redirect;



class LoginController extends Controller {



    public function index()

    {

        return view("login.login");

    }

    public function logincheck()

    {

    	$post = Input::all();

    	$request = Request::create('/api/v1/device/adminLoginCheck', 'POST', $post);

    	$originalInput = Request::input();

    	Request::replace($request->input());

    	$response = Route::dispatch($request);

    	$content = $response->getContent();

    	$results = json_decode($content);

    	Request::replace($originalInput);

    	$user_detail=$results->result;

    	//Session::flush();

    	if(isset($results->status) && $results->status){

    		Session::push('user_detail', $user_detail->user);

    		 

    		$userRole=$user_detail->user;
    		$userRoleMenu = $userRole->role;
               if($userRole->role_id!=1){
		  if(count($userRoleMenu)>0)  
		  {

		  	foreach ( $userRoleMenu as $role )
		  	{
		  		if ($role->key =='MUTN' )
		  		{
		  			return Redirect::to('/managemountain');
		  		}
		  		else if ($role->key =='JUG' )
		  		{
		  			return Redirect::to('/managejudge');
		  		}
		  		else if ($role->key =='USR' )
		  		{
		  			return Redirect::to('/manageuser');
		  		}
		  		else if ($role->key =='NOFY' )
		  		{
		  			return Redirect::to('/notification');
		  		}
                               
		  	
		  	}
		  	
		  }
		  else{
		                Session::flush();
		  			return Redirect::back()->withErrors('User have no permissions');
		  }		 
			
             }else{
		  	return Redirect::to('/managemountain');
		  }	

    	}else{

    		 

    		$data['errors'] = $results->message;

    		return Redirect::back()->withErrors($results->message);

    	}

    }



}