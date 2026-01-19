<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entranceexam extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entranceexam';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','employee_id'];

}
