<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestionAnswer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_question_answers';

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
    protected $fillable = ['answerDate', 'answer', 'questionId', 'userId', 'typeOfExaminations_id', 'employee_id', 'likes', 'share'];

    
}
