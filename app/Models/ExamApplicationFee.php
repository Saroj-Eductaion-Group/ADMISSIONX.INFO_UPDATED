<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamApplicationFee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_application_fees';

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
    protected $fillable = ['category', 'quota', 'mode', 'gender', 'amount', 'typeOfExaminations_id', 'employee_id'];

    
}
