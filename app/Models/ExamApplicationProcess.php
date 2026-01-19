<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamApplicationProcess extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_application_processes';

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
    protected $fillable = ['modeofapplication', 'modeofpayment', 'description', 'typeOfExaminations_id', 'employee_id','examinationtype','applicationandexamstatus','examinationmode','eligibilitycriteria'];

}
