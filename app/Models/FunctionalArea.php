<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunctionalArea extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'functionalarea';

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
     * Get the zones types that owns the comment.
     */
    public function degree()
    {
        return $this->belongsTo('App\Models\Degree');
    }
}
