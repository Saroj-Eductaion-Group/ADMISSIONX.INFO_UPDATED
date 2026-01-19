<?php

/**PAGE ROUTES FOR WEBSITE FRONTEND ONLY**************************************************************************/
Route::get('/old-index', [
    'middleware' => ['auth'],
    'uses' => 'website\HomeController@index'
]);

Route::get('/old-home', [
    'middleware' => ['auth'],
    'uses' => 'website\HomeController@homeDesign'
]);

Route::get('/new-home', [
    'middleware' => ['auth'],
    'uses' => 'website\HomeController@newHomePage'
]);

/******* START ADMISSIONX UPGRADE NEW ROUTES FOR WEBSITE FRONTEND ONLY ***/
Route::get('/', 'website\HomeController@newHomePageAction');

Route::get('/home', [
    'middleware' => ['auth'],
    'uses' => 'website\HomeController@newHomePageAction'
]);


Route::get('/examination', 'website\HomeController@examinationPage');
Route::get('/examination-list/{stream}', 'website\HomeController@examinationListPage');
Route::get('/examination-list/{stream}/{degreeSlug?}', 'website\HomeController@examinationStreamListPage');
Route::get('/examination-details/{stream}/{slug}', 'website\HomeController@examinationDetailPage');
Route::get('/examination-details/{stream}/{slug}/faqs', 'website\HomeController@examinationFaqsDetailPage');
Route::get('/examination-details/{stream}/{slug}/questions', 'website\HomeController@examinationQuesListPage');
Route::get('/examination-details/{stream}/{slug}/{questionId}/question-details', 'website\HomeController@examinationQuesAnswerDetailPage');

Route::get('/careers/opportunities', 'website\HomeController@careersOpportunitiesListPage');
Route::get('/careers/opportunities/{stream}', 'website\HomeController@careersOpportunitiesIntrestPage');
Route::get('/careers-opportunities/{stream}', 'website\HomeController@counselingCareerRelevantPage');
Route::get('/careers/opportunities/{stream}/{slug}', 'website\HomeController@careersOpportunitiesStreamDetails');
Route::get('/popular-careers', 'website\HomeController@allPopularCareerListPage');
Route::get('/popular-careers/{slug}', 'website\HomeController@popularCareersDetails');
Route::get('/careers-courses', 'website\HomeController@allCoursesListPage');
Route::get('/careers-courses/{eligibility}/{slug}', 'website\HomeController@coursesStreamDetailsPage');
Route::get('/boards', 'website\HomeController@allBoardsListPage');
Route::get('/board/{category}/{slug}', 'website\HomeController@boardDetailPage');
/******* END ADMISSIONX UPGRADE NEW ROUTES FOR WEBSITE FRONTEND ONLY ***/
Route::get('/edu-career-mela/{slug}', 'website\HomeController@eduCareerMelaPage');


$router->group(['middleware' => 'auth'], function($router)
{
	/******** Login Routes*******/
	$router->resource('login', 'administrator\UsersController@login');
	$router->resource('user/doLogin', 'administrator\UsersController@doLogin');
	$router->resource('logout', 'administrator\UsersController@logout');
	$router->get('/sucess-login', 'administrator\UsersController@sucessLogin');
	$router->post('forget-password', 'administrator\UsersController@forgetPassword');
	$router->get('update-password/{emailAddress}', 'administrator\UsersController@updatePassword');
	$router->resource('password-update-sucess', 'administrator\UsersController@passwordUpdateSucess');
	$router->resource('/college-login', 'administrator\UsersController@collegeLoginAction');

	/*************** Student apply course routes******************/
	$router->resource('student-login', 'administrator\UsersController@studentLogin');
	$router->resource('student/doLogin', 'administrator\UsersController@studentLoginDetails');

	/*************** Student apply course routes******************/
	$router->resource('query-search-login', 'administrator\UsersController@guestQueryLogin');
	$router->resource('querysearch/doLogin', 'administrator\UsersController@queryLoginDetails');

	/************************ Check Bookmark Student Login Route************************/
	$router->resource('user/bookmark-login', 'administrator\UsersController@bookmarkLogin');
	$router->post('ajax-do-login', 'administrator\UsersController@ajaxDoLogin');

	$router->get('/old-educational-institution', 'website\HomeController@OldEducationalInstitution');
	$router->get('/educational-institution', 'website\HomeController@educationalInstitution');
	$router->get('/quick-sign-up', 'website\HomeController@quickSignUp');
	$router->post('/quick-sign-up-action', 'college\quickSignUpController@index');
	$router->get('/detail-sign-up/{slug}', 'college\quickSignUpController@detailSignUp');
	$router->post('/college-profile-action', 'college\quickSignUpController@collegeProfileStore');
	$router->get('/sucess-signup-details', 'college\quickSignUpController@sucessSignUp');
	$router->resource('sendCollegeSignupMail', 'college\quickSignUpController@sendCollegeSignupMail');

	$router->get('/old-student-sign-up', 'student\studentSignUpController@oldStudentSignUp');
	$router->get('/signup', 'student\studentSignUpController@studentSignUp');
	$router->get('/sign-up', 'student\studentSignUpController@studentSignUp');
	$router->get('/register', 'student\studentSignUpController@studentSignUp');
	$router->get('/student-sign-up', 'student\studentSignUpController@studentSignUp');
	$router->post('/student-sign-up-action', 'student\studentSignUpController@index');
	$router->get('/sucess-signup', 'student\studentSignUpController@sucessSignUp');
	$router->get('/student-detail-sign-up/{slug}', 'student\studentSignUpController@detailsSignUp');
	$router->post('/student-profile-details', 'student\studentSignUpController@studentDetailStore');
	$router->get('/getCurrentDOBCalculate', 'student\studentSignUpController@getCurrentDOBCalculate');
	$router->get('/getCurrentDOBCalculateApply', 'student\studentSignUpController@getCurrentDOBCalculateApply');
	$router->resource('sendSignupSms', 'student\studentSignUpController@sendSignupSms');
	$router->resource('sendStudentSignupMail', 'student\studentSignUpController@sendStudentSignupMail');
	$router->get('/return-back', 'student\studentSignUpController@returnBackHome');

	$router->post('/student-apply-course-signup', 'student\studentSignUpController@applyCourseStudentSingup');
	$router->post('/mailchimp', 'website\HomeController@addEmailToList');
	$router->post('/mailchimp-blogs', 'website\HomeController@addEmailToListViaBlogs');

	$router->get('/getStudentDOBCalculate', 'administrator\StudentProfileController@getStudentDOBCalculate');
	$router->get('getAllCollegeMasterName', 'administrator\FacultyController@getAllCollegeMasterName');
	
	$router->post('/request/create/college-account', 'college\quickSignUpController@requestCollegeAccountFormSubmit');

});


/****************Fetch Gallery and Document on Admin Dashboard  ********/
Route::get('documentPathImages/{imagename}', function($imagename = null)
{
	if (Auth::check())
	{
		$userId = Auth::id();
		$roleGrant = App\User::where('id', '=', $userId)->first();
		
		if( $roleGrant->userrole_id == '1' )
		{
			$path = base_path().'/public/document/'.$imagename;
			header("Content-Type: image/jpg ");
			header("Content-Type: image/png ");
			readfile($path);
			// header("Content-Length: " . filesize($imagename));
		    if (file_exists($path)) {
		        return $path;
		    }			
		}
	}else{
		return view('errors.404');
	}
    
});

Route::get('galleryPathImages/{imagename}', function($imagename = null)
{
	if (Auth::check())
	{
		$userId = Auth::id();
		$roleGrant = App\User::where('id', '=', $userId)->first();
		
		if( $roleGrant->userrole_id == '1' )
		{
			$path = base_path().'/public/gallery/'.$imagename;
			header("Content-Type: image/jpg ");
			header("Content-Type: image/png ");
			readfile($path);
			// header("Content-Length: " . filesize($imagename));
		    if (file_exists($path)) {
		        return $path;
		    }			
		}
	}else{
		return view('errors.404');
	}
    
});
/****************END Gallery and Document on Admin Dashboard  ********/

/*************************** HOME PAGES CONTROLLERS******************************************************************/
$router->group(['middleware' => 'auth'], function($router)
{
	$router->resource('/about', 'website\HomePageController@aboutUs');
	$router->resource('/contact-us', 'website\HomePageController@contactUs');
	$router->resource('/careers', 'website\HomePageController@careers');
	$router->get('/counselling', 'website\HomePageController@counselling');
	$router->resource('/education-blogs', 'website\HomePageController@blogsListPage');
	$router->resource('/blogs/{slugUrl}/', 'website\HomePageController@blogDetailPage');
	$router->resource('/college-signup', 'website\HomeController@educationalInstitution');
	$router->resource('/help-center', 'website\HomePageController@helpCenter');
	$router->resource('/press', 'website\HomePageController@press');
	$router->resource('/policies', 'website\HomePageController@policies');
	$router->resource('/terms-and-privacy', 'website\HomePageController@termsAndPrivacy');
	$router->resource('/trust-and-safety', 'website\HomePageController@trustAndSafety');
	$router->resource('/terms-and-conditions', 'website\HomePageController@termsAndConditions');
	$router->resource('/disclaimer', 'website\HomePageController@disclaimer');
	$router->resource('/terms-of-service', 'website\HomePageController@termsOfService');
	$router->resource('/testimonials', 'website\HomePageController@testimonials');
	$router->resource('/testimonial/{testimonialsID}/', 'website\HomePageController@testimonialDetails');
	$router->resource('/admission-registration-policy', 'website\HomePageController@admissionRegistrationPolicy');
	$router->resource('/advertiser-agreement', 'website\HomePageController@advertiserAgreement');
	$router->resource('/cancellation-refunds', 'website\HomePageController@cancellationRefunds');
	$router->resource('/payments-refunds-policy', 'website\HomePageController@paymentsTermsOfService');
	$router->resource('/student-referral-policy', 'website\HomePageController@studentReferralPolicy');
	$router->resource('/privacy-policy', 'website\HomePageController@privacyPolicy');
	$router->resource('/college-partner-agreement', 'website\HomePageController@collegePartnerAgreement');
	$router->resource('/change-data-name','website\HomeController@changeNameData');
	$router->resource('/add-missing-gallery','college\CollegeController@AddMissingGallery');
	$router->resource('/update-review-verify','college\CollegeController@UpdateCollegeReviewVerify');
	$router->resource('/agreement-private-college','college\CollegeController@UpdateCollegeAgreement');

	/* Running Cron Job for Application if college is not accept application in 72 hours*/
	$router->resource('/check-application-approval','website\HomeController@checkApplicationStatus');
	/***************************END HOME PAGES CONTROLLERS******************************************************************/

	/************ Career Route*************************************/
	$router->resource('/apply-for-job', 'website\HomePageController@applyForJob');
	$router->post('/help-center-detail-query', 'website\HomePageController@helpCenterForm');
	/****************** Website Log Controller****************/
	$router->get('/website-log', 'website\WebsiteLogController@catchAllEventInApp');
	$router->get('/college-log', 'website\WebsiteLogController@catchAllEventCollege');
	$router->get('/college-course-log', 'website\WebsiteLogController@catchAllEventCourseCollege');
	$router->get('/test-email-temp', 'website\WebsiteLogController@testEmailTemp');
	$router->get('/get-all-years', 'website\HomePageController@getAllYears');
	$router->get('/engineering-association-examination', 'website\HomeController@engineeringAssociationExamination');
	$router->get('/create-all-student-folder', 'website\HomePageController@createAllStudentFolder');


	$router->get('/404', 'website\HomePageController@errorPage');
	$router->get('/latest-updates', 'website\HomePageController@latestUpdates');
	$router->get('/reviews', 'website\HomePageController@websiteReviews');
	$router->get('/ask', 'website\HomePageController@askQuestionPage');
	$router->get('/unanswers', 'website\HomePageController@unanswersQuestionPage');
	$router->get('/discussions', 'website\HomePageController@discussionsQuestionPage');	
	$router->get('/ask/{slug}', 'website\HomePageController@askQuestionDetailPage');	
	$router->get('/ask/{type}/{slug}', 'website\HomePageController@askQuestionTagsPage');	
	$router->get('/news', 'website\HomePageController@newsList');
	$router->get('/news/{slug}', 'website\HomePageController@newsDetails');
	$router->get('/news/{type}/{slug}', 'website\HomePageController@getNewsTypesAction');

	$router->get('{userrole}/submit-question-list/{slug}','administrator\AskQuestionController@listOfSubmitQuestionAction');
	$router->get('{userrole}/submit-answer-list/{slug}','administrator\AskQuestionController@listOfSubmitAnswerAction');
	$router->get('{userrole}/submit-comments-list/{slug}','administrator\AskQuestionController@listOfSubmitCommentsAction');
	$router->get('{userrole}/review-list/{slug}','Helper\FetchDataServiceController@listOfSubmitReviewsAction');
	$router->post('/college/review-forms/{slug}/submit', 'Helper\FetchDataServiceController@collegeReviewFormsStore');
	$router->post('/examination/counselling/forms', 'Helper\FetchDataServiceController@counsellingFormSubmit');

	$router->post('/api/set/blog-bookmark', 'Helper\FetchDataServiceController@setBlogBookmarkSession');
	$router->post('/api/set/college-bookmark', 'Helper\FetchDataServiceController@setCollegeBookmarkSession');
	$router->post('/api/set/course-bookmark', 'Helper\FetchDataServiceController@setCourseBookMarkSession');
	$router->post('/api/set/college-reviews', 'Helper\FetchDataServiceController@setCollegeReviewsSession');
	$router->post('/api/set/college-helpdesk', 'Helper\FetchDataServiceController@setCollegeHelpDeskSession');
	$router->post('/api/set/examination-question', 'Helper\FetchDataServiceController@setExamQuestionContentSession');
	$router->post('/api/set/examination-answer', 'Helper\FetchDataServiceController@setExamAnswerContentSession');
	$router->post('/api/set/examination-comments', 'Helper\FetchDataServiceController@setExamCommentContentSession');
	$router->post('/api/set/ask-question', 'Helper\FetchDataServiceController@setAskQuestionContentSession');
	$router->post('/api/set/ask-answer', 'Helper\FetchDataServiceController@setAskAnswerContentSession');
	$router->post('/api/set/ask-comments', 'Helper\FetchDataServiceController@setAskCommentContentSession');

	$router->post('/add/exam-question/{examId}','examination\ExaminationDetailsController@addExamQuestion');
	$router->post('/add/exam-question-answer/{examId}/{questionId}','examination\ExaminationDetailsController@addExamQuestionAnswer');
	$router->post('/add/exam-question-answer-comment/{examId}/{questionId}/{answerId}','examination\ExaminationDetailsController@addExamQuestionAnswerComment');

	$router->post('/exam-question-answer/{queid}/update/{answerId}','examination\ExaminationDetailsController@updateQuestionAnswer');
	$router->post('/exam-question-answer-comment/{questionId}/{answerId}/update/{commentId}','examination\ExaminationDetailsController@updateQuestionAnswerComment');

	$router->post('/ask-new-question','administrator\AskQuestionController@addNewAskQuestion');
	$router->post('/add/ask-question-answer/{questionId}','administrator\AskQuestionController@addNewAskQuestionAnswer');
	$router->post('/add/ask-question-answer-comment/{questionId}/{answerId}','administrator\AskQuestionController@addNewAskQuestionAnswerComment');

	$router->post('/update/ask-question-answer/{questionId}/{answerId}','administrator\AskQuestionController@updateAskQuestionAnswer');
	$router->post('/update/ask-question-answer-comment/{questionId}/{answerId}/{commentId}','administrator\AskQuestionController@updateAskQuestionAnswerComment');

	$router->post('/landing-page-query', 'Helper\FetchDataServiceController@landingPageQueryFormSubmit');
});

Route::get('/validateEmailAddress', 'website\HomePageController@validateEmailAddress');

Route::get('auth/facebook', 'website\SocialConnectController@redirectToProviderFacebook');
Route::get('auth/facebook/callback', 'website\SocialConnectController@handleProviderCallbackFacebook');
Route::get('auth/google', 'website\SocialConnectController@redirectToProviderGoogle');
Route::get('auth/google/callback', 'website\SocialConnectController@handleProviderCallbackGoogle');
Route::post('social-fb-google/signup', 'website\SocialConnectController@socialFbGoogleSignupAction');


/********************************* Sitemap Routes Start****************************/
Route::get('/sitemap', 'website\SitemapController@sitemap');
// Route::get('/sitemap.html', 'website\SitemapController@sitemap');
// Route::get('/urllist.txt', 'website\SitemapController@sitemap');
// Route::get('/rss.xml', 'website\SitemapController@sitemap');

Route::get('/sitemap.xml', 'website\SitemapController@sitemapXmlAction');
// RENDER WEBSITE SITEMAP XML
Route::get('/sitemap/website.xml','website\SitemapController@websiteXmlAction');
// RENDER College SITEMAP XML
Route::get('/sitemap/college/{slug}','website\SitemapController@collegeXmlAction');
// RENDER Study Abroad SITEMAP XML
Route::get('/sitemap/study-abroad.xml','website\SitemapController@studyAbroadXmlAction');
// RENDER university SITEMAP XML
Route::get('/sitemap/university/{slug}','website\SitemapController@universityXmlAction');
// RENDER EDUCATION SITEMAP XML
Route::get('/sitemap/education-level-college-list.xml','website\SitemapController@educationLevelCollegeListXmlAction');
// RENDER STREAM SITEMAP XML
Route::get('/sitemap/stream-college-list.xml','website\SitemapController@streamCollegeListXmlAction');
// RENDER DEGREE SITEMAP XML
Route::get('/sitemap/degree-college-list.xml','website\SitemapController@degreeCollegeListXmlAction');
// RENDER COURSE SITEMAP XML
Route::get('/sitemap/course-college-list.xml','website\SitemapController@coursesCollegeListXmlAction');
// RENDER STREAM PRODUCT SITEMAP XML
Route::get('/sitemap/stream-list.xml','website\SitemapController@streamListXmlAction');
// RENDER DEGREE PRODUCT SITEMAP XML
Route::get('/sitemap/degree-list.xml','website\SitemapController@degreeListXmlAction');
// RENDER examination SITEMAP XML
Route::get('/sitemap/examination.xml','website\SitemapController@examinationXmlAction');
// RENDER examination SITEMAP XML
Route::get('/sitemap/careers-opportunities.xml','website\SitemapController@careersOpportunitiesXmlAction');
// RENDER examination SITEMAP XML
Route::get('/sitemap/popular-careers.xml','website\SitemapController@popularCareersXmlAction');
// RENDER examination SITEMAP XML
Route::get('/sitemap/careers-courses.xml','website\SitemapController@careersCoursesXmlAction');
// RENDER examination SITEMAP XML
Route::get('/sitemap/boards.xml','website\SitemapController@boardsXmlAction');
// RENDER BLOG SITEMAP XML
Route::get('/sitemap/blog.xml','website\SitemapController@blogXmlAction');
// RENDER AUCTION LISTING SITEMAP XML
Route::get('/sitemap/news.xml','website\SitemapController@newsXmlAction');
// RENDER AUCTION LISTING SITEMAP XML
Route::get('/sitemap/ask-tags.xml','website\SitemapController@askTagXmlAction');
// RENDER ASK SITEMAP XML
Route::get('/sitemap/ask/{slug}','website\SitemapController@askXmlAction');
// RENDER review SITEMAP XML
Route::get('/sitemap/reviews/{slug}','website\SitemapController@reviewsXmlAction');
// RENDER COUNTRY SITEMAP XML
Route::get('/sitemap/state-wise-college/{slug}','website\SitemapController@stateWiseCollegeListXmlAction');
// RENDER CITY SITEMAP XML
Route::get('/sitemap/city-wise-college/{slug}','website\SitemapController@cityWiseCollegeListXmlAction');
// RENDER country wise state SITEMAP XML
Route::get('/sitemap/country-wise-state.xml','website\SitemapController@countryWiseStateListXmlAction');
// RENDER state wise cities SITEMAP XML
Route::get('/sitemap/state-wise-cities/{slug}','website\SitemapController@stateWiseCityListXmlAction');
/****************************** Sitemap Routes End****************************/