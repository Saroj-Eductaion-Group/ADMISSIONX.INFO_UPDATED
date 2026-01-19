<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsManagement extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_managements';

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
    protected $fillable = ['title', 'img', 'description', 'isactive', 'users_id', 'slug', 'redirectto', 'start', 'end', 'ads_position'];
}