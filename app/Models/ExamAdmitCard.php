<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAdmitCard extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_admit_cards';

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
    protected $fillable = ['degreeId', 'degreeName', 'description', 'rebemberPoints', 'typeOfExaminations_id', 'employee_id'];

    
}
