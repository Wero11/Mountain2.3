function flipPage(which,to)
{
	jQuery("label.error").remove();
	jQuery(".error").removeClass("error");
	jQuery('#form-login').find("input,textarea").val('').end();
	jQuery('#email_form').find("input,textarea").val('').end();
	jQuery('#form-' + to).addClass('inactive');
    jQuery('#form-' + to).removeClass('active');
    jQuery('#form-' + which).addClass('active');
    jQuery('#form-' + which).removeClass('inactive');

}
function loginFormValidation()
{
	
	jQuery("#form-login").validate({
         rules: {
        	 user_name: {
               required: true,

            },
            password: {
               required: true,

            },
         },
         messages: {
            user_name: {
               required: "Username is required",
            },
            password: {
               required: "Password is required",
            }
         },
         tooltip_options: {
         	'_all_': { placement:'right',html:true}
         }
         
      });
}
function usernameFormValidation()
{
	
	jQuery("#email_form").validate({
         rules: {
        	 email: {required: true,email:true},
          
         },
         messages: {
            email: {
               required: "Email is required",
               email   : "Enter a valid email",
            },
          
         },
         tooltip_options: {
         	'_all_': { placement:'right',html:true}
         }
         
      });
}

jQuery( document ).ready(function() {
	loginFormValidation();
	usernameFormValidation();
	
});