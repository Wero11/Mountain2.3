<form class="form-horizontal" action="" method="POST" id="rolesettings">
  <div id="products" class="row list-group portfolio-item">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 role-selection-area">
      <div class="rolename">Role Name</div>
      <div>
        <select
	                class="form-control"
	                id="mountain_id" 
	                v-model="rolesettings.role_id"
	                v-on="change: getRoleSettings(rolesettings.role_id);">
          <option value="">Select Role</option>
          <option
            v-repeat="role: rolelisting"
            value="@{{role.id}}">
            @{{role.name}}
          </option>
        </select>
       
       
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 role-selection-area">
      <div class="roledescription" v-show="rolesettings.role_id">Description</div>
      <div v-show="rolesettings.role_id">
        <textarea name="roledescription" id="roledescription"  class="form-control" v-model="roledetails.description"></textarea>

      </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" v-show="rolesettings.role_id">
      <div class="rolehead">
        <span>Manage Mountain</span>
        <span class="settingsbtnarea">
          <div class="">
            <button v-class="active: rolesettings.MUTN==1" class="btn btn-xs btn-default btn-allow btn-settings" id="mountainallow" v-on="click:allowdenycheck('mountain',1)">Allow</button>
            <button v-class="active: rolesettings.MUTN==0" class="btn btn-xs btn-default btn-settings btn-deny" id="mountaindeny" v-on="click:allowdenycheck('mountain',0)">Deny</button>
          </div>
        </span>

      </div>
      <div id="mountaincontainer" class="rolecontent" v-show="enablesectionforrolesettings(rolesettings.role_id,rolesettings.MUTN)">
        <div class="elementhead">
          Allow Access to Advertising Mountain 
          
        </div>
        <div class="yesnoarea">
          <span style="float:left;">
            <input type="radio" name="advmountain" id="advmountainyes" value="1" v-model="rolesettings.ADV_MUTN" class="mountainyeselement mountainelement" v-on="click:disableadvmountain(1,'rolesettings.ADV_MUTN')" checked=""/> <label for="advmountainyes">Yes</label>
            &nbsp; &nbsp;
            <input type="radio" name="advmountain" id="advmountainno" value="0" v-model="rolesettings.ADV_MUTN" class="mountainnoelement mountainelement" v-on="click:disableadvmountain(0,'rolesettings.ADV_MUTN')" /> <label for="advmountainno">No</label>
          </span>
            <span style="float:left;">
            <select id="advmountaincontainer" v-model="rolesettings.ADV_MUTN_LIST" v-show="rolesettings.ADV_MUTN==1" multiple style="width:300px;height:200px;margin:0px 50px;">
              <option value="0">All</option>
              <option
              v-repeat="advmount: advmountainlist"
              value="@{{advmount.id}}">
                @{{advmount.name}}
              </option>
             
            </select>
            
          </span>
        </div>
        <div style="clear:both">&nbsp;</div>
        <div class="elementhead">
          Allow Access to Fame Mountain
        </div>
        <div class="yesnoarea">
          <span style="float:left;">
            <input type="radio" name="mainmountain" id="mainmountainyes" value="1" v-model="rolesettings.FAM_MUNT" class="mountainyeselement mountainelement" checked="" v-on="click:disablefamemountain(1,'rolesettings.FAM_MUNT')" /> <label for="mainmountainyes">Yes</label>
            &nbsp; &nbsp;
            <input type="radio" name="mainmountain" id="mainmountainno" value="0" v-model="rolesettings.FAM_MUNT" class="mountainnoelement mountainelement" v-on="click:disablefamemountain(0,'rolesettings.FAM_MUNT')" /> <label for="mainmountainno">No</label>
          </span>
            <span style="float:left;">
            <select id="famemountaincontainer" v-model="rolesettings.FAM_MUTN_LIST" v-show="rolesettings.FAM_MUNT==1" multiple style="width:300px;height:200px;margin:0px 50px;">
              <option value="0">All</option>
              <option
              v-repeat="famemount: famemountainlist"
              value="@{{famemount.id}}">
                @{{famemount.name}}
              </option>

            </select>

          </span>

        </div>
        <div style="clear:both">&nbsp;</div>
        <div class="elementhead">
          Allow Access to Create Mountain
        </div>
        <div class="yesnoarea">
          <input type="radio" name="createmountain" id="createmountainyes" value="1" v-model="rolesettings.CRE_MUTN" class="mountainyeselement mountainelement" checked=""/> <label for="createmountainyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="createmountain" id="createmountainno" value="0" v-model="rolesettings.CRE_MUTN" v-on="click:mountainnoradiocheck('rolesettings.CRE_MUTN')" class="mountainnoelement mountainelement"  /> <label for="createmountainno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Modify Mountain
        </div>
        <div class="yesnoarea">
          <input type="radio" name="modifymountain" id="modifymountainyes" value="1" v-model="rolesettings.EDT_MUTN" class="mountainyeselement mountainelement" checked=""/> <label for="modifymountainyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="modifymountain" id="modifymountainno" value="0" v-model="rolesettings.EDT_MUTN" v-on="click:mountainnoradiocheck('rolesettings.EDT_MUTN')" class="mountainnoelement mountainelement" /> <label for="modifymountainno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Search Mountain
        </div>
        <div class="yesnoarea">
          <input type="radio" name="searchmountain" id="searchmountainyes" value="1" v-model="rolesettings.SER_MUTN" class="mountainyeselement mountainelement" checked=""/> <label for="searchmountainyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="searchmountain" id="searchmountainno" value="0" v-model="rolesettings.SER_MUTN" v-on="click:mountainnoradiocheck('rolesettings.SER_MUTN')" class="mountainnoelement mountainelement" /> <label for="searchmountainno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Push Notification
        </div>
        <div class="yesnoarea">
          <input type="radio" name="pushnotification" id="pushnotificationyes" value="1" v-model="rolesettings.PUS_NOFY" class="mountainyeselement mountainelement" checked=""/> <label for="pushnotificationyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="pushnotification" id="pushnotificationno" value="0" v-model="rolesettings.PUS_NOFY" v-on="click:mountainnoradiocheck('rolesettings.PUS_NOFY')" class="mountainnoelement mountainelement" /> <label for="pushnotificationno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Assign Judge
        </div>
        <div class="yesnoarea">
          <input type="radio" name="assignjudge" id="assignjudgeyes" value="1" v-model="rolesettings.ASN_JUG" class="mountainyeselement mountainelement" checked=""/> <label for="assignjudgeyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="assignjudge" id="assignjudgeno" value="0" v-model="rolesettings.ASN_JUG" v-on="click:mountainnoradiocheck('rolesettings.ASN_JUG')" class="mountainnoelement mountainelement" /> <label for="assignjudgeno">No</label>
        </div>
<div class="elementhead">
          Allow Access to All Mountain
        </div>
        <div class="yesnoarea">
          <input type="radio" name="allmountain" id="allmountainyes" value="1" v-model="rolesettings.ALL_MUTN" class="mountainyeselement mountainelement" checked=""/> <label for="allmountainyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="allmountain" id="allmountainno" value="0" v-model="rolesettings.ALL_MUTN" v-on="click:mountainnoradiocheck('rolesettings.ALL_MUTN')" class="mountainnoelement mountainelement" /> <label for="allmountainno">No</label>
        </div>
        <input type="hidden" name="hmountainallow" id="hmountainallow" value="@{{rolesettings.MUTN}}"  />
      </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  v-show="rolesettings.role_id">
      <div class="rolehead">
        <span>Manage Judge</span>
        <span class="settingsbtnarea">
          <div class="">
            <button v-class="active: rolesettings.JUG=='1'" class="btn btn-xs btn-default btn-allow btn-settings" id="judgeallow" v-on="click:allowdenycheck('judge',1)">Allow</button>
            <button v-class="active: rolesettings.JUG=='0'" class="btn btn-xs btn-default btn-settings btn-deny" id="judgedeny" v-on="click:allowdenycheck('judge',0)">Deny</button>
           
          </div>
        </span>

      </div>
      <div id="judgecontainer" class="rolecontent" v-show="enablesectionforrolesettings(rolesettings.role_id,rolesettings.JUG)">
        <div class="elementhead">
          Allow Access to Create Judge
        </div>
        <div class="yesnoarea">
          <input type="radio" name="createjudge" id="createjudgeyes" value="1" v-model="rolesettings.CRE_JUG" class="judgeyeselement judgeelement" /> <label for="createjudgeyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="createjudge" id="createjudgeno" value="0" v-model="rolesettings.CRE_JUG" v-on="click:judgenoradiocheck('rolesettings.CRE_JUG')" class="judgenoelement judgeelement" /> <label for="createjudgeno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Edit Judge
        </div>
        <div class="yesnoarea">
          <input type="radio" name="editjudge" id="editjudgeyes" value="1" v-model="rolesettings.EDT_JUG" class="judgeyeselement judgeelement" /> <label for="editjudgeyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="editjudge" id="editjudgeno" value="0" v-model="rolesettings.EDT_JUG" v-on="click:judgenoradiocheck('rolesettings.EDT_JUG')" class="judgenoelement judgeelement" /> <label for="editjudgeno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Delete Judge
        </div>
        <div class="yesnoarea">
          <input type="radio" name="deletejudge" id="deletejudgeyes" value="1" v-model="rolesettings.DEL_JUG" class="judgeyeselement judgeelement" /> <label for="deletejudgeyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="deletejudge" id="deletejudgeno" value="0" v-model="rolesettings.DEL_JUG" v-on="click:judgenoradiocheck('rolesettings.DEL_JUG')" class="judgenoelement judgeelement" /> <label for="deletejudgeno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Hide Judge
        </div>
        <div class="yesnoarea">
          <input type="radio" name="hidejudge" id="hidejudgeyes" value="1" v-model="rolesettings.HIDE_JUG" class="judgeyeselement judgeelement" /> <label for="hidejudgeyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="hidejudge" id="hidejudgeno" value="0" v-model="rolesettings.HIDE_JUG" v-on="click:judgenoradiocheck('rolesettings.HIDE_JUG')" class="judgenoelement judgeelement" /> <label for="hidejudgeno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Search Judge
        </div>
        <div class="yesnoarea">
          <input type="radio" name="searchjudge" id="searchjudgeyes" value="1" v-model="rolesettings.SER_JUG" class="judgeyeselement judgeelement" /> <label for="searchjudgeyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="searchjudge" id="searchjudgeno" value="0" v-model="rolesettings.SER_JUG" v-on="click:judgenoradiocheck('rolesettings.SER_JUG')" class="judgenoelement judgeelement" /> <label for="searchjudgeno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Assign Mountain
        </div>
        <div class="yesnoarea">
          <input type="radio" name="assignmountain" id="assignmountainyes" value="1" v-model="rolesettings.ASN_MUTN" class="judgeyeselement judgeelement" /> <label for="assignmountainyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="assignmountain" id="assignmountainno" value="0" v-model="rolesettings.ASN_MUTN" v-on="click:judgenoradiocheck('rolesettings.ASN_MUTN')" class="judgenoelement judgeelement" /> <label for="assignmountainno">No</label>
        </div>

        <input type="hidden" name="hjudgeallow" id="hjudgeallow" value="@{{rolesettings.JUG}}"  />
      </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  v-show="rolesettings.role_id">
      <div class="rolehead">
        <span>Manage User</span>
        <span class="settingsbtnarea">
          <div class="">
            <button v-class="active: rolesettings.USR=='1'" class="btn btn-xs btn-default btn-allow btn-settings" id="userallow" v-on="click:allowdenycheck('user',1)">Allow</button>
            <button v-class="active: rolesettings.USR=='0'" class="btn btn-xs btn-default btn-settings btn-deny" id="userdeny" v-on="click:allowdenycheck('user',0)">Deny</button>

          </div>
        </span>

      </div>
      <div id="usercontainer" class="rolecontent" v-show="enablesectionforrolesettings(rolesettings.role_id,rolesettings.USR)">
        <div class="elementhead">
          Allow Access to Create User
        </div>
        <div class="yesnoarea">
          <input type="radio" name="createuser" id="createuseryes" value="1" v-model="rolesettings.CRE_USR" class="judgeyeselement judgeelement" /> <label for="createuseryes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="createuser" id="createuserno" value="0" v-model="rolesettings.CRE_USR" v-on="click:usernoradiocheck('rolesettings.CRE_USR')" class="judgenoelement judgeelement" /> <label for="createuserno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Block User
        </div>
        <div class="yesnoarea">
          <input type="radio" name="blockuser" id="blockuseryes" value="1" v-model="rolesettings.BLK_USR" class="judgeyeselement judgeelement" /> <label for="blockuseryes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="blockuser" id="blockuserno" value="0" v-model="rolesettings.BLK_USR" v-on="click:usernoradiocheck('rolesettings.BLK_USR')" class="judgenoelement judgeelement" /> <label for="blockuserno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Search User
        </div>
        <div class="yesnoarea">
          <input type="radio" name="searchuser" id="searchuseryes" value="1" v-model="rolesettings.SER_USR" class="judgeyeselement judgeelement" /> <label for="searchuseryes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="searchuser" id="searchuserno" value="0" v-model="rolesettings.SER_USR" v-on="click:usernoradiocheck('rolesettings.SER_USR')" class="judgenoelement judgeelement" /> <label for="searchuserno">No</label>
        </div>
       

        <input type="hidden" name="huserallow" id="huserallow" value="@{{rolesettings.USR}}"  />
      </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  v-show="rolesettings.role_id">
      <div class="rolehead">
        <span>Manage Notification</span>
        <span class="settingsbtnarea">
          <div class="">
            <button v-class="active: rolesettings.NOFY=='1'" class="btn btn-xs btn-default btn-allow btn-settings" id="notifyallow" v-on="click:allowdenycheck('notify',1)">Allow</button>
            <button v-class="active: rolesettings.NOFY=='0'" class="btn btn-xs btn-default btn-settings btn-deny" id="notifydeny" v-on="click:allowdenycheck('notify',0)">Deny</button>

          </div>
        </span>

      </div>
      <div id="notifycontainer" class="rolecontent" v-show="enablesectionforrolesettings(rolesettings.role_id,rolesettings.NOFY)">
        <div class="elementhead">
          Allow Access to View Notification
        </div>
        <div class="yesnoarea">
          <input type="radio" name="viewnotify" id="viewnotifyyes" value="1" v-model="rolesettings.VIEW_NOFY" class="judgeyeselement judgeelement" /> <label for="viewnotifyyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="viewnotify" id="viewnotifyno" value="0" v-model="rolesettings.VIEW_NOFY" v-on="click:notifynoradiocheck('rolesettings.VIEW_NOFY')" class="judgenoelement judgeelement" /> <label for="viewnotifyno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Delete Feed
        </div>
        <div class="yesnoarea">
          <input type="radio" name="deletefeed" id="deletefeedyes" value="1" v-model="rolesettings.DEL_FEED" class="judgeyeselement judgeelement" /> <label for="deletefeedyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="deletefeed" id="deletefeedno" value="0" v-model="rolesettings.DEL_FEED" v-on="click:notifynoradiocheck('rolesettings.DEL_FEED')" class="judgenoelement judgeelement" /> <label for="deletefeedno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Block Notification User
        </div>
        <div class="yesnoarea">
          <input type="radio" name="blocknofyusr" id="blocknofyusryes" value="1" v-model="rolesettings.BLK_NOTIFY_USR" class="judgeyeselement judgeelement" /> <label for="blocknofyusryes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="blocknofyusr" id="blocknofyusrno" value="0" v-model="rolesettings.BLK_NOTIFY_USR" v-on="click:notifynoradiocheck('rolesettings.BLK_NOTIFY_USR')" class="judgenoelement judgeelement" /> <label for="blocknofyusrno">No</label>
        </div>
        <div class="elementhead">
          Allow Access to Delete Notification
        </div>
        <div class="yesnoarea">
          <input type="radio" name="deletenotify" id="deletenotifyyes" value="1" v-model="rolesettings.DEL_NOFY" class="judgeyeselement judgeelement" /> <label for="deletenotifyyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="deletenotify" id="deletenotifyno" value="0" v-model="rolesettings.DEL_NOFY" v-on="click:notifynoradiocheck('rolesettings.DEL_NOFY')" class="judgenoelement judgeelement" /> <label for="deletenotifyno">No</label>
        </div>
<div class="elementhead">
          Allow Access to Search Notification
        </div>
        <div class="yesnoarea">
          <input type="radio" name="searchnotify" id="searchnotifyyes" value="1" v-model="rolesettings.SER_NOFY" class="judgeyeselement judgeelement" /> <label for="searchnotifyyes">Yes</label>
          &nbsp; &nbsp;
          <input type="radio" name="searchnotify" id="searchnotifyno" value="0" v-model="rolesettings.SER_NOFY" v-on="click:notifynoradiocheck('rolesettings.SER_NOFY')" class="judgenoelement judgeelement" /> <label for="searchnotifyno">No</label>
        </div>

        <input type="hidden" name="hnotifyallow" id="hnotifyallow" value="@{{rolesettings.NOFY}}"  />
      </div>
    </div>


    <div style="clear:both">&nbsp;</div>
    <div class="row btn-holder text-center" v-show="rolesettings.role_id">
      <span id="user_error" class= "error_new"></span>
      <div class="col-xs-12">
        <button type="button" class="btn btn-primary" id="creat_user" v-on="click:saveRoleSettings(rolesettings)">SAVE</button>
        &nbsp;&nbsp;
        <button type="button" class="btn" id="creat_user" v-on="click:reloadwindow()">CANCEL</button>
        
      </div>
    </div>
    <div style="clear:both">&nbsp;</div>
  </div>
  
  <div style="clear:both">&nbsp;</div>
  
</form>

 <script>

   jQuery( document ).ready(function() {

   jQuery('#judgecontainer').hide();

   });
   jQuery(".btn-settings").click(function(e) {
   e.preventDefault();
   ///mountain settings
   if(this.id=='mountainallow'){
   jQuery('#hmountainallow').val(1);
   jQuery('#mountaincontainer').show( "slow" );
   }
   if(this.id=='mountaindeny'){
   jQuery('#hmountainallow').val(0);
   jQuery('#mountaincontainer').hide( "slow" );
   }
   //judge settings
   if(this.id=='judgeallow'){
   jQuery('#hjudgeallow').val(1);
   jQuery('#judgecontainer').show( "slow" );

   }
   if(this.id=='judgedeny'){
   jQuery('#hjudgeallow').val(0);
   jQuery('#judgecontainer').hide( "slow" );
   }

   //user settings
   if(this.id=='userallow'){
   jQuery('#huserallow').val(1);
   jQuery('#usercontainer').show( "slow" );

   }
   if(this.id=='userdeny'){
   jQuery('#huserallow').val(0);
   jQuery('#usercontainer').hide( "slow" );
   }

   //notification settings
   if(this.id=='notifyallow'){
   jQuery('#hnotifyallow').val(1);
   jQuery('#notifycontainer').show( "slow" );

   }
   if(this.id=='notifydeny'){
   jQuery('#hnotifyallow').val(0);
   jQuery('#notifycontainer').hide( "slow" );
   }


   });

 </script>
<style type="text/css">
  .role-selection-area{
  margin:10px 0px;
  }
  .rolename, .roledescription{
  color:#331B4D;
  font-weight:600;
  font-size:12px;
  }
  .rolehead{
  padding:10px 0px;
  border-bottom: 1px solid #E7E7E7;
  font-weight:600;
  color:#331B4D;
  }
  .rolehead span{
  text-transform:uppercase;
  font-size:13px;
  }
  .settingsbtnarea{
  float:right !important
  }
  .btn-allow.active{
  background:green !important;
  border-color: green !important;
  color:#fff;
  }
  .active.btn-deny{
  background:red !important;
  border-color: red !important;
  color:#fff;
  }
  .elementhead{
  margin:10px 0px;
  color:#331B4D;
  font-weight:600;
  font-size:12px;
  }
  .yesnoarea label{
  color:#331B4D;
  font-size:12px !important;

  }
  .btn-deny{
  float:right;
  margin-left:-1px !important;
  }
  .btn-settings{
  border-radius:0px !important;
  }
  .btn-xs, .btn-group-xs>.btn{
    padding:3px 5px !important;
  font-size:10px !important;
  }


</style>