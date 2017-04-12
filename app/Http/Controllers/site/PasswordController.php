<?php namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use Request;
use Input;
use Route;
use Session;
use Redirect;
use Mail;
class PasswordController extends Controller {

    
	public function forgotpassword()
	{
		if (Request::isMethod('post'))
		{
			$post = Input::all();
			
			$request = Request::create('/api/v1/site/userEmailcheck', 'POST', $post);
			$response = Route::dispatch($request);
			$content = $response->getContent();
			$results = json_decode($content);
//echo "";print_r($results);die;
			if(isset($results->status) && $results->status)
			{
				$data['password'] =$results->result->password;
				$data['email'] = $results->result->email;
				$data['first_name'] = $results->result->first_name;
				$data['last_name'] = $results->result->last_name;
				$data['user_name'] = $results->result->user_name;
				
				$sent = Mail::send('login.emailpassword', $data, function($message)
				{
					
					$message->to(Input::get('email'))->subject('Mountain : Forgot UserName/Password');
					
				});
				
				if($sent){	
return Redirect::back()->withErrors('Email has been sent.');			
				  //return Redirect::to('/login')->with('message', 'success|Email has been sent.');
				}  
				else {
return Redirect::back()->withErrors('Something went wrong. Please try again later.');
				   //return Redirect::to('/login')->withErrors('Something went wrong. Please try again later.');   
				}  
			}
			else
			{	$data['errors'] = $results->message;

    		                 return Redirect::back()->withErrors($results->message);
				//return Redirect::to('/login')->withErrors($results->errors);
			}	
		}
		
		
	}
	
	

}