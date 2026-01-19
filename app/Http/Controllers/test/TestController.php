<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    public function showAvailableCourses()
    {
        $courses = DB::table('collegemaster')
            ->join('collegeprofile', 'collegemaster.collegeprofile_id', '=', 'collegeprofile.id')
            ->join('users', 'collegeprofile.users_id', '=', 'users.id')
            ->join('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id')
            ->join('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id')
            ->join('degree', 'collegemaster.degree_id', '=', 'degree.id')
            ->join('course', 'collegemaster.course_id', '=', 'course.id')
            ->join('coursetype', 'collegemaster.coursetype_id', '=', 'coursetype.id')
            ->where('users.userstatus_id', '1')
            ->select(
                'collegemaster.id as course_id',
                'users.firstname as college_name',
                'collegeprofile.slug as college_slug',
                'educationlevel.name as education_level',
                'functionalarea.name as functional_area',
                'degree.name as degree_name',
                'course.name as course_name',
                'coursetype.name as course_type',
                'collegemaster.fees',
                'collegemaster.seats',
                'collegemaster.twelvemarks as min_marks'
            )
            ->get();

        $html = '<!DOCTYPE html>
<html>
<head>
    <title>Available Courses - AdmissionX</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .course-card { border: 1px solid #ddd; margin: 10px 0; padding: 15px; border-radius: 5px; }
        .course-title { color: #2c3e50; font-size: 18px; font-weight: bold; }
        .college-name { color: #27ae60; font-size: 16px; }
        .course-details { margin: 10px 0; }
        .apply-btn { background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px; }
        .apply-btn:hover { background: #2980b9; }
    </style>
</head>
<body>
    <h1>Available Courses for Application</h1>';

        if (empty($courses)) {
            $html .= '<p>No courses available. <a href="/seed-dummy-course">Click here to seed dummy data</a></p>';
        } else {
            foreach ($courses as $course) {
                $html .= '
                <div class="course-card">
                    <div class="course-title">' . $course->course_name . ' (' . $course->degree_name . ')</div>
                    <div class="college-name">' . $course->college_name . '</div>
                    <div class="course-details">
                        <strong>Education Level:</strong> ' . $course->education_level . '<br>
                        <strong>Stream:</strong> ' . $course->functional_area . '<br>
                        <strong>Course Type:</strong> ' . $course->course_type . '<br>
                        <strong>Fees:</strong> ₹' . number_format($course->fees) . '<br>
                        <strong>Seats:</strong> ' . $course->seats . '<br>
                        <strong>Min 12th Marks:</strong> ' . $course->min_marks . '%
                    </div>
                    <a href="/student/apply-course-details/' . $course->course_id . '/' . $course->college_slug . '" class="apply-btn">Apply Now</a>
                </div>';
            }
        }

        $html .= '</body></html>';

        return response($html);
    }
}