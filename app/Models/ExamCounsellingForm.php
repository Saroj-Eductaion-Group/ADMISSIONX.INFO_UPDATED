<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamCounsellingForm extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exam_counselling_forms';

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
    protected $fillable = ['name', 'email', 'phone', 'misc', 'city_id', 'course_id', 'exam_id', 'users_id', 'employee_id','isResponse','isResponseMethod'];

    
}
