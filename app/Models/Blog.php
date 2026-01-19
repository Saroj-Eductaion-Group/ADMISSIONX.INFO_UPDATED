<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['topic','featimage', 'fullimage', 'width', 'height', 'description', 'isactive', 'slug','employee_id'];

    /**
     * Get the data.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
