var StudentSignUpForm = function () {

    return {
        
        //Masking
        initStudentSignUpForm: function () {
	        // Validation for recovery form
	        $("#sky-form4").validate({
	            // Rules for form validation
	            rules:
	            {	
	            	suffix:
	            	{
	            		required: true,
	            	},
	            	firstName:
	            	{
	            		required: true,
	            	},
	            	lastName:
	            	{
	            		required: true,
	            	},
	                email:
	                {
	                    required: true,
	                    email: true
	                },
	                password:
	                {
	                    required: true,
	                    minlength: 6,
	                },
	                password_again: {
				      equalTo: "#password"
				    },
	                phone:
	                {
	                	minlength: 7,
	                    maxlength: 11,
	                    digits: true
	                },
	            },
	                                
	            // Messages for form validation
	            messages:
	            {	suffix:
	            	{
	            		required: 'Please select suffix'
	            	},
	            	firstName:
	            	{
	            		required: 'Please enter your first name'
	            	},
	            	lastName:
	            	{
	            		required: 'Please enter your last name'
	            	},
	                email:
	                {
	                    required: 'Please enter your email address',
	                    email: 'Please enter a VALID email address'
	                },
	                password:
	                {
	                    required: 'Please enter your password'
	                }
	            },
	                                
	            // Ajax form submition                  
	            submitHandler: function(form)
	            {	
	            	$('button[type=submit]').attr('disabled', 'disabled');
	            	$('button[type=submit]').css('background', '#AFEA7D');
	            	$('#loader').removeClass('hide');
	            	
	                $(form).ajaxSubmit(
	                {
	                    success: function(data)
	                    {	
	                    	$('button[type=submit]').removeAttr('disabled', 'disabled');
			            	$('button[type=submit]').css('background', '');
			            	$('#loader').addClass('hide');
			            	console.log(data);
	                    	if( data.code == '200' ){
	                    		//window.location.href="sucess-signup/"; 
	                    		window.location.href="/student-detail-sign-up/"+data.slug; 
	                        	$("#sky-form4").addClass('submited');	
	                    	}else if( data.code == '400' ){
	                    		$('.duplicateEmaill').text('Please verify the captcha').show().delay(5000).fadeOut(400);
	                    		toastr.error('reCAPTCHA is mandatory');
	                    	}else{
	                    		$('.duplicateEmaill').text('This Email ( '+data.email+' ) address is already registered with us. Please try with new one.').show().delay(5000).fadeOut(400);
	                    		$('input[name=email]').val('');
	                    	}
	                    	
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