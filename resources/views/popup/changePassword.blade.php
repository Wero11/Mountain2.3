<!-- create/edit mountain -->
<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
$user_id=$aUserDetail->user_id;
}
?>
<div class="modal modal-wide fade" id="changepasswordmodel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">Change Password</h4>
         </div>
		 <form class="form-horizontal" action="" method="POST" id="change_password_form">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               	
					   <div class="col-md-12">
		                 <div class="row">
                       <div class="col-xs-12">
		                            <label class="control-label" for="inputFirstName">New Password<span style="color:#ED7476">*</span></label>
		                            <input type="password" id="newpassword" style="margin-bottom: 0px" class="form-control required" name="newpassword" maxlength="30">
		                        </div>
		                        
							</div>
		                    
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <label class="control-label" for="inputZipTraffic">Confirm Password</label>
		                            <input type="password" id="confirmpassword" style="margin-bottom: 0px" class="form-control required" name="confirmpassword" maxlength="30">
		                        </div>
		                       
		                    </div>
							
		                    <div class="row btn-holder text-center">
		                     <span id="user_error" class= "error_new"></span>
		                        <div class="col-xs-12">
		                            <button type="button" class="btn btn-primary" id="creat_user" v-on="click:changePassword(<?php echo $user_id;?>)">Ok</button>
		                            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
		                        </div>
		                    </div>
						</div>
               
    				</div>
				</div>
			</form>
		</div>
	</div>
</div>
        