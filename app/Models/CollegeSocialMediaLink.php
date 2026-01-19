<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeSocialMediaLink extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_social_media_links';

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
    protected $fillable = ['title', 'url', 'isActive', 'other', 'users_id', 'collegeprofile_id', 'employee_id'];

    
}
