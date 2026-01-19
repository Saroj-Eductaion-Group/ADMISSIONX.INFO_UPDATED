

<div id="footer-v2" class="footer-v2">
	<div class="footer">
		<div class="container">
			<div class="row">
				<!-- About -->
				<div class="col-md-3 md-margin-bottom-40">
					<a href="/"><img id="logo-footer" class="footer-logo" src="{{asset('assets/images/logo.png')}}" width="200" alt="admissionx logo"></a>
					<p class="margin-bottom-20">AdmissionX is a first of its kind platform that connects students and institutions for the purpose of admission in different courses. With over 31100 colleges, more than 50200 courses in 4000 cities- AdmissionX aims to be your one stop solution for all things admission.</p>

					<form action="{{ URL::to('mailchimp') }}" class="footer-subsribe" method="post" id="mailChimpSubscribe" data-parsley-validate>
						<input type="text" class="form-control" id="emailSubscribe" name="email" placeholder="Subscribe to our Newsletter" data-parsley-type="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">

						<button class="btn-u btn-block margin-top10" type="submit">Go</button>
						<small class="pull-left text-danger" id="errorMessage"></small>
					</form>
					<p id="thank-you-message"></p>
				</div>
				<!-- End About -->

				<!-- Link List -->
				<div class="col-md-3 md-margin-bottom-40">
					<div class="headline"><h2 class="heading-sm">Company</h2></div>
					<ul class="list-unstyled link-list">
						<li><a href="{{ URL::to('about') }}">About us</a><i class="fa fa-angle-right"></i></li>
						<li><a href="{{ URL::to('careers') }}">Careers</a><i class="fa fa-angle-right"></i></li>
						<li><a href="{{ URL::to('contact-us') }}">Contact Us</a><i class="fa fa-angle-right"></i></li>
						<li><a href="{{ URL::to('help-center') }}">Help Center</a><i class="fa fa-angle-right"></i></li>
						<li><a href="{{ URL::to('terms-of-service') }}">Terms of Service</a><i class="fa fa-angle-right"></i></li>
						<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation Policy</a><i class="fa fa-angle-right"></i></li>
						<li><a href="{{ URL::to('payments-refunds-policy') }}">Refunds Policy</a><i class="fa fa-angle-right"></i></li>
					</ul>
				</div>
				<!-- End Link List -->

				<!-- Latest Tweets -->
				<div class="col-md-3 md-margin-bottom-40">
					<div class="latest-tweets">
						<div class="headline"><h2 class="heading-sm">Latest Tweets</h2></div>
						<!-- <a class="twitter-timeline" data-lang="en" data-height="224" data-theme="light" href="https://twitter.com/BYA_HQ">Tweets by BYA_HQ</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>	 -->
						<a class="twitter-timeline" data-lang="en" data-height="224" data-theme="light" href="https://twitter.com/adxdotcom">Tweets by AdmissionX</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
				</div>
				<!-- End Latest Tweets -->

				<!-- Address -->
				<div class="col-md-3 md-margin-bottom-40">
					<div class="headline"><h2 class="heading-sm">Contact Us</h2></div>
					<address class="md-margin-bottom-40">
						<i class="fa fa-home"></i>2nd Floor, L 5, Lajpat Nagar, <br /> <div class="padding-left25">New Delhi - 110024 </div>
						<i class="fa fa-home"></i>62, SVP Nagar, Four Bungalows, <br /> <div class="padding-left25"> Versova, Mumbai - 400053 </div>
						<i class="fa fa-phone"></i>Phone: 011-4224-9249 <br />
						<i class="fa fa-envelope"></i>Email: <a href="mailto:support@admissionx.info">support@admissionx.info</a>
					</address>

					<!-- Social Links -->
					<ul class="social-icons">
						<li><a href="https://www.facebook.com/AdmissionX/" target="_blank" data-original-title="Facebook" class="rounded-x social_facebook"></a></li>
						<li><a href="https://twitter.com/adxdotcom" target="_blank" data-original-title="Twitter" class="rounded-x social_twitter"></a></li>
						<li><a href="https://in.linkedin.com/company/officialadx" target="_blank" data-original-title="Linkedin" class="rounded-x social_linkedin"></a></li>
						<li><a href="https://www.youtube.com/channel/UCyF-Xah1WKGEq5bb0jKXtpg" target="_blank" data-original-title="Youtube" class="rounded-x social_youtube"></a></li>
						<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=RB4GUrj5tO2wKJ3GVA2ibl3nm7pqsbAjr0dxyIfYeny8l0i6rfko96pdcgMU"></script></span>
					</ul>
					<!-- End Social Links -->
				</div>
				<!-- End Address -->
			</div>
		</div>
	</div><!--/footer-->

	<div class="copyright">
		<div class="container">
			<p class="text-center">{!! date('Y') !!} &copy; All Rights Reserved. <a href="javascript:void(0);">AdmissionX</a></p>
		</div>
	</div><!--/copyright-->
</div>
<!--=== End Footer v2 ===-->

</div><!--/wrapper-->

</div><!--/wrapper-->

<!-- START FOOTER  -->
	@include('website/home-layouts.all-model')
<!-- END FOOTER  -->

{!! Html::script('assets/js/parsley.min.js') !!}
{!! Html::script('assets/js/forms/student-details.js') !!}
@include('administrator.users.validate-email-script')
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



<script type="text/javascript">
	var currentURL = window.location.href;
	var currentMenu = currentURL.substr(currentURL.lastIndexOf('/') + 1)
	$( ".res-container > ul > li > a" ).each( function( index, element ){
		if( currentURL == $( this ).attr('href')){
			$(this).parent().addClass('active');
			$(this).parent().parent().addClass('active');
			$(this).parent().parent().parent().addClass('active');
		}
	});
</script>


<!-- ZOPIM CHAT INTEGRATION -->
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3A9xnwMCkhFv6yQt6VbhXTovbGUcl64J";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
<!-- END

<!--Start of Zendesk Chat Script-->
<!-- <script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4to7sVeGtsuUkU9CeNZs3SxCaFFjncOK";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script> -->
<!--End of Zendesk Chat Script-->
