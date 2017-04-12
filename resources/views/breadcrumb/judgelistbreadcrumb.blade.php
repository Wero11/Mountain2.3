<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
$user_role_id=$aUserDetail->role_id;
//echo"";print_r($aUserDetail->role);die;
$aUserRole=$aUserDetail->role;
}

?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" id="bread_crumb_btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>	
     	 <ul class="nav navbar-nav navbar-left">
	       <li> <h1 class="breadcrumb-div-left">Manage Judges</h1></li>
	       <input type="hidden" value="<?php echo $user_role_id?>" id="hdn_mount_role"/>
	    </ul> 	    
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav navbar-right">
	      @if (Session::has('user_detail.0'))
	       @if (count($aUserRole)>0)
              @foreach($aUserRole as $key) 
                @if ($key->key =='SER_JUG' && $key->value==1)
		    	 <li>
	        		<div class="input-group add-on" style="height:25px">
					  <input type="text" class="k-textbox form-control" style="height: 25px;" placeholder="Search"  id="search_judge">
					  <div class="input-group-btn">
						<button class="btn btn-default" id="btnSearch" v-on="click:getJudges(formVariables.country_id)" type="submit" style="height: 25px;padding: 2px 12px!important"><i class="fa fa-search"></i></button>
					  </div>
					</div>		
		        </li>
		        @endif
		       @endforeach
		         @else
			        <li>
	        			<div class="input-group add-on" style="height:25px">
						  <input type="text" class="k-textbox form-control" style="height: 25px;" placeholder="Search"  id="search_judge">
						  <div class="input-group-btn">
							<button class="btn btn-default" id="btnSearch" v-on="click:getJudges(formVariables.country_id)" type="submit" style="height: 25px;padding: 2px 12px!important"><i class="fa fa-search"></i></button>
						  </div>
						</div>		
		        	</li>
		        @endif
		     @endif
		       @if (Session::has('user_detail.0'))
	         	@if (count($aUserRole)>0)
             		 @foreach($aUserRole as $key) 
	         			@if ($key->key =='CRE_JUG' && $key->value==1)
	      					 <li> <button id="j_create" class="breadcrumb-btn_mountain_active" onclick="showPopup('Create Judge','create','judgemodal','clear_judge')">Create Judge</button></li>
	      				@endif
		      	 	@endforeach
		         @else
		         	<li> <button id="j_create" class="breadcrumb-btn_mountain_active" onclick="showPopup('Create Judge','create','judgemodal','clear_judge')">Create Judge</button></li>
	      		@endif
		     @endif
	       <li>	<select name="judge_type" id="judge_type" class="form-control breadcrumb-div-a"  style="    height: 25px!important;"
	       v-on="change: getJudges(formVariables.country_id);">
									  <option value="Fame">Fame</option>
									  <option value="Advertise">Advertise</option>
									</select>
			</li>
	        <li> 
	        	<a href="#"  class="switcher breadcrumb-div-a"> 
	        		<img id="gridview" src="{{ asset('public/images/title_a.png')}} " />
	        	</a>
	        </li>
	        <li>
	        	<a href="#"  class="switcher active breadcrumb-div-a">
	        		<img id="listview" src="{{ asset('public/images/list_n.png')}} "  />
				</a>
			</li>
	         @if (Session::has('user_detail.0'))
			 	@if (count($aUserRole)>0)
             		 @foreach($aUserRole as $key) 
	               		 @if ($key->key =='HIDE_JUG' && $key->value==1)
					        <li>
					        	<a href="#" class="breadcrumb-div-a" title="Hide Judges" onclick="showPopup('HIDE JUDGES','hide','hidejudgemodal','');">  
					        		<img id="j_hide" src="{{ asset('public/images/eye_n.png')}} "  title="hide"/>
							    </a>
							</li>
					   	 @elseif ($key->key =='ASN_MUTN' && $key->value==1)
							<li style="margin-right: -3px;">
					        	<a href="#" class="breadcrumb-div-a" title="Assign Mountain" onclick="showPopup('ASSIGN MOUNTAIN[s]','add','assignmountainmodal','');"> 
					        		<img id="j_assign_mountain" src="{{ asset('public/images/assignmountain_n.png')}} "  title="Assign Mountain"/>
					        	</a>
					        </li>
 						 @elseif ($key->key =='DEL_JUG' && $key->value==1)
					        <li >
					        	<a href="#" title="Delete" class="breadcrumb-div-a" onclick="showPopup('DELETE JUDGES','delete','deletejudgemodal','');"> 
					        		<img id="j_delete" src="{{ asset('public/images/delete_n.png')}} "  title="delete"/>
					        	</a>
					        </li>
					      @endif
					    @endforeach
		      		  @else
		      		   	<li>
					        	<a href="#" class="breadcrumb-div-a" title="Hide Judges" onclick="showPopup('HIDE JUDGES','hide','hidejudgemodal','');">  
					        		<img id="j_hide" src="{{ asset('public/images/eye_n.png')}} "  title="hide"/>
							    </a>
							</li>
						<li style="margin-right: -3px;">
					        	<a href="#" class="breadcrumb-div-a" title="Assign Mountain" onclick="showPopup('ASSIGN MOUNTAIN[s]','add','assignmountainmodal','');"> 
					        		<img id="j_assign_mountain" src="{{ asset('public/images/assignmountain_n.png')}} "  title="Assign Mountain"/>
					        	</a>
					        </li>
						<li style="margin-right: -3px;">
					        	<a href="#" title="Delete" class="breadcrumb-div-a" onclick="showPopup('DELETE JUDGES','delete','deletejudgemodal','');"> 
					        		<img id="j_delete" src="{{ asset('public/images/delete_n.png')}} "  title="delete"/>
					        	</a>
					        </li>
		      	 @endif
		     @endif
		     
	    </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
