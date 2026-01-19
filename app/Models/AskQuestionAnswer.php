<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AskQuestionAnswer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ask_question_answers';

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
    protected $fillable = ['answer', 'answerDate', 'questionId', 'userId', 'employee_id', 'status', 'likes', 'share','totalCommentsCount'];

    
}
