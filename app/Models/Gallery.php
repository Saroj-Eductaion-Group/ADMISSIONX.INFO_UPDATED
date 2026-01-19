<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gallery';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'fullimage','caption', 'width', 'height','misc','employee_id'];

    /**
     * Get the data.
     */
    public function category()
    {
        return $this->hasMany('App\Models\Category');
    }

    /**
     * Get the data.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
