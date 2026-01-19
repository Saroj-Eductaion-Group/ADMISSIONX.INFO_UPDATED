<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invite';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['link', 'referemail', 'isactive','employee_id'];

    /**
     * Get the data.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
