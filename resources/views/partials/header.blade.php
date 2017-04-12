<!-- header -->
<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
$logUsrCountryId=$aUserDetail->country;
$logUsrCountryCode=$aUserDetail->code;
$aUserRole=$aUserDetail->role;
$loggedUsername = $aUserDetail->first_name;//$aUserDetail->first_name;
if ($aUserDetail->ProfileImage)
	$imagepath = $aUserDetail->ProfileImage;
else
	$imagepath = 'no-profile.png';
}else{
 $logUsrCountryId='';
$logUsrCountryCode='';
}
date_default_timezone_set ( 'Australia/Sydney' );
$date = date ( 'd-m-Y h:i a' );
$logged_time = $date;

?>

<div id="top-nav" class="navbar navbar-inverse navbar-static-top dashboard_header_banner_img">
	<div class="container-fluid">
   	 <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
             <center><a class="navbar-brand" href="#"></a></center>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-top: -20px;
    margin-bottom: -9px;">
             <center><img src="{{ asset('/public/images/HeaderBGLogo.png') }}" class="img-responsive"></center>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        	<div class="row">
           		 <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-offset-3" style="cursor:pointer" onclick="clear_password_form()">
           		 		 @if (Session::has('user_detail.0'))
              			<img style="float:left" src="public/upload/<?php echo $imagepath;?>" width="40"
                            height="40" alt="" class="dashboard_header_user_img">
                 		<p class="dashboard_header_welcome_text"> Welcome | <?php echo $loggedUsername;?><br>
                 		 @endif
                 	 	<span class="dashboard_header_date_text"><?php echo $logged_time;?></span></p>
            	 </div>
       		</div>
        	<div class="row" id="country_header_row" style="padding-bottom:30px;">
            	<div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-offset-3 country_header" id="countryHeader" style="display:none" >
            	   <div style="">
   					 <div id="dvFlag" style="background-image:url(public/images/flags.png);background-repeat:no-repeat;float:left;height:16px;width:16px;margin-top:3px" class="au"></div>
		            	  <select style="width:128px!important;margin-right:0px;margin-top:-2px;height:24px!important;padding-top:2px!important"
		                          class="breadcrumb_mountain_property form-control" 
		                          id="country_id" 
		                          v-model="formVariables.country_id" 
		                          @if(isset($component))
		                            @if($component == 'components.managemountain')
		                              v-on="change: getMountain(formVariables.country_id);"
		                            @endif
		                            @if($component == 'components.managejudge')
		                              v-on="change: getJudges(formVariables.country_id);"
		                            @endif
		                            @endif
		                  >
		                  <option 
		                      v-repeat="country: countrylist" 
		                      v-attr="selected: country.id==formVariables.country_id"    
		                      value="@{{country.id}}"  
		                      code="@{{country.code}}"
		                     >@{{country.name}}
		                  </option>                                
		               </select>	
		              </div>
           		 </div>
          	</div>
      	 </div>
   		</div>
  	</div>
</div> 
<input type="hidden" name="hidn_country_id" id="hidn_country_id" value="<?php echo $logUsrCountryId;?>" />
<input type="hidden" name="hidn_country_code" id="hidn_country_code" value="<?php echo $logUsrCountryCode;?>" />
<style>
select.icon-menu option {
background-repeat:no-repeat;
background-position:bottom left;
padding-left:30px;
}    
 
</style>