<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'examination_details';

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
    protected $fillable = ['title', 'description', 'functionalarea_id', 'courses_id', 'slug', 'applicationFrom', 'applicationTo', 'exminationDate', 'resultAnnounce', 'image', 'imagealttext', 'content', 'getMoreInfoLink', 'userId', 'status', 'totalLikes', 'totalViews', 'totalApplicationClick','employee_id','typeOfExaminations_id'];

    
}
