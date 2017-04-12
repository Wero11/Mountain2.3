<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="rolemodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" v-on="click:cancelrole()"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">Create Role</h4>
         </div>
		 <form class="form-horizontal" action="" method="POST" id="add_role">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
                <div class="row text-center" id="roleduplicate" style="font-size:12px;color:red;">Role name is already exists</div>
               		
					   <div class="col-md-12">
		                 <div class="row">
                       <div class="col-xs-12">
		                            <label class="control-label" for="inputFirstName">Role Name<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="rolename" style="margin-bottom: 0px" class="form-control required" name="rolename" maxlength="30">
		                        </div>
		                        
							</div>
		                    
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <label class="control-label" for="inputZipTraffic">Description</label>
		                            <textarea id="description" name="description" class="form-control"  maxlength="100" style="margin-bottom: 5px"></textarea>
		                        </div>
		                       
		                    </div>
							
		                    <div class="row btn-holder text-center">
		                     <span id="user_error" class= "error_new"></span>
		                        <div class="col-xs-12">
		                            <button type="button" class="btn btn-primary" id="creat_user" v-on="click:createrole()">Ok</button>
		                            <button type="button" class="btn btn-default" data-dismiss="modal" v-on="click:cancelrole()">Cancel</button>
		                        </div>
		                    </div>
						</div>
               
    				</div>
				</div>
			</form>
		</div>
	</div>
</div>


        