<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="pushpopupmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick="getIcons('default');"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">Push Notification</h4>
         </div>
		 <form class="form-horizontal" action="" method="POST" id="push_notification">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               		
					   <div class="col-md-12">
							<div class="row">
		                       <div class="col-xs-12">
		                            <label class="control-label" for="inputZipTraffic">Description<span style="color:#ED7476">*</span></label>
		                            <textarea id="push_description" name="push_description" class="form-control" required   style="margin-bottom: 5px;height:150px"></textarea>
		                        </div>
		                       
							</div>
							
		                    <div class="row btn-holder text-center" style=" padding-top: 20px;">
		                        <div class="col-xs-12">
		                            <button type="button" class="btn btn-primary" id="push_notification_btn" v-on="click:pushNotification();" >Ok</button>
		                            <button type="button" class="btn btn-default" data-dismiss="modal" onClick="getIcons('default');">Cancel</button>
		                        </div>
		                    </div>
						</div>
    				</div>
				</div>
			</form>
		</div>
	</div>
</div>


        