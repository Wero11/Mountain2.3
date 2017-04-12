function blockUserPopup(userid, notificationid) {
  if(userid!=''){
	  clear_userblock_form();

	    jQuery('h4.modal-title').text('Block User');

	    jQuery('#blcokusermodal').modal('show');

	    jQuery('#blcokusermodal').find('#user_id').val(userid);
	    jQuery('#blcokusermodal').find('#notific_id').val(notificationid);

	}
  else
  {
	confirmBox('Alert',"Please Select Atleast one User",'','');
	 confirmModal.modal('show');
	confirmModal.find('#okButton').hide();
	confirmModal.find('#cancelButton').hide();
  }
  
    

}
function blockUsernValidation(){
	jQuery("#frmblcokuser").validate({
	    rules: {
	    	daterange 		: {required: true},
	    	description  	: {required: true},
	    	
	    },
	    messages: {
	    	daterange 			: "Date range is required",
	    	description 			: "Description is required",
	    },
	    tooltip_options: {
	    	'_all_': { placement:'right',html:true}
	    },  
	});

	}
function blockUser() {

    if (jQuery("#frmblcokuser").valid()) {

        var blockuserdata = jQuery('#frmblcokuser').serializeArray();

        jQuery.ajax({

            type: 'POST',

            url: 'api/v1/site/blockUser',

            data: blockuserdata,

            dataType: 'json',

            success: function (data) {

                jQuery('#blcokusermodal').modal('hide');



            }

        });

    } else {

        return false;

    }

}

function clear_userblock_form() {

    jQuery('input[name="blocktype"]:checked').val('');

    jQuery('#daterange').val('');

    jQuery('#description').val('');
    jQuery('#adminnote').val('');
jQuery("label.error").remove();
    jQuery(".error").removeClass("error");

}



jQuery('.blocktype').click(function (event) {

    if (jQuery(this).val() == 'PERM') {

        jQuery('#daterangerow').hide();

    } else if (jQuery(this).val() == 'TEMP') {

        jQuery('#daterangerow').show();

    }

});



function UserDetailPopupforBlock(userid) {

    jQuery('h4.modal-title').text('USER DETAILS');

    jQuery('#userdetailblockmodal').modal('show');

}



function showDeleteNotificationPopup(title, flag, selector, clear_form, paramvalue) {
	jQuery("#m_push").attr("src","public/images/push_n.png");
	
    if (clear_form)

        window[clear_form]();

    jQuery('h4.modal-title').text(title);

    jQuery('#notificationid').val(paramvalue);

    jQuery('#' + selector).modal('show');



}

function showUnBlockUserPopup(title, flag, selector, clear_form, paramvalue) {
    jQuery("#m_push").attr("src", "public/images/push_n.png");

    if (clear_form)

        window[clear_form]();

    jQuery('h4.modal-title').text(title);

    jQuery('#unblockuserid').val(paramvalue);

    jQuery('#' + selector).modal('show');



}

function showDeleteFeedPopup(title, flag, selector, clear_form, paramvalue) {

    if (clear_form)

        window[clear_form]();

    jQuery('h4.modal-title').text(title);

    jQuery('#deletefeedid').val(paramvalue);
    
    jQuery('#' + selector).modal('show');



}









