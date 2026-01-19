@extends('website/new-design-layouts.master')

@section('content')

<!-- <div class="container  content-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12 md-margin-bottom-50">
			</div>
		</div>
	</div>
</div> -->


<style type="text/css">
	.termna-navbar{ width:unset !important; padding-top:4px !important; text-align:center;  }
	.termna-navbar  li{ display:inline !important; }
	.termna-navbar  li a{ display:inline-block !important;}
</style>

<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav termna-navbar">
			<li><a href="{{ URL::to('terms-of-service') }}">Terms Of Service</a></li>
			<li><a href="{{ URL::to('privacy-policy') }}" class="active" style="color: #fff;">Privacy Policy</a></li>
			<li><a href="{{ URL::to('payments-refunds-policy') }}">Payments & Refunds Policy</a></li>
			<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation & Refunds</a></li>
			<!-- <li><a href="{{ URL::to('student-referral-policy') }}">Student referral policy</a></li> -->
			<li><a href="{{ URL::to('admission-registration-policy') }}">Admission Registration Policy</a></li>
			<li><a href="{{ URL::to('advertiser-agreement') }}">Advertiser Agreement</a></li>
			@if(Auth::check())									
				{{--*/   $getLoggedObj = DB::table('users')
						->where('users.id', '=', Auth::id())
	                    ->where('users.userrole_id','=','2')
	                    ->select('users.id')
	                    ->take(1)
	                    ->get()
	                    ;
	        	/*--}}
	        	@if( $getLoggedObj )
	        	<li><a href="{{ URL::to('college-partner-agreement') }}">College Agreement</a></li>								
				@endif
			@endif
		</ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
	<div class="col-md-12">
		<div class="container content">
			<div class="row-fluid privacy" style="text-align: justify;">
				@foreach($getPageContentDataObj as $item)
					<div class="overflow-h">
						<h4 class="text-center"><strong>{{ $item->title }}</strong></h4>
						{!! $item->description !!}
					</div>
				@endforeach
				<!-- <h4 class="text-center"><strong>This Privacy Policy applies to admissionx.com</strong></h4><br/>
				<p>	AdmissionX recognises the importance of maintaining your privacy. We value your privacy and appreciate your trust in us. This Policy describes how we treat user information we collect on 
				  	<a href="https://www.admissionx.com">https://www.admissionx.com</a> and other offline sources. This Privacy Policy applies to current and former visitors to our website and to our online customers. By visiting and/or using our website, you agree to this Privacy Policy.
				</p>

				<p>Admissionx.com is a property of Yuvi Aviation Pvt. Ltd., an Indian Company registered under the Companies Act, 2013 having its registered office at L-5, Lajpat Nagar 2, New Delhi - 110024
				</p>

				<p><strong>Contact information. </strong> We might collect your name, email, mobile number, phone number, street, city, state, pin code, country and IP address.
				</p>

				<p><strong>Payment and billing information. </strong> We might collect your billing name, billing address and payment method when you register for admission. We NEVER collect your credit card number or credit card expiry date or other details pertaining to your credit card on our website. Credit card information will be obtained and processed by our online payment partner, PayU money.
				</p>

				<p><strong>Information you post. </strong>  We collect information you post in a public space on our website or on a third-party social media site belonging to admissionx.com
				</p>
				
				<p><strong>Demographic information. </strong>  We may collect demographic information about you, educational institutions and courses you like, events you intend to participate in, or any other information provided by you during the use of our website. We might collect this as a part of a survey also.
				</p>

				<p><strong>Other information. </strong> If you use our website, we may collect information about your IP address and the browser you're using. We might look at what site you came from, duration of time spent on our website, pages accessed or what site you visit when you leave us. We might also collect the type of mobile device you are using, or the version of the operating system your computer or device is running.
				</p><br/>
				 
				<h4><strong>We collect information in different ways.</strong></h4><br/>

				<p><strong>We collect information directly from you:</strong> We collect information directly from you when you register on the website or book admission. We also collect information if you post comments on our websites or ask us a question through phone or email.

				</p>

				<p><strong>We collect information from you passively. </strong> We use tracking tools like Google Analytics, Google Webmaster, browser cookies and web beacons for collecting information about your usage of our website.
				</p>

				<p><strong>We get information about you from third parties. </strong>For example, if you use an integrated social media feature on our websites. The third-party social media site will give us certain information about you. This could include your name and email address.
				</p><br/>

				<h4><strong>Use of your personal information</strong></h4><br/>
				<p><strong>We use information to contact you: </strong> We might use the information you provide to contact you for confirmation of a purchase on our website or for other promotional purposes.
				</p>

				<p><strong>We use information to respond to your requests or questions.</strong> We might use your information to 
					confirm your registration for admission or other associated services and events.
				</p>

				<p><strong>We use information to improve our products and services. </strong> We might use your information to
				customize your experience with us. This could include displaying content based upon your preferences.</p>

				<p><strong>We use information to look at site trends and customer interests.</strong> We may use your information to make our website and products better. We may combine information we get from you with information we get from third parties.</p>
				
				<p><strong>We use information for security purposes. </strong> We may use the information to protect our company, our customers, or our websites.</p>

				<p><strong>We use information for marketing purposes. </strong> We might send you information about special promotions or offers. We might also tell you about new features or services. These might be our own offers or services, or third-party offers, products or services we think you might find interesting.</p>

				<p><strong>We use information to send you transactional communications. </strong> We might send you emails or SMS about your account or transactions.</p>

				<p>We use information as otherwise permitted by law.</p><br/>
				
				<h4><strong>Sharing of information with third-parties</strong></h4><br/>

				<p><strong>We will share information with third parties who perform services on our behalf.</strong> We share information with vendors who help us manage our online registration process or payment processors or transactional message processors. Some vendors may be located outside of India.</p>

				<p><strong>We will share information with the education institutions and service providers.</strong> We share your information with education institutions and other parties responsible for fulfilling the purchase obligation. The education institutions and other parties may use the information we give them as described in their privacy policies.</p>

				<p><strong>We will share information with our business partners.</strong> Our partners use the information we give them as described in their privacy policies.</p>

				<p><strong>We may share information if we think we have to in order to comply with the law or to protect ourselves.</strong> We will share information to respond to a court order or subpoena. We may also share it if a government agency or investigatory body requests. Or, we might also share information when we are investigating potential fraud.</p>

				<p><strong>We may share information with any successor to all or part of our business.</strong> For example, if part of our business is sold we may give our customer list as part of that transaction.</p>

				<p><strong>We may share your information for reasons not described in this policy.</strong> We will tell you before we do this.</p><br/>

				<h5><strong>Email Opt-Out</strong></h5>
				<p><strong>You can opt out of receiving our marketing emails.</strong> To stop receiving our promotional emails, please email at <a href="mailto:unsubscribe@admissionx.com">unsubscribe@admissionx.com</a> It may take about ten days to process your request. Even if you opt out of getting marketing messages, we will still be sending you transactional messages through email and SMS about your purchases.</p><br/>

				<h5><strong>Third party sites</strong></h5>
				<p>If you click on one of the links to third party websites, you may be taken to websites we do not control. This policy does not apply to the privacy practices of those websites. Read the privacy policy of other websites carefully. We are not responsible for these third-party sites.
				</p><br/>

				<h5><strong>Updates to this policy</strong></h5>
				<p>This Privacy Policy was last updated on 04/07/2017. From time to time we may change our privacy practices. We will notify you of any material changes to this policy as required by law. We will also post an updated copy on our website. Please check our site periodically for updates.</p><br/>

				<h5><strong>Jurisdiction</strong></h5>
				<p>If you choose to visit the website, your visit and any dispute over privacy are subject to this Policy and the website's terms of use. In addition to the foregoing, any disputes arising under this Policy shall be governed by the laws of India.</p>

				<p>If you have any questions about this Policy or other privacy concerns, you can also email us at <a href="mailto:support@admissionx.info">support@admissionx.info</a></p><br/> -->
				
			</div><!--/row-fluid-->
		</div><!--/container-->
	</div>
</div>
			
@endsection


