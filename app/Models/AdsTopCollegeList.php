<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsTopCollegeList extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_top_college_lists';

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
    protected $fillable = ['collegeprofile_id', 'functionalarea_id', 'degree_id', 'course_id', 'educationlevel_id', 'city_id', 'state_id', 'country_id', 'university_id', 'status', 'employee_id','method_type'];

    
}
