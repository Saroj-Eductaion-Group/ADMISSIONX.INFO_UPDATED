<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllTableInformation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alltableinformations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','employee_id'];

}
