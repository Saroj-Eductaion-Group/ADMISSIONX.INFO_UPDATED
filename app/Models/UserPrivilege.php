<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'userprivileges';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['allTableInformation_id', 'create', 'edit', 'update', 'delete', 'show', 'mertics1', 'mertics2', 'mertics3', 'mertics4', 'mertics5', 'mertics6', 'queries', 'users_id','index','slug','employee_id'];

}
