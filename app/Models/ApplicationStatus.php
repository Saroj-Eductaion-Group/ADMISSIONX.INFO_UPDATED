<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'applicationstatus';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id'];

    /**
     * Get the data.
     */
    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }
}
