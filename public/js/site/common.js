var flag;
var view_flag='grid';
jQuery.extend({
    getValues: function(url) {
        var getResult = null;
        jQuery.ajax({
            url: baseurl+url,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(data) {
                getResult = data.result;
            }
        });
       return getResult;
    },
    postValues: function(url,parameter) {
        var postResult = null;
        jQuery.ajax({
            url: baseurl+url,
            type: 'POST',
            dataType: 'json',
            data: parameter,
             async: false,
            success: function(data) {
                postResult = data.result;
            }
        });
       return postResult;
    }
});
jQuery("#user_profile_image,#judge_profile_image").click(function() {
    jQuery("#fileToUpload").click();
});

jQuery( document ).ready(function() {
    jQuery('#listview').click(function(event) {
            event.preventDefault();
            jQuery(this).addClass("active");
            jQuery("#gridview").removeClass("active");
            jQuery("#gridview").attr("src","public/images/title_n.png");
            jQuery("#listview").attr("src","public/images/list_a.png");
            jQuery('#products .item').addClass('list-group-item');
            jQuery('#products .item').removeClass('grid-group-item');
            jQuery('li div.content_wrap').removeClass('grid_video_wrapper');
            jQuery('li div.content_wrap').addClass('list_video_wrapper');
            jQuery('li div.video_overlay').removeClass('grid_description');
            jQuery('li div.video_overlay').addClass('list_description');
            
            jQuery('li div img.content_view ').addClass('list-group-item_view_icon');
            jQuery('li div img.content_view ').removeClass('grid-group-item_view_icon');
            jQuery('li div img.content_like ').addClass('list-group-item_img_icon');
            jQuery('li div img.content_like ').removeClass('grid-group-item_img_icon');
            jQuery('li div.content_rank ').addClass('list-group-item_rank');
            jQuery('li div.content_rank ').removeClass('grid-group-item_rank');
           view_flag='list';
           
    });
     jQuery('#gridview').click(function(event) {
            event.preventDefault();
            jQuery('#products .item').removeClass('list-group-item');
            jQuery('#products .item').addClass('grid-group-item');
            jQuery(this).addClass("active");
            jQuery("#listview").removeClass("active");
            jQuery("#listview").attr("src","public/images/list_n.png");
            jQuery("#gridview").attr("src","public/images/title_a.png");
            jQuery('li div.video_overlay').addClass('grid_description');
            jQuery('li div.video_overlay').removeClass('list_description');                    
            jQuery('li div.content_wrap').addClass('grid_video_wrapper');
            jQuery('li div.content_wrap').removeClass('list_video_wrapper');
            jQuery('li div img.content_view ').removeClass('list-group-item_view_icon');
            jQuery('li div img.content_view ').addClass('grid-group-item_view_icon');
            jQuery('li div img.content_like ').removeClass('list-group-item_img_icon');
            jQuery('li div img.content_like ').addClass('grid-group-item_img_icon');
            jQuery('li div.content_rank ').removeClass('list-group-item_rank');
            jQuery('li div.content_rank ').addClass('grid-group-item_rank');
            view_flag='grid';
    });
     
     jQuery('#userlistview').click(function(event) {
         event.preventDefault();
         jQuery(this).addClass("active");
         jQuery("#usergridview").removeClass("active");
         jQuery("#usergridview").attr("src","public/images/title_n.png");
         jQuery("#userlistview").attr("src","public/images/list_a.png");
         jQuery('#products .useritem').addClass('col-xs-12');
         jQuery('#products .useritem').removeClass('col-xs-4');
         jQuery('li div.imgrow ').removeClass('col-xs-4');
         jQuery('li div.imgrow ').addClass('col-xs-2');
         jQuery('li div.contentrow ').removeClass('col-xs-8');
         jQuery('li div.contentrow ').addClass('col-xs-10');
 });
  jQuery('#usergridview').click(function(event) {
         event.preventDefault();
         jQuery('#products .useritem').removeClass('col-xs-12');
         jQuery('#products .useritem').addClass('col-xs-4');
         jQuery(this).addClass("active");
         jQuery("#userlistview").attr("src","public/images/list_n.png");
         jQuery("#usergridview").attr("src","public/images/title_a.png");
         jQuery('li div.imgrow ').removeClass('col-xs-2');
         jQuery('li div.imgrow ').addClass('col-xs-4');
         jQuery('li div.contentrow ').removeClass('col-xs-10');
         jQuery('li div.contentrow ').addClass('col-xs-8');
        
 });
     var str= window.location.pathname;
     url=str.split('/');
     getMenuIcons(url[1]);
if(url[1]=='manageuser')
   document.title = 'MANAGEPORTALUSER';
else
  document.title = url[1].toUpperCase();
     userFormvalidation();
judgevalidation();
addRolevalidation();
blockUsernValidation();
     
validatePassword();
    var timerId = setInterval(timerMethod, 60000);  
});
 
function timerMethod() {
   console.log('executed');
}


function validatePassword(){
		 jQuery("#change_password_form").validate({
		     rules: {
		    	 newpassword 		: {required: true, minlength: 6},
		    	 confirmpassword 	: {required: true, equalTo: "#newpassword", minlength: 6},
		     	
		     },
		     messages: {
		    	 newpassword 		 :{required: " Enter new password",minlength: "Password must be at least 6 characters long"},
		    	 confirmpassword :{required: " Enter confirm password",equalTo: " Enter Confirm Password Same as Password",minlength: "Password must be at least 6 characters long"}
		     
		     },
		     tooltip_options: {
		     	'_all_': { placement:'right',html:true}
		     },  
		 });

}
function clear_password_form()
{
	jQuery('#newpassword').val('');
    jQuery('#confirmpassword ').val('');
    
    jQuery('#change_password_form').find("input,textarea").val('').end()
      .find("label.error").remove();
jQuery('#changepasswordmodel').modal('show');
}
function getMenuIcons(title)
{
	 switch (title) {
	     case 'managemountain':
	         jQuery("#mountain_menu").addClass("sidemenu_li_mountain_active");
	         jQuery("#mountain_menu").removeClass("sidemenu_li_mountain");
	         jQuery("#judge_menu").addClass("sidemenu_li_judge");
	         jQuery("#judge_menu").removeClass("sidemenu_li_judge_active");
	         jQuery("#user_menu").addClass("sidemenu_li_user");
	         jQuery("#user_menu").removeClass("sidemenu_li_user_active");
	         jQuery("#notification_menu").addClass("sidemenu_li_notification");
	         jQuery("#notification_menu").removeClass("sidemenu_li_notification_active");
	         jQuery("#logout").addClass("sidemenu_li_logout");
	         jQuery("#logout").removeClass("sidemenu_li_logout_active");
	         break;
	     case 'managejudge':
	    	 jQuery("#mountain_menu").addClass("sidemenu_li_mountain");
	         jQuery("#mountain_menu").removeClass("sidemenu_li_mountain_active");
	         jQuery("#judge_menu").addClass("sidemenu_li_judge_active");
	         jQuery("#judge_menu").removeClass("sidemenu_li_judge");
	         jQuery("#user_menu").addClass("sidemenu_li_user");
	         jQuery("#user_menu").removeClass("sidemenu_li_user_active");
	         jQuery("#notification_menu").addClass("sidemenu_li_notification");
	         jQuery("#notification_menu").removeClass("sidemenu_li_notification_active");
	         jQuery("#logout").addClass("sidemenu_li_logout");
	         jQuery("#logout").removeClass("sidemenu_li_logout_active");
	         break;
	     case 'manageuser':
	    	 jQuery("#mountain_menu").addClass("sidemenu_li_mountain");
	         jQuery("#mountain_menu").removeClass("sidemenu_li_mountain_active");
	         jQuery("#judge_menu").addClass("sidemenu_li_judge");
	         jQuery("#judge_menu").removeClass("sidemenu_li_judge_active");
	         jQuery("#user_menu").addClass("sidemenu_li_user_active");
	         jQuery("#user_menu").removeClass("sidemenu_li_user");
	         jQuery("#notification_menu").addClass("sidemenu_li_notification");
	         jQuery("#notification_menu").removeClass("sidemenu_li_notification_active");
	         jQuery("#logout").addClass("sidemenu_li_logout");
	         jQuery("#logout").removeClass("sidemenu_li_logout_active");
	         break;
	     case 'notification':
	    	 jQuery("#mountain_menu").addClass("sidemenu_li_mountain");
	         jQuery("#mountain_menu").removeClass("sidemenu_li_mountain_active");
	         jQuery("#judge_menu").addClass("sidemenu_li_judge");
	         jQuery("#judge_menu").removeClass("sidemenu_li_judge_active");
	         jQuery("#user_menu").addClass("sidemenu_li_user");
	         jQuery("#user_menu").removeClass("sidemenu_li_user_active");
	         jQuery("#notification_menu").addClass("sidemenu_li_notification_active");
	         jQuery("#notification_menu").removeClass("sidemenu_li_notification");
	         jQuery("#logout").addClass("sidemenu_li_logout");
	         jQuery("#logout").removeClass("sidemenu_li_logout_active");
	         break;
	     case 'rolesettings':
	    	 jQuery("#mountain_menu").addClass("sidemenu_li_mountain");
	         jQuery("#mountain_menu").removeClass("sidemenu_li_mountain_active");
	         jQuery("#judge_menu").addClass("sidemenu_li_judge");
	         jQuery("#judge_menu").removeClass("sidemenu_li_judge_active");
	         jQuery("#user_menu").addClass("sidemenu_li_user");
	         jQuery("#user_menu").removeClass("sidemenu_li_user_active");
	         jQuery("#notification_menu").addClass("sidemenu_li_notification");
	         jQuery("#notification_menu").removeClass("sidemenu_li_notification_active");
	         jQuery("#logout").addClass("sidemenu_li_logout");
	         jQuery("#logout").removeClass("sidemenu_li_logout_active");
	         jQuery("#role_menu").addClass("sidemenu_li_rolesettings_active");
	         jQuery("#role_menu").removeClass("sidemenu_li_user");
	         break;
		case 'logout':
			jQuery("#mountain_menu").addClass("sidemenu_li_mountain");
	         jQuery("#mountain_menu").removeClass("sidemenu_li_mountain_active");
	         jQuery("#judge_menu").addClass("sidemenu_li_judge");
	         jQuery("#judge_menu").removeClass("sidemenu_li_judge_active");
	         jQuery("#user_menu").addClass("sidemenu_li_user");
	         jQuery("#user_menu").removeClass("sidemenu_li_user_active");
	         jQuery("#notification_menu").addClass("sidemenu_li_notification");
	         jQuery("#notification_menu").removeClass("sidemenu_li_notification_active");
	         jQuery("#logout").addClass("sidemenu_li_logout_active");
	         jQuery("#logout").removeClass("sidemenu_li_logout");
		    break;
	}
}

function playvideo(object){
     var video = jQuery(object).attr('id');
html5Lightbox.showLightbox(2, '/public/feed/'+video , '', 480, 270, '/public/feed/'+video );

 //html5Lightbox.showLightbox(2, '', '', 650, 370, '/public/feed/'+video);  
}
function SaveToDisk(object) {
var fileName = jQuery(object).attr('id');
var fileUrl= '/public/feed/'+fileName ;
    var hyperlink = document.createElement('a');
    hyperlink.href = fileUrl;
    hyperlink.target = '_blank';
    hyperlink.download = fileName || fileUrl;

    var mouseEvent = new MouseEvent('click', {
        view: window,
        bubbles: true,
        cancelable: true
    });

    hyperlink.dispatchEvent(mouseEvent);
    (window.URL || window.webkitURL).revokeObjectURL(hyperlink.href);
}


function confirmBox(heading, question, cancelButtonTxt, okButtonTxt, callback) {

    confirmModal = 
    	jQuery('<div class="modal fade" id="deleteModal" data-backdrop="static">' +        
          '<div class="modal-dialog">' +
          '<div class="modal-content">' +
          '<div class="modal-header">' +
            '<a style="padding:3px 4px 3px 6px !important;float:right" data-dismiss="modal" id="confirm_close_btn"><img src="public/images/close.png" height="20px" width="20px"></a>' +
            '<h5>' + heading +'</h5>' +
          '</div>' +

          '<div class="modal-body">' +
            '<p>' + question + '</p>' +
          '</div>' +

          '<div class="modal-footer">' +
            '<a href="javascript:void(0)" id="okButton" class="btn btn-primary">' + 
              okButtonTxt + 
            '</a>' +
            '<a href="javascript:void(0)" id="cancelButton" class="btn btn-default" data-dismiss="modal">' + 
              cancelButtonTxt + 
            '</a>' +
          '</div>' +
          '</div>' +
          '</div>' +
        '</div>');      
  } 

function getJudgeIcons(title)
{
  
   switch (title) {
       case 'create':
           jQuery("#j_hide").attr("src","public/images/eye_n.png");
           jQuery("#j_search").attr("src","public/images/search_n.png");
           jQuery("#j_assign_mountain").attr("src","public/images/assignmountain_n.png");
           jQuery("#j_delete").attr("src","public/images/delete_n.png");
           jQuery("#j_create").addClass("breadcrumb-btn_mountain");
           jQuery("#j_create").removeClass("breadcrumb-btn_mountain_active");
           break;
       case 'assign':
         jQuery("#j_hide").attr("src","public/images/eye_n.png");
           jQuery("#j_search").attr("src","public/images/search_n.png");
           jQuery("#j_assign_mountain").attr("src","public/images/assignmountain_a.png");
           jQuery("#j_delete").attr("src","public/images/delete_n.png");
           jQuery("#j_create").removeClass("breadcrumb-btn_mountain");
           jQuery("#j_create").addClass("breadcrumb-btn_mountain_active");
           break;
       case 'search':
         jQuery("#j_hide").attr("src","public/images/eye_n.png");
           jQuery("#j_search").attr("src","public/images/search_a.png");
           jQuery("#j_assign_mountain").attr("src","public/images/assignmountain_n.png");
           jQuery("#j_delete").attr("src","public/images/delete_n.png");
           jQuery("#j_create").removeClass("breadcrumb-btn_mountain");
           jQuery("#j_create").addClass("breadcrumb-btn_mountain_active");
           break;
       case 'hide':
         jQuery("#j_hide").attr("src","public/images/eye_a.png");
           jQuery("#j_search").attr("src","public/images/search_n.png");
           jQuery("#j_assign_mountain").attr("src","public/images/assignmountain_n.png");
           jQuery("#j_delete").attr("src","public/images/delete_n.png");
           jQuery("#j_create").removeClass("breadcrumb-btn_mountain");
           jQuery("#j_create").addClass("breadcrumb-btn_mountain_active");
           break;
       case 'delete':
         jQuery("#j_hide").attr("src","public/images/eye_n.png");
           jQuery("#j_search").attr("src","public/images/search_n.png");
           jQuery("#j_assign_mountain").attr("src","public/images/assignmountain_n.png");
           jQuery("#j_delete").attr("src","public/images/delete_a.png");
           jQuery("#j_create").removeClass("breadcrumb-btn_mountain");
           jQuery("#j_create").addClass("breadcrumb-btn_mountain_active");
           break;
    case 'default':
       jQuery("#j_hide").attr("src","public/images/eye_n.png");
           jQuery("#j_search").attr("src","public/images/search_n.png");
           jQuery("#j_assign_mountain").attr("src","public/images/assignmountain_n.png");
           jQuery("#j_delete").attr("src","public/images/delete_n.png");
           jQuery("#j_create").removeClass("breadcrumb-btn_mountain");
           jQuery("#j_create").addClass("breadcrumb-btn_mountain_active");
clearSelectJudge();
        break;
  }
}

function showPopup(title,flag,selector,clear_form)
{

  if(clear_form)
    window[clear_form](); 
   if(flag=='create')
	{
	   jQuery('h4.modal-title').text(title);
	   jQuery('#'+selector).modal('show');
	}
	else
	{
	  if(selectedJudgeArr.length>0)
	  {
	    jQuery('h4.modal-title').text(title);
	    jQuery('#'+selector).modal('show');
	  }
	  else
	  {
		confirmBox('Alert',"Please select atleast one user",'','');
		 confirmModal.modal('show');
		confirmModal.find('#okButton').hide();
		confirmModal.find('#cancelButton').hide();
		 confirmModal.find('#confirm_close_btn').on('click',function(event)
		{
        	//alert('hi');
        	getJudgeIcons('default');
		});
			
	  }
	}
  jQuery(".mitem").removeClass("selected-image");
  jQuery(".citem").removeClass("selected-image");
}
function showUserPopup(title, flag, selector, clear_form) {
   
    if (clear_form)
        window[clear_form]();
    
        if (selectedJudgeArr.length > 0) {
            jQuery('h4.modal-title').text(title);
            jQuery('#' + selector).modal('show');
        }
        else {
            confirmBox('Alert', "Please select atleast one user", '', '');
            confirmModal.modal('show');
            confirmModal.find('#okButton').hide();
            confirmModal.find('#cancelButton').hide();
            confirmModal.find('#confirm_close_btn').on('click',function(event)
    		{
            	//alert('hi');
            	getUserIcons('default');
    		});
        }
   
    
}
function imgMError(image) {
    image.onerror = "";
    image.src = baseurl+'/public/upload/thumbnail/noimage.jpg';
    image.class= "";
    return true;
}
jQuery('.btn-toggle').click(function() {
    jQuery(this).find('.btn').toggleClass('active');  
    
    if (jQuery(this).find('.btn-primary').size()>0) {
    	jQuery(this).find('.btn').toggleClass('btn-primary');
    }
    if (jQuery(this).find('.btn-danger').size()>0) {
    	jQuery(this).find('.btn').toggleClass('btn-danger');
    }
    if (jQuery(this).find('.btn-success').size()>0) {
    	jQuery(this).find('.btn').toggleClass('btn-success');
    }
    if (jQuery(this).find('.btn-info').size()>0) {
    	jQuery(this).find('.btn').toggleClass('btn-info');
    }
    
    jQuery(this).find('.btn').toggleClass('btn-default');
       
});