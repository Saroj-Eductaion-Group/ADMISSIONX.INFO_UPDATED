<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingBoardImpDate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counseling_board_imp_dates';

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
    protected $fillable = ['dates', 'description', 'counselingBoardId'];

    
}
