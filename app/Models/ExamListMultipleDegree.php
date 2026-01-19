<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamListMultipleDegree extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_list_multiple_degrees';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['degree_id', 'typeOfExaminations_id','examsection_id' ,'functionalarea_id', 'degreeSlug'];
}
