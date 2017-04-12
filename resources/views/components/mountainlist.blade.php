 
 <div id="products" class="row list-group portfolio-item">
	<div class="mountain_list item col-xs-2 grid-group-item" v-repeat = "list: feedlist">
    	<ul  class="thumbnail"  onclick="selectmountain(this);" id="@{{list.feed_id}}">
	    	<li class="clearfix" style="background-color:#F2F2F2 !important">
			    <div  class="content_wrap grid_video_wrapper" >  
					
					 <a href="#" onClick="playvideo(this)" id="@{{list.feed_video}}"  class="html5lightbox" >
			   		  	 <img class="group list-group-image img-responsive" src="<?php echo asset('/public/feed/thumbnail');?>/@{{list.thumbnail}}">
					 </a>
			   		 <div  class='row group inner list-group-item-text video_overlay grid_description' style="margin:0px">  
				   		 <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding-left: 0px!important;">
				            <img src="{{ asset('public/images/eye24.png')}} " class="content_view grid-group-item_view_icon"></img> <span class="likespan">@{{list.FeedsView}}</span>
				        </div>
				        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				            <img src="{{ asset('public/images/thumbgraydefault.png')}} " class="content_like grid-group-item_img_icon"></img><span class="likespan">@{{list.FeedsLike}}</span>
				        </div>
				         <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 content_rank grid-group-item_rank" style="background: #FEBA00 none repeat scroll 0 0;">
				             <span class="rankspan">@{{list.Rank}}</span>
				        </div>
			        	
			    	</div>  
		       </div>
		       <div class="caption">
		            <h4 class="group inner list-group-item-heading list-group-item-text">
		               @{{ list.first_name }} @{{ list.family_name }}
		            </h4>
		            <a  class="group inner list-group-item-text" href="#">@{{ list.feed_description }}</a>
		            <p class="group inner list-group-item-text">
		            	#@{{ list.mountain_hash}},@{{ list.feed_hash}}<br/>
		            	<a href="javascript:void(0)" title="Delete" style="float:right " onclick="showDeleteFeedPopup('DELETE FEED','show','deletefeedmodal','',@{{list.feed_id}});">Delete</a>
		            </p>
             <div class="mountaintickmark" style="display:none;">
               &#10004;
             </div>
	        </div>
        </li>
	 </ul>
   </div>
 </div>
<div class="text-center" style="margin-bottom:20px"><a href="#" id="show_more" onclick="ShowPost();pageNumber++;">Show More</a></div>
 
<script id="mountainTemplate" type="x-jquery-tmpl">
  <div class="item col-xs-2 grid-group-item"">
<ul  class="thumbnail"  onclick="selectmountain(this);" id="${feed_id}">
	<li class="clearfix" style="background-color:#F2F2F2 !important">
	    <div  class="content_wrap grid_video_wrapper" >  
			
			 <a href="#" onClick="playvideo(this)" id="${feed_video}"  class="html5lightbox" >
	   		  	 <img class="group list-group-image img-responsive" src="<?php echo asset('/public/feed/thumbnail');?>/${thumbnail}">
			 </a>
	   		 <div  class='row group inner list-group-item-text video_overlay grid_description' style="margin:0px">  
		   		 <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding-left: 0px!important;">
		            <img src="{{ asset('public/images/eye24.png')}} " class="content_view grid-group-item_view_icon"></img> <span class="likespan">${FeedsView}</span>
		        </div>
		        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		            <img src="{{ asset('public/images/thumbgraydefault.png')}} " class="content_like grid-group-item_img_icon"></img><span class="likespan">${FeedsLike}</span>
		        </div>
		         <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 content_rank grid-group-item_rank" style="background: #FEBA00 none repeat scroll 0 0;">
		             <span class="rankspan">${Rank}</span>
		        </div>
	        	
	    	</div>  
       </div>
       <div class="caption">
            <h4 class="group inner list-group-item-heading list-group-item-text">
               ${first_name} ${family_name }
            </h4>
            <a  class="group inner list-group-item-text" href="#">${feed_description }</a>
            <p class="group inner list-group-item-text">
            	#${mountain_hash},${feed_hash}

<br/>
		         <a href="javascript:void(0)" title="Delete" style="float:right " onclick="showDeleteFeedPopup('DELETE FEED','show','deletefeedmodal','',${feed_id});">Delete</a>
            </p>
     <div class="mountaintickmark" style="display:none;">
       &#10004;
     </div>
    </div>
</li>
</ul>
</div>
</script>
