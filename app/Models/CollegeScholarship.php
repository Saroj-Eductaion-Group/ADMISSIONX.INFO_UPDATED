<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeScholarship extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_scholarships';

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
    protected $fillable = ['title', 'description', 'users_id', 'collegeprofile_id', 'employee_id'];

    
}
