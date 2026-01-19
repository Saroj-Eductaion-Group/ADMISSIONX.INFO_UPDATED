<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeAdmissionImportantDated extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_admission_important_dateds';

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
    protected $fillable = ['fromdate', 'todate', 'eventName', 'collegeAdmissionProcedure_id', 'users_id', 'collegeprofile_id', 'employee_id'];

    
}
