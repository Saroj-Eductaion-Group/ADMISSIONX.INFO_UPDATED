<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngineeringExam extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'engineeringexams';

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
    protected $fillable = ['title', 'firstname', 'middlename', 'lastname', 'fathername', 'category', 'gender', 'nationality', 'choice1st', 'choice2nd', 'choice3rd', 'firstaddress1', 'firstaddress2', 'firstaddress3', 'firstcity', 'firststate', 'firstpincode', 'firstcontact', 'secondaddress1', 'secondaddress2', 'secondaddress3', 'secondcity', 'secondstate', 'secondpincode', 'secondcontact', 'addresssame','board1','subject1','passingyr1','percentage1','cgpa1','division1','board2','subject2','passingyr2','percentage2','cgpa2','division2', 'iagree','place','date','email','phone','apikey','applicationId','examTransactionHashKey'];
    /**
     * Get the data.
     */
    public function examtransaction()
    {
        return $this->belongsTo('App\Models\Examtransaction');
    }

    
}
