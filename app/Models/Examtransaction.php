<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examtransaction extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'examtransaction';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','employee_id','studentname','amount','examTransactionHashKey'];

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
    public function engineeringexams()
    {
        return $this->hasMany('App\Models\EngineeringExam');
    }
}


