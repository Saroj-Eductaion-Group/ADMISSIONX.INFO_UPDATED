<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'query';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['subject', 'message', 'admin_id', 'college_id', 'student_id', 'queryflowtype', 'replytoid', 'chatkey','guestname','guestemail','guestphone','querytypeinfo','employee_id'];

}
