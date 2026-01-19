<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamPattern extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_patterns';

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
    protected $fillable = ['degreeId', 'degreeName', 'modeOfExam', 'examDuration', 'totalQuestion', 'totalMarks', 'section', 'markingSchem', 'languageofpaper', 'typeOfExaminations_id', 'employee_id','patternDesc'];

    
}
