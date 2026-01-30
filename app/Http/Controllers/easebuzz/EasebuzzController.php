<?php

namespace App\Http\Controllers\easebuzz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use Session;
use Redirect;
use App\Models\Transaction;
use App\Models\Application;
use App\Http\Controllers\Helper\FetchDataServiceController;
use Config;

class EasebuzzController extends Controller
{
    private $merchantKey;
    private $salt;
    private $env;
    private $baseUrl;
    protected $fetchDataServiceController;

    public function __construct()
    {
        $this->merchantKey = env('EASEBUZZ_MERCHANT_KEY');
        $this->salt = env('EASEBUZZ_SALT');
        $this->env = env('EASEBUZZ_ENV', 'prod');
        $this->baseUrl = env('EASEBUZZ_BASE_URL', 'https://pay.easebuzz.in/');
        $this->fetchDataServiceController = new FetchDataServiceController();
    }

    public function generateHash($params)
    {
        $hashString = $this->merchantKey . '|' . 
                     $params['txnid'] . '|' . 
                     $params['amount'] . '|' . 
                     $params['productinfo'] . '|' . 
                     $params['firstname'] . '|' . 
                     $params['email'] . '|' . 
                     '||||||||||' . 
                     $this->salt;
        
        return hash('sha512', $hashString);
    }

    public function verifyHash($params)
    {
        $hashString = $this->salt . '|' . 
                     $params['status'] . '|' . 
                     '||||||||||' . 
                     $params['email'] . '|' . 
                     $params['firstname'] . '|' . 
                     $params['productinfo'] . '|' . 
                     $params['amount'] . '|' . 
                     $params['txnid'] . '|' . 
                     $this->merchantKey;
        
        $calculatedHash = hash('sha512', $hashString);
        return $calculatedHash === $params['hash'];
    }

    public function getPaymentUrl()
    {
        return $this->baseUrl . 'payment/initiateLink';
    }

    public function initiatePayment($params)
    {
        $hash = $this->generateHash($params);
        $params['hash'] = $hash;
        $params['key'] = $this->merchantKey;
        
        // For test environment, you can redirect directly
        // For production, use cURL to initiate payment
        if ($this->env === 'test') {
            return [
                'status' => 'success',
                'payment_url' => $this->getPaymentUrl(),
                'params' => $params
            ];
        }
        
        // Production payment initiation via API
        return $this->callPaymentAPI($params);
    }

    private function callPaymentAPI($params)
    {
        try {
            $client = new Client();
            $response = $client->post($this->getPaymentUrl(), [
                'form_params' => $params,
                'timeout' => 30
            ]);
            
            return [
                'status' => 'success',
                'response' => $response->getBody()->getContents()
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function handleResponse(Request $request)
    {
        $responseData = $request->all();
        
        // Log the response for debugging
        \Log::info('Easebuzz Response: ', $responseData);
        
        // Find transaction by txnid
        $transaction = DB::table('transaction')
            ->where('name', $responseData['txnid'])
            ->first();
            
        if (!$transaction) {
            \Log::error('Transaction not found for txnid: ' . $responseData['txnid']);
            Session::flash('paymentFailureMessage', 'Transaction not found!');
            return redirect('/failure-payment-details');
        }
        
        if ($this->verifyHash($responseData)) {
            if ($responseData['status'] === 'success') {
                // Update transaction status to success
                DB::table('transaction')
                    ->where('id', $transaction->id)
                    ->update([
                        'paymentstatus_id' => 1, // Success
                        'updated_at' => now()
                    ]);
                    
                // Update application status to success
                DB::table('application')
                    ->where('id', $transaction->application_id)
                    ->update([
                        'paymentstatus_id' => 1, // Success
                        'lastPaymentAttemptDate' => now(),
                        'updated_at' => now()
                    ]);
                
                // Process success actions (send emails, SMS, etc.)
                $this->processSuccessActions($transaction->application_id);
                
                Session::flash('paymentSuccessMessage', 'Your payment has been processed successfully!');
                return redirect('/success-payment-details');
            } else {
                // Update transaction status to failed
                DB::table('transaction')
                    ->where('id', $transaction->id)
                    ->update([
                        'paymentstatus_id' => 2, // Failed
                        'updated_at' => now()
                    ]);
                    
                // Update application payment attempt date
                DB::table('application')
                    ->where('id', $transaction->application_id)
                    ->update([
                        'lastPaymentAttemptDate' => now(),
                        'updated_at' => now()
                    ]);
                
                Session::flash('paymentFailureMessage', 'Payment failed: ' . ($responseData['error_Message'] ?? 'Unknown error'));
                return redirect('/failure-payment-details');
            }
        } else {
            \Log::error('Hash verification failed for txnid: ' . $responseData['txnid']);
            Session::flash('paymentFailureMessage', 'Payment verification failed!');
            return redirect('/failure-payment-details');
        }
    }
    
    private function processSuccessActions($applicationId)
    {
        // Get application details for email/SMS processing
        $getApplicationTableData = DB::table('application')
            ->leftJoin('applicationstatus', 'application.applicationstatus_id','=', 'applicationstatus.id')
            ->leftJoin('users as studentUser', 'application.users_id','=', 'studentUser.id')
            ->leftJoin('collegeprofile', 'application.collegeprofile_id','=', 'collegeprofile.id')
            ->leftJoin('users as collegeUser', 'collegeprofile.users_id', '=', 'collegeUser.id')
            ->leftJoin('collegemaster', 'application.collegemaster_id','=', 'collegemaster.id')
            ->leftJoin('educationlevel', 'collegemaster.educationlevel_id','=', 'educationlevel.id')
            ->leftJoin('functionalarea', 'collegemaster.functionalarea_id','=', 'functionalarea.id')
            ->leftJoin('degree', 'collegemaster.degree_id','=', 'degree.id')
            ->leftJoin('coursetype', 'collegemaster.coursetype_id','=', 'coursetype.id')
            ->leftJoin('course', 'collegemaster.course_id','=', 'course.id')
            ->leftJoin('transaction', 'application.id', '=', 'transaction.application_id')
            ->leftJoin('paymentstatus', 'transaction.paymentstatus_id', '=', 'paymentstatus.id')
            ->leftJoin('cardtype', 'transaction.cardtype_id', '=', 'cardtype.id') 
            ->where('application.id', '=', $applicationId)
            ->where('studentUser.userstatus_id', '!=', '5')
            ->where('collegeUser.userstatus_id', '!=', '5')
            ->select('application.id as applicationId', 'application.name as applicationName','applicationstatus.name as applicationstatusName','applicationstatus.id as applicationstatusId', 'studentUser.id as studentUserID', 'studentUser.firstname as studentUserFirstName', 'studentUser.middlename as studentUserMiddleName','studentUser.lastName as studentUserLastName', 'collegeprofile.id as collegeprofileID', 'collegeprofile.description as collegeprofileDescription', 'collegeUser.firstname as collegeUserFirstName','application.firstname as applicationFirstName', 'application.middlename as applicationMiddleName', 'application.lastname as applicationLastname', 'application.dob','application.byafees','application.email', 'application.phone','studentUser.email as studentUserEmail','collegeUser.email as collegeUserEmail','collegemaster.id as collegemasterId','educationlevel.name as educationlevelName','functionalarea.name as functionalareaName','degree.name as degreeName','coursetype.name as coursetypeName','course.name as courseName','transaction.id as transactionId','studentUser.phone as studentUserPhone','collegeUser.phone as collegeUserPhone','paymentstatus.id as paymentstatusID','application.applicationID')
            ->first();

        if($getApplicationTableData){
            $applicationId = $getApplicationTableData->applicationID;
            $collegeEmailAddress = $getApplicationTableData->collegeUserEmail;
            $collegeName = $getApplicationTableData->collegeUserFirstName;
            $functionalareaName = $getApplicationTableData->functionalareaName;
            $degreeName = $getApplicationTableData->degreeName;
            $courseName = $getApplicationTableData->courseName;
            $studentName = $getApplicationTableData->studentUserFirstName.' '.$getApplicationTableData->studentUserMiddleName.' '.$getApplicationTableData->studentUserLastName;
            $studentEmailAddress = $getApplicationTableData->studentUserEmail;
            $applicationFees = $getApplicationTableData->byafees;
            $transactionId = $getApplicationTableData->transactionId;
            $studentMobileNo = $getApplicationTableData->studentUserPhone;
            $collegeMobileNo = $getApplicationTableData->collegeUserPhone;
            
            // Send emails and SMS (same logic as in the original controller)
            $this->sendSuccessEmails($collegeEmailAddress, $collegeName, $courseName, $applicationId, $functionalareaName, $degreeName, $applicationFees, $studentName, $studentEmailAddress, $transactionId);
            $this->sendSuccessSMS($collegeMobileNo, $collegeName, $applicationId, $studentMobileNo, $studentName);
        }
    }
    
    private function sendSuccessEmails($collegeEmailAddress, $collegeName, $courseName, $applicationId, $functionalareaName, $degreeName, $applicationFees, $studentName, $studentEmailAddress, $transactionId)
    {
        // Send email to college
        try {
            if(!empty($collegeEmailAddress) && ($this->fetchDataServiceController->isValidEmail($collegeEmailAddress) == 1))
            {
                \Mail::send('emailtemplate/course-application.email-to-college', array('email' => $collegeEmailAddress, 'collegeName' => $collegeName, 'courseName' => $courseName, 'applicationId' => $applicationId, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName,'amount' => $applicationFees, 'studentName' => $studentName,  ), function($message) use ($collegeEmailAddress)
                {
                    $message->to($collegeEmailAddress, 'AdmissionX')->subject('College get new application for a course - College');
                }); 
            }
        } catch ( \Swift_TransportException $e) {                
        }

        // Send email to student
        try {
            if(!empty($studentEmailAddress) && ($this->fetchDataServiceController->isValidEmail($studentEmailAddress) == 1))
            {
                \Mail::send('emailtemplate/course-application.email-to-student', array('email' => $studentEmailAddress, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'amount' => $applicationFees ,'courseName' => $courseName, 'functionalareaName' => $functionalareaName, 'degreeName' => $degreeName ), function($message) use ($studentEmailAddress)
                {
                    $message->to($studentEmailAddress, 'AdmissionX')->subject('You have applied for new admission - AdmissionX');
                }); 
            }
        } catch ( \Swift_TransportException $e) {                
        }

        // Send email to admin
        $getTheAdminEmail = DB::table('users')
            ->where('userrole_id', '=', '1')
            ->where('userstatus_id', '=', '1')
            ->select('email')
            ->get();
            
        foreach ($getTheAdminEmail as $admin) {
            try {
                if(!empty($admin->email) && ($this->fetchDataServiceController->isValidEmail($admin->email) == 1))
                {
                    \Mail::send('emailtemplate/course-application.email-to-admin', array('email' => $admin->email, 'studentName' => $studentName, 'collegeName' => $collegeName, 'applicationId' => $applicationId, 'amount' => $applicationFees , 'courseName' => $courseName, 'transactionId' => $transactionId), function($message) use ($admin)
                    {
                        $message->to($admin->email, 'AdmissionX')->subject('College get new application for a course - Admin');
                    });       
                }
            }catch ( \Swift_TransportException $e) {                
            }
        }
    }
    
    private function sendSuccessSMS($collegeMobileNo, $collegeName, $applicationId, $studentMobileNo, $studentName)
    {
        // Send SMS to college
        try {
            if(!empty($collegeMobileNo))
            {   
                $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($collegeName)); 
                $smsMessageData = 'Dear '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', Application ID: '.$applicationId.' has been forwarded. Kindly approve earliest by maximum 72 hours. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_1');
                $this->fetchDataServiceController->sendTextSmsOnMobile($collegeMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_FORWARDED_TO_COLLEGE'));
            } 
        }catch (\Exception $e) {
            \Log::error('SMS sending failed: ' . $e->getMessage());
        }
        
        // Send SMS to student
        try {
            if(!empty($studentMobileNo))
            {
                $collegeNameStr = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u',' ', strip_tags($collegeName)); 
                $smsMessageData = 'Dear '.$studentName.', Your Application No.'.$applicationId.' has been forwarded to '.(str_limit($collegeNameStr, $limit = 30, $end = '')).', will take 7 working days for the processing. For assistance call our Helpline '.Config::get('systemsetting.SMS_PHONE_NUMBER').' '.Config::get('systemsetting.SMS_GROUP_NAME_2');
                $this->fetchDataServiceController->sendTextSmsOnMobile($studentMobileNo, $smsMessageData, Config::get('systemsetting.TEMPLATE_APPLICATION_FORWARDED_TO_STUDENT'));
            } 
        }catch (\Exception $e) {
            \Log::error('SMS sending failed: ' . $e->getMessage());
        }
    }
}