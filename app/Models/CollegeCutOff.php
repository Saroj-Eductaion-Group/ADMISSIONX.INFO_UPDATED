<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeCutOff extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_cut_offs';

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
    protected $fillable = ['title', 'description', 'functionalarea_id', 'degree_id', 'coursetype_id', 'course_id', 'users_id', 'collegeprofile_id', 'employee_id','educationlevel_id'];

    
}
