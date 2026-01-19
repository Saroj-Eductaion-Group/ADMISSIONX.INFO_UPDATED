<?php
$router->group(['middleware' => 'auth'], function($router)
{
	/**START QUERY ROUTES **********************************************************/
	$router->post('/student-for-college', 'query\college\QueryCollegeController@studentForCollege');

	$router->get('college/check-queries/{slug}', 'query\college\QueryCollegeController@checkQueriesForCollege');
	$router->get('college/query-detail/{slug}/{queryId}', 'query\college\QueryCollegeController@queryDetailForCollege');
	$router->get('college/query-detail-bya-admin/{slug}/{queryId}', 'query\college\QueryCollegeController@queryDetailForByaAdmin');
	$router->get('college/check-queries-status/{option}', 'query\college\QueryCollegeController@checkQueriesForCollegeStatus');

	$router->post('college/update-comment-query', 'query\college\QueryCollegeController@updateCommentQuery');
	$router->post('college/update-comment-query-to-bya', 'query\college\QueryCollegeController@updateCommentQueryToBya');


	$router->get('student/check-queries/{option}', 'query\student\QueryStudentController@checkQueriesForStudent');

	$router->get('student/query-detail/{option}/{queryId}', 'query\student\QueryStudentController@queryDetailForStudent');
	$router->get('student/query-detail-bya-admin/{option}/{queryId}', 'query\student\QueryStudentController@queryDetailForByaAdmin');

	$router->post('student/update-comment-query', 'query\student\QueryStudentController@updateCommentQuery');
	$router->post('student/update-comment-query-to-bya', 'query\student\QueryStudentController@updateCommentQueryToBya');
	/**END**********************************************************/


	/**************** Contact Us Route *******************************/
	$router->post('/contact-us-detail-query', 'query\admin\QueryAdminController@contactUsForm');
	$router->resource('sendSms', 'query\admin\QueryAdminController@sendSms');
});