 
 <div id="products" class="row list-group portfolio-item mountain_child_list">
	<div class="mountain_list item col-xs-2 grid-group-item" v-repeat = "list: feedlist">
    	<ul  class="thumbnail"  onclick="selectmountain(this);" id="@{{list.feed_id}}">
	    	<li class="clearfix" style="background-color:#F2F2F2 !important">
			    <div  class="content_wrap grid_video_wrapper" >  
					 <a href="#" onClick="playvideo(this)" id="@{{list.feed_video}}"  class="html5lightbox" >
			   		  	 <img class="group list-group-image img-responsive" v-if="list.thumbnail" src="<?php echo asset('/public/feed/thumbnail');?>/@{{list.thumbnail}}">
<img class="group list-group-image img-responsive" v-if="!list.thumbnail" src="<?php echo asset('/public/upload/noimage.jpg');?>">
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
<span style="font-size: 12px;">@@{{ list.user_name }}<span>
		            <a  class="group inner list-group-item-text" href="#">@{{ list.feed_description }}</a>
		            <p class="group inner list-group-item-text">
		            	#@{{ list.mountain_hash}},@{{ list.feed_hash}}<br/>
		            	<div id="icon_div" style="margin-bottom:17px;" ><a href="javascript:void(0)" title="Delete" 
		            	class="icon_div_right" onclick="showDeleteFeedPopup('DELETE FEED','show','deletefeedmodal','',@{{list.feed_id}});"> <img src="{{ asset('public/images/Delete22_n.png')}} " >
		            	</img></a><a href="javascript:void(0)" id="@{{list.feed_video}}" 
		            	onclick="SaveToDisk(this)" style="width:35px;" title="Download"><img 
		            	src="{{ asset('public/images/downlaod22.png')}} " class="icon_div_right"></img></a>
</div>
		         
		            </p><br/><br/>
             <div class="mountaintickmark" style="display:none;">
               &#10004;
             </div>
	        </div>
        </li>
	 </ul>
   </div>
 </div>
  <div  class="history_list row list-group portfolio-item mount_invisible">
  <nav> <ul class="pager" style="margin:0px 0px 0px 0px!important">
                            <li  v-show="pagination.page >=2" class="previous "><a v-on="click:paginate('previous')" class="page-scroll" href="#"><< Previous</a></li>
                            <li   v-show="pagination.next" class="next"><a v-on="click:paginate('next')" class="page-scroll" href="#">Next >></a></li>                        </ul>
                    </nav>
  <div class="clear-fix">&nbsp;</div>
  <div class="container-fluid">
    <div class="row">

      <div id="no-more-tables">
        <table class="col-md-12 table-striped table-condensed ">
          <thead class="cf">
            <tr height="50">
              <th>NAME</th>
              <th>START DATE</th>
              <th>END DATE</th>
              <th>TYPE</th>
              <th >
                STATUS
              </th>
              <th>&nbsp;</th>

            </tr>
          </thead>
          <tbody>
            <tr v-repeat = "list: historylist">
              <td data-title="NAME" style="width:25%;" class="clickablerow" v-on="click:getMountainPeak(list.id);">
                <span style="float:left;padding:0px 10px 0px 0px;">
                  <img v-if="list.image_path" class="" src="<?php echo asset('/public/upload');?>/@{{list.image_path}}" width="60" height="55"   />
                  <img v-if="!list.image_path" class="" src="<?php echo asset('/public/upload/noimage.jpg');?>" width="60" height="55" />

                  </span>
                <span style="color:#342453;font-weight:bold;">@{{list.name }}</span>
                </br>
                  <span class="notifytag">@{{list.hash_tag}}</span>

              </td>
              <td data-title="START DATE" style="width:20%">@{{list.start_date}}</td>
              <td data-title="END DATE" style="width:25%" >
                @{{list.end_date}}

              </td>
              <td data-title="TYPE" style="width:10%;">
              <span class="notifytag" v-if="list.is_main=='1'">Fame</span>
              <span class="notifytag" v-if="list.is_main=='0'">Advertise</span>
               </td>
              <td data-title="STATUS" style="width:5%;text-align:center;">

                <img src="{{ asset('public/images/delete-new.png')}}" width="25" height="25" 
                         onclick="showDeleteMountainPopup('DELETE MOUNTAIN','show','deletemountainmodal','',@{{list.id}});" class="deletenotification" style="margin-top:2px;" />
              
              </td>
            </tr>
            

          </tbody>
        </table>
<div style="clear:both;">&nbsp;</div>
<div style="clear:both;">&nbsp;</div>
<div class="modalloader" style="display: none">
    <div class="centerloader">
        <img alt="" src="{{ asset('public/images/feedback_loading.gif')}}" />
    </div>
</div>
      </div>
    </div>

  </div>
</div>
<div class="text-center" style="margin-bottom:20px;"><a href="#" id="show_more" onclick="ShowPost();pageNumber++;" style="display:none"><img src="{{ asset('public/images/morefeeds.png')}} " ></img></a></div>
 
<script id="mountainTemplate" type="x-jquery-tmpl">
  <div class="item col-xs-2 grid-group-item"">
<ul  class="thumbnail"  onclick="selectmountain(this);" id="${feed_id}">
	<li class="clearfix" style="background-color:#F2F2F2 !important">
	    <div  class="content_wrap grid_video_wrapper" >  
			
			 <a href="#" onClick="playvideo(this)" id="${feed_video}"  class="html5lightbox" >
	   		  	 <img class="group list-group-image img-responsive"  src="<?php echo asset('/public/feed/thumbnail');?>/${thumbnail}">
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
<span style="font-size: 12px;">@${user_name }<span>
            <a  class="group inner list-group-item-text" href="#">${feed_description }</a>
            <p class="group inner list-group-item-text">
            	#${mountain_hash},${feed_hash}
<br/>
<div style="margin-bottom:17px;" ><a href="javascript:void(0)" title="Delete"  
onclick="showDeleteFeedPopup('DELETE FEED','show','deletefeedmodal','',${feed_id});"> 
<img src="{{ asset('public/images/Delete22_n.png')}} " class="icon_div_right"></img></a>
<a href="javascript:void(0)" id="${feed_video}" onclick="SaveToDisk(this)" style="width:35px;" title="Download">
<img src="{{ asset('public/images/downlaod22.png')}} "  class="icon_div_right" ></img></a>
</div>
		       
            </p><br/><br/>
     <div class="mountaintickmark" style="display:none;">
       &#10004;
     </div>
    </div>
</li>
</ul>
</div>

</script>
