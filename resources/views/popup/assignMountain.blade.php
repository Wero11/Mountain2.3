<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="assignmountainmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" style="width:730px!important">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick="getJudgeIcons('default');" ><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">ASSIGN MOUNTAIN</h4>
          	
         </div>
		 <form class="form-horizontal" action="" method="POST" id="assign_mountain">
        	 <div class="modal-body ">            										  
				<div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:10px;"><h4 class="mainmountainhead">Main Mountain</h4></div>	  				
				<div id="arrowL" onclick="arrowLeft('mitem')"><img src="public/images/button-previous.png" /></div>
				<div id="arrowR" onclick="arrowRight('mitem')"><img src="public/images/button-next.png" /></div>
				<div id="list-container">
					<div class='list'>
						<div class='thumbnail mitem' id="@{{list.id}}" v-repeat = "list: mainMountain" onclick="selectMountain(this,@{{list.id}})">
							<img v-if="list.image_path" src="<?php echo asset('/public/upload');?>/@{{list.image_path}}" id="@{{list.id}}" class="mountainimage" />
							<img v-if="!list.image_path" src="<?php echo asset('/public/mountain/HeaderBGLogo.png');?>" id="@{{list.id}}" class="mountainimage" />		
							<p class="thumbhead">@{{list.name}}</p>
							<p>@{{list.start_date}} - @{{list.end_date}}</p>
						</div>
												 						   							 
					</div>
				</div>				
				<div class="col-sm-12 col-md-12 col-xs-12" style="margin-top:10px;">
					<h4 class="commountainhead">Commercial Mountain</h4>
				</div>
				<div id="carrowL" onclick="arrowLeft('citem')"><img src="public/images/button-previous.png" /></div>
				<div id="carrowR" onclick="arrowRight('citem')"><img src="public/images/button-next.png" /></div>
				<div id="clist-container" style="padding-bottom:20px;">
					<div class='list'>
						<div class='thumbnail citem' id="@{{list.id}}" v-repeat = "list: commercialMountain" onclick="selectMountain(this,@{{list.id}})">
							<img v-if="list.image_path" src="<?php echo asset('/public/upload');?>/@{{list.image_path}}" id="@{{list.id}}" class="mountainimage" />
							<img v-if="!list.image_path" src="<?php echo asset('/public/mountain/HeaderBGLogo.png');?>" id="@{{list.id}}" class="mountainimage" />
							<p class="thumbhead">@{{list.name}}</p>
							<p>@{{list.start_date}} - @{{list.end_date}}</p>
						</div>
					</div>
				</div>											
				<div class="row btn-holder text-center">
				 <span id="judge_error" class= "error_new"></span>
					<div class="col-xs-12">
						<input type="hidden" name="mountain_id" id="mountain_id"/>
						<button type="button" class="btn btn-primary" id="assign_mountain"  v-on="click:assignMountain()">ASSIGN</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" onClick="clearMountain();getJudgeIcons('default')">CANCEL</button>
					</div>
				</div>
				</div>				
			</form>
		</div>
	</div>
</div>
<style>
  
#list-container,#clist-container {
overflow:hidden;    
width: 600px;  
float:left;    
margin:0px 20px !important;
}

.list{
    
	min-width:30000px;
    float:left;
	overflow:hidden; 
}


#arrowR,#carrowR{

    width:20px;
    float:right;
    cursor:pointer;
	margin-top:100px !important;
}


#arrowL,#carrowL{
	
    width:20px;
  
    float:left;
    cursor:pointer;
	margin-top:100px !important;
}

.mitem, .citem{
    background:gray;
	width:141px;
    height:auto;
    margin:5px;
    float:left;
    position:relative;
}
.mountainimage{
	width:100% !important;
}

.selected-image{
	background:#778AA0 !important;
	color: #fff;
}
.thumbnail{
	padding:6px;
}
.thumbnail img{
	margin-left : auto;
	margin-right: auto;
}
.mitem p,.citem p{
	text-align:center !important;
	font-size: 12px;
}
.thumbhead{
	font-weight:bold;
	padding-top:10px;
}
#list-container > div > div.thumbnail{
	height:175px !important;
}
</style>


        