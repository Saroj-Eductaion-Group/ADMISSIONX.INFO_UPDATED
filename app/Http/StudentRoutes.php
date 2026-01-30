<?php

// Student registration route (outside auth middleware)
$router->post('student-sign-up-action', 'student\studentSignUpController@store');

// Email verification route (outside auth middleware)
$router->get('/verify-student-email-address/{token}', 'student\studentSignUpController@verifyEmailAddress');

// Email validation check route
$router->post('/check-email-exists', function (Illuminate\Http\Request $request) {
	$email = $request->email;
	$exists = DB::table('users')->where('email', $email)->exists();

	return response()->json(['exists' => $exists]);
});

// SMS callback route
$router->post('/sms-callback', 'student\studentSignUpController@smsCallback');

// Test routes
$router->get('/test-sms', 'student\studentSignUpController@testSMS');
$router->get('/test-email', 'student\studentSignUpController@testEmail');

// SMS status check route
$router->get('/sms-status/{id}', function ($id) {
	$sms = DB::table('sms_logs')->where('message_id', $id)->first();
	if ($sms) {
		return response()->json(['status' => $sms->status]);
	}
	return response()->json(['status' => 'not_found'], 404);
});

$router->group(['middleware' => 'auth'], function ($router) {

	$router->get('student/dashboard/edit/{slug}', ['as' => 'student_dash', 'uses' => 'student\StudentDetailController@index']);

	$router->post('student/upload-student-pic', ['as' => 'upload_student_pic', 'uses' => 'student\StudentDetailController@uploadStudentPicture']);
	$router->get('student/delete-student-pic/{galleryId}/{slugUrl}', ['as' => 'delete_student_pic', 'uses' => 'student\StudentDetailController@deleteStudentPic']);

	$router->resource('/student/profilePartial', 'student\StudentDetailController@profileStudentPartial');
	$router->post('/student-profile-partial', 'student\StudentDetailController@profilePartialUpdate');

	$router->resource('/student/addressPartial', 'student\StudentDetailController@addressStudentPartial');
	$router->post('/student-parmanent-address-partial', 'student\StudentDetailController@parmanentAddressPartialUpdate');
	$router->post('/student-present-address-partial', 'student\StudentDetailController@presentAddressPartialUpdate');

	$router->post('student/upload-acedemic-record-image', ['as' => 'upload_academic_record_image', 'uses' => 'student\StudentDetailController@uploadAcademicRecordImage']);
	$router->get('student/delete-student-document/{documentId}/{slugUrl}', ['as' => 'delete_student_logo', 'uses' => 'student\StudentDetailController@deleteStudentAcademicRecord']);
	$router->resource('/student/photoVideoPartial', 'student\StudentDetailController@photoVideoPartial');

	$router->get('/studentMarksPartial', 'student\StudentDetailController@studentMarksPartial');
	$router->get('student/delete-student-marks/{studentmarksId}/{slugUrl}', ['as' => 'delete_student_marks', 'uses' => 'student\StudentDetailController@deleteStudentmarks']);
	$router->post('/student-marks-partial', 'student\StudentDetailController@studentMarksPartialUpdate');
	$router->post('/student-marks-update', 'student\StudentDetailController@studentMarksUpdate');

	$router->resource('/student/projectPartial', 'student\StudentDetailController@projectPartial');
	$router->get('student/delete-uploaded-document/{documentId}/{slugUrl}', ['as' => 'delete_project_document', 'uses' => 'student\StudentDetailController@deleteUploadedDocument']);
	$router->get('student/delete-project-description/{documentId}/{slugUrl}', ['as' => 'delete_project_document', 'uses' => 'student\StudentDetailController@deleteProjectDocument']);

	$router->post('student/updatecollege-project-desc', 'student\StudentDetailController@uploadProjectDesc');
	$router->get('/projectPartialLoad', 'student\StudentDetailController@projectPartialLoad');
	$router->post('/student-project-desc-update', 'student\StudentDetailController@projectPartialLoadUpdate');
	$router->get('/getCurrentDateCalculate', 'student\StudentDetailController@getCurrentDateCalculate');

	$router->resource('/student/accountSetting', 'student\StudentDetailController@studentAccountSetting');
	$router->post('/student-account-setting-partials-update', 'student\StudentDetailController@studentAccountSettingPartialsUpdate');
	$router->post('student/update-application-status', 'student\StudentDetailController@updateStudentApplicationStatus');
	/********* End Student Profile Routes***************************/

	/******** Student Profile Show Routes ******************************/
	$router->get('/student/{slug}/', 'student\StudentProfileShowController@index');
	$router->post('/student/profilePartialShow', 'student\StudentProfileShowController@profilePartialShow');
	$router->post('/student/addressPartialShow', 'student\StudentProfileShowController@addressPartialShow');
	$router->post('/student/photoDocumentPartialShow', 'student\StudentProfileShowController@photoDocumentPartialShow');
	$router->post('/student/projectPartialShow', 'student\StudentProfileShowController@projectPartialShow');
	/********* End Student Profile Show Routes***************************/

	//$router->get('student/apply-course-details/{collegemasterId}/{slugUrl}', ['as' => 'student_course_details', 'uses' => 'student\studentApplyCourseController@applyCourseDetails']);
	$router->get('student/apply-course-details/{collegemasterId}/{slugUrl}', ['as' => 'student_course_details', 'uses' => 'student\studentApplyCourseController@applyCourseFormDetails']);


	$router->post('/student-course-apply-details', 'student\studentApplyCourseController@studentProfileApplyCourseUpdate');

	//ON SUCCESS PAYMENT
	$router->post('/transaction/process-payment/{id}', 'student\studentApplyCourseController@processPaymentAdmission');
	//ON FAILURE PAYMENT
	$router->post('/transaction/process-failure-payment/{id}', 'student\studentApplyCourseController@processFailurePaymentAdmission');
	/***************PAYMENT PROCESS ROUTES******************/

	/***************End Student apply course routes******************/

	/***************************** Student Bookmark Routes**********************************************/
	$router->post('student/add-bookmark', 'student\StudentBookmarkController@addBookmark');
	$router->get('/get-bookmark-course/student', 'student\StudentBookmarkController@getBookmarkCoursePartials');
	$router->get('/get-bookmark-college/student', 'student\StudentBookmarkController@getBookmarkCollegePartials');
	$router->get('/get-bookmark-blogs/student', 'student\StudentBookmarkController@getBookmarkBlogsPartials');

	$router->get('student/check-applications/{option}', 'student\StudentBookmarkController@checkStudentApplications');
	$router->get('student/check-bookmark/{option}', 'student\StudentBookmarkController@checkStudentBookmark');
	$router->get('student/delete-bookmark/{id}', 'student\StudentBookmarkController@deleteBookmark');
	$router->get('student/application-detail/{slug}/{applicationId}', 'student\StudentBookmarkController@detailsStudentApplications');

	/************************ Remove Bookmarked************************/
	$router->post('/remove-selected-bookmarked', 'student\StudentBookmarkController@removeSelectedBookmarked');
	/************************ END************************/


	/*** Re-apply appliation payment *****/
	$router->get('/student-course-re-apply/{slug}/{applicationId}', 'student\studentApplyCourseController@studentReapplyCourse');


	$router->get('/documentPartialLoadStudent', 'student\StudentDetailController@documentPartialLoadStudent');
	$router->post('/student-document-caption-update', 'student\StudentDetailController@documentPartialLoadUpdate');

	$router->any('/failure-payment-details', 'student\studentApplyCourseController@failurePayment');
	$router->any('/success-payment-details', 'student\studentApplyCourseController@successPayment');


	$router->any('/payment-failed/{id}', 'student\studentApplyCourseController@handleFailurePaymentAction');
	$router->any('/payment-success/{id}', 'student\studentApplyCourseController@handleSuccessPaymentAction');

	$router->get('/student/counselling/{slug}/forms', 'student\StudentDetailController@studentCounsellingForms');

	$router->get('/student/review-forms/{slug}/edit/{id}', 'student\StudentDetailController@studentReviewFormsEdit');
	$router->post('/student/review-forms/{slug}/update', 'student\StudentDetailController@studentReviewFormsUpdate');
	$router->post('/student/review-forms/{slug}/delete/{id}', 'student\StudentDetailController@studentReviewFormsDelete');

	// Test email route
	$router->get('/test-email', 'student\studentSignUpController@testEmail');

	// Test SMS route (inside auth)
	$router->get('/test-sms-auth', 'student\studentSignUpController@testSMS');

	// SMS logs view route
	$router->get('/sms-logs', function () {
		$logs = DB::table('sms_logs')->orderBy('created_at', 'desc')->paginate(20);
		return view('administrator.sms-logs', compact('logs'));
	});

	// Seed dummy course data
	$router->get('/seed-dummy-course', function () {
		require_once database_path('seeds/DummyCourseSeeder.php');
		$seeder = new DummyCourseSeeder();
		$seeder->run();
		return response()->json(['message' => 'Dummy course data seeded successfully']);
	});

	// Fix payment status
	$router->get('/fix-payment-status', function () {
		try {
			DB::table('paymentstatus')->insert([
				'id' => 1,
				'name' => 'Success',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			]);
			return response()->json(['message' => 'Payment status fixed']);
		} catch (Exception $e) {
			return response()->json(['message' => 'Payment status already exists or error: ' . $e->getMessage()]);
		}
	});

	// Show available courses
	$router->get('/available-courses', 'test\TestController@showAvailableCourses');
});

/***************Payment Process From PAYUBIZ******************/
$router->post('/student-payment-process-start/{id}', 'student\studentApplyCourseController@processPaymentNowForStudent');

/***************Easebuzz Payment Routes******************/
$router->post('/easebuzz/payment/success', 'easebuzz\EasebuzzController@handleResponse');
$router->post('/easebuzz/payment/failure', 'easebuzz\EasebuzzController@handleResponse');

/***************End Student apply course routes******************/

// Student details page after registration
$router->get('/student/{slug}/details', 'student\studentSignUpController@detailsSignUp');

// Student registration success page
$router->get('/sucess-signup', 'student\studentSignUpController@sucessSignUp');
