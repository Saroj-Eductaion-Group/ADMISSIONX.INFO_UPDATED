<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeType extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collegetype';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id'];

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->belongsTo('App\Models\CollegeProfile');
    }
}
