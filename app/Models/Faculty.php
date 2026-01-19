<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Faculty extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculty';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'collegemaster_id', 'collegeprofile_id','suffix','sortorder','imagename','employee_id','email','phone', 'image_original','email','dob','gender','addressline1','addressline2','landmark','pincode','country_id','state_id','city_id','designation','languageKnown'];

    public static function getFacultyObj($slug)
    {
        $getFacultyObj      =   Faculty::orderBy('faculty.id', 'DESC')
                                ->leftJoin('collegeprofile', 'collegeprofile.id', '=', 'faculty.collegeprofile_id')
                                ->leftJoin('city', 'faculty.city_id', '=', 'city.id')
                                ->leftJoin('state', 'faculty.state_id', '=', 'state.id')
                                ->leftJoin('country', 'faculty.country_id', '=', 'country.id')
                                ->where('collegeprofile.slug', '=', $slug)
                                ->where('faculty.name', '<>', '')
                                ->paginate(10, array(
                                    'faculty.id',
                                    'faculty.name',
                                    'faculty.description',
                                    'faculty.suffix',
                                    'faculty.email',
                                    'faculty.phone',
                                    'faculty.imagename',
                                    'faculty.image_original',
                                    'faculty.designation',
                                    'faculty.dob',
                                    'faculty.gender',
                                    'faculty.addressline1',
                                    'faculty.addressline2',
                                    'faculty.landmark',
                                    'faculty.pincode',
                                    'faculty.languageKnown',
                                    'faculty.collegeprofile_id',
                                    'collegeprofile.users_id',
                                    'city.name as cityName',
                                    'state.name as stateName',
                                    'country.name as countryName'
                                ));

        foreach ($getFacultyObj as $key => $value) {
           $value->qualificationsObj = DB::table('faculty_qualifications')
                                ->where('faculty_qualifications.faculty_id','=', $value->id)
                                ->where('faculty_qualifications.users_id','=', $value->users_id)
                                ->where('faculty_qualifications.collegeprofile_id','=', $value->collegeprofile_id)
                                ->orderBy('faculty_qualifications.id', 'ASC')
                                ->get();

            $value->experienceObj = DB::table('faculty_experiences')
                                ->where('faculty_experiences.faculty_id','=', $value->id)
                                ->where('faculty_experiences.users_id','=', $value->users_id)
                                ->where('faculty_experiences.collegeprofile_id','=', $value->collegeprofile_id)
                                ->orderBy('faculty_experiences.id', 'ASC')
                                ->get();

            $value->facultyDepartmentObj = DB::table('faculty_departments')
                                ->leftJoin('educationlevel','faculty_departments.educationlevel_id','=','educationlevel.id')
                                ->leftJoin('functionalarea','faculty_departments.functionalarea_id','=','functionalarea.id')
                                ->leftJoin('degree','faculty_departments.degree_id','=','degree.id')
                                ->leftJoin('coursetype','faculty_departments.coursetype_id','=','coursetype.id')
                                ->leftJoin('course','faculty_departments.course_id','=','course.id')
                                ->where('faculty_departments.users_id','=', $value->users_id)
                                ->where('faculty_departments.faculty_id','=', $value->id)
                                ->where('faculty_departments.collegeprofile_id','=', $value->collegeprofile_id)
                                ->select('educationlevel.id as educationlevelId', 'educationlevel.name as educationlevelName', 'functionalarea.id as functionalareaId', 'functionalarea.name as functionalareaName', 'degree.id as degreeId', 'degree.name as degreeName', 'coursetype.id as coursetypeId', 'coursetype.name as coursetypeName', 'course.id as courseId', 'course.name as courseName')
                                ->orderBy('faculty_departments.id', 'ASC')
                                ->get();

        }
        return $getFacultyObj;
    }
}