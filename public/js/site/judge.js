var selectedJudgeArr = new Array();
function clear_judge()
{
	jQuery('#first_name').val('');
    jQuery('#description').val('');
    jQuery('#family_name').val('');
    jQuery('#profession').val('');
    //jQuery('#judge_type').val('');
    jQuery("#tags").val('');
    jQuery("#email").val('');
    jQuery("#website").val('');
    jQuery('h4.modal-title').text('Create Judge');
    jQuery("#file_error").html('');
jQuery("#judge_error").html(""); 
    jQuery("label.error").remove();
 jQuery("#password").prop("type", "text");
    jQuery(".error").removeClass("error");
jQuery('#user_name').val('').prop('disabled',false);
    	jQuery('#password').val('').prop('disabled',false);
    jQuery("#judge_profile_image").attr('src',baseurl+"/public/images/img-placeholder.jpg");
    jQuery('#add_judge').find("input,textarea").val('').end()
      .find("label.error").remove();
    flag='add';
    jQuery('#create_judge').show();
    jQuery('#update_judge').hide();
jQuery('#add_prof').hide();
				jQuery('#select_prof').show();
				jQuery('#prof_error').html('');
}


function judgevalidation(){
	jQuery("#add_judge").validate({
	    rules: {
	    	first_name 	: {required: true},
	    	last_name 	: {required: true},
	    	user_name 	: {required: true},
	    	password 	: {required: true, minlength: 6},
	    	profession  : {required: true},
	    	tags 		: {required: true},	    	
	    	website     : {required: true},
	    	description : {required: true},
	    	email 		: { required: true,email:true},
	    	judge_type  : { required: true},
	    	
	    },
	    messages: {
	    	first_name 		: "First name is required",
	    	family_name 	: "Last name is required",
	    	user_name 		: "Username is required",
	    	password 		: {required:"Password is required",minlength: "Password must be at least 6 characters long"},
	    	profession      : "Profession is required",
	    	tags  			: "Tags is required",
	    	email  			: {required:"Email is required"},
	    	website  		: {required:'Website is required'},
	    	description		: {required: "Bio is required"},
	    	judge_type  	: { required: "Type is required"},
	    },
	    tooltip_options: {
	    	'_all_': { placement:'right',html:true}
	    },  
	});
}

function getJudge(judge_id){
	var response = jQuery.postValues('/api/v1/device/getJudgeDetail',{user_id:judge_id}); 

    if(response){
clear_judge();
 jQuery("#password").prop("type", "password");
    	jQuery('h4.modal-title').text('Edit Judge');
    	jQuery('#judgemodal').modal('show');
    	jQuery('#first_name').val(response.first_name);
    	jQuery('#family_name').val(response.family_name);
    	jQuery('#user_name').val(response.user_name).prop('disabled',true);
    	jQuery('#password').val(response.password).prop('disabled',true);
	    jQuery('#description').val(response.description);	    
	    jQuery("#profession option[value=" + response.profession + "]").prop("selected",true);
	    jQuery("#mountain_judge_type option[value=" + response.judge_type + "]").prop("selected",true);
	    jQuery("#tags").val(response.tags);
	    jQuery("#email").val(response.email);
	    jQuery("#judge_id").val(response.user_id);
	    jQuery("#website").val(response.website);
	    if(response.ProfileImage == '' || response.ProfileImage == null) {
          jQuery('#judge_profile_image').attr('src',baseurl+'/public/upload/thumbnail/noimage.png'); 
        } else {
          jQuery('#judge_profile_image').attr('src',baseurl+'/public/upload/thumbnail/'+response.ProfileImage);
        }
        jQuery('#create_judge').hide();
        jQuery('#update_judge').show();

    }	
}

function imageselected(obj)
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
                    if (height == 320 && width == 480) {
                    	 jQuery("#judge_profile_image").attr('src', reader.result);
         			    jQuery("#judgeprofileImage").val(reader.result);  
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


function selectjudge(obj){
	//alert(jQuery(obj).attr("hide"));
       if(jQuery(obj).attr("hide")==0)
       {
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
	//jQuery("#j_assign_mountain").prop('disabled', true);
}

function clearSelectJudge(){
	jQuery('.judgelist ul').removeClass("selected-border");
	jQuery('.judgelist ul').find("div.judgetickmark").css("display", "none");
	selectedJudgeArr.length = 0;
}

function selectMountain(object,mountain_id){
	jQuery(".mitem").removeClass("selected-image");
	jQuery(".citem").removeClass("selected-image");
	jQuery(object).addClass("selected-image");
	jQuery('#mountain_id').val(mountain_id);
}

function clearMountain(){
	jQuery(".mitem").removeClass("selected-image");
	jQuery(".citem").removeClass("selected-image");
	jQuery('#mountain_id').val('');
}

function arrowRight(selector){
	var $item = jQuery('div.'+selector), 
        visible = 4, 
        index = 0,
        endIndex = ( $item.length / visible ) - 1;

	if(index < endIndex ){
          index++;
          $item.animate({'left':'-=600px'});
    }
}
function arrowLeft(selector){
	var $item = jQuery('div.'+selector), 
        visible = 4, 
        index = 0,
        endIndex = ( $item.length / visible ) - 1;

	if(index < endIndex ){
          index++;
          $item.animate({'left':'+=600px'});
    }

}
function showUnhideJudgePopup(title, flag, selector, clear_form, paramvalue) {
    if (clear_form)
        window[clear_form]();
    jQuery('h4.modal-title').text(title);
    jQuery('#unhide_judge_id').val(paramvalue);
    jQuery('#' + selector).modal('show');

}
function imgError(image) {
    image.onerror = "";
    image.src = baseurl+'/public/upload/thumbnail/noimage.png';
    image.class= "";
    return true;
}

