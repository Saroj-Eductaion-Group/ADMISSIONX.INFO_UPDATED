<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatusMessage extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'applicationstatusmessages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['application_id', 'student_id', 'college_id', 'admin_id', 'applicationStatus', 'message', 'others','employee_id'];

}
