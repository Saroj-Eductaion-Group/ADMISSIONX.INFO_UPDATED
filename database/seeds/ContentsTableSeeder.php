<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('contents')->delete();
        
		\DB::table('contents')->insert(array (
			0 => 
			array (
				'id' => 1,
				'title' => 'About AdmissionX',
				'description' => '<p>AdmissionX is a first of its kind platform based in New Delhi which helps connect students and institutions for the purpose of admission in different courses. Our portal is a repository of reliable data of over 31100 colleges, more than 50200 courses in over 4000 cities. Whether it is a Diploma course in Computing or a Bachelor’s course in Engineering or Masters Course in Management, Science or IT- we have it all. With the help of the provided information, students can get easy access to detailed information on colleges, admission criteria, eligibility, fees, scholarships and latest updates- all at one place.</p>',
				'status' => 1,
				'contentslug' => 'about-admissionx',
				'created_at' => '2020-05-30 08:35:39',
				'updated_at' => '2020-05-30 08:35:39',
				'contentcategory_id' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'title' => 'Our Motto',
				'description' => '<p>We stand for “admission for all” and are developing an online platform where students from all over the country can connect with different institutions and take admission in courses of their choice. We realize that students and institutes both spend a considerable amount of time and money on the admission process.  Our aim is to make this process less time-consuming as well economical for them. We are trying to transform the way students take admission in our country, by making the process of admission as easy as we can.</p>',
				'status' => 1,
				'contentslug' => 'our-motto',
				'created_at' => '2020-05-30 08:35:39',
				'updated_at' => '2020-05-30 08:35:39',
				'contentcategory_id' => 1,
			),
			2 => 
			array (
				'id' => 3,
				'title' => 'Our Vision',
				'description' => '<p>We want every student that leaves school to have access to higher education in an efficient and affordable manner. We are trying to bridge the gap between colleges and students and bringing college admission within the reach of every student.  With an aim to cut down the role of the long admission process, the long line and hustle for the admission in colleges and other marketing channels which lead to high student acquisition cost - we are here trying to making the admission accessible, affordable and incredible!</p>',
				'status' => 1,
				'contentslug' => 'our-vision',
				'created_at' => '2020-05-30 08:35:39',
				'updated_at' => '2020-05-30 08:35:39',
				'contentcategory_id' => 1,
			),
			3 => 
			array (
				'id' => 4,
				'title' => 'Admission Registration Policy',
				'description' => '<li>The admission registration will be deemed void if any details provided by the student are false. It is then the institution’s discretion to accept or reject the application.</li><li>The annual fee for the student for any academic year, during the entire course, will not exceed annual fee amount mentioned in the provisional admission letter.</li><li>If the student fails to report to the institution for document verification and completing the remaining formalities, by the due date, then the provisional admission will be deemed void and any fee paid to AdmissionX shall be forfeited.</li><li>At the time of booking admission online, the student pays Rs. 499 as a part of the annual fee of the institution. The institution agrees to deduct this amount from the 1st year fee chargeable to the student.</li><li>The institution cannot deny admission to any student who is in possession of a valid provisional admission letter issued by AdmissionX. However, the institution has the right to deny admission to any student who appears after the due date.</li><li>The student is NOT entitled to a refund of the amount paid to AdmissionX if they cancel their admission after the generation of the provisional admission letter. However, half the student is entitled to half refund minus transaction charges if he cancels the admission within 3 working days of applying for such admission.</li>',
				'status' => 1,
				'contentslug' => 'admission-registration-policy',
				'created_at' => '2020-05-30 08:36:32',
				'updated_at' => '2020-05-30 08:36:32',
				'contentcategory_id' => 2,
			),
			4 => 
			array (
				'id' => 5,
				'title' => 'Advertiser Agreement',
			'description' => '<p><span style="color: rgb(104, 104, 105); font-family: Calibri; font-size: 14px; text-align: justify; background-color: rgba(255, 255, 255, 0.4);">Content will be updated soon</span><br></p>',
				'status' => 1,
				'contentslug' => 'advertiser-agreement',
				'created_at' => '2020-05-30 08:37:48',
				'updated_at' => '2020-05-30 09:03:53',
				'contentcategory_id' => 3,
			),
			5 => 
			array (
				'id' => 6,
				'title' => 'Cancellation and Return',
				'description' => '<p>Once a student is registered or admitted in an institute/university for admission, cancellation of the admission is not possible under any circumstances. &lt;/li&gt;&lt;li&gt; We strictly follow a ‘No Return Policy’ at admissionx.com<br></p>',
				'status' => 1,
				'contentslug' => 'cancellation-refunds',
				'created_at' => '2020-05-30 08:38:39',
				'updated_at' => '2020-05-30 08:38:39',
				'contentcategory_id' => 4,
			),
			6 => 
			array (
				'id' => 7,
				'title' => 'Refunds',
				'description' => '<li>Customers agree that we follow a ‘No Refund Policy’ at <a href="www.admissionx.com">www.admissionx.com</a>.</li><li> Service providers agree that www.admissionx.com is not responsible for refunding the amount paid for acquiring the enlisting services under the varied packages on the website.</li>
<li>The customer support team of www.admissionx.com should be approached in case of any feedback, complaint or suggestions. The Support Team will take responsibility for resolution of a problem within 15 days.</li>',
				'status' => 1,
				'contentslug' => 'cancellation-refunds',
				'created_at' => '2020-05-30 08:39:18',
				'updated_at' => '2020-05-30 08:39:18',
				'contentcategory_id' => 4,
			),
			7 => 
			array (
				'id' => 8,
				'title' => 'Clauses for the agreement between AdmissionX and colleges',
				'description' => '
<li> At the time of taking admission, the student pays Rs. 499 as a part of the college fees online to AdmissionX website. College agrees to deduct this amount (Rs. 499) from the 1st year fee chargeable to the student.</li>
<li>The annual fee amount for any particular student, for the entire duration of the course, must not exceed the amount mentioned in the provisional admission letter issued by AdmissionX to that particular student.</li>
<li>College cannot deny admission to any particular student (within the deadline period, decided by AdmissionX), once the provisional admission letter has been generated by AdmissionX to that particular student.</li>
',
				'status' => 1,
				'contentslug' => 'college-partner-agreement',
				'created_at' => '2020-05-30 08:53:35',
				'updated_at' => '2020-05-30 08:56:32',
				'contentcategory_id' => 5,
			),
			8 => 
			array (
				'id' => 9,
				'title' => 'Disclaimer',
			'description' => '<p><span style="color: rgb(104, 104, 105); font-family: Calibri; font-size: 14px; text-align: justify; background-color: rgba(255, 255, 255, 0.4);">Content will be updated soon</span><br></p>',
				'status' => 1,
				'contentslug' => 'disclaimer',
				'created_at' => '2020-05-30 09:03:39',
				'updated_at' => '2020-05-30 09:03:39',
				'contentcategory_id' => 7,
			),
			9 => 
			array (
				'id' => 10,
				'title' => 'We Love to hear from you...',
				'description' => '<h4><b>AdmissionX </b>is here to provide you with more information, answer any questions you may have and create an effective solution for your instructional needs.
</h4>',
				'status' => 1,
				'contentslug' => 'contact-us',
				'created_at' => '2020-05-30 09:06:26',
				'updated_at' => '2020-05-30 09:07:24',
				'contentcategory_id' => 6,
			),
			10 => 
			array (
				'id' => 11,
				'title' => 'Refunds',
				'description' => '<p>Customers agree that we follow a ‘No Refund Policy’ at www.admissionx.com Service providers agree that www.admissionx.com is not responsible for refunding the amount paid for acquiring the enlisting services under the varied packages on the website. The customer support team of www.admissionx.com should be approached in case of any feedback, complaint or suggestions. The Support Team will take responsibility for resolution of a problem within 15 days.</p><div><br></div>',
				'status' => 1,
				'contentslug' => 'payments-terms-of-service',
				'created_at' => '2020-05-30 09:10:25',
				'updated_at' => '2020-05-30 09:10:25',
				'contentcategory_id' => 9,
			),
			11 => 
			array (
				'id' => 12,
				'title' => 'Policies',
				'description' => 'Content will be updated soon',
				'status' => 1,
				'contentslug' => 'policies',
				'created_at' => '2020-05-30 09:15:16',
				'updated_at' => '2020-05-30 09:15:41',
				'contentcategory_id' => 10,
			),
			12 => 
			array (
				'id' => 13,
				'title' => 'Press',
			'description' => '<p><span style="color: rgb(103, 106, 108);">Content will be updated soon</span><br></p>',
				'status' => 1,
				'contentslug' => 'press',
				'created_at' => '2020-05-30 09:18:00',
				'updated_at' => '2020-05-30 09:18:18',
				'contentcategory_id' => 11,
			),
			13 => 
			array (
				'id' => 14,
				'title' => 'This Privacy Policy applies to admissionx.com',
				'description' => '<p>	AdmissionX recognises the importance of maintaining your privacy. We value your privacy and appreciate your trust in us. This Policy describes how we treat user information we collect on 
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

<p><strong>Other information. </strong> If you use our website, we may collect information about your IP address and the browser you\'re using. We might look at what site you came from, duration of time spent on our website, pages accessed or what site you visit when you leave us. We might also collect the type of mobile device you are using, or the version of the operating system your computer or device is running.
</p><br>

<h4><strong>We collect information in different ways.</strong></h4><br>

<p><strong>We collect information directly from you:</strong> We collect information directly from you when you register on the website or book admission. We also collect information if you post comments on our websites or ask us a question through phone or email.

</p>

<p><strong>We collect information from you passively. </strong> We use tracking tools like Google Analytics, Google Webmaster, browser cookies and web beacons for collecting information about your usage of our website.
</p>

<p><strong>We get information about you from third parties. </strong>For example, if you use an integrated social media feature on our websites. The third-party social media site will give us certain information about you. This could include your name and email address.
</p><br>

<h4><strong>Use of your personal information</strong></h4><br>
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

<p>We use information as otherwise permitted by law.</p><br>

<h4><strong>Sharing of information with third-parties</strong></h4><br>

<p><strong>We will share information with third parties who perform services on our behalf.</strong> We share information with vendors who help us manage our online registration process or payment processors or transactional message processors. Some vendors may be located outside of India.</p>

<p><strong>We will share information with the education institutions and service providers.</strong> We share your information with education institutions and other parties responsible for fulfilling the purchase obligation. The education institutions and other parties may use the information we give them as described in their privacy policies.</p>

<p><strong>We will share information with our business partners.</strong> Our partners use the information we give them as described in their privacy policies.</p>

<p><strong>We may share information if we think we have to in order to comply with the law or to protect ourselves.</strong> We will share information to respond to a court order or subpoena. We may also share it if a government agency or investigatory body requests. Or, we might also share information when we are investigating potential fraud.</p>

<p><strong>We may share information with any successor to all or part of our business.</strong> For example, if part of our business is sold we may give our customer list as part of that transaction.</p>

<p><strong>We may share your information for reasons not described in this policy.</strong> We will tell you before we do this.</p><br>

<h5><strong>Email Opt-Out</strong></h5>
<p><strong>You can opt out of receiving our marketing emails.</strong> To stop receiving our promotional emails, please email at <a href="mailto:unsubscribe@admissionx.com">unsubscribe@admissionx.com</a> It may take about ten days to process your request. Even if you opt out of getting marketing messages, we will still be sending you transactional messages through email and SMS about your purchases.</p><br>

<h5><strong>Third party sites</strong></h5>
<p>If you click on one of the links to third party websites, you may be taken to websites we do not control. This policy does not apply to the privacy practices of those websites. Read the privacy policy of other websites carefully. We are not responsible for these third-party sites.
</p><br>

<h5><strong>Updates to this policy</strong></h5>
<p>This Privacy Policy was last updated on 04/07/2017. From time to time we may change our privacy practices. We will notify you of any material changes to this policy as required by law. We will also post an updated copy on our website. Please check our site periodically for updates.</p><br>

<h5><strong>Jurisdiction</strong></h5>
<p>If you choose to visit the website, your visit and any dispute over privacy are subject to this Policy and the website\'s terms of use. In addition to the foregoing, any disputes arising under this Policy shall be governed by the laws of India.</p>

<p>If you have any questions about this Policy or other privacy concerns, you can also email us at <a href="mailto:support@admissionx.info">support@admissionx.info</a></p><br>',
				'status' => 1,
				'contentslug' => 'privacy-policy',
				'created_at' => '2020-05-30 09:19:58',
				'updated_at' => '2020-05-30 09:19:58',
				'contentcategory_id' => 12,
			),
			14 => 
			array (
				'id' => 15,
				'title' => 'Student Referral Policy',
				'description' => '<p>content will be updated soon<br></p>',
				'status' => 1,
				'contentslug' => 'student-referral-policy',
				'created_at' => '2020-05-30 09:24:00',
				'updated_at' => '2020-05-30 09:24:00',
				'contentcategory_id' => 13,
			),
			15 => 
			array (
				'id' => 16,
				'title' => 'TERMS OF SERVICE AGREEMENT',
				'description' => '<p>PLEASE READ THIS TERMS OF SERVICE AGREEMENT CAREFULLY. BY USING THIS WEBSITE OR ORDERING PRODUCTS/SERVICES FROM THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.</p>

<p>This Terms of Service Agreement (the "Agreement") governs your use of this website,<strong> admissionx.com</strong> (the "Website"), AdmissionX ("Business Name") offer of products or services for purchase on this Website, or your purchase of products or services available on this Website. This Agreement includes, and incorporates by this reference, the policies and guidelines referenced below. AdmissionX reserves the right to change or revise the terms and conditions of this Agreement at any time by posting any changes or a revised Agreement on this Website. AdmissionX will alert you that changes or revisions have been made by indicating on the top of this Agreement the date it was last revised. The changed or revised Agreement will be effective immediately after it is posted on this Website. Your use of the Website following the posting any such changes or of a revised Agreement will constitute your acceptance of any such changes or revisions. AdmissionX encourages you to review this Agreement whenever you visit the Website to make sure that you understand the terms and conditions governing the use of the Website. This Agreement does not alter in any way the terms or conditions of any other written agreement you may have with AdmissionX for other products or services. If you do not agree to this Agreement (including any referenced policies or guidelines), please immediately terminate your use of the Website.</p><br>

<h4><strong>I. PRODUCTS</strong></h4><br>
<p><strong>Terms of Offer: </strong> This Website offers for sale certain products and services (the "Products &amp; Services"). By placing an order for Products &amp; Services through this Website, you agree to the terms set forth in this Agreement.</p>

<p><strong>Customer Solicitation: </strong>Unless you notify our third party call center reps or AdmissionX sales reps, while they are calling you, of your desire to opt out from further direct company communications and solicitations, you are agreeing to continue to receive further emails and call solicitations AdmissionX and its designated in-house or third party call team(s).</p>

<p><strong>Opt Out Procedure:&nbsp;</strong> We provide 2 easy ways to opt out of from future</p>
<ol>
<li>You may use the opt-out link found in any email solicitation that you may receive.</li>
<li>You may also choose to opt out, via sending your email address to <a href="mailto:unsubscribe@admissionx.com">unsubscribe@admissionx.com</a></li>
</ol><br>

<p><strong>Proprietary Rights: </strong> AdmissionX has proprietary rights and trade secrets in the Products. You may not copy, reproduce, resell or redistribute any Product manufactured and/or distributed by AdmissionX. AdmissionX also has rights to all trademarks and trade dress and specific layouts of this web page, including calls to action, text placement, images and other information.</p>

<p><strong>GST: </strong> If you purchase any Products &amp; Services, you will be responsible for paying any applicable GST.</p><br>

<h4><strong>II. WEBSITE</strong></h4> <br>
<p>Content; Intellectual Property; Third Party Links. In addition to making Products &amp; Services available, this Website also offers information and marketing materials. This Website also offers information, both directly and through indirect links to third-party websites, about educational institutions and admission registration. AdmissionX does not always create the information offered on this Website; instead, the information is often gathered from other sources. To the extent that AdmissionX does create the content on this Website, such content is protected by intellectual property laws of the India, foreign nations, and international bodies. Unauthorized use of the Material may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content on this Website is for personal, non-commercial use. Any links to third-party websites are provided solely as a convenience to you. AdmissionX does not endorse the contents on any such third-party websites. AdmissionX is not responsible for the content of or any damage that may result from your access to or reliance on these third-party websites. If you link to third-party websites, you do so at your own risk. We use our best endeavors to ensure that the websites we select for inclusion in www.admissionx.com work, continue to work properly; that their content remains acceptable and useful; and that their operation will not be injurious to our users.</p><br>

<p>We explicitly disclaim, and will not accept any responsibility for any of the following in respect of the sites that we link to:</p>

<ul>
<li>Infection by computer viruses</li>
<li>Damage caused by downloaded software</li>
<li>Praesentium voluptatum deleniti atque corrupti quos</li>
<li>Technical problems, failures and speed of operation</li>
<li>Libelous or illegal material</li>
<li>The quality or truth of any material, or advice that is offered</li>
</ul>

<p><strong>Use of Website;</strong>  AdmissionX is not responsible for any damages resulting from the use of this website by anyone. You will not use the Website for illegal purposes. You will (1) abide by all applicable local, state, national, and international laws and regulations in your use of the Website (including laws regarding intellectual property), (2) not interfere with or disrupt the use and enjoyment of the Website by other users, (3) not resell material on the Website, (4) not engage, directly or indirectly, in transmission of "spam", chain letters, junk mail or any other type of unsolicited communication, and (5) not defame, harass, abuse, or disrupt other users of the Website</p><br>

<p><strong>License: </strong>  By using this Website, you are granted a limited, non-exclusive, non-transferable right to use the content and materials on the Website in connection with your normal, non-commercial, use of the Website. You may not copy, reproduce, transmit, distribute, or create derivative works of such content or information without express written authorization from AdmissionX or the applicable third party (if third party content is at issue).</p>

<p><strong>Registration. </strong> On registration you agree to:</p>
<ol>
<li>Make your contact details available to Admissionx.com &amp; its partners, you may be contacted by Admissionx.com &amp; its partners for educational information through email, telephone and SMS.</li>
<li>Receive promotional emails/special offers from Admissionx.com or any of its partner websites.</li>
</ol><br>

<p><strong>Posting. </strong>  By posting, storing, or transmitting any content on the Website, you hereby grant AdmissionX a perpetual, worldwide, non-exclusive, royalty-free, assignable, right and license to use, copy, display, perform, create derivative works from, distribute, have distributed, transmit and assign such content in any form, in all media now known or hereinafter created, anywhere in the world. AdmissionX does not have the ability to control the nature of the user-generated content offered through the Website. You are solely responsible for your interactions with other users of the Website and any content you post. AdmissionX is not liable for any damage or harm resulting from any posts by or interactions between users. AdmissionX reserves the right, but has no obligation, to monitor interactions between users of the Website and to remove any content AdmissionX deems objectionable.</p>

<p><strong>Disclaimer of online availability, impressions, and click-throughs:</strong> in addition to the other disclaimers and limitations discussed in this notice, there are no guarantees and no warranties regarding online availability, impressions, and click-through of www.admissionx.com its web pages, and any material, information, links, or content presented on the web pages at admissionx.com, its web pages, and any material, information, links, or content presented on the web pages at www.admissionx.com, may be unavailable for online access at anytime. Advertising sponsors and advertising must be approved by Yuvi Aviation (Pvt) Ltd before the posting of any advertising material, information, links, content, banners, and graphics on www.admissionx.com. Any advertising should be related to interactive digital television and related subject areas. Yuvi Aviation (Pvt) Ltd reserves the right to accept or to reject any advertising sponsor or any advertising for any reason.</p><br>

<h4><strong>III. DISCLAIMER OF WARRANTIES</strong></h4><br>
<p>Yuvi Aviation (Pvt) Ltd expressly disclaims warranties of any kind for any use of or any access to <a href="www.admissionx.com">www.admissionx.com</a>, to any material, information, links, or content presented on the web pages at www.admissionx.com, to any external website linked thereto, and to any external material, information, links, or content linked thereto admissionx.com. and any material, information, links, and content presented on the web pages at www.admissionx.com, as well as any external website and any external material, information, links, and content linked thereto, are provided on an "as is" basis, without warranty of any kind, either express or implied, including, without limitation, the implied warranties of merchantability or fitness for a particular purpose, or non-infringement.</p><br>
<p>Yuvi Aviation (Pvt) Ltd has no control over any external website or over any external material, information, links, and content linked to www.admissionx.com Certain jurisdictions do not permit the exclusion of implied warranties and the foregoing exclusions of implied warranties may not apply to you. Admissionx.com and its internal web pages may be unavailable for online access from time to time and at any time; there are no guarantees and no warranties of online availability, impressions, and click-throughs. The entire risk as to the performance of, or non-performance of, or arising out of the use of, or the access of, or the lack of access to www.admissionx.com, to any material, information, links, or content presented on the web pages at www.admissionx.com, to any external website linked thereto, or to any external material, information, links, or content linked thereto, is borne by the user, visitor, customer, or other person.</p><br>
<p>Some jurisdictions do not allow the exclusion of certain warranties, so some of the above exclusions may not apply to you.</p><br>

<h4><strong>IV. CONTENT AND LIABILITY DISCLAIMER</strong></h4>
<p>admissionx.com is an intermediary as defined under sub-clause (w) of Section 2 of the Information Technology Act, 2000.</p><br>
<p>Yuvi Aviation (Pvt) Ltd shall not be responsible for any errors or omissions contained on any Yuvi Aviation (Pvt) Ltd website and reserve the right to make changes without notice. Mention of not-Yuvi Aviation (Pvt) Ltd products or services is provided for informational purposes only and constitutes neither an endorsement nor a recommendation by Yuvi Aviation (Pvt) Ltd and third-party information Yuvi Aviation (Pvt) Ltd provided on any Yuvi Aviation (Pvt) Ltd website is provided on an "as is" basis. The information contained in this website is for general information purposes only. While we endeavor to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p><br>
<p>Views expressed by the users are their own; Yuvi Aviation (Pvt) Ltd does not endorse the same. No claim as to the accuracy and correctness of the information on the site is made although every attempt is made to ensure that the content is not misleading. In case any inaccuracy is or otherwise improper content is sighted on the website, please report it.</p><br>
<p>Yuvi Aviation (Pvt) Ltd disclaims all warranties, expressed or implied, with regard to any information (including any software, products, or services) provided by any Yuvi Aviation (Pvt) Ltd website, including the implied warranties of merchantability and fitness for a particular purpose, and non-infringement.</p><br>

<p>Use of this Website is at your own risk, and the Yuvi Aviation (Pvt) Ltd will not be held liable for any errors or omissions contained in this Website. In no event, shall the Yuvi Aviation(Pvt) Ltd be liable for any special, indirect or consequential damages, or any damages whatsoever resulting from loss of use, data or profits whether contract, negligence or any tort action arising out of, or in connection with, the use or performance of the information available from <a href="https://www.admissionx.com">www.admissionx.com</a></p>

<p>Through this website, you are able to link to other websites which are not under the control of <strong>AdmissionX.</strong> We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>

<p>Every effort is made to keep the website up and running smoothly. However,<strong> AdmissionX</strong> takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</p><br>

<h4><strong>V. LIMITATION OF LIABILITY</strong></h4><br>
<p>AdmissionX Entire liability, and your exclusive remedy, in law, in equity, or otherwise, with respect to the website content and products and/or for any breach of this Agreement is solely limited to the amount you paid, less shipping and handling, for products &amp; services purchased via the website.</p><br>
<p>AdmissionX will not be liable for any direct, indirect, incidental, special or consequential damages in connection with this agreement or the products / services in any manner, including liabilities resulting from (1) the use of or any access to or the inability to access or use the website, including any material, information, links, and content accessed through this website or through any linked external website or products/services; (2) the cost of procuring substitute products/services or content; (3) any products/services purchased or obtained or transactions entered into through the website; or (4) any lost profits you allege.</p><br>
<p>Some jurisdictions do not allow the limitation or exclusion of liability for incidental or consequential damages so some of the above limitations may not apply to you.</p>

<h4><strong>VI. INDEMNIFICATION</strong></h4><br>
<p>You will release, indemnify, defend and hold harmless AdmissionX, and any of its contractors, agents, employees, officers, directors, shareholders, affiliates and assigns from all liabilities, claims, damages, costs and expenses, including reasonable attorneys\' fees and expenses, of third parties relating to or arising out of (1) this Agreement or the breach of your warranties, representations and obligations under this Agreement; (2) the Website content or your use of the Website content; (3) the Products or your use of the Products (including Trial Products); (4) any intellectual property or other proprietary right of any person or entity; (5) your violation of any provision of this Agreement; or (6) any information or data you supplied to AdmissionX. When AdmissionX is threatened with suit or sued by a third party, AdmissionX may seek written assurances from you concerning your promise to indemnify AdmissionX; your failure to provide such assurances may be considered by AdmissionX to be a material breach of this Agreement. AdmissionX will have the right to participate in any defence by you of a third-party claim related to your use of any of the Website content or Products, with counsel of AdmissionX choice at its expense. AdmissionX will reasonably cooperate in any defence by you of a third-party claim at your request and expense. You will have sole responsibility to defend AdmissionX against any claim, but you must receive AdmissionX prior written consent regarding any related settlement. The terms of this provision will survive any termination or cancellation of this Agreement or your use of the Website or Products.</p><br>

<h4><strong>VII. PRIVACY</strong></h4><br>
<p>AdmissionX believes strongly in protecting user privacy and providing you with notice of AdmissionX\'s use of data. Please refer to AdmissionX privacy policy, incorporated by reference herein, which is posted on the Website.</p><br>

<h4><strong>VIII. AGREEMENT TO BE BOUND</strong></h4><br>
<p>By using this Website or ordering Products &amp; Services, you acknowledge that you have read and agree to be bound by this Agreement and all terms and conditions on this Website.</p><br>

<h4><strong>IX. GENERAL</strong></h4><br>
<p><strong>Force Majeure. </strong> AdmissionX will not be deemed in default hereunder or held responsible 
for any cessation, interruption or delay in the performance of its obligations hereunder due to earthquake, flood, fire, storm, natural disaster, act of God, war, terrorism, armed conflict, labor strike, lockout, or boycott.</p>

<p><strong>Cessation of Operation.</strong> AdmissionX may at any time, in its sole discretion and without advance notice to you, cease operation of the Website and distribution of the Products &amp; Services.</p>

<p><strong>Entire Agreement. </strong>This Agreement comprises the entire agreement between you and AdmissionX and supersedes any prior agreements pertaining to the subject matter contained herein.</p>

<p><strong>Effect of Waiver. </strong> The failure of AdmissionX to exercise or enforce any right or provision of this Agreement will not constitute a waiver of such right or provision. If any provision of this Agreement is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties\' intentions as reflected in the provision, and the other provisions of this Agreement remain in full force and effect.</p>

<p><strong>Governing Law Jurisdiction. </strong> This Website originates from New Delhi, Delhi. This Agreement will be governed by the laws of the State of Delhi without regard to its conflict of law principles to the contrary. Neither you nor AdmissionX will commence or prosecute any suit, proceeding or claim to enforce the provisions of this Agreement, to recover damages for breach of or default of this Agreement, or otherwise arising under or by reason of this Agreement, other than in courts located in State of Delhi. By using this Website or ordering Products &amp; Services, you consent to the jurisdiction and venue of such courts in connection with any action, suit, proceeding or claim arising under or by reason of this Agreement. You hereby waive any right to trial by jury arising out of this Agreement and any related documents.</p>

<p><strong>Statute of Limitation. </strong>You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or related to use of the Website or Products or this Agreement must be filed within one (1) year after such claim or cause of action arose or be forever barred.</p>


<p><strong>Waiver of Class Action Rights. </strong> By entering into this agreement, you hereby irrevocably waive any right you may have to join claims with those of other in the form of a class action or similar procedural device. Any claims arising out of, relating to, or connection with this agreement must be asserted individually.</p>

<p><strong>Termination. </strong> AdmissionX reserves the right to terminate your access to the Website if it reasonably believes, in its sole discretion, that you have breached any of the terms and conditions of this Agreement. Following termination, you will not be permitted to use the Website and AdmissionX may, in its sole discretion and without advance notice to you, cancel any outstanding orders for Products &amp; Services. If your access to the Website is terminated, AdmissionX reserves the right to exercise whatever means it deems necessary to prevent unauthorized access of the Website. This Agreement will survive indefinitely unless and until AdmissionX chooses, in its sole discretion and without advance notice to you, to terminate it.</p>

<p><strong>Domestic Use – Local Laws. </strong> AdmissionX makes no representation that the Website or Products are appropriate or available for use in locations outside India. Users who access the Website from outside India do so at their own risk and initiative and must bear all responsibility for compliance with any applicable local laws. Unless otherwise explicitly stated, all marketing or promotional materials found on this Website are solely directed to individuals, companies or other entities located in India and comply with the laws prevailing for the time being in force in India. Disputes if any shall be subject to the exclusive jurisdiction of Courts at Delhi.</p>

<p><strong>Assignment. </strong> You may not assign your rights and obligations under this Agreement to anyone. AdmissionX may assign its rights and obligations under this Agreement in its sole discretion and without advance notice to you.</p>
<p>By using this website or ordering products from this website you agree&nbsp;to be bound by all of terms and conditions of this agreement.</p>',
				'status' => 1,
				'contentslug' => 'terms-of-service',
				'created_at' => '2020-05-30 09:26:03',
				'updated_at' => '2020-05-30 09:26:03',
				'contentcategory_id' => 14,
			),
			16 => 
			array (
				'id' => 17,
				'title' => 'Terms and Privacy',
				'description' => '<p>content will be updated soon<br></p>',
				'status' => 1,
				'contentslug' => 'terms-and-privacy',
				'created_at' => '2020-05-30 09:28:54',
				'updated_at' => '2020-05-30 09:28:54',
				'contentcategory_id' => 15,
			),
			17 => 
			array (
				'id' => 18,
				'title' => 'Terms and Conditions',
				'description' => '<p>content will be updated soon<br></p>',
				'status' => 1,
				'contentslug' => 'terms-and-conditions',
				'created_at' => '2020-05-30 09:39:31',
				'updated_at' => '2020-05-30 09:39:31',
				'contentcategory_id' => 16,
			),
			18 => 
			array (
				'id' => 19,
				'title' => 'Trust and Safety',
				'description' => '<p>content will be updated soon<br></p>',
				'status' => 1,
				'contentslug' => 'trust-and-safety',
				'created_at' => '2020-05-30 09:41:10',
				'updated_at' => '2020-05-30 09:41:10',
				'contentcategory_id' => 17,
			),
			19 => 
			array (
				'id' => 20,
				'title' => 'AFTER 10TH',
				'description' => '<p>Selecting a stream after 10th requires a lot of brainstorming and critical thinking.</p>

<p>To successfully select a stream of your choice follow these steps:</p>
<ul>
<li>Think about the last 12 years of education you have had. Reflect on what you have liked, what subjects interested you, what ignited your passion and what you disliked. Write it down in 5-6 bullet points.</li>
<li>After you have done this consider this question “What stream of the given 3- Science, Commerce, and Humanities suits your likings the best?” If you still don’t get the answer, try this:</li>
<li>Think about the next 5 years, you will be finishing college (or 6 years) and getting placed/going for Masters. What would you like to work on? What makes you feel fulfilled? It could be giving back to society, or creating things, or making art, or just simply business. Find your calling.</li>
</ul> 

<p>Select a stream you think is right for YOU. Not your parents, not your neighbors- but you.
And if you select a stream and realize it isn’t for you- don’t panic. Most schools give you an option to switch streams by submitting applications before a stipulated time.
Here is a brief description of the streams available for a little help:</p><br>
<ul>
<li><strong>Science:</strong> Science is the most chosen stream of all. It offers popular and wholesome courses like Engineering and Medicine. It is also popular because it helps keep your options open, which means you can opt for commerce and arts courses after doing Science as 10+2. (With disadvantage of a few marks, of course.) The main subjects you will study in Science are Physics, Chemistry, and English, and usually are giving a choice between Mathematics, Biology, and Psychology amongst others depending on your school.
</li><br>
<li><strong>Commerce:</strong> Being second most popular stream in the country, it offers some of the highest paying jobs in the world ranging from investment banking, chartered accountant and financial advisors. With the corporate world booming manifold, this stream is picking up the pace with science with many students opting for commerce because of its wide scope in this economy.
</li><br>
<li>
<strong>Humanities/Arts:</strong> Although there is a notion that Humanities is an easy stream for weaker students- it is not. This stream offers some exciting subjects and courses for the students interested in History, Political Science, Literature and Economics.</li><br>
<li>This stream is popular for careers like teaching, journalism, lecturers and social work.</li><br>
<li>Alternatively, if you do not wish to pursue school after 10th, here are some career courses to choose from-</li><br>
<li><strong>Indian Army:</strong> After completing matriculation, students can apply to various posts in the Indian Army by giving examinations like Indian Army Soldier Clerks Examination, Indian Army Soldier Technical Examination. A point to be noted here is that these are not high but Clerical and Technical posts.</li><br>

<li><strong>Police Force:</strong>  On the basis of a physical and written test, one can join as constable in Central Reserve Police Force.
</li><br>
<li><strong>ITIs and ITCs:</strong> Established under Ministry of Labor, Government run Industrial Training Institutes and privately run Industrial Training Centers provide training in a technical field. ITI courses are designed for basic skill development needed for a specified trade like a fitter, plumber, electrician, mechanic, welder amongst others. Depending upon trade, the duration of the course may vary from one to three years. After passing the course one may opt to undergo practical training in his trade. A National Trade Certificate (NTC) in provided by National Council for Vocational Training (NCVT) in the concerned trade and to obtain this certificate one has to qualify the All India Trade Test (AITT).</li>
</ul>',
				'status' => 1,
				'contentslug' => 'counselling',
				'created_at' => '2020-05-30 09:57:28',
				'updated_at' => '2020-05-30 09:57:28',
				'contentcategory_id' => 8,
			),
			20 => 
			array (
				'id' => 21,
				'title' => 'AFTER 12TH',
				'description' => '<p>This is a crucial time in everyone’s life. The decisions you make now make your future. So make sure you take each step carefully, logically and most importantly, to YOUR benefit.</p>
<p>First, reflect on the last two years of your education. 11th and 12th grade decide a lot of things.</p>
<ul>
<li>What stream did you take?</li>
<li>What subjects did you like the most?</li>
<li>How much did you score in each subject?</li>
</ul>
<p>Do an in-depth analysis of you strengths, weaknesses and pressure points.
This will give you a strong insight into what is good for you.
Do an opportunity analysis of your stream by assessing all the course options available for you and find the one that suits you best.
It could be something other than Engineering, CA or Medicine. Don’t go with the crowd. The key here is to find a course that fulfils your purpose, not the other 8.2 million youth of the Country.
</p>
<h4><strong>Here is a list of some of the courses available for you to help start your career/course selection:</strong></h4><br>
<h4>For Science Stream:</h4>
<ul>
<li>Engineering- Mechanical, Aeronautical, Civil, Electrical, Computer, Electronics, Robotics, Chemical, Agricultural, Environmental and Petroleum are just some of the engineering degree courses available after 12th.</li>
<li>B.Sc. Botany, Zoology, Chemistry, B.Sc. Botany, Microbiology, Chemistry, B.Sc. Microbiology, Biotechnology, Chemistry, B.Sc. or B.Tech. in Biotechnology, B.Sc. in Microbiology, B.Sc. Agriculture Science, B.Sc. Marine Biology, B.Sc. Medical Laboratory Technology, B.Sc. in Radiology, B.Sc. in Bioinformatics, B.Sc. Computer Science are some other conventional courses after Science stream.</li>
<li>Medicine- There is a range of medical courses available after 12th, after the science stream (with Biology). MBBS, BAMS (Ayurvedic), BHMS (Homoeopathy), BUMS (Unani), B.Dental Studies, Bachelor of Veterinary Science &amp; Animal Husbandry (B.VSc AH), Bachelor of Naturopathy &amp; Yogic Science (BNYS), Bachelor of Physiotherapy, Integrated M.Sc. and B.Sc. Nursing are some sought-after courses after PCB.</li>
</ul>
<p>Alternatively, students from Science stream can pursue courses from Commerce and Humanities at a slight marks disadvantage.</p>
<p>Also, there are some standard courses available.</p>

<h4><strong>For Commerce Stream:</strong></h4>
<ul>
<li>  B.Com, B.Com (H) - B.Com and B.Com(Hons.) are commerce specialized courses that deal with a wide range of subjects from business/corporate law, accountancy, management and other key business areas. These courses have a wide scope for further study and even specialization.</li>
<li>B.A. (Hons.) Economics- One of the sophisticated courses offered in India. This course offers specialization in the field of Economics. The subjects are a little difficult, compared to B.Com/B.Com (H), but this course opens doors to a number of post-graduate specializations and jobs.</li>
<li>Chartered Accountancy (CA)- The Chartered Accountancy course is a professional study regulated by ICAI (The Institute of Chartered Accountants of India) which deals with Accounting, Law, Economics and other of any business. It has been an upcoming and popular study due to its professional title and availability of opportunities in this field currently. It requires clearing of four levels of exams and completing and articleship of 3 years minimum to become a certified practicing CA.</li>
<li>Company Secretary (CS)- Companies Secretary is a highly reputed and rewarding course that deals with the law, management and governance aspect of an organization to name a few. It is sometimes an above-managerial level position, otherwise, managerial. This profession deals with regulation, security and legal compliances of an organization. It is a specialization that is regulated by ICSI (The Institute of Company Secretaries of India.) and consists of 3 levels and 15 months of training with a practicing CS.</li>
<li>Bachelors of Business Administration. (BBA)- BBA is a 3-year degree programme that provides fundamental knowledge of business and management principles. The study in this course ranges from international business, finance, real estate, computer information systems, to accounting. Many Schools provide practical management training as a part of curriculum making BBA a very sought after option to pursue.</li>
<li>Cost and Management Accountant. (CMA) – Formerly known as Cost and Works Accountant (CWA), CMA is a proficiency in accounting, financial planning, analysis and management decision making. CMAs can specialize in many roles such as staff accountant, cost accountant, corporate accountant, internal auditor, tax accountant, financial analyst or budget analyst.</li>
<li>BBA (LLB) - BBA (LLB) is the study of law that deals with common law aspects such as civil, criminal, procedural and corporate laws but also incorporates business aspect such as Business Ethics, Human resource management and strategic management. This is a very popular course amongst students who want to pursue corporate law in the future. It gives a good insight into business functions as well as the legal aspect of banking, corporate governance, investment, mergers and acquisitions.</li>
</ul>
<p>Enlisted above are some conventional courses for students of Commerce Stream.
Alternatively, Commerce students can apply to Humanities courses. (At a slight marks disadvantage in some cases and colleges.)
</p>

<br>
<h4><strong>For Humanities Stream:</strong></h4>
<ul>
<li>
Bachelor of Arts- Bachelor of Arts (BA) is a broad interdisciplinary undergraduate programme. This degree is offered by many colleges and universities with honors and specializations in subjects like English, History, Political Science, Economics, Journalism, and Psychology to name a few. The prospects after these courses range from a Masters degree to jobs. The possibilities are government jobs, research work, and social work amongst others.
</li>
<li>
Bachelor of Fine Arts-Fine Arts is an art form which is developed mainly for aesthetics rather than practical application. Subjects studied under this degree are drawing, painting, figure drawing, portraiture, watercolour, art-making concept development, and art history critique. Many students opt for this degree to pursue arts as a career or for a further, in-depth study into their skills. Job prospects range from Illustrator, Visual artist, art critic to design trainer. The possibilities are endless.
</li>
<li>Journalism and Mass Communication- Popularly called BJMC (Bachelor or Journalism and Mass Communication), it is an undergraduate Mass Communication course. It is aimed at the development of journalistic skills, media research and development, and foundation in many media technologies like print, radio, television, and internet. BJMC graduates can work in a number of media like print, television, radio. They can also freelance. BJMC is extremely career offering in nature.</li>
<li>Hotel Management- The hotel industry is a crucial part of the hospitality industry with a huge growth potential in the near future. The demand for hotel management professionals is already huge and is expected to grow. The 3-year undergraduate program trains students in multiple skills like food and beverage service, front office operation, sales and marketing, and accounting.</li>

</ul>
<p>For any further queries and doubts, feel free to contact AdmissionX from our <a href="{{ URL::to(\'contact-us\') }}" target="_blank">Contact Us</a> page.
AdmissionX- Making higher education accessible, affordable and incredible!
</p>',
				'status' => 1,
				'contentslug' => 'counselling',
				'created_at' => '2020-05-30 09:58:19',
				'updated_at' => '2020-05-30 10:02:35',
				'contentcategory_id' => 8,
			),
			21 => 
			array (
				'id' => 22,
				'title' => 'AFTER GRADUATION',
				'description' => '<p>
After completing a Bachelors degree, a lot of options are opened. The two main choices in front of you are- to continue education and get a Masters degree or to get a job. While getting a job after graduation is a good idea, sometimes a further study of your subjects may open a lot more avenues in the future.
</p>
<p>
Before selecting either of the options, do a careful analysis of your subjects and ask the
following questions:
“Do I really need a job immediately?” “Do I truly enjoy my subjects and want to study further?” “Does my career require further knowledge or a specific qualification?”

If you are passionate about your subjects or require that extra qualification- great. Go ahead get that Master’s degree. But if you are going for Masters because it buys you another year or two in School, you might want to reconsider. Master’s degree is expensive and a lot of them, if not from top tier schools- are worthless.
</p>
<p>
If you think your campus placement after graduation isn’t up to the mark, relax. Accept this is where you start. It is okay to not be placed as the CEO of a multi-billion corporation. Alternatively, here is a list of all courses and degrees that can be pursued after  graduation:
</p>
<p>
<strong>M.COM.</strong> –&nbsp;Masters of Commerce is a post-graduate degree in commerce, management and accounting related subjects. Reputed universities have criteria of a minimum of 60% in a commerce or commerce related bachelor\'s degree.
</p>
<p>
<strong>M.Tech.</strong> –&nbsp;Masters of Technology or Masters of Engineering is a postgraduate degree an engineer can opt for. It is an extension of engineer’s graduate education. It is a good choice if you wish to get in-depth knowledge of your technical field and is also a reputed qualification a lot of technical careers require.
</p>
<p>
<strong>MBA</strong> -&nbsp;The most opted Master\'s degree of all, MBA is an internationally recognised degree designed to develop business and managerial skills. They include core curriculum subjects such as accounting, operations marketing and economics and elective courses for the student to mould his degree to his professional and personal preference.
</p>
<p>
<strong>MCA</strong> -&nbsp;Masters of Computer Applications is an increasingly popular postgraduate degree&nbsp;in the field of Information Technology. MCA is inclined more towards Application Development and thus has more emphasis on latest programming language and tools to develop better and faster applications. MCA focuses on providing a sound theoretical background as well as good practical exposure to students in the relevant areas.
</p>
<p>
<strong>M.Sc.</strong> - is a&nbsp;postgraduate level programme offered in the majority of universities in India.&nbsp;It offers in-depth theoretical as well as practical knowledge in a wide range of subjects such as Physics, Chemistry, Mathematics, Botany, Zoology etc. It forms the foundation for further study such as PhD.
</p>
<p>
<strong>MA</strong> -&nbsp;Masters of Arts&nbsp;is&nbsp;a broad subdivision of a culture composed of many expressive disciplines. The field of arts encompasses visual arts, literature, performing arts, including music, drama, dance, film and related media, amongst others. It is a non-scientific postgraduate degree that is also available through Correspondence and Distance Learning.
</p>
<p>
<strong>Alternatively</strong>,&nbsp;there are many other courses such as&nbsp;<strong>M.Pharma, Law, CA, CS,</strong>&nbsp;and <strong>other&nbsp;postgraduate courses in biological and life sciences.</strong>
</p>',
				'status' => 1,
				'contentslug' => 'counselling',
				'created_at' => '2020-05-30 09:58:55',
				'updated_at' => '2020-05-30 10:03:04',
				'contentcategory_id' => 8,
			),
			22 => 
			array (
				'id' => 23,
				'title' => 'View Top College List',
				'description' => '<p>Here you can see the list of top colleges and easily apply for admission.<br></p>',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 02:58:23',
				'updated_at' => '2020-06-25 02:58:23',
				'contentcategory_id' => 18,
			),
			23 => 
			array (
				'id' => 24,
				'title' => 'Check College Courses & Fees',
				'description' => '<p>One can easily see the list of course and fee details of any college.<br></p>',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 03:00:47',
				'updated_at' => '2020-06-25 03:00:47',
				'contentcategory_id' => 18,
			),
			24 => 
			array (
				'id' => 25,
				'title' => 'Details of all the main exams',
				'description' => '<p>Details of all the main exams, dates, procedures and examination related information are available.<br></p>',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 03:03:52',
				'updated_at' => '2020-06-25 03:03:52',
				'contentcategory_id' => 18,
			),
			25 => 
			array (
				'id' => 26,
				'title' => 'Choose career stream',
				'description' => '<p>According to which field you want to go, you can see the details of your career.<br></p>',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 03:07:13',
				'updated_at' => '2020-06-25 03:07:13',
				'contentcategory_id' => 18,
			),
			26 => 
			array (
				'id' => 27,
				'title' => 'Ask Questions, Replies & Comments',
				'description' => '<p>You can ask questions from experts here, if you want to answer a question or comment on an answer, then you have complete freedom.<br></p>',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 03:11:23',
				'updated_at' => '2020-06-25 03:11:23',
				'contentcategory_id' => 18,
			),
			27 => 
			array (
				'id' => 28,
				'title' => 'Never miss Important deadlines, latest updates & news',
				'description' => '<p>Here you will get all the latest updates like news, important dates, exam dates, admission dates etc.<br></p>',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 03:15:31',
				'updated_at' => '2020-06-25 03:15:31',
				'contentcategory_id' => 18,
			),
			28 => 
			array (
				'id' => 29,
				'title' => 'Ask Questions, Replies & Comments in any examination',
				'description' => 'You can see and submit examination related questions, answers and comments here.',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 03:15:31',
				'updated_at' => '2020-06-25 04:03:35',
				'contentcategory_id' => 18,
			),
			29 => 
			array (
				'id' => 30,
				'title' => 'Bookmark important blogs, courses & colleges',
				'description' => '<p>Here you can bookmark your favorite colleges, courses or blogs and view reviews of any college and submit your review.<br></p>',
				'status' => 1,
				'contentslug' => 'student-signup-page',
				'created_at' => '2020-06-25 03:21:06',
				'updated_at' => '2020-06-25 03:21:06',
				'contentcategory_id' => 18,
			),
		));
	}

}
