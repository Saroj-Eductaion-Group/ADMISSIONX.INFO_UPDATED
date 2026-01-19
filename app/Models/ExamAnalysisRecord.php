<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnalysisRecord extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_analysis_records';

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
    protected $fillable = ['degreeId', 'degreeName', 'description', 'papername', 'files', 'typeOfExaminations_id', 'employee_id'];

    
}
