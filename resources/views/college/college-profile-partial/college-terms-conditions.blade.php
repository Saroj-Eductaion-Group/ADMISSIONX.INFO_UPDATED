@extends('website/new-design-layouts.master')


@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/dashboard/edit', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-12">
								<h2 class="text-center">Terms and Conditions</h2>		
							</div>							
						</div>
					</div>
					<div class="wrapper wrapper-content animated bounceInRight">
						<div class="row">
					        <div class="col-lg-12">
					            <div class="ibox float-e-margins">
					                <div class="ibox-content text-center p-md">
					                    <h2><span class="text-navy">
					                    @if( $getCollegeProfileObj )
											@foreach( $getCollegeProfileObj as $item )
												{{ $item->firstname }}
											@endforeach
										@endif 
										 - </span>
					                     is advised to send the below terms and conditions on a signed agreement of ₹ 10 stamp paper</h2>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<div class="container">
	<div class="col-md-12">
		<div class="container content">
			<div class="row-fluid privacy">
				<h4><strong>Terms and Conditions:</strong></h4>
				<p>The following terms and conditions, along with all other terms and legal notices www.admissionx.com (collectively, "Terms"), govern your use of www.admissionx.com (the "Website"). If you do not understand and agree to be bound by all Terms, do not use this Website. Your use of this Website at anytime constitutes a binding agreement by you to abide by these Terms.</p>

				<h4><strong>Registration:</strong></h4>
				<h4>On registration you agree to: </h4>
				<br />
				<ol>
					a) Make your contact details available to  Admissionx.com, any of the college / institute / University concerned, you may be contacted by Admissionx.com or above for education information through email, telephone and SMS.
					<br />
					b) Receive promotional mails / special offers from Admissionx.com or any of its linked websites or the college / institute / University concerned.
				</ol>
				<h4><strong>Disclaimer for websites that we link to</strong></h4>
				<p>We use our best endeavours to ensure that the websites we select for inclusion in www.admissionx.com work, and continue to work properly; that their content remains acceptable and useful; and that their operation will not be injurious to our users' PCs.</p>
				<p>We explicitly disclaim, and will not accept any responsibility for any of the following in respect of the sites that we link to:</p>
				<ol>
					<li>Infection by computer viruses</li>
					<li>Damage caused by downloaded software</li>
					<li>Technical problems, failures and speed of operation</li>
					<li>Libelous or illegal material</li>
					<li>The quality or truth of any material, or advice that is offered	</li>
				</ol>
				<h4><strong>DISCLAIMER OF WARRANTY:</strong></h4>
				<p>'Yuvi Aviation (P) Ltd.' expressly disclaims warranties of any kind for any use of or any access to www.admissionx.com, to any material, information, links, or content presented on the web pages at www.admissionx.com, to any external website linked thereto, and to any external material, information, links, or content linked thereto admissionx.com.  And any material, information, links, and content presented on the web pages at www.admissionx.com, as well as any external website and any external material, information, links, and content linked thereto, are provided on an "as is where is" basis, without warranty of any kind, either express or implied, including, without limitation, the implied warranties of merchantability or fitness for a particular purpose, or non-infringement. 'Yuvi Aviation (P) Ltd.' has no control over any external website or over any external material, information, links, and content linked to www.admissionx.com certain jurisdictions do not permit the exclusion of implied warranties and the foregoing exclusions of implied warranties may not apply to you. admissionx.com  and its internal web pages may be unavailable for online access from time to time and at anytime; there are no guarantees and no warranties of online availability, impressions, and click-throughs. The entire risk as to the performance of, or non-performance of, or arising out of the use of, or the access of, or the lack of access to www.admissionx.com, to any material, information, links, or content presented on the web pages at www.admissionx.com, to any external website linked thereto, or to any external material, information, links, or content linked thereto, is borne by the user, visitor, customer, or other persons. </p>

				<h4><strong>DISCLAIMER OF ONLINE AVAILABILITY, IMPRESSIONS, AND CLICK-THROUGHS:</strong></h4>
				<p>In addition to the other disclaimers and limitations discussed in this notice, there are no guarantees and no warranties regarding online availability, impressions, and click-through of www.admissionx.com its web pages, and any material, information, links, or content presented on the web pages at admissionx.com, its web pages, and any material, information, links, or content presented on the web pages at www.admissionx.com may be unavailable for online access at anytime. Advertising sponsors and advertising must be approved by ‘Yuvi Aviation (P) Limited' before the posting of any advertising material, information, links, content, banners, and graphics on www.admissionx.com . 'Yuvi Aviation (P) Ltd.’  reserves the right to accept or to reject any registration for admission or any other communication from any of the users for any reason. </p>
				<h4><strong>PAYMENT TERMS:</strong></h4>
				<p>Payments for the services offered by  www.admissionx.com shall be 10% of first year total fees as registration charge for booking of admission. The payment for service once subscribed to by the subscriber is not refundable and any amount paid  for  booking of admission shall stand appropriated. Refund if any will be at the sole discretion of Yuvi Aviation (P) Ltd.. Yuvi Aviation (P) Ltd. offers no guarantees whatsoever for the accuracy or timelines of the refunds reaching the Customers card / bank accounts.  Yuvi Aviation (P) Ltd gives no guarantees of server uptime or applications working properly. All is on a best effort basis and liability is limited to refund of amounts received only. Yuvi Aviation (P) Ltd. undertakes no liability for free services. Yuvi Aviation (P) Ltd reserves its right to amend / alter or change all or any disclaimers, contents or terms of agreements at any time without any prior notice. All terms / disclaimers whether specifically mentioned or not shall be deemed to be included if any reference is made to them. </p>
				<h4><strong>LIMITATION OF LIABILITY:</strong></h4>
				<p>In no event and under no circumstances and under no legal theory, tort, contract, or otherwise shall  Yuvi Aviation(P) Ltd  be liable, without limitation, for any damages whatsoever, including direct, indirect, incidental, consequential or punitive damages, arising out of any access to or any use of or any inability to access or use this website including any material, information, links, and content accessed through this website or through any linked external website.</p>
				<h4><strong>Local Laws</strong></h4>
				<p>Yuvi Aviation (P) Ltd controls and operates this Website from its headquarters in New Delhi and in Mumbai makes no representation that the materials on the website are appropriate or available for use in other locations. If you use this Website from other locations, you are responsible for compliance with applicable local laws including but not limited to the export and import regulations of other countries. Unless otherwise explicitly stated, all marketing or promotional materials found on this Website are solely directed to individuals, companies or other entities located in India and comply with the laws prevailing for the time being in force in India. Disputes if any shall be subject to the exclusive jurisdiction of Courts at New Delhi and shall be referred for arbitration at New Delhi to be adjudicated by a Sole Arbitrator to be appointed by the Managing Director of Yuvi Aviation (P) Ltd..</p>
				<h4><strong>LICENSE DISCLAIMER</strong></h4>
				<p>Nothing on any 'Yuvi Aviation (P) Ltd website shall be construed as conferring any license under any of Yuvi Aviation (P) Ltd or any third party's intellectual property rights, whether by estoppel, implication, or otherwise. </p>
				<h4><strong>CONTENT AND LIABILITY DISCLAIMER</strong></h4>
				<p>The admissionx.com is an intermediary as defined under sub-clause (w) of Section 2 of the Information Technology Act, 2000.</p>
				<br />
				<p>Yuvi Aviation (P) Ltd shall not be responsible for any errors or omissions contained on any Yuvi Aviation (P) Ltd website, and reserve the right to make changes anytime without notice. Mention of non-Yuvi Aviation (P) Ltd. services are provided for informational purposes only and constitutes neither an endorsement nor a recommendation by 'Yuvi Aviation (P) Ltd.' and third-party information provided on any ‘Yuvi Aviation (P) Ltd.’ website is provided on an "as is where is" basis. </p>
				<p>Views expressed by the users are their own; Yuvi Aviation (P) Ltd. does not endorse the same. No claim as to the accuracy and correctness of the information on the site is made although every attempt is made to ensure that the content is not misleading. In case any inaccuracy is or otherwise improper content is sighted on the website, please report it to report abuse </p>
				<p>'Yuvi Aviation (P) Ltd.' DISCLAIMS ALL WARRANTIES, EXPRESSED OR IMPLIED, WITH REGARD TO ANY INFORMATION (INCLUDING ANY SOFTWARE, PRODUCTS, OR SERVICES) PROVIDED ON ANY  Yuvi Aviation (P) Ltd WEBSITE, INCLUDING THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. </p>
				<p>Use of this Website is at your own risk, and the 'Yuvi Aviation (P) Ltd will not be held liable for any errors or omissions contained in this Website. In no event, shall the ‘Yuvi Aviation (P) Ltd.’ be liable for any special, indirect or consequential damages, or any damages whatsoever resulting from loss of use, data or profits whether contract, negligence or any tort action arising out of, or in connection with, the use or performance of the information available from www.admissionx.com</p>
				<p>Yuvi Aviation (P) Ltd may, without notice in its sole discretion, and at any time, terminate or restrict your use or access to admissionx.com (or any part thereof) and / or take down any content uploaded by you for any reason, including, without limitation, based on its judgment and perception believes you have violated or acted inconsistently with the letter or spirit of these Terms and Conditions.</p>
				<div class="text-center"><a href="/assets/TermsandConditions.pdf" class="btn btn-primary" download><i class="fa fa-arrow-down"></i> Download</a></div>
			</div>
		</div>
	</div>
</div>	
@endsection
