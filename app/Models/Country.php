<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome','totalCollegeRegAddress','totalCollegeByCampusAddress'];

    /**
     * Get the data.
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
}
