<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','datetime', 'venue', 'description', 'link','employee_id'];

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->hasMany('App\Models\CollegeProfile');
    }
}
