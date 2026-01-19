<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'address';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address1', 'address2', 'landmark', 'postalcode','employee_id'];

    /**
     * Get the data.
     */
    public function addresstype()
    {
        return $this->hasMany('App\Models\AddressType');
    }

    /**
     * Get the data.
     */
    public function city()
    {
        return $this->hasMany('App\Models\City');
    }

    /**
     * Get the data.
     */
    public function studentprofile()
    {
        return $this->hasMany('App\Models\StudentProfile');
    }

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->hasMany('App\Models\CollegeProfile');
    }
}
