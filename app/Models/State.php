<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'state';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','pagetitle','pagedescription','pageslug','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress'];

    /**
     * Get the data.
     */
    public function country()
    {
        return $this->hasMany('App\Models\Country');
    }

    /**
     * Get the data.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
