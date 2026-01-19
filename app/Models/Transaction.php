<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transaction';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','transactionHashKey'];

    /**
     * Get the data.
     */
    public function paymentstatus()
    {
        return $this->hasMany('App\Models\PaymentStatus');
    }

    /**
     * Get the data.
     */
    public function cardtype()
    {
        return $this->hasMany('App\Models\CardType');
    }

    /**
     * Get the data.
     */
    public function application()
    {
        return $this->hasMany('App\Models\Application');
    }
}
