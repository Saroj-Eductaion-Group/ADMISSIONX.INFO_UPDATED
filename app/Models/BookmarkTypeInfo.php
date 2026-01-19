<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkTypeInfo extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookmarktypeinfos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'other','employee_id'];

}
