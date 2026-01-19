<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeOfExamination extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_of_examinations';

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
    protected $fillable = ['sortname', 'name', 'status', 'slug','employee_id','universitylogo','universityName','university_id','examsection_id','functionalarea_id','isShowOnTop','isShowOnHome'];

    
}
