<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AskQuestion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ask_questions';

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
    protected $fillable = ['question', 'questionDate', 'userId', 'status', 'employee_id','slug','likes','share','views','askQuestionTagIds','totalAnswerCount','totalCommentsCount'];

    
}
