<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="assignjudgemodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick="getIcons('default');"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">ASSIGN JUDGE[s]</h4>
         </div>
		 <form class="form-horizontal" action="" method="POST" id="assign_judge">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               		   
                        <form class="form-horizontal" method="POST" action="">
                           
							<div class="col-sm-12 col-md-12 col-xs-12">
							
								<select multiple="multiple" 
				                     class="breadcrumb_mountain_property" 
				                     id="judge_id" onChange="onCheckSelect()">
				                 </select>
								 <div id="no-judge" style="position:relative;top:-100px;padding:20px 0px;display:none;width:100%;text-align:center;">No Judges Available. <a href="managejudge">Click here</a> to go to Manage judge.</div>
								  </div>
								 	  </div>
								 	   <span id="judge_error" class= "error_new"></span>
										<div class="col-sm-11 col-md-11 col-xs-12" style="margin-top:15px;" id="assign_judge_lbl">
								<h5 class="recentassignedhead">RECENTLY ASSIGNED JUDGES</h5>
							</div>
							<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background:#EFEFEF;padding:10px 0px !important;margin:10px -20px !important;width:108% !important;" id="assign_judge_container">
								
								<div id="aContainer">
									<div id="assignedarrowL">
										<img src="public/images/button-previous.png" />
									</div>
									<div id="assignedarrowR">
										<img src="public/images/button-next.png" />
									</div>
									<div class='assignedlist' id="a_temp_judge" style="min-height:140px;">
									</div>
								</div>	
							</div>
                          
                            <div class="row btn-holder text-center">
		                     
		                        <div class="col-xs-12">
		                        
		                            <button type="button" class="btn btn-primary" id="assign_btn" onClick="assignJudgesToMountain()">Ok</button>
		                            <button type="button" class="btn btn-default" data-dismiss="modal" onClick="getIcons('default');">Cancel</button>
		                        </div>
		                    </div>
                        </form>
                   
				</div>
				
			</form>
		</div>
	</div>
</div>
<script id="clientTemplate" type="x-jquery-tmpl">
		<div class="assigneditem recentlist">
			<div class="" id="${judge_id}" style="padding-left:0px!important;padding-right:0px!important" >
				<div class="text-right">
					<img id="j_close_img" src="{{ asset('/public/images/close_small_icon.gif') }}" width="15" height="15" class="imgclose" 
						onClick="deleteJudge(${judge_id})"/>
				</div>
				<div class="text-center">
					<img src="public/upload/${ProfileImage}" width="75" height="75" class="imgrecent" />
				</div>
				<div class="jrecentname text-center">
					${first_name}
				</div>
			</div>
		</div>
</script>
<style>
  .btn-group, .btn-group-vertical{
  width:95% !important;
  }
  .input-group{
  width:97% !important;
  }
  .multiselect {
  width: 100% !important;
  }
  .btn .caret{
  float:right;

  margin-top:10px !important;
  }
  .multiselect-selected-text{
  float:left;
  margin:2px !important;
  }
  .jrecentname{
  padding:10px 0px;
  font-weight:bold;
  color:#331B4D;
  text-transform:uppercase;
  }
  .open > .dropdown-menu{
  width:100% !important;
  }
  .ms-container .ms-list{
  border: 0px none !important;
  }
  .ms-selected{
  background:#E1DBE8;
  }
  .ms-elem-selectable{
  margin: 1px 0px !important;
  }
  .search-input{

  background: url("public/images/search-icon.png") top right no-repeat;
  height:38px;
  padding-right:30px;
  }
  .judgeimage{
  border-radius: 50% !important;
  }
  .recentlist{
  padding: 0px 5px !important;
  margin: 0px 8px !important;
  background:#C7C1CE !important;
  }
  .recentlist:hover{
  cursor:pointer;
  }
  .imgrecent{
  border-radius: 50%;
  }
  .selected-judge{
  background:#778AA0 !important;
  color: #fff;
  }

  #aContainer{
  overflow:hidden;
  width: 500px;
  float:left;
  margin:0px 20px !important;
  }

  .assignedlist{

  min-width:30000px;
  float:left;
  overflow:hidden;
  }


  #assignedarrowR{

  width:20px;
  position:absolute;
  right:10px;
  cursor:pointer;
  top:70px;
  }


  #assignedarrowL{

  width:20px;
  position:absolute;
  left:10px;
  cursor:pointer;
  top:70px;
  }

  .assigneditem{
  background:gray;
  width:85px;
  height:auto;
  margin:5px;
  float:left;
  position:relative;
  }
  .recentassignedhead{
   
    font-weight: bold;
    color: #331B4D;
    text-transform: uppercase;
  }

</style>
