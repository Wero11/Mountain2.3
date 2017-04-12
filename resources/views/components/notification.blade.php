<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
//echo "<pre>";print_r($aUserDetail);
  $aUserRole=$aUserDetail->role;
  if($aUserDetail->role_id==1){
    $viewnotify=true;
    $statushead=true;
  }else{
    $viewnotify=false;
    $statushead=false;
    foreach($aUserRole as $key){
      if($key->key=='VIEW_NOFY'){
        $viewnotify=true;
      }
      if($key->key=='BLK_NOTIFY_USR' || $key->key=='DEL_NOFY' ){
        $statushead=true;
      }
    }
   }
 
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
              <th>REPORTER</th>
              <th>
                @if ($statushead==true)
                STATUS
                @endif
              </th>
              <th>&nbsp;</th>

            </tr>
          </thead>
          <tbody>
            <tr v-if="notificationlist[0].user_id!=''" v-repeat = "list: notificationlist">
              @if ($viewnotify==true)
              <td data-title="NAME" style="width:25%;" class="clickablerow" v-on="click:UserDetailPopupforBlock(list.user_id)">
                @endif
                @if ($viewnotify==false)
                <td data-title="NAME" style="width:25%;">
                  @endif
                
                <span style="float:left;padding:0px 10px 0px 0px;">
                  <img v-if="list.image_path!='NULL'" class="" src="<?php echo asset('/public/upload/thumbnail');?>/@{{list.image_path}}" width="60" height="55" />
                  <img v-if="list.image_path=='NULL'" class="" src="<?php echo asset('/public/upload/thumbnail/no-profile.png');?>" width="60" height="55" />

                </span>
                <span style="color:#342453;font-weight:bold;">@{{list.contactname}}</span>
                </br>
                <span class="notifytag">@{{list.tags}}</span>

              </td>
               @if ($viewnotify==true)
                <td data-title="LAST POST" style="width:10%" class="clickablerow" v-on="click:UserDetailPopupforBlock(list.user_id)">
                  @endif
                  @if ($viewnotify==false)
                  <td data-title="LAST POST" style="width:10%">
                    @endif
               @{{list.lastpost}}
              </td>
              @if ($viewnotify==true)
                  <td data-title="SUBJECT" style="width:20%" class="clickablerow" v-on="click:UserDetailPopupforBlock(list.user_id)">
                    @endif
                    @if ($viewnotify==false)
                    <td data-title="SUBJECT" style="width:20%">
                      @endif
                      @{{list.description}}

                    </td>
                    @if ($viewnotify==true)
                    <td data-title="REPORTER" style="width:20%" class="clickablerow" v-on="click:UserDetailPopupforBlock(list.user_id)">
                      @endif
                      @if ($viewnotify==false)
                      <td data-title="REPORTER" style="width:20%">
                        @endif
                        @{{list.reportername}}

                      </td>
              <td data-title="STATUS" style="width:15%;text-align:center;">
                @if (Session::has('user_detail.0'))
                @if (count($aUserRole)>0)
                @foreach($aUserRole as $key)
                @if ($key->key =='BLK_NOTIFY_USR' && $key->value==1)
                <button class="btnunblock" onclick="showUnBlockUserPopup('UNBLOCK USER','show','userunblocknotificationmodal','',@{{list.user_id}});" style="float:left;" v-if="list.blockedtype" >UNBLOCK</button>
                <button class="btnblock" onclick="blockUserPopup('@{{list.user_id}}','@{{list.id}}')" style="float:left;" v-if="!list.blockedtype" >&nbsp;&nbsp;&nbsp;BLOCK&nbsp;&nbsp;&nbsp;</button>
                &nbsp;&nbsp;<span v-if="list.blockedtype=='TEMP'" style="float:left;padding:7px 7px;">Temporary blocked for @{{list.blockeddays}} days </span>
                @endif
                @endforeach
                @else
                <button class="btnunblock" onclick="showUnBlockUserPopup('UNBLOCK USER','show','userunblocknotificationmodal','',@{{list.user_id}});" style="float:left;" v-if="list.blockedtype" >UNBLOCK</button>
                <button class="btnblock" onclick="blockUserPopup('@{{list.user_id}}','@{{list.id}}')" style="float:left;" v-if="!list.blockedtype" >&nbsp;&nbsp;&nbsp;BLOCK&nbsp;&nbsp;&nbsp;</button>
                &nbsp;&nbsp;<span v-if="list.blockedtype=='TEMP'" style="float:left;padding:7px 5px;">Temporary blocked for @{{list.blockeddays}} days </span>


                @endif
                @endif
              </td>
              <td data-title="STATUS" style="width:5%;text-align:center;">

                @if (Session::has('user_detail.0'))
                @if (count($aUserRole)>0)
                @foreach($aUserRole as $key)
                @if ($key->key =='DEL_NOFY' && $key->value==1)
                <img src="{{ asset('public/images/delete-new.png')}}" width="25" height="25" onclick="showDeleteNotificationPopup('DELETE NOTIFICATION','show','deletenotificationmodal','',@{{list.id}});" class="deletenotification" style="margin-top:2px;" />
                @endif
                @endforeach
                @else
                <img src="{{ asset('public/images/delete-new.png')}}" width="25" height="25" onclick="showDeleteNotificationPopup('DELETE NOTIFICATION','show','deletenotificationmodal','',@{{list.id}});" class="deletenotification" style="margin-top:2px;" />
                @endif
                @endif
              </td>
            </tr>
            <tr v-if="notificationlist==''">
              <td class="norecord" align="center" colspan="5">
                <h5>No Records Found</h5>
              </td>
            </tr>

          </tbody>
        </table>
        <div style="clear:both;">&nbsp;</div>
        <div style="clear:both;">&nbsp;</div>
      </div>
    </div>

  </div>
</div>

<style>
.btnblock{
  background: #e03f3c !important;
  text-transform: uppercase;
  color: #fff !important;
  text-shadow: none !important;
  border: 1px solid #e03f3c !important;
  font-weight: 600;
  font-size: 12px;
  padding: 5px 15px;
  width: 100px;
  border-radius: 1px;

  }
  .btnunblock{
  background: #93D827 !important;
  text-transform: uppercase;
  color: #fff !important;
  text-shadow: none !important;
  border: 1px solid #93D827 !important;
  font-weight: 600;
  font-size: 12px;
  padding: 5px 15px;
  width: 100px;
  border-radius: 1px;
  }
  .clickablerow{
  color:#696290 !important;
  font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
  font-weight:bold !important;
  font-size:12px !important;
  }
</style>
