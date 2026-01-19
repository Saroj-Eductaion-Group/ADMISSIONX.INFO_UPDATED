<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamFaq extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_faqs';

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
    protected $fillable = ['question', 'answer', 'refLinks', 'typeOfExaminations_id', 'employee_id'];

    
}
