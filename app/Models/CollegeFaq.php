<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeFaq extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'college_faqs';

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
    protected $fillable = ['question', 'answer', 'refLinks', 'users_id', 'collegeprofile_id', 'employee_id'];

    public static function getCollegeFaqsObj($slug)
    {
        $getCollegeFaqsObj      =   CollegeFaq::orderBy('college_faqs.id', 'DESC')
                                    ->leftJoin('collegeprofile', 'collegeprofile.id', '=', 'college_faqs.collegeprofile_id')
                                    ->where('collegeprofile.slug', '=', $slug)
                                    ->where('college_faqs.question', '<>', '')
                                    ->paginate(20, array(
                                        'college_faqs.id',
                                        'college_faqs.question',
                                        'college_faqs.answer',
                                        'college_faqs.refLinks',
                                        'college_faqs.users_id',
                                        'college_faqs.collegeprofile_id',
                                        'college_faqs.employee_id'
                                    ));
        return $getCollegeFaqsObj;
    }
}
