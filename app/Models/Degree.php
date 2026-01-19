<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'degree';

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
    public function functionalarea()
    {
        return $this->hasMany('App\Models\FunctionalArea');
    }

    /**
     * Get the zones types that owns the comment.
     */
    public function course()
    {
        return $this->belongsTo('App\Models\course');
    }
}
