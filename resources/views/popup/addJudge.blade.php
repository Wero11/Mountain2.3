<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="judgemodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick="getJudgeIcons('default');"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">Create Judge</h4>
         </div>
		 <form class="form form-horizontal" action="" method="POST" id="add_judge">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               		<div class="col-md-12 center create_header_popup_img">
	                  <div class=" center"><img src="{{asset('public/images/img-placeholder.jpg')}}" id="judge_profile_image" class="upload_img_padding"></div>
					 	<span id="file_error" style="color:red"></span><br/>
					 	 <div class="fileUpload btn btn-primary" style="display:none">
							<span>Upload Image</span>
                       		 <input type="file" class="upload" id="fileToUpload" name="fileToUpload"
                        		accept="image/jpg,image/png,image/jpeg" onchange="imageselected(this.files)"/>
							<input type="hidden" name="judgeprofileImage" id="judgeprofileImage"/>
                 		 </div>
                 		 
			  		 </div>
					   <div class="col-md-12">
		                 <div class="row">
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputFirstName">First Name<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="first_name" style="margin-bottom: 0px" class="form-control" required  name="first_name" maxlength="45">
		                        </div>
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputLastName">Last Name<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="family_name" style="margin-bottom: 0px" class="form-control" required  name="family_name" maxlength="45">
		                        </div>
							</div>
							<div class="row">
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputFirstName">User Name<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="user_name" style="margin-bottom: 0px" class="form-control" required  name="user_name" maxlength="45">
		                        </div>
		                        <div class="col-xs-6">
		                            <label class="control-label" for="inputLastName">Password<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="password" style="margin-bottom: 0px" class="form-control" required  name="password" minlength="6" maxlength="50">
		                        </div>
							</div>
		                    <div class="row">
		                         <div class="col-xs-6" style="padding: 0px!important;">
		                        <div class="col-xs-12" id="select_prof">
		                           <label class="control-label" for="inputZipTraffic">Profession<span style="color:#ED7476">*</span></label>
		                           <div class="col-xs-10" style="padding: 0px!important;">
		                            <select class="form-control" id="profession" name="profession">
		                         <option 
						                  v-repeat="prof: professionlist" 
						                  value="@{{prof.id}}">@{{prof.value}}
						                </option>   
		                            </select></div>
		                            <div class="col-xs-2" style="padding:8px 0px 0px 10px!important;cursor:pointer;"><img src="{{ asset('public/images/Add.png')}} " class="content_view grid-group-item_view_icon"  v-on="click:saveProfession('show')" title="Add"></img>
		                            </div>
		                        </div>
		                          <div class="col-xs-12" style="display: none" id="add_prof">
		                           <label class="control-label" for="inputZipTraffic">Profession<span style="color:#ED7476">*</span></label>
		                           <div class="col-xs-10" style="padding: 0px!important;">
		                             <input type="text" id="prof_name" style="margin-bottom: 0px" class="form-control" required  name="prof_name" maxlength="50"></div><div class="col-xs-2" style="padding:8px 0px 0px 10px!important;cursor:pointer;"><img src="{{ asset('public/images/Save.png')}} " class="content_view grid-group-item_view_icon"  v-on="click:saveProfession('save')" title="Save"></img>

		                            </div>
		                        </div>
<span id="prof_error" class= "error_new" style="margin-left: 15px;!important"></span>
		                        </div>
		                         <div class="col-xs-6">
		                            <label class="control-label" for="inputLastName">Associated #tags<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="tags" style="margin-bottom: 0px" class="form-control" required  name="tags" maxlength="225">
		                        </div>
		                    </div>
		                    <div class="row">
		                        <div class="col-xs-6">
		                           <label class="control-label" for="inputZipTraffic">Email<span style="color:#ED7476">*</span></label>
		                            <input type="email" id="email" class="form-control" required  name="email" maxlength="45" style="margin-bottom: 5px">
		                        </div>
		                         <div class="col-xs-6">
		                            <label class="control-label" for="inputLastName">Website<span style="color:#ED7476">*</span></label>
		                            <input type="text" id="website" style="margin-bottom: 0px" class="form-control" required  name="website" maxlength="60">
		                        </div>
		                       
		                    </div>
		                    <div class="row">
		                       <div class="col-xs-6">
		                            <label class="control-label" for="inputZipTraffic">Type<span style="color:#ED7476">*</span></label>
		                            <select name="judge_type" id="mountain_judge_type" class="form-control" required>
									  <option value="Fame">Fame</option>
									  <option value="Advertise">Advertise</option>
									</select>
		                        </div>
		                       
							</div>
							<div class="row">
		                       <div class="col-xs-12">
		                            <label class="control-label" for="inputZipTraffic">Bio<span style="color:#ED7476">*</span>&nbsp;[Max 255 characters]</label>
		                            <textarea id="description" name="description" maxlength="255" class="form-control" required   style="margin-bottom: 5px"></textarea>
		                        </div>
		                       
							</div>
							
		                    <div class="row btn-holder text-center" style=" padding-top: 20px;">
		                     <span id="judge_error" class= "error_new"></span>
		                        <div class="col-xs-12">
		                        	<input type="hidden" name="judge_id" id="judge_id" value=""/>
		                            <button type="button" class="btn btn-primary" id="create_judge" v-on="click:saveJudge(formVariables.country_id)" >Ok</button>
		                            <button type="button" class="btn btn-primary" id="update_judge" v-on="click:updateJudge(formVariables.country_id)" style="display:none">Ok</button>
		                            <button type="button" class="btn btn-default" data-dismiss="modal" onClick="getJudgeIcons('default');">Cancel</button>
		                        </div>
		                    </div>
						</div>
    				</div>
				</div>
			</form>
		</div>
	</div>
</div>


        