<?php
$router->group(['middleware' => 'auth'], function($router)
{
	/*************City State Ajax Controller *****************************************************/
	$router->get('/getCityTotal', 'college\quickSignUpController@getCityTotal');
	/*************************************************************************************************************/

	/**VERIFY EMAIL ADDRESS FOR LOGIN ACTIONS**************************************************************************************/
	$router->get('verify-email-address/{token}', 'college\quickSignUpController@verifyEmailAddress');
	$router->get('resend-college-email-link/{emailAddress}', 'college\quickSignUpController@resendEmailAddressLink');
	/*************************************************************************************************************/


	/**************************** College Routes ************************************************/

	/********* College Dashboard Route***********************************************************/
	//$router->get('/college/dashboard/{slug}', 'college\CollegeController@index');
	$router->get('college/dashboard/edit/{slug}', ['as' => 'college_dash', 'uses' => 'college\CollegeController@index']);

	/*************** GET PARTIAL TEMPLATE ROUTES FOR COLLEGE DASHBOARD****/
	$router->resource('/college/profilePartial', 'college\CollegeController@profilePartial');
	$router->resource('/college/photoVideoPartial', 'college\CollegeController@photoVideoPartial');
	$router->resource('/college/achievementsPartial', 'college\CollegeController@achievementPartial');
	$router->resource('/college/placementPartial', 'college\CollegeController@placementPartial');
	$router->resource('/college/addressPartial', 'college\CollegeController@addressPartial');
	$router->get('/courseMasterPartial', 'college\CollegeController@courseMasterPartial');
	$router->get('/galleryPartialLoad', 'college\CollegeController@galleryPartialLoad');
	$router->get('/documentPartialLoad', 'college\CollegeController@documentPartialLoad');
	$router->get('/calenderEventPartial', 'college\CollegeController@calenderEventPartial');
	$router->get('/collegeFacilityPartial', 'college\CollegeController@collegeFacilityPartial');
	$router->get('/college/managementPartial', 'college\CollegeController@managementPartial');
	$router->get('/managementDetailsPartial', 'college\CollegeController@managementDetailsPartial');
	$router->get('/college/scholarshipPartial', 'college\CollegeController@scholarshipPartial');
	$router->get('/scholarshipPartial', 'college\CollegeController@scholarshipDetailsPartial');
	$router->get('/college/facilitiesPartial', 'college\CollegeController@facilitiesPartial');
	$router->get('/college/coursesPartial', 'college\CollegeController@coursesPartial');
	$router->get('/college/eventsPartial', 'college\CollegeController@eventsPartial');
	$router->get('/placementUpdatePartial', 'college\CollegeController@placementUpdatePartial');
	$router->get('/college/sportsActivityPartial', 'college\CollegeController@sportsActivityPartial');
	$router->get('/sportsActivityUpdatePartial', 'college\CollegeController@sportsActivityUpdatePartial');
	$router->get('/college/collegeCutOffPartial', 'college\CollegeController@collegeCutOffPartial');
	$router->get('/collegeCutOffUpdatePartial', 'college\CollegeController@collegeCutOffUpdatePartial');
	

	$router->get('/get-account-setting-partials/college', 'college\CollegeController@getAccountSettingPartials');
	$router->post('/get-account-setting-partials/college/update', 'college\CollegeController@getAccountSettingPartialsUpdate');

	$router->get('/get-affiliattion-letters/college', 'college\CollegeController@getAffiliattionLettersPartials');
	$router->post('/get-affiliattion-letters/college/update', 'college\CollegeController@getAffiliattionLettersPartialsUpdate');

	$router->get('/affiliationPartialLoad', 'college\CollegeController@affiliationPartialLoad');
	$router->post('/college-affiliation-caption-update', 'college\CollegeController@affiliationPartialLoadpdate');

	$router->get('/get-banner-image-partials/college', 'college\CollegeController@getBannerImagePartials');
	$router->post('/get-banner-image-partials/college/update', 'college\CollegeController@getBannerImagePartialsUpdate');

	$router->get('/get-facebook-widget-partials', 'college\CollegeController@getFacebookWidgetPartials');
	$router->post('/update-facebook-widget-partials', 'college\CollegeController@getFacebookWidgetPartialsUpdate');

	$router->get('/get-social-link-management-partials', 'college\CollegeController@getSocialLinkPartials');
	$router->post('/update-social-link-management-partials', 'college\CollegeController@getSocialLinkPartialsUpdate');


	$router->post('/check-facebook-page-exists', 'college\CollegeController@checkFacebookPageExists');

	$router->get('college/check-applications/{slug}', 'college\CollegeController@checkApplications');
	$router->get('college/application-detail/{slug}/{applicationId}', 'college\CollegeController@detailsForApplications');
	$router->post('college/update-application-status', 'college\CollegeController@updateApplicationStatus');
	$router->get('college/check-application-status/{option}', 'college\CollegeController@checkCollegeApplications');
	/*************** END PARTIAL TEMPLATE ROUTES FOR COLLEGE DASHBOARD *************************/

	/**************** Update College Dashboard Template Routes*******************************/
	$router->post('/college-profile-partial', 'college\CollegeController@profilePartialUpdate');
	$router->post('/college-placement-partial', 'college\CollegeController@placementPartialUpdate');
	$router->post('/college-registered-address-partial', 'college\CollegeController@registeredAddressPartialUpdate');
	$router->post('/college-campus-address-partial', 'college\CollegeController@campusAddressPartialUpdate');
	$router->post('/college-course-partial', 'college\CollegeController@courseMasterCreate');
	$router->post('/college-course-master-update', 'college\CollegeController@courseMasterUpdate');
	$router->post('/college-gallery-caption-update', 'college\CollegeController@galleryPartialLoadUpdate');
	$router->post('/college-document-caption-update', 'college\CollegeController@documentPartialLoadUpdate');
	$router->post('/college-event-partial', 'college\CollegeController@eventPartialUpdate');
	$router->post('/college-calender-event-update', 'college\CollegeController@calenderEventUpdate');
	$router->post('/college-facilities-partial', 'college\CollegeController@facilityPartialUpdate');
	$router->post('/college-facility-update', 'college\CollegeController@collegeFacilityUpdate');
	$router->post('/college-management-partial', 'college\CollegeController@managementDetailsCreatePartial');
	$router->post('/college-management-update', 'college\CollegeController@managementDetailsUpdatePartial');
	$router->post('/college-scholarship-partial', 'college\CollegeController@scholarshipCreatePartial');
	$router->post('/college-scholarship-update', 'college\CollegeController@scholarshipUpdatePartial');
	$router->post('/college-placement-created', 'college\CollegeController@placementPartialCreated');
	$router->post('/college-sports-activity-create', 'college\CollegeController@sportsActivityCreate');
	$router->post('/college-sports-activity-update', 'college\CollegeController@sportsActivityUpdate');
	$router->post('/college-cut-offs-create', 'college\CollegeController@collegeCutOffCreate');
	$router->post('/college-cut-offs-update', 'college\CollegeController@collegeCutOffUpdate');

	//delete-college-master
	/**************** End College Dashboard Template Routes*******************************/



	/*************** COLLEGE PROFILE SHOW ROUTES FOR COLLEGE DASHBOARD****/
	$router->get('/college/{slug}', 'college\CollegeProfileShowController@collegeProfileDetails');
	$router->get('/college/{slug}/faculty','college\CollegeProfileShowController@collegeProfileFacultyList');
	$router->get('/college/{slug}/reviews','college\CollegeProfileShowController@collegeProfileReviewsList');
	$router->get('/college/{slug}/admission-procedure','college\CollegeProfileShowController@collegeAdmissionProcedureList');
	$router->get('/college/{slug}/faqs','college\CollegeProfileShowController@collegeFaqsList');
	$router->get('/old/college/{slug}', 'college\CollegeProfileShowController@index');
	$router->post('/college/profilePartialShow', 'college\CollegeProfileShowController@profilePartialShow');
	$router->post('/college/addressPartialShow', 'college\CollegeProfileShowController@addressPartialShow');
	$router->post('/college/photoVideoPartialShow', 'college\CollegeProfileShowController@photoVideoPartialShow');
	$router->post('/college/achievementsPartialShow', 'college\CollegeProfileShowController@achievementsPartialShow');
	$router->post('/college/placementPartialShow', 'college\CollegeProfileShowController@placementPartialShow');
	$router->post('/college/courseListShow', 'college\CollegeProfileShowController@courseListShow');
	$router->post('college/reviewPartialShow', 'college\CollegeProfileShowController@reviewListShow');
	$router->post('college/scholarshipPartialShow', 'college\CollegeProfileShowController@scholarshipListShow');
	$router->post('college/facultyPartialShow', 'college\CollegeProfileShowController@facultyListShow');
	/*************** END COLLEGE PROFILE SHOW ROUTES FOR COLLEGE DASHBOARD *************************/
});

/****************Fetch College Logo on College Dashboard ********/
Route::get('collegeLogoPathImages/{imagename}', function($imagename = null)
{
	if (Auth::check())
	{
		$userId = Auth::id();
		$roleGrant = App\User::where('id', '=', $userId)->first();
		
		if( $roleGrant->userrole_id == '2' && $roleGrant->userstatus_id == '1' )
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
/****************End College Logo on College Dashboard ********/

/****************Fetch Gallery and Document on College Profile Dashboard (Video & Photo Partial) ********/
Route::get('collegeGalleryPathImages/{imagename}', function($imagename = null)
{
	if (Auth::check())
	{
		$userId = Auth::id();
		$roleGrant = App\User::where('id', '=', $userId)->first();
		if( $roleGrant->userrole_id == '2' && $roleGrant->userstatus_id == '1' )
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

Route::get('collegeDocumentPathImages/{imagename}', function($imagename = null)
{
	if (Auth::check())
	{
		$userId = Auth::id();
		$roleGrant = App\User::where('id', '=', $userId)->first();
		
		if( $roleGrant->userrole_id == '2' && $roleGrant->userstatus_id == '1' )
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
/****************End Gallery and Document on College Profile Dashboard (Video & Photo Partial) ********/

$router->group(['middleware' => 'auth'], function($router)
{
	/**************** ROUTES FOR IMAGE UPLOADING IN GALLERY N VIDEOS  ********/
	$router->post('college/upload-college-logo', ['as' => 'upload_college_logo', 'uses' => 'college\CollegeProfileDetailController@uploadCollegeLogo']);
	$router->get('college/delete-college-logo/{galleryId}/{slugUrl}', ['as' => 'delete_college_logo', 'uses' => 'college\CollegeProfileDetailController@deleteCollegeLogo']);
	$router->get('college/delete-college-gallery/{galleryId}/{slugUrl}', ['as' => 'delete_college_logo', 'uses' => 'college\CollegeProfileDetailController@deleteCollegeGallery']);
	$router->post('college/updatecollege-video-url', 'college\CollegeProfileDetailController@uploadCollegeVideoUrl');
	$router->post('college/updatecollege-awards-desc', 'college\CollegeProfileDetailController@uploadCollegeAwardsDesc');

	$router->get('college/delete-college-affiliation/{galleryId}/{slugUrl}', ['as' => 'delete_college_affiliation', 'uses' => 'college\CollegeProfileDetailController@deleteCollegeAffiliation']);

	/**GALLERY IMAGE UPLOAD ACTIONS**********************************************************************/
	$router->post('college/upload-gallery-image', ['as' => 'upload_gallery_image', 'uses' => 'college\CollegeProfileDetailController@uploadGalleryImage']);
	$router->post('college/upload-document-image', ['as' => 'upload_document_image', 'uses' => 'college\CollegeProfileDetailController@uploadDocumentImage']);

	$router->post('college/upload-affiliation-letters-image', ['as' => 'upload_affiliation_letters_image', 'uses' => 'college\CollegeProfileDetailController@uploadAffiliationLettersImage']);


	$router->get('college/delete-uploaded-document/{galleryId}/{slugUrl}', ['as' => 'delete_uploaded_document', 'uses' => 'college\CollegeProfileDetailController@deleteUploadedDocument']);
	/****************End ROUTES FOR IMAGE UPLOADING IN GALLERY N VIDEOS ********/


	$router->get('college/delete-event/{eventId}/{slugUrl}', ['as' => 'delete_event', 'uses' => 'college\CollegeController@deleteEvent']);
	$router->get('college/delete-college-master/{collegemasterId}/{slugUrl}', ['as' => 'delete_college_master', 'uses' => 'college\CollegeController@deleteCollegeMaster']);

	$router->get('college/delete-college-facility/{collegefacilitiesId}/{slugUrl}', ['as' => 'delete_college_facility', 'uses' => 'college\CollegeController@deleteCollegeFacility']);
	$router->get('/college/delete-college-management-details/{managementId}/{slugUrl}', ['as' => 'delete_college_management', 'uses' => 'college\CollegeController@deleteCollegeManagentDetail']);

	$router->get('/college/delete-college-scholarship-details/{scholarshipId}/{slugUrl}', ['as' => 'delete_college_scholarship', 'uses' => 'college\CollegeController@deleteCollegeScholarship']);

	$router->get('college/delete-placement/{placementId}/{slugUrl}', ['as' => 'delete_placement', 'uses' => 'college\CollegeController@deletePlacement']);

	$router->get('college/delete-sports-activity/{collegeSportsActivityId}/{slugUrl}', ['as' => 'delete_sports_activity', 'uses' => 'college\CollegeController@deleteCollegeSportsActivity']);

	$router->get('college/delete-cut-offs/{collegeCutOffId}/{slugUrl}', ['as' => 'delete_cut_offs', 'uses' => 'college\CollegeController@deleteCollegeCutOff']);
	


	/***************************AJAX ROUTES******************************************************************/
	$router->get('getAllDegreeName', 'college\CollegeAjaxController@getAllDegreeName');
	$router->get('getAllCourseName', 'college\CollegeAjaxController@getAllCourseName');
	$router->get('getAllStateName', 'college\CollegeAjaxController@getAllStateName');
	$router->get('getAllCityName', 'college\CollegeAjaxController@getAllCityName');
	$router->get('getAllExamCityName', 'college\CollegeAjaxController@getAllExamCityName');
	$router->get('getFunctionalAreaName', 'college\CollegeAjaxController@getFunctionalAreaName');
	$router->get('getUniversityName', 'college\CollegeAjaxController@getUniversityName');
	$router->get('getAllExamDegreeName', 'college\CollegeAjaxController@getAllExamDegreeName');
	$router->get('/fetch-asssociated-faculty-list', 'college\CollegeAjaxController@fetchAsssociatedFacultyList');

	$router->get('autocomplete/getCollegeFullName', 'college\CollegeAjaxController@getCollegeFullName');
	$router->post('getAllCollegeAmenitiesView', 'college\CollegeAjaxController@getAllCollegeAmenitiesView');


	$router->post('get-all-degree-multi-by-stream', 'college\CollegeAjaxController@getAllDegreeMultiByStream');
	/**FILTER API CALL*******************************************************************************************/
	// $router->get('/explore/college', 'college\CollegeAjaxController@collegeFilterOnParams');
	$router->post('/explore/multi/college', 'college\CollegeAjaxController@collegeFilterOnParamsMulti');

	$router->get('/explore/college', 'college\CollegeAjaxController@filterCollegeData');
	/*********************************************************************************************/




	/**VERIFY EMAIL ADDRESS FOR STUDENT LOGIN ACTIONS*************************************************************/
	$router->get('verify-student-email-address/{token}', 'student\studentSignUpController@verifyEmailAddress');
	$router->get('resend-email-link/{emailAddress}', 'student\studentSignUpController@resendEmailAddressLink');
	/*************************************************************************************************************/


	/********* Course Detail Routes *******************************/
	//$router->get('college/detail-course/{collegemasterId}/{slugUrl}', ['as' => 'course_college_master', 'uses' => 'college\CollegeProfileShowController@applyCourses']);
	$router->get('college/detail-course/{collegemasterId}/{slugUrl}', ['as' => 'course_college_master', 'uses' => 'college\CollegeProfileShowController@collegeCourseDetails']);

	//College Matrix
	$router->get('college/check-matrix/{slug}', 'college\CollegeController@checkMatrixForCollege');

	//College Terms & Conditions
	$router->get('college/terms-conditions/{slug}', 'college\CollegeController@collegeTermsConditions');

	/*********************************************************************************************************
	*	manager faculty members
	*********************************************************************************************************/
	$router->get('college/faculty/{slug}','college\CollegeController@listFacultyAction');
	$router->get('college/faculty/{slug}/create','college\CollegeController@createFacultyAction');
	$router->post('college/faculty/{slug}/store','college\CollegeController@storeFacultyAction');
	$router->get('college/faculty/{slug}/{id}','college\CollegeController@showFacultyAction');
	$router->get('college/faculty/{slug}/edit/{id}','college\CollegeController@editFacultyAction');
	$router->post('college/faculty/{slug}/update','college\CollegeController@updateFacultyAction');
	$router->post('college/faculty/{slug}/remove/{id}','college\CollegeController@removeFacultyAction');


	/*********************************************************************************************************
	*	manager faculty members
	*********************************************************************************************************/
	$router->get('college/faqs/{slug}','college\CollegeController@listFaqsAction');
	$router->get('college/faqs/{slug}/create','college\CollegeController@createFaqsAction');
	$router->post('college/faqs/{slug}/store','college\CollegeController@storeFaqsAction');
	$router->get('college/faqs/{slug}/edit/{id}','college\CollegeController@editFaqsAction');
	$router->post('college/faqs/{slug}/update','college\CollegeController@updateFaqsAction');
	$router->post('college/faqs/{slug}/remove/{id}','college\CollegeController@removeFaqsAction');

	$router->get('college/transaction-list/{slug}','college\CollegeController@listTransactionAction');

	/*********************************************************************************************************
	*	manager admission procedure
	*********************************************************************************************************/
	$router->get('college/admission-procedure/{slug}','college\CollegeController@listAdmissionProcedureAction');
	$router->get('college/admission-procedure/{slug}/create','college\CollegeController@createAdmissionProcedureAction');
	$router->post('college/admission-procedure/{slug}/store','college\CollegeController@storeAdmissionProcedureAction');
	$router->get('college/admission-procedure/{slug}/{id}','college\CollegeController@showAdmissionProcedureAction');
	$router->get('college/admission-procedure/{slug}/edit/{id}','college\CollegeController@editAdmissionProcedureAction');
	$router->post('college/admission-procedure/{slug}/update','college\CollegeController@updateAdmissionProcedureAction');
	$router->post('college/admission-procedure/{slug}/remove/{id}','college\CollegeController@removeAdmissionProcedureAction');
});
