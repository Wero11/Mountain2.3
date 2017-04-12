<?php 
// Get session

if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
//echo"";print_r($aUserDetail->role);die;
$role_id=$aUserDetail->role_id;
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
	       <li> <h1 class="breadcrumb-div-left">@{{formVariables.mountain_name}}</h1></li>
	      	<li id="progress_bar" style="margin: 5px;font-size: 10px;"> 
	      	<span id="peak_duration" >@{{formVariables.duration}}</span>
		      	<div class="progress">		      	
				  <div id="bar_load" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
				  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
				  </div>
				</div>
			</li>
	        <li>
            <ul class="pagination breadcrumb-div-left nav" v-repeat="peak:peaklist | orderBy 'peak_index'" >
              <li id="@{{peak.id}}" style="cursor:pointer" 
                  v-model="formVariables.peak_id"  
                  class="active_@{{peak.is_finished}}_color"
                  v-on="click: getMountainListById(peak.id,peak.is_finished,peak.Duration);" >@{{peak.peak_index}}			      
              </li>
           </ul>
	       </li>     
	    </ul> 	    
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	     <ul class="nav navbar-nav navbar-right">
	      @if (Session::has('user_detail.0'))
	       @if (count($aUserRole)>0)
              @foreach($aUserRole as $key) 
                @if ($key->key =='SER_MUTN' && $key->value==1)
	     		<li>
	        		<div class="input-group add-on" style="height:25px;margin-right: 3px;">
					  <input type="text" class="k-textbox form-control" style="height: 25px;" placeholder="Search"  id="feedSearchString" v-on="keydown: getMountainListById(formVariables.peak_id) | key 'enter'">
					  <div class="input-group-btn">
						<button class="btn btn-default" id="btnSearch" type="submit" style="height: 25px;padding: 2px 12px!important" v-on="click: getMountainListById(formVariables.peak_id)"><i class="fa fa-search"></i></button>
					  </div>
					</div>		
	        	</li>
	         @endif
		       @endforeach
		         @else
			        <li>
		        		<div class="input-group add-on" style="height:25px;margin-right: 3px;">
						  <input type="text" class="k-textbox form-control" style="height: 25px;    font-size: 12px;" placeholder="Search"  id="feedSearchString" v-on="keydown: getMountainListById(formVariables.peak_id) | key 'enter'">
						  <div class="input-group-btn">
							<button class="btn btn-default" id="btnSearch" type="submit" style="height: 25px;padding: 2px 12px!important" v-on="click: getMountainListById(formVariables.peak_id)"><i class="fa fa-search"></i></button>
						  </div>
						</div>		
		       		 </li>
		        @endif
		     @endif
	        @if (Session::has('user_detail.0'))
	         	@if (count($aUserRole)>0)
             		 @foreach($aUserRole as $key) 
	         			@if ($key->key =='CRE_MUTN' && $key->value==1)
	       					<li> <button id="m_create" class="breadcrumb-btn_mountain_active" onclick="onShowCreatePopup();getIcons('create');">Create Mountain</button></li>
	      			 	@endif
		      	 	@endforeach
		         @else
		         <li> <button id="m_create" class="breadcrumb-btn_mountain_active" onclick="onShowCreatePopup();getIcons('create');">Create Mountain</button></li>
		        @endif
		     @endif
	      	<li> 
	      		 <select 
	                class="breadcrumb_mountain_property form-control" 
	                id="mountain_id" style="height:24px!important;padding-top:2px!important;font-size: 12px;"
	                v-model="formVariables.mountain_id" 
	                v-on="change: getMountainPeak(formVariables.mountain_id);">
<OPTGROUP LABEL="Fame"> 
	                <option 
	                  v-repeat="mountainfame: mountainlist.fame"
	                  v-attr="selected: mountainfame.is_main == 1" 
	                    class="active_@{{mountainfame.is_main}}"  
	                  value="@{{mountainfame.id}}">@{{mountainfame.name}}
	                </option>    
	                </OPTGROUP> 
	                 <OPTGROUP LABEL="Advertise"> 
	                <option 
	                  v-repeat="mountainadv: mountainlist.advertise"
	                  v-attr="selected: mountainadv.is_main == 1" 
	                   class="active_@{{mountainadv.is_main}}"  
	                  value="@{{mountainadv.id}}">@{{mountainadv.name}}
	                </option>    
	                </OPTGROUP>  
	               <!-- <option 
	                  v-repeat="mountain: mountainlist" 
	                  v-attr="selected: mountain.is_main == 1"  
	                  value="@{{mountain.id}}">@{{mountain.name}}
	                </option>  -->                              
	            </select>
	            <input type="hidden" value="<?php echo $role_id?>" id="hdn_role_id"/>
			</li>
			
	        <li> 
	        	<a href="#"  class="switcher breadcrumb-div-a"> 
	        		<img id="gridview" src="{{ asset('public/images/title_a.png')}} " title="Grid View"/>
	        	</a>
	        </li>
	        <li>
	        	<a href="#"  class="switcher active breadcrumb-div-a">
	        		<img id="listview" src="{{ asset('public/images/list_n.png')}} "  title="List View"/>
				</a>
			</li>
			 @if (Session::has('user_detail.0'))
			 	@if (count($aUserRole)>0)
             		 @foreach($aUserRole as $key) 
	               		 @if ($key->key =='PUS_NOFY' && $key->value==1)
					        <li>
					        	<a href="#" class="breadcrumb-div-a"  onClick="getPushPopup();getIcons('push');" >  
					        		<img id="m_push" src="{{ asset('public/images/push_n.png')}} " title="Push Notification"/>
							    </a>
							</li>
						@elseif ($key->key =='ASN_JUG' && $key->value==1)
					        <li>
					        	<a href="#" class="breadcrumb-div-a"  onClick="getJudgesPopup();getIcons('judge');" >  
					        		<img id="m_judge" src="{{ asset('public/images/assignjudge_n.png')}} " title="Assign Judges"/>
							    </a>
							</li>
						@elseif ($key->key =='EDT_MUTN' && $key->value==1)
							<li style="margin-right: -3px;">
					        	<a href="#" class="breadcrumb-div-a" > 
					        		<img id="m_edit" src="{{ asset('public/images/setting_n.png')}} " title="Edit Mountain"/>
					        	</a>
					        </li>
					        @elseif ($key->key =='ALL_MUTN' && $key->value==1)
							 <li>
								<a href="#" class="breadcrumb-div-a"   v-on="click:getAdminCurrentMountain(formVariables.country_id);">  
				        		<img id="m_history" src="{{ asset('public/images/histroy_n.png')}} " title="All Mountain"/>
						    	</a>
						    </li>
		            	@endif
		      		 @endforeach
		      		  @else
		      		   	<li>
					        <a href="#" class="breadcrumb-div-a"  onClick="getPushPopup(); getIcons('push');
						        " >  
					        	<img id="m_push" src="{{ asset('public/images/push_n.png')}} " title="Push Notification"/>
							 </a>
						</li>
						 <li>
				        	<a href="#" class="breadcrumb-div-a"  onClick="getJudgesPopup(); getIcons('judge');
					        	" >  
				        		<img id="m_judge" src="{{ asset('public/images/assignjudge_n.png')}} " title="Assign Judges"/>
						    </a>
						</li>
						<li style="margin-right: -3px;">
				        	<a href="#" class="breadcrumb-div-a" > 
				        		<img id="m_edit" src="{{ asset('public/images/setting_n.png')}} " title="Edit Mountain"/>
				        	</a>
				        </li>
				         <li>
                             <a href="#" class="breadcrumb-div-a"   v-on="click:getAdminCurrentMountain(formVariables.country_id);">  
				        		<img id="m_history" src="{{ asset('public/images/histroy_n.png')}} " title="All Mountain"/>
						    </a>
						</li>
		      	 @endif
		     @endif

	    </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-left recentjudgehead" id="assign_lbl">
  ASSIGNED JUDGES
</div>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 text-left recentjudgecontent`">
  <div id="recentjudge">
    <!--<modal
	    :model="assignedjudgelist">
	  </modal>-->

  </div>
</div>
<script id="judgeTemplate" type="x-jquery-tmpl">
  <div class="recentjudgeitem">
    <h3 id="${judge_id}">
      <span class="recentjudgeimage">
        <img src="public/upload/${ProfileImage}" width="45" height="45" style="webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;"/>
      </span>
      <span class="recentjudgelabel">
        ${first_name}
      </span>
      <button type="button" class="close" onClick="deleteJudge(${judge_id})">
        <span>×</span>
      </button>
    </h3>
  </div>
</script>
<style>


</style>
