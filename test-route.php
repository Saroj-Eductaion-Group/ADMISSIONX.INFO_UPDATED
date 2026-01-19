<?php

Route::get('/add-test-data', function() {
    try {
        // Check table structure first
        $colleges = DB::select('SHOW COLUMNS FROM collegemaster');
        $courses = DB::select('SHOW COLUMNS FROM coursemaster');
        
        return response()->json([
            'college_columns' => $colleges,
            'course_columns' => $courses
        ]);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});