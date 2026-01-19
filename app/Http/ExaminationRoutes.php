<?php
$router->group(['middleware' => 'adminemployee'], function($router)
{
	$router->resource('examination/exam-section', 'examination\ExamSectionController');
	$router->resource('examination/type-of-examination', 'examination\TypeOfExaminationController');
	$router->resource('examination/examination-type', 'examination\ExaminationTypeController');
	$router->resource('examination/application-and-exam-status', 'examination\ApplicationAndExamStatusController');
	$router->resource('examination/application-mode', 'examination\ApplicationModeController');
	$router->resource('examination/examination-mode', 'examination\ExaminationModeController');
	$router->resource('examination/eligibility-criteria', 'examination\EligibilityCriteriaController');
	$router->resource('examination/examination-details', 'examination\ExaminationDetailsController');

	$router->get('/examination/all-exam-question', 'examination\TypeOfExaminationController@allExamQuestion');
	$router->get('/examination/exam-question/edit/{id}', 'examination\TypeOfExaminationController@editExamQuestion');
	$router->get('/examination/exam-question/show/{id}', 'examination\TypeOfExaminationController@showExamQuestion');
	$router->post('/examination/exam-question/update/{examId}/{questionId}', 'examination\TypeOfExaminationController@updateExamQuestionAdmin');

	$router->get('/examination/all-exam-answers', 'examination\TypeOfExaminationController@allExamAnswers');
	$router->get('/examination/exam-answers/edit/{id}', 'examination\TypeOfExaminationController@editExamAnswer');
	$router->get('/examination/exam-answers/show/{id}', 'examination\TypeOfExaminationController@showExamAnswer');
	$router->post('/examination/exam-question/update/{examId}/{questionId}/{answerId}', 'examination\TypeOfExaminationController@updateExamAnswerAdmin');

	$router->get('/examination/all-exam-comments', 'examination\TypeOfExaminationController@allExamComments');
	$router->get('/examination/exam-comments/edit/{id}', 'examination\TypeOfExaminationController@editExamComments');
	$router->get('/examination/exam-comments/show/{id}', 'examination\TypeOfExaminationController@showExamComments');
	$router->post('/examination/exam-question/update/{examId}/{questionId}/{answerId}/{commentId}', 'examination\TypeOfExaminationController@updateExamCommentAdmin');

	$router->get('examination/review-and-update-form-details/{id}', 'examination\ExaminationDetailsController@reviewAndUpdateExamFormDetails');
	
	$router->post('/update/examination-details/{examId}','examination\ExaminationDetailsController@updateExamDetails');
	$router->post('/update/exam-application-process/{examId}','examination\ExaminationDetailsController@updateExamApplicationProcess');
	$router->post('/update/exam-eligibilities/{examId}','examination\ExaminationDetailsController@updateExamEligibility');
	$router->post('/update/exam-dates/{examId}','examination\ExaminationDetailsController@updateExamDates');
	$router->post('/update/exam-examination-syllabus/{examId}','examination\ExaminationDetailsController@updateExaminationSyllabus');
	$router->post('/update/examination-patterns/{examId}','examination\ExaminationDetailsController@updateExaminationPatterns');
	$router->post('/update/exam-admit-card/{examId}','examination\ExaminationDetailsController@updateExamAdmitCard');
	$router->post('/update/exam-results/{examId}','examination\ExaminationDetailsController@updateExamResults');
	$router->post('/update/exam-cut-offs/{examId}','examination\ExaminationDetailsController@updateExamCutOffs');
	$router->post('/update/exam-counselling-procedure/{examId}','examination\ExaminationDetailsController@updateExamCounsellingProcedure');
	$router->post('/update/examination-prepration/{examId}','examination\ExaminationDetailsController@updateExamPrepration');
	$router->post('/update/exam-answer-keys/{examId}','examination\ExaminationDetailsController@updateExamAnswerKeys');
	$router->post('/update/exam-reference-links/{examId}','examination\ExaminationDetailsController@updateReferenceLinks');
	$router->post('/update/exam-analysis-records/{examId}','examination\ExaminationDetailsController@updateExamAnalysisRecords');
	$router->post('/update/exam-faqs/{examId}','examination\ExaminationDetailsController@updateExamFaqs');
	$router->post('/update/exam-question/{examId}','examination\ExaminationDetailsController@addExamQuestionByAdmin');
	$router->post('/update/exam-question-answer/{examId}/{questionId}','examination\ExaminationDetailsController@addExamQuestionAnswerByAdmin');
	$router->post('/update/exam-question-answer-comment/{examId}/{questionId}/{answerId}','examination\ExaminationDetailsController@addExamQuestionAnswerCommentByAdmin');

	$router->get('/delete/exam-answer-key-events/{examId}/{answerKeyId}','examination\ExaminationDetailsController@deleteExamAnswerKeyEvents');
	$router->get('/delete-exam/question/{examId}/{questionId}','examination\ExaminationDetailsController@deleteExamQuestion');
	$router->get('/delete-exam/question-answer/{examId}/{questionId}/{answerId}','examination\ExaminationDetailsController@deleteExamQuestionAnswer');
	$router->get('/delete-exam/question-answer-comments/{examId}/{questionId}/{answerId}/{commentId}','examination\ExaminationDetailsController@deleteExamQuestionAnswerComment');

	$router->get('/get-examination-details-partial/{examId}','examination\ExaminationDetailsController@getExaminationDetailsPartial');
	$router->get('/get-application-processes-partial/{examId}','examination\ExaminationDetailsController@getApplicationProcessesPartial');
	$router->get('/get-exam-eligibilities-partial/{examId}','examination\ExaminationDetailsController@getExamEligibilitiesPartial');
	$router->get('/get-exam-dates-partial/{examId}','examination\ExaminationDetailsController@getExamDatesPartial');
	$router->get('/get-exam-syllabus-papers-partial/{examId}','examination\ExaminationDetailsController@getExamSyllabusPapersPartial');
	$router->get('/get-exam-patterns-partial/{examId}','examination\ExaminationDetailsController@getExamPatternsPartial');
	$router->get('/get-exam-admit-cards-partial/{examId}','examination\ExaminationDetailsController@getExamAdmitCardsPartial');
	$router->get('/get-exam-results-partial/{examId}','examination\ExaminationDetailsController@getExamResultsPartial');
	$router->get('/get-exam-cut-offs-partial/{examId}','examination\ExaminationDetailsController@getExamCutOffsPartial');
	$router->get('/get-exam-counsellings-partial/{examId}','examination\ExaminationDetailsController@getExamCounsellingsPartial');
	$router->get('/get-exam-prepration-tips-partial/{examId}','examination\ExaminationDetailsController@getExamPreprationTipsPartial');
	$router->get('/get-exam-answer-key-partial/{examId}','examination\ExaminationDetailsController@getExamAnswerKeyPartial');
	$router->get('/get-exam-analysis-records-partial/{examId}','examination\ExaminationDetailsController@getExamAnalysisRecordsPartial');
	$router->get('/get-examination-reference-links-partial/{examId}','examination\ExaminationDetailsController@getExaminationReferenceLinksPartial');
	$router->get('/get-exam-faqs-partial/{examId}','examination\ExaminationDetailsController@getExamFaqsPartial');
	$router->get('/get-ask-exam-questions-partial/{examId}','examination\ExaminationDetailsController@getAskExamQuestionsPartial');
	$router->get('/get-ask-exam-questions-answer-partial/{examId}/{questionId}','examination\ExaminationDetailsController@getAskExamQuestionsAnswerPartial');

});