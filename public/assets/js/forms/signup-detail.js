var SignUpDetailForm = function () {

    return {
       
        initSignUpForm: function () {
	        // Validation for recovery form
	        $("#sky-form2").validate({
	            // Rules for form validation
	            	                                
	            // Ajax form submition                  
	            submitHandler: function(form)
	            {
	                $(form).ajaxSubmit(
	                {
	                    success: function()
	                    {	
	                    	window.location.href="sucess-signup-details"; 
	                        $("#sign-up-detail").addClass('submited');
	                    }
	                });
	            },              
	            
	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
        
        }

    };

}();