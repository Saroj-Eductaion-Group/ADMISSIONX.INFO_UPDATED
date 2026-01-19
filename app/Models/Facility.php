<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facilities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','iconname'];

    /**
     * Get the data.
     */
    public function collegefacility()
    {
        return $this->belongsTo('App\Models\CollegeFacility');
    }
}
