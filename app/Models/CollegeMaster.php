<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeMaster extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collegemaster';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['twelvemarks','others','fees', 'seats','seatsallocatedtobya', 'courseduration','description','employee_id'];

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->hasMany('App\Models\CollegeProfile');
    }

    /**
     * Get the data.
     */
    public function educationlevel()
    {
        return $this->hasMany('App\Models\EducationLevel');
    }

    /**
     * Get the data.
     */
    public function functionalarea()
    {
        return $this->hasMany('App\Models\FunctionalArea');
    }

    /**
     * Get the data.
     */
    public function degree()
    {
        return $this->hasMany('App\Models\Degree');
    }

    /**
     * Get the data.
     */
    public function coursetype()
    {
        return $this->hasMany('App\Models\CourseType');
    }

    /**
     * Get the data.
     */
    public function course()
    {
        return $this->hasMany('App\Models\Course');
    }

    /**
     * Get the data.
     */
    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }
}
