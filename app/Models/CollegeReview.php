<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeReview extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_reviews';

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
    protected $fillable = ['title', 'description', 'votes', 'academic', 'accommodation', 'faculty', 'infrastructure', 'placement', 'social', 'guestUserId', 'users_id', 'collegeprofile_id', 'employee_id'];

    
}
