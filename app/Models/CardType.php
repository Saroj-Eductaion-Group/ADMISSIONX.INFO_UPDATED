<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cardtype';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id'];

    /**
     * Get the data.
     */
    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }

    /**
     * Get the data.
     */
    public function examtransaction()
    {
        return $this->belongsTo('App\Models\Examtransaction');
    }
}
