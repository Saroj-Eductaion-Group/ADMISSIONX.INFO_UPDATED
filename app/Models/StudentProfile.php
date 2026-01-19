<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'studentprofile';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['gender', 'dateofbirth', 'parentsname', 'parentsnumber', 'hobbies', 'interests', 'achievementsawards', 'projects', 'entranceexamname', 'entranceexamnumber', 'isverifiedage','slug','employee_id'];

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
    public function studentmarks()
    {
        return $this->belongsTo('App\Models\StudentMarks');
    }

    /**
     * Get the data.
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public static function getStudentName($slug)
    {
        $getStudentName = StudentProfile::where('slug', '=', $slug)
                            ->leftJoin('users','studentprofile.users_id', '=', 'users.id')
                            ->first();
        return $getStudentName->firstname;
    }
}
