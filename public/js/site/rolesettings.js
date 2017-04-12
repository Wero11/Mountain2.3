function onShowCreateRolePopup() {
    clear_form();
    jQuery('h4.modal-title').text('Create Role');
    jQuery('#btn-create-role').addClass("breadcrumb_btn_role");
    jQuery('#roleduplicate').hide();
    jQuery('#rolename').val('');
    jQuery('#description').val('');
    jQuery('#rolemodal').modal('show');
    flag = 'add';
    //getIcons('create');
}

function showDeleteRolePopup(title, flag, selector, clear_form, paramvalue) {
   
    if (clear_form)

        window[clear_form]();

    jQuery('h4.delete-role-modal-title').text(title);

    jQuery('#roleid').val(paramvalue);

    jQuery('#' + selector).modal('show');



}

function addRolevalidation(){
	jQuery("#add_role").validate({
	    rules: {
	    	rolename 		: {required: true},
	    	
	    },
	    messages: {
	    	rolename 			: "Role name is required",
	    },
	    tooltip_options: {
	    	'_all_': { placement:'right',html:true}
	    },  
	});

	}
