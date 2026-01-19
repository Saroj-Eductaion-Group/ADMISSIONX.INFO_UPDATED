<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoContent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seo_contents';

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
    protected $fillable = ['pagetitle', 'description', 'keyword', 'misc', 'slugurl', 'h1title', 'canonical', 'h2title', 'h3title', 'image', 'imagealttext', 'content', 'pageId', 'userId', 'collegeId', 'examId', 'boardId', 'careerReleventId', 'popularCareerId','courseId','blogId','examSectionId','employee_id','educationLevelId','degreeId','functionalAreaId','topCourseId','universityId','countryId','stateId','cityId','newsId','newsTagId','newsTypeId','askQuestionId','askTagId'];    
}
