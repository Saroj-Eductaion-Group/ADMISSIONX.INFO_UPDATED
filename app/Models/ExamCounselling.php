<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamCounselling extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_counsellings';

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
    protected $fillable = ['degreeId', 'degreeName', 'modeofcounselling', 'description', 'counsellingProcedure', 'documentsRequired', 'websiteLink', 'typeOfExaminations_id', 'employee_id'];

    
}
