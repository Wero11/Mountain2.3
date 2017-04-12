<div id="products" class=" row list-group portfolio-item">
    <div class="judgelist item col-xs-2 grid-group-item" v-repeat = "list: judgelist">
    	<ul class="thumbnail" onclick="selectjudge(this);" id="@{{list.judge_id}}">
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
				        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				             <span class="likespan"><a href="javascript:void(0)" title="Edit" onclick="getJudge(@{{list.judge_id}})">Edit</a></span>
				        </div>
				        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" v-if="list.is_hide">
				             <span class="likespan"><a href="javascript:void(0)" title="Hide" v-on="click:unhideJudge(list.judge_id)" >Unhide</a></span>
				        </div>			        	
			    	</div>  
		        </div>
		        <div class="caption grand-parent">
		            <h4 class="group inner list-group-item-heading list-group-item-text parent">
		               @{{ list.first_name }} @{{ list.family_name }} <img src="{{ asset('public/images/hidesmall.png')}} " title="hide" class="hide_icon child" style="float: right;"></img>
		            </h4>

		            <a  class="group inner list-group-item-text" href="#">@{{ list.tags}}</a>
		            
		            <p class="group inner list-group-item-text">
		            	PROFILE : @{{ list.description}}
		            </p>
		        </div>
	        </li>
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

