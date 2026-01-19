<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderManager extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'slider_managers';

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
    protected $fillable = ['sliderTitle', 'bottomText', 'sliderImage', 'bottomLink', 'status', 'isShowCollegeCount', 'isShowExamCount', 'isShowCourseCount', 'isShowBlogCount', 'scrollerFirstText', 'scrollerLastText'];

    
}
