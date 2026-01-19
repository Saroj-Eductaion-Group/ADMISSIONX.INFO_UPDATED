<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'studentmarks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['marks', 'percentage','name','employee_id','studentMarkType'];

    /**
     * Get the data.
     */
    public function category()
    {
        return $this->hasMany('App\Models\Category');
    }
    
    /**
     * Get the data.
     */
    public function studentprofile()
    {
        return $this->hasMany('App\Models\StudentProfile');
    }
}
