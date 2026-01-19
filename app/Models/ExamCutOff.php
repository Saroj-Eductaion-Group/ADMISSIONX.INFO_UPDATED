<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamCutOff extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_cut_offs';

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
    protected $fillable = ['degreeId', 'degreeName', 'description', 'typeOfExaminations_id', 'employee_id'];

    
}
