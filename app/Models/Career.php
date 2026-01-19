<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'careers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'middlename', 'lastname', 'email', 'dateOfBirth', 'gender', 'phonenumber', 'address', 'pincode', 'cv', 'postappliedfor','employee_id'];

    /**
     * Get the data.
     */
    public function city()
    {
        return $this->hasMany('App\Models\City');
    }

}
