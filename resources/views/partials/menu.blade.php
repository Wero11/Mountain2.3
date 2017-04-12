<!-- Main -->
<?php 
// Get session

if(Session::has('user_detail.0'))
{	
$aUserDetail = Session::get ( 'user_detail.0' );
$arole=$aUserDetail->role_id;
//echo"";print_r($aUserDetail->role);die;
$aUserRole=$aUserDetail->role;
}

?>

<div class="container-fluid" style="margin-top: -6px;">
    <div class="row" >
        <div  class="col-sm-2 col-md-2 col-lg-1 col-fixed-92" style="    margin-top: -1px;" >
          
         <div class="sidebar-nav">
              <div class="navbar" role="navigation">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <span class="visible-xs navbar-brand">Sidebar menu</span>
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse sidemenu" style=" padding-left: 0px;
    padding-right: 0px;
">
                  <ul class="nav navbar-nav">
                   @if (Session::has('user_detail.0'))
                   	 @if (count($aUserRole)>0)
                    	@foreach($aUserRole as $key) 
                        @if ($key->key =='MUTN' && $key->value==1)
	                    	 <li > 
		                    	<a id="mountain_menu" href="managemountain" class="sidemenu_li_mountain"  ></a>
			                </li> 
			             
							
							 @elseif ($key->key =='JUG' && $key->value==1)
			                 <li > 
			                    <a href="managejudge" id="judge_menu" class="sidemenu_li_judge" ></a>
			                </li> 
			                 @elseif ($key->key =='USR' && $key->value==1)
			                 <li > 
			                    <a href="manageuser" id="user_menu" class="sidemenu_li_user" ></a>
			                </li> 
			                 @elseif ($key->key =='NOFY' && $key->value==1)
			                <li> 
			                    <a href="notification" id="notification_menu" class="sidemenu_li_notification" ></a>
			                </li>
			                 @endif
		                	 @endforeach
		                 	
		                 	   @else
		                 	   <li > 
		                    	<a id="mountain_menu" href="managemountain" class="sidemenu_li_mountain"  ></a>
			                </li> 
			             
							
			                 <li > 
			                    <a href="managejudge" id="judge_menu" class="sidemenu_li_judge" ></a>
			                </li> 
			                 <li > 
			                    <a href="manageuser" id="user_menu" class="sidemenu_li_user" ></a>
			                </li> 
			                <li> 
			                    <a href="notification" id="notification_menu" class="sidemenu_li_notification" >
	                          </a>
			                </li>
			                 @endif
		                 @endif
@if (Session::has('user_detail.0'))
@if ($arole==1)
		                <li > 
		                    <a href="rolesettings" id="role_menu" class="sidemenu_li_rolesettings" ></a>
		                </li> 
 @endif
  @endif
		              	<li >
		                    <a href="logout" id="logout_menu" class="sidemenu_li_logout" ></a>
		                </li>
		               
		                
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
            </div>
          </div>
        <!-- /col-3 -->
        
        <!--mobile-->
        <div  class="col-sm-2 col-md-1 col-lg-1 col-fixed-sm" style="display:none">
          
         <div class="sidebar-nav">
              <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <span class="visible-xs navbar-brand">Sidebar menu</span>
                  
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse sidemenu" style=" padding-left: 0px;padding-right: 0px;">
                  <ul class="nav navbar-nav">
@if (Session::has('user_detail.0'))
                   	 @if (count($aUserRole)>0)
                    	@foreach($aUserRole as $key) 
                        @if ($key->key =='MUTN' && $key->value==1)
	                    	 <li > 
		                    	<a id="mountain_menu" href="managemountain"   >MANAGE MOUNTAIN</a>
			                </li> 
			             
							
							 @elseif ($key->key =='JUG' && $key->value==1)
			                 <li > 
			                    <a href="managejudge" id="judge_menu"  >MANAGE JUDGE</a>
			                </li> 
			                 @elseif ($key->key =='USR' && $key->value==1)
			                 <li > 
			                    <a href="manageuser" id="user_menu"  >MANAGE USER</a>
			                </li> 
			                 @elseif ($key->key =='NOFY' && $key->value==1)
			                <li> 
			                    <a href="notification" id="notification_menu"  >
	                         
	                          NOTIFICATIONS
	                         </a>
			                </li>
			                 @endif
		                	 @endforeach
		                 	
		                 	   @else
		                 	   <li > 
		                    	<a id="mountain_menu" href="managemountain"   >MANAGE MOUNTAINS</a>
			                </li> 
			             
							
			                 <li > 
			                    <a href="managejudge" id="judge_menu" >MANAGE JUDGES</a>
			                </li> 
			                 <li > 
			                    <a href="manageuser" id="user_menu"  >MANAGE USERS</a>
			                </li> 
			                <li> 
			                    <a href="notification" id="notification_menu"  >
	                          
	                          NOTIFICATIONS
	                         </a>
			                </li>
			                 @endif
		                 @endif
@if (Session::has('user_detail.0'))
@if ($arole==1)
		                <li > 
		                    <a href="rolesettings" id="role_menu"  >ROLE SETTINGS</a>
		                </li> 
 @endif
  @endif
		              	<li >
		                    <a href="logout" id="logout_menu"  >LOGOUT</a>
		                </li>
		               
                    	
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
            </div>
          </div>
 