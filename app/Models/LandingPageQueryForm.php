<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageQueryForm extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'landing_page_query_forms';

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
    protected $fillable = ['fullname', 'mobilenumber', 'emailaddress', 'subject', 'message', 'users_id', 'employee_id'];

    
}
