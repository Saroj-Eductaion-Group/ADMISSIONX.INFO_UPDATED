<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'placement';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numberofrecruitingcompany', 'numberofplacementlastyear', 'ctchighest', 'ctclowest', 'ctcaverage','placementinfo','employee_id'];

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->hasMany('App\Models\CollegeProfile');
    }
}
