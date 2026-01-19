<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CollegeAdmissionProcedure extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_admission_procedures';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'functionalarea_id', 'educationlevel_id', 'degree_id', 'coursetype_id', 'course_id', 'users_id', 'collegeprofile_id', 'employee_id'];

    public static function getAdmissionProcedureObj($slug)
    {
        $getAdmissionProcedureObj  =  CollegeAdmissionProcedure::orderBy('college_admission_procedures.id', 'DESC')
                                    ->leftJoin('collegeprofile', 'college_admission_procedures.collegeprofile_id', '=', 'collegeprofile.id')
                                    ->leftJoin('educationlevel','college_admission_procedures.educationlevel_id','=','educationlevel.id')
                                    ->leftJoin('functionalarea','college_admission_procedures.functionalarea_id','=','functionalarea.id')
                                    ->leftJoin('degree','college_admission_procedures.degree_id','=','degree.id')
                                    ->leftJoin('coursetype','college_admission_procedures.coursetype_id','=','coursetype.id')
                                    ->leftJoin('course','college_admission_procedures.course_id','=','course.id')
                                    ->where('collegeprofile.slug', '=', $slug)
                                    ->paginate(15, array(
                                            'college_admission_procedures.id',
                                            'college_admission_procedures.title', 
                                            'college_admission_procedures.description',
                                            'college_admission_procedures.functionalarea_id',
                                            'college_admission_procedures.educationlevel_id',
                                            'college_admission_procedures.degree_id',
                                            'college_admission_procedures.coursetype_id',
                                            'college_admission_procedures.course_id',
                                            'college_admission_procedures.users_id',
                                            'college_admission_procedures.collegeprofile_id', 
                                            'educationlevel.id as educationlevelId',
                                            'educationlevel.name as educationlevelName',
                                            'functionalarea.id as functionalareaId',
                                            'functionalarea.name as functionalareaName', 
                                            'degree.id as degreeId', 
                                            'degree.name as degreeName', 
                                            'coursetype.id as coursetypeId', 
                                            'coursetype.name as coursetypeName', 
                                            'course.id as courseId', 
                                            'course.name as courseName',
                                            'collegeprofile.slug'
                                        ));


        foreach ($getAdmissionProcedureObj as $key => $value) {
            $value->importantDatedObj = DB::table('college_admission_important_dateds')
                                ->where('college_admission_important_dateds.collegeAdmissionProcedure_id','=', $value->id)
                                ->where('college_admission_important_dateds.users_id','=', $value->users_id)
                                ->where('college_admission_important_dateds.collegeprofile_id','=', $value->collegeprofile_id)
                                ->orderBy('college_admission_important_dateds.id', 'ASC')
                                ->get();

        }
        return $getAdmissionProcedureObj;
    }
}
