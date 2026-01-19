<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contentcategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contentcategory';

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
    protected $fillable = ['name', 'status'];

    /**
     * Get the data.
     */
    public function contents()
    {
        return $this->belongsTo('App\Models\Content');
    }

}