<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingBoardHighlight extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'counseling_board_highlights';

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
    protected $fillable = ['title', 'description', 'counselingBoardId'];

    
}
