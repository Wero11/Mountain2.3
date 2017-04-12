<?php 
// Get session
if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
//echo"";print_r($aUserDetail->role);die;
$aUserRole=$aUserDetail->role;
}

?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      
      <ul class="nav navbar-nav navbar-left">
        <li>
          <h1 class="breadcrumb-div-left">NOTIFICATION / ALERT</h1>
        </li>

      </ul>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li style="padding:5px;height: 25px!important;font-size:12px;">Filter by &nbsp;&nbsp;</li>
        <li>
          <select name="notify_filter" id="notify_filter" class="form-control breadcrumb-div-a"  style="height: 25px!important;"
     v-on="change: getNotificationList();">
            <option value="">All</option>
            <option value="N">Unread</option>
            <option value="P">Permanent</option>
            <option value="T">Temporary</option>
            
          </select>
        </li>
         @if (Session::has('user_detail.0'))
        @if (count($aUserRole)>0)
        @foreach($aUserRole as $key)
        @if ($key->key =='SER_NOFY' && $key->value==1)
           <li style="padding-left:10px;">
            <div class="input-group add-on" style="height:25px">
              <input type="text" class="k-textbox form-control" style="height: 25px;" placeholder="Search"  id="searchuserkeyword" v-on="keydown: getNotificationList() | key 'enter'"/>
              <div class="input-group-btn">
                <button class="btn btn-default" id="btnSearch" v-on="click:getNotificationList()" type="submit" style="height: 25px;padding: 2px 12px!important">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </li>
        @endif
        @endforeach
        @else
           <li style="padding-left:10px;">
            <div class="input-group add-on" style="height:25px">
              <input type="text" class="k-textbox form-control" style="height: 25px;" placeholder="Search"  id="searchuserkeyword" v-on="keydown: getNotificationList() | key 'enter'"/>
              <div class="input-group-btn">
                <button class="btn btn-default" id="btnSearch" v-on="click:getNotificationList()" type="submit" style="height: 25px;padding: 2px 12px!important">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </li>
        @endif
        @endif
      
     
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
