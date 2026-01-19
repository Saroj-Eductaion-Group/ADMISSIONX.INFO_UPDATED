<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeLog extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collegelog';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['college_id','student_id','users_id', 'userrole_id','event','ipaddress','employee_id','course_id'];

}
