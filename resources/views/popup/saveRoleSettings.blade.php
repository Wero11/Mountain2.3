<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="saverolesettingsmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="width: 350px;">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" v-on="click:reloadwindow()"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="role-settings-title">ROLE SETTINGS</h4>
         </div>
		
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               		<div class="col-md-12 center">
	                  <div class="center"><img src="{{asset('public/images/assignmountain_n.png')}}" id="judge_delete_image" width="35" height="35"></div>
			  		 </div>
					   <div class="col-md-12">
		                 
							<div class="row">
		                       <div class="col-xs-12 center">
		                            <label class="control-label" for="inputZipTraffic" style="font-size: 14px;">
		                           Saved Successfully</label>
		                        </div>		                       
							</div>							
		                    <div class="row btn-holder text-center" style=" padding-top: 20px;">
		                        <div class="col-xs-12">
		                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="saverole" v-on="click:reloadwindow()" >Ok</button>
		                            
		                        </div>
		                    </div>
						</div>
    				</div>
				</div>
    
		</div>
	</div>
</div>


        