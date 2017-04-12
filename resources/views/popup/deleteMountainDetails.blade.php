<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="deletemountainmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="width: 350px;margin-left:auto;margin-right:auto;">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick=""><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">DELETE MOUNTAIN</h4>
         </div>
		 <form class="form-horizontal" action="" method="POST" id="delete_mountain">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               		<div class="col-md-12 center">
	                  <div class="center"><img src="{{asset('public/images/BlockUser_MsgBoxIcons.png')}}" id="judge_delete_image" width="94" height="99"></div>
			  		 </div>
					   <div class="col-md-12">
		                 
							<div class="row">
		                       <div class="col-xs-12 text-center">
		                            <label class="control-label" for="inputZipTraffic" style="font-size: 14px;text-align:center;">
                                  If you delete this, YOU CAN NOT RETRIVE THIS MOUNTAIN in future.Are you sure want to continue?</label>
		                        </div>		                       
							</div>							
		                    <div class="row btn-holder text-center" style=" padding-top: 20px;">
		                        <div class="col-xs-12">
		                            <button type="button" class="btn btn-primary" id="delete_mount_btn" data-dismiss="modal" v-on="click:deleteMountain()" >Ok</button>
		                            <button type="button" class="btn btn-default" data-dismiss="modal" onClick="">Cancel</button>
		                        </div>
		                    </div>
						</div>
    				</div>
				</div>
       <input type="hidden" name="deletemountid" id="deletemountid" value="" />
			</form>
		</div>
	</div>
</div>


        