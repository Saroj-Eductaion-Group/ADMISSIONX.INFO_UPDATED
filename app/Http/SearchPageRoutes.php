<?php
//Home Page typehaead search route
Route::get('/api/home-page-search-list', 'website\SearchPageController@homePageSearchList');

/*********** Search Page Routes Start **************************************/
Route::get('/search', 'website\SearchPageController@searchCollegeListPage');
Route::get('/top-colleges', 'website\SearchPageController@topCollegeListPage');

//Study Abroad List & Study Abroad College List Route
Route::get('/study-abroad', 'website\SearchPageController@studyAbroadListPage');
Route::get('/study-abroad/{country}/states', 'website\SearchPageController@countryStateList');
Route::get('/study-abroad/{country}/{state}/cities', 'website\SearchPageController@countryStateCityList');
//Study Abroad List & Study Abroad College List Route
Route::get('/{pageslug}/college-list', 'website\SearchPageController@studyAbroadCollegeListPage');
//Study Abroad State Wise College List Route
Route::get('/{state}/{country}/college-list', 'website\SearchPageController@stateCollegeListPage');
//Study Abroad City Wise College List Route
Route::get('/{city}/{state}/{country}/college-list', 'website\SearchPageController@cityCollegeListPage');
//Top courses List & College List Route
Route::get('/top-courses', 'website\SearchPageController@topCoursesListPage');
//education level & Funcational area
Route::get('/{pageslug}/colleges', 'website\SearchPageController@streamAndEduLevelCollegeListPage');
//Degree College List
Route::get('{stream}/{degree}/colleges', 'website\SearchPageController@degreeCollegeListPage');
//Courses College List
Route::get('{stream}/{degree}/{courses}/colleges', 'website\SearchPageController@coursesCollegeListPage');

//University List & University College List Route
Route::get('/top-university', 'website\SearchPageController@topUniversityListPage');
Route::get('/university/{pageslug}', 'website\SearchPageController@universityCollegeListPage');

/*********** Search Page Routes End **************************************/

/*********** Stream/Degree/Courses Page Routes Start **************************************/
Route::get('/stream', 'website\SearchPageController@streamList');
Route::get('/stream/{functionalarea}/degree', 'website\SearchPageController@streamDegreeList');
Route::get('/stream/{functionalarea}/{degree}/courses', 'website\SearchPageController@streamDegreeCourseList');
/*********** Stream/Degree/Courses Page Routes Start **************************************/

/*********** Autocomplete Search Routes Start **************************************/
Route::get('/autocomplete/getAllSearchTypeList', 'website\SearchPageController@getAllSearchTypeList');
Route::get('/autocomplete/getUniversityList', 'website\SearchPageController@getUniversityList');
Route::get('/autocomplete/getCollegeList', 'website\SearchPageController@getCollegeList');
Route::get('/autocomplete/getStreamList', 'website\SearchPageController@getStreamList');
Route::get('/autocomplete/getStreamDegreeList', 'website\SearchPageController@getStreamDegreeList');
Route::get('/autocomplete/getStreamDegreeCourseList', 'website\SearchPageController@getStreamDegreeCourseList');
Route::get('/autocomplete/getExaminationList', 'website\SearchPageController@getExaminationList');
Route::get('/autocomplete/getExaminationBoardsList', 'website\SearchPageController@getExaminationBoardsList');
Route::get('/autocomplete/getCareerCoursesList', 'website\SearchPageController@getCareerCoursesList');
Route::get('/autocomplete/getPopularCareerCoursesList', 'website\SearchPageController@getPopularCareerCoursesList');
Route::get('/autocomplete/getBlogsList', 'website\SearchPageController@getBlogsList');
Route::get('/autocomplete/getCountryStateCityList', 'website\SearchPageController@getCountryStateCityList');
Route::get('/autocomplete/getNewsList', 'website\SearchPageController@getNewsList');
Route::get('/autocomplete/getAskQuestionList', 'website\SearchPageController@getAskQuestionList');
Route::get('/autocomplete/getStreamDegreeCourseEduList', 'website\SearchPageController@getStreamDegreeCourseEduList');

Route::get('/autocomplete/getAdsCollegeProfileList', 'website\SearchPageController@getAdsCollegeProfileList');
/*********** Autocomplete Search Routes End **************************************/
