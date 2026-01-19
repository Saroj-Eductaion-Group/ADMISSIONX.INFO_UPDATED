<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationMode extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application_modes';

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
    protected $fillable = ['name', 'status', 'slug','employee_id'];

    
}
