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
		<li><a href="{{ URL::to('terms-of-service') }}" class="active" style="color: #fff;">Terms Of Service</a></li>
		<li><a href="{{ URL::to('privacy-policy') }}">Privacy Policy</a></li>
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
						<h4  class="text-center"><strong>{{ $item->title }}</strong></h4>
						{!! $item->description !!}
					</div>
				@endforeach
				<!-- <h4  class="text-center"><strong>TERMS OF SERVICE AGREEMENT</strong></h4><br/>
				<p>PLEASE READ THIS TERMS OF SERVICE AGREEMENT CAREFULLY. BY USING THIS WEBSITE OR ORDERING PRODUCTS/SERVICES FROM THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.</p>

				<p>This Terms of Service Agreement (the "Agreement") governs your use of this website,<strong> admissionx.com</strong> (the "Website"), AdmissionX ("Business Name") offer of products or services for purchase on this Website, or your purchase of products or services available on this Website. This Agreement includes, and incorporates by this reference, the policies and guidelines referenced below. AdmissionX reserves the right to change or revise the terms and conditions of this Agreement at any time by posting any changes or a revised Agreement on this Website. AdmissionX will alert you that changes or revisions have been made by indicating on the top of this Agreement the date it was last revised. The changed or revised Agreement will be effective immediately after it is posted on this Website. Your use of the Website following the posting any such changes or of a revised Agreement will constitute your acceptance of any such changes or revisions. AdmissionX encourages you to review this Agreement whenever you visit the Website to make sure that you understand the terms and conditions governing the use of the Website. This Agreement does not alter in any way the terms or conditions of any other written agreement you may have with AdmissionX for other products or services. If you do not agree to this Agreement (including any referenced policies or guidelines), please immediately terminate your use of the Website.</p><br />

				<h4><strong>I. PRODUCTS</strong></h4><br />
				<p><strong>Terms of Offer: </strong> This Website offers for sale certain products and services (the "Products & Services"). By placing an order for Products & Services through this Website, you agree to the terms set forth in this Agreement.</p>

				<p><strong>Customer Solicitation: </strong>Unless you notify our third party call center reps or AdmissionX sales reps, while they are calling you, of your desire to opt out from further direct company communications and solicitations, you are agreeing to continue to receive further emails and call solicitations AdmissionX and its designated in-house or third party call team(s).</p>

				<p><strong>Opt Out Procedure: </strong> We provide 2 easy ways to opt out of from future</p>
				<ol>
					<li>You may use the opt-out link found in any email solicitation that you may receive.</li>
					<li>You may also choose to opt out, via sending your email address to <a href="mailto:unsubscribe@admissionx.com">unsubscribe@admissionx.com</a></li>
				</ol><br />

				<p><strong>Proprietary Rights: </strong> AdmissionX has proprietary rights and trade secrets in the Products. You may not copy, reproduce, resell or redistribute any Product manufactured and/or distributed by AdmissionX. AdmissionX also has rights to all trademarks and trade dress and specific layouts of this web page, including calls to action, text placement, images and other information.</p>

				<p><strong>GST: </strong> If you purchase any Products & Services, you will be responsible for paying any applicable GST.</p><br/>

				<h4><strong>II. WEBSITE</strong></h4> <br/>
				<p>Content; Intellectual Property; Third Party Links. In addition to making Products & Services available, this Website also offers information and marketing materials. This Website also offers information, both directly and through indirect links to third-party websites, about educational institutions and admission registration. AdmissionX does not always create the information offered on this Website; instead, the information is often gathered from other sources. To the extent that AdmissionX does create the content on this Website, such content is protected by intellectual property laws of the India, foreign nations, and international bodies. Unauthorized use of the Material may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content on this Website is for personal, non-commercial use. Any links to third-party websites are provided solely as a convenience to you. AdmissionX does not endorse the contents on any such third-party websites. AdmissionX is not responsible for the content of or any damage that may result from your access to or reliance on these third-party websites. If you link to third-party websites, you do so at your own risk. We use our best endeavors to ensure that the websites we select for inclusion in www.admissionx.com work, continue to work properly; that their content remains acceptable and useful; and that their operation will not be injurious to our users.</p><br/>

				<p>We explicitly disclaim, and will not accept any responsibility for any of the following in respect of the sites that we link to:</p>

				<ul>
					<li>Infection by computer viruses</li>
					<li>Damage caused by downloaded software</li>
					<li>Praesentium voluptatum deleniti atque corrupti quos</li>
					<li>Technical problems, failures and speed of operation</li>
					<li>Libelous or illegal material</li>
					<li>The quality or truth of any material, or advice that is offered</li>
				</ul>

				<p><strong>Use of Website;</strong>  AdmissionX is not responsible for any damages resulting from the use of this website by anyone. You will not use the Website for illegal purposes. You will (1) abide by all applicable local, state, national, and international laws and regulations in your use of the Website (including laws regarding intellectual property), (2) not interfere with or disrupt the use and enjoyment of the Website by other users, (3) not resell material on the Website, (4) not engage, directly or indirectly, in transmission of "spam", chain letters, junk mail or any other type of unsolicited communication, and (5) not defame, harass, abuse, or disrupt other users of the Website</p><br />

				<p><strong>License: </strong>  By using this Website, you are granted a limited, non-exclusive, non-transferable right to use the content and materials on the Website in connection with your normal, non-commercial, use of the Website. You may not copy, reproduce, transmit, distribute, or create derivative works of such content or information without express written authorization from AdmissionX or the applicable third party (if third party content is at issue).</p>

				<p><strong>Registration. </strong> On registration you agree to:</p>
				<ol>
					<li>Make your contact details available to Admissionx.com & its partners, you may be contacted by Admissionx.com & its partners for educational information through email, telephone and SMS.</li>
					<li>Receive promotional emails/special offers from Admissionx.com or any of its partner websites.</li>
				</ol><br />

				<p><strong>Posting. </strong>  By posting, storing, or transmitting any content on the Website, you hereby grant AdmissionX a perpetual, worldwide, non-exclusive, royalty-free, assignable, right and license to use, copy, display, perform, create derivative works from, distribute, have distributed, transmit and assign such content in any form, in all media now known or hereinafter created, anywhere in the world. AdmissionX does not have the ability to control the nature of the user-generated content offered through the Website. You are solely responsible for your interactions with other users of the Website and any content you post. AdmissionX is not liable for any damage or harm resulting from any posts by or interactions between users. AdmissionX reserves the right, but has no obligation, to monitor interactions between users of the Website and to remove any content AdmissionX deems objectionable.</p>

				<p><strong>Disclaimer of online availability, impressions, and click-throughs:</strong> in addition to the other disclaimers and limitations discussed in this notice, there are no guarantees and no warranties regarding online availability, impressions, and click-through of www.admissionx.com its web pages, and any material, information, links, or content presented on the web pages at admissionx.com, its web pages, and any material, information, links, or content presented on the web pages at www.admissionx.com, may be unavailable for online access at anytime. Advertising sponsors and advertising must be approved by Yuvi Aviation (Pvt) Ltd before the posting of any advertising material, information, links, content, banners, and graphics on www.admissionx.com. Any advertising should be related to interactive digital television and related subject areas. Yuvi Aviation (Pvt) Ltd reserves the right to accept or to reject any advertising sponsor or any advertising for any reason.</p><br/>

				<h4><strong>III. DISCLAIMER OF WARRANTIES</strong></h4><br/>
				<p>Yuvi Aviation (Pvt) Ltd expressly disclaims warranties of any kind for any use of or any access to <a href="www.admissionx.com">www.admissionx.com</a>, to any material, information, links, or content presented on the web pages at www.admissionx.com, to any external website linked thereto, and to any external material, information, links, or content linked thereto admissionx.com. and any material, information, links, and content presented on the web pages at www.admissionx.com, as well as any external website and any external material, information, links, and content linked thereto, are provided on an "as is" basis, without warranty of any kind, either express or implied, including, without limitation, the implied warranties of merchantability or fitness for a particular purpose, or non-infringement.</p><br/>
				<p>Yuvi Aviation (Pvt) Ltd has no control over any external website or over any external material, information, links, and content linked to www.admissionx.com Certain jurisdictions do not permit the exclusion of implied warranties and the foregoing exclusions of implied warranties may not apply to you. Admissionx.com and its internal web pages may be unavailable for online access from time to time and at any time; there are no guarantees and no warranties of online availability, impressions, and click-throughs. The entire risk as to the performance of, or non-performance of, or arising out of the use of, or the access of, or the lack of access to www.admissionx.com, to any material, information, links, or content presented on the web pages at www.admissionx.com, to any external website linked thereto, or to any external material, information, links, or content linked thereto, is borne by the user, visitor, customer, or other person.</p><br/>
				<p>Some jurisdictions do not allow the exclusion of certain warranties, so some of the above exclusions may not apply to you.</p><br/>

				<h4><strong>IV. CONTENT AND LIABILITY DISCLAIMER</strong></h4>
				<p>admissionx.com is an intermediary as defined under sub-clause (w) of Section 2 of the Information Technology Act, 2000.</p><br/>
				<p>Yuvi Aviation (Pvt) Ltd shall not be responsible for any errors or omissions contained on any Yuvi Aviation (Pvt) Ltd website and reserve the right to make changes without notice. Mention of not-Yuvi Aviation (Pvt) Ltd products or services is provided for informational purposes only and constitutes neither an endorsement nor a recommendation by Yuvi Aviation (Pvt) Ltd and third-party information Yuvi Aviation (Pvt) Ltd provided on any Yuvi Aviation (Pvt) Ltd website is provided on an "as is" basis. The information contained in this website is for general information purposes only. While we endeavor to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p><br/>
				<p>Views expressed by the users are their own; Yuvi Aviation (Pvt) Ltd does not endorse the same. No claim as to the accuracy and correctness of the information on the site is made although every attempt is made to ensure that the content is not misleading. In case any inaccuracy is or otherwise improper content is sighted on the website, please report it.</p><br/>
				<p>Yuvi Aviation (Pvt) Ltd disclaims all warranties, expressed or implied, with regard to any information (including any software, products, or services) provided by any Yuvi Aviation (Pvt) Ltd website, including the implied warranties of merchantability and fitness for a particular purpose, and non-infringement.</p><br/>

				<p>Use of this Website is at your own risk, and the Yuvi Aviation (Pvt) Ltd will not be held liable for any errors or omissions contained in this Website. In no event, shall the Yuvi Aviation(Pvt) Ltd be liable for any special, indirect or consequential damages, or any damages whatsoever resulting from loss of use, data or profits whether contract, negligence or any tort action arising out of, or in connection with, the use or performance of the information available from <a href="https://www.admissionx.com">www.admissionx.com</a></p>

				<p>Through this website, you are able to link to other websites which are not under the control of <strong>AdmissionX.</strong> We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>

				<p>Every effort is made to keep the website up and running smoothly. However,<strong> AdmissionX</strong> takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</p><br/>

				<h4><strong>V. LIMITATION OF LIABILITY</strong></h4><br />
				<p>AdmissionX Entire liability, and your exclusive remedy, in law, in equity, or otherwise, with respect to the website content and products and/or for any breach of this Agreement is solely limited to the amount you paid, less shipping and handling, for products & services purchased via the website.</p><br/>
				<p>AdmissionX will not be liable for any direct, indirect, incidental, special or consequential damages in connection with this agreement or the products / services in any manner, including liabilities resulting from (1) the use of or any access to or the inability to access or use the website, including any material, information, links, and content accessed through this website or through any linked external website or products/services; (2) the cost of procuring substitute products/services or content; (3) any products/services purchased or obtained or transactions entered into through the website; or (4) any lost profits you allege.</p><br/>
				<p>Some jurisdictions do not allow the limitation or exclusion of liability for incidental or consequential damages so some of the above limitations may not apply to you.</p>

				<h4><strong>VI. INDEMNIFICATION</strong></h4><br/>
				<p>You will release, indemnify, defend and hold harmless AdmissionX, and any of its contractors, agents, employees, officers, directors, shareholders, affiliates and assigns from all liabilities, claims, damages, costs and expenses, including reasonable attorneys' fees and expenses, of third parties relating to or arising out of (1) this Agreement or the breach of your warranties, representations and obligations under this Agreement; (2) the Website content or your use of the Website content; (3) the Products or your use of the Products (including Trial Products); (4) any intellectual property or other proprietary right of any person or entity; (5) your violation of any provision of this Agreement; or (6) any information or data you supplied to AdmissionX. When AdmissionX is threatened with suit or sued by a third party, AdmissionX may seek written assurances from you concerning your promise to indemnify AdmissionX; your failure to provide such assurances may be considered by AdmissionX to be a material breach of this Agreement. AdmissionX will have the right to participate in any defence by you of a third-party claim related to your use of any of the Website content or Products, with counsel of AdmissionX choice at its expense. AdmissionX will reasonably cooperate in any defence by you of a third-party claim at your request and expense. You will have sole responsibility to defend AdmissionX against any claim, but you must receive AdmissionX prior written consent regarding any related settlement. The terms of this provision will survive any termination or cancellation of this Agreement or your use of the Website or Products.</p><br/>

				<h4><strong>VII. PRIVACY</strong></h4><br/>
				<p>AdmissionX believes strongly in protecting user privacy and providing you with notice of AdmissionX's use of data. Please refer to AdmissionX privacy policy, incorporated by reference herein, which is posted on the Website.</p><br/>

				<h4><strong>VIII. AGREEMENT TO BE BOUND</strong></h4><br />
				<p>By using this Website or ordering Products & Services, you acknowledge that you have read and agree to be bound by this Agreement and all terms and conditions on this Website.</p><br />

				<h4><strong>IX. GENERAL</strong></h4><br />
				<p><strong>Force Majeure. </strong> AdmissionX will not be deemed in default hereunder or held responsible 
					for any cessation, interruption or delay in the performance of its obligations hereunder due to earthquake, flood, fire, storm, natural disaster, act of God, war, terrorism, armed conflict, labor strike, lockout, or boycott.</p>

				<p><strong>Cessation of Operation.</strong> AdmissionX may at any time, in its sole discretion and without advance notice to you, cease operation of the Website and distribution of the Products & Services.</p>

				<p><strong>Entire Agreement. </strong>This Agreement comprises the entire agreement between you and AdmissionX and supersedes any prior agreements pertaining to the subject matter contained herein.</p>

				<p><strong>Effect of Waiver. </strong> The failure of AdmissionX to exercise or enforce any right or provision of this Agreement will not constitute a waiver of such right or provision. If any provision of this Agreement is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties' intentions as reflected in the provision, and the other provisions of this Agreement remain in full force and effect.</p>

				<p><strong>Governing Law Jurisdiction. </strong> This Website originates from New Delhi, Delhi. This Agreement will be governed by the laws of the State of Delhi without regard to its conflict of law principles to the contrary. Neither you nor AdmissionX will commence or prosecute any suit, proceeding or claim to enforce the provisions of this Agreement, to recover damages for breach of or default of this Agreement, or otherwise arising under or by reason of this Agreement, other than in courts located in State of Delhi. By using this Website or ordering Products & Services, you consent to the jurisdiction and venue of such courts in connection with any action, suit, proceeding or claim arising under or by reason of this Agreement. You hereby waive any right to trial by jury arising out of this Agreement and any related documents.</p>

				<p><strong>Statute of Limitation. </strong>You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or related to use of the Website or Products or this Agreement must be filed within one (1) year after such claim or cause of action arose or be forever barred.</p>


				<p><strong>Waiver of Class Action Rights. </strong> By entering into this agreement, you hereby irrevocably waive any right you may have to join claims with those of other in the form of a class action or similar procedural device. Any claims arising out of, relating to, or connection with this agreement must be asserted individually.</p>

				<p><strong>Termination. </strong> AdmissionX reserves the right to terminate your access to the Website if it reasonably believes, in its sole discretion, that you have breached any of the terms and conditions of this Agreement. Following termination, you will not be permitted to use the Website and AdmissionX may, in its sole discretion and without advance notice to you, cancel any outstanding orders for Products & Services. If your access to the Website is terminated, AdmissionX reserves the right to exercise whatever means it deems necessary to prevent unauthorized access of the Website. This Agreement will survive indefinitely unless and until AdmissionX chooses, in its sole discretion and without advance notice to you, to terminate it.</p>

				<p><strong>Domestic Use – Local Laws. </strong> AdmissionX makes no representation that the Website or Products are appropriate or available for use in locations outside India. Users who access the Website from outside India do so at their own risk and initiative and must bear all responsibility for compliance with any applicable local laws. Unless otherwise explicitly stated, all marketing or promotional materials found on this Website are solely directed to individuals, companies or other entities located in India and comply with the laws prevailing for the time being in force in India. Disputes if any shall be subject to the exclusive jurisdiction of Courts at Delhi.</p>

				<p><strong>Assignment. </strong> You may not assign your rights and obligations under this Agreement to anyone. AdmissionX may assign its rights and obligations under this Agreement in its sole discretion and without advance notice to you.</p>
				<p>By using this website or ordering products from this website you agree to be bound by all of terms and conditions of this agreement.</p> -->
				
			</div><!--/row-fluid-->
		</div><!--/container-->
	</div>
</div>
			
@endsection


