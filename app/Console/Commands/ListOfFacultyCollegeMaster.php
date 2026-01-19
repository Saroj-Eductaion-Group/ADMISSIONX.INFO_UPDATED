<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Session;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use Config;
use Storage;
use DateTime;
use DateTimeZone;
use PDF;
use File;
use App\User;
use Image;
use App\Models\Faculty;
use App\Models\FacultyDepartment;
use App\Models\CollegeMaster;
use App\Models\CollegeMasterAssociateFaculty;
use App\Models\CollegeProfile;

class ListOfFacultyCollegeMaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-faculty-college-master';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to upload bulk images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
        $this->info('Process Started At : '.date('F d,Y h:i A'));
        // GET ALL FILE NAME
        ini_set('max_allowed_packet', '1677721600');
        ini_set('max_execution_time', '-1');
        ini_set('memory_limit', '10240M');

        $dataObj = storage_path('facultycsv/faculty.csv');
        $customerArr = $this->csvToArray($dataObj);
        // echo "<pre>";
        // print_r($customerArr);die;
        foreach($customerArr as $key => $value):
            if(($value['collegemaster_id'] != 'NULL') && ($value['collegeprofile_id'] != 'NULL')){
                $createFacultyObj = New Faculty;
                if($value['imagename'] != 'NULL'){
                    $createFacultyObj->imagename = $value['imagename'];
                }
                if($value['name'] != 'NULL'){
                    $createFacultyObj->name = $value['name'];
                }
                if($value['description'] != 'NULL'){
                    $createFacultyObj->description = $value['description'];
                }

                if($value['sortorder'] != 'NULL'){
                    $createFacultyObj->sortorder = $value['sortorder'];
                }
                if($value['collegemaster_id'] != 'NULL'){
                    $createFacultyObj->collegemaster_id = $value['collegemaster_id'];
                }

                if($value['collegeprofile_id'] != 'NULL'){
                    $createFacultyObj->collegeprofile_id = $value['collegeprofile_id'];
                }

                if($value['employee_id'] != 'NULL'){
                    $createFacultyObj->employee_id = $value['employee_id'];
                }
                if($value['suffix'] != 'NULL'){
                    $createFacultyObj->suffix = $value['suffix'];
                }
                if($value['email'] != 'NULL'){
                    $createFacultyObj->email = $value['email'];
                }
                if($value['designation'] != 'NULL'){
                    $createFacultyObj->designation = $value['designation'];
                }
                if($value['languageKnown'] != 'NULL'){
                    $createFacultyObj->languageKnown = $value['languageKnown'];
                }

                if($value['image_original'] != 'NULL'){
                    $createFacultyObj->image_original = $value['image_original'];
                }
                if($value['dob'] != 'NULL'){
                    $createFacultyObj->dob = $value['dob'];
                }
                if($value['gender'] != 'NULL'){
                    $createFacultyObj->gender = $value['gender'];
                }
                if($value['addressline1'] != 'NULL'){
                    $createFacultyObj->addressline1 = $value['addressline1'];
                }
                if($value['addressline2'] != 'NULL'){
                    $createFacultyObj->addressline2 = $value['addressline2'];
                }
                if($value['landmark'] != 'NULL'){
                    $createFacultyObj->landmark = $value['landmark'];
                }
                if($value['pincode'] != 'NULL'){
                    $createFacultyObj->pincode = $value['pincode'];
                }
                if($value['country_id'] != 'NULL'){
                    $createFacultyObj->country_id = $value['country_id'];
                }
                if($value['state_id'] != 'NULL'){
                    $createFacultyObj->state_id = $value['state_id'];
                }
                if($value['city_id'] != 'NULL'){
                    $createFacultyObj->city_id = $value['city_id'];
                }

                $createFacultyObj->save();

                $collegeMasterObj = DB::table('collegemaster')
                    ->where('collegemaster.id', '=', $value['collegemaster_id'])
                    ->orderBy('collegemaster.id' ,'DESC')
                    ->first();  

                $collegeProfileObj = CollegeProfile::where('id','=',$value['collegeprofile_id'])->first();

                $createFacultyDepartmentObj                          = New FacultyDepartment;
                $createFacultyDepartmentObj->course_id               = $collegeMasterObj->course_id ? $collegeMasterObj->course_id : 'NULL';
                $createFacultyDepartmentObj->educationlevel_id       = $collegeMasterObj->educationlevel_id ? $collegeMasterObj->educationlevel_id : 'NULL';
                $createFacultyDepartmentObj->coursetype_id           = $collegeMasterObj->coursetype_id ? $collegeMasterObj->coursetype_id : 'NULL';
                $createFacultyDepartmentObj->functionalarea_id       = $collegeMasterObj->functionalarea_id ? $collegeMasterObj->functionalarea_id : 'NULL';
                $createFacultyDepartmentObj->degree_id               = $collegeMasterObj->degree_id ? $collegeMasterObj->degree_id : 'NULL';
                $createFacultyDepartmentObj->faculty_id              = $createFacultyObj->id;
                $createFacultyDepartmentObj->collegeprofile_id       = $createFacultyObj->collegeprofile_id;
                $createFacultyDepartmentObj->users_id                = $collegeProfileObj->users_id;
                $createFacultyDepartmentObj->employee_id             = $value['employee_id'];
                $createFacultyDepartmentObj->save(); 

                $collegeMasterAssociateFacultyObj                          = New CollegeMasterAssociateFaculty;
                $collegeMasterAssociateFacultyObj->faculty_id              = $createFacultyObj->id;
                $collegeMasterAssociateFacultyObj->functionalarea_id       = $collegeMasterObj->functionalarea_id ? $collegeMasterObj->functionalarea_id : 'NULL';
                $collegeMasterAssociateFacultyObj->educationlevel_id       = $collegeMasterObj->educationlevel_id ? $collegeMasterObj->educationlevel_id : 'NULL';
                $collegeMasterAssociateFacultyObj->degree_id               = $collegeMasterObj->degree_id ? $collegeMasterObj->degree_id : 'NULL';
                $collegeMasterAssociateFacultyObj->coursetype_id           = $collegeMasterObj->coursetype_id ? $collegeMasterObj->coursetype_id : 'NULL';
                $collegeMasterAssociateFacultyObj->course_id               = $collegeMasterObj->course_id ? $collegeMasterObj->course_id : 'NULL';
                $collegeMasterAssociateFacultyObj->collegemaster_id        = $collegeMasterObj->id;
                $collegeMasterAssociateFacultyObj->collegeprofile_id       = $collegeMasterObj->collegeprofile_id;
                $collegeMasterAssociateFacultyObj->users_id                = $collegeProfileObj->users_id;
                $collegeMasterAssociateFacultyObj->employee_id             = $value['employee_id'];
                $collegeMasterAssociateFacultyObj->save();
            }
        endforeach;
        return 'Process Completed';
        $this->info('Process Completed At : '.date('F d,Y h:i A'));
    }


    function csvToArray($filename = '', $delimiter = ',')
    {
        ini_set('memory_limit', '-1');
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000000000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}