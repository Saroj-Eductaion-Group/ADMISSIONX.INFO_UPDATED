<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeProfile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collegeprofile';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'estyear', 'website', 'collegecode', 'contactpersonname', 'contactpersonemail', 'contactpersonnumber', 'review', 'agreement', 'verified','calenderinfo','slug','facebookurl','twitterurl','advertisement','employee_id','advertisementTimeFrame','approvedBy','advertisementTimeFrameEnd','bannerimage','isShowOnTop','isShowOnHome','registeredSortAddress','registeredFullAddress','registeredAddressCityId','registeredAddressStateId','registeredAddressCountryId','campusSortAddress','campusFullAddress','campusAddressCityId','campusAddressStateId','campusAddressCountryId','mediumOfInstruction','studyForm','studyTo','admissionStart','admissionEnd','CCTVSurveillance','totalStudent','ACCampus','rating','totalRatingUser','users_id'];

    /**
     * Get the data.
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the data.
     */
    public function collegefacility()
    {
        return $this->belongsTo('App\Models\CollegeFacility');
    }

    /**
     * Get the data.
     */
    public function collegemaster()
    {
        return $this->belongsTo('App\Models\CollegeMaster');
    }

    /**
     * Get the data.
     */
    public function university()
    {
        return $this->hasMany('App\Models\University');
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
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    /**
     * Get the data.
     */
    public function collegetype()
    {
        return $this->hasMany('App\Models\CollegeType');
    }

    /**
     * Get the data.
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * Get the data.
     */
    public function placement()
    {
        return $this->belongsTo('App\Models\Placement');
    }

    public static function getCollegeName($slug)
    {
        $getCollegeName = CollegeProfile::where('slug', '=', $slug)
                            ->leftJoin('users','collegeprofile.users_id', '=', 'users.id')
                            ->first();
        return $getCollegeName->firstname;
    }
}
