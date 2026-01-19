<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coursetype';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id'];

    /**
     * Get the data.
     */
    public function collegemaster()
    {
        return $this->belongsTo('App\Models\CollegeMaster');
    }

    
}
