<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="mountainmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick="getIcons('default');"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">Create Mountain</h4>
         </div>
		 <form class="form-horizontal" action="" method="POST" id="add_mountain">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               		<div class="col-md-12 center">
	                  <div class="upload-img-preview center"><img src="{{asset('public/images/img-placeholder.jpg')}}" id="profile_image" width="100" height="70"></div>
					 	  <div class="upload-img-preview center"><img src="{{asset('public/images/img-placeholder.jpg')}}" id="mountain_profile_image" width="100" height="70"></div>
					 	 <div class="fileUpload btn btn-primary">
							<span>Upload Image</span>
                       		 <input type="file" class="upload" id="fileToUpload" name="fileToUpload"
                        		accept="image/jpg,image/png,image/jpeg" onchange="mountainimageselected(this.files)"/>
							<input type="hidden" name="mountainprofileImage" id="mountainprofileImage"/>
                 		 </div>
                 		 <span id="file_error" style="color:red"></span>
			  		 </div>
					   <div class="col-md-12">
		                 <div class="row">
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputFirstName">Mountain Name<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="name" style="margin-bottom: 0px" class="form-control" required  name="name" maxlength="50">
		                        </div>
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputLastName">Hash Tag<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="hash_tag" style="margin-bottom: 0px" class="form-control" required  name="hash_tag" maxlength="50">
		                        </div>
							</div>
		                    <div class="row">
		                        <div class="col-xs-6">
		                           <label class="control-label" for="inputZipTraffic">URL<span style="color:#ED7476">*</span></label>
		                            <input type="url" id="url" class="form-control" required  name="url" maxlength="50" style="margin-bottom: 5px">
		                        </div>
		                    </div>
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <label class="control-label" for="inputZipTraffic">Description<span style="color:#ED7476">*</span></label>
		                            <textarea id="description" name="description" class="form-control" required  maxlength="100" style="margin-bottom: 5px"></textarea>
		                        </div>
		                       
		                    </div>
							<div class="row">
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputPassword">Start Date<span style="color:#ED7476">*</span></label>
		                            <input type="date" id="start_date" class="form-control" required  name="start_date" maxlength="15" style="margin-bottom: 5px">
		                        </div>
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputRePassword">End Date<span style="color:#ED7476">*</span> </label>
		                            <input type="text" id="end_date" class="form-control" required  name="end_date" maxlength="15" style="margin-bottom: 5px" disabled>
		                        </div>
							</div>
							<div class="row">
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputDbo">Number of Peaks<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="no_of_peaks" class="form-control" required  name="no_of_peaks" maxlength="15" style="margin-bottom: 15px">
		                        </div>
		                        <div class="col-xs-6">
		                            <label class="control-label" for=" ">Peaks Duration<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="mount_peak_duration" class="form-control" required  name="peak_duration" maxlength="15" >
		                        </div>
		                    </div>
                            <div class="row">
		                        <div class="col-xs-12">
		                            <label class="control-label" for="inputZipTraffic">Choose Basetimezone<span style="color:#ED7476">*</span></label>
		                            <select required
						                class="form-control" 
						                id="zone_id" name="zone_id"
						                v-model="formVariables.time_zones">
						                <option 
						                  v-repeat="zone: zonelist" 
						                  value="@{{zone.id	}}">@{{zone.time_zone}}
						                </option>                                
						            </select></div>
		                       
		                    </div>
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <label class="control-label" for="inputZipTraffic">Upload Window Description<span style="color:#ED7476">*</span></label>
		                            <textarea id="window_description" name="window_description" class="form-control" required  maxlength="100" style="margin-bottom: 5px"></textarea>
		                        </div>
		                       
		                    </div>
		                    <div class="row btn-holder text-center">
		                     <span id="user_error" class= "error_new"></span>
		                        <div class="col-xs-12">
		                            <button type="button" class="btn btn-primary" id="creat_user" onClick="saveMountain()">Ok</button>
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


        