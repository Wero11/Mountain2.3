<!-- create/edit mountain -->
<div class="modal modal-wide fade" id="blcokusermodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick="getIcons('default');"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="modal-title">Block User</h4>
         </div>
		 <form class="form-horizontal" action="" method="POST" id="frmblcokuser">
        	 <div class="modal-body ">
            	<div class="row  popup-form">
               		
					   <div class="col-md-12">

                 <div class="row">
                   <div class="col-xs-12">
                     <label class="control-label" for="blocktype">
                       Block Type <span style="color:#ED7476">*</span>
                     </label>
                     <div id="blocktypeelement">
                     <input type="radio" name="blocktypes" id="temp" value="TEMP" class="blocktype" checked /> <label for="temp" class="control-label">Temporary Block</label>
                     &nbsp;&nbsp;&nbsp;&nbsp;
                     <input type="radio" name="blocktypes" id="perm" value="PERM" class="blocktype" />
                     <label for="perm" class="control-label">Permanent Block</label>
                     </div>
                   </div>
                 </div>
               <div class="row" id="daterangerow">
                 <div class="col-xs-12">
                   <label class="control-label" for="daterange">
                     Date Range<span style="color:#ED7476">*</span>
                   </label>
                   <input type="number" min="1" value="10" id="daterange" name="daterange" class="required form-control" style="width:90% !important;float:left;margin-bottom: 5px" />
                   <span class="daystyle">Day(s)</span>
                 </div>
               </div>
                  <div class="row">
		                  <div class="col-xs-12">
		                      <label class="control-label" for="description">Description<span style="color:#ED7476">*</span></label>
		                      <textarea id="description" name="description" class="required form-control"  rows="5"  maxlength="255" style="margin-bottom: 5px"></textarea>
		                  </div>
		              </div>
               <div class="row">
                 <div class="col-xs-12">
                   <label class="control-label" for="adminnote">
                     Admin Note
                   </label>
                   <textarea id="adminnote" name="adminnote" class="form-control"  rows="5"  maxlength="255" style="margin-bottom: 5px"></textarea>
                 </div>
               </div>
							
		              <div class="row btn-holder text-center">
		                <span id="user_error" class= "error_new"></span>
		                  <div class="col-xs-12">
		                      <button type="button" id="blockuser" class="btnblockuser" v-on="click:blockUser()">Ok</button>
		                      <button type="button" class="btncancelblock" data-dismiss="modal" onClick="getIcons('default');">Cancel</button>
		                  </div>
		              </div>
						</div>
               
    				</div>
				</div>
       <input type="hidden" name="user_id" id="user_id" value="" />
       <input type="hidden" name="notific_id" id="notific_id" value="" />
			</form>
		</div>
	</div>
</div>
<style>
  #frmblcokuser label.control-label{
  font-weight:600 !important;
  font-size:13px !important;
  color:#331B4D;
  }
  #frmblcokuser div.row{
  margin-bottom:10px !important;
  }
  #blocktypeelement{
  padding-left:10px;
  }
  .daystyle{
  float:left;
  padding:7px 3px;
  font-weight:600 !important;
  font-size:13px !important;
  color:#331B4D;
  }
 .btnblockuser{
  background: #331B4D !important;
  text-transform: uppercase;
  color: #fff !important;
  text-shadow: none !important;
  border: 1px solid #331B4D !important;
  font-weight: 600;
  font-size: 12px;
  padding: 5px 15px;
  width: 100px;
  border-radius: 2px;
  }
  .btncancelblock{
  background: #757575 !important;
  text-transform: uppercase;
  color: #fff !important;
  text-shadow: none !important;
  border: 1px solid #757575 !important;
  font-weight: 600;
  font-size: 12px;
  padding: 5px 15px;
  width: 100px;
  border-radius: 2px;
  }
</style>
<script>
  
 
</script>

        