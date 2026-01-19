var LoginForm = function () {

    return {
        
        //Masking
        initLoginForm: function () {
	        // Validation for recovery form
	        $("#sky-form2").validate({
	            // Rules for form validation
	            rules:
	            {	
	            	collegeName:
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
	                    minlength: 6
	                },
	                password_again: {
				      equalTo: "#password"
				    }/*,
	                contactNumber:
	                {
	                	minlength: 7,
	                    maxlength: 11,
	                    digits: true
	                },*/
	            },
	                                
	            // Messages for form validation
	            messages:
	            {	
	            	collegeName:
	            	{
	            		required: 'Please enter your valid college name'
	            	},
	                email:
	                {
	                    required: 'Please enter your email address',
	                    email: 'Please enter a valid email address'
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

	                    	if( data.code == '200' ){
	                    		window.location.href="detail-sign-up/"+data.slug; 
	                        	$("#sky-form2").addClass('submited');	
	                    	}else if( data.code == '400' ){
	                    		toastr.error('reCAPTCHA is mandatory');
	                    		$('.duplicateEmaill').text('Please verify the captcha').show().delay(5000).fadeOut(400);
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

	        $("#sky-form3").validate({
	            // Rules for form validation
	            rules:
	            {	
	            	collegeName:
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
	                    minlength: 6
	                },
	                password_again: {
				      equalTo: "#password1"
				    }/*,
	                contactNumber:
	                {
	                	minlength: 7,
	                    maxlength: 12,
	                    digits: true
	                },*/
	            },
	                                
	            // Messages for form validation
	            messages:
	            {	
	            	collegeName:
	            	{
	            		required: 'Please enter your valid college name'
	            	},
	                email:
	                {
	                    required: 'Please enter your email address',
	                    email: 'Please enter a valid email address'
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

	                    	if( data.code == '200' ){
	                    		window.location.href="detail-sign-up/"+data.slug; 
	                        	$("#sky-form2").addClass('submited');	
	                    	}else if( data.code == '400' ){
	                    		toastr.error('reCAPTCHA is mandatory');
	                    		$('.duplicateEmaill').text('Please verify the captcha').show().delay(5000).fadeOut(400);
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