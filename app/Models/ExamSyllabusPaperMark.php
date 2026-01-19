<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSyllabusPaperMark extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_syllabus_paper_marks';

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
    protected $fillable = ['degreeId', 'degreeName', 'unitName', 'topicname', 'topicDesc', 'examSyllabusPaperId', 'typeOfExaminations_id', 'employee_id'];

    
}
