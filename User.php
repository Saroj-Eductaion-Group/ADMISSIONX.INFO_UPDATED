<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
     use Authenticatable, Authorizable, CanResetPassword;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['suffix', 'firstname', 'middlename', 'lastname', 'phone', 'email', 'token','employee_id','apikey','google_provider_id','google_token','google_refresh_token','fb_provider_id','fb_token','fb_refresh_token','type_of_user','is_emailSent'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the data.
     */
    public function collegeprofile()
    {
        return $this->belongsTo('App\Models\CollegeProfile');
    }

    /**
     * Get the data.
     */
    public function userstatus()
    {
        return $this->hasMany('App\Models\UserStatus');
    }

    /**
     * Get the data.
     */
    public function userrole()
    {
        return $this->hasMany('App\Models\UserRole');
    }

    /**
     * Get the data.
     */
    public function studentprofile()
    {
        return $this->belongsTo('App\Models\StudentProfile');
    }

    /**
     * Get the data.
     */
    public function document()
    {
        return $this->belongsTo('App\Models\Document');
    }

    /**
     * Get the data.
     */
    public function gallery()
    {
        return $this->belongsTo('App\Models\Gallery');
    }

    /**
     * Get the data.
     */
    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }

    /**
     * Get the data.
     */
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }

    /**
     * Get the data.
     */
    public function invite()
    {
        return $this->belongsTo('App\Models\Invite');
    }
}   
