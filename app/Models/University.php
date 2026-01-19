<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'university';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome'];

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->belongsTo('App\Models\CollegeProfile');
    }
}
