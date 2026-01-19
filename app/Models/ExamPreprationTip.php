<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamPreprationTip extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_prepration_tips';

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
    protected $fillable = ['degreeId', 'degreeName', 'description', 'booksName', 'importantTopics', 'typeOfExaminations_id', 'employee_id'];

    
}
