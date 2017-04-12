<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
//echo"";print_r($aUserDetail->role);die;
$aUserRole=$aUserDetail->role;
}

?>
<div id="products" class=" row list-group portfolio-item">
    <div class="judgelist item col-xs-2 grid-group-item" v-repeat = "list: judgelist">
    	<ul class="thumbnail" onclick="selectjudge(this);" id="@{{list.judge_id}}" hide="@{{list.is_hide}}">
	    	<li class="judgeitem clearfix " style="background-color:#F2F2F2 !important" v-class="hide_judge: list.is_hide==1"  >
			    <div  class="content_wrap grid_video_wrapper" > 
			   		<div class="judgetickmark" style="display:none;">
						&#10004;
					</div>
					<img class="group list-group-image img-responsive" v-if="list.ProfileImage" src="<?php echo asset('/public/upload/thumbnail');?>/@{{list.ProfileImage}}">										
					<img class="group list-group-image img-responsive" v-if="!list.ProfileImage" src="<?php echo asset('/public/upload/noimage.jpg');?>">										
			   		<div  class='row group inner list-group-item-text video_overlay grid_description' style="margin:0px">  
			   		    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding-left: 0px!important;">
				            <img src="{{ asset('public/images/judegsmall.png')}} " class="content_view grid-group-item_view_icon" title="Assigned Mountain"></img> 
				            <span class="likespan">@{{list.mountainCount}}</span>
				        </div>
				        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				            <img src="{{ asset('public/images/pushnotificationsmall.png')}} " title="Touch" class="content_like grid-group-item_img_icon" style="margin-top:-2px!important"></img>
				            <span class="likespan">@{{list.touchCount}}</span>
				        </div>	
				       
				        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" v-if="list.is_hide">
				             <span class="likespan"><a href="javascript:void(0)" title="Hide" v-on="click:unhideJudge(list.judge_id)" >Unhide</a></span>
				        </div>	
				        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2  grid-group-item_rank" >
				             <div id="judgedvFlag" style="background-image:url(public/images/flags.png);background-repeat:no-repeat;float:left;height:16px;width:16px;margin-top:6px" class="@{{formVariables.country_code}}"></div>
		            
				        </div>		        	
			    	</div>  
		        </div>
		        <div class="caption grand-parent">
		            <h4 class="group inner list-group-item-heading list-group-item-text parent">
		               @{{ list.first_name }} @{{ list.family_name }} <img src="{{ asset('public/images/hidesmall.png')}} " title="hide" class="hide_icon child" style="float: right;"></img>
		            </h4>

		            <a  class="group inner list-group-item-text" href="#">@{{list.tags}}</a>
		            <div v-repeat="name: list.mountainname" style="font-size:12px;">
			               @{{name.name}} <br/>
			            </div>
		            <p class="group inner list-group-item-text">
		            	BIO: @{{ list.description}}</p>

<p>
		            	 @if (Session::has('user_detail.0'))
					       @if (count($aUserRole)>0)
				              @foreach($aUserRole as $key) 
				                @if ($key->key =='EDT_JUG' && $key->value==1)
						            	<a href="javascript:void(0)" title="Edit" style="float:right " onclick="getJudge(@{{list.judge_id}})">Edit</a>
						         @endif
						       @endforeach
						    @else
							  <a href="javascript:void(0)" title="Edit" style="float:right " onclick="getJudge(@{{list.judge_id}})">Edit</a>
						    @endif
						@endif

		           </p>
		            
	 
	            	  
		        </div>
 
	        </li>
        <div v-if="list.is_hide==1" style="width:100%;position:absolute;padding:0px 10px;">
          <img src="{{ asset('public/images/hidesmall.png')}} " title="un hide" style="top:-73px;float:right;position:relative" onclick="showUnhideJudgePopup('UN HIDE JUDGES','unhide','unhidejudgemodal','',@{{list.judge_id}});"></img>
        </div>

	    </ul>
    </div>
 </div>
<style>
.grand-parent {
  position:relative;
}
.parent {
  overflow:hidden;
}
.child {
  position:absolute; 
  top:-10px; 
  left:-5px;
}
.judgelist>ul.thumbnail:hover { background-color:#9AD3D7 !important; }
</style>

