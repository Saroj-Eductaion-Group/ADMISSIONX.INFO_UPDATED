<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
use App\User as User;
use App\Models\UserRole as UserRole;
use App\Models\UserStatus as UserStatus;
use App\Models\University as University;
use App\Models\CollegeType as CollegeType;
use App\Models\AddressType as AddressType;
use App\Models\City as City;
use App\Models\State as State;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\EducationLevel as EducationLevel;
use App\Models\Degree as Degree;
use App\Models\CourseType as CourseType;
use App\Models\Course as Course;
use App\Models\ApplicationStatus as ApplicationStatus;

class ExportToExcelReportController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{  
    	
        $universityObj = DB::table('university')
                ->orderBy('university.name', 'ASC')
                ->get()
                ;
            /*    print_r($universityObj);die;*/
        $collegeProfileObj = DB::table('collegeprofile')
                            ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                            ->where('users.userrole_id', '=', '2')
                            ->where('users.userstatus_id','!=','5')
                            ->select('collegeprofile.id as collegeprofileID', 'users.id as userID','users.firstname')
                            ->orderBy('users.firstname', 'ASC')
                            ->get()
                            ;
        $functionalAreaObj = DB::table('functionalarea')
                ->orderBy('functionalarea.name', 'ASC')
                ->get()
                ;

        $educationLevelObj = DB::table('educationlevel')
                ->orderBy('educationlevel.name', 'ASC')
                ->get()
                ;

        $degreeObj = DB::table('degree')
                ->orderBy('degree.name', 'ASC')
                ->get()
                ;       

        $courseTypeObj = DB::table('coursetype')
                ->orderBy('coursetype.name', 'ASC')
                ->get()
                ;   
        
        $courseObj = DB::table('course')
                ->orderBy('course.name', 'ASC')
                ->get()
                ; 

        $applicationStatusObj = DB::table('applicationstatus')
                ->orderBy('applicationstatus.name', 'ASC')
                ->get()
                ;          
 
       /* $functionalAreaObj = FunctionalArea::all();
        $educationLevelObj = EducationLevel::all();
        $degreeObj = Degree::all();
        $courseTypeObj = CourseType::all();
        $courseObj = Course::all();
        $applicationStatusObj = ApplicationStatus::all();*/

		return view('administrator/exportreporttoexcel.index')
                    ->with('universityObj', $universityObj)
                    ->with('collegeProfileObj',$collegeProfileObj)
                    ->with('functionalAreaObj',$functionalAreaObj)
                    ->with('educationLevelObj',$educationLevelObj)
                    ->with('degreeObj',$degreeObj)
                    ->with('courseTypeObj',$courseTypeObj)
                    ->with('courseObj',$courseObj)
                    ->with('applicationStatusObj',$applicationStatusObj)
                    ;
    }

    public function exportSearchResult(Request $request)
    {
        ini_set('max_execution_time', 0);
        if (Auth::check())
        {
            $userId = Auth::id();
            $roleGrant = User::where('id', '=', $userId)->first();

        	if( $roleGrant->userrole_id == '1' && $roleGrant->userstatus_id == '1' ||  $roleGrant->userrole_id == '4' && $roleGrant->userstatus_id == '1')
        	{
		        $searchCollegeName = $request->collegeName;
				$universityId = $request->university_id;
				$applicationStatus = $request->applicationStatus;
				$functionalArea = $request->functionalarea_id;
				$degreeName = $request->degree_id;
				$courseName = $request->course_id;

                $createdDateFrom = $request->createdDateStart;
                $createdDateTo = $request->createdDateEnd;
               
                if( $createdDateFrom != '' && $createdDateTo == '' ){

		        	$createdDateStartArray = explode('/', $createdDateFrom);
			        $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

		        	$applicationDate = "AND application.created_at >= '".$createdDateStart1."'";
		        }elseif( $createdDateFrom == '' && $createdDateTo != '' ){

		        	$createdDateEndArray = explode('/', $createdDateTo);
			        $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
		        	$applicationDate = "AND application.created_at <= '".$createdDateEnd1."'";
		        }elseif($createdDateFrom != '' && $createdDateTo != '' ){

		        	$createdDateStartArray = explode('/', $createdDateFrom);
			        $createdDateStart1 = $createdDateStartArray[2].'-'.$createdDateStartArray[0].'-'.$createdDateStartArray[1];

			        $createdDateEndArray = explode('/', $createdDateTo);
			        $createdDateEnd1 = $createdDateEndArray[2].'-'.$createdDateEndArray[0].'-'.$createdDateEndArray[1];
		        	$applicationDate = "AND application.created_at BETWEEN '".$createdDateStart1."' AND '".$createdDateEnd1."'";
		        }else{
		        	$applicationDate = '';
		        }
            	
            	$search0 = 'collegeprofile.id';
/*print_r($search0);die;*/
                if( $searchCollegeName != null ){
		            $collegeName = "AND users.firstname LIKE  '%".$searchCollegeName."%'";
		        }else{
		            $collegeName =  '';
		        }

				if( $universityId != '' ){
		            $universityName = "AND collegeprofile.university_id =  '".$universityId."'";
		        }else{
		            $universityName =  '';
		        }

		        if( $applicationStatus != '' ){
		            $applicationName = "AND applicationstatus.id =  '".$applicationStatus."'";
		        }else{
		            $applicationName =  '';
		        }

		        if( $functionalArea != '' ){
		            $functionalAreaName = "AND `collegemaster`.`functionalarea_id` =  '".$functionalArea."'";
		        }else{
		            $functionalAreaName =  '';
		        }

		        if( $degreeName != '' ){
		            $degreeNameData = "AND `collegemaster`.`degree_id` =  '".$degreeName."'";
		        }else{
		            $degreeNameData =  '';
		        }

		        if( $courseName != '' ){
		            $courseNameData = "AND `collegemaster`.`course_id` =  '".$courseName."'";
		        }else{
		            $courseNameData =  '';
		        }
                           
                
                $collegeProfileDataObj =  DB::select( DB::raw("SELECT collegeprofile.id as collegeprofileID, COUNT(application.id) as totalCount, collegeprofile.description as clgDescription, estyear, website, collegecode,  contactpersonname, contactpersonemail, contactpersonnumber,review, agreement, verified, calenderinfo,collegetype.name as collegetypeName, users.id as userID,users.firstname, users.lastname, users.email as registerEmail,users.phone as registerPhone, userrole.name as userRoleName,university.name as universityName,address.id as addressId, addresstype.id as addresstypeID, addresstype.name as addresstypeName,city.id as cityId, city.name as cityName,state.id as stateId, state.name as stateName, country.id as countryId,country.name as countryName,address.name as addressName, address.address1, address.address2, address.postalcode,application.id as applicationId, applicationstatus.id as applicationstatusId, applicationstatus.name as applicationstatusName, collegemaster.id as collegemasterId, educationlevel.name as educationlevelName,functionalarea.name as functionalareaName, degree.name as degreeName, coursetype.name as coursetypeName,course.name as courseName FROM  collegeprofile 
                	left join users ON collegeprofile.users_id = users.id
	                left join userrole ON  users.userrole_id =  userrole.id
	                left join university ON  collegeprofile.university_id =  university.id
	                left join collegetype ON collegeprofile.collegetype_id = collegetype.id
	                left join address ON collegeprofile.id = address.collegeprofile_id
	                left join addresstype ON address.addresstype_id = addresstype.id  
	                left join city ON address.city_id = city.id
	                left join state ON city.state_id = state.id
	                left join country ON state.country_id = country.id
	                left join application ON  collegeprofile.id = application.collegeprofile_id
	                left join applicationstatus ON application.applicationstatus_id = applicationstatus.id
	                left join collegemaster ON application.collegemaster_id = collegemaster.id
	                left join educationlevel ON collegemaster.educationlevel_id = educationlevel.id
	                left join functionalarea ON collegemaster.functionalarea_id = functionalarea.id
	                left join degree ON collegemaster.degree_id = degree.id
	                left join coursetype ON collegemaster.coursetype_id = coursetype.id
	                left join course ON collegemaster.course_id = course.id 
	                where $search0 $collegeName $applicationDate $universityName $applicationName $functionalAreaName $degreeNameData $courseNameData and address.addresstype_id = '1' and users.userstatus_id != '5' and application.applicationstatus_id != '4' group by applicationstatus.id, collegeprofile.id ORDER BY collegeprofile.id ASC"));
               /*echo "<pre>";
                print_r($collegeProfileDataObj);die;*/
                if( !empty($collegeProfileDataObj) ){
                        Excel::create('collegeprofilesearch', function($excel) use($searchCollegeName, $universityId, $applicationStatus, $functionalArea, $degreeName, $courseName,  $createdDateFrom, $createdDateTo, $collegeProfileDataObj){          
                        $excel->sheet('collegeprofilesearch', function($sheet) use($searchCollegeName, $universityId, $applicationStatus, $functionalArea, $degreeName, $courseName, $createdDateFrom, $createdDateTo, $collegeProfileDataObj) {
                       
                       //echo json_encode($collegeProfileDataObj);die;
                        foreach ($collegeProfileDataObj as $exportCollegeProfileExcelData) {
		                    $arrayData[] = json_decode(json_encode($exportCollegeProfileExcelData),TRUE);         
		                    }
		                   
		                    if(!empty($arrayData)){
		                        foreach ($arrayData as $arr) {
		                            $report[$arr['collegeprofileID']][$arr['firstname']][$arr['registerEmail']][$arr['registerPhone']][$arr['countryName']][$arr['stateName']][$arr['cityName']][$arr['addressName']][$arr['address1']][$arr['address2']][$arr['postalcode']][$arr['contactpersonname']][$arr['contactpersonemail']][$arr['contactpersonnumber']][$arr['universityName']][$arr['applicationstatusId']] = $arr['totalCount'];
		                        }
		                        $sheet->loadView('administrator/exportreporttoexcel.exportCollegeReport', ['collegeProfileDataObj' => $report, 'searchCollegeName' =>$searchCollegeName, 'universityId' => $universityId, 'applicationStatus' => $applicationStatus, 'functionalArea' => $functionalArea,'degreeName' => $degreeName, 'courseName' => $courseName, 'createdDateFrom' => $createdDateFrom, 'createdDateTo' => $createdDateTo]);
		                    }
                        });
                    })->download('xls');
                }else{
                    Session::flash('warning', 'No Data Found'); 
                    return redirect()->action('administrator\ExportToExcelReportController@index');   
                }                
            }
            else
            {
                Auth::logout();
                return view('user.login');
            }
            
        }
        else
        {
            Auth::logout();
            return view('user.login');
        }
    }

    /*public function exportSearchResult(Request $request)
    {
        
        $searchCollegeName = $request->collegeName;
        $searchEmailAddress = $request->userEmailAddress;
        $searchReview = $request->review;
        $searchVerified = $request->verified;
        $searchAgreement = $request->agreement;
        $collegeTypeId = $request->collegetype_id;
        $universityId = $request->university_id;
        $addressTypeID = $request->addresstype_id;
        $cityName = $request->cityName;
        $stateName = $request->stateName;

                      
        $search0 = 'collegeprofile.id';

        if( $searchCollegeName != null ){
            $search1 = "AND users.firstname LIKE  '%".$searchCollegeName."%'";
        }else{
            $search1 =  '';
        }

        if( $searchEmailAddress != '' ){
            $search2 = "AND users.email LIKE  '%".$searchEmailAddress."%'";
        }else{
            $search2 =  '';
        }

        if( $searchReview != '' ){
            $search3 = "AND collegeprofile.review LIKE  '%".$searchReview."%'";
        }else{
            $search3 =  '';
        }

        if( $searchVerified != '' ){
            $search4 = "AND collegeprofile.verified LIKE  '%".$searchVerified."%'";
        }else{
            $search4 =  '';
        }

        if( $searchAgreement != '' ){
            $search5 = "AND collegeprofile.agreement LIKE  '%".$searchAgreement."%'";
        }else{
            $search5 =  '';
        }

        if( $collegeTypeId != '' ){
            $search6 = "AND collegeprofile.collegetype_id =  '".$collegeTypeId."'";
        }else{
            $search6 =  '';
        }

        if( $universityId != '' ){
            $search7 = "AND collegeprofile.university_id =  '".$universityId."'";
        }else{
            $search7 =  '';
        }

        if( $addressTypeID != null ){
            $search8 = "AND addresstype.id =  '".$addressTypeID."'";
        }else{
            $search8 =  '';
        }

        if( $cityName != '' ){
            $search9 = "AND city.id =  '".$cityName."'";
            $cityID = $cityName;
        }else{
            $search9 =  '';
            $cityID= '';
        }
       
        if( $stateName != '' ){
            $search10 = " AND state.id =  '".$stateName."'"; 
            $stateID = $stateName;          
        }else{
            $search10 = '';
            $stateID = '';
        }
                
        $collegeProfileDataObj = DB::select( DB::raw("SELECT  collegeprofile.id as collegeprofileID, COUNT(application.id) as totalCount, collegeprofile.description as clgDescription, estyear, website, collegecode,  contactpersonname, contactpersonemail, contactpersonnumber,review, agreement, verified, calenderinfo,collegetype.name as collegetypeName, users.id as userID,users.firstname, users.lastname, users.email as registerEmail,users.phone as registerPhone, userrole.name as userRoleName,university.name as universityName,address.id as addressId, addresstype.id as addresstypeID, addresstype.name as addresstypeName,city.id as cityId, city.name as cityName,state.id as stateId, state.name as stateName, country.id as countryId,country.name as countryName,address.name as addressName, address.address1, address.address2, address.postalcode,application.id as applicationId, applicationstatus.id as applicationstatusId, applicationstatus.name as applicationstatusName FROM  `collegeprofile`      
                LEFT JOIN `users` ON `collegeprofile`.`users_id` = `users`.`id`
                LEFT JOIN  `userrole` ON  `users`.`userrole_id` =  `userrole`.`id`
                LEFT JOIN  `university` ON  `collegeprofile`.`university_id` =  `university`.`id`
                LEFT JOIN `collegetype` ON `collegeprofile`.`collegetype_id` = `collegetype`.`id`
                LEFT JOIN `address` ON `collegeprofile`.`id` = `address`.`collegeprofile_id`
                LEFT JOIN `addresstype` ON `address`.`addresstype_id` = `addresstype`.`id`  
                LEFT JOIN `city` ON `address`.`city_id` = `city`.`id`
                LEFT JOIN `state` ON `city`.`state_id` = `state`.`id`
                LEFT JOIN `country` ON `state`.`country_id` = `country`.`id`
                LEFT JOIN `application` ON  `collegeprofile`.`id` = `application`.`collegeprofile_id`
                LEFT JOIN `applicationstatus` ON `application`.`applicationstatus_id` = `applicationstatus`.`id`
                WHERE $search0
                $search1 
                $search2
                $search3
                $search4
                $search5
                $search6
                $search7
                $search8
                $search9
                $search10
                AND users.userstatus_id != '5'
                group by users.id
                ORDER BY collegeprofile.id ASC"
            ));
        

            if(!empty($collegeProfileDataObj)){

                Excel::create('collegeprofilesearch', function($excel) use($cityName, $stateName,  $addressTypeID, $universityId, $collegeTypeId, $searchAgreement, $searchCollegeName, $searchEmailAddress, $searchReview, $searchVerified,$collegeProfileDataObj) {           
                $excel->sheet('exportCollegeReport', function($sheet) use($cityName, $stateName,  $addressTypeID, $universityId, $collegeTypeId, $searchAgreement, $searchCollegeName, $searchEmailAddress, $searchReview, $searchVerified, $collegeProfileDataObj) {

                  //echo json_encode($collegeProfileDataObj);die;
                foreach ($collegeProfileDataObj as $exportCollegeProfileExcelData) {
                    $arrayData[] = json_decode(json_encode($exportCollegeProfileExcelData),TRUE);         
                    }
                   
                    if(!empty($arrayData)){
                        foreach ($arrayData as $arr) {
                            $report[$arr['collegeprofileID']][$arr['firstname']][$arr['registerEmail']][$arr['registerPhone']][$arr['countryName']][$arr['stateName']][$arr['cityName']][$arr['addressName']][$arr['address1']][$arr['address2']][$arr['postalcode']][$arr['contactpersonname']][$arr['contactpersonemail']][$arr['contactpersonnumber']][$arr['universityName']][$arr['applicationstatusId']] = $arr['totalCount'];
                        }
                        $sheet->loadView('administrator/collegeprofile.exportCollegeReport', ['collegeProfileDataObj' => $report, 'cityName' =>$cityName, 'stateName' => $stateName, 'addressTypeID' => $addressTypeID, 'universityId' => $universityId,'collegeTypeId' => $collegeTypeId, 'searchAgreement' => $searchAgreement, 'searchCollegeName' => $searchCollegeName, 'searchEmailAddress' => $searchEmailAddress, 'searchReview' => $searchReview, 'searchVerified' => $searchVerified]);
                    }

                    });
                })->download('xls');
            }else{
                Session::flash('warning', 'No Data Found'); 
                return redirect()->action('administrator\ExportToExcelReportController@index');   
        }         
            //$sheet->loadView('administrator/collegeprofile.exportResult', ['collegeProfileDataObj' => $collegeProfileDataObj]); 
    }*/
}