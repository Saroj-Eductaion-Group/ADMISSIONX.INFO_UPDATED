<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingCoursesMoreDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counseling_courses_more_details';

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
    protected $fillable = ['title', 'description', 'popularCities', 'specialisations', 'entranceExamsName', 'coursesDetailsId', 'functionalarea_id', 'degree_id'];

    
}
