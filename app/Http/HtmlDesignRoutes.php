<?php

Route::get('/new-home', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@newHomeDesign'
]);

Route::get('/search-college-page', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@searchCollegePage'
]);

Route::get('/choose-stream-page', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@chooseStreamPage'
]);

Route::get('/choose-stream-detail-page', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@chooseStreamDetailPage'
]);

Route::get('/choose-stream-full-detail-page', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@chooseStreamFullDetailPage'
]);

Route::get('/govt-exams-page', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@govtExamsPage'
]);

Route::get('/govt-exams-detail-page', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@govtExamsDetailPage'
]);

Route::get('/govt-exams-list-page', [
    'middleware' => ['auth'],
    'uses' => 'website\HtmlDesignController@govtExamsListPage'
]);

Route::get('/demo-new-home', 'website\HtmlDesignController@demoNewDesign');
Route::get('/college-list-page', 'website\HtmlDesignController@collegeListPage');
Route::get('/top-college-page', 'website\HtmlDesignController@topCollegePage');

Route::get('/dm-new-home', 'website\HtmlDesignController@dmNewHomeDesign');
Route::get('/dm-college-list-page', 'website\HtmlDesignController@dmCollegeListPage');
Route::get('/dm-top-college-page', 'website\HtmlDesignController@dmTopCollegePage');




Route::get('/student-popup-page', 'website\HtmlDesignController@studentPopupPage');

Route::get('/student-popup-one-page', 'website\HtmlDesignController@studentPopupOnePage');

Route::get('/college-popup-one-page', 'website\HtmlDesignController@collegePopupOnePage');

Route::get('/landing-page-one', 'website\HtmlDesignController@landingPageOne');

    


