<?php 

namespace App\Http\Controllers\device;


use App\Http\Controllers\Controller;
use App\Http\Models\api\Accent;
use App\Http\Models\api\Acting;
use App\Http\Models\api\Country;
use App\Http\Models\api\Feeds;
use App\Http\Models\api\FeedsLike;
use App\Http\Models\api\FeedsView;
use App\Http\Models\api\FeedsAbused;
use App\Http\Models\api\FeedTrendingTag;
use App\Http\Models\api\HashTagMaster;
use App\Http\Models\api\Language;
use App\Http\Models\api\Modeling;
use App\Http\Models\api\Mountain;
use App\Http\Models\api\MountainPeak;
use App\Http\Models\api\MountainJudges;
use App\Http\Models\api\PeakTrack;
use App\Http\Models\api\ReferenceDomain;
use App\Http\Models\api\ReferenceValue;
use App\Http\Models\api\State;
use App\Http\Models\api\SocialMapping;
use App\Http\Models\api\Users;
use App\Http\Models\api\UserAttributes;
use App\Http\Models\api\UserFollowers;
use App\Http\Models\api\UserImage;
use App\Http\Models\api\UserInbox;
use App\Http\Models\api\TimeZoneCountry;
use Input;
use DB;
use Request;
use Illuminate\Support\Collection;
use Config;
use File;
use DateTime;


class ApiController extends Controller {
	
	public function __construct() {
        $this->api = Request::segment(4);
   }

	public function getpostdata($data){

   	$post = Input::json ()->all ();		
		if (! isset ( $post ) || empty ( $post ))
			$post = Input::all ();		

		return $post;
	}

	public function getErrormessage($errorIndex) 
	{

		$errormessges = array (
			// Default
			'1' => 'Success',
			'2' => 'Error',					
			'3' => 'Requested data is empty',
			'4' => 'No Records Found',
			'5' => 'Unable to save data',
			'6' => 'Updated sucessfully',
			'7' => 'Deleted sucessfully',

			// Register 
			'8'  => 'Username/Email is already registered.',
			'9'  => 'No account found with that  username' ,
			'10' => 'User register successfully',

			// Login
			'11' => 'Invalid Username or Password.Please try again',
			'12' => 'User logged successfully',
			'13' => 'Unable to login',

			// Feed
			'14' => 'Unable to upload video.Please try again ',
			'15' => 'Feed uploaded successfully  ',

			// Inbox
			'16' => 'Message sent successfully',
			'17' => 'Unable to send message',
			'18' => 'Alreay feed uploaded against the current mountain  ',

			// Forgot Password 
			'19' => 'Mail Send Successfully',
			'20' => 'Already feed viewed  ',
			'21' => 'Feed reposted successfully  ',			

			 // Judge 
			'22' => 'Judge register successfully',			

			// User 
			'23' => 'Profile image updated successfully',

			// User 
			'24' => 'Password changed successfully',

			// Activty
			'25' => 'Source added sucessfully',

			'26' => 'No active peak for this mountain',

		);

		return $errormessges [$errorIndex];
	}


	public function getReponse($status,$code,$result){

		$response['status'] = $status;
		$response['code']   = $code;
		$response['message']  = $this->getErrormessage($code);
		$response['api']    = $this->api;
		$response['result'] = $result;
		return $response;
	}	

	
	public function Register() {
		
		$post = $this->getpostdata ( $_REQUEST );
		
		$chkUsername =Users::getUserDetail ( $post ['user_name'], $post ['email'],$post['user_type'] );
		if (count ( $chkUsername ) > 0) {
			$response = $this->getReponse(FALSE,8,FALSE);	
		} else {

			$oUser = new Users();
			if (! empty ( $post ['password'] )) {
                                $newpassword=$post ['password'];
				$post ['password'] = md5 ( $post ['password'] );
			}

			if(isset($post['country']) && empty($post['country']))
				$post['country'] = 15;

			$oUser->fill ( $post );		
			$oUser->created_dttm =  date ( 'Y-m-d H:i:s' );
			$oUser->is_active =  1;
			if ($oUser->save () === FALSE) {
				$response = $this->getReponse(FALSE,5,FALSE);	
			} else {

				if ($this->uploadProfileImage ( $oUser->id, $post ) == TRUE)
					$profile_flag = TRUE;
				else
					$profile_flag = FALSE;

				$oMountain = Mountain::where(array('country_id'=>$post['country'],'is_active'=>2,'is_main'=>1))->first();
				if(!$oMountain){
					$createNewMountain = $this->createMountain($post['country'],date ( 'Y-m-d H:00:00' ),1);					
					$createForthMountain = $this->createMountain($post['country'],$createNewMountain->end_date,0);
				}
                                if(! empty ( $post ['first_name'] )){
				  	$post['first_name']=$post['first_name'];
				}else {
					$post['first_name']='Guest';
                                 }
				if(! empty ( $post ['family_name'] )){
				  	$post['family_name']=$post['family_name'];
				}else{ 
					$post['family_name']='';
                                 }
                                 if (! empty ( $post ['email'] )) {
                                     $fullname = ucwords ($post['first_name']. " " .$post['family_name']);
				      $this->SendUserDetailsToEmail($fullname, $post ['email'], $newpassword,$post ['user_name']);
                                 }
				$result = $this->getUserDetailArray($oUser->id,$oUser->country);
				$response = $this->getReponse(TRUE,10,$result);	
			}			
		}

		return $response;
	}

	public function createMountain($country_id,$start_date,$start_peak){

		$oTimeZoneCountry = TimeZoneCountry::where(array('country_id'=>$country_id,'is_default'=>'1'))->first();		
		$defaultMountain  = Mountain::getMountainSetting($country_id);
		$defaultMountain  = Mountain::where('id',$defaultMountain->id)->first();
		$newMountain = $defaultMountain->replicate();
		$month = date('F', strtotime($start_date));
		$newMountain->name         = 'Default '.$month;	
		$newMountain->country_id   = $country_id;	
		$newMountain->zone_id      = $oTimeZoneCountry->id;		
		$newMountain->start_date   = $start_date;
		$newMountain->created_dttm = date ( 'Y-m-d H:i:s' );
		$newMountain->updated_dttm = date ( 'Y-m-d H:i:s' );
		if($start_peak)
			$newMountain->is_active    = 2;
		else
			$newMountain->is_active    = 3;
		$days = $newMountain->no_of_peaks * $newMountain->peak_duration;
		$newMountain->end_date = date('Y-m-d H:i:s', strtotime($newMountain->start_date. ' + '.$days.' days'));
		
		if ($newMountain->save () === TRUE) {
			
			for($i=1;$i <= $newMountain->no_of_peaks;$i++){

				$oMountainPeak = new MountainPeak();
				$oMountainPeak->mountain_id = $newMountain->id;
				$start_days = ($i-1) * $newMountain->peak_duration;
				$end_days = $i * $newMountain->peak_duration;
				$oMountainPeak->start_dttm  = date('Y-m-d H:i:s', strtotime($newMountain->start_date. ' + '.$start_days.' days'));
				$oMountainPeak->end_dttm  = date('Y-m-d H:i:s', strtotime($newMountain->start_date. ' + '.$end_days.' days'));
				$oMountainPeak->peak_index = $i;
				if($start_peak && $i == 1){
					$oMountainPeak->is_finished = 0;					
				} else {
					$oMountainPeak->is_finished = 2;					
				}
				$oMountainPeak->is_active = 1;
				if ($oMountainPeak->save () === TRUE) {
					
				} 
			}
			return $newMountain;
		} 
	}

	public function uploadProfileImage($user_id, $profileimage) {
		$post ['user_id'] = $user_id;
		if (isset ( $profileimage ['ProfileImage'] ) && ! empty ( $profileimage ['ProfileImage'] ))
			$post ['imagecontent'] = $profileimage ['ProfileImage'];
		else
			$post ['imagecontent'] = '';

		if (! empty ( $post ['user_id'] ) && ! empty ( $post ['imagecontent'] )) {
			$post ['image_path'] = time () . ".jpg";						
			$oUserImage = UserImage::where ( "user_id", $post ["user_id"] )->first ();
			if(!$oUserImage)
				$oUserImage = new UserImage();
			if (! empty ( $oUserImage )) {
				$oUserImage->updated_dttm = date ( 'Y-m-d H:i:s' );
			} else {
				$oUserImage = new UserImage ();
				$oUserImage->created_dttm = date ( 'Y-m-d H:i:s' );
			}

			$oUserImage->is_active =  1;
			$oUserImage->user_id = $user_id;
			$oUserImage->image_path = $post ['image_path'];
			$base64img = str_replace ( 'data:image/jpeg;base64,', '', $post ['imagecontent'] );
			file_put_contents ( public_path () . "/upload/" . $post ['image_path'], base64_decode ( $base64img ) );
			$imagePath = public_path () . "/upload/" . $post ['image_path'];
			$destPath = public_path () . "/upload/thumbnail/" . $post ['image_path'];			
			$this->resizeImage($imagePath,$destPath);			
			if (! empty ( $oUserImage->id )) {				
				if ($oUserImage->update () === FALSE)
					return FALSE;
				else
					return TRUE;
			} else {
				if ($oUserImage->save () === FALSE)
					return FALSE;
				else
					return TRUE;
			}

		}

	}

	public function resizeImage($SrcImage,$DestImage){

		$MaxWidth      = 480; 
		$MaxHeight     = 320; 
		$Quality       = 80; 

	   list($iWidth,$iHeight,$type)    = getimagesize($SrcImage);
	   $ImageScale             = min($MaxWidth/$iWidth, $MaxHeight/$iHeight);
	   $NewWidth               = ceil($ImageScale*$iWidth);
	   $NewHeight              = ceil($ImageScale*$iHeight);
	   $NewCanves              = imagecreatetruecolor($NewWidth, $NewHeight);

	   switch(strtolower(image_type_to_mime_type($type))){
         case 'image/jpeg':
        		$NewImage = imagecreatefromjpeg($SrcImage);
         break;
	      case 'image/png':
	        	$NewImage = imagecreatefromjpeg($SrcImage);
	         break;
	      case 'image/gif':
	         $NewImage = imagecreatefromjpeg($SrcImage);
	         break;
	      default:
	         return false;
	    }

	    // Resize Image
	    if(imagecopyresampled($NewCanves, $NewImage,0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight)){
	        if(imagejpeg($NewCanves,$DestImage,$Quality)){
	            imagedestroy($NewCanves);
	            return true;
	        }
	    }
	}

	public function loginCheck() {
		$post = $this->getpostdata ( $_REQUEST );
		if (! empty ( $post ['password'] ) && (!empty ( $post ['user_name'] ) || !empty ( $post ['email'] )) ){
			if(isset($post['user_name']))
				$oUser = Users::where(array('user_name'=>$post ['user_name'],'password'=>md5 ( $post ['password'] ),'is_active'=>1,'role_id'=>0))->first();
			else
				$oUser = Users::where(array('email'=>$post ['email'],'password'=>md5 ( $post ['password'] ),'is_active'=>1,'role_id'=>0))->first();

			if ($oUser) {				
				if(isset($post['device_token'])){	
					$exist  = Users::where('device_token',$post['device_token'])->update(['device_token' => '']);
					$update = Users::where('id',$oUser->id)->update(['device_token' => $post['device_token']]);
				}					
				$result = $this->getUserDetailArray($oUser->id,$oUser->country);
				$response = $this->getReponse(TRUE,12,$result);	
			} else {
				$response = $this->getReponse(FALSE,9,FALSE);	
			}
		} else {
			$response = $this->getReponse(FALSE,13,FALSE);	
		}
		return $response;

	}


	public function adminLoginCheck() {
		$post = $this->getpostdata ( $_REQUEST );
		if (! empty ( $post ['password'] ) && (!empty ( $post ['user_name'] ) || !empty ( $post ['email'] )) ){
			$oUser = Users::getadminLogin($post ['user_name'],md5 ( $post ['password'] ));				
			if ($oUser) {				
				$result = $this->getUserDetailArray($oUser->id,$oUser->country);
				$response = $this->getReponse(TRUE,12,$result);
			} else {
				$response = $this->getReponse(FALSE,9,FALSE);
			}
		} else {
			$response = $this->getReponse(FALSE,13,FALSE);
		}
		return $response;	
	}

	public function userAvailablityCheck(){
		$post = $this->getpostdata($_REQUEST);
		if(!empty($post['column']) && !empty($post['value'])){
			$chkUsername =Users::where ( $post['column'], $post ["value"] )->first();
			if (!empty( $chkUsername )) {					
				$response = $this->getReponse(TRUE,8,TRUE);
			}
			else {
				$response = $this->getReponse(FALSE,9,FALSE);
			}
		}
		return $response;
	}

   public function forgotPassword(){
      $post = $this->getpostdata ( $_REQUEST );
	   if(!empty($post['column']) && !empty($post['value'])){
			$oUser = Users::where ( $post['column'], $post ["value"] )->first();
		}
		if ( !empty( $oUser ) ) {
        $newpassword = $this->randomPassword ();
        $oUser->password = md5 ( $newpassword );
        $oUser->updated_dttm = date ( 'Y-m-d H:i:s' );
        if ($oUser->update () === false) {
		  	$response = $this->getReponse(FALSE,5,FALSE);	
			} else {
            $fullname = ucwords ($oUser->first_name. " " .$oUser->last_name);
 				$this->SendPasswordToEmail($fullname, $oUser->email, $newpassword);
				$response = $this->getReponse(TRUE,19,$oUser);	
         }				
		} else {
			$response = $this->getReponse(FALSE,4,FALSE);	
		}

	   return $response;
   }

   public function changePassword(){
      $post = $this->getpostdata ( $_REQUEST );
	   if(!empty($post['user_id']) && !empty($post['password'])){
			 $oUser = Users::where ( array('id' => $post['user_id'],'password' => md5($post['old_password']),'is_active' => 1))->first();
		}

		if ( !empty( $oUser ) ) {
         $newpassword = $post['password'];
         $oUser->password = md5 ( $newpassword );
         $oUser->updated_dttm = date ( 'Y-m-d H:i:s' );
         if ($oUser->update () === false) {
		   	$response = $this->getReponse(FALSE,5,FALSE);	
			} else {
            $fullname = ucwords ($oUser->first_name. " " .$oUser->last_name);
 				$response = $this->getReponse(TRUE,24,$oUser);	
        }				
		} else {
			$response = $this->getReponse(FALSE,4,FALSE);	
		}
	   return $response;
   }

   public function randomPassword(){
   	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
   	$pass = array ();
   	$alphaLength = strlen ( $alphabet ) - 1;
   	for($i = 0; $i < 8; $i ++){
   		$n = rand ( 0, $alphaLength );
   		$pass [] = $alphabet [$n];
   	}
      return implode ( $pass );
   }

    public function SendPasswordToEmail($userName, $userEmail, $password){
      	$admin_email = "Admin<noreply@Mountain.com.au>";
		$userEmail   = $userEmail;
		$subject     = "Mountain";
		$message  	 = "Dear ". $userName . "<br/><br/>";
		$message 	.= "We received a request for reset password. Please find the new password below". "<br/><br/>";
		$message 	.= "Password: <b>". $password . "</b><br/><br/>";
		$message 	.= "Kind regards,". "<br/>";
		$message 	.= "The Mountain team";
		$headers 	 = "MIME-Version: 1.0" . "\r\n";
		$headers 	.= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers 	.= "From: {$admin_email}\r\nReply-To: {$admin_email}";
	   	if ($userEmail != ""){
	   		if (mail ( $userEmail, $subject, $message, $headers )){
	   			file_put_contents ( __DIR__ . "/mountain_request_log.txt", "password sent to " . $userEmail . "\n", FILE_APPEND | LOCK_EX );
	   		}
	   	}
   	}
     public function SendUserDetailsToEmail($userName, $userEmail, $password,$uname){
      	        $admin_email = "Admin<noreply@Mountain.com.au>";
		$userEmail   = $userEmail;
		$subject     = "Mountain";
$message  	 = '<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
  <tbody>
    <tr>
      <td width="10" bgcolor="#28354d" style="width:10px;background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d">&nbsp;</td>
      <td valign="middle" align="left" height="50" bgcolor="#28354d" style="background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d;padding:0;margin:0;width:35px"><a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="http://staging.mountainapi.globalit.net.au/" target="_blank">
          <img border="0" height="30" src="http://staging.mountainapi.globalit.net.au/public/images/HeaderBGLogo.png" style="border:none" class="CToWUd">
        </a></td>
      <td valign="middle" align="left" height="50" bgcolor="#28354d" style="background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d;padding:0;margin:0"><a style="text-decoration:none;outline:none;color:#ffffff;font-size:18px" href="#" target="_blank">
        Welcome Mail</a></td>
      <td width="10" bgcolor="#28354d" style="width:10px;background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d">&nbsp;</td>
    </tr>
  </tbody>
</table>

<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
  <tbody>
    <tr>
      <td align="left" valign="top" style="color:#2c2c2c;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:2px dashed #ccc;background-color:#f9f9f9;padding:20px" bgcolor="#F9F9F9"><p style="padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px"> Dear '.$userName.',
        </p>
        <br>
 <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px"> User Access Details:
         </p>
         <br>
        <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px"> User Name : '. $uname . '
         </p>
        <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px"> Password  : '. $password . '
         </p>
           <br>
        <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px"> Your username and password must be kept confidential. Please do not share this information with anyone.
         </p>
          <br>
        <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px"> Kind regards,
         </p>
        <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px"> The Mountain team
         </p></td>
    </tr>
  </tbody>
</table>';
		//$message  	 = "Dear ". $userName . "<br/><br/>";
                //$message  	 .= "Congratulations!". "<br/><br/>";
		//$message 	.= "This email confirms your registration with us". "<br/><br/>";
               // $message 	.= "User Name: <b>". $uname. "<br/><br/>";
		//$message 	.= "Password: <b>". $password . "</b><br/><br/>";
		//$message 	.= "Kind regards,". "<br/>";
		//$message 	.= "The Mountain team";
		$headers 	 = "MIME-Version: 1.0" . "\r\n";
		$headers 	.= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers 	.= "From: {$admin_email}\r\nReply-To: {$admin_email}";
	   	if ($userEmail != ""){
	   		if (mail ( $userEmail, $subject, $message, $headers )){
	   			file_put_contents ( __DIR__ . "/mountain_request_log.txt", "password sent to " . $userEmail . "\n", FILE_APPEND | LOCK_EX );
	   		}
	   	}
   	}

	public function getUserDetailArray($user_id,$country_id) {
		$currentMountain = $this->getCurrentMountain($user_id,$country_id);
		$result['user'] = Users::getUserProfile($user_id);
		if($result['user']->role_id!=0)
			$result['user']->role = Users::getUserRoles($result['user']->role_id);
		else
			$result['user']->role = Users::getUserRoles(0);
		$result['user']->mountain = $currentMountain;
		$result['user']->advertisingCount = count(Mountain::getMoutainList($country_id,0,0));
		$result['user']->privacy = 'http://www.google.com';
		$result['user']->terms = 'http://www.google.com';
		return $result;
	}	

	public function quickRegister(){
		$record['country'] = Country::where('is_active',1)->get();
		$record['state']   = State::where('is_active',1)->get();
		$response = $this->getReponse(TRUE,1,$record);		
		return $response;
	}

	public function getProfessionalDetails() {
 		$post = $this->getpostdata ( $_REQUEST );
 		if (isset ( $post ['user_id'] ) && ! empty ( $post ['user_id'] )) {
 			$oUser = Users::where(array('is_active'=>1,'id'=>$post ['user_id']))->first();
 			$attributes = Config::get('app.physical_attributes.'.$oUser->gender);
 			
	 		$record = array();
	 		$record['Accent']       = ReferenceDomain::getReferenceValuesByCode ('Accent');
			$record['ActingExp']    = ReferenceDomain::getReferenceValuesByCode ('ActingExp');
			$record['Language']     = ReferenceDomain::getReferenceValuesByCode ('Language');
			$record['ModelingExp']  = ReferenceDomain::getReferenceValuesByCode ('ModelingExp');
			$record['Agency']       = Users::select('agency_name','agency_website','agent_name','agent_number','agent_email')
									->where ('id',$post['user_id'])->first();

	 		foreach ($attributes as $key => $value) {
	 			$record[$value] 		= ReferenceDomain::getReferenceValuesByCode ($value);
	 		}
	 		if ($record) {
				$response = $this->getReponse(TRUE,1,$record);
			} else {
				$response = $this->getReponse(FALSE,2,FALSE);
			}

	 	}else {
	 		$response = $this->getReponse(FALSE,3,FALSE);		
	 	}	
			return $response;

	 }

	public function getFans(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) ){
			$oUserFollowers = UserFollowers::where(array('follower_id'=>$post['user_id'],'is_active'=>1))->count();
			if($oUserFollowers > 0){
				$result = UserFollowers::getFans($post['user_id']);
				$response = $this->getReponse(TRUE,1,$result);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getIdols(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) ){
			$oUserFollowers = UserFollowers::where(array('user_id'=>$post['user_id'],'is_active'=>1))->count();
			if($oUserFollowers > 0){
				$result = UserFollowers::getIdols($post['user_id']);
				$response = $this->getReponse(TRUE,1,$result);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	
	public function getUserPeaks(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) ){
			$oPeakTrack = PeakTrack::where(array('user_id'=>$post['user_id']))->count();
			$peakList = array();
			if($oPeakTrack > 0){
				$result = PeakTrack::getUserPeaks($post['user_id']);
				if($result){
					$i =0;
					foreach ($result as $key => $value) {
						$peakList[$i] = $value;
						$peakList[$i]->FeedsLike  = FeedsLike::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->count();
				      $peakList[$i]->FeedsView  = FeedsView::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->count();
						$peakList[$i]->judgeList  = MountainJudges::getJudge($value->mountain_id);
						$peakList[$i]->judgeList  = $this->isLiked($peakList[$i]->judgeList,$value->feed_id);
						$i++;
					}
					$response = $this->getReponse(TRUE,1,$peakList);		
				}
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function isLiked($result,$feed_id){
		foreach($result as $key => $value){
			$result[$key]->isLiked    = FeedsLike::where(array('feed_id'=>$feed_id,'is_active'=>1,'user_id'=>$value->judge_id))->exists();
			$result[$key]->isViewed   = FeedsView::where(array('feed_id'=>$feed_id,'is_active'=>1,'user_id'=>$value->judge_id))->exists();				
		}	
		return $result;	
	}

	public function setIdol(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) && isset($post['follower_id']) && !empty($post['follower_id'])){
			$oUserFollowers = UserFollowers::where(array('user_id'=>$post['user_id'],'follower_id'=>$post['follower_id'],'is_active'=>1))->first();
			if($oUserFollowers){
				$oUserFollowers->fill($post);
				$oUserFollowers->is_active = 0;
			} else {
				$oUserFollowers = new UserFollowers();
				$oUserFollowers->fill($post);
				$oUserFollowers->is_active = 1;
			}
			$oUserFollowers->created_dttm = date ( 'Y-m-d H:i:s' );
			if($oUserFollowers->save() === TRUE){
				$oUserFollowers->countFans  = count(UserFollowers::getFans($post['follower_id']));
			   $oUserFollowers->countIdols = count(UserFollowers::getIdols($post['follower_id']));
				$response = $this->getReponse(TRUE,1,$oUserFollowers);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getUserProfile(){
		$post = $this->getpostdata ( $_REQUEST );
		$result = array();
		if(isset($post['user_id']) && !empty($post['user_id']) || isset($post['viewprofile_id']) && !empty($post['viewprofile_id'])  ){
			if(isset($post['viewprofile_id']) && !empty($post['viewprofile_id']))
				$user_id = $post['viewprofile_id'];
			else
				$user_id = $post['user_id'];

			$result['userDetails']     = $this->editUserProfile($post['user_id']);
			$result['userDetails'] = Users::getUserProfile($user_id);
			$result['userDetails']->countFans  = count(UserFollowers::getFans($user_id));
			$result['userDetails']->countIdols = count(UserFollowers::getIdols($user_id));
			$result['userDetails']->countPeaks = PeakTrack::where('user_id',$user_id)->count();
			$result['userDetails']->popularity = '0.0';
			$result['userDetails']->judges     = '0';
			if(!isset($post['viewprofile_id']) && empty($post['viewprofile_id'])){
				$professional     = $this->editUserProfile($post['user_id']);
				if(isset($professional->accent))
					$result['userDetails']->accent      = $professional->accent;
				if(isset($professional->language))
					$result['userDetails']->language    = $professional->language;
				if(isset($professional->acting))
					$result['userDetails']->acting      = $professional->acting;
				if(isset($professional->modeling))
					$result['userDetails']->modeling    = $professional->modeling;
				$oUserAttributes = DB::table('user_attributes')->where('user_id',$user_id)->get();
				if($oUserAttributes && count($oUserAttributes) > 0) {
					foreach ($oUserAttributes[0] as $key => $value) {
						$result['userDetails']->$key = DB::table('reference_value')->select('id','value')->where('id',$value)->first();
					}
				}
			}


			if(isset($post['viewprofile_id']) && !empty($post['viewprofile_id']) && isset($post['user_id']) && !empty($post['user_id']))
				$result['userDetails']->isIdol  = UserFollowers::where(array('follower_id'=>$post['viewprofile_id'],'user_id'=>$post['user_id'],'is_active'=>1))->exists();
			if($result)			
				$response = $this->getReponse(TRUE,1,$result);		
			else
				$response = $this->getReponse(FALSE,4,FALSE);		
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function editUserProfile($user_id){
		$post = $this->getpostdata ( $_REQUEST );
		$result = array();

		if(isset($user_id) && !empty($user_id)){			
			$result['userDetails'] = Users::getUserProfile($user_id);			
			$oUserAttributes = DB::table('user_attributes')->where('user_id',$user_id)->get();
			if($oUserAttributes && count($oUserAttributes) > 0) {
				foreach ($oUserAttributes[0] as $key => $value) {
					$result['userDetails']->$key = DB::table('reference_value')->select('id','value')->where('id',$value)->first();
				}
			}

			$oAccent = DB::table('accent')->select('id','value')->where('user_id',$user_id)->get();
			if($oAccent && count($oAccent) > 0 ) {				
				 foreach ($oAccent as $key => $value) {
					$accent[] = DB::table('reference_value')->select('id','value')->where('id',$value->value)->first();	
				}
				$result['userDetails']->accent = $accent;	
			}
			$oLanguage = DB::table('language')->select('id','value')->where('user_id',$user_id)->get();
			if($oLanguage && count($oLanguage) > 0) {
				foreach ($oLanguage as $key => $value) {
					$language[] = DB::table('reference_value')->select('id','value')->where('id',$value->value)->first();	
				}
				$result['userDetails']->language = $language;	
			}

			$oActing  = Acting::where(array('user_id'=>$user_id,'is_active'=>1))->get();
			if($oActing && count($oActing) > 0){
				$result['userDetails']->acting = $oActing;
				$result['userDetails']->acting[0]->experince = DB::table('reference_value')->select('id','value')->where('id',$oActing[0]->experince)->first();
			}

			$oModeling  = Modeling::where(array('user_id'=>$user_id,'is_active'=>1))->get();
			if($oModeling && count($oModeling) > 0){
				$result['userDetails']->modeling = $oModeling;
				$result['userDetails']->modeling[0]->experince = DB::table('reference_value')->select('id','value')->where('id',$oModeling[0]->experince)->first();
			}

			if($result)			
				$response = $this->getReponse(TRUE,1,$result['userDetails']);		
			else
				$response = $this->getReponse(FALSE,4,FALSE);		
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $result['userDetails'];
	}


	public function updateProfile(){
		$post = $this->getpostdata($_REQUEST);
		if(isset($post['user_id']) && !empty($post['user_id'])){
			$result = '';
			if(isset($post['acting']) && !empty($post['acting'])){					
				$oActing = Acting::where(array('user_id'=> $post['user_id'],'is_active' =>1))->first();
				if(!$oActing)
					$oActing= new Acting();

				$oActing->fill($post['acting']);
				$oActing->user_id = $post['user_id'];
				$oActing->is_active = 1;
				$oActing->created_by = $post['user_id'];
				$oActing->created_dttm = date ( 'Y-m-d H:i:s' );
				$result = $oActing->save();
			}	
			if(isset($post['language']) && !empty($post['language'])) {

				foreach ($post['language'] as $key => $value) {							
					$oLanguage = Language::where(array('user_id'=> $post['user_id'],'value'=>$value,'is_active' =>1))->first();
					if(!$oLanguage)
						$oLanguage= new Language();

					$oLanguage->fill($value);
					$oLanguage->user_id = $post['user_id'];
					$oLanguage->is_active = 1;
					$oLanguage->created_by = $post['user_id'];
					$oLanguage->updated_by = $post['user_id'];
					$oLanguage->created_dttm = date ( 'Y-m-d H:i:s' );
					$result = $oLanguage->save();

				}			

			} 
			if(isset($post['accent']) && !empty($post['accent'])){				

				foreach ($post['accent'] as $key => $value) {							
					$oAccent = Accent::where(array('user_id'=> $post['user_id'],'value'=>$value,'is_active' =>1))->first();
					if(!$oAccent)
						$oAccent= new Accent();

					$oAccent->fill($value);
					$oAccent->user_id = $post['user_id'];
					$oAccent->is_active = 1;
					$oAccent->created_by = $post['user_id'];
					$oAccent->updated_by = $post['user_id'];
					$oAccent->created_dttm = date ( 'Y-m-d H:i:s' );
					$result = $oAccent->save();
				}							
			}
			if(isset($post['modeling']) && !empty($post['modeling'])){				

				$oModeling = Modeling::where(array('user_id'=> $post['user_id'],'is_active' =>1))->first();
				if(!$oModeling)
					$oModeling= new Modeling();

				$oModeling->fill($post['modeling']);
				$oModeling->user_id = $post['user_id'];
				$oModeling->is_active = 1;
				$oModeling->created_by = $post['user_id'];
				$oModeling->created_dttm = date ( 'Y-m-d H:i:s' );
				$result = $oModeling->save();										

			}
			if(isset($post['attributes']) && !empty($post['attributes'])){			

				$oUserAttributes = UserAttributes::where(array('user_id'=> $post['user_id'],'is_active' =>1))->first();
				if(!$oUserAttributes)
					$oUserAttributes= new UserAttributes();

				$oUserAttributes->fill($post['attributes']);
				$oUserAttributes->user_id = $post['user_id'];
				$oUserAttributes->is_active = 1;
				$oUserAttributes->created_by = $post['user_id'];
				$oUserAttributes->created_dttm = date ( 'Y-m-d H:i:s' );
				$result = $oUserAttributes->save();					

			} 
			if(isset($post['userdetails']) && !empty($post['userdetails'])){							    

				$oUser = Users::where(array('id'=> $post['user_id'],'is_active' =>1))->first();
				$oUser->fill($post['userdetails']);
				$result = $oUser->save();					

			} 
			if(isset($post['ProfileImage']) && !empty($post['ProfileImage'])){

				$result = $this->uploadProfileImage ( $post['user_id'], $post );
				if($result)
					$oUserImage = UserImage::select('image_path as ProfileImage')
										->where(array('user_id'=>$post['user_id'],'is_active'=>1))
										->first();
																			
			}
			
			if($result==TRUE){	
				$data = $this->editUserProfile($post['user_id']);	
				$oMountain = Mountain::where(array('country_id'=>$data->country_id,'is_active'=>2,'is_main'=>1))->first();
				if(!$oMountain){
					$createNewMountain = $this->createMountain($data->country_id,date ( 'Y-m-d H:00:00' ),1);					
					$createForthMountain = $this->createMountain($data->country_id,$createNewMountain->end_date,0);
				}

				$response = $this->getReponse(TRUE,1,$data);
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);
			}			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}

		return $response;
	}

	public function getUserFeeds(){

		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])){
			$feeds = Feeds::getUserFeeds($post['user_id'],$post['start'],$post['end']);
			if($feeds){
				$result = $this->getFeedsLikeCount($feeds,$post['start'],$post['user_id']);
				$response = $this->getReponse(TRUE,1,$result);		
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getFeedsLikeCount($result,$rank,$user_id=''){
		
		if($result){	
			foreach ($result as $key => $value) {			
				$result[$key]->FeedsLike  = FeedsLike::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->count();
				$result[$key]->FeedsView  = FeedsView::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->count();
				if($user_id){
					$result[$key]->isLiked    = FeedsLike::where(array('feed_id'=>$value->feed_id,'is_active'=>1,'user_id'=>$user_id))->exists();
					$result[$key]->isViewed   = FeedsView::where(array('feed_id'=>$value->feed_id,'is_active'=>1,'user_id'=>$user_id))->exists();				
				}
				$result[$key]->Total = $result[$key]->FeedsLike + $result[$key]->FeedsView;	
				$result[$key]->thumbnail = str_replace(".mp4", "", $value->feed_video).'.jpeg';			
				if($value->feed_id)		
					$result[$key]->feed_hash =  Mountain::getHashTag($value->feed_id);			
				else
					$result[$key]->feed_hash =  '';				
			}
				
			$collection = new Collection($result);
			$sorted  = $collection->sortByDesc('Count');
			$feeds  = $sorted->values()->all();						
			foreach ($feeds as $key => $value) {						
				$feeds[$key]->Rank = $rank + 1;
				$rank ++;					
			}			
			return $feeds;		
		} else {
			return FALSE;		
		}
	}	

	
	public function generateFeedRank($result,$rank){
		if($result){	
			foreach ($result as $key => $value) {			
				$result[$key]->FeedsLike  = FeedsLike::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->count();
				$result[$key]->FeedsView  = FeedsView::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->count();
				$result[$key]->isLiked    = FeedsLike::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->exists();
				$result[$key]->isViewed   = FeedsView::where(array('feed_id'=>$value->feed_id,'is_active'=>1))->exists();				
				$result[$key]->Total = $result[$key]->FeedsLike + $result[$key]->FeedsView;	
				$result[$key]->Rank = $rank + 1;
				$result[$key]->thumbnail = str_replace(".mp4", "", $value->feed_video).'.jpeg';
				$rank ++;					
			}	
			return $result;		
		} else {
			return FALSE;		
		}
	}	

	public function getCountry() {

		$post = $this->getpostdata ( $_REQUEST );	
		$record = Country::where('is_active',1)->get();
		if (! empty ( $record )) {
			$response = $this->getReponse(TRUE,1,$record);
		} else {
				$response = $this->getReponse(FALSE,4,FALSE);
		}		
		return $response;
	}

	public function getState() {
		$post = $this->getpostdata ( $_REQUEST );
		if (! empty ( $post ["country_id"] )) {
			$record = State::where('country_id',$post ["country_id"] )->get();				
			if (! empty ( $record )) {
				$response = $this->getReponse(TRUE,1,$record);			
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function getMountainList(){
		$post = $this->getpostdata ( $_REQUEST );

		if(isset($post['type']) && !empty($post['type']) ){	

			$type = $post['type'];

			$user_country_id = $post['user_country_id'];

			$feeds = '';			
			$result = '';
			$mountain = Mountain::getCurrentMountain($user_country_id);
			$data['uploadMountain'] = '';
			$data['uploadStatus'] = '';

			if($type == 'local') {
				if($mountain){
					$feeds = Mountain::getLocalMountainList($mountain->mountain_id,$post['start'],$post['end'],$user_country_id);				
					$data['uploadMountain'] = $mountain->mountain_id;
					$status = Feeds::getUploadStatus($post['user_id'],$mountain->mountain_id);
					if($status)
						$data['uploadStatus']  = TRUE;
					else
						$data['uploadStatus'] = FALSE;
				} 
			}

			if($type == 'global') {
				if(isset($post['country_id']) && !empty($post['country_id'])){
					$country_id = $post['country_id'];	
					$feeds = Mountain::getGlobalMountainList($post['start'],$post['end'],$country_id);						
				} else {
					$feeds = Mountain::getGlobalMountainList($post['start'],$post['end'],FALSE);	
				} 				
			}
			
			if($type == 'commercial') {				
				if(isset($post['mountain_id']) && !empty($post['mountain_id'])){
					$feeds = Mountain::getCommercialMountainList($post['mountain_id'],$post['start'],$post['end']);	
					$data['uploadMountain'] = $post['mountain_id'];
					$status =  Feeds::getUploadStatus($post['user_id'],$post['mountain_id']);	
					if($status)
						$data['uploadStatus']  = TRUE;	
					else
						$data['uploadStatus'] = FALSE;		
				} 
			} 
						
			if($feeds){				
				$result = $this->getFeedsLikeCount($feeds,$post['start'],$post['user_id']);				
			} 
	      		      							
			$data['feeds']           = $result;	
			$data['type']            = $type;
			$data['start']           = $post['start'];
			$data['end']             = $post['end'];															
			
			$response = $this->getReponse(TRUE,1,$data);	
			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}			
		return $response;
	}
	

	public function getUserCountryList(){
		$record = Users::getUserCountryList();
		if($record){
			$response = $this->getReponse(TRUE,1,$record);
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function getCurrentMountain($user_id,$country_id) {

		$oMountainPeak = Mountain::getCurrentMountain($country_id);	
		if($oMountainPeak) {
			$oUserFeed  = Feeds::where(array('user_id'=>$user_id,'peak_id'=>$oMountainPeak->peak_id,'is_active'=>1))->first();
			if($oUserFeed) {
				$oMountainPeak->feed_id = $oUserFeed->id;
				$oMountainPeak->FeedsLike  = FeedsLike::where(array('feed_id'=>$oUserFeed->id,'is_active'=>1))->count();
				$oMountainPeak->FeedsView  = FeedsView::where(array('feed_id'=>$oUserFeed->id,'is_active'=>1))->count();
			} else {
				$oMountainPeak->feed_id = '';
				$oMountainPeak->FeedsLike = '';
				$oMountainPeak->FeedsView = '';
			}
		} else {
			$oMountainPeak = new Mountain();
			$oMountainPeak->id = '';
			$oMountainPeak->mountain_name = '';
		}
		return $oMountainPeak;
	}

	public function getAdvertising() {
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['country_id']) && !empty($post['country_id']) ){			
			$oMountain = Mountain::getMoutainList($post['country_id'],0,0);

			$today     = date ( 'Y-m-d' ) ;
			$list['current'] = array();
			$list['forth']   = array();
			$i =0;
			foreach ($oMountain as $key => $value) {
				$start_date = date("Y-m-d", strtotime($value->start_date));
				$end_date   = date("Y-m-d", strtotime($value->end_date));	

				if ($value->is_active == 2) {
					$list['current'][] = $value;
				}
				if ($value->is_active == 3) {
					$list['forth'][] = $value;
				}
				$i++;
			}
			if($list){				
				$response = $this->getReponse(TRUE,1,$list);	
			} else {					
				$response = $this->getReponse(FALSE,4,FALSE);			
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function getMountainInfo() {
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['country_id']) && !empty($post['country_id']) ){									
			$oMountain = Mountain::getMoutainByCountry($post['country_id'],1);
			$today     = date ( 'Y-m-d' );
			$list['current']      = array();
			$list['forth']      = array();
			$i =0;
			foreach ($oMountain as $key => $value) {
				$value->judges = MountainJudges::getJudge($value->mountain_id);
				foreach ($value->judges as $keys => $values) {
					$value->judges[$keys]->mountainCount = MountainJudges::where(array('judge_id'=>$values->judge_id,'is_active'=>1))->count();
					$value->judges[$keys]->msgCount = UserInbox::where(array('user_id'=>$values->judge_id,'is_active'=>1))->count();
					$value->judges[$keys]->touchCount =  $value->judges[$keys]->msgCount;
				}
				$start_date = date("Y-m-d", strtotime($value->start_date));
				$end_date   = date("Y-m-d", strtotime($value->end_date));
				if ($value->is_active == 2) {
					$list['current'][] = $value;
				}
				if ($value->is_active == 3) {
					$list['forth'][] = $value;
				}
				$i++;
			}
			if($list['current'])
				$list['current'] = array_slice($list['current'], 0, 1);
			if($list['forth'])
				$list['forth'] = array_slice($list['forth'], 0, 1);
			if($list){				
				$response = $this->getReponse(TRUE,1,$list);	
			} else {					
				$response = $this->getReponse(FALSE,4,FALSE);			
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}			
		return $response;
	}



	public function getMountainListById(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['country_id']) && !empty($post['country_id']) ){						
			if(!empty($post['start']) && empty($post['end'])){
				$pageSize = 10;
				$pageNumber = $post['start'];
				$from = ($pageNumber - 1) * $pageSize;
				$to = $pageNumber * $pageSize;
				$post['start']=$from;
				$post['end']=$pageSize;
			}else{
				$post['start']=$post['start'];
				$post['end']=$post['end'];
			}
			$feeds = Mountain::getMountainListById($post['start'],$post['end'],$post['country_id'],$post['mountain_id'],$post['peak_id'],$post['search_tag']);
			if($feeds){				
				$result = $this->getFeedsLikeCount($feeds,$post['start']);			
				$data['feeds'] = $result;
				$response = $this->getReponse(TRUE,1,$data['feeds']);	
			} else {					
				$response = $this->getReponse(FALSE,4,FALSE);			
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}			
		return $response;
	}


	public function uploadVideo(){
		$post = $this->getpostdata ( $_REQUEST );
		

		if(isset($post['user_id']) && !empty($post['user_id']) ){
			$post ['mediatype']    = $post ['mediatype'];
			$post ['filetype']     = $post ['filetype'];
	        $post ['imagecontent'] = $_FILES ['imagecontent'];
	        $post ['imagepath'] = time () . "." . $post ['filetype'];	
			$post ['thumbnail_image'] = time () . "." . 'jpeg';			
			$outputFile = public_path () . "/feed/" . $post ['imagepath'];
			$thumbnail = public_path () . "/feed/thumbnail/" . $post ['thumbnail_image'];			
			try {				
				
				if(move_uploaded_file($post['imagecontent']['tmp_name'],$outputFile)){					
					$base64img = str_replace ( 'data:image/jpeg;base64,', '', $post ['thumbnail'] );
					file_put_contents ( $thumbnail, base64_decode ( $base64img ) );
				}

				$feeds = Feeds::getUploadStatus($post['user_id'],$post['mountain_id']);
				if($feeds){
					$oFeeds = Feeds::where('id',$feeds->id)->first();					
					$oFeeds->peak_id      = $feeds->peak_id;
					$oFeeds->user_id      = $post ['user_id'];
					$oFeeds->country_id   = $feeds->country_id;
					$oFeeds->description  = $post ['description'];
					$oFeeds->video_name   = $post ['imagepath'];
					$oFeeds->updated_dttm = date ( 'Y-m-d H:i:s' );
					$result = $oFeeds->save ();
					if($result){
						$feedsLike = FeedsLike::where('feed_id',$feeds->id)->update(array('is_active'=>0));
						$feedsView = FeedsView::where('feed_id',$feeds->id)->update(array('is_active'=>0));
					}
					
				} else {
					$feeds = Mountain::getMountainActivePeak($post['mountain_id']);
					$oFeeds = new Feeds ();
					$oFeeds->peak_id      = $feeds->peak_id;
					$oFeeds->user_id      = $post['user_id'];
					$oFeeds->country_id   = $feeds->country_id;
					$oFeeds->description  = $post['description'];
					$oFeeds->video_name   = $post ['imagepath'];
					$oFeeds->created_by   = $post ['user_id'];
					$oFeeds->updated_by   = $post ['user_id'];
					$oFeeds->created_dttm = date ( 'Y-m-d H:i:s' );
					$oFeeds->updated_dttm = date ( 'Y-m-d H:i:s' );
					$result = $oFeeds->save ();
				}
				if ($result) {
					$oFeeds->thumbnail = $post ['thumbnail_image'];
					$this->registerHashTag($post['user_id'],$post['description'],$oFeeds->id);
					$response = $this->getReponse(TRUE,15,$oFeeds);
				} else {
						$response = $this->getReponse(FALSE,14,FALSE);
				}
				

			} catch(Exception $error) {
			    $response = $this->getReponse(FALSE,3,$error);
			}

		} else {
				$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}


	public function getHashTag(){

		$oHashTagMaster = HashTagMaster::where('is_active',1)->get();
		if($oHashTagMaster)
			$response = $this->getReponse(TRUE,1,$oHashTagMaster);
		else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}


	public function deleteFeed(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['feed_id']) && !empty($post['feed_id'])){
		 	$oFeeds = Feeds::where(array('id'=>$post['feed_id'],'is_active'=>1))->first();
			if($oFeeds){
				$oFeeds->is_active = 0;
				$oFeeds->updated_dttm = date ( 'Y-m-d H:i:s' );
				if ($oFeeds->save () === TRUE) {
					$response = $this->getReponse(TRUE,7,$oFeeds);
				} else {				
					$response = $this->getReponse(FALSE,5,FALSE);
				}
			} else {				
					$response = $this->getReponse(FALSE,4,FALSE);
			}	
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function repostFeed(){		
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['feed_id']) && !empty($post['feed_id']) && isset($post['peak_id']) && !empty($post['peak_id'])){
		 	$existFeeds = Feeds::where(array('user_id'=>$post['user_id'],'peak_id'=>$post['peak_id'],'is_active'=>1))->first();						
			$oFeed = Feeds::where('id',$post['feed_id'])->first();
			// If exists video against current mountain update feed
			if($existFeeds) {
				$existFeeds->video_name   = $oFeed->video_name;
				$existFeeds->created_by   = $oFeed->created_by;
				$existFeeds->updated_by   = $oFeed->updated_by;
				$existFeeds->is_active    = 1;	
				$existFeeds->description  = $oFeed->description;
				$existFeeds->peak_id  = $post['peak_id'];	
				$existFeeds->updated_dttm = date ( 'Y-m-d H:i:s' );				
				$result = $existFeeds->save();	
				$newFeed = $existFeeds;
			} 
			// Create new feed against current mountain
			else { 
				$oFeed->created_dttm = date ( 'Y-m-d H:i:s' );	
				$newFeed = $oFeed->replicate();		
				$newFeed->peak_id  = $post['peak_id'];	
				$result = $newFeed->save();				
			}			
			if ($result == TRUE) {
				$newFeed->feed_id = $newFeed->id;
				$oFeed = Feeds::find($post['feed_id'])->update(array('is_reposted'=>1));
				$response = $this->getReponse(TRUE,21,$newFeed);
			} else {				
				$response = $this->getReponse(FALSE,5,FALSE);
			}				
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function registerHashTag($user_id,$description,$feed_id){
		preg_match_all('/#(\w+)/',$description,$matches);
		$hash_tag = $matches[0];		
		if($hash_tag){	
			foreach ($hash_tag as $key => $value) {
				$oHashTagMaster = HashTagMaster::where(array('feed_id'=>$feed_id,'hash_tag'=>$value,'is_active'=>1))->first();
				if(!$oHashTagMaster){
					$oHashTagMaster = new HashTagMaster();
				}	
				$oHashTagMaster->hash_tag = $value;
				$oHashTagMaster->feed_id  = $feed_id;
				$oHashTagMaster->created_dttm = date ( 'Y-m-d H:i:s' );
				
				if($oHashTagMaster->save() == TRUE){

					$oFeedTrendingTag = new FeedTrendingTag();
					$oFeedTrendingTag->feed_id = $feed_id;
					$oFeedTrendingTag->user_id = $user_id;
					$oFeedTrendingTag->hash_tag_id = $oHashTagMaster->id;
					$oFeedTrendingTag->trending_dttm = date ( 'Y-m-d H:i:s' );
					if($oFeedTrendingTag->save() == TRUE)
						$status =  TRUE;
					else
						$status =  FALSE;
				}else{
					$status =  FALSE;
				}
			}
			return $status;
		} else {
			return FALSE;
		}
	}


	public function feedLike(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) && isset($post['feed_id']) && !empty($post['feed_id'])){
			$oFeedsLike = FeedsLike::where(array('user_id'=>$post['user_id'],'feed_id'=>$post['feed_id'],'is_active'=>1))->first();
			if($oFeedsLike){
				$oFeedsLike->fill($post);
				$oFeedsLike->is_active = 0;
			} else {
				$oFeedsLike = new FeedsLike();
				$oFeedsLike->fill($post);
				$oFeedsLike->is_active = 1;
			}
			$oFeedsLike->like_dttm = date ( 'Y-m-d H:i:s' );
			if($oFeedsLike->save() === TRUE){
				$oFeedsLike->countLike = FeedsLike::where(array('feed_id'=>$post['feed_id'],'is_active'=>1))->count();
				$oFeedsLike->countView = FeedsView::where(array('feed_id'=>$post['feed_id'],'is_active'=>1))->count();
				$response = $this->getReponse(TRUE,1,$oFeedsLike);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function feedView(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) && isset($post['feed_id']) && !empty($post['feed_id'])){
			$oFeedsView = FeedsView::where(array('user_id'=>$post['user_id'],'feed_id'=>$post['feed_id'],'is_active'=>1))->first();
			if(!$oFeedsView){
				$oFeedsView = new FeedsView();
				$oFeedsView->fill($post);
				$oFeedsView->is_active = 1;
				$oFeedsView->viewed_dttm = date ( 'Y-m-d H:i:s' );
				if($oFeedsView->save() === TRUE){
					$oFeedsView->countLike = FeedsLike::where(array('feed_id'=>$post['feed_id'],'is_active'=>1))->count();
					$oFeedsView->countView = FeedsView::where(array('feed_id'=>$post['feed_id'],'is_active'=>1))->count();
					$response = $this->getReponse(TRUE,1,$oFeedsView);		
				}else{
					$response = $this->getReponse(FALSE,4,FALSE);		
				}
			} else {
				$response = $this->getReponse(FALSE,20,FALSE);	
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}


	public function feedAbuse(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) && isset($post['feed_id']) && !empty($post['feed_id'])){
			$oFeedsAbused = FeedsAbused::where(array('user_id'=>$post['user_id'],'feed_id'=>$post['feed_id'],'is_active'=>1))->first();
			if($oFeedsAbused){
				$oFeedsAbused->fill($post);
			} else {
				$oFeedsAbused = new FeedsAbused();
				$oFeedsAbused->fill($post);
				$oFeedsAbused->is_active = 1;
			}
			$oFeedsAbused->reported_dttm = date ( 'Y-m-d H:i:s' );
			if($oFeedsAbused->save() === TRUE){
				$response = $this->getReponse(TRUE,1,$oFeedsAbused);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getConversation(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {
			$oUserInbox = UserInbox::getConversation($post['sender_id'],$post['user_id']);
			if($oUserInbox){
				$update = UserInbox::updateConversation($post['sender_id'],$post['user_id']);
				$response = $this->getReponse(TRUE,1,$oUserInbox);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	
	public function receiveMessage(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {
			$oUserInbox = UserInbox::receiveMessage($post['sender_id'],$post['user_id']);
			if($oUserInbox){
				$update = UserInbox::updateConversation($post['sender_id'],$post['user_id']);
				$response = $this->getReponse(TRUE,1,$oUserInbox);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function deleteConversation(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {						
			$oUserInbox = UserInbox::deleteConversation($post['user_id'],$post['sender_id']);			
			if($oUserInbox){
				$response = $this->getReponse(TRUE,1,$oUserInbox);						
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getMessageHistory(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {
			$oUserInbox = UserInbox::getMessageHistory($post['user_id']);
			if($oUserInbox){
				foreach($oUserInbox as $key => $value){
					$oUserInbox[$key]->unread = UserInbox::getUnreadCount($value->user_id,$value->sender_id);						
				}
				$response = $this->getReponse(TRUE,1,$oUserInbox);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function sendMessage(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) && isset($post['sender_id']) && !empty($post['sender_id'])){
			$oUserInbox = new UserInbox();
			$oUserInbox->fill($post);
			$oUserInbox->is_active = 1;	
			$oUserInbox->is_read = 0;	
			$oUserInbox->created_by = $post['user_id'];		
			$oUserInbox->created_dttm = date ( 'Y-m-d H:i:s' );
			if($oUserInbox->save() === TRUE){
                $oSender = Users::where(array('id'=>$post['user_id']))->first();
 				$oUser = Users::where(array('id'=>$post['sender_id']))->first();
                $messagecounts=UserInbox::getAllUnreadCount($post['user_id']);
               
                $this->sendAPNNotification($oUser->device_token,$oSender->first_name,'',$post['message'],1,$messagecounts);
				$response = $this->getReponse(TRUE,16,$oUserInbox);		
			}else{
				$response = $this->getReponse(FALSE,17,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

public function sendAPNNotification($deviceToken, $name, $image, $message, $senderid, $messagecounts) {
  
	  $passphrase = 'invigor';

	  $ctx = stream_context_create ();
	  stream_context_set_option ( $ctx, 'ssl', 'local_cert', "apns-pro.pem" );
	  stream_context_set_option ( $ctx, 'ssl', 'passphrase', $passphrase );
	  stream_context_set_option ( $ctx, 'ssl', 'cafile', "entrust_2048_ca.cer" );
  
	  // For live
	  $fp = stream_socket_client ( 'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx );
  
	  // for testing APNS
	   //$fp = stream_socket_client ( 'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx );
  
	  if (! $fp)
	   return false;

		$message = $this->unescape_utf16($message);
  
	  // Create the payload body
	  $consolidatedmsg = ucfirst ( $this->unescape_utf16($name)) . ": " . $message . "";
  
	  $body ['aps'] = array (
		'alert' => $consolidatedmsg,
		'sound' => 'default',
		'senderid' => $senderid,    
		'name' => $this->unescape_utf16($name),
		'image' => $image,
		'badge' => ( int ) $messagecounts 
	  );
  
	  // Encode the payload as JSON
	  $payload = json_encode ( $body );
  
	  // Build the binary notification
	  $msg = chr ( 0 ) . pack ( 'n', 32 ) . pack ( 'H*', $deviceToken ) . pack ( 'n', strlen ( $payload ) ) . $payload;
  
	  // Send it to the server
	  $result = fwrite ( $fp, $msg, strlen ( $msg ) );
	  if (! $result)
	   return false;
	  else
	   return true;
   
	  // Close the connection to the server
	  fclose ( $fp );
	}
 
	
	public function unescape_utf16($string) {

	  $string = preg_replace_callback(
		'/\\\\u(D[89ab][0-9a-f]{2})\\\\u(D[c-f][0-9a-f]{2})/i',
		function ($matches) {
		 $d = pack("H*", $matches[1].$matches[2]);
		 return mb_convert_encoding($d, "UTF-8", "UTF-16BE");
		}, $string);

	  $string = preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
		function ($matches) {
		 $d = pack("H*", $matches[1]);
		 return mb_convert_encoding($d, "UTF-8", "UTF-16BE");
		}, $string);
		return $string;
	 }

	public function setMessageMarked(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['message_id']) && !empty($post['message_id'])) {
			$oUserInbox = UserInbox::where(array('id'=>$post['message_id'],'is_active'=>1))->first();
			if($oUserInbox) {
				$oUserInbox->$post['name'] = $post['value'];
				$oUserInbox->updated_dttm = date ( 'Y-m-d H:i:s' );
 				if($oUserInbox->save() == TRUE){
					$response = $this->getReponse(TRUE,1,$oUserInbox);	
				} else {
					$response = $this->getReponse(FALSE,2,FALSE);	
				}
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}




	public function getJudgeDetail(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])){
			$oUser = Users::getUserProfile($post['user_id']);
			if($oUser){
				$response = $this->getReponse(TRUE,1,$oUser);		
			}else{
				$response = $this->getReponse(FALSE,2,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function updateJudgeProfile(){
		$post = $this->getpostdata ( $_REQUEST );		
		if(isset($post['id']) && !empty($post['id'])){
			$oUser = Users::where(array('id'=>$post['id'],'is_active'=>1))->first();
			if($oUser) {
				$oUser->fill($post);
				if($oUser->save() == TRUE){
					$result = $this->uploadProfileImage ( $post['id'], $post );
					$response = $this->getReponse(TRUE,1,$oUser);		
				} else{
					$response = $this->getReponse(FALSE,5,FALSE);		
				}	
			} else {
				$response = $this->getReponse(FALSE,2,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	
	public function getMountainJudges(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['mountain_id']) && !empty($post['mountain_id'])){
			$oMountain = Mountain::select('country_id')->where('id',$post['mountain_id'])->first();						
			if($oMountain)
				$oMountainJudges = MountainJudges::getCountryAllJudges($oMountain->country_id,$post['mountain_id']);
			else
				$oMountainJudges = '';
			if($oMountainJudges){
				foreach ($oMountainJudges as $key => $value) {
					$oMountainJudges[$key]->mountainCount = MountainJudges::where(array('judge_id'=>$value->judge_id,'is_active'=>1))->count();
					$oMountainJudges[$key]->msgCount = UserInbox::where(array('user_id'=>$value->judge_id,'is_active'=>1))->count();
					$oMountainJudges[$key]->touchCount =  $oMountainJudges[$key]->msgCount;
				}
				$response = $this->getReponse(TRUE,1,$oMountainJudges);		
			}else{
				$response = $this->getReponse(FALSE,2,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getPeakWeek(){
		$post = $this->getpostdata ( $_REQUEST );
		if( isset($post['mountain_id']) && !empty($post['mountain_id']) && isset($post['country_id']) && !empty($post['country_id']) ) {																	
			$feeds = Mountain::getPeakWeek($post['mountain_id'],$post['country_id'],$post['user_id']);
			if($feeds){				
				$i =0;
				$peakList = array();
				foreach ($feeds as $key => $value) {
					$this_index = $value->peak_index;
					$peakList[$this_index][$i] = $value;	
					$peakList[$this_index][$i]->judgeList  = MountainJudges::getJudge($value->mountain_id);
					$peakList[$this_index][$i]->judgeList  = $this->isLiked($peakList[$this_index][$i]->judgeList,$value->feed_id);
					$i++;
				}								
				foreach ($peakList as $key => $value) {
					$this_index = $key;
					$peakList[$this_index] = array_slice($peakList[$key],0,10);
					$peakList[$this_index] = $this->getFeedsLikeCount($peakList[$key],0,$post['user_id']);
				}
				$response = $this->getReponse(TRUE,1,$peakList);	
			} else {					
				$response = $this->getReponse(FALSE,4,FALSE);			
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}			
		return $response;
	}
	
	public function getFansActivityList(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])){			
			$feedList   = Users:: getFansActivityList($post['user_id']);
			if($feedList){
				$activityList = array();
				foreach ($feedList as $key => $value) {
					$activityList[$key]['ActivityDate'] = $value->ActivityDate;
					$activityList[$key]['Type'] = $value->Type;					
					$activityList[$key]['from_user']['first_name'] = $value->first_name;
					$activityList[$key]['from_user']['family_name'] = $value->family_name;
					$activityList[$key]['from_user']['ProfileImage'] = $value->ProfileImage;
					$activityList[$key]['from_user']['user_name'] = $value->user_name;										
					$activityList[$key]['to_user']['user_id'] = $post['user_id'];
					$user = Users::getUserProfile($post['user_id']);
					$activityList[$key]['to_user']['user_name'] = $user->user_name;
					if($value->Type ==  'isLike'){
						$activityList[$key]['from_user']['user_id'] = $value->user_id;
						$activityList[$key]['feed']['feed_id'] = $value->ref_id;
						$activityList[$key]['feed']['thumbnail'] = $value->thumbnail;
					} else {
						$activityList[$key]['from_user']['user_id'] = $value->ref_id;
					}		
				}				
				$response = $this->getReponse(TRUE,1,$activityList);	
			}else {
				$response = $this->getReponse(FALSE,4,FALSE);	
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}
		return $response;
	}

	public function getIdolsActivityList(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])){

			$getUserIdolslist = Users::getUserIdolsActivityList($post['user_id']);
			$oUserFollowing = UserFollowers::getIdols($post['user_id']);
			$activityList1 = array();
			$activityList2=array();
			if($getUserIdolslist){
				foreach ($getUserIdolslist as $key => $value) {
					$activityList1[$key]['ActivityDate'] = $value->ActivityDate;
					$activityList1[$key]['Type'] = $value->Type;				
					$activityList1[$key]['from_user']['user_id'] = $value->user_id;	
					$user = Users::getUserProfile($post['user_id']);
					$activityList1[$key]['from_user']['user_name'] = $value->user_name;
					$activityList1[$key]['from_user']['first_name'] = $value->first_name;
					$activityList1[$key]['from_user']['family_name'] = $value->family_name;
					$activityList1[$key]['from_user']['ProfileImage'] = $value->ProfileImage;
					if($value->Type ==  'isLike'){
						$activityList1[$key]['feed']['feed_id'] = $value->ref_id;
						$activityList1[$key]['feed']['thumbnail'] = $value->thumbnail;
					} 
					$activityList1[$key]['to_user']['user_id'] = $post['user_id'];
					$activityList1[$key]['to_user']['user_name'] = $user->user_name;										
				}		
			}
			
						
			if($oUserFollowing){
				$activityList=array();				
				$i =0;
				foreach ($oUserFollowing as $keys => $values) {

					if($values->user_id){
						$activityList[$i]['user'][] = Users::getIdolsActivityList($values->user_id,$values->idol_dttm);
						
						$i++;
					}					
				}

				foreach ($activityList as $keys => $values) {
					foreach($values['user'] as $val){
				        $getIdolsList[] = $val;
				    }				
				}

				$getIdolsList = $this->array_flatten($getIdolsList);

				foreach ($getIdolsList as $key => $value) {
					$activityList2[$key]['ActivityDate'] = $value->ActivityDate;
					$activityList2[$key]['Type'] = $value->Type;				
					
					if($value->Type ==  'isLike'){
						$activityList2[$key]['feed']['feed_id'] = $value->ref_id;
						$activityList2[$key]['feed']['thumbnail'] = $value->thumbnail;
						$activityList2[$key]['from_user']['user_id'] = $value->user_id;	
						$user = Users::getUserProfile($value->user_id);
						$activityList2[$key]['from_user']['user_name'] = $user->user_name;
						$activityList2[$key]['from_user']['first_name'] = $user->first_name;
						$activityList2[$key]['from_user']['family_name'] = $user->family_name;
						$activityList2[$key]['from_user']['ProfileImage'] = $user->ProfileImage;
					} else {
						$activityList2[$key]['from_user']['user_id'] = $value->ref_id;	
						$user = Users::getUserProfile($value->user_id);
						$activityList2[$key]['from_user']['user_name'] = $value->user_name;
						$activityList2[$key]['from_user']['first_name'] = $value->first_name;
						$activityList2[$key]['from_user']['family_name'] = $value->family_name;
						$activityList2[$key]['from_user']['ProfileImage'] = $value->ProfileImage;
						$activityList2[$key]['to_user']['user_id'] = $user->user_id;
						$activityList2[$key]['to_user']['user_name'] = $user->user_name;
					}
															
				}	
			}
			$result = array_merge($activityList1,$activityList2);	

			if($result){				
				$collection   = new Collection($result);
				$sorted       = $collection->sortByDesc('ActivityDate');
				$result = $sorted->values()->all();	
				$response = $this->getReponse(TRUE,1,$result);
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);	
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function array_flatten($array) { 
	   if (!is_array($array)) { 
	     return FALSE; 
	   } 
	   $result = array(); 
	   foreach ($array as $key => $value) { 
		   if (is_array($value)) { 
		      $result = array_merge($result, array_flatten($value)); 
		   }  else { 
		      $result[$key] = $value; 
		   } 
	   } 
	  return $result; 
	} 

	public function getSearchUserDetail(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {				
			$users =  Users::getSearchUserDetail($post['user_id'],$post['value']);
			if($users) {
				$response = $this->getReponse(TRUE,1,$users);
			} else {	
				$response = $this->getReponse(FALSE,4,FALSE);
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

   public function getSearchFeedTagDetail(){
		$post = $this->getpostdata ( $_REQUEST );
		$sfeed =  Mountain::searchFeedTagDetails($post['start'],$post['end'],$post['search_tag']);
		if($sfeed) {
			$result = $this->getFeedsLikeCount($sfeed,$post['start'],$post['user_id']);			
			$response = $this->getReponse(TRUE,1,$result);
		} else {
			$response = $this->getReponse(FALSE,4,FALSE);
		}
		return $response;
	}

	public function getFeedRelatedTags(){
		$post = $this->getpostdata ( $_REQUEST );
		$sfeed =  Mountain::searchFeedTagDetails(FALSE,FALSE,$post['search_tag']);
		if($sfeed) {
			foreach ($sfeed as $key => $value) {			
				$hash[] =  Mountain::getHash($value->feed_id);
			}
			$list = array_reduce($hash, 'array_merge', array());
			foreach ($list as $key => $value) {			
				$result[] =  $value->feed_hash;
			}
			$result = array_unique($result);
			$response = $this->getReponse(TRUE,1,$result);
		} else {
			$response = $this->getReponse(FALSE,4,FALSE);
		}
		return $response;
	}
    
   public function getSearchTagDetail(){
		$post = $this->getpostdata ( $_REQUEST );	
		$sfeed =  Mountain::searchTagDetails($post['search_tag']);
		if($sfeed){
			$response = $this->getReponse(TRUE,1,$sfeed);
		} else {
			$response = $this->getReponse(FALSE,4,FALSE);
		}
		return $response;
	}

	public function getSearchTreandingTagDetail(){
		$post = $this->getpostdata ( $_REQUEST );	
		$sfeed =  Mountain::searchTrendingTagDetails($post['search_tag']);
		if($sfeed){				
			$response = $this->getReponse(TRUE,1,$sfeed);
		} else {	
			$response = $this->getReponse(FALSE,4,FALSE);
		}
		return $response;
	}  

	public function getIdolsMountainList(){	
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {
			if(isset($post['mountain_id']) && !empty($post['mountain_id']) )
				$mountain_id = $post['mountain_id'];
			else
				$mountain_id = FALSE;

			if(isset($mountain_id) && !empty($mountain_id))
				$feeds = Mountain::getIdolsFeedList($post['start'],$post['end'],$post['user_id'],$mountain_id);
			else
				$feeds = '';

			if($feeds){
				$result = $this->getFeedsLikeCount($feeds,$post['start'],$post['user_id']);
			} else {
				$result = '';
			}	

			$result = $this->getFeedsLikeCount($feeds,$post['start'],$post['user_id']);
			$data['feeds'] = $result;
			$data['start'] = $post['start'];
			$data['end']   = $post['end'];
			$response = $this->getReponse(TRUE,1,$data);	
					
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function saveSocial(){	
		$post = $this->getpostdata ( $_REQUEST );	
		if(isset($post['user_id']) && !empty($post['user_id'])) {		
			$source_id   = $post['source_id'];
			$source_type = $post['source_type'];
			$oSocialMapping = SocialMapping::where(array('source_type'=>$source_type,'user_id'=>$post['user_id'],'is_active'=>1))->first();
			if(!$oSocialMapping){
				$oSocialMapping = new SocialMapping();
			} 
			if($oSocialMapping){
				$oSocialMapping->fill ( $post );
				$oSocialMapping->created_dttm = date ( 'Y-m-d H:i:s' );
				if ($oSocialMapping->save () === TRUE) {
					$response = $this->getReponse(TRUE,25,$oSocialMapping);	
				} else {				
					$response = $this->getReponse(FALSE,5,$result);	
				}		
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);
			}		
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function unlinkSocial(){
		$post = $this->getpostdata ( $_REQUEST );	
		if(isset($post['user_id']) && !empty($post['user_id'])) {			
			$source_id   = $post['source_id'];
			$source_type = $post['source_type'];
			$oSocialMapping = SocialMapping::where(array('source_type'=>$source_type,'user_id'=>$post['user_id'],'is_active'=>1))->first();
			if($oSocialMapping){
				$oSocialMapping->is_active = 0;
				if ($oSocialMapping->save () === TRUE) {
					$response = $this->getReponse(TRUE,1,$oSocialMapping);	
				} else {					
					$response = $this->getReponse(FALSE,5,$result);	
				}
			} else {
				$response = $this->getReponse(FALSE,4,FALSE);
			}		
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function getSocial(){	
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {
			$source_id   = $post['source_id'];
			$source_type = $post['source_type'];
			$oSocialMapping = SocialMapping::where(array('source_type'=>$source_type,'user_id'=>$post['user_id'],'is_active'=>1))->first();
			if($oSocialMapping){
				$post['isSocial'] = TRUE;				
			}else{
				$post['isSocial'] = FALSE;				
			}
			$response = $this->getReponse(TRUE,1,$post);
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;			
	}

	public function findContacts(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) && isset($post['contacts']) && !empty($post['contacts'])) {
			$contacts = $post['contacts'];
			$contactsList = array();
			foreach ($contacts as $key => $value) {
				$mountain_user_id  = Users::getEmailContacts($value['emails'],$value['phonenumbers'],$post['user_id']);				
				$contactsList[$key] = $value;
				$contactsList[$key]['isIdol']  = UserFollowers::where(array('user_id'=>$post['user_id'],'follower_id'=>$mountain_user_id,'is_active'=>1))->exists();		
				$contactsList[$key]['mountain_user_id'] = $mountain_user_id;				
				if(!$contactsList[$key]['mountain_user_id']){
					unset($contactsList[$key]);
					$contactsList = array_values($contactsList);
				}	
			}			
			$response = $this->getReponse(TRUE,1,$contactsList);		
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function findSocialContacts(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id']) && isset($post['facebookFriends']) && !empty($post['facebookFriends'])) {
			$contacts = $post['facebookFriends'];
			$contactsList = array();
			foreach ($contacts as $key => $value) {
				$oSocialMapping  = SocialMapping::where(array('source_id'=>$value['id'],'source_type'=>$post['source_type'],'is_active'=>1))->first();				
				if($oSocialMapping){
					$contactsList[$key] = $value;
					$contactsList[$key]['isIdol']  = UserFollowers::where(array('user_id'=>$post['user_id'],'follower_id'=>$oSocialMapping->user_id,'is_active'=>1))->exists();		
					$contactsList[$key]['mountain_user_id'] = $oSocialMapping->user_id;
				}		
			}
			$response = $this->getReponse(TRUE,1,$contactsList);		
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function getFeed(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['feed_id']) && !empty($post['feed_id'])) {
			$oFeed = Feeds::getFeed($post['feed_id']);
			if($oFeed){
				$oFeed = $this->getFeedsLikeCount($oFeed,1,$post['user_id']);				
				$response = $this->getReponse(TRUE,1,$oFeed[0]);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);
			}			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	public function getCount(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])) {
			$oUser = Users::find($post['user_id']);
			$country_id = $oUser->country;
			$data['localCount'] = 0;
			$data['globalCount']     = count(Mountain::getGlobalMountainList(FALSE,FALSE,FALSE)); 
			$data['idolsFeedCount'] = 0;
			$data['commercialCount'] = 0;
			$CurrentMountain = Mountain::getCurrentMountain($country_id);
			if($CurrentMountain){
				$data['localCount']      = count(Mountain::getLocalMountainList($CurrentMountain->mountain_id,FALSE,FALSE,$country_id));
				$data['idolsFeedCount']  = count(Mountain::getIdolsFeedList(FALSE,FALSE,$post['user_id'],$CurrentMountain->mountain_id));
				$data['commercialCount'] = count(Mountain::getMoutainList($country_id,0,0));															
			}	
			$data['mountain'] = $this->getCurrentMountain($post['user_id'],$oUser->country);
			$response = $this->getReponse(TRUE,1,$data);
			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}

	
}