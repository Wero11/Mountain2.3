<!-- create/edit mountain -->
<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
//echo"";print_r($aUserDetail->role);die;
$aUserRole=$aUserDetail->role;
}

?>
<div class="modal modal-wide fade" id="userdetailblockmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <a style="padding:3px 4px 3px 6px !important;float:right;cursor:pointer;" aria-hidden="true" data-dismiss="modal" onClick="getIcons('default');"><img src="{{ asset('public/images/close.png')}}" height="20px" width="20px"></a>
          	<h4 class="user-modal-title">USER DETAILS</h4>
         </div>
		
        	 <div class="modal-body ">
            	<div class="row  popup-form" v-repeat = "list: userdetails">
               		
					   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                     <img class="" v-if="list.ProfileImage!=null" src="<?php echo asset('/public/upload/thumbnail');?>/@{{list.ProfileImage}}" width="175" height="175" style="border-radius:50%" />
                       <img class="" v-if="list.ProfileImage==null" src="<?php echo asset('/public/upload/thumbnail/no-profile.png');?>" width="175" height="175" style="border-radius:50%" />
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 userinfoblock1">
                     <div id="username">@{{list.first_name}} @{{list.family_name}}</div>
                     <div id="usertag">@{{list.tags}}</div>
                     <div id="userprofile">PROFILE - @{{list.description}}</div>
                     
                   </div>
                </div>
               
               
							
		              
						</div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px !important">

                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-left:10px !important">
                      <img class="" v-if="list.gender=='M'" src="<?php echo asset('/public/images/male (1).png');?>">
                      <img class="" v-if="list.gender=='F'" src="<?php echo asset('/public/images/female.png');?>">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 userinfoblock">
                      <div id="countarea">
                        <span id="usereyes">
                          <img src="{{ asset('public/images/eyedefault.png')}}" width="25" height="25" /> &nbsp;@{{list.countFans}}
                        </span>
                        <span id="userstar">

                          <img src="{{ asset('public/images/grey-star.png')}}" width="18" height="18" /> &nbsp;@{{list.countIdols}}

                        </span>

                      </div>

                    </div>
                
                  </div>
                </div>
    				</div>
            <div v-if="userfeedlist[0].feed_id!=''">
             <div class="row  popup-form" style="border-top:2px solid #EAE8E8;padding:5px;" v-repeat="list: userfeedlist">
               <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding:1px !important">
                 <a href="#" onClick="playvideo(this)" id="@{{list.feed_video}}"  class="html5lightbox" >
                   <img class="" src="<?php echo asset('/public/feed/thumbnail');?>/@{{list.thumbnail}}" width="100" height="100" />
                 </a>
                 </div>
               <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="padding:0px !important">
                 <div id="mountaintitle">
                   Mountain Name : <span>@{{list.mountain_name}}</span>
                 </div>
                 <div id="abusetitle">
                   Abused by : <span v-if="list.abusedby">@{{list.abusedby}}, @{{list.tags}}</span>
                   <span v-if="!list.abusedby">&nbsp;-</span>
                 </div>
                 <div id="mountaincomment">
                   Comments : @{{list.feed_description}}
                 </div>
                 <div id="mountaincloseicon">
                   @if (Session::has('user_detail.0'))
				       @if (count($aUserRole)>0)
			              @foreach($aUserRole as $key) 
			                @if ($key->key =='DEL_FEED' && $key->value==1)
                   				<img src="{{ asset('public/images/close3.png')}}" width="13" height="13" style="position:absolute;right:5px;top:0;cursor:pointer" onclick="showDeleteFeedPopup('DELETE FEED','show','deletefeedmodal','',@{{list.feed_id}});" title="Block Feed" />
                 			@endif
					      @endforeach
					   @else
					        	 <img src="{{ asset('public/images/close3.png')}}" width="13" height="13" style="position:absolute;right:5px;top:0;cursor:pointer" onclick="showDeleteFeedPopup('DELETE FEED','show','deletefeedmodal','',@{{list.feed_id}});" title="Block Feed" />
                 	  @endif
				@endif
                 
                 </div>
               </div>
               </div>
             </div>
            <div v-show="!userfeedlist || userfeedlist.result==false">
              <div style="margin-top:10px;text-align:center" class="norecord">
                <h3>No Feeds Found</h3>
              </div>
             </div>
           </div>
             <div class="row btn-holder text-center">
               <span id="user_error" class= "error_new"></span>
               <div class="col-xs-12">
                 <button type="button" class="btncancelblock" data-dismiss="modal" onClick="getIcons('default');">Cancel</button>
               </div>
             </div>
        <div class="clear-fix">&nbsp;</div>
				</div>
       
	
		</div>
	</div>

<style>
  .userinfoblock{
  padding:0px 30px;
  }
  .userinfoblock1{
  padding:20px 40px;
  }
  #username{
  color:#162363;
  font-size:13px;
  text-transform: uppercase;
  font-weight:600;
  line-height:15px;
  }
  #usertag{
  color:#5BB3BA !important;
  text-decoration:underline;
  font-size:13px;
  line-height:30px;
  }
  #userprofile{
  color:#162363;
  font-size:13px;
  padding-bottom:40px;
  }

  #userstar{
  padding-left:20px;
  color:#8E8E8E;
  }
  #usereyes{
  color:#8E8E8E;
  }
  #mountaintitle, #mountaincomment{
  padding-bottom:10px;
  color:#162363;
  font-size:13px;
  font-weight:bold;
  }
  #mountaintitle{
  padding-top:10px;
  }
  #mountaintitle span{
  text-transform:uppercase;
  }
  #abusetitle{
  padding-bottom:10px;
  color:#B7B7B7;
  font-size:13px;
  font-weight:bold;
  }
</style>
<script>
  
 
</script>

        