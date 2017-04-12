<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
//echo"";print_r($aUserDetail->role);die;
$aUserRole=$aUserDetail->role;
}

?>
<div id="products" class="row list-group portfolio-item">
  <div class="clear-fix">&nbsp;</div>
  <div class="container-fluid">
    <div class="row">

      <div id="no-more-tables">
        <table class="col-md-12 table-striped table-condensed cf notification">
          <thead class="cf">
            <tr height="50">
              <th>NAME</th>
              <th>LAST POST</th>
              <th>SUBJECT</th>
              <th>STATUS</th>

            </tr>
          </thead>
          <tbody>
            <tr v-repeat = "list: notificationlist">
              <td data-title="NAME" style="width:25%;" class="clickablerow" v-on="click:UserDetailPopupforBlock(list.user_id)">
                <span style="float:left;padding:0px 10px 0px 0px;">
                   <img v-if="list.image_path!=null" class="" src="<?php echo asset('/public/upload/thumbnail');?>/@{{list.image_path}}" width="60" height="55" />
                  <img v-if="list.image_path==null" class="" src="<?php echo asset('/public/upload/thumbnail/no-profile.png');?>" width="60" height="55" />

                </span>
                <span style="color:#342453;font-weight:bold;">@@{{list.contactname}}</span>
                </br>
                  <span class="notifytag">@{{list.tags}}</span>
              
              </td>
              <td data-title="LAST POST" style="width:10%" class="clickablerow" v-on="click:UserDetailPopupforBlock(list.user_id)">@{{list.lastpost}}</td>
              <td data-title="SUBJECT" style="width:40%" class="clickablerow" v-on="click:UserDetailPopupforBlock(list.user_id)">
                @{{list.description}}

              </td>
              <td data-title="STATUS" style="width:25%;text-align:center;">
               @if (Session::has('user_detail.0'))
			       @if (count($aUserRole)>0)
		              @foreach($aUserRole as $key) 
		                @if ($key->key =='BLK_NOTIFY_USR' && $key->value==1)
               				 <button class="btn btn-sm btn-danger" onclick="blockUserPopup('@{{list.user_id}}')" style="float:left;">BLOCK</button> 
                 			<img src="{{ asset('public/images/delete5.png')}}" width="25" height="25" onclick="showDeleteNotificationPopup('DELETE NOTIFICATION','show','deletenotificationmodal','',@{{list.id}});" class="deletenotification" style="margin-top:2px;" />
            			 @elseif ($key->key =='DEL_NOFY' && $key->value==1)
							<img src="{{ asset('public/images/delete5.png')}}" width="25" height="25" onclick="showDeleteNotificationPopup('DELETE NOTIFICATION','show','deletenotificationmodal','',@{{list.id}});" class="deletenotification" style="margin-top:2px;" />
            		
		            	@endif
		      		 @endforeach
		      		  @else
		      		   <button class="btn btn-sm btn-danger" onclick="blockUserPopup('@{{list.user_id}}')" style="float:left;">BLOCK</button> 
                 	   <img src="{{ asset('public/images/delete5.png')}}" width="25" height="25" onclick="showDeleteNotificationPopup('DELETE NOTIFICATION','show','deletenotificationmodal','',@{{list.id}});" class="deletenotification" style="margin-top:2px;" />
            		
             	 @endif
		     @endif
              </td>
            </tr>
            

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<style>
  
</style>
