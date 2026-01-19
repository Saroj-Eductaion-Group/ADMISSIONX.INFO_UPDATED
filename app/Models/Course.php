<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','pagetitle','pagedescription','pageslug','logoimage','bannerimage','isShowOnTop','isShowOnHome'];

    /**
     * Get the data.
     */
    public function collegemaster()
    {
        return $this->belongsTo('App\Models\CollegeMaster');
    }

    /**
     * Get the locations for the blog post.
     */
    public function degree()
    {
        return $this->hasMany('App\Models\Degree');
    }
}
