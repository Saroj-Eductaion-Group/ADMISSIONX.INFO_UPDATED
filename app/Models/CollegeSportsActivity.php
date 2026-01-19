<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeSportsActivity extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_sports_activities';

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
    protected $fillable = ['typeOfActivity', 'name', 'users_id', 'collegeprofile_id', 'employee_id'];

    
}
