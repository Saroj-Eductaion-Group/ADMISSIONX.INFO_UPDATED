<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingCareerDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counseling_career_details';

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
    protected $fillable = ['title', 'description', 'image', 'jobProfileDesc', 'totalLikes', 'pros', 'cons', 'futureGrowthPurpose', 'employeeOpportunities', 'studyMaterial', 'whereToStudy', 'functionalarea_id', 'slug', 'careerRelevantId','status','purpose_desc','eligibility','qualification','syllabus','exam_pattern','selection_criteria','frequency','other_details'];

    
}
