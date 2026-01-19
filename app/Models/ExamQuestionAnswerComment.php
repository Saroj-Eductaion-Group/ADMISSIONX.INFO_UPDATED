<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestionAnswerComment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_question_answer_comments';

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
    protected $fillable = ['answerDate', 'replyanswer', 'answerId', 'questionId', 'userId', 'typeOfExaminations_id', 'employee_id', 'likes', 'share'];

    
}
