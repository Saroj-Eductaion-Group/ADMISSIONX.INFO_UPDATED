<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyExperience extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculty_experiences';

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
    protected $fillable = ['fromyear', 'toyear', 'role', 'organisation', 'city', 'users_id', 'collegeprofile_id', 'employee_id','faculty_id'];

    
}
