<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyDepartment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculty_departments';

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
    protected $fillable = ['functionalarea_id', 'educationlevel_id', 'degree_id', 'coursetype_id', 'course_id', 'faculty_id', 'users_id', 'collegeprofile_id', 'employee_id','collegemaster_id'];

    
}
