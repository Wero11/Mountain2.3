<?php 
namespace App\Http\Controllers\site;

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
use App\Http\Models\api\Users;
use App\Http\Models\api\UserAttributes;
use App\Http\Models\api\UserFollowers;
use App\Http\Models\api\UserImage;
use App\Http\Models\api\UserInbox;
use App\Http\Models\api\TimeZoneCountry;
use App\Http\Models\api\UserBlock;
use App\Http\Models\api\Role;
use App\Http\Models\api\RolePermission;

use Input;
use DB;
use Request;
use DateTime;
use Illuminate\Support\Collection;

class SiteController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Device API Controller
	|--------------------------------------------------------------------------
	|
	*/

	 public function __construct() {

       $this->api = Request::segment(1);
        
    }

	/**
	 * Author : Karthiga
	 *
	 * Created Date : 19 October 2015
	 *
	 * Description : To Get Post Data
	 *
	 * @return Response
	 */


	public function getpostdata($data){

		$post = Input::json ()->all ();		
		if (! isset ( $post ) || empty ( $post ))
			$post = Input::all ();		
		return $post;
	}

	
	/**
	 * Author : Karthiga
	 *
	 * Created Date : 19 October 2015
	 *
	 * Description : To Get Error Messsage
	 *
	 * @return Response
	 */

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
			'8' => 'Mountain assigned successfully',
			'9' => 'Judge removed successfully',
                        '10' => 'Not an admin user'
			);
		
		return $errormessges [$errorIndex];
	}
	
	

	/**
	 * Author : Karthiga
	 *
	 * Created Date : 19 October 2015
	 *
	 * Description : To Get Reponse
	 *
	 * @return Response
	 */

	public function getReponse($status,$code,$result){

		$response['status'] = $status;
		$response['code']   = $code;
		$response['message']  = $this->getErrormessage($code);
		$response['api']    = $this->api;
		$response['result'] = $result;

		return $response;
	}	

	/**
	 * Author : Amutha
	 *
	 * Created Date : 19 October 2015
	 *
	 * Description : To Convert date 
	 *
	 * @return Response
	 */

	public function convertdob($str) {

		$data = explode ( " ", $str );
		//echo"";print_r($data);die;
		if (isset ( $data[0] ) && strcmp ( $data [0], $str ) == 0) {
			$data1 = explode ( "/", $data[0] );
		}
		$data1 = explode ( "/", $data[0] );
		$today = $data[1];
		$sdate = $data1 [0] . '-' . $data1 [1] . '-' . $data1 [2].' '.$today;
		//echo"";print_r($sdate);die;
		//$sdate = strtotime ( $sdate );
		//$sdate = date ( "Y-m-d", $sdate );
		return $sdate;
	}

	/** BEGIN Mountain API

	/**
	 * Author : Karthiga
	 *
	 * Created Date : 2 November 2015
	 *
	 * Description : To Get Mountain List
	 *
	 * @return Response
	 */

	public function getMountain(){

		$post = $this->getpostdata ( $_REQUEST );


		if(isset($post['country_id']) && !empty($post['country_id']) ){			
			
			$oMountain = Mountain::getadminCurrentMountain($post['country_id'],$post['role_id']);
			$list['fame'] = '';
			$list['advertise'] = '';
			foreach ($oMountain as $key => $value) {
				if($value->is_main == 1) {
					$list['fame'][] = $value;
				} else {
					$list['advertise'][] = $value;
				}
			}
			if($list){								
				$response = $this->getReponse(TRUE,1,$list);	

			} else {					
				$response = $this->getReponse(FALSE,4,FALSE);			
			}

			
		}else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
			
		return $response;
	}
public function getAdminCurrentMountain(){
	
		$post = $this->getpostdata ( $_REQUEST );
	
	
		if(isset($post['country_id']) && !empty($post['country_id']) ){
			$pageSize = 10;
			$pageNumber = $post['start'];
			$from = ($pageNumber - 1) * $pageSize;
			$to = $pageNumber * $pageSize;
			$post['start']=$from;
			$post['end']=$pageSize;
			
			$oMountain = Mountain::getMoutains($post['country_id'],$post['role_id'],$post['start'],$post['end']);
			//echo"";print_r($oMountain);die;
			if(count($oMountain)>0){
				foreach ($oMountain as $key => $value) {
	
					$today     = new DateTime(date ( 'Y-m-d H:i:s' )) ;
					$start_date = new DateTime($value->start_date);
					$end_date   = new DateTime($value->end_date);
					$list[$key] = $value;
					if (($today > $start_date) && ($today < $end_date) ) {
						$list[$key]->isCurrent = 1;
					} else {
						$list[$key]->isCurrent = 0;
					}
	
				}
	
				$collection   = new Collection($list);
				$sorted       = $collection->sortByDesc('isCurrent');
				$list = $sorted->values()->all();
	
					
				if($list){
					$response = $this->getReponse(TRUE,1,$list);
	
				} else {
					$response = $this->getReponse(FALSE,4,FALSE);
				}
			}
			else {
				$response = $this->getReponse(FALSE,4,FALSE);
			}
	
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
			
		return $response;
	}

	/**
	 * Author : Karthiga
	 *
	 * Created Date : 03 November 2015
	 *
	 * Description : To Get Mountain Peak List
	 *
	 * @return Response
	 */

	public function getMountainPeak(){

		$post = $this->getpostdata ( $_REQUEST );

		
		if(isset($post['mountain_id']) && !empty($post['mountain_id']) ){			
			
			$oMountainPeak = Mountain::getMountainPeak($post['mountain_id']);
			
			if($oMountainPeak){	

				$result = $oMountainPeak;
                                   /*  foreach ($oMountainPeak as $key => $value) {
					if($oMountainPeak[$key]->start_dttm < date('Y-m-d H:00:00')  )
						$oMountainPeak[$key]->is_start =0;
					
                                       else  
				           $oMountainPeak[$key]->is_start =2;
				}*/
				
				
				$response = $this->getReponse(TRUE,1,$oMountainPeak);	

			} else {					
				$response = $this->getReponse(FALSE,4,FALSE);			
			}

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
			
		return $response;
	}



	


	


	/**
	 * Author : Karthiga
	 *
	 * Created Date : 02 November 2015
	 *
	 * Description : To Get Mountain List By Id
	 *
	 * @return Response
	 */

	public function getMountainListByPeak(){

		$post = $this->getpostdata ( $_REQUEST );


		if(isset($post['peak_id']) && !empty($post['peak_id']) ){			
			
			$oMountain = Mountain::getMountainListById($post['start'],$post['end'],$post['country_id'],$post['mountain_id'],$post['peak_id']);

			if($oMountain){				
				
				$response = $this->getReponse(TRUE,1,$oMountain);	

			} else {					
				$response = $this->getReponse(FALSE,4,FALSE);			
			}

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
			
		return $response;
	}


	/** save Mountain**/
	
	public function saveMountain()
	{
		$post = $this->getpostdata ( $_REQUEST );

		if (isset ( $post ["id"] ) && $post ["id"] != 0){



			$oMountain = Mountain::where( array('id'=>$post['id']))->first();
			$result = '';
			if ($oMountain) {

				$oMountain->fill ( $post );
				$oMountain->image_path = $oMountain->image_path;
				$oMountain->updated_dttm = date ( 'Y-m-d H:i:s' );
				if (isset ($post ['image_path']) && ! empty ( $post ['image_path'] )){
					$post ['imagecontent'] = $post ['image_path'];
					$post['image_path_name']= time () . ".jpg";
					$oMountain->image_path =$post['image_path_name'];
					$base64img = str_replace ( 'data:image/jpeg;base64,', '', $post ['imagecontent'] );
					file_put_contents ( public_path () . "/upload/" . $post['image_path_name'], base64_decode ( $base64img ) );				
				}				
				if($post ['is_edit']==0){	
					$result =  $oMountain->save ();		
							
				} else {
					$deletePeak       = MountainPeak::where(array('mountain_id'=>$post['id']))->delete();
					$oTimeZoneCountry = TimeZoneCountry::where(array('id'=>$post ['zone_id']))->first();		
					$start_date       =  Mountain::convertTimezone($post ['start_date'],$oTimeZoneCountry->offset);
					$days = $oMountain->no_of_peaks * $oMountain->peak_duration;
					$oMountain->start_date = $start_date;	
					$oMountain->end_date   = date('Y-m-d H:i:s', strtotime($oMountain->start_date. ' + '.$days.' days'));
					if(($oMountain->start_date <= date('Y-m-d H:00:00')) || ($oMountain->start_date <= date('Y-m-d H:i:00'))){
						$oMountain->is_active = 2;
					} else {
						$oMountain->is_active = 3;
					}
					$result =  $oMountain->save ();	
								
				}	
			}	

		} else {
			$oMountain = new Mountain();
			$oMountain->image_path = '';
			$oMountain->fill ( $post );
			$oMountain->is_main = 0;
			$oMountain->created_dttm = date ( 'Y-m-d H:i:s' );	
			$oTimeZoneCountry = TimeZoneCountry::where(array('id'=>$post ['zone_id']))->first();		
			$start_date       =  Mountain::convertTimezone($post ['start_date'],$oTimeZoneCountry->offset);
			$days = $oMountain->no_of_peaks * $oMountain->peak_duration;
			$oMountain->start_date = $start_date;	
			$oMountain->end_date = date('Y-m-d H:i:s', strtotime($oMountain->start_date. ' + '.$days.' days'));

			if(($oMountain->start_date <= date('Y-m-d H:00:00')) || ($oMountain->start_date <= date('Y-m-d H:i:00'))){
				$oMountain->is_active = 2;
			} else {
				$oMountain->is_active = 3;
			}

			if (isset ($post ['image_path']) && ! empty ( $post ['image_path'] )){

				$post ['imagecontent'] = $post ['image_path'];
				$post['image_path_name']= time () . ".jpg";
				$oMountain->image_path =$post['image_path_name'];
				$base64img = str_replace ( 'data:image/jpeg;base64,', '', $post ['imagecontent'] );
				file_put_contents ( public_path () . "/upload/" . $post['image_path_name'], base64_decode ( $base64img ) );	
			} 
			$result =  $oMountain->save ();
			
		}
		if ($result === FALSE){
			$response ['success'] = FALSE;
			$errors = $this->manupulateerrors ( $oMountain->errors );
			$response ['errors'] = $errors;
		} else {
			if($post ['is_edit'])
				$peaks = $this->peakCreate($oMountain);
			$response ['success'] = TRUE;
			$response ['code'] = 1; 
			$response ['mountainDetails'] = $oMountain;													
		}
		
		return $response;
	}


	public function peakCreate($oMountain){

		if($oMountain){
			for($i=1;$i <= $oMountain->no_of_peaks;$i++){
				$oMountainPeak = new MountainPeak();
				$oMountainPeak->mountain_id = $oMountain->id;
				$start_days = ($i-1) * $oMountain->peak_duration;
				$end_days = $i * $oMountain->peak_duration;					
				$oMountainPeak->start_dttm  = date('Y-m-d H:i:s', strtotime($oMountain->start_date. ' + '.$start_days.' days'));
				$oMountainPeak->end_dttm  = date('Y-m-d H:i:s', strtotime($oMountain->start_date. ' + '.$end_days.' days'));
				$oMountainPeak->peak_index = $i;
				$oMountainPeak->is_active = 1;	
				if(($oMountainPeak->start_dttm <= date('Y-m-d H:00:00')) || ($oMountainPeak->start_dttm <= date('Y-m-d H:i:00')) && $i == 1 ){
					$oMountainPeak->is_finished = 0;
				}
				else{
					$oMountainPeak->is_finished = 2;
				}
				
				if ($oMountainPeak->save () === FALSE){
					$response [] = FALSE;
				} else {
					$response [] = TRUE;
				}
			}
		} else {
			return FALSE;
		}
		return $response;
	}
	
	/** getmountainbyid**/
	public function getMountainDetailById(){
	
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['id']) && !empty($post['id'])){
	
			$oMountainDetail = Mountain::getMountainDetail($post['id']);
			if($oMountainDetail){
				$oPeakDetail = MountainPeak::where(array('mountain_id'=>$post['id']))->get();
						
				if(($oMountainDetail->start_date <= date('Y-m-d H:00:00')) || ($oMountainDetail->start_date <= date('Y-m-d H:i:00')) )				
				{
					$oMountainDetail->is_edit=0;
					$response = $this->getReponse(TRUE,1,$oMountainDetail);
				}
				else
				{
					$oMountainDetail->is_edit=1;
					$response = $this->getReponse(TRUE,1,$oMountainDetail);
				}
			} else {
	
				$response = $this->getReponse(FALSE,4,FALSE);
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}
	
	
	/** Email Check**/
	
	public function userEmailcheck()
	{
		$post = $this->getpostdata ( $_REQUEST );
		$response = array ();
		if (! empty ( $post ['email'] ))
		{
			$Userdetaildata = Users::where ( "email", $post ['email'] )->first ();
			if (!empty( $Userdetaildata ))
			{
				if($Userdetaildata->role_id!=0){
					$newpassword = $this->randomPassword ();
					$Userdetaildata->password = md5 ( $newpassword );
					$Userdetaildata->updated_dttm = date ( 'Y-m-d H:i:s' );
					if ($Userdetaildata->update () === false)
					{
						$response = $this->getReponse(FALSE,4,FALSE);
						
					}
					else
					{
						$Userdetaildata ['newpassword'] = $newpassword;
						$response = $this->getReponse(TRUE,1,$Userdetaildata);
					}
					
				}
				else
				{
					$response = $this->getReponse(FALSE,4,FALSE);
				}
	
			}
			else
			{
				$response = $this->getReponse(FALSE,4,FALSE);
			}
		}
	
		return $response;
	}
	

	public function randomPassword()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array ();
		$alphaLength = strlen ( $alphabet ) - 1;
		for($i = 0; $i < 8; $i ++)
		{
		$n = rand ( 0, $alphaLength );
		$pass [] = $alphabet [$n];
		}
		return implode ( $pass );
	}
	



	/**
	 * Author : Karthiga
	 *
	 * Created Date : 23 November 2015
	 *
	 * Description : To get judges based on country
	 *
	 * @return Response
	 */

	public function getJudgeList(){

		$post = $this->getpostdata ( $_REQUEST );

		
		if(isset($post['country_id']) && !empty($post['country_id'])){
			$post['country_id']=$post['country_id'];
		} else {
			$post['country_id']=0;	
		}	
			
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
		
			if(isset($post['mountain_id']) && isset($post['mountain_id']))
			{		$omountain=Mountain::where(array('id'=>$post['mountain_id']))->first();
					if($omountain->is_main==1)
						$type="Fame";
					else 
						$type="Advertise";	
				$oMountainJudges = MountainJudges::getJudges($post['country_id'],'','',$post['mountain_id'],'',$type);
			}else if(isset($post['search']) && isset($post['search']))
				$oMountainJudges = MountainJudges::getJudges($post['country_id'],$post['start'],$post['end'],'',$post['search'],$post['type']);
			else
				$oMountainJudges = MountainJudges::getJudges($post['country_id'],$post['start'],$post['end'],'','',$post['type']);

			if($oMountainJudges){
				foreach ($oMountainJudges as $key => $value) {
					$oMountainJudges[$key]->mountainname= MountainJudges::getJudgeMountains($value->judge_id);
					$oMountainJudges[$key]->mountainCount = MountainJudges::where(array('judge_id'=>$value->judge_id,'is_active'=>1))->count();
					$oMountainJudges[$key]->msgCount = UserInbox::where(array('user_id'=>$value->judge_id,'is_active'=>1))->count();
					$oMountainJudges[$key]->touchCount =  $oMountainJudges[$key]->msgCount;
				}

				$response = $this->getReponse(TRUE,1,$oMountainJudges);		
			}else{

				$response = $this->getReponse(FALSE,2,FALSE);		
			}

		
		return $response;
	}


	/**
	 * Author : Karthiga
	 *
	 * Created Date : 23 November 2015
	 *
	 * Description : To assign judge to mountain
	 *
	 * @return Response
	 */

	public function assignJudgeToMountain(){

		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['judge_id']) && !empty($post['judge_id']) && isset($post['mountain_id']) && !empty($post['mountain_id'])){
						
			foreach ($post['judge_id'] as $key => $value) {

				$oMountainJudges = MountainJudges::where(array('mountain_id'=>$post['mountain_id'],'judge_id'=>$value,'is_active'=>1))->first();
				if(!$oMountainJudges)
					$oMountainJudges = new MountainJudges();

				$oMountainJudges->mountain_id = $post['mountain_id'];
				$oMountainJudges->judge_id = $value;
				$oMountainJudges->is_active = 1;
				$oMountainJudges->created_dttm = date ( 'Y-m-d H:i:s' );
				if($oMountainJudges->save() === TRUE){
					$response = $this->getReponse(TRUE,8,$oMountainJudges);		
				}else{
					$response = $this->getReponse(FALSE,4,FALSE);		
				}						
			}

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}


	/**
	 * Author : Karthiga
	 *
	 * Created Date : 23 November 2015
	 *
	 * Description : To delete judge
	 *
	 * @return Response
	 */

	public function deleteJudge(){

		$post = $this->getpostdata ( $_REQUEST );
		
		if(isset($post['judge_id']) && !empty($post['judge_id']) ){
						
			foreach ($post['judge_id'] as $key => $value) {	
				$oUsers = Users::where(array('id'=>$value,'is_active'=>1))->first();
				$oUsers->is_active = 0;
				if($oUsers->save() === TRUE){
					$response = $this->getReponse(TRUE,1,$oUsers);		
				}else{
					$response = $this->getReponse(FALSE,4,FALSE);		
				}						
			}

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	/**
	 * Author : Karthiga
	 *
	 * Created Date : 26 November 2015
	 *
	 * Description : To delete judge
	 *
	 * @return Response
	 */

	public function hideJudge(){

		$post = $this->getpostdata ( $_REQUEST );
		
		if(isset($post['judge_id']) && !empty($post['judge_id']) ){
						
			foreach ($post['judge_id'] as $key => $value) {	
				$oUsers = Users::where(array('id'=>$value,'is_active'=>1))->first();
				$oUsers->is_hide = 1;
				if($oUsers->save() === TRUE){
					$response = $this->getReponse(TRUE,1,$oUsers);		
				}else{
					$response = $this->getReponse(FALSE,4,FALSE);		
				}						
			}

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	/**
	 * Author : Karthiga
	 *
	 * Created Date : 25 November 2015
	 *
	 * Description : To hide judge
	 *
	 * @return Response
	 */

	public function unhideJudge(){

		$post = $this->getpostdata ( $_REQUEST );
		
		if(isset($post['judge_id']) && !empty($post['judge_id']) ){
			//echo"";print($post['judge_id']);die;
			$oUsers = Users::where(array('id'=>$post['judge_id']))->first();
			$oUsers->is_hide = 0;
			if($oUsers->save() === TRUE){
				$response = $this->getReponse(TRUE,1,$oUsers);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}									

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}


	/**
	 * Author : Karthiga
	 *
	 * Created Date : 23 November 2015
	 *
	 * Description : To delete judge
	 *
	 * @return Response
	 */

	public function deleteMountainJudge(){

		$post = $this->getpostdata ( $_REQUEST );
		
		if(isset($post['judge_id']) && !empty($post['judge_id']) && isset($post['mountain_id']) && !empty($post['mountain_id']) ){									
			$oMountainJudges = MountainJudges::where(array('mountain_id'=>$post['mountain_id'],'judge_id'=>$post['judge_id'],'is_active'=>1))->first();
			$oMountainJudges->is_active = 0;
			if($oMountainJudges->save() === TRUE){
				$response = $this->getReponse(TRUE,9,$oMountainJudges);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}							
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	


	/**
	 * Author : Karthiga
	 *
	 * Created Date : 25 November 2015
	 *
	 * Description : To get mountain list
	 *
	 * @return Response
	 */

	public function getMountains(){

		$post = $this->getpostdata ( $_REQUEST );

		
		if(isset($post['country_id']) && !empty($post['country_id'])){
			$mountain = array();
			$mountain['main'] = Mountain::getMoutainList($post['country_id'],1,$post['mount_role_id']);
			$mountain['commercial'] = Mountain::getMoutainList($post['country_id'],0,$post['mount_role_id']);
			if($mountain){
				$response = $this->getReponse(TRUE,1,$mountain);		
			}else{

				$response = $this->getReponse(FALSE,2,FALSE);		
			}

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

   public function getTimeZoneBycountry()
	{
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['country_id']) && !empty($post['country_id'])){
			//echo"";print($post['country_id']);die;
			$tzone= TimeZoneCountry::where('country_id',$post['country_id'])->get();
			if($tzone){
				$response = $this->getReponse(TRUE,1,$tzone);
			}else{
		
				$response = $this->getReponse(FALSE,2,FALSE);
			}
		
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}
	

	/** push Notification**/
	
	public function pushNotificationforMountain()
	{
		$post = $this->getpostdata ( $_REQUEST );
		if(count($post['feed_id'])>0 && $post['push_description']!=''){
			foreach($post['feed_id'] as $key=>$value){
					$oFeed = Feeds::where(array('id'=>$value))->first();
					$response ['success'] = true;
					$response ['code'] = 1; // Success
					//get user details for push notifcation
					$oUser = Users::where(array('id'=>$oFeed->user_id))->first();
					$device_token=trim($oUser->device_token);
                                        $messagecounts=UserInbox::getAllUnreadCount($oFeed->user_id);
					
					//put entry in userinbox
					$oUserInbox = new UserInbox();
					$oUserInbox->user_id = 1;	
					$oUserInbox->feed_id = 0;
					$oUserInbox->message = $post['push_description'];
					$oUserInbox->sender_id = $oFeed->user_id;	
					$oUserInbox->is_active = 1;	
					$oUserInbox->is_read = 0;	
					$oUserInbox->created_by = 1;		
					$oUserInbox->created_dttm = date ( 'Y-m-d H:i:s' );
					$oUserInbox->updated_by = 1;		
					$oUserInbox->updated_dttm = date ( 'Y-m-d H:i:s' );
					if($oUserInbox->save() === TRUE){
						$this->sendAPNNotification($device_token,'Admin','',$post['push_description'],1,$messagecounts);
						$response ['device_token_'.$value]=$device_token;
						$response [$value]=$oFeed->user_id;
					}
			}
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
	  $consolidatedmsg = ucfirst ( $this->unescape_utf16($name)) . " : " . $message . "";
  
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
	public function editMountainDetailById(){
	
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['id']) && !empty($post['id'])){
	
			$oMountainDetail = Mountain::editMoutainListById($post['id']);
			if($oMountainDetail){
	
				$response = $this->getReponse(TRUE,1,$oMountainDetail);
			} else {
	
				$response = $this->getReponse(FALSE,4,FALSE);
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);
		}
		return $response;
	}
	public function getNotificationList(){
			$post = $this->getpostdata ( $_REQUEST );
			
			//if($post['searchuserkeyword']=="" or empty($post['searchuserkeyword'])){
				//$searchuserkeyword="";
			//}else{
				//$searchuserkeyword=$post['searchuserkeyword'];
			//}


			$notificationlist = array();
			$notificationlist = FeedsAbused::getnotificationlist($post);
			
			if($notificationlist){
				$response = $this->getReponse(TRUE,1,$notificationlist);		
			}else{

				$response = $this->getReponse(FALSE,2,FALSE);		
			}

		
		return $response;
			
	}
	public function blockUser()
	{
		$post = $this->getpostdata ( $_REQUEST );
		$oUserBlock = new UserBlock ();
		$oUserBlock->blockedtype = $post ['blocktypes'];
		$oUserBlock->blockeddays = ($post ['daterange']=='') ? 0 : $post ['daterange'];
		$oUserBlock->description = $post ['description'];
		$oUserBlock->adminnote = $post ['adminnote'];
		$oUserBlock->user_id = $post ['user_id'];
		$oUserBlock->created_by = 1;
		$oUserBlock->created_dttm =  date ( 'Y-m-d H:i:s' );
		
		if ($oUserBlock->save () === false)
		{
			
			$response ['success'] = false;
			$errors = $this->manupulateerrors ( $oUserBlock->errors );
			$response ['errors'] = $errors;
		}
		else
		{
			
			///make inactive in user table also
			$oUser = Users::where(array('id'=>$post['user_id']))->first();
			$oUser->is_active = 0;
			if($oUser->save() === TRUE){
				//send push notification
				if($oUserBlock->blockedtype=='TEMP'){
					$usermsg="You have been blocked for ".$oUserBlock->blockeddays." days because of this reason : ".$oUserBlock->description;
				}
				if($oUserBlock->blockedtype=='PERM'){
					$usermsg="You have been permenantly blocked because of this reason : ".$oUserBlock->description;
				}
				

				$messagecounts=UserInbox::getAllUnreadCount($post['user_id']);

				$this->sendAPNNotification($oUser->device_token,$oUser->first_name,'',$usermsg,1,$messagecounts);


				//update read flag in feed abused table
				$oNotificationFeed = FeedsAbused::where(array('id'=>$post['notificid']))->first();
				$oNotificationFeed->is_read = 1;
				if($oNotificationFeed->save() === TRUE){
					$response ['success'] = true;
				}
				$response ['success'] = true;
				$response ['code'] = 1; // Success
				if($post['searchuserkeyword']=="" or empty($post['searchuserkeyword'])){
					$searchuserkeyword="";
				}else{
					$searchuserkeyword=$post['searchuserkeyword'];
				}
				$oNotificationList=FeedsAbused::getnotificationlist($post);
				$response = $oNotificationList;	
			}
			
		}
		return $response;
	}
	public function makefeedinactive(){

		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['feed_id']) && !empty($post['feed_id'])){

			$oFeeds = Feeds::where(array('id'=>$post['feed_id']))->first();


			$oFeeds->is_active = 0;
			if($oFeeds->save() === TRUE){
				$oUserFeedList=$this->getUserFeeds($oFeeds->user_id);
				$response = $this->getReponse(TRUE,1,$oUserFeedList);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}							
			
			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	public function getUserFeeds($userid){

		
		if(isset($userid) && !empty($userid)){
			
			$feeds = Feeds::getUserFeeds($userid,0,100);
			if($feeds){
				foreach ($feeds as $key => $value) {	
					$feeds[$key]->thumbnail = str_replace(".mp4", "", $value->feed_video).'.jpeg';	
				}
				
				$response = $feeds;	
			} else {

				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	public function deleteNotification(){

		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['noteid']) && !empty($post['noteid'])){

			$oFeedsAbused = FeedsAbused::where(array('id'=>$post['noteid']))->first();


			$oFeedsAbused->is_active = 0;
			if($oFeedsAbused->save() === TRUE){
				$oNotificationList = FeedsAbused::getnotificationlist($post);
				$response = $this->getReponse(TRUE,1,$oNotificationList);	
				
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}							
			
			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	public function unblocknotifyuser(){

		$post = $this->getpostdata ( $_REQUEST );
		
		if(isset($post['userid']) && !empty($post['userid'])){

			///make inactive in user table also
			$oUser = Users::where(array('id'=>$post['userid']))->first();
			$oUser->is_active = 1;
			if($oUser->save() === TRUE){
			
				$oUserBlock = UserBlock::unblocknotifyuser($post['userid']);
			
				$oNotificationList = FeedsAbused::getnotificationlist($post);
				$response = $this->getReponse(TRUE,1,$oNotificationList);
			}	
				
									
			
			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	public function getUserFeedsWithAbused(){

		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_id']) && !empty($post['user_id'])){
			
			$result = Feeds::getUserFeedsWithAbused($post['user_id'],$post['start'],$post['end']);
			if($result){
				
				foreach ($result as $key => $value) {			
					$result[$key]->thumbnail = str_replace(".mp4", "", $value->feed_video).'.jpeg';			
					//get feed abused by details
					$feedAbusedBy = FeedsAbused::getFeedAbusedByUserDetails($value->feed_id);
					if($feedAbusedBy){
					//print_r($feedAbusedBy);
					$result[$key]->abusedby = $feedAbusedBy[0]->abusedby;
					$result[$key]->tags = $feedAbusedBy[0]->tags;
					
					}
				}
				$response = $this->getReponse(TRUE,1,$result);		
			} else {

				$response = $this->getReponse(FALSE,4,FALSE);		
			}
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getRoleList(){
		$post = $this->getpostdata ( $_REQUEST );
		$rolelist = array();
		$rolelist = Role::getRoles();
		if($rolelist){
			$response = $this->getReponse(TRUE,1,$rolelist);		
		}else{
			$response = $this->getReponse(FALSE,2,FALSE);		
		}
		return $response;
	}

	public function getRoleSettings(){
		$post = $this->getpostdata ( $_REQUEST );
		$rolesettings = array();
		$rolesettings = RolePermission::getRoleSettings($post['role_id']);
		if($rolesettings){
			$response = $this->getReponse(TRUE,1,$rolesettings);		
		}else{
			$response = $this->getReponse(FALSE,2,FALSE);		
		}
		return $response;
	}

	public function getAdvMountainList(){
		$post = $this->getpostdata ( $_REQUEST );
		$advmountainlist = array();
		$advmountainlist = RolePermission::getMoutainLists('',0);
		if($advmountainlist){
			$response = $this->getReponse(TRUE,1,$advmountainlist);		
		}else{
			$response = $this->getReponse(FALSE,2,FALSE);		
		}
		return $response;
	}

	public function getFameMountainList(){
		$post = $this->getpostdata ( $_REQUEST );
		$famemountainlist = array();
		$famemountainlist = RolePermission::getMoutainLists('',1);
		if($famemountainlist){
			$response = $this->getReponse(TRUE,1,$famemountainlist);		
		}else{
			$response = $this->getReponse(FALSE,2,FALSE);		
		}
		return $response;
	}

	public function saveRoleSettings()
	{
		$post = $this->getpostdata ( $_REQUEST );
		//update role description
		Role::updateRoleDescription($post['objrolesettings']['role_id'],$post['role_description']);
		foreach ($post['objrolesettings'] as $key => $value) {
			if($key!='role_id'){
				RolePermission::insertRoleSettings($post['objrolesettings']['role_id'],$key,$value);
			}
		}
		
		
	}

	public function getUserList(){
	
		$post = $this->getpostdata ( $_REQUEST );
			$pageSize = 12;
			$pageNumber = $post['start'];
			$from = ($pageNumber - 1) * $pageSize;
			$to = $pageNumber * $pageSize;
			$post['start']=$from;
			$post['end']=$pageSize;
			$auser = Users::getUserlist($post['country_id'],$post['start'],$post['end'],$post['search_user']);
			if($auser){
				$response = $this->getReponse(TRUE,1,$auser);
			}else{
	
				$response = $this->getReponse(FALSE,2,FALSE);
			}
	
		
		return $response;
	}

	public function createrole()
	{
		$post = $this->getpostdata ( $_REQUEST );
		//check the role is already exists
		$oRoleCheck = Role::where(array(strtolower('name')=>strtolower($post['rolename']),'is_active'=>1))->first();
		if($oRoleCheck){
			$response ['success'] = true;
			$response ['code'] = 12;
		}else{


			$oRole = new Role ();
			$oRole->name = $post ['rolename'];
			$oRole->description = $post ['description'];
		
		
			if ($oRole->save () === false)
			{
			
				$response ['success'] = false;
				$errors = $this->manupulateerrors ( $oRole->errors );
				$response ['errors'] = $errors;
			}
			else
			{
					$response ['success'] = true;
					$response ['code'] = 1; // Success
				
					$oRoleList=Role::getRoles();
					$response = $oRoleList;	
			
			
			}
		}
		return $response;
	}
public function deleterole(){

		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['role_id']) && !empty($post['role_id'])){

			//check the role is assigned to any user
			$roleassignedflag=Role::checkRoleAssigned($post['role_id']);
			if($roleassignedflag==0){
				$oRole = Role::where(array('id'=>$post['role_id']))->first();
				$oRole->is_active = 0;
				if($oRole->save() === TRUE){
					$response ['success'] = true;
					$response ['message'] = 'done';
				
				}else{
					$response = $this->getReponse(FALSE,4,FALSE);		
				}		
			}else if($roleassignedflag>0){
				$response ['success'] = true;
				$response ['message'] = 'exist';
			}					
			
			
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}

	public function getRoleDetails(){
		$post = $this->getpostdata ( $_REQUEST );
		$roleinfo = array();
		$roledetails = Role::getRoleDetails($post['role_id']);
		if($roledetails){
			foreach ($roledetails as $roledetails) {
				$response['name']=$roledetails->name;
				$response['description']=$roledetails->description;

			}		
		}else{
			$response = $this->getReponse(FALSE,2,FALSE);		
		}
		return $response;
	}
	
	public function getMountainJudges(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['mountain_id']) && !empty($post['mountain_id'])){
			$oMountainJudges = MountainJudges::getMountainJudges($post['mountain_id']);
			
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

	public function getProfession(){
		$oReferenceDomain = ReferenceDomain::getReferenceValuesByCode('Profession');
		if($oReferenceDomain){
				$response = $this->getReponse(TRUE,1,$oReferenceDomain);		
		}else{
			$response = $this->getReponse(FALSE,2,FALSE);		
		}
		return $response;
	}


	public function saveProfession(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['user_profession']) && !empty($post['user_profession'])){

			$oReferenceDomain = ReferenceDomain::where('code','Profession')->first();

			$oReferenceValue = ReferenceValue::getReferenceValue($oReferenceDomain->id,$post['user_profession']);

			if($oReferenceValue){

				$response = $this->getReponse(TRUE,1,$oReferenceValue);
			} else {

				$oReferenceValue = new ReferenceValue();
				$oReferenceValue->reference_id = $oReferenceDomain->id;
				$oReferenceValue->value = $post['user_profession'];
				$oReferenceValue->code = $post['user_profession'];
				$oReferenceValue->is_active = 1;
				$oReferenceValue->created_dttm = date('Y-m-d H:i:s');

				if($oReferenceValue->save() == TRUE){
					$response = $this->getReponse(TRUE,1,$oReferenceValue);
				} else {
					$response = $this->getReponse(FALSE,4,FALSE);	
				}
			}	
		} else{
			$response = $this->getReponse(FALSE,3,FALSE);		
		}
		return $response;
			
	}


	public function deleteProfession(){
		$post = $this->getpostdata ( $_REQUEST );
		if(isset($post['reference_value_id']) && !empty($post['reference_value_id'])){
			
			$oReferenceValue = ReferenceValue::where('id',$post['reference_value_id'])->first();

			if(!$oReferenceValue){

				$response = $this->getReponse(FALSE,2,FALSE);
			} else {

				$oReferenceValue->is_active = 0;
				$oReferenceValue->updated_dttm = date('Y-m-d H:i:s');

				if($oReferenceValue->save() == TRUE){
					$response = $this->getReponse(TRUE,1,$oReferenceValue);
				} else {
					$response = $this->getReponse(FALSE,4,FALSE);	
				}
			}	
		} else{
			$response = $this->getReponse(FALSE,3,FALSE);		
		}
		return $response;
			
	}
 public function changePassword(){

		$post = $this->getpostdata ( $_REQUEST );
		
		if(isset($post['user_id']) && !empty($post['user_id']) ){
			//echo"";print($post['judge_id']);die;
			$oUsers = Users::where(array('id'=>$post['user_id']))->first();
			$oUsers->password = md5 ( $post ['password'] );
			if($oUsers->save() === TRUE){
				$response = $this->getReponse(TRUE,1,$oUsers);		
			}else{
				$response = $this->getReponse(FALSE,4,FALSE);		
			}									

		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
 public function deleteMountainDetails(){

		$post = $this->getpostdata ( $_REQUEST );
		
		if(isset($post['mountain_id']) && !empty($post['mountain_id']) ){
			$status = mountain::removeMountain($post['mountain_id']);
			if($status)
				$response = $this->getReponse(TRUE,1,$status);	
			else 
				$response = $this->getReponse(FALSE,5,FALSE);
					
		} else {
			$response = $this->getReponse(FALSE,3,FALSE);	
		}	
		return $response;
	}
	
}