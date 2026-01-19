<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingCareerWhereToStudy extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counseling_career_where_to_studies';

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
    protected $fillable = ['instituteName', 'instituteUrl', 'city', 'programmeFees', 'careerDetailsId'];

    
}
