<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'userrole';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id'];

    /**
     * Get the data.
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
