<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','firstname','middlename','lastname','dob','email','phone','gender','percent10','marksheet10','percent11','marksheet11','percent12','marksheet12','parentname','parentnumber','parentidproof','hobbies','interest','awards','projects','iagreeparents','iagreeform','totalfees','byafees','restfees', 'paymentstatus_id', 'applicationID', 'lastPaymentAttemptDate','misc','employee_id','transactionHashKey', 'graduationPercent', 'graduationMarksheet'];
    
    /**
     * Get the data.
     */
    public function applicationstatus()
    {
        return $this->hasMany('App\Models\ApplicationStatus');
    }

    /**
     * Get the data.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->hasMany('App\Models\CollegeProfile');
    }

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
    public function collegemaster()
    {
        return $this->hasMany('App\Models\CollegeMaster');
    }
}
