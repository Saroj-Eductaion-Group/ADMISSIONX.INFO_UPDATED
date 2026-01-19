<?php
$router->group(['middleware' => 'auth'], function($router)
{
	/*****************************ADMINISTRATOR ROUTES***************************************************************/
	$router->resource('/administrator/dashboard', 'administrator\AdminController');

	$router->resource('administrator/userrole', 'administrator\UserRoleController');
	$router->resource('administrator/userstatus', 'administrator\UserStatusController');
	$router->resource('administrator/paymentstatus', 'administrator\PaymentStatusController');
	$router->resource('administrator/cardtype', 'administrator\CardTypeController');
	$router->resource('administrator/applicationstatus', 'administrator\ApplicationStatusController');
	$router->resource('administrator/facilities', 'administrator\FacilitiesController');
	$router->resource('administrator/category', 'administrator\CategoryController');
	$router->resource('administrator/country', 'administrator\CountryController');
	$router->resource('administrator/university', 'administrator\UniversityController');
	$router->resource('administrator/state', 'administrator\StateController');
	$router->resource('administrator/city', 'administrator\CityController');
	$router->resource('administrator/collegetype', 'administrator\CollegeTypeController');
	$router->resource('administrator/addresstype', 'administrator\AddressTypeController');
	$router->resource('administrator/studentprofile', 'administrator\StudentProfileController');
	$router->resource('administrator/collegeprofile', 'administrator\CollegeProfileController');
	$router->resource('administrator/educationlevel', 'administrator\EducationLevelController');
	$router->resource('administrator/functionalarea', 'administrator\FunctionalAreaController');
	$router->resource('administrator/degree', 'administrator\DegreeController');
	$router->resource('administrator/coursetype', 'administrator\CourseTypeController');
	$router->resource('administrator/course', 'administrator\CourseController');
	$router->resource('administrator/event', 'administrator\EventController');
	$router->resource('administrator/studentmarks', 'administrator\StudentMarksController');
	$router->resource('administrator/collegefacilities', 'administrator\CollegeFacilitiesController');
	$router->resource('administrator/users', 'administrator\UsersController');
	$router->resource('administrator/invite', 'administrator\InviteController');
	$router->resource('administrator/blogs', 'administrator\BlogsController');
	$router->resource('administrator/bookmarks', 'administrator\BookmarksController');
	$router->resource('administrator/address', 'administrator\AddressController');
	$router->resource('administrator/documents', 'administrator\DocumentsController');
	$router->resource('administrator/galleries', 'administrator\GalleryController');
	$router->resource('administrator/logs', 'administrator\LogsController');
	$router->resource('administrator/application', 'administrator\ApplicationController');
	$router->resource('administrator/transaction', 'administrator\TransactionController');
	$router->resource('administrator/collegemaster', 'administrator\CollegeMasterController');
	$router->resource('administrator/subscribe', 'administrator\SubscribeController');
	//$router->resource('administrator/albums', 'administrator\AlbumsController');
	$router->resource('administrator/placement', 'administrator\PlacementController');
	$router->resource('administrator/pages', 'administrator\PagesController');
	$router->resource('administrator/entranceexam', 'administrator\EntranceexamController');
	//$router->resource('administrator/faculty', 'administrator\FacultyController');
	$router->resource('administrator/faculty', 'administrator\CollegeFacultyController');
	$router->resource('administrator/alltableinformation', 'administrator\AllTableInformationController');
	$router->resource('administrator/userprivilege', 'administrator\UserPrivilegeController');
	$router->resource('administrator/career', 'administrator\CareerController');
	$router->resource('administrator/socialmanagement', 'administrator\SocialManagementController');
	$router->resource('administrator/bookmarktypeinfo', 'administrator\BookmarkTypeInfoController');
	$router->resource('adminSendEmails', 'administrator\UsersController@adminSendEmails');
	$router->resource('administrator/youtube', 'administrator\GalleryController@youtubeLink');
	$router->resource('administrator/youtube-create', 'administrator\GalleryController@updateYoutubeLink');
	$router->resource('administrator/applicationstatusmessage', 'administrator\ApplicationStatusMessageController');
	$router->resource('administrator/testimonial', 'administrator\TestimonialController');

	$router->resource('administrator/query', 'administrator\QueryController');
	$router->get('/administrator/query-college-student', 'administrator\QueryController@queryBetweenCollegeStudent');
	$router->get('/administrator/query-college-student-details/{chatkey}/{id}', 'administrator\QueryController@queryBetweenCollegeStudentDetails');

	$router->get('administrator/query-bya', 'administrator\QueryController@queryToBya');
	$router->get('administrator/query-bya-detail/{id}/{person}', 'administrator\QueryController@queryToByaDetails');
	$router->post('administrator/query-reply-bya', 'administrator\QueryController@queryReplyBya');
	$router->get('/administrator/query-details/{chatkey}/{id}', 'administrator\QueryController@queryDetails');

	$router->post('administrator/affiliation-accreditation', 'administrator\GalleryController@affiliationAccreditation');
	/*************************************************************************************************************/

	/********* Delete Serarch User for admin *********************/
	$router->get('administrator/users/delete/{id}','administrator\UsersController@deleteSearchUser');
	$router->get('administrator/collegemaster/delete/{id}','administrator\CollegeMasterController@deleteSearchCollegeMaster');
	$router->get('administrator/event/delete/{id}','administrator\EventController@deleteSearchEvent');
	$router->get('administrator/collegefacilities/delete/{id}','administrator\CollegeFacilitiesController@deleteSearchFacility');
	$router->get('administrator/documents/delete/{id}','administrator\DocumentsController@deleteSearchDocument');
	$router->get('administrator/galleries/delete/{id}','administrator\GalleryController@deleteSearchGallery');
	$router->get('administrator/blogs/delete/{id}','administrator\BlogsController@deleteSearchBlog');
	$router->get('administrator/query/delete/{id}','administrator\QueryController@deleteSearchQuery');
	$router->get('administrator/subscribe/delete/{id}','administrator\SubscribeController@deleteSearchSubscribe');
	$router->get('administrator/pages/delete/{id}','administrator\PagesController@deleteSearchPages');
	$router->get('administrator/logs/delete/{id}','administrator\LogsController@deleteSearchLogs');
	$router->get('administrator/educationlevel/delete/{id}','administrator\EducationLevelController@deleteSearchEducationLavel');
	$router->get('administrator/functionalarea/delete/{id}','administrator\FunctionalAreaController@deleteSearchFunctionalArea');
	$router->get('administrator/degree/delete/{id}','administrator\DegreeController@deleteSearchDegree');
	$router->get('administrator/course/delete/{id}','administrator\CourseController@deleteSearchCourse');
	$router->get('administrator/facilities/delete/{id}','administrator\FacilitiesController@deleteSearchFacilities');
	$router->get('administrator/invite/delete/{id}','administrator\InviteController@deleteSearchInvite');
	$router->get('administrator/university/delete/{id}','administrator\UniversityController@deleteSearchUniversity');
	$router->get('administrator/placement/delete/{id}','administrator\PlacementController@deleteSearchPlacemant');

	/***** Search Route For Admin************************/
	$router->resource('search/user', 'administrator\UsersController@searchUsers');
	$router->resource('search/all-users', 'administrator\UsersController@allUserDetails');

	$router->resource('search/college-profile', 'administrator\CollegeProfileController@searchCollegeProfile');
	$router->resource('search/all-college-profile', 'administrator\CollegeProfileController@allCollegeProfile');

	$router->resource('search/college-master', 'administrator\CollegeMasterController@searchCollegeMaster');
	$router->resource('search/all-college-master', 'administrator\CollegeMasterController@allCollegeMasterCourse');
	$router->get('/selectCityNameData', 'administrator\CollegeMasterController@selectCityNameData');

	$router->resource('search/college-event', 'administrator\EventController@collegeEventSearch');
	$router->resource('search/all-college-event', 'administrator\EventController@allEventSearch');

	$router->resource('search/college-facility', 'administrator\CollegeFacilitiesController@collegeFacilitySearch');
	$router->resource('search/all-college-facility', 'administrator\CollegeFacilitiesController@allFacilitySearch');

	$router->resource('search/address', 'administrator\AddressController@addressSearch');
	$router->resource('search/all-address', 'administrator\AddressController@allAddressSearch');
	$router->get('/getAllCityNameData', 'administrator\AddressController@getAllCityNameData');
	$router->get('/getAllStateNameData', 'administrator\AddressController@getAllStateNameData');

	$router->get('/getAllCollegeCourseNameData', 'Helper\FetchDataServiceController@getAllCollegeCourseNameData');

	$router->resource('search/blogs', 'administrator\BlogsController@blogsSearch');
	$router->resource('search/all-blogs', 'administrator\BlogsController@allBlogsSearch');

	$router->resource('search/query', 'administrator\QueryController@querySearch');
	$router->resource('search/all-query', 'administrator\QueryController@allQuerySearch');

	$router->resource('search/document', 'administrator\DocumentsController@documentSearch');
	$router->resource('search/all-document', 'administrator\DocumentsController@allDocumentSearch');

	$router->resource('search/gallery', 'administrator\GalleryController@gallerySearch');
	$router->resource('search/all-gallery', 'administrator\GalleryController@allGallerySearch');

	$router->resource('search/pages', 'administrator\PagesController@pagesSearch');
	$router->resource('search/all-pages', 'administrator\PagesController@allPagesSearch');

	$router->resource('search/university', 'administrator\UniversityController@universitySearch');
	$router->resource('search/all-university', 'administrator\UniversityController@allUniversitySearch');

	$router->resource('search/placement', 'administrator\PlacementController@placementSearch');
	$router->resource('search/all-placement', 'administrator\PlacementController@allPlacementSearch');

	$router->resource('search/subscribe', 'administrator\SubscribeController@subscribeSearch');
	$router->resource('search/all-subscribe', 'administrator\SubscribeController@allSubscribeSearch');

	$router->resource('search/functionalarea', 'administrator\FunctionalAreaController@functionalAreaSearch');
	$router->resource('search/all-functionalarea', 'administrator\FunctionalAreaController@allFunctionalAreaSearch');

	$router->resource('search/logs', 'administrator\LogsController@logsSearch');
	$router->resource('search/all-logs', 'administrator\LogsController@allLogSearch');

	$router->resource('search/course', 'administrator\CourseController@courseSearch');
	$router->resource('search/all-course', 'administrator\CourseController@allCourseSearch');

	$router->resource('search/degree', 'administrator\DegreeController@degreeSearch');
	$router->resource('search/all-degree', 'administrator\DegreeController@allDegreeSearch');

	$router->resource('search/facilities', 'administrator\FacilitiesController@facilitySearch');
	$router->resource('search/all-facilities', 'administrator\FacilitiesController@allFacilitySearch');

	$router->resource('search/invite', 'administrator\InviteController@inviteSearch');
	$router->resource('search/all-invite', 'administrator\InviteController@allInviteSearch');

	$router->resource('search/educationlevel', 'administrator\EducationLevelController@educationLevelSearch');
	$router->resource('search/all-educationlevel', 'administrator\EducationLevelController@allEducationLevelSearch');

	$router->resource('search/city-name', 'administrator\CityController@citySearch');
	$router->resource('search/all-city-name', 'administrator\CityController@allCitySearch');

	$router->resource('search/state-name', 'administrator\StateController@stateSearch');
	$router->resource('search/all-state-name', 'administrator\StateController@allStateSearch');

	$router->resource('search/application', 'administrator\ApplicationController@applicationSearch');
	$router->resource('search/all-application', 'administrator\ApplicationController@allApplicationSearch');

	$router->resource('search/transaction', 'administrator\TransactionController@transactionSearch');
	$router->resource('search/all-transaction', 'administrator\TransactionController@allTransactionSearch');

	$router->resource('search/student-profile', 'administrator\StudentProfileController@studentProfileSearch');
	$router->resource('search/all-student-profile', 'administrator\StudentProfileController@allStudentProfileSearch');

	$router->resource('search/application-remarks', 'administrator\ApplicationStatusMessageController@applicationRemarkSearch');
	$router->resource('search/all-application-remarks', 'administrator\ApplicationStatusMessageController@allApplicationStatusSearch');

	$router->resource('search/query-admissionx', 'administrator\QueryController@querySearchAdmissionx');
	$router->resource('search/all-query-admissionx', 'administrator\QueryController@allQuerySearchAdmissionx');

	$router->resource('search/college-faculty', 'administrator\FacultyController@facultySearch');
	$router->resource('search/all-college-faculty', 'administrator\FacultyController@allFacultySearch');


	/****************************************************/
	/************* Reports *****************************************************************/
	$router->get('/administrator/reports', 'administrator\ExportToExcelReportController@index');
	$router->resource('export/search-result', 'administrator\ExportToExcelReportController@exportSearchResult');

	/**User Group ***/
	$router->resource('/administrator/usergroup', 'administrator\UsergroupController');
	$router->resource('/administrator/usergroup-table-info', 'administrator\UsergroupController@userGroupTableInfo');
	$router->get('/updateTableInfo', 'administrator\UsergroupController@updateTableInfo');	
	$router->post('/user-group-table-update', 'administrator\UsergroupController@userGroupTableUpdate');
	$router->post('/administrator/usergroup-add-table', 'administrator\UsergroupController@addNewTable');
	$router->get('/administrator/usergroup/delete/{id}','administrator\UsergroupController@deleteUserGroup');
	$router->get('/administrator/userprivilege-table-info/{usersId}', 'administrator\UserPrivilegeController@userPrivilegeInfo');
	$router->get('/administrator/userprivilege/delete/{usersId}','administrator\UserPrivilegeController@deleteUserprivilege');
	$router->post('/administrator/userprivilege/addtable', 'administrator\UserPrivilegeController@addNewTableUserPrivileges');

	/**WEBSITE METRICS ACTIONS**/
	$router->resource('/administrator/website-analytics', 'administrator\LogsController@WebsiteAnalytics');

	/**COLLEGE CONTACT CARDS**/
	$router->get('/administrator/collegeprofile-info/contact-card', 'administrator\CollegeProfileController@collegeContactCard');
	$router->resource('/administrator/sendWelcomeEmail','administrator\CollegeProfileController@sendWelcomeEmail');


	/***** Transaction Graph route ******/
	$router->resource('/administrator/transaction-analytics', 'administrator\TransactionController@TransactionAnalyticsIndex');
	$router->resource('/administrator/search-transaction-analytics', 'administrator\TransactionController@searchTransactionAnalyticsIndex');

	/*** PRovisional Letter ***/
	$router->resource('/administrator/provisional-letter','administrator\ApplicationController@sendProvisionalLetter');

	//Testing Provisional Letter Route
	$router->get('/provisionalLetter-demo/{id}', array('as'=>'htmltopdfview','uses'=>'administrator\ApplicationController@provisionalLetter'));

	//College Data Insert
	/*$router->resource('/add-all-college-test','college\CollegeController@AddBulkCollegeData');
	$router->resource('/update-stateid','college\CollegeController@updateStateId');
	$router->resource('/update-cityid','college\CollegeController@updateCityId');
	$router->resource('/update-university','college\CollegeController@updateCollegeUnivertityData');
	$router->resource('/add-old-college-data','college\CollegeController@AddOldCollegeData');
	$router->resource('/add-old-college-course-data','college\CollegeController@AddOldCollegeCourseData');
	$router->resource('/add-old-college-faculty','college\CollegeController@AddFacultyName');
	$router->resource('/add-old-college-facility','college\CollegeController@AddFacilityName');*/
	/*$router->resource('/add-university','college\CollegeController@addUnivercityData');
	$router->resource('/add-usa-college-data','college\CollegeController@AddUsaCollegeData');*/
	//$router->resource('/add-usa-city-data','college\CollegeController@addUpdteCityData');

	//$router->get('/insert-country-state-city', 'website\HomeController@insertCountryStateCity');
	
	$router->resource('/administrator/engineering-exam', 'administrator\EngineeringExamController');
	$router->get('/administrator/all-india-engineer-association', 'administrator\EngineeringExamController@AllIndiaEngineeringAssociation');
	/***************Payment Process From PAYUBIZ******************/
	$router->post('/exam-payment-process-start/{id}','administrator\EngineeringExamController@examPaymentNowForStudent');
	//ON SUCCESS PAYMENT
	$router->post('/examtransaction/process-payment/{id}', 'administrator\EngineeringExamController@processPaymentApplication');
	//ON FAILURE PAYMENT
	$router->post('/examtransaction/process-failure-payment/{id}', 'administrator\EngineeringExamController@processFailurePaymentApplication');

	$router->get('/exam-failure-payment-details', 'administrator\EngineeringExamController@failurePayment');
	$router->get('/exam-success-payment-details', 'administrator\EngineeringExamController@successPayment');

	$router->any('/exam-success-payment-failed/{id}', 'administrator\EngineeringExamController@handleFailureExamPaymentAction');
	$router->any('/exam-success-payment-success/{id}', 'administrator\EngineeringExamController@handleSuccessExamPaymentAction');


	//EMAIL TEST ROUTE
	$router->get('/emailTest', 'administrator\UsersController@emailTest');

	//ADS MANAGEMENT ROUTES
	$router->resource('administrator/ads-management', 'administrator\AdsManagementController');
});


$router->group(['middleware' => 'adminemployee'], function($router)
{	
	$router->resource('/administrator/request/create-college-account', 'administrator\RequestForCreateCollegeAccountController');
    $router->resource('/administrator/college-management-details', 'administrator\CollegeManagementDetailsController');
	$router->resource('/administrator/college-scholarship', 'administrator\CollegeScholarshipController');
	$router->resource('/administrator/college-cut-offs', 'administrator\CollegeCutOffsController');
	$router->resource('/administrator/college-sports-activity', 'administrator\CollegeSportsActivityController');
	$router->resource('/administrator/college-faqs', 'administrator\CollegeFaqsController');
	$router->resource('/administrator/college-social-media-links', 'administrator\CollegeSocialMediaLinksController');
	$router->resource('/administrator/college-reviews', 'administrator\CollegeReviewsController');
	$router->resource('/administrator/college-admission-procedure', 'administrator\CollegeAdmissionProcedureController');
	$router->resource('/administrator/college-admission-imp-dated', 'administrator\CollegeAdmissionImportantDatedController');
	$router->resource('/administrator/college-master-associate-faculty', 'administrator\CollegeMasterAssociateFacultyController');
	$router->resource('/administrator/faculty-experience', 'administrator\FacultyExperienceController');
	$router->resource('/administrator/faculty-qualification', 'administrator\FacultyQualificationController');
	$router->resource('/administrator/faculty-department', 'administrator\FacultyDepartmentController');
	$router->resource('/administrator/exam-counselling-form', 'administrator\ExamCounsellingFormController');
	$router->resource('/administrator/landing-page-query-form', 'administrator\LandingPageQueryFormController');
	$router->resource('/administrator/template', 'administrator\TemplateController');
	$router->resource('/administrator/what-we-offer', 'administrator\WhatWeOfferController');
    $router->resource('/administrator/slider-manager', 'administrator\SliderManagerController');
	$router->resource('/administrator/latest-update', 'administrator\LatestUpdateController');
	$router->resource('/administrator/news', 'administrator\NewsController');
	$router->resource('/administrator/news-type', 'administrator\NewsTypeController');
	$router->resource('/administrator/news-tags', 'administrator\NewsTagsController');
	$router->resource('/administrator/ask-question', 'administrator\AskQuestionController');
	$router->resource('/administrator/ask-question-tags', 'administrator\AskQuestionTagsController');

    $router->resource('/administrator/content', 'administrator\ContentController');
	$router->resource('/administrator/contentcategory', 'administrator\ContentcategoryController');
    Route::get('/administrator/all-page-contents/{id}', 'administrator\ContentController@allPageContents');

	$router->resource('/administrator/seo-content', 'administrator\SeoContentController');
    $router->get('/administrator/custom-seo-content', 'administrator\SeoContentController@customSeoContent');
    $router->get('/administrator/dynamic-seo-content', 'administrator\SeoContentController@dynamicSeoContent');
    $router->get('/administrator/student-seo-content', 'administrator\SeoContentController@studentProfileSeoContent');
    $router->get('/administrator/college-seo-content', 'administrator\SeoContentController@collegeProfileSeoContent');
    $router->get('/administrator/examination-seo-content', 'administrator\SeoContentController@examinationSeoContent');
    $router->get('/administrator/boards-details-seo-content', 'administrator\SeoContentController@boardSeoContent');
    $router->get('/administrator/career-relevent-seo-content', 'administrator\SeoContentController@careerReleventSeoContent');
    $router->get('/administrator/popular-career-seo-content', 'administrator\SeoContentController@popularCareerSeoContent');
    $router->get('/administrator/course-details-seo-content', 'administrator\SeoContentController@courseDetailsSeoContent');
    $router->get('/administrator/blog-seo-content', 'administrator\SeoContentController@blogSeoContent');
    $router->get('/administrator/exam-section-seo-content', 'administrator\SeoContentController@examSectionSeoContent');
    $router->get('/administrator/education-level-seo-content', 'administrator\SeoContentController@educationLevelSeoContent');
    $router->get('/administrator/degree-seo-content', 'administrator\SeoContentController@degreeSeoContent');
    $router->get('/administrator/functionalarea-seo-content', 'administrator\SeoContentController@functionalareaSeoContent');
    $router->get('/administrator/course-seo-content', 'administrator\SeoContentController@coursesSeoContent');
    $router->get('/administrator/university-seo-content', 'administrator\SeoContentController@universitySeoContent');
    $router->get('/administrator/country-seo-content', 'administrator\SeoContentController@countrySeoContent');
    $router->get('/administrator/state-seo-content', 'administrator\SeoContentController@stateSeoContent');
    $router->get('/administrator/city-seo-content', 'administrator\SeoContentController@citySeoContent');
    $router->get('/administrator/news-seo-content', 'administrator\SeoContentController@newsSeoContent');
    $router->get('/administrator/news-tags-seo-content', 'administrator\SeoContentController@newsTagsSeoContent');
    $router->get('/administrator/news-type-seo-content', 'administrator\SeoContentController@newsTypeSeoContent');
    $router->get('/administrator/ask-question-seo-content', 'administrator\SeoContentController@askQuestionSeoContent');
    $router->get('/administrator/ask-question-tag-seo-content', 'administrator\SeoContentController@askQuestionTagsSeoContent');

    $router->post('/administrator/permanently-delete-user','administrator\UsersController@permanentlyDeleteUser');

	Route::post('administrator/slider/isShowCollegeCount', 'administrator\SliderManagerController@isShowCollegeCount');
	Route::post('administrator/slider/isShowExamCount', 'administrator\SliderManagerController@isShowExamCount');
	Route::post('administrator/slider/isShowCourseCount', 'administrator\SliderManagerController@isShowCourseCount');
	Route::post('administrator/slider/isShowBlogCount', 'administrator\SliderManagerController@isShowBlogCount');
	Route::post('administrator/collegeprofile/isShowOnHome', 'administrator\CollegeProfileController@isShowOnHome');
	Route::post('administrator/collegeprofile/isShowOnTop', 'administrator\CollegeProfileController@isShowOnTop');
	Route::post('administrator/isShowOnHome', 'Helper\FetchDataServiceController@isShowOnHome');
	Route::post('administrator/isShowOnTop', 'Helper\FetchDataServiceController@isShowOnTop');

	Route::get('administrator/updateTableSlug/{table}', 'Helper\FetchDataServiceController@updateTableSlug');

	$router->get('/administrator/all-ask-answers', 'administrator\AskQuestionController@allASKAnswers');
	$router->get('/administrator/ask-answers/edit/{id}', 'administrator\AskQuestionController@editASKAnswers');
	$router->get('/administrator/ask-answers/show/{id}', 'administrator\AskQuestionController@showASKAnswers');

	$router->get('/administrator/all-ask-comments', 'administrator\AskQuestionController@allASKComments');
	$router->get('/administrator/ask-comments/edit/{id}', 'administrator\AskQuestionController@editASKComments');
	$router->get('/administrator/ask-comments/show/{id}', 'administrator\AskQuestionController@showASKComments');

	$router->get('/delete-ask/question-answer/{questionId}/{answerId}','administrator\AskQuestionController@deleteAskQuestionAnswer');
	$router->get('/delete-ask/question-answer-comments/{questionId}/{answerId}/{commentId}','administrator\AskQuestionController@deleteAskQuestionAnswerComment');

	$router->post('/administrator/update/ask-question-answer/{questionId}/{answerId}','administrator\AskQuestionController@updateAskQuestionAnswerAdmin');
	$router->post('/administrator/update/ask-question-answer-comment/{questionId}/{answerId}/{commentId}','administrator\AskQuestionController@updateAskQuestionAnswerCommentAdmin');

	Route::post('administrator/annwer/status', 'administrator\AskQuestionController@answerStatusChange');
	Route::post('administrator/comment/status', 'administrator\AskQuestionController@answerCommentStatusChange');

	Route::post('administrator/accept-request/college-account/created', 'administrator\RequestForCreateCollegeAccountController@collegeProfileCreated');

	$router->resource('/administrator/ads-top-college-list', 'administrator\AdsTopCollegeListController');
	$router->get('/getAllDropdownOptions', 'Helper\FetchDataServiceController@getAllDropdownOptions');
	$router->get('/checkExistingAdsCollegeList', 'Helper\FetchDataServiceController@checkExistingAdsCollegeList');
	$router->post('/update-on-change-status', 'Helper\FetchDataServiceController@updateStatusOnChange');
});