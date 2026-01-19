{!! Html::script('assets/js/parsley.min.js') !!}
{!! Html::script('assets/js/forms/student-details.js') !!}

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('submit', '#mailChimpSubscribe', function(){
		var data = $(this).serialize();
 		var email = $('#emailSubscribe').val();
 		$('.updateProfileBlock').addClass('hide');
		$.ajax({
			type : 'POST',
			url  : '/mailchimp',
			data: JSON.stringify({emailSubscribe: email}),
	        contentType: "application/json; charset=utf-8",
	        dataType: "json",
			success :  function(data){
				if( data.code == '200' ){
					$('.updateProfileBlock').removeClass('hide');
                    $('.updateProfileBlock .profileUpdateMessage').html(data.message);
                    $('#profileUpdate').modal({show: 'true'});
					$('#emailSubscribe').val('');
					$('#thank-you-message').text('Thank you for subscribing AdmissionX').show().delay(2000).fadeOut(400);
				}else{
					$('.updateProfileBlock').removeClass('hide');
                    $('.updateProfileBlock .profileUpdateMessage').html(data.message);
                    $('#profileUpdate').modal({show: 'true'});
					$('#emailSubscribe').val('');
					$('#thank-you-message').text('Thank you for reconfirming as you are already subscribed us').show().delay(2000).fadeOut(400);
				}
	       }
		});
		return false;
		});
	});
</script>


<script type="text/javascript">
	//AJAX

	$( '.studentSignUpProcess' ).submit(function(e) {
  		e.preventDefault();

  		//VALIDATE FORM SUBMISSION
  		if( $(this).find('input[name=firstName]').val() == ''){
  			return false;
  		}else if($(this).find('input[name=lastName]').val() == ''){
  			return false;
  		}else if( $(this).find('input[name=email]').val() == ''){
  			return false;
  		}else if( $(this).find('input[name=phone]').val() == ''){
  			return false;
		}else if( $(this).find('#password1').val() == ''){
			return false;
		}else if( $(this).find('#password_again').val() == ''){
			return false;
  		}else if( $(this).find('#password1').val() == $(this).find('#password_again').val() ){
  			var form = $(this).serialize();
	  		$.ajax({
		        type: "POST",
		        url: '{{ URL::to("student-sign-up-action") }}',
		        data: form,
		        success: function(data){
		            if( data.code =='200' ){
		            	window.location.href="student-detail-sign-up/"+data.slug;
		            }else if( data.code == '400' ){
                		$('.duplicateEmaill').text('Please verify the captcha').show().delay(5000).fadeOut(400);
                		toastr.error('reCAPTCHA is mandatory');
                	}else{
		            	$('.duplicateEmaill').text('This Email ( '+data.email+' ) address is already registered with us. Please try with new one.').show().delay(5000).fadeOut(400);
	            		$('input[name=email]').val('');
		            }
		        }
		    });
  		}else{
  			return false;
  		}
	});

</script>
<script type="text/javascript">
		$(document).ready(function(){
		    $('#dateChange').on('change', function(){
				var dateofbirth = $(this).val();
				var HTML = '';
				var year = '';
				$.ajax({
		            headers: {
		              'X-CSRF-Token': $('input[name="_token"]').val()
		            },
		            method: "GET",
		            data: { dateofbirth: dateofbirth },
		            contentType: "application/json; charset=utf-8",
		            dataType: "json",
		            url: "{{ URL::to('/getCurrentDOBCalculate') }}",
		            success: function(data) {
	            		if( data.code == '200' ){
	            			$('.calculatedDateFromNow').text(data.calculateDate);
	            			year = data.year;
	           	 			if( year < 18 ){
	           	 				$('input[name=parentsname]').val('');
	           	 				$('input[name=parentsnumber]').val('');
	           	 				$('.gurdianBlock').removeClass('hide');
	            			}else{
	            				$('input[name=parentsname]').val('');
	           	 				$('input[name=parentsnumber]').val('');
	            				$('.gurdianBlock').addClass('hide');
	            			}
	            		}else{

	            		}
		            }
		        });
			});
		});
	</script>

<script type="text/javascript">
	//AJAX
	$( '.homeLoginPopupWindow' ).submit(function(e) {
		$('.homeLoginPopupWindow .errorMessageBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("ajax-do-login") }}',
	        data: form,
	        success: function(data){
	        	if( data.code =='200' ){
	        		window.location='/'+data.url;
	            }else if( data.code == '401' ){
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }else if( data.code == '210' ){
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }else if( data.code == '220' ){
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }else{
	            	$('.homeLoginPopupWindow .errorMessageBlock').removeClass('hide');
	            	$('.homeLoginPopupWindow .errorMessage').html(data.response);
	            }
	        }
	    });
	});
</script>

@include('administrator.users.validate-email-script')