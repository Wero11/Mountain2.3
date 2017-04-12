function clear_user()
{
	jQuery('#user_first_name').val('');
    jQuery('#description').val('');
    jQuery('#user_last_name').val('');
    jQuery('#user_profession').val('');
    jQuery('#user_description').val('');
    jQuery("#user_tags").val(''); 
    jQuery('#gender_female').prop('checked',false);
    jQuery('#gender_male').prop('checked',false);
    jQuery('h4.modal-title').text('Create User');
    jQuery("#file_error").html('');
    jQuery("#user_email").val('');
    jQuery("label.error").remove();
    jQuery("#user_error").html('');
jQuery("#password").prop("type", "text");
    jQuery(".error").removeClass("error");
    jQuery("#user_profile_image").attr('src',baseurl+"/public/images/img-placeholder.jpg");
    jQuery('#add_user').find("input,textarea").val('').end()
      .find("label.error").remove();
    flag='add';
    jQuery('#create_user').show();
    jQuery('#update_user').hide();
jQuery('#add_prof').hide();
				jQuery('#select_prof').show();
				jQuery('#prof_error').html('');
}


function userFormvalidation(){
	jQuery("#add_user").validate({
	    rules: {
	    	user_first_name 	: {required: true},
	    	user_last_name 	: {required: true},
	    	user_name 	: {required: true},
	    	password 	: {required: true, minlength: 6},
	    	user_profession  : {required: true},
	    	user_tags 		: {required: true},	    	
	    	gender     : {required: true},
	    	user_country_id : {required: true},
	    	user_role_type 		: { required: true},
	    	user_description  : { required: true},
	    	user_email 		: { required: true,email:true},
	    	
	    },
	    messages: {
	    	user_first_name 		: "First name is required",
	    	user_last_name 	: "Last name is required",
	    	user_name 		: "Username is required",
	    	password 		: {required:"Password is required",minlength: "Password must be at least 6 characters long"},
	    	user_profession : "Profession is required",
	    	user_tags  	    : "Tags is required",
	    	gender  		: "Gender  is required",
	    	user_country_id :'Country is required',
	    	user_description: {required: "Profile is required"},
	    	user_role_type  : { required: "Role type is required"},
	    	user_email  			: {required:"Email is required"},
	    },
	    tooltip_options: {
	    	'_all_': { placement:'right',html:true}
	    },  
errorPlacement: function(error, element) {
              if (element.attr("name") == "gender" )
                  error.insertAfter(".checkbox");
              else
                  error.insertAfter(element);
          },
	});
}
function selectuser(obj){
	
	if(jQuery(obj).hasClass("selected-border")){
	   jQuery(obj).removeClass("selected-border");
	   jQuery(obj).find( "div.judgetickmark" ).css("display","none");
	   var aIndex= selectedJudgeArr.indexOf(jQuery(obj).attr("id"));
	   selectedJudgeArr.splice(aIndex, 1);
	}else{
	   jQuery(obj).addClass("selected-border");
	   jQuery(obj).find( "div.judgetickmark" ).css("display","block");
	   selectedJudgeArr.push(jQuery(obj).attr("id"));
	}
}
function clearSelectedUser(){
	jQuery('.useritem ul').removeClass("selected-border");
	jQuery('.useritem ul').find("div.judgetickmark").css("display", "none");
	selectedJudgeArr.length = 0;
}
function getUserIcons(title)
{
	//alert(title);
	 switch (title) {
	     case 'create':
	         jQuery("#u_block").attr("src","public/images/delete_n.png");
	        
	         jQuery("#u_ceate").addClass("breadcrumb-btn_mountain");
	         jQuery("#u_ceate").removeClass("breadcrumb-btn_mountain_active");
	         break;
	     case 'delete':
	    	 jQuery("#u_block").attr("src","public/images/delete_a.png");
	         
	         jQuery("#u_ceate").removeClass("breadcrumb-btn_mountain");
			 jQuery("#u_ceate").addClass("breadcrumb-btn_mountain_active");
	         break;
		case 'default':
			 jQuery("#u_block").attr("src","public/images/delete_n.png");
		    
		    jQuery("#u_ceate").removeClass("breadcrumb-btn_mountain");
		    jQuery("#u_ceate").addClass("breadcrumb-btn_mountain_active");
		    clearSelectedUser();
		    break;
	}
}

function userimageselected(obj)
{
	var file  = obj[0]; 
	file_size = obj[0].size;
	image_select_flag = 0;
	if(file_size > 1048576) {
	   jQuery("#file_error").html("File size is greater than 1MB"); 
	} else {
		var ext = obj[0].type;
		ext = ext.split('/');
		if(jQuery.inArray(ext[1], ['jpg','jpeg','png']) == -1) {
		  jQuery("#file_error").html("Invalid file type"); 
		} else {
			var reader    = new FileReader();
			reader.onload = function (e)
			{   
			   
			    var image = new Image();
			       
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                   // alert(height+''+width);
                    if (height == 320 || width == 480) {
                    	 jQuery("#user_profile_image").attr('src', reader.result);
         			    jQuery("#userprofileImage").val(reader.result);  
         			    jQuery("#file_error").html("");  
                    }
                    else
                    {
                    	jQuery("#file_error").html("Please upload 480x320 size image"); 
                    }
                 }
			}
		}
	}
	reader.readAsDataURL(file);
}




function clearSelectUser(){
	//jQuery('.judgelist ul').removeClass("selected-border");
	//jQuery('.judgelist ul').find("div.judgetickmark").css("display", "none");
	selectedJudgeArr.length = 0;
}


