<?php
$router->group(['middleware' => 'adminemployee'], function($router)
{
	Route::resource('counseling/counseling-boards', 'counseling\CounselingBoardsController');
	Route::resource('counseling/counseling-career-interests', 'counseling\CounselingCareerInterestsController');
	Route::resource('counseling/counseling-career-relevant', 'counseling\CounselingCareerRelevantController');
	Route::resource('counseling/counseling-career-details', 'counseling\CounselingCareerDetailsController');
	Route::resource('counseling/counseling-courses-details', 'counseling\CounselingCoursesDetailsController');

	$router->get('counseling/boards/update-form-details/{id}', 'counseling\CounselingBoardsController@updateFormDetails');
	$router->post('/update/counseling-boards-details/{id}','counseling\CounselingBoardsController@updateCounselingBoardDetails');

	$router->get('counseling/courses/update-form-details/{id}', 'counseling\CounselingCoursesDetailsController@updateFormDetails');
	$router->post('/update/counseling-courses-details/{id}','counseling\CounselingCoursesDetailsController@updateCounselingCourseDetails');

	$router->get('counseling/career/update-form-details/{id}', 'counseling\CounselingCareerRelevantController@updateFormDetails');
	$router->post('/update/counseling-career-details/{id}','counseling\CounselingCareerRelevantController@updateCounselingCareerDetails');
});