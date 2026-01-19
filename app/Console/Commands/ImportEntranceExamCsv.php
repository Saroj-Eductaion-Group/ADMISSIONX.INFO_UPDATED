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
use App\Models\TypeOfExamination;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\ExamSection as ExamSection;
use App\Models\University as University;
use App\Models\ExamListMultipleDegree;
use App\Models\ExaminationDetail;
use App\Models\ExamApplicationProcess;
use App\Models\Degree;
use App\Models\ExaminationType;
use App\Models\ApplicationAndExamStatus;
use App\Models\ApplicationMode;
use App\Models\ExaminationMode;
use App\Models\EligibilityCriterion;
use App\Models\SeoContent;

class ImportEntranceExamCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-entrance-exam-csv';

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

        $dataObj = storage_path('facultycsv/entrance-exam-list.csv');
        $customerArr = $this->csvToArray($dataObj);
        // echo "<pre>";
        // print_r($customerArr);die;
        foreach($customerArr as $key => $value):
            if(($value['examsection_id'] != 'NULL') && ($value['fullname'] != 'NULL')){
                $examsection = ExamSection::findOrFail($value['examsection_id']);
                $createObj = New TypeOfExamination();
                if($value['sortname'] != 'NULL'){
                    $createObj->sortname = $value['sortname'];
                }
                if($value['fullname'] != 'NULL'){
                    $createObj->name = $value['fullname'];
                }
                if($value['status'] != 'NULL'){
                    $createObj->status = $value['status'];
                }
                if($value['examsection_id'] != 'NULL'){
                    $createObj->examsection_id = $value['examsection_id'];
                }
                if($value['examsection_id'] != 'NULL'){
                    $createObj->examsection_id = $value['examsection_id'];
                }
                $createObj->universityName = null;

                $createObj->functionalarea_id = $examsection->functionalarea_id;
                $createObj->employee_id = Auth::id();
                $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($value['sortname'])); 
                $slug = strtolower(trim($cleanChar));
                $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
                $slug = preg_replace('/-+/', "-", $slug);
                rtrim($slug, '-');
                $createObj->slug = $slug;
                $createObj->save();

                $degreeObj = DB::table('exam_sections')
                    ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                    ->leftjoin('degree', 'functionalarea.id', '=', 'degree.functionalarea_id')
                    ->where('exam_sections.id', '=', $value['examsection_id'])
                    ->select('degree.id as degreeId', 'degree.name')
                    ->orderBy('degree.name','ASC')
                    ->get();


                if (sizeof($degreeObj) > 0) {
                    foreach ($degreeObj as $key => $item) {
                        $addDegreeObj = New ExamListMultipleDegree;
                        $addDegreeObj->degree_id = $item->degreeId;
                        $addDegreeObj->typeOfExaminations_id = $createObj->id;
                        $addDegreeObj->examsection_id = $value['examsection_id'];
                        $cleanChar =  preg_replace('/[^a-zA-Z0-9]/', ' ', strtolower($item->name)); 
                        $slug1 = strtolower(trim($cleanChar));
                        $slug1 = preg_replace('/[^a-z0-9-]/', '-', $slug1);
                        $slug1 = preg_replace('/-+/', "-", $slug1);
                        rtrim($slug1, '-');
                        $addDegreeObj->degreeSlug = $slug1;
                        $addDegreeObj->functionalarea_id = $examsection->functionalarea_id;
                        $addDegreeObj->save();
                    }
                }

                $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                    ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                    ->where('type_of_examinations.id','=', $createObj->id)
                    ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as examinationSlug') 
                    ->first();

                $examinationUrl = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->examinationSlug.'/'.$typeOfExaminationObj->slug;

                $createExaminationDetail                        = New ExaminationDetail;
                if($value['fullname'] != 'NULL'){
                    $createExaminationDetail->title             = $value['fullname'];
                }
                $createExaminationDetail->description           = null;
                $createExaminationDetail->applicationFrom       = null;
                $createExaminationDetail->applicationTo         = null;
                $createExaminationDetail->exminationDate        = null;
                $createExaminationDetail->resultAnnounce        = null;
                $createExaminationDetail->imagealttext          = null;
                $createExaminationDetail->content               = null;
                $createExaminationDetail->getMoreInfoLink       = $examinationUrl;
                $createExaminationDetail->typeOfExaminations_id = $createObj->id;
                $createExaminationDetail->functionalarea_id     = $examsection->functionalarea_id;
                $createExaminationDetail->courses_id            = $createObj->id;
                $createExaminationDetail->slug                  = $createObj->slug;
                $createExaminationDetail->userId                = Auth::id();
                $createExaminationDetail->status                = 1;
                $createExaminationDetail->employee_id           = Auth::id();
                $createExaminationDetail->save();

                $createApplicationProcessObj                            =   New ExamApplicationProcess;
                if($value['modeofapplication'] != 'NULL'){
                    $createApplicationProcessObj->modeofapplication     = $value['modeofapplication'];
                }

                if($value['modeofpayment'] != 'NULL'){
                    $createApplicationProcessObj->modeofpayment         = $value['modeofpayment'];
                }

                if($value['examinationtype'] != 'NULL'){
                    $createApplicationProcessObj->examinationtype       = $value['examinationtype'];
                }

                if($value['applicationandexamstatus'] != 'NULL'){
                    $createApplicationProcessObj->applicationandexamstatus  = $value['applicationandexamstatus'];
                }

                if($value['examinationmode'] != 'NULL'){
                    $createApplicationProcessObj->examinationmode       = $value['examinationmode'];
                }

                if($value['eligibilitycriteria'] != 'NULL'){
                    $createApplicationProcessObj->eligibilitycriteria   = $value['eligibilitycriteria'];
                }

                $createApplicationProcessObj->typeOfExaminations_id     =   $createObj->id;
                $createApplicationProcessObj->employee_id               =   Auth::id();
                $createApplicationProcessObj->save();


                $this->info('####################################################################');
                $this->info('TypeOfExamination Id '.$createObj->id.' Process Started At : '.date('F d,Y h:i A'));

                $pagetitle = $value['sortname'].' '.$value['fullname'].' examination ';
                $pagedescription = $value['sortname'].' '.$value['fullname'].' examination details';
                $keyword = $value['sortname'];
                
                $this->info('Add New seo content for TypeOfExamination Id '.$createObj->id.' Process Started At : '.date('F d,Y h:i A'));
                    $seoContentCreateTypeOfExaminationObj = New SeoContent();
                    $seoContentCreateTypeOfExaminationObj->pagetitle = $pagetitle;
                    $seoContentCreateTypeOfExaminationObj->description = $pagedescription;
                    $seoContentCreateTypeOfExaminationObj->keyword = $keyword;
                    $seoContentCreateTypeOfExaminationObj->h1title = $pagetitle;
                    $seoContentCreateTypeOfExaminationObj->h2title = $pagetitle;
                    $seoContentCreateTypeOfExaminationObj->h3title = $pagetitle;
                    $seoContentCreateTypeOfExaminationObj->imagealttext     = $pagetitle;
                    $seoContentCreateTypeOfExaminationObj->content = $pagedescription;
                    $seoContentCreateTypeOfExaminationObj->examId = $createObj->id;
                    $seoContentCreateTypeOfExaminationObj->misc = 'examinationpage';
                    $seoContentCreateTypeOfExaminationObj->save();

                    $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateTypeOfExaminationObj->id);
                    $slugUrl = strtolower($slugUrl);
                    $seoContentCreateTypeOfExaminationObj->slugurl = $slugUrl;
                    $seoContentCreateTypeOfExaminationObj->save();
                $this->info('TypeOfExamination Id '.$createObj->id.' Process End At : '.date('F d,Y h:i A'));
                $this->info('####################################################################');
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