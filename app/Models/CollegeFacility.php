<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeFacility extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collegefacilities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','employee_id'];

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
    public function facility()
    {
        return $this->hasMany('App\Models\Facility');
    }
}
