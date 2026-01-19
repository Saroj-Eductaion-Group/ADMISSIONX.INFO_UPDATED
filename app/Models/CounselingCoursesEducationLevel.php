<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingCoursesEducationLevel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counseling_courses_education_levels';

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
    protected $fillable = ['educationlevel_id', 'functionalarea_id', 'coursesDetailsId', 'educationLevelSlug'];

    
}
