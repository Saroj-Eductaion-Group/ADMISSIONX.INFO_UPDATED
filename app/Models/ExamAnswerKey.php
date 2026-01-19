<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswerKey extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_answer_keys';

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
    protected $fillable = ['degreeId', 'degreeName', 'description', 'importantDesc', 'papername', 'typeOfExaminations_id', 'employee_id'];

    
}
