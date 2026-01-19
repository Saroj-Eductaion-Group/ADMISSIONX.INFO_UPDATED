<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'city';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','cityStatus','pagetitle','pagedescription','pageslug','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress'];

    /**
     * Get the data.
     */
    public function state()
    {
        return $this->hasMany('App\Models\State');
    }

    /**
     * Get the data.
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * Get the data.
     */
    public function careers()
    {
        return $this->belongsTo('App\Models\Career');
    }
}

