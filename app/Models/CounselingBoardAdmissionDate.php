<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingBoardAdmissionDate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counseling_board_admission_dates';

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
    protected $fillable = ['place', 'dates', 'fees', 'class', 'subjects', 'counselingBoardId'];

    
}
