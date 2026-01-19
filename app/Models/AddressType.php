<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresstype';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id'];

    /**
     * Get the data.
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
}
