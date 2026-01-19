<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyQualification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculty_qualifications';

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
    protected $fillable = ['qualification', 'course', 'subjects', 'collegename', 'boardName', 'year', 'users_id', 'collegeprofile_id', 'employee_id','faculty_id'];

    
}
