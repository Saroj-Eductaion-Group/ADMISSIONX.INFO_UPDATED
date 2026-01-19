<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatWeOffer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'what_we_offers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'iconImage', 'bannerText', 'bannerImage', 'description', 'status', 'slug','pageurl'];

    
}
