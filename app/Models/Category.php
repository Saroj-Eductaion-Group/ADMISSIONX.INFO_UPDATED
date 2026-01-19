<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id'];

    /**
     * Get the data.
     */
    public function document()
    {
        return $this->belongsTo('App\Models\Document');
    }

    /**
     * Get the data.
     */
    public function gallery()
    {
        return $this->belongsTo('App\Models\Gallery');
    }

    /**
     * Get the data.
     */
    public function studentmark()
    {
        return $this->belongsTo('App\Models\StudentMark');
    }
}
