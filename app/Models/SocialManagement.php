<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialManagement extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'socialmanagements';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'url', 'isActive', 'other','employee_id'];

}
