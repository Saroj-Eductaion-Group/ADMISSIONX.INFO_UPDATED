<?php
$router->group(['middleware' => 'auth'], function($router)
{
	/*****************************Employee ROUTES***************************************************************/
	$router->resource('/employee/dashboard', 'employee\AdminEmployeeController');

	$router->resource('employee/userrole', 'employee\UserRoleController');
	$router->resource('employee/userstatus', 'employee\UserStatusController');
	$router->resource('employee/paymentstatus', 'employee\PaymentStatusController');
	$router->resource('employee/cardtype', 'employee\CardTypeController');
	$router->resource('employee/applicationstatus', 'employee\ApplicationStatusController');
	$router->resource('employee/facilities', 'employee\FacilitiesController');
	$router->resource('employee/category', 'employee\CategoryController');
	$router->resource('employee/country', 'employee\CountryController');
	$router->resource('employee/university', 'employee\UniversityController');
	$router->resource('employee/state', 'employee\StateController');
	$router->resource('employee/city', 'employee\CityController');
	$router->resource('employee/collegetype', 'employee\CollegeTypeController');
	$router->resource('employee/addresstype', 'employee\AddressTypeController');
	$router->resource('employee/studentprofile', 'employee\StudentProfileController');
	$router->resource('employee/collegeprofile', 'employee\CollegeProfileController');
	$router->resource('employee/educationlevel', 'employee\EducationLevelController');
	$router->resource('employee/functionalarea', 'employee\FunctionalAreaController');
	$router->resource('employee/degree', 'employee\DegreeController');
	$router->resource('employee/coursetype', 'employee\CourseTypeController');
	$router->resource('employee/course', 'employee\CourseController');
	$router->resource('employee/event', 'employee\EventController');
	$router->resource('employee/studentmarks', 'employee\StudentMarksController');
	$router->resource('employee/collegefacilities', 'employee\CollegeFacilitiesController');
	$router->resource('employee/users', 'employee\UsersController');
	$router->resource('employee/invite', 'employee\InviteController');
	$router->resource('employee/blogs', 'employee\BlogsController');
	$router->resource('employee/bookmarks', 'employee\BookmarksController');
	$router->resource('employee/address', 'employee\AddressController');
	$router->resource('employee/documents', 'employee\DocumentsController');
	$router->resource('employee/galleries', 'employee\GalleryController');
	$router->resource('employee/query', 'employee\QueryController');
	$router->resource('employee/logs', 'employee\LogsController');
	$router->resource('employee/application', 'employee\ApplicationController');
	$router->resource('employee/transaction', 'employee\TransactionController');
	$router->resource('employee/collegemaster', 'employee\CollegeMasterController');
	$router->resource('employee/subscribe', 'employee\SubscribeController');
	//$router->resource('employee/albums', 'employee\AlbumsController');
	$router->resource('employee/placement', 'employee\PlacementController');
	$router->resource('employee/pages', 'employee\PagesController');
	$router->resource('employee/entranceexam', 'employee\EntranceexamController');
	//$router->resource('employee/faculty', 'employee\FacultyController');
	$router->resource('employee/faculty', 'employee\CollegeFacultyController');
	$router->resource('employee/alltableinformation', 'employee\AllTableInformationController');
	$router->resource('employee/userprivilege', 'employee\UserPrivilegeController');
	$router->post('employee/affiliation-accreditation', 'employee\GalleryController@affiliationAccreditation');
	$router->resource('employee/career', 'employee\CareerController');
	$router->resource('employee/socialmanagement', 'employee\SocialManagementController');
	$router->resource('employee/bookmarktypeinfo', 'employee\BookmarkTypeInfoController');
	$router->resource('employeeSendEmails', 'employee\UsersController@employeeSendEmails');
	$router->resource('employee/youtube', 'employee\GalleryController@youtubeLink');
	$router->resource('employee/youtube-create', 'employee\GalleryController@updateYoutubeLink');
	$router->resource('employee/applicationstatusmessage', 'employee\ApplicationStatusMessageController');
	$router->resource('employee/testimonial', 'employee\TestimonialController');
	/*****************************End Employee ROUTES***************************************************************/

	/****Welcome email *****/
	$router->resource('/employee/sendWelcomeEmail','employee\CollegeProfileController@sendWelcomeEmail');

	/**User Group ***/
	$router->resource('/employee/usergroup', 'employee\UsergroupController');
	$router->resource('/employee/usergroup-table-info', 'employee\UsergroupController@userGroupTableInfo');
	$router->get('/employee/updateTableInfo', 'employee\UsergroupController@updateTableInfo');
	$router->post('/user-group-table-emp-update', 'employee\UsergroupController@userGroupTableUpdate');
	$router->post('/employee/usergroup-add-table', 'employee\UsergroupController@addNewTable');
	$router->get('/employee/usergroup/delete/{id}','employee\UsergroupController@deleteUserGroup');
	$router->get('/employee/userprivilege-table-info/{usersId}', 'employee\UserPrivilegeController@userPrivilegeInfo');
	$router->get('/employee/userprivilege/delete/{usersId}','employee\UserPrivilegeController@deleteUserprivilege');
	$router->post('/employee/userprivilege/addtable', 'employee\UserPrivilegeController@addNewTableUserPrivileges');


	$router->get('/employee/query-college-student', 'employee\QueryController@queryBetweenCollegeStudent');
	$router->get('/employee/query-college-student-details/{chatkey}/{id}', 'employee\QueryController@queryBetweenCollegeStudentDetails');

	$router->get('employee/query-bya', 'employee\QueryController@queryToBya');
	$router->get('employee/query-bya-detail/{id}/{person}', 'employee\QueryController@queryToByaDetails');
	$router->post('employee/query-reply-bya', 'employee\QueryController@queryReplyBya');
	$router->get('/employee/query-details/{chatkey}/{id}', 'employee\QueryController@queryDetails');

	/***** Search Route For Employee************************/
	$router->resource('search/user-employee', 'employee\UsersController@searchEmployeeUsers');
	$router->resource('search/all-users-employee', 'employee\UsersController@allEmployeeUserDetails');

	$router->resource('search/employee-college-profile', 'employee\CollegeProfileController@searchEmployeeCollegeProfile');
	$router->resource('search/employee-all-college-profile', 'employee\CollegeProfileController@allEmployeeCollegeProfile');

	$router->resource('search/employee-college-master', 'employee\CollegeMasterController@searchEmployeeCollegeMaster');
	$router->resource('search/employee-all-college-master', 'employee\CollegeMasterController@allEmployeeCollegeMasterCourse');

	$router->resource('search/employee-college-event', 'employee\EventController@collegeEventEmployeeSearch');
	$router->resource('search/employee-all-college-event', 'employee\EventController@allEventEmployeeSearch');

	$router->resource('search/employee-college-facility', 'employee\CollegeFacilitiesController@collegeFacilityEmployeeSearch');
	$router->resource('search/employee-all-college-facility', 'employee\CollegeFacilitiesController@allFacilityEmployeeSearch');

	$router->resource('search/employee-address', 'employee\AddressController@addressEmployeeSearch');
	$router->resource('search/employee-all-address', 'employee\AddressController@allAddressEmployeeSearch');

	$router->resource('search/employee-blogs', 'employee\BlogsController@blogsEmployeeSearch');
	$router->resource('search/employee-all-blogs', 'employee\BlogsController@allBlogsEmployeeSearch');

	$router->resource('search/employee-query', 'employee\QueryController@queryEmployeeSearch');
	$router->resource('search/employee-all-query', 'employee\QueryController@allQueryEmployeeSearch');

	$router->resource('search/employee-document', 'employee\DocumentsController@documentEmployeeSearch');
	$router->resource('search/employee-all-document', 'employee\DocumentsController@allDocumentEmployeeSearch');

	$router->resource('search/employee-gallery', 'employee\GalleryController@galleryEmployeeSearch');
	$router->resource('search/employee-all-gallery', 'employee\GalleryController@allGalleryEmployeeSearch');

	$router->resource('search/employee-pages', 'employee\PagesController@pagesEmployeeSearch');
	$router->resource('search/employee-all-pages', 'employee\PagesController@allPagesEmployeeSearch');

	$router->resource('search/employee-university', 'employee\UniversityController@universityEmployeeSearch');
	$router->resource('search/employee-all-university', 'employee\UniversityController@allUniversityEmployeeSearch');

	$router->resource('search/employee-placement', 'employee\PlacementController@placementEmployeeSearch');
	$router->resource('search/employee-all-placement', 'employee\PlacementController@allPlacementEmployeeSearch');

	$router->resource('search/employee-subscribe', 'employee\SubscribeController@subscribeEmployeeSearch');
	$router->resource('search/employee-all-subscribe', 'employee\SubscribeController@allSubscribeEmployeeSearch');

	$router->resource('search/employee-functionalarea', 'employee\FunctionalAreaController@functionalAreaEmployeeSearch');
	$router->resource('search/employee-all-functionalarea', 'employee\FunctionalAreaController@allFunctionalAreaEmployeeSearch');

	$router->resource('search/employee-logs', 'employee\LogsController@logsEmployeeSearch');
	$router->resource('search/employee-all-logs', 'employee\LogsController@allLogEmployeeSearch');

	$router->resource('search/employee-course', 'employee\CourseController@courseEmployeeSearch');
	$router->resource('search/employee-all-course', 'employee\CourseController@allCourseEmployeeSearch');

	$router->resource('search/employee-degree', 'employee\DegreeController@degreeEmployeeSearch');
	$router->resource('search/employee-all-degree', 'employee\DegreeController@allDegreeEmployeeSearch');

	$router->resource('search/employee-facilities', 'employee\FacilitiesController@facilityEmployeeSearch');
	$router->resource('search/employee-all-facilities', 'employee\FacilitiesController@allFacilityEmployeeSearch');

	$router->resource('search/employee-invite', 'employee\InviteController@inviteEmployeeSearch');
	$router->resource('search/employee-all-invite', 'employee\InviteController@allInviteEmployeeSearch');

	$router->resource('search/employee-educationlevel', 'employee\EducationLevelController@educationLevelEmployeeSearch');
	$router->resource('search/employee-all-educationlevel', 'employee\EducationLevelController@allEducationLevelEmployeeSearch');

	$router->resource('search/employee-city-name', 'employee\CityController@cityEmployeeSearch');
	$router->resource('search/employee-all-city-name', 'employee\CityController@allCityEmployeeSearch');

	$router->resource('search/employee-state-name', 'employee\StateController@stateEmployeeSearch');
	$router->resource('search/employee-all-state-name', 'employee\StateController@allStateEmployeeSearch');

	$router->resource('search/employee-application', 'employee\ApplicationController@applicationEmployeeSearch');
	$router->resource('search/employee-all-application', 'employee\ApplicationController@allApplicationEmployeeSearch');

	$router->resource('search/employee-transaction', 'employee\TransactionController@transactionEmployeeSearch');
	$router->resource('search/employee-all-transaction', 'employee\TransactionController@allTransactionEmployeeSearch');

	$router->resource('search/employee-student-profile', 'employee\StudentProfileController@studentProfileEmployeeSearch');
	$router->resource('search/employee-all-student-profile', 'employee\StudentProfileController@allStudentProfileEmployeeSearch');

	$router->resource('search/employee-application-remarks', 'employee\ApplicationStatusMessageController@applicationRemarkEmployeeSearch');
	$router->resource('search/employee-all-application-remarks', 'employee\ApplicationStatusMessageController@allApplicationStatusEmployeeSearch');

	$router->resource('search/employee-query-admissionx', 'employee\QueryController@querySearchAdmissionxEmployee');
	$router->resource('search/employee-all-query-admissionx', 'employee\QueryController@allQuerySearchAdmissionxEmployee');

	$router->resource('search/employee-college-faculty', 'employee\FacultyController@facultyEmployeeSearch');
	$router->resource('search/employee-all-college-faculty', 'employee\FacultyController@allFacultyEmployeeSearch');
	/****************************************************/

	/********* Delete Serarch Record for Employee *********************/
	$router->get('employee/users/delete/{id}','employee\UsersController@deleteEmployeeSearchUser');
	$router->get('employee/collegemaster/delete/{id}','employee\CollegeMasterController@deleteEmployeeSearchCollegeMaster');
	$router->get('employee/event/delete/{id}','employee\EventController@deleteEmployeeSearchEvent');
	$router->get('employee/collegefacilities/delete/{id}','employee\CollegeFacilitiesController@deleteEmployeeSearchFacility');
	$router->get('employee/documents/delete/{id}','employee\DocumentsController@deleteEmployeeSearchDocument');
	$router->get('employee/galleries/delete/{id}','employee\GalleryController@deleteEmployeeSearchGallery');
	$router->get('employee/blogs/delete/{id}','employee\BlogsController@deleteEmployeeSearchBlog');
	$router->get('employee/query/delete/{id}','employee\QueryController@deleteEmployeeSearchQuery');
	$router->get('employee/subscribe/delete/{id}','employee\SubscribeController@deleteEmployeeSearchSubscribe');
	$router->get('employee/pages/delete/{id}','employee\PagesController@deleteEmployeeSearchPages');
	$router->get('employee/logs/delete/{id}','employee\LogsController@deleteEmployeeSearchLogs');
	$router->get('employee/educationlevel/delete/{id}','employee\EducationLevelController@deleteEmployeeSearchEducationLavel');
	$router->get('employee/functionalarea/delete/{id}','employee\FunctionalAreaController@deleteEmployeeSearchFunctionalArea');
	$router->get('employee/degree/delete/{id}','employee\DegreeController@deleteEmployeeSearchDegree');
	$router->get('employee/course/delete/{id}','employee\CourseController@deleteEmployeeSearchCourse');
	$router->get('employee/facilities/delete/{id}','employee\FacilitiesController@deleteEmployeeSearchFacilities');
	$router->get('employee/invite/delete/{id}','employee\InviteController@deleteEmployeeSearchInvite');
	$router->get('employee/university/delete/{id}','employee\UniversityController@deleteEmployeeSearchUniversity');
	$router->get('employee/placement/delete/{id}','employee\PlacementController@deleteEmployeeSearchPlacemant');


	/***** Transaction Graph route ******/
	$router->resource('/employee/transaction-analytics', 'employee\TransactionController@TransactionAnalyticsIndex');
	$router->resource('/employee/search-transaction-analytics', 'employee\TransactionController@searchTransactionAnalyticsIndex');

	/*** PRovisional Letter ***/
	$router->resource('/employee/provisional-letter','employee\ApplicationController@sendProvisionalLetter');

	/**WEBSITE METRICS ACTIONS**/
	$router->resource('/employee/website-analytics', 'employee\LogsController@WebsiteAnalytics');

	//College Contact Card
	$router->get('/employee/collegeprofile-info/contact-card', 'employee\CollegeProfileController@collegeContactCard');
	$router->get('/employee/all-india-engineer-association', 'employee\EngineeringExamController@AllIndiaEngineeringAssociation');
	$router->resource('/employee/engineering-exam', 'employee\EngineeringExamController');

	$router->resource('employee/ads-management', 'administrator\AdsManagementController');

	$router->resource('/employee/request/create-college-account', 'administrator\RequestForCreateCollegeAccountController');
    $router->resource('/employee/college-management-details', 'administrator\CollegeManagementDetailsController');
	$router->resource('/employee/college-scholarship', 'administrator\CollegeScholarshipController');
	$router->resource('/employee/college-cut-offs', 'administrator\CollegeCutOffsController');
	$router->resource('/employee/college-sports-activity', 'administrator\CollegeSportsActivityController');
	$router->resource('/employee/college-faqs', 'administrator\CollegeFaqsController');
	$router->resource('/employee/college-social-media-links', 'administrator\CollegeSocialMediaLinksController');
	$router->resource('/employee/college-reviews', 'administrator\CollegeReviewsController');
	$router->resource('/employee/college-admission-procedure', 'administrator\CollegeAdmissionProcedureController');
	$router->resource('/employee/college-admission-imp-dated', 'administrator\CollegeAdmissionImportantDatedController');
	$router->resource('/employee/college-master-associate-faculty', 'administrator\CollegeMasterAssociateFacultyController');
	$router->resource('/employee/faculty-experience', 'administrator\FacultyExperienceController');
	$router->resource('/employee/faculty-qualification', 'administrator\FacultyQualificationController');
	$router->resource('/employee/faculty-department', 'administrator\FacultyDepartmentController');
	$router->resource('/employee/exam-counselling-form', 'administrator\ExamCounsellingFormController');
	$router->resource('/employee/landing-page-query-form', 'administrator\LandingPageQueryFormController');
	$router->resource('/employee/template', 'administrator\TemplateController');
	$router->resource('/employee/what-we-offer', 'administrator\WhatWeOfferController');
    $router->resource('/employee/slider-manager', 'administrator\SliderManagerController');
	$router->resource('/employee/latest-update', 'administrator\LatestUpdateController');
	$router->resource('/employee/news', 'administrator\NewsController');
	$router->resource('/employee/news-type', 'administrator\NewsTypeController');
	$router->resource('/employee/news-tags', 'administrator\NewsTagsController');
	$router->resource('/employee/ask-question', 'administrator\AskQuestionController');
	$router->resource('/employee/ask-question-tags', 'administrator\AskQuestionTagsController');

    $router->resource('/employee/content', 'administrator\ContentController');
	$router->resource('/employee/contentcategory', 'administrator\ContentcategoryController');
    Route::get('/employee/all-page-contents/{id}', 'administrator\ContentController@allPageContents');

	$router->resource('/employee/seo-content', 'administrator\SeoContentController');
    $router->get('/employee/custom-seo-content', 'administrator\SeoContentController@customSeoContent');
    $router->get('/employee/dynamic-seo-content', 'administrator\SeoContentController@dynamicSeoContent');
    $router->get('/employee/student-seo-content', 'administrator\SeoContentController@studentProfileSeoContent');
    $router->get('/employee/college-seo-content', 'administrator\SeoContentController@collegeProfileSeoContent');
    $router->get('/employee/examination-seo-content', 'administrator\SeoContentController@examinationSeoContent');
    $router->get('/employee/boards-details-seo-content', 'administrator\SeoContentController@boardSeoContent');
    $router->get('/employee/career-relevent-seo-content', 'administrator\SeoContentController@careerReleventSeoContent');
    $router->get('/employee/popular-career-seo-content', 'administrator\SeoContentController@popularCareerSeoContent');
    $router->get('/employee/course-details-seo-content', 'administrator\SeoContentController@courseDetailsSeoContent');
    $router->get('/employee/blog-seo-content', 'administrator\SeoContentController@blogSeoContent');
    $router->get('/employee/exam-section-seo-content', 'administrator\SeoContentController@examSectionSeoContent');
    $router->get('/employee/education-level-seo-content', 'administrator\SeoContentController@educationLevelSeoContent');
    $router->get('/employee/degree-seo-content', 'administrator\SeoContentController@degreeSeoContent');
    $router->get('/employee/functionalarea-seo-content', 'administrator\SeoContentController@functionalareaSeoContent');
    $router->get('/employee/course-seo-content', 'administrator\SeoContentController@coursesSeoContent');
    $router->get('/employee/university-seo-content', 'administrator\SeoContentController@universitySeoContent');
    $router->get('/employee/country-seo-content', 'administrator\SeoContentController@countrySeoContent');
    $router->get('/employee/state-seo-content', 'administrator\SeoContentController@stateSeoContent');
    $router->get('/employee/city-seo-content', 'administrator\SeoContentController@citySeoContent');
    $router->get('/employee/news-seo-content', 'administrator\SeoContentController@newsSeoContent');
    $router->get('/employee/news-tags-seo-content', 'administrator\SeoContentController@newsTagsSeoContent');
    $router->get('/employee/news-type-seo-content', 'administrator\SeoContentController@newsTypeSeoContent');
    $router->get('/employee/ask-question-seo-content', 'administrator\SeoContentController@askQuestionSeoContent');
    $router->get('/employee/ask-question-tag-seo-content', 'administrator\SeoContentController@askQuestionTagsSeoContent');

	$router->get('/employee/all-ask-answers', 'administrator\AskQuestionController@allASKAnswers');
	$router->get('/employee/ask-answers/edit/{id}', 'administrator\AskQuestionController@editASKAnswers');
	$router->get('/employee/ask-answers/show/{id}', 'administrator\AskQuestionController@showASKAnswers');

	$router->get('/employee/all-ask-comments', 'administrator\AskQuestionController@allASKComments');
	$router->get('/employee/ask-comments/edit/{id}', 'administrator\AskQuestionController@editASKComments');
	$router->get('/employee/ask-comments/show/{id}', 'administrator\AskQuestionController@showASKComments');

	$router->resource('/employee/ads-top-college-list', 'administrator\AdsTopCollegeListController');
});