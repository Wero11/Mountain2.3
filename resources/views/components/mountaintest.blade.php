 <div id="products" class="row list-group portfolio-item">
    <div class="item col-xs-2 grid-group-item" v-repeat = "list: feedlist">
    	<ul  class="thumbnail">
	    	<li class="clearfix" >
			    <div  class="content_wrap grid_video_wrapper" >  
					
					 <a href="void:(0)" onClick="playvideo(this)" id="@{{list.feed_video}}"  class="html5lightbox" >
			   		  	 <img class="group list-group-image img-responsive" src="<?php echo asset('/public/feed/thumbnail');?>/@{{list.thumbnail}}">
					   </a>
			   		 <div  class='row group inner list-group-item-text video_overlay grid_description' style="margin:0px">  
				   		 <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				            <img src="{{ asset('public/images/eye24.png')}} " class="content_view grid-group-item_view_icon"></img> <span class="likespan">@{{list.FeedsView}}</span>
				        </div>
				        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				            <img src="{{ asset('public/images/thumbgraydefault.png')}} " class="content_like grid-group-item_img_icon"></img><span class="likespan">@{{list.FeedsLike}}</span>
				        </div>
				         <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 content_rank grid-group-item_rank">
				             <span class="rankspan">@{{list.Rank}}</span>
				        </div>
			        	
			    	</div>  
		        </div>		         
	    	</ul>	
    	</div>  
 	</div>
	 
	
<script src="{{ asset('public/js/lib/html5lightbox.js')}}"></script>
 <script>
   function playvideo(object){
     var video = jQuery(object).attr('id');
   html5Lightbox.showLightbox(2, '', '', 650, 370, '/mountain/public/feed/'+video);  
   }
   
   </script>
<style type="text/css">
.lightboxcontainer {
  width:100%;
  text-align:left;
}
.lightboxleft {
  width: 40%;
  float:left;
}
.lightboxright {
  width: 60%;
  float:left;
}
.lightboxright iframe {
  min-height: 390px;
}
.divtext {
  margin: 36px;
}
@media (max-width: 800px) {
  .lightboxleft {
    width: 100%;
  }
  .lightboxright {
    width: 100%;
  }
  .divtext {
    margin: 12px;
  }
}
</style>