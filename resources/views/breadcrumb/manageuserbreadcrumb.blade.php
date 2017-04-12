<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
//echo"";print_r($aUserDetail->role);die;
$aUserRole=$aUserDetail->role;
}

?><nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" id="bread_crumb_btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>	
     	 <ul class="nav navbar-nav navbar-left">
	       <li> <h1 class="breadcrumb-div-left">Manage Portal User</h1></li>
	      
	    </ul> 	    
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	     <ul class="nav navbar-nav navbar-right">
	      @if (Session::has('user_detail.0'))
	       @if (count($aUserRole)>0)
              @foreach($aUserRole as $key) 
                @if ($key->key =='SER_USR' && $key->value==1)
			     	<li>
		        		<div class="input-group add-on" style="height:25px">
						  <input type="text" class="k-textbox form-control" style="height: 25px;font-size: 12px;" placeholder="Search"  id="search_user" v-on="keydown: getUserList(formVariables.country_id) | key 'enter'">
						  <div class="input-group-btn">
							<button class="btn btn-default" id="userbtnSearch" v-on="click:getUserList(formVariables.country_id)" type="submit" style="height: 25px;padding: 2px 12px!important"><i class="fa fa-search"></i></button>
						  </div>
						</div>		
			        </li>
			          @endif
		       @endforeach
		         @else
			        <li>
		        		<div class="input-group add-on" style="height:25px">
						  <input type="text" class="k-textbox form-control" style="height: 25px;" placeholder="Search"  id="search_user" v-on="keydown: getUserList(formVariables.country_id) | key 'enter'">
						  <div class="input-group-btn">
							<button class="btn btn-default" id="userbtnSearch" v-on="click:getUserList(formVariables.country_id)" type="submit" style="height: 25px;padding: 2px 12px!important"><i class="fa fa-search"></i></button>
						  </div>
						</div>		
			        </li>
		        @endif
		     @endif
		      @if (Session::has('user_detail.0'))
	         	@if (count($aUserRole)>0)
             		 @foreach($aUserRole as $key) 
	         			@if ($key->key =='CRE_USR' && $key->value==1)
	       					<li> <button id="u_ceate" class="breadcrumb-btn_mountain_active" onclick="showPopup('Create User','create','usermodal','clear_user');getUserIcons('create')">Create User</button></li>
	      					@endif
		      	 	@endforeach
		         @else
		         	<li> <button id="u_ceate" class="breadcrumb-btn_mountain_active" onclick="showPopup('Create User','create','usermodal','clear_user');getUserIcons('create')">Create User</button></li>
	      		@endif
		     @endif
	        <li> 
	        	<a href="#"  class="switcher breadcrumb-div-a"> 
	        		<img id="usergridview" src="{{ asset('public/images/title_a.png')}} " title="Grid View"/>
	        	</a>
	        </li>
	        <li>
	        	<a href="#"  class="switcher active breadcrumb-div-a">
	        		<img id="userlistview" src="{{ asset('public/images/list_n.png')}} " title="List View" />
				</a>
			</li>
	        
	        @if (Session::has('user_detail.0'))
			 	@if (count($aUserRole)>0)
             		 @foreach($aUserRole as $key) 
	               		 @if ($key->key =='BLK_USR' && $key->value==1)
					        <li style="margin-right: -3px;">
					        	<a href="#" title="Delete" class="breadcrumb-div-a" onclick="showUserPopup('DELETE USER(S)','delete','deleteusermodal','');getUserIcons('delete')"> 
					        		<img id="u_block" src="{{ asset('public/images/delete_n.png')}} "  title="Delete"/>
					        	</a>
					        </li>
					         @endif
					     @endforeach
					 @else
				         <li style="margin-right: -3px;">
					        	<a href="#" title="Delete" class="breadcrumb-div-a" onclick="showUserPopup('DELETE USER(S)','delete','deleteusermodal','');getUserIcons('delete')"> 
					        		<img id="u_block" src="{{ asset('public/images/delete_n.png')}} "  title="Delete"/>
					        	</a>
					        </li>
			        @endif
			     @endif
	    </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
