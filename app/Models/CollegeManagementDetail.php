<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeManagementDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_management_details';

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
    protected $fillable = ['suffix','name', 'designation', 'gender', 'picture', 'emailaddress', 'phoneno', 'landlineNo', 'about', 'users_id', 'collegeprofile_id', 'employee_id'];

    
}
