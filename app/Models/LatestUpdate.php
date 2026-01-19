<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LatestUpdate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'latest_updates';

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
    protected $fillable = ['name', 'date', 'desc', 'status', 'users_id', 'employee_id'];

    
}
