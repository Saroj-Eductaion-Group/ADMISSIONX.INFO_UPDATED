<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usergroups';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'allTableInformation_id', 'users_id', 'create_action', 'edit_action', 'update_action', 'delete_action', 'show_action', 'metrics1_action', 'metrics2_action', 'metrics3_action', 'metrics4_action', 'metrics5_action','metrics6_action','queries_action','index', 'slug','employee_id'];

}















