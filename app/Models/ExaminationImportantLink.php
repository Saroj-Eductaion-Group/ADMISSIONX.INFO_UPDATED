<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationImportantLink extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'examination_important_links';

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
    protected $fillable = ['title', 'url', 'examinationDetailsId','employee_id','typeOfExaminations_id'];

    
}
