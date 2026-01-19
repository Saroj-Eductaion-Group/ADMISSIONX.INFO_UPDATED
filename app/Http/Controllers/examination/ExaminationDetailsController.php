<?php

namespace App\Http\Controllers\examination;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ExaminationDetail;
use Illuminate\Http\Request;
use Session;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use Excel;
use Config;
use PHPMailer;
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use GuzzleHttp\Client;
use App\Http\Controllers\website\WebsiteLogController;
use App\Models\ExaminationType;
use App\Models\ApplicationAndExamStatus;
use App\Models\ApplicationMode;
use App\Models\ExaminationMode;
use App\Models\EligibilityCriterion;
use App\Models\ExaminationImportantLink;
use App\Models\ExamSection;
use App\Models\TypeOfExamination;
use App\Models\ExamApplicationProcess;
use App\Models\ExamApplicationFee;
use App\Models\ExamEligibility;
use App\Models\ExamDate;
use App\Models\ExamSyllabusPaper;
use App\Models\ExamSyllabusPaperMark;
use App\Models\ExamPattern;
use App\Models\ExamAdmitCard;
use App\Models\ExamResult;
use App\Models\ExamCutOff;
use App\Models\ExamCounselling;
use App\Models\ExamCounsellingDate;
use App\Models\ExamCounsellingContact;
use App\Models\ExamPreprationTip;
use App\Models\ExamAnalysisRecord;
use App\Models\ExamAnswerKey;
use App\Models\ExamAnswerKeyEvent;
use App\Models\ExamFaq;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionAnswer;
use App\Models\ExamQuestionAnswerComment;
use App\Models\Degree as Degree;
use App\Http\Controllers\Helper\FetchDataServiceController;

class ExaminationDetailsController extends Controller
{
    protected $fetchDataServiceController;

    public function __construct(FetchDataServiceController $fetchDataServiceController)
    {
        $this->fetchDataServiceController = $fetchDataServiceController;
    }

    public function reviewAndUpdateExamFormDetails($examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->index == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->get();

        if (sizeof($typeOfExaminationObj) > 0) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $examApplicationProcessesObj    =  DB::table('exam_application_processes')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_application_processes.id', 'ASC')
                                                ->first();

            $examApplicationFeesObj         =  DB::table('exam_application_fees')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_application_fees.id', 'ASC')
                                                ->get();

            $examEligibilitiesObj           =  DB::table('exam_eligibilities')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_eligibilities.id', 'ASC')
                                                ->get();

            $examDatesObj                   =  DB::table('exam_dates')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_dates.id', 'ASC')
                                                ->get();

            $examSyllabusPapersObj          =  DB::table('exam_syllabus_papers')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_syllabus_papers.id', 'ASC')
                                                ->get();  

            $examSyllabusPaperMarksObj      =  DB::table('exam_syllabus_paper_marks')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_syllabus_paper_marks.id', 'ASC')
                                                ->get();

            $examPatternsObj                =  DB::table('exam_patterns')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_patterns.id', 'ASC')
                                                ->get();

            $examAdmitCardsObj              =  DB::table('exam_admit_cards')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_admit_cards.id', 'ASC')
                                                ->get();  

            $examResultsObj                 =  DB::table('exam_results')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_results.id', 'ASC')
                                                ->get();  

            $examCutOffsObj                 =  DB::table('exam_cut_offs')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_cut_offs.id', 'ASC')
                                                ->get();  

            $examCounsellingsObj            =  DB::table('exam_counsellings')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counsellings.id', 'ASC')
                                                ->get();  

            $examCounsellingDatesObj        =  DB::table('exam_counselling_dates')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counselling_dates.id', 'ASC')
                                                ->get();  

            $examCounsellingContactsObj     =  DB::table('exam_counselling_contacts')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counselling_contacts.id', 'ASC')
                                                ->get();  

            $examPreprationTipsObj          =  DB::table('exam_prepration_tips')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_prepration_tips.id', 'ASC')
                                                ->get(); 

            $examAnswerKeysObj              =  DB::table('exam_answer_keys')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_answer_keys.id', 'ASC')
                                                ->get();  

            $examAnswerKeyEventsObj         =  DB::table('exam_answer_key_events')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_answer_key_events.id', 'ASC')
                                                ->get();  

            $examAnalysisRecordsObj         =  DB::table('exam_analysis_records')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_analysis_records.id', 'ASC')
                                                ->get();  

            $examinationImportantLinksObj   =  DB::table('examination_important_links')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_important_links.id', 'ASC')
                                                ->get(); 

            $examFaqsObj                    =  DB::table('exam_faqs')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_faqs.id', 'ASC')
                                                ->get(); 

            $examQuestionsObj               =  DB::table('exam_questions')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_questions.id', 'ASC')
                                                ->get();  

            foreach ($examQuestionsObj as $key => $que) {
                $examQuestionAnswersObj         =  DB::table('exam_question_answers')
                                                    ->where('typeOfExaminations_id','=', $examId)
                                                    ->where('questionId','=', $que->id)
                                                    ->orderBy('exam_question_answers.id', 'ASC')
                                                    ->get(); 


                foreach ($examQuestionAnswersObj as $key => $ans) {
                    $ans->examQuestionAnswerCommentsObj  =  DB::table('exam_question_answer_comments')
                                                        ->where('typeOfExaminations_id','=', $examId)
                                                        ->where('questionId','=', $que->id)
                                                        ->where('answerId','=', $ans->id)
                                                        ->orderBy('exam_question_answer_comments.id', 'ASC')
                                                        ->get();  
                }

                $que->examQuestionAnswersObj   =  $examQuestionAnswersObj; 
            }

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.all-exam-form-details', compact('examinationDetailsObj','examApplicationProcessesObj','examApplicationFeesObj','examEligibilitiesObj','examDatesObj','examSyllabusPapersObj','examSyllabusPaperMarksObj','examPatternsObj','examAdmitCardsObj','examResultsObj','examCutOffsObj','examCounsellingsObj','examCounsellingDatesObj','examCounsellingContactsObj','examPreprationTipsObj','examQuestionsObj','examAnswerKeyEventsObj','examAnswerKeysObj','examAnalysisRecordsObj','examFaqsObj','examinationImportantLinksObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExaminationDetailsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  


            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-examination-details-partial', compact('examinationDetailsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        } 
    }

    public function getApplicationProcessesPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {

            $examApplicationProcessesObj    =  DB::table('exam_application_processes')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_application_processes.id', 'ASC')
                                                ->first();

            $examApplicationFeesObj         =  DB::table('exam_application_fees')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_application_fees.id', 'ASC')
                                                ->get();

            
            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-application-processes-partial', compact('examApplicationProcessesObj','examApplicationFeesObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamEligibilitiesPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $examEligibilitiesObj           =  DB::table('exam_eligibilities')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_eligibilities.id', 'ASC')
                                                ->get();

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-eligibilities-partial', compact('examinationDetailsObj','examEligibilitiesObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamDatesPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  


            $examDatesObj                   =  DB::table('exam_dates')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_dates.id', 'ASC')
                                                ->get();


            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-dates-partial', compact('examinationDetailsObj','examDatesObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamSyllabusPapersPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {

            $examSyllabusPapersObj          =  DB::table('exam_syllabus_papers')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_syllabus_papers.id', 'ASC')
                                                ->get();  

            $examSyllabusPaperMarksObj      =  DB::table('exam_syllabus_paper_marks')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_syllabus_paper_marks.id', 'ASC')
                                                ->get();

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-syllabus-papers-partial', compact('examSyllabusPapersObj','examSyllabusPaperMarksObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamPatternsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examPatternsObj                =  DB::table('exam_patterns')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_patterns.id', 'ASC')
                                                ->get();


            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-patterns-partial', compact('examPatternsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamAdmitCardsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $examAdmitCardsObj              =  DB::table('exam_admit_cards')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_admit_cards.id', 'ASC')
                                                ->get();  

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-admit-cards-partial', compact('examinationDetailsObj','examAdmitCardsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamResultsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  


            $examResultsObj                 =  DB::table('exam_results')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_results.id', 'ASC')
                                                ->get();  

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-results-partial', compact('examinationDetailsObj','examResultsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamCutOffsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examCutOffsObj                 =  DB::table('exam_cut_offs')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_cut_offs.id', 'ASC')
                                                ->get();  

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-cut-offs-partial', compact('examCutOffsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamCounsellingsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examCounsellingsObj            =  DB::table('exam_counsellings')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counsellings.id', 'ASC')
                                                ->get();  

            $examCounsellingDatesObj        =  DB::table('exam_counselling_dates')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counselling_dates.id', 'ASC')
                                                ->get();  

            $examCounsellingContactsObj     =  DB::table('exam_counselling_contacts')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_counselling_contacts.id', 'ASC')
                                                ->get();  

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-counsellings-partial', compact('examCounsellingsObj','examCounsellingDatesObj','examCounsellingContactsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamPreprationTipsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examPreprationTipsObj          =  DB::table('exam_prepration_tips')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_prepration_tips.id', 'ASC')
                                                ->get();  


            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-prepration-tips-partial', compact('examPreprationTipsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamAnswerKeyPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examAnswerKeysObj              =  DB::table('exam_answer_keys')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_answer_keys.id', 'ASC')
                                                ->get();  

            $examAnswerKeyEventsObj         =  DB::table('exam_answer_key_events')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_answer_key_events.id', 'ASC')
                                                ->get();  

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-answer-key-partial', compact('examAnswerKeyEventsObj','examAnswerKeysObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamAnalysisRecordsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;


        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();  

            $examAnalysisRecordsObj         =  DB::table('exam_analysis_records')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_analysis_records.id', 'ASC')
                                                ->get();  

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-analysis-records-partial', compact('examinationDetailsObj','examAnalysisRecordsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExaminationReferenceLinksPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examinationDetailsObj          =  DB::table('examination_details')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_details.id', 'ASC')
                                                ->first();

            $examinationImportantLinksObj   =  DB::table('examination_important_links')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('examination_important_links.id', 'ASC')
                                                ->get();

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-examination-reference-links-partial', compact('examinationDetailsObj','examinationImportantLinksObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getExamFaqsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examFaqsObj                    =  DB::table('exam_faqs')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_faqs.id', 'ASC')
                                                ->get(); 

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-exam-faqs-partial', compact('examFaqsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getAskExamQuestionsPartial($examId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examQuestionsObj               =  DB::table('exam_questions')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->orderBy('exam_questions.id', 'ASC')
                                                ->get();  

            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-ask-exam-questions-partial', compact('examQuestionsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function getAskExamQuestionsAnswerPartial($examId, $questionId)
    {
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        if (!empty($typeOfExaminationObj)) {
            $examQuestionsObj               =  DB::table('exam_questions')
                                                ->where('typeOfExaminations_id','=', $examId)
                                                ->where('id','=', $questionId)
                                                ->orderBy('exam_questions.id', 'ASC')
                                                ->get();  

            foreach ($examQuestionsObj as $key => $que) {
                $examQuestionAnswersObj         =  DB::table('exam_question_answers')
                                                    ->where('typeOfExaminations_id','=', $examId)
                                                    ->where('questionId','=', $que->id)
                                                    ->orderBy('exam_question_answers.id', 'ASC')
                                                    ->get(); 


                foreach ($examQuestionAnswersObj as $key => $ans) {
                    $ans->examQuestionAnswerCommentsObj  =  DB::table('exam_question_answer_comments')
                                                        ->where('typeOfExaminations_id','=', $examId)
                                                        ->where('questionId','=', $que->id)
                                                        ->where('answerId','=', $ans->id)
                                                        ->orderBy('exam_question_answer_comments.id', 'ASC')
                                                        ->get();  
                }

                $que->examQuestionAnswersObj   =  $examQuestionAnswersObj; 
            }


            $examinationType                = ExaminationType::get();
            $applicationAndExamStatus       = ApplicationAndExamStatus::get();
            $applicationMode                = ApplicationMode::get();
            $examinationMode                = ExaminationMode::get();
            $eligibilityCriterion           = EligibilityCriterion::get();

            $examDegreeObj                  = DB::table('exam_list_multiple_degrees')
                                                ->leftjoin('degree', 'exam_list_multiple_degrees.degree_id', '=', 'degree.id')
                                                ->select('degree.id as degreeId','degree.name as degreeName')
                                                ->where('exam_list_multiple_degrees.typeOfExaminations_id', '=', $examId)
                                                ->orderBy('degree.name', 'ASC')
                                                ->get();

            return view('examination.common-partial.partial-exam-pages.get-ask-exam-questions-answer-partial', compact('examQuestionsObj','examinationType','applicationAndExamStatus','applicationMode','examinationMode','eligibilityCriterion','examId','typeOfExaminationObj','examDegreeObj'));
        }else{
            return redirect('examination/type-of-examination');
        }
    }

    public function updateExamDetails(Request $request, $examId)
    {  
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        $getExaminationId = DB::table('examination_details')
                               ->where('typeOfExaminations_id', '=', $examId)
                               ->select('id')
                               ->orderBy('id','DESC')
                               ->take(1)
                               ->get();
        if(sizeof($getExaminationId) == 0):
            $createExaminationDetail                        = New ExaminationDetail;
        else:
            $createExaminationDetail                        = ExaminationDetail::findOrFail($getExaminationId[0]->id);
        endif;
            $createExaminationDetail->title                 = Input::get('examtitle');
            $createExaminationDetail->description           = Input::get('description');
            $createExaminationDetail->applicationFrom       = Input::get('applicationFrom');
            $createExaminationDetail->applicationTo         = Input::get('applicationTo');
            $createExaminationDetail->exminationDate        = Input::get('exminationDate');
            $createExaminationDetail->resultAnnounce        = Input::get('resultAnnounce');
            $createExaminationDetail->imagealttext          = Input::get('imagealttext');
            $createExaminationDetail->getMoreInfoLink       = Input::get('getMoreInfoLink');
            $createExaminationDetail->content               = Input::get('content');
            $createExaminationDetail->typeOfExaminations_id = $examId;
            $createExaminationDetail->functionalarea_id     = $typeOfExaminationObj->functionalarea_id;
            $createExaminationDetail->courses_id            = $typeOfExaminationObj->examsection_id;
            $createExaminationDetail->slug                  = $typeOfExaminationObj->slug;
            $createExaminationDetail->userId                = Auth::id();
            $createExaminationDetail->status                = 1;
            $createExaminationDetail->employee_id           = Auth::id();
            $createExaminationDetail->save();


            if($request->file('image')){
                $fileName = $typeOfExaminationObj->slug.".".$request->image->getClientOriginalExtension();
                $request->image->move(public_path('examinationlogo/'), $fileName);
                DB::table('examination_details')->where('examination_details.id', '=', $createExaminationDetail->id)->update(array('examination_details.image' => $fileName)); 
            }
        Session::flash('alert_class', 'alert-success');    
        Session::flash('flash_message', 'Examination details has been updated!');
        return Redirect::back();
    }

    public function updateExamApplicationProcess(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->where('type_of_examinations.id','=', $examId)
                ->first();

        $getApplicationProcessId = DB::table('exam_application_processes')
                               ->where('typeOfExaminations_id', '=', $examId)
                               ->select('id')
                               ->orderBy('id','DESC')
                               ->take(1)
                               ->get();

        if(sizeof($getApplicationProcessId) == 0):
            $createApplicationProcessObj                            = New ExamApplicationProcess;
        else:
            $createApplicationProcessObj                            = ExamApplicationProcess::findOrFail($getApplicationProcessId[0]->id);
        endif;
            $createApplicationProcessObj->modeofapplication         = Input::get('modeofapplication');
            $createApplicationProcessObj->modeofpayment             = Input::get('modeofpayment');
            $createApplicationProcessObj->examinationtype           = Input::get('examinationtype');
            $createApplicationProcessObj->applicationandexamstatus  = Input::get('applicationandexamstatus');
            $createApplicationProcessObj->examinationmode           = Input::get('examinationmode');
            $createApplicationProcessObj->eligibilitycriteria       = Input::get('eligibilitycriteria');
            $createApplicationProcessObj->description               = Input::get('description');
            $createApplicationProcessObj->typeOfExaminations_id     = $examId;
            $createApplicationProcessObj->employee_id               = Auth::id();
            $createApplicationProcessObj->save();


        DB::statement(DB::raw("DELETE FROM exam_application_fees WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('category'))) {
            $sizeOfApplicationFee = sizeof(Input::get('category'));
            for($applicationCounter = 0; $applicationCounter < $sizeOfApplicationFee; $applicationCounter++){
                $createObj                          = New ExamApplicationFee();
                $createObj->category                = Input::get('category')[$applicationCounter];
                $createObj->quota                   = Input::get('quota')[$applicationCounter];
                $createObj->mode                    = Input::get('mode')[$applicationCounter];
                $createObj->gender                  = Input::get('gender')[$applicationCounter];
                $createObj->amount                  = Input::get('amount')[$applicationCounter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination application process details has been updated!');
        return Redirect::back();
    }

    public function updateExamEligibility(Request $request, $examId)
    {   

        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $updateExaminationDetail                            = ExaminationDetail::findOrFail(Input::get('examDetailId'));
        $updateExaminationDetail->examEligibilityCriteria   = Input::get('examEligibilityCriteria');
        $updateExaminationDetail->typeOfExaminations_id     = $examId;
        $updateExaminationDetail->employee_id               = Auth::id();
        $updateExaminationDetail->save();

        DB::statement(DB::raw("DELETE FROM exam_eligibilities WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamEligibility();
                $createObj->degreeName              = $degreeObj->name;
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->description             = Input::get('description')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination eligibility details has been updated!');
        return Redirect::back();
    }

    public function updateExamDates(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $updateExaminationDetail                            = ExaminationDetail::findOrFail(Input::get('examDetailId'));
        $updateExaminationDetail->examDates                 = Input::get('examDates');
        $updateExaminationDetail->typeOfExaminations_id     = $examId;
        $updateExaminationDetail->employee_id               = Auth::id();
        $updateExaminationDetail->save();

        DB::statement(DB::raw("DELETE FROM exam_dates WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamDate();
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->degreeName              = $degreeObj->name;
                $createObj->eventDate               = Input::get('eventDate')[$counter];
                $createObj->eventName               = Input::get('eventName')[$counter];
                $createObj->eventStatus             = Input::get('eventStatus')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination dates details has been updated!');
        return Redirect::back();
    }

    public function updateExaminationSyllabus(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        // echo "<pre>";
        // print_r(Input::get('degreeId'));die;
        DB::statement(DB::raw("DELETE FROM exam_syllabus_papers WHERE (typeOfExaminations_id = $examId)"));
        DB::statement(DB::raw("DELETE FROM exam_syllabus_paper_marks WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamSyllabusPaper();
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->degreeName              = $degreeObj->name;
                $createObj->paperName               = Input::get('paperName')[$counter];
                $createObj->totalMark               = Input::get('totalMark')[$counter];
                $createObj->description             = Input::get('description')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();

                if (!empty(Input::get('unitName'.$degreeObj->id))) {
                    $sizeOfPaperMarks = sizeof(Input::get('unitName'.$degreeObj->id));
                    for($counter1 = 0; $counter1 < $sizeOfPaperMarks; $counter1++){
                        $paperMarksObj                          = New ExamSyllabusPaperMark();
                        $paperMarksObj->degreeId                = Input::get('degreeId')[$counter];
                        $paperMarksObj->degreeName              = $degreeObj->name;
                        $paperMarksObj->unitName                = Input::get('unitName'.$degreeObj->id)[$counter1];
                        $paperMarksObj->topicname               = Input::get('topicname'.$degreeObj->id)[$counter1];
                        $paperMarksObj->topicDesc               = Input::get('topicDesc'.$degreeObj->id)[$counter1];
                        $paperMarksObj->typeOfExaminations_id   = $examId;
                        $paperMarksObj->examSyllabusPaperId     = $createObj->id;
                        $paperMarksObj->employee_id             = Auth::id();
                        $paperMarksObj->save();

                    }
                }
            }
                
                Session::flash('alert_class', 'alert-success');}
        Session::flash('flash_message', 'Examination syllabus details has been updated!');
        return Redirect::back();
    }

    public function updateExaminationPatterns(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::statement(DB::raw("DELETE FROM exam_patterns WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();
                if (!empty(Input::get('modeOfExam')[$counter])) {
                    $createObj                          = New ExamPattern();
                    $createObj->degreeId                = Input::get('degreeId')[$counter];
                    $createObj->degreeName              = $degreeObj->name;
                    $createObj->modeOfExam              = Input::get('modeOfExam')[$counter];
                    $createObj->examDuration            = Input::get('examDuration')[$counter];
                    $createObj->totalQuestion           = Input::get('totalQuestion')[$counter];
                    $createObj->totalMarks              = Input::get('totalMarks')[$counter];
                    $createObj->section                 = Input::get('section')[$counter];
                    $createObj->languageofpaper         = Input::get('languageofpaper')[$counter];
                    $createObj->markingSchem            = Input::get('markingSchem')[$counter];
                    $createObj->patternDesc             = Input::get('patternDesc')[$counter];
                    $createObj->typeOfExaminations_id   = $examId;
                    $createObj->employee_id             = Auth::id();
                    $createObj->save();
                }

            }
                
                Session::flash('alert_class', 'alert-success');}
        Session::flash('flash_message', 'Examination pattern details has been updated!');
        return Redirect::back();
    }

    public function updateExamAdmitCard(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $updateExaminationDetail                            = ExaminationDetail::findOrFail(Input::get('examDetailId'));
        $updateExaminationDetail->admidCardDesc             = Input::get('admidCardDesc');
        $updateExaminationDetail->admidCardInstructions     = Input::get('admidCardInstructions');
        $updateExaminationDetail->typeOfExaminations_id     = $examId;
        $updateExaminationDetail->employee_id               = Auth::id();
        $updateExaminationDetail->save();

        DB::statement(DB::raw("DELETE FROM exam_admit_cards WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamAdmitCard();
                $createObj->degreeName              = $degreeObj->name;
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->description             = Input::get('description')[$counter];
                $createObj->rebemberPoints          = Input::get('rebemberPoints')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination admit card details has been updated!');
        return Redirect::back();
    }

    public function updateExamResults(Request $request, $examId)
    {  
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $updateExaminationDetail                            = ExaminationDetail::findOrFail(Input::get('examDetailId'));
        $updateExaminationDetail->examResultDesc            = Input::get('examResultDesc');
        $updateExaminationDetail->typeOfExaminations_id     = $examId;
        $updateExaminationDetail->employee_id               = Auth::id();
        $updateExaminationDetail->save();

        DB::statement(DB::raw("DELETE FROM exam_results WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamResult();
                $createObj->degreeName              = $degreeObj->name;
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->description             = Input::get('description')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination result details has been updated!');
        return Redirect::back();
    }

    public function updateExamCutOffs(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::statement(DB::raw("DELETE FROM exam_cut_offs WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamCutOff();
                $createObj->degreeName              = $degreeObj->name;
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->description             = Input::get('description')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination cut-off details has been updated!');
        return Redirect::back();
    }

    public function updateExamCounsellingProcedure(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::statement(DB::raw("DELETE FROM exam_counsellings WHERE (typeOfExaminations_id = $examId)"));
        DB::statement(DB::raw("DELETE FROM exam_counselling_dates WHERE (typeOfExaminations_id = $examId)"));
        DB::statement(DB::raw("DELETE FROM exam_counselling_contacts WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamCounselling();
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->degreeName              = $degreeObj->name;
                $createObj->modeofcounselling       = Input::get('modeofcounselling')[$counter];
                $createObj->description             = Input::get('description')[$counter];
                $createObj->counsellingProcedure    = Input::get('counsellingProcedure')[$counter];
                $createObj->documentsRequired       = Input::get('documentsRequired')[$counter];
                $createObj->websiteLink             = Input::get('websiteLink')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();

                if (!empty(Input::get('mode'.$degreeObj->id))) {
                    $sizeOfCounsellingDates = sizeof(Input::get('mode'.$degreeObj->id));
                    for($counter1 = 0; $counter1 < $sizeOfCounsellingDates; $counter1++){
                        $counsellingDateObj                          = New ExamCounsellingDate();
                        $counsellingDateObj->degreeId                = Input::get('degreeId')[$counter];
                        $counsellingDateObj->degreeName              = $degreeObj->name;
                        $counsellingDateObj->modeofcounselling       = Input::get('mode'.$degreeObj->id)[$counter1];
                        $counsellingDateObj->eventName               = Input::get('eventName'.$degreeObj->id)[$counter1];
                        $counsellingDateObj->eventDate               = Input::get('eventDate'.$degreeObj->id)[$counter1];
                        $counsellingDateObj->typeOfExaminations_id   = $examId;
                        $counsellingDateObj->employee_id             = Auth::id();
                        $counsellingDateObj->save();
                    }
                }

                if (!empty(Input::get('contactPersonName'.$degreeObj->id))) {
                    $sizeOfCounsellingContacts = sizeof(Input::get('contactPersonName'.$degreeObj->id));
                    for($counter2 = 0; $counter2 < $sizeOfCounsellingContacts; $counter2++){
                        $counsellingContactObj                          = New ExamCounsellingContact();
                        $counsellingContactObj->degreeId                = Input::get('degreeId')[$counter];
                        $counsellingContactObj->degreeName              = $degreeObj->name;
                        $counsellingContactObj->contactPersonName       = Input::get('contactPersonName'.$degreeObj->id)[$counter2];
                        $counsellingContactObj->contactNumber           = Input::get('contactNumber'.$degreeObj->id)[$counter2];
                        $counsellingContactObj->typeOfExaminations_id   = $examId;
                        $counsellingContactObj->employee_id             = Auth::id();
                        $counsellingContactObj->save();
                    }
                }
            }
                
                Session::flash('alert_class', 'alert-success');}
        Session::flash('flash_message', 'Examination counselling procedure details has been updated!');
        return Redirect::back();
    }

    public function updateExamPrepration(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::statement(DB::raw("DELETE FROM exam_prepration_tips WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamPreprationTip();
                $createObj->degreeName              = $degreeObj->name;
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->description             = Input::get('description')[$counter];
                $createObj->booksName               = Input::get('booksName')[$counter];
                $createObj->importantTopics         = Input::get('importantTopics')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination prepration tips details has been updated!');
        return Redirect::back();
    }

    public function updateExamAnswerKeys(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::statement(DB::raw("DELETE FROM exam_answer_keys WHERE (typeOfExaminations_id = $examId)"));
        DB::statement(DB::raw("DELETE FROM exam_answer_key_events WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                $createObj                          = New ExamAnswerKey();
                $createObj->degreeId                = Input::get('degreeId')[$counter];
                $createObj->degreeName              = $degreeObj->name;
                $createObj->description             = Input::get('description')[$counter];
                $createObj->importantDesc           = Input::get('importantDesc')[$counter];
                $createObj->papername               = Input::get('papername')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->employee_id             = Auth::id();
                $createObj->save();

                if (!empty(Input::get('paperName'.$degreeObj->id))) {
                    $sizeOfPaperMarks = sizeof(Input::get('paperName'.$degreeObj->id));
                    for($counter1 = 0; $counter1 < $sizeOfPaperMarks; $counter1++){
                        if(!empty(Input::get('examAnswerKeyEventId')[$counter])):
                            $examAnswerKeyEventObj                          = ExamAnswerKeyEvent::findOrFail(Input::get('examAnswerKeyEventId')[$counter]);
                        else:
                            $examAnswerKeyEventObj                          = New ExamAnswerKeyEvent;
                        endif;

                        $examAnswerKeyEventObj->degreeId                = Input::get('degreeId')[$counter];
                        $examAnswerKeyEventObj->degreeName              = $degreeObj->name;
                        $examAnswerKeyEventObj->paperName               = Input::get('paperName'.$degreeObj->id)[$counter1];
                        $examAnswerKeyEventObj->dates                   = Input::get('dates'.$degreeObj->id)[$counter1];
                        $examAnswerKeyEventObj->links                   = Input::get('links'.$degreeObj->id)[$counter1];
                        $examAnswerKeyEventObj->examAnswerKeyID         = $createObj->id;
                        $examAnswerKeyEventObj->typeOfExaminations_id   = $examId;
                        $examAnswerKeyEventObj->employee_id             = Auth::id();
                        $examAnswerKeyEventObj->save();

                        if (!empty($request->file('files'.$degreeObj->id)[$counter1])) {
                            if($request->file('files'.$degreeObj->id)[$counter1]){
                                $objName = 'files'.$degreeObj->id;
                                $currentMyTime = round(microtime(true) * 1000).'_'.uniqid();
                                $fileName = $currentMyTime.'-'.$examAnswerKeyEventObj->id.".".$request->$objName[$counter1]->getClientOriginalExtension();

                                $request->$objName[$counter1]->move(public_path('examinationlogo/'), $fileName);
                                DB::table('exam_answer_key_events')->where('exam_answer_key_events.id', '=', $examAnswerKeyEventObj->id)->update(array('exam_answer_key_events.files' => $fileName));
                            }
                        }
                    }
                }
            }
                
                Session::flash('alert_class', 'alert-success');}
        Session::flash('flash_message', 'Examination answer keys details has been updated!');
        return Redirect::back();
    }

    public function updateReferenceLinks(Request $request, $examId)
    {  
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::statement(DB::raw("DELETE FROM examination_important_links WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('title'))) {
            $sizeOfRefLinks = sizeof(Input::get('title'));
            for($counter = 0; $counter < $sizeOfRefLinks; $counter++){
                $createObj                          = New ExaminationImportantLink();
                $createObj->title                   = Input::get('title')[$counter];
                $createObj->url                     = Input::get('url')[$counter];
                $createObj->typeOfExaminations_id   = $examId;
                $createObj->examinationDetailsId    = Input::get('examDetailId');
                $createObj->employee_id             = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination reference links has been updated!');
        return Redirect::back();
    }

    public function updateExamAnalysisRecords(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $updateExaminationDetail                            = ExaminationDetail::findOrFail(Input::get('examDetailId'));
        $updateExaminationDetail->examAnalysisDesc          = Input::get('examAnalysisDesc');
        $updateExaminationDetail->typeOfExaminations_id     = $examId;
        $updateExaminationDetail->employee_id               = Auth::id();
        $updateExaminationDetail->save();
        
        if (!empty(Input::get('degreeId'))) {
            $sizeOfDegree = sizeof(Input::get('degreeId'));
            for($counter = 0; $counter < $sizeOfDegree; $counter++){
                $degreeObj                         = Degree::orderBy('degree.id' ,'ASC')
                                                    ->where('degree.id','=', Input::get('degreeId')[$counter])
                                                    ->first();

                if(!empty(Input::get('examAnalysisRecordId')[$counter])):
                    $createObj                          = ExamAnalysisRecord::findOrFail(Input::get('examAnalysisRecordId')[$counter]);
                else:
                    $createObj                          = New ExamAnalysisRecord;
                endif;
                    $createObj->degreeId                = Input::get('degreeId')[$counter];
                    $createObj->degreeName              = $degreeObj->name;
                    $createObj->description             = Input::get('description')[$counter];
                    $createObj->papername               = Input::get('papername')[$counter];
                    $createObj->typeOfExaminations_id   = $examId;
                    $createObj->employee_id             = Auth::id();
                    $createObj->save();

                if (!empty($request->file('analysisfiles')[$counter])) {
                    if($request->file('analysisfiles')[$counter]){
                        $currentMyTime = round(microtime(true) * 1000).'_'.uniqid();
                        $fileName = $currentMyTime.'-'.$createObj->id.".".$request->analysisfiles[$counter]->getClientOriginalExtension();

                        $request->analysisfiles[$counter]->move(public_path('examinationlogo/'), $fileName);
                        DB::table('exam_analysis_records')->where('exam_analysis_records.id', '=', $createObj->id)->update(array('exam_analysis_records.files' => $fileName));
                    }
                }
            }
                
                Session::flash('alert_class', 'alert-success');}
        Session::flash('flash_message', 'Examination analysis record details has been updated!');
        return Redirect::back();
    }

    public function updateExamFaqs(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('TypeOfExamination');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->updated == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        DB::statement(DB::raw("DELETE FROM exam_faqs WHERE (typeOfExaminations_id = $examId)"));
        if (!empty(Input::get('question'))) {
            $sizeOfQuestion = sizeof(Input::get('question'));
            for($faqCounter = 0; $faqCounter < $sizeOfQuestion; $faqCounter++){
                $createObj = New ExamFaq();
                $createObj->question = Input::get('question')[$faqCounter];
                $createObj->answer = Input::get('answer')[$faqCounter];
                $createObj->refLinks = Input::get('refLinks')[$faqCounter];
                $createObj->typeOfExaminations_id = $examId;
                $createObj->employee_id = Auth::id();
                $createObj->save();
            }
        }
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination faqs has been updated!');
        return Redirect::back();
    }

    public function addExamQuestionByAdmin(Request $request, $examId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestion');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->created == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $createObj = New ExamQuestion();
        $createObj->questionDate = date('Y-m-d H:i:s');
        $createObj->question = Input::get('question');
        $createObj->userId = Auth::id();
        $createObj->typeOfExaminations_id = $examId;
        $createObj->employee_id = Auth::id();
        $createObj->save();
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination question has been created!');
        return Redirect::back();
    }

    public function addExamQuestionAnswerByAdmin(Request $request, $examId, $questionId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswer');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->created == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;

        $createObj = New ExamQuestionAnswer();
        $createObj->answer = Input::get('answer');
        $createObj->answerDate = date('Y-m-d H:i:s');
        $createObj->questionId = $questionId;
        $createObj->typeOfExaminations_id = $examId;
        $createObj->employee_id = Auth::id();
        $createObj->userId = Auth::id();
        $createObj->save();
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination answer has been updated!');
        return Redirect::back();
    }

    public function addExamQuestionAnswerCommentByAdmin(Request $request, $examId, $questionId, $answerId)
    {   
        if(Auth::check()):
            if(Auth::user()->userrole_id == 4):
                $validateUserRoleCall = $this->fetchDataServiceController->validateUserRoleCall('ExamQuestionAnswerComment');
                if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->created == '0')):
                    return Redirect::back();
                endif;
            endif;
        else:
            Auth::logout(); // logout user
            return Redirect::to('login'); //redirect back to login
        endif;
        
        $createObj = New ExamQuestionAnswerComment();
        $createObj->replyanswer = Input::get('replyanswer');
        $createObj->answerDate = date('Y-m-d H:i:s');
        $createObj->answerId = $answerId;
        $createObj->questionId = $questionId;
        $createObj->typeOfExaminations_id = $examId;
        $createObj->employee_id = Auth::id();
        $createObj->userId = Auth::id();
        $createObj->save();
        
        Session::flash('alert_class', 'alert-success');
        Session::flash('flash_message', 'Examination comment has been updated!');
        return Redirect::back();
    }

    public function addExamQuestion(Request $request, $examId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $question = Input::get('question');

            self::submitExamQuestion($examId, $question, $userId);
            
            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Examination question has been created!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function submitExamQuestion($examId, $question, $userId)
    {
        $createObj = New ExamQuestion();
        $createObj->questionDate = date('Y-m-d H:i:s');
        $createObj->question = $question;
        $createObj->userId = Auth::id();
        $createObj->typeOfExaminations_id = $examId;
        $createObj->employee_id = Auth::id();
        $createObj->save();

        $userDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=', $userId)
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->first();


        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('type_of_examinations.id','=', $examId)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                ->first();

        $examinationName        = $typeOfExaminationObj->sortname.' '.$typeOfExaminationObj->name; 
        $userName               = $userDetailsObj->fullname;
        $userEmail              = $userDetailsObj->email;
        $examinationUrl         = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/questions';

        $bodyContent    =   '<p><b>User Details :</b></p>
                            <ul>
                                <li>User Name : '.$userName.'</li>
                                <li>Email : '.$userEmail.'</li>
                            </ul>
                            <p><b>Examination Question Details :</b></p>
                            <ul>
                                <li>Question            : '.$question.'</li>
                                <li>Examination Name    : '.$examinationName.'</li>
                                <li>Page Url            : '.$examinationUrl.'</li>
                            </ul>';

        $send_to = $userEmail;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $userName;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        // $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
        //         ->where('users.userstatus_id','=', '1')
        //         ->where('users.userrole_id','=', '1')
        //         ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
        //         ->get();

        // $slug1 = 'submit_question_answer_comment';
        // foreach ($getTheEmailAdmin as $key => $value) {
        //     $fullname1 = $value->fullname;
        //     $send_to1 = $value->email;
        //     $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        //     $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        // }

        // if(Auth::check() && (Auth::user()->userrole_id == 1)){
        //     $msg = 'Examination question has been added successfully!';
        // }else{
        //     $msg = 'Examination question has been added successfully!, Your answer approval is under process!';
        // }
        $msg = 'Examination question has been added successfully!';

        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }

    public function addExamQuestionAnswer(Request $request, $examId, $questionId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $answer = Input::get('answer');

            self::submitExamQuestionAnswer($examId, $questionId, $answer, $userId);
            
            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Examination answer has been added successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function submitExamQuestionAnswer($examId, $questionId, $answer, $userId)
    {
        $createObj = New ExamQuestionAnswer();
        $createObj->answer = $answer;
        $createObj->answerDate = date('Y-m-d H:i:s');
        $createObj->questionId = $questionId;
        $createObj->typeOfExaminations_id = $examId;
        $createObj->employee_id = Auth::id();
        $createObj->userId = Auth::id();
        $createObj->save();

        $userDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=', $userId)
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->first();


        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('type_of_examinations.id','=', $examId)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                ->first();

        $questionObj = ExamQuestion::orderBy('exam_questions.id' ,'DESC')
                ->where('exam_questions.id','=',$questionId)
                ->first();

        $examinationName        = $typeOfExaminationObj->sortname.' '.$typeOfExaminationObj->name; 
        $userName               = $userDetailsObj->fullname;
        $userEmail              = $userDetailsObj->email;
        $examinationUrl         = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/'.$questionId.'/question-details';

        $bodyContent    =   '<p><b>User Details :</b></p>
                            <ul>
                                <li>User Name : '.$userName.'</li>
                                <li>Email : '.$userEmail.'</li>
                            </ul>
                            <p><b>Answer Details :</b></p>
                            <ul>
                                <li>Question            : '.$questionObj->question.'</li>
                                <li>Answer              : '.$answer.'</li>
                                <li>Examination Name    : '.$examinationName.'</li>
                                <li>Page Url            : '.$examinationUrl.'</li>
                            </ul>';

        $send_to = $userEmail;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $userName;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        // $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
        //         ->where('users.userstatus_id','=', '1')
        //         ->where('users.userrole_id','=', '1')
        //         ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
        //         ->get();

        // $slug1 = 'submit_question_answer_comment';
        // foreach ($getTheEmailAdmin as $key => $value) {
        //     $fullname1 = $value->fullname;
        //     $send_to1 = $value->email;
        //     $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        //     $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        // }

        $msg = 'Examination question has been added successfully!';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }

    public function addExamQuestionAnswerComment(Request $request, $examId, $questionId, $answerId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $replyanswer = Input::get('replyanswer');

            self::submitExamQuestionAnswerComment($examId, $questionId, $answerId, $replyanswer, $userId);
            
            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Examination comment has been added successfully!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function submitExamQuestionAnswerComment($examId, $questionId, $answerId, $replyanswer, $userId)
    {
        $createObj = New ExamQuestionAnswerComment();
        $createObj->replyanswer = $replyanswer;
        $createObj->answerDate = date('Y-m-d H:i:s');
        $createObj->answerId = $answerId;
        $createObj->questionId = $questionId;
        $createObj->typeOfExaminations_id = $examId;
        $createObj->employee_id = Auth::id();
        $createObj->userId = Auth::id();
        $createObj->save();

        $userDetailsObj = User::orderBy('users.id' ,'DESC')
                ->where('users.id','=', $userId)
                ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                ->first();

        $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                ->where('type_of_examinations.id','=', $examId)
                ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                ->first();

        $questionObj = ExamQuestion::orderBy('exam_questions.id' ,'DESC')
                ->where('exam_questions.id','=',$questionId)
                ->first();

        $answerObj = ExamQuestionAnswer::orderBy('exam_question_answers.id' ,'DESC')
                ->where('exam_question_answers.id','=',$answerId)
                ->where('exam_question_answers.questionId','=',$questionId)
                ->first();

        $examinationName        = $typeOfExaminationObj->sortname.' '.$typeOfExaminationObj->name; 
        $userName               = $userDetailsObj->fullname;
        $userEmail              = $userDetailsObj->email;
        $examinationUrl         = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/'.$questionId.'/question-details';

        $bodyContent    =   '<p><b>User Details :</b></p>
                            <ul>
                                <li>User Name : '.$userName.'</li>
                                <li>Email : '.$userEmail.'</li>
                            </ul>
                            <p><b>Comment Details :</b></p>
                            <ul>
                                <li>Question            : '.$questionObj->question.'</li>
                                <li>Answer              : '.$answerObj->answer.'</li>
                                <li>Comments            : '.$replyanswer.'</li>
                                <li>Examination Name    : '.$examinationName.'</li>
                                <li>Page Url            : '.$examinationUrl.'</li>
                            </ul>';

        $send_to = $userEmail;
        $send_cc = null;
        $send_bcc = null;
        $slug = 'send_response_email';
        $title =  Config::get('systemsetting.TITLE');
        $form_name = $userName;

        $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

        // $getTheEmailAdmin = User::orderBy('users.id' ,'DESC')
        //         ->where('users.userstatus_id','=', '1')
        //         ->where('users.userrole_id','=', '1')
        //         ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
        //         ->get();

        // $slug1 = 'submit_question_answer_comment';
        // foreach ($getTheEmailAdmin as $key => $value) {
        //     $fullname1 = $value->fullname;
        //     $send_to1 = $value->email;
        //     $array1   =  array("[NAME]" => $fullname1, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
        //     $sendmail1 = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to1 , $slug1, $array1);
        // }

        $msg = 'Examination comment has been added successfully!';
        
        Session::set('is_open_popup_window_status', 1);
        Session::set('is_open_popup_window_text', $msg);

        return true;
    }

    public function updateQuestionAnswer(Request $request, $questionId, $answerId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $checkUser = DB::table('exam_question_answers')
                            ->where('exam_question_answers.id','=',$answerId)
                            ->where('exam_question_answers.questionId','=',$questionId)
                            ->where('exam_question_answers.userId', '=', $userId)
                            ->get();

            if (sizeof($checkUser) > 0) {
                $createObj = ExamQuestionAnswer::findOrFail($answerId);
                $createObj->answer = Input::get('answer');
                $createObj->questionId = $questionId;
                $createObj->employee_id = Auth::id();
                //$createObj->userId = Auth::id();
                $createObj->save();

                $userDetailsObj = User::orderBy('users.id' ,'DESC')
                    ->where('users.id','=', $userId)
                    ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                    ->first();

                $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->where('type_of_examinations.id','=', $createObj->typeOfExaminations_id)
                        ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                        ->first();

                $questionObj = ExamQuestion::orderBy('exam_questions.id' ,'DESC')
                        ->where('exam_questions.id','=',$questionId)
                        ->first();

                $examinationName        = $typeOfExaminationObj->sortname.' '.$typeOfExaminationObj->name; 
                $userName               = $userDetailsObj->fullname;
                $userEmail              = $userDetailsObj->email;
                $examinationUrl         = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/'.$questionId.'/question-details';

                $bodyContent    =   '<p><b>User Details :</b></p>
                                    <ul>
                                        <li>User Name : '.$userName.'</li>
                                        <li>Email : '.$userEmail.'</li>
                                    </ul>
                                    <p><b>Answer Details :</b></p>
                                    <ul>
                                        <li>Question            : '.$questionObj->question.'</li>
                                        <li>Answer              : '.Input::get('answer').'</li>
                                        <li>Examination Name    : '.$examinationName.'</li>
                                        <li>Page Url            : '.$examinationUrl.'</li>
                                    </ul>';

                $send_to = $userEmail;
                $send_cc = null;
                $send_bcc = null;
                $slug = 'send_response_email';
                $title =  Config::get('systemsetting.TITLE');
                $form_name = $userName;

                $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
                $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

                Session::flash('alert_class', 'alert-success');
                Session::flash('flash_message', 'Answer has been updated successfully!');
                return Redirect::back();
            }else{
                Session::flash('alert_class', 'alert-danger');
                Session::flash('flash_message', 'You are not authorize person for this answer');
                return Redirect::back();
            }
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function updateQuestionAnswerComment(Request $request, $questionId, $answerId, $commentId)
    {   
        if (Auth::check()){   
            $userId = Auth::id();
            $checkUser = DB::table('exam_question_answer_comments')
                            ->where('exam_question_answer_comments.id','=',$commentId)
                            ->where('exam_question_answer_comments.answerId','=',$answerId)
                            ->where('exam_question_answer_comments.questionId','=',$questionId)
                            ->where('exam_question_answer_comments.userId', '=', $userId)
                            ->get();

            if (sizeof($checkUser) > 0) {
                $createObj = ExamQuestionAnswerComment::findOrFail($commentId);
                $createObj->replyanswer = Input::get('replyanswer');
                $createObj->answerId = $answerId;
                $createObj->questionId = $questionId;
                $createObj->employee_id = Auth::id();
                //$createObj->userId = Auth::id();
                $createObj->save();

                $userDetailsObj = User::orderBy('users.id' ,'DESC')
                    ->where('users.id','=', $userId)
                    ->select('users.id','email','firstname','middlename','lastname', DB::raw("CONCAT(IFNULL(users.firstname,''),' ',IFNULL(users.middlename,''),' ',IFNULL(users.lastname,'')) as fullname"))
                    ->first();

                $typeOfExaminationObj = TypeOfExamination::orderBy('type_of_examinations.id' ,'DESC')
                        ->leftjoin('exam_sections', 'type_of_examinations.examsection_id', '=', 'exam_sections.id')
                        ->where('type_of_examinations.id','=', $createObj->typeOfExaminations_id)
                        ->select('type_of_examinations.id','sortname', 'type_of_examinations.name', 'type_of_examinations.slug','exam_sections.slug as streamSlug') 
                        ->first();

                $questionObj = ExamQuestion::orderBy('exam_questions.id' ,'DESC')
                        ->where('exam_questions.id','=',$questionId)
                        ->first();

                $answerObj = ExamQuestionAnswer::orderBy('exam_question_answers.id' ,'DESC')
                        ->where('exam_question_answers.id','=',$answerId)
                        ->where('exam_question_answers.questionId','=',$questionId)
                        ->first();

                $examinationName        = $typeOfExaminationObj->sortname.' '.$typeOfExaminationObj->name; 
                $userName               = $userDetailsObj->fullname;
                $userEmail              = $userDetailsObj->email;
                $examinationUrl         = env('APP_URL').'/examination-details/'.$typeOfExaminationObj->streamSlug.'/'.$typeOfExaminationObj->slug.'/'.$questionId.'/question-details';

                $bodyContent    =   '<p><b>User Details :</b></p>
                                    <ul>
                                        <li>User Name : '.$userName.'</li>
                                        <li>Email : '.$userEmail.'</li>
                                    </ul>
                                    <p><b>Comment Details :</b></p>
                                    <ul>
                                        <li>Question            : '.$questionObj->question.'</li>
                                        <li>Answer              : '.$answerObj->answer.'</li>
                                        <li>Comments            : '.Input::get('replyanswer').'</li>
                                        <li>Examination Name    : '.$examinationName.'</li>
                                        <li>Page Url            : '.$examinationUrl.'</li>
                                    </ul>';

                $send_to = $userEmail;
                $send_cc = null;
                $send_bcc = null;
                $slug = 'send_response_email';
                $title =  Config::get('systemsetting.TITLE');
                $form_name = $userName;

                $array   =  array("[NAME]" => $form_name, "[TITLE]" => $title, '[COMMENTS]' => $bodyContent);
                $sendmail = app('App\Http\Controllers\Helper\FetchDataServiceController')->sendEmailTemplateViaSupport($send_to, $slug, $array);

                Session::flash('alert_class', 'alert-success');
                Session::flash('flash_message', 'Comment has been updated successfully!');
                return Redirect::back();
            }else{
                Session::flash('alert_class', 'alert-danger');
                Session::flash('flash_message', 'You are not authorize person for this answer');
                return Redirect::back();
            }
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }

    public function deleteExamQuestion($examId, $questionId)
    {   
        if (Auth::check()){ 
            Db::table('exam_question_answer_comments')
                ->where('exam_question_answer_comments.questionId', '=', $questionId)
                ->where('exam_question_answer_comments.typeOfExaminations_id', '=', $examId)
                ->delete();

            Db::table('exam_question_answers')
                ->where('exam_question_answers.questionId', '=', $questionId)
                ->where('exam_question_answers.typeOfExaminations_id', '=', $examId)
                ->delete();

            Db::table('exam_questions')
                ->where('exam_questions.id', '=', $questionId)
                ->where('typeOfExaminations_id', '=', $examId)
                ->delete();
            
            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Examination question deleted!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'You are not authorize person for this answer. Please login first!'); 
            return Redirect::back();
        }
    }

    public function deleteExamQuestionAnswer($examId, $questionId, $answerId)
    {   
        if (Auth::check()){ 
            Db::table('exam_question_answer_comments')
                ->where('exam_question_answer_comments.questionId', '=', $questionId)
                ->where('exam_question_answer_comments.answerId', '=', $answerId)
                ->where('exam_question_answer_comments.typeOfExaminations_id', '=', $examId)
                ->delete();

            Db::table('exam_question_answers')
                ->where('exam_question_answers.questionId', '=', $questionId)
                ->where('exam_question_answers.id', '=', $answerId)
                ->where('exam_question_answers.typeOfExaminations_id', '=', $examId)
                ->delete();
            
            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Examination question answer!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'You are not authorize person for this answer. Please login first!'); 
            return Redirect::back();
        }
    }

    public function deleteExamQuestionAnswerComment($examId, $questionId, $answerId, $commentId)
    {   
        if (Auth::check()){ 
            Db::table('exam_question_answer_comments')
                ->where('exam_question_answer_comments.id', '=', $commentId)
                ->where('exam_question_answer_comments.questionId', '=', $questionId)
                ->where('exam_question_answer_comments.answerId', '=', $answerId)
                ->where('exam_question_answer_comments.typeOfExaminations_id', '=', $examId)
                ->delete();
            
            Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Examination question comments!');
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'You are not authorize person for this answer. Please login first!'); 
            return Redirect::back();
        }
    }

    public function deleteExamAnswerKeyEvents($examId, $answerKeyId)
    {   
        if (Auth::check()){ 
             $fileObj     = ExamAnswerKeyEvent::orderBy('exam_answer_key_events.id' ,'ASC')
                                ->where('exam_answer_key_events.id','=', $answerKeyId)
                                ->where('exam_answer_key_events.typeOfExaminations_id','=', $examId)
                                ->first();

            $publicFolderPath = public_path().'/examinationlogo';

            if (file_exists($publicFolderPath.$fileObj->files) && !empty($fileObj->files)) {
                unlink($publicFolderPath.$fileObj->files);
            }
                   
            Db::table('exam_answer_key_events')
                ->where('exam_answer_key_events.id', '=', $answerKeyId)
                ->where('exam_answer_key_events.typeOfExaminations_id', '=', $examId)
                ->delete();


                    Session::flash('alert_class', 'alert-success');
            Session::flash('flash_message', 'Examination answer key event file deleted!');
            //ExamAnswerKeyEvent::destroy($answerKeyId);
            return Redirect::back();
        }else{
            Session::flash('alert_class', 'alert-danger');
            Session::flash('flash_message', 'Please login & fill this form!'); 
            return Redirect::back();
        }
    }
}
