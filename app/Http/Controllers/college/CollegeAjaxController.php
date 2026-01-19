<?php

namespace App\Http\Controllers\college;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Cache;
use Config;
use Session;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\CollegeType as CollegeType;
use App\Models\City as City;
use App\Models\Address as Address;
use App\Models\Gallery as Gallery;
use App\Models\Document as Document;
use App\Models\AddressType as AddressType;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\Degree as Degree;
use App\Models\Course as Course;
use App\Models\CourseType as CourseType;
use App\Models\EducationLevel as EducationLevel;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\CollegeMaster as CollegeMaster;
use App\Models\Placement as Placement;
use App\Models\Event as Event;
use App\Models\Facility as Facility;
use App\Models\CollegeFacility as CollegeFacility;


class CollegeAjaxController extends Controller
{
	public function getAllDegreeName(Request $request)
    {
        $functionalareaIdValue = $request->currentID;
        $degreeObj = DB::table('functionalarea')
                    ->join('degree', function ($join) use ($functionalareaIdValue) {
                        $join->on('functionalarea.id', '=','degree.functionalarea_id')
                            ->where('functionalarea.id', '=', DB::raw($functionalareaIdValue)
                            );
                        })
                    ->select('degree.id as degreeId', 'degree.name')
                    ->orderBy('degree.name','ASC')
                    ->get()
                    ;
        if( !empty($degreeObj) ){
            $dataArray = array(
                        'code' => '200',
                        'degreeObj' => $degreeObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'degreeObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    public function getAllCourseName(Request $request)
    {
        $degreeIdValue = $request->currentID;
        $courseObj = DB::table('degree')
                    ->join('course', function ($join) use ($degreeIdValue) {
                        $join->on('degree.id', '=','course.degree_id')
                            ->where('degree.id', '=', DB::raw($degreeIdValue)
                            );
                        })
                    ->select('course.id as courseId', 'course.name')
                    ->orderBy('course.name','ASC')
                    ->get()
                    ;
        if( !empty($courseObj) ){
            $dataArray = array(
                        'code' => '200',
                        'courseObj' => $courseObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'courseObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    public function getAllStateName(Request $request)
    {
        $stateIdValue = $request->countryID;
        $stateObj = DB::table('country')
                    ->join('state', function ($join) use ($stateIdValue) {
                        $join->on('country.id', '=','state.country_id')
                            ->where('country.id', '=', DB::raw($stateIdValue)
                            );
                        })
                    ->select('state.id as stateId', 'state.name')
                    ->orderBy('state.name', 'ASC')
                    ->get()
                    ;

            if(sizeof($stateObj) == 0){
                $country = Country::orderBy('id', 'DESC')
                                ->select('country.id', 'country.name')
                                ->findOrFail($stateIdValue);

                $newStateObj = new State;
                $newStateObj->name = $country->name;
                $newStateObj->country_id = $country->id;
                $newStateObj->isShowOnTop = '1';
                $newStateObj->isShowOnHome = '1';        
                $newStateObj->save();

                $stateObj = DB::table('state')
                    ->where('country_id', '=', $stateIdValue) 
                    ->select('state.id', 'state.name')
                    ->orderBy('state.name', 'ASC')
                    ->get()
                    ;
            }
        if( !empty($stateObj) ){
            $dataArray = array(
                        'code' => '200',
                        'stateObj' => $stateObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'stateObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    public function getAllCityName(Request $request)
    {
        $stateIdValue = $request->currentID;
        $cityObj = DB::table('state')
                    ->join('city', function ($join) use ($stateIdValue) {
                        $join->on('state.id', '=','city.state_id')
                            ->where('state.id', '=', DB::raw($stateIdValue)
                            );
                        })
                    ->where('city.cityStatus','=','1')
                    ->select('city.id as cityId', 'city.name')
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;

            if(sizeof($cityObj) == 0){
                $state = State::orderBy('id', 'DESC')
                            ->select('state.id', 'state.name')
                            ->findOrFail($stateIdValue);

                $newCityObj = new City;
                $newCityObj->name = $state->name;
                $newCityObj->state_id = $state->id;
                $newCityObj->cityStatus = '1';
                $newCityObj->isShowOnTop = '1';
                $newCityObj->isShowOnHome = '1';        
                $newCityObj->save();

                $cityObj = DB::table('city')
                    ->where('state_id', '=', $stateIdValue) 
                    ->where('city.cityStatus','=','1')
                    ->select('city.id as cityId', 'city.name')
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;
            }

        if( !empty($cityObj) ){
            $dataArray = array(
                        'code' => '200',
                        'cityObj' => $cityObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'cityObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    public function getAllExamCityName(Request $request)
    {
        $stateIdValue = $request->currentID;
        $cityObj = DB::table('state')
                    ->join('city', function ($join) use ($stateIdValue) {
                        $join->on('state.id', '=','city.state_id')
                            ->where('state.name', '=', DB::raw($stateIdValue)
                            );
                        })
                    ->where('city.cityStatus','=','1')
                    ->select('city.id as cityId', 'city.name')
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;

            if(sizeof($cityObj) == 0){
                $state = State::orderBy('id', 'DESC')
                            ->select('state.id', 'state.name')
                            ->findOrFail($stateIdValue);

                $newCityObj = new City;
                $newCityObj->name = $state->name;
                $newCityObj->state_id = $state->id;
                $newCityObj->cityStatus = '1';
                $newCityObj->isShowOnTop = '1';
                $newCityObj->isShowOnHome = '1';        
                $newCityObj->save();

                $cityObj = DB::table('city')
                    ->where('state_id', '=', $stateIdValue) 
                    ->where('city.cityStatus','=','1')
                    ->select('city.id as cityId', 'city.name')
                    ->orderBy('city.name', 'ASC')
                    ->get()
                    ;
            }
        if( !empty($cityObj) ){
            $dataArray = array(
                        'code' => '200',
                        'cityObj' => $cityObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'cityObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }



    public function getCollegeFullName(Request $request)
    {
    	$query = Input::get('term');
        $results = array();

    	$getCollegeNameObj = DB::table('users')
							->leftJoin('collegeprofile','users.id', '=', 'collegeprofile.users_id')
							->where('users.firstname', 'like', '%'.$query.'%')
                            ->where('userrole_id', '=', '2')
                            ->where('userstatus_id', '!=', '5')
							->select('collegeprofile.id','users.firstname as value')
							->get()
							;
		if( empty($getCollegeNameObj) ){
            $getCollegeNameObj = '';
        }

        header('Content-Type: application/json');
        echo json_encode($getCollegeNameObj);
        die;
    }

    public function collegeFilterOnParams(Request $request)
    {
        //GET ALL VALUES
        $getFunctionalAreaObj = FunctionalArea::all();
        $getDegreeObj = Degree::all();
        $getCourseObj = Course::all();
        $getEducationLevelObj = EducationLevel::all();
        $getCountryObj = Country::all();
        $getStateObj = State::all();
        $getCityObj = City::all();

        if( Input::get('functionalarea_id') != '' ){
            $search1 = "AND collegemaster.functionalarea_id = ".Input::get('functionalarea_id')."";
            $functionalareaID = Input::get('functionalarea_id');
        }else{
            $search1 = '';
            $functionalareaID = '';
        }

        if( Input::get('degree_id') != '' ){
            $search2 = "AND collegemaster.degree_id = ".Input::get('degree_id')."";
            $degreeID = Input::get('degree_id');
            $addNewGroupByIfDegreeAvail = ', course.id';
        }else{
            $search2 = '';
            $degreeID = '';
            $addNewGroupByIfDegreeAvail = '';
        }

        if( Input::get('course_id') != '' ){
            $search3 = "AND collegemaster.course_id = ".Input::get('course_id')."";
            $courseID = Input::get('course_id');
        }else{
            $search3 = '';
            $courseID = '';
        }

        if( Input::get('country_id') != '' ){
            $searchCountry4 = "AND country.id = ".Input::get('country_id')."";
            $countryID = Input::get('country_id');
        }else{
            $searchCountry4 = '';
            $countryID = '';
        }

        if( Input::get('state_id') != '' ){
            $search4 = "AND state.id = ".Input::get('state_id')."";
            $stateID = Input::get('state_id');
        }else{
            $search4 = '';
            $stateID = '';
        }

        if( Input::get('city_id') != '' ){
            $search5 = "AND city.id = ".Input::get('city_id')."";
            $cityID = Input::get('city_id');
        }else{
            $search5 = '';
            $cityID = '';
        }

        if( Input::get('field_id') != '' ){
            $search6 = "AND collegeprofile.id = ".Input::get('field_id')."";
        }else{
            $search6 = '';
        }

        $currentNode = $request->currentNode;
        if(!empty($currentNode)){
            $getValue = ($currentNode - 1)*50;
        }else{
            $getValue = 0;
        }

        //Case of GROUP BY
        if( empty($functionalareaID) ){
            $orderByFunctionalArea = 'collegeprofile.id, functionalarea.id';
        }else{
            $orderByFunctionalArea = 'collegemaster.id';
        }

        $getFilterOutDataObj = DB::select( DB::raw("SELECT
                        users.id as usersId, users.firstname,
                        collegeprofile.id as collegeprofileID, collegeprofile.slug, collegeprofile.agreement,
                        city.name as cityName, state.name as stateName,
                        functionalarea.id as functionalareaID, functionalarea.name as functionalareaName,
                        degree.id as degreeID, degree.name as degreeName,
                        course.id as courseID, course.name as courseName,
                        collegemaster.id as collegemasterID,collegemaster.fees,collegemaster.seats,
                        gallery.name as galleryName, gallery.caption, gallery.width, gallery.height,
                        collegefacilities.id as collegefacilitiesID
                        FROM  users
                        INNER JOIN collegeprofile ON users.id = collegeprofile.users_id
                        INNER JOIN collegemaster ON collegeprofile.id = collegemaster.collegeprofile_id
                        LEFT JOIN functionalarea ON collegemaster.functionalarea_id = functionalarea.id
                        LEFT JOIN degree ON collegemaster.degree_id = degree.id
                        LEFT JOIN course ON collegemaster.course_id = course.id
                        LEFT JOIN educationlevel ON collegemaster.educationlevel_id = educationlevel.id
                        INNER JOIN address ON collegeprofile.id = address.collegeprofile_id
                        INNER JOIN city ON address.city_id = city.id
                        INNER JOIN state ON city.state_id = state.id
                        INNER JOIN country ON state.country_id = country.id
                        LEFT JOIN gallery ON gallery.users_id = users.id
                        LEFT JOIN collegefacilities ON collegemaster.collegeprofile_id  = collegefacilities.collegeprofile_id
                        WHERE users.id
                        $search1
                        $search2
                        $search3
                        $searchCountry4
                        $search4
                        $search5
                        $search6
                        AND address.addresstype_id = '1'
                        AND collegeprofile.review = '1'
                        AND collegeprofile.verified = '1'
                        And users.userstatus_id != '5'
                        GROUP BY $orderByFunctionalArea
                        ORDER BY collegeprofile.id DESC
                        LIMIT 50 OFFSET $getValue"
                    ));//GROUP BY users.id + degree.id $addNewGroupByIfDegreeAvail
                    // AND gallery.misc = 'college-logo-img'

        $noMatchFound = '0';
        if( empty($getFilterOutDataObj) ){
            // $getFilterOutDataObj = DB::select( DB::raw("SELECT
            //             users.id as usersId, users.firstname,
            //             collegeprofile.id as collegeprofileID, collegeprofile.slug, collegeprofile.agreement,
            //             city.name as cityName, state.name as stateName,
            //             functionalarea.id as functionalareaID, functionalarea.name as functionalareaName,
            //             degree.id as degreeID, degree.name as degreeName,
            //             course.id as courseID, course.name as courseName,
            //             collegemaster.id as collegemasterID,collegemaster.fees,collegemaster.seats,
            //             gallery.name as galleryName, gallery.caption, gallery.width, gallery.height,
            //             collegefacilities.id as collegefacilitiesID
            //             FROM  users
            //             INNER JOIN collegeprofile ON users.id = collegeprofile.users_id
            //             INNER JOIN collegemaster ON collegeprofile.id = collegemaster.collegeprofile_id
            //             LEFT JOIN functionalarea ON collegemaster.functionalarea_id = functionalarea.id
            //             LEFT JOIN degree ON collegemaster.degree_id = degree.id
            //             LEFT JOIN course ON collegemaster.course_id = course.id
            //             LEFT JOIN educationlevel ON collegemaster.educationlevel_id = educationlevel.id
            //             INNER JOIN address ON collegeprofile.id = address.collegeprofile_id
            //             INNER JOIN city ON address.city_id = city.id
            //             INNER JOIN state ON city.state_id = state.id
            //             INNER JOIN country ON state.country_id = country.id
            //             LEFT JOIN gallery ON gallery.users_id = users.id
            //             LEFT JOIN collegefacilities ON collegemaster.collegeprofile_id  = collegefacilities.collegeprofile_id
            //             WHERE users.id
            //             $search1
            //             $search2
            //             $search3
            //             $search4
            //             $search5
            //             $search6
            //             AND address.addresstype_id = '1'
            //             AND collegeprofile.review = '1'
            //             AND collegeprofile.verified = '1'
            //             GROUP BY $orderByFunctionalArea
            //             ORDER BY collegeprofile.id DESC
            //             LIMIT 50 OFFSET $getValue"
            //         ));//$searchCountry4
            // $noMatchFound = '1';
            $getFilterOutDataObj = array();
            $noMatchFound = '0';
        }

        if( empty($functionalareaID) ){
            foreach ($getFilterOutDataObj as $exportExcelData) {
                        $arrayData12[] = json_decode(json_encode($exportExcelData),TRUE);

                    }
                    $json_str1='[';
                    $not_length = count($getFilterOutDataObj);
                    for ($i=0; $i < $not_length; $i++) {
                        $a=$arrayData12[$i]['collegeprofileID'];
                        $json_str1.='{"collegeprofileID": "'.$a.'",';
                        $json_str1.='"usersId": "'.$arrayData12[$i]['usersId'].'",';
                        $json_str1.='"firstname": "'.$arrayData12[$i]['firstname'].'",';
                        $json_str1.='"slug": "'.$arrayData12[$i]['slug'].'",';
                        $json_str1.='"agreement": "'.$arrayData12[$i]['agreement'].'",';
                        $json_str1.='"cityName": "'.$arrayData12[$i]['cityName'].'",';
                        $json_str1.='"stateName": "'.$arrayData12[$i]['stateName'].'",';
                        $json_str1.='"functionalareaID": "'.$arrayData12[$i]['functionalareaID'].'",';
                        $json_str1.='"degreeID": "'.$arrayData12[$i]['degreeID'].'",';
                        $json_str1.='"courseID": "'.$arrayData12[$i]['courseID'].'",';
                        $json_str1.='"courseName": "'.$arrayData12[$i]['courseName'].'",';
                        $json_str1.='"collegemasterID": "'.$arrayData12[$i]['collegemasterID'].'",';
                        $json_str1.='"fees": "'.$arrayData12[$i]['fees'].'",';
                        $json_str1.='"seats": "'.$arrayData12[$i]['seats'].'",';
                        $json_str1.='"galleryName": "'.$arrayData12[$i]['galleryName'].'",';
                        $json_str1.='"caption": "'.$arrayData12[$i]['caption'].'",';
                        $json_str1.='"width": "'.$arrayData12[$i]['width'].'",';
                        $json_str1.='"height": "'.$arrayData12[$i]['height'].'",';
                        $json_str1.='"collegefacilitiesID": "'.$arrayData12[$i]['collegefacilitiesID'].'",';
                        if(!empty($a)){
                            $b="";
                            $c="";
                            foreach($arrayData12 as $arrayData123)
                            {
                                if($a==$arrayData123["collegeprofileID"])
                                {

                                    $b.=$arrayData123["functionalareaName"]." ,";
                                    $c.=$arrayData123["degreeName"].'|'.$arrayData123["courseName"]." ,";
                                    $i++;
                                }
                            }
                            $i--;
                            $json_str1.='"functionalareaName": "'.trim($b," ,").'","degreeName": "'.trim($c," ,").'"},';
                            // echo '<br>';

                        }else{
                            continue;
                        }
                    }
                    $json_str1=trim($json_str1,",");
                    $json_str1.= "]";
                    //echo $json_str1;die;
                    $encodeJson = json_encode('{"functionalareaName":'.$json_str1.'}');
                    $decodeJson1 = json_decode($json_str1);
                    json_encode($decodeJson1);
        }elseif( !empty($functionalareaID) AND empty($degreeID) AND empty($courseID) ){
            foreach ($getFilterOutDataObj as $exportExcelData) {
                        $arrayData12[] = json_decode(json_encode($exportExcelData),TRUE);

                    }
                    $json_str1='[';
                    $not_length = count($getFilterOutDataObj);
                    for ($i=0; $i < $not_length; $i++) {
                        $a=$arrayData12[$i]['collegeprofileID'];
                        $json_str1.='{"collegeprofileID": "'.$a.'",';
                        $json_str1.='"usersId": "'.$arrayData12[$i]['usersId'].'",';
                        $json_str1.='"firstname": "'.$arrayData12[$i]['firstname'].'",';
                        $json_str1.='"slug": "'.$arrayData12[$i]['slug'].'",';
                        $json_str1.='"agreement": "'.$arrayData12[$i]['agreement'].'",';
                        $json_str1.='"cityName": "'.$arrayData12[$i]['cityName'].'",';
                        $json_str1.='"stateName": "'.$arrayData12[$i]['stateName'].'",';
                        $json_str1.='"functionalareaID": "'.$arrayData12[$i]['functionalareaID'].'",';
                        $json_str1.='"degreeID": "'.$arrayData12[$i]['degreeID'].'",';
                        $json_str1.='"courseID": "'.$arrayData12[$i]['courseID'].'",';
                        $json_str1.='"courseName": "'.$arrayData12[$i]['courseName'].'",';
                        $json_str1.='"collegemasterID": "'.$arrayData12[$i]['collegemasterID'].'",';
                        $json_str1.='"fees": "'.$arrayData12[$i]['fees'].'",';
                        $json_str1.='"seats": "'.$arrayData12[$i]['seats'].'",';
                        $json_str1.='"galleryName": "'.$arrayData12[$i]['galleryName'].'",';
                        $json_str1.='"caption": "'.$arrayData12[$i]['caption'].'",';
                        $json_str1.='"width": "'.$arrayData12[$i]['width'].'",';
                        $json_str1.='"height": "'.$arrayData12[$i]['height'].'",';
                        $json_str1.='"collegefacilitiesID": "'.$arrayData12[$i]['collegefacilitiesID'].'",';
                        if(!empty($a)){
                            $b="";
                            $c="";
                            foreach($arrayData12 as $arrayData123)
                            {
                                if($a==$arrayData123["collegeprofileID"])
                                {

                                    $b.=$arrayData123["degreeName"]." ,";
                                    $c.=$arrayData123["functionalareaName"].'|'.$arrayData123["courseName"]." ,";
                                    $i++;
                                }
                            }
                            $i--;
                            $json_str1.='"functionalareaName": "'.trim($b," ,").'","degreeName": "'.trim($c," ,").'"},';
                            // echo '<br>';

                        }else{
                            continue;
                        }
                    }
                    $json_str1=trim($json_str1,",");
                    $json_str1.= "]";
                    //echo $json_str1;die;
                    $encodeJson = json_encode('{"functionalareaName":'.$json_str1.'}');
                    $decodeJson1 = json_decode($json_str1);
                    json_encode($decodeJson1);
        }elseif( !empty($degreeID) AND !empty($functionalareaID) AND empty($courseID) ){
            foreach ($getFilterOutDataObj as $exportExcelData) {
                        $arrayData12[] = json_decode(json_encode($exportExcelData),TRUE);

                    }
                    $json_str1='[';
                    $not_length = count($getFilterOutDataObj);
                    for ($i=0; $i < $not_length; $i++) {
                        $a=$arrayData12[$i]['collegeprofileID'];
                        $json_str1.='{"collegeprofileID": "'.$a.'",';
                        $json_str1.='"usersId": "'.$arrayData12[$i]['usersId'].'",';
                        $json_str1.='"firstname": "'.$arrayData12[$i]['firstname'].'",';
                        $json_str1.='"slug": "'.$arrayData12[$i]['slug'].'",';
                        $json_str1.='"agreement": "'.$arrayData12[$i]['agreement'].'",';
                        $json_str1.='"cityName": "'.$arrayData12[$i]['cityName'].'",';
                        $json_str1.='"stateName": "'.$arrayData12[$i]['stateName'].'",';
                        $json_str1.='"functionalareaID": "'.$arrayData12[$i]['functionalareaID'].'",';
                        $json_str1.='"degreeID": "'.$arrayData12[$i]['degreeID'].'",';
                        $json_str1.='"courseID": "'.$arrayData12[$i]['courseID'].'",';
                        $json_str1.='"courseName": "'.$arrayData12[$i]['courseName'].'",';
                        $json_str1.='"collegemasterID": "'.$arrayData12[$i]['collegemasterID'].'",';
                        $json_str1.='"fees": "'.$arrayData12[$i]['fees'].'",';
                        $json_str1.='"seats": "'.$arrayData12[$i]['seats'].'",';
                        $json_str1.='"galleryName": "'.$arrayData12[$i]['galleryName'].'",';
                        $json_str1.='"caption": "'.$arrayData12[$i]['caption'].'",';
                        $json_str1.='"width": "'.$arrayData12[$i]['width'].'",';
                        $json_str1.='"height": "'.$arrayData12[$i]['height'].'",';
                        $json_str1.='"collegefacilitiesID": "'.$arrayData12[$i]['collegefacilitiesID'].'",';
                        if(!empty($a)){
                            $b="";
                            $c="";
                            foreach($arrayData12 as $arrayData123)
                            {
                                if($a==$arrayData123["collegeprofileID"])
                                {

                                    $b.=$arrayData123["courseName"]." ,";
                                    $c.=$arrayData123["functionalareaName"].'|'.$arrayData123["courseName"]." ,";
                                    $i++;
                                }
                            }
                            $i--;
                            $json_str1.='"functionalareaName": "'.trim($b," ,").'","degreeName": "'.trim($c," ,").'"},';
                            // echo '<br>';

                        }else{
                            continue;
                        }
                    }
                    $json_str1=trim($json_str1,",");
                    $json_str1.= "]";
                    //echo $json_str1;die;
                    $encodeJson = json_encode('{"functionalareaName":'.$json_str1.'}');
                    $decodeJson1 = json_decode($json_str1);
                    json_encode($decodeJson1);
        }elseif( !empty($degreeID) AND !empty($functionalareaID) AND !empty($courseID)){
            $decodeJson1 = $getFilterOutDataObj;
        }else{
            $decodeJson1 = $getFilterOutDataObj;
        }

        // echo '<pre>';print_r($decodeJson1);die;

        $tempArrayOfUsersID = array();
        foreach ($getFilterOutDataObj as $key => $value) {
            array_push($tempArrayOfUsersID, $value->usersId);
        }
        $implodeUsersId  = implode("','", $tempArrayOfUsersID);


        if(!empty($getFilterOutDataObj)){
            $dataArray = array(
                    'getFilterOutDataObj' => $decodeJson1,//$getFilterOutDataObj,
                    'getFilterOutDataObj1' => $implodeUsersId,
                    'currentNode' =>$currentNode,
                );
        }else{
            $dataArray = array(
                    'getFilterOutDataObj' => '',
                    'getFilterOutDataObj1' => '',
                    'currentNode' =>'',
                );
        }

        return view('college/filter.fiter-college-details')
                ->with('getFunctionalAreaObj', $getFunctionalAreaObj)
                ->with('getDegreeObj', $getDegreeObj)
                ->with('getCourseObj', $getCourseObj)
                ->with('getEducationLevelObj', $getEducationLevelObj)
                ->with('getCountryObj', $getCountryObj)
                ->with('getStateObj', $getStateObj)
                ->with('getCityObj', $getCityObj)
                ->with('functionalareaID', $functionalareaID)
                ->with('degreeID', $degreeID)
                ->with('courseID', $courseID)
                ->with('countryID', $countryID)
                ->with('stateID', $stateID)
                ->with('cityID', $cityID)
                ->with('getFilterOutDataObj', $dataArray)
                ->with('noMatchFound', $noMatchFound)
                ;
    }

    public function collegeFilterOnParamsMulti(Request $request)
    {

        $functionalAreaArray = array();
        $functionalAreaArray[] = $request->functionalareaID;
        $functionalAreaIDS = array();
        foreach($functionalAreaArray as $key ) {
            $functionalAreaIDS = $key;
        }
        if(!empty($functionalAreaIDS)){
            $storeFuncID = implode (", ", $functionalAreaIDS);
            $search1 =  'AND functionalarea.id IN ('.$storeFuncID.')';

            //Case of GROUP BY
            $orderByFunctionalArea = 'collegemaster.id';
        }else{
            $search1 = '';
            $orderByFunctionalArea = 'collegeprofile.id, functionalarea.id';

        }

        $degreeArray = array();
        $degreeArray[] = $request->degreeID;
        $degreeIDS = array();
        foreach($degreeArray as $key ) {
            $degreeIDS = $key;
        }
        if(!empty($degreeIDS)){
            $storedegreeID = implode (", ", $degreeIDS);
            $search2 =  'AND degree.id IN ('.$storedegreeID.')';
            $addNewGroupByIfDegreeAvail = ', course.id';
        }else{
            $search2 = '';
            $addNewGroupByIfDegreeAvail = '';
        }

        $courseArray = array();
        $courseArray[] = $request->courseID;
        $courseIDS = array();
        foreach($courseArray as $key ) {
            $courseIDS = $key;
        }
        if(!empty($courseIDS)){
            $storecourseID = implode (", ", $courseIDS);
            $search3 =  'AND course.id IN ('.$storecourseID.')';
        }else{
            $search3 = '';
        }

        $educationLevelArray = array();
        $educationLevelArray[] = $request->educationLevelID;
        $educationLevelIDS = array();
        foreach($educationLevelArray as $key ) {
            $educationLevelIDS = $key;
        }
        if(!empty($educationLevelIDS)){
            $storeeducationLevelID = implode (", ", $educationLevelIDS);
            $search4 =  'AND educationlevel.id IN ('.$storeeducationLevelID.')';
        }else{
            $search4 = '';
        }


        $stateArray = array();
        $stateArray[] = $request->stateID;
        $stateIDS = array();
        foreach($stateArray as $key ) {
            $stateIDS = $key;
        }
        if(!empty($stateIDS)){
            $storestateID = implode (", ", $stateIDS);
            $search5 =  'AND state.id IN ('.$storestateID.')';
        }else{
            $search5 = '';
        }

        $cityArray = array();
        $cityArray[] = $request->cityID;
        $cityIDS = array();
        foreach($cityArray as $key ) {
            $cityIDS = $key;
        }
        if(!empty($cityIDS)){
            $storecityID = implode (", ", $cityIDS);
            $search6 =  'AND city.id IN ('.$storecityID.')';
        }else{
            $search6 = '';
        }


        if( !empty($request->lowerFees) ){
            $search7 = 'AND collegemaster.fees BETWEEN  '.$request->lowerFees.' AND  '.$request->highFees.'';
            // $search7 = 'AND collegemaster.fees >  '.$request->lowerFees.'';
        }else{
            $search7 = '';
        }

        if( !empty($request->sortBy) ){
            if( $request->sortBy == 'feeslowtohigh' ){
                $orderBy = 'ORDER BY CAST(collegemaster.fees as SIGNED INTEGER) ASC';
            }else{
                if( $request->sortBy == 'fees' ){
                    if( !empty($functionalAreaIDS) ){
                        $orderBy = 'ORDER BY CAST(collegemaster.fees as SIGNED INTEGER) DESC';
                    }else{
                        $orderBy = 'ORDER BY CAST(collegemaster.fees as SIGNED INTEGER) ASC';
                    }

                }else{
                    $orderBy = 'ORDER BY '.$request->sortBy.' ASC';
                }
            }

        }else{
            $orderBy = 'ORDER BY collegeprofile.id DESC';
        }

        //GET OLD USERS IDS-
        if( !empty($request->oldUsersId) ){
            $search8 = "AND users.id NOT IN ('".$request->oldUsersId."')";
        }else{
            $search8 = '';
        }


        $currentNode = $request->currentNode;
        if(!empty($currentNode)){
            $getValue = ($currentNode - 1)*50;
        }else{
            $getValue = 0;
        }

        //GET FILTERED DATA WITH WHERE IN CLAUSE QUERY
        $getTotalCollegeDataObj = DB::select( DB::raw("SELECT
                    users.id as usersId, users.firstname,
                    collegeprofile.id as collegeprofileID, collegeprofile.slug, collegeprofile.agreement,
                    city.name as cityName, state.name as stateName,
                    functionalarea.id as functionalareaID, functionalarea.name as functionalareaName,
                    degree.id as degreeID, degree.name as degreeName,
                    course.id as courseID, course.name as courseName,
                    collegemaster.id as collegemasterID,collegemaster.fees,collegemaster.seats,
                    gallery.name as galleryName, gallery.caption, gallery.width, gallery.height,
                    collegefacilities.id as collegefacilitiesID
                    FROM  users
                    INNER JOIN collegeprofile ON users.id = collegeprofile.users_id
                    INNER JOIN collegemaster ON collegeprofile.id = collegemaster.collegeprofile_id
                    LEFT JOIN functionalarea ON collegemaster.functionalarea_id = functionalarea.id
                    LEFT JOIN degree ON collegemaster.degree_id = degree.id
                    LEFT JOIN course ON collegemaster.course_id = course.id
                    LEFT JOIN educationlevel ON collegemaster.educationlevel_id = educationlevel.id
                    INNER JOIN address ON collegeprofile.id = address.collegeprofile_id
                    INNER JOIN city ON address.city_id = city.id
                    INNER JOIN state ON city.state_id = state.id
                    LEFT JOIN gallery ON gallery.users_id = users.id
                    LEFT JOIN collegefacilities ON collegemaster.collegeprofile_id  = collegefacilities.collegeprofile_id
                    WHERE users.id
                    $search1
                    $search2
                    $search3
                    $search4
                    $search5
                    $search6
                    $search7
                    $search8
                    AND address.addresstype_id = '1'
                    AND collegeprofile.review = '1'
                    AND collegeprofile.verified = '1'
                    And users.userstatus_id != '5'
                    GROUP BY $orderByFunctionalArea
                    $orderBy
                    LIMIT 50 OFFSET $getValue"
                ));//degree.id $addNewGroupByIfDegreeAvail
            // $search8
            //         AND gallery.misc = 'college-logo-img'?


        //CASE TO CHECK THE DEGREE AND COURSE IDS
        if( empty($storeFuncID) ){
            foreach ($getTotalCollegeDataObj as $exportExcelData) {
                        $arrayData12[] = json_decode(json_encode($exportExcelData),TRUE);

                    }
                    $json_str1='[';
                    $not_length = count($getTotalCollegeDataObj);
                    for ($i=0; $i < $not_length; $i++) {
                        $a=$arrayData12[$i]['collegeprofileID'];
                        $json_str1.='{"collegeprofileID": "'.$a.'",';
                        $json_str1.='"usersId": "'.$arrayData12[$i]['usersId'].'",';
                        $json_str1.='"firstname": "'.$arrayData12[$i]['firstname'].'",';
                        $json_str1.='"slug": "'.$arrayData12[$i]['slug'].'",';
                        $json_str1.='"agreement": "'.$arrayData12[$i]['agreement'].'",';
                        $json_str1.='"cityName": "'.$arrayData12[$i]['cityName'].'",';
                        $json_str1.='"stateName": "'.$arrayData12[$i]['stateName'].'",';
                        $json_str1.='"functionalareaID": "'.$arrayData12[$i]['functionalareaID'].'",';
                        $json_str1.='"degreeID": "'.$arrayData12[$i]['degreeID'].'",';
                        $json_str1.='"courseID": "'.$arrayData12[$i]['courseID'].'",';
                        $json_str1.='"courseName": "'.$arrayData12[$i]['courseName'].'",';
                        $json_str1.='"collegemasterID": "'.$arrayData12[$i]['collegemasterID'].'",';
                        $json_str1.='"fees": "'.$arrayData12[$i]['fees'].'",';
                        $json_str1.='"seats": "'.$arrayData12[$i]['seats'].'",';
                        $json_str1.='"galleryName": "'.$arrayData12[$i]['galleryName'].'",';
                        $json_str1.='"caption": "'.$arrayData12[$i]['caption'].'",';
                        $json_str1.='"width": "'.$arrayData12[$i]['width'].'",';
                        $json_str1.='"height": "'.$arrayData12[$i]['height'].'",';
                        $json_str1.='"collegefacilitiesID": "'.$arrayData12[$i]['collegefacilitiesID'].'",';
                        if(!empty($a)){
                            $b="";
                            $c="";
                            foreach($arrayData12 as $arrayData123)
                            {
                                if($a==$arrayData123["collegeprofileID"])
                                {

                                    $b.=$arrayData123["functionalareaName"]." ,";
                                    $c.=$arrayData123["degreeName"].'|'.$arrayData123["courseName"]." ,";
                                    $i++;
                                }
                            }
                            $i--;
                            $json_str1.='"functionalareaName": "'.trim($b," ,").'","degreeName": "'.trim($c," ,").'"},';
                            // echo '<br>';

                        }else{
                            continue;
                        }
                    }
                    $json_str1=trim($json_str1,",");
                    $json_str1.= "]";
                    //echo $json_str1;die;
                    $encodeJson = json_encode('{"functionalareaName":'.$json_str1.'}');
                    $decodeJson1 = json_decode($json_str1);
                    json_encode($decodeJson1);
        }elseif( !empty($storeFuncID) AND empty($storedegreeID) AND empty($storecourseID) ){
            foreach ($getTotalCollegeDataObj as $exportExcelData) {
                        $arrayData12[] = json_decode(json_encode($exportExcelData),TRUE);

                    }
                    $json_str1='[';
                    $not_length = count($getTotalCollegeDataObj);
                    for ($i=0; $i < $not_length; $i++) {
                        $a=$arrayData12[$i]['collegeprofileID'];
                        $json_str1.='{"collegeprofileID": "'.$a.'",';
                        $json_str1.='"usersId": "'.$arrayData12[$i]['usersId'].'",';
                        $json_str1.='"firstname": "'.$arrayData12[$i]['firstname'].'",';
                        $json_str1.='"slug": "'.$arrayData12[$i]['slug'].'",';
                        $json_str1.='"agreement": "'.$arrayData12[$i]['agreement'].'",';
                        $json_str1.='"cityName": "'.$arrayData12[$i]['cityName'].'",';
                        $json_str1.='"stateName": "'.$arrayData12[$i]['stateName'].'",';
                        $json_str1.='"functionalareaID": "'.$arrayData12[$i]['functionalareaID'].'",';
                        $json_str1.='"degreeID": "'.$arrayData12[$i]['degreeID'].'",';
                        $json_str1.='"courseID": "'.$arrayData12[$i]['courseID'].'",';
                        $json_str1.='"courseName": "'.$arrayData12[$i]['courseName'].'",';
                        $json_str1.='"collegemasterID": "'.$arrayData12[$i]['collegemasterID'].'",';
                        $json_str1.='"fees": "'.$arrayData12[$i]['fees'].'",';
                        $json_str1.='"seats": "'.$arrayData12[$i]['seats'].'",';
                        $json_str1.='"galleryName": "'.$arrayData12[$i]['galleryName'].'",';
                        $json_str1.='"caption": "'.$arrayData12[$i]['caption'].'",';
                        $json_str1.='"width": "'.$arrayData12[$i]['width'].'",';
                        $json_str1.='"height": "'.$arrayData12[$i]['height'].'",';
                        $json_str1.='"collegefacilitiesID": "'.$arrayData12[$i]['collegefacilitiesID'].'",';
                        if(!empty($a)){
                            $b="";
                            $c="";
                            foreach($arrayData12 as $arrayData123)
                            {
                                if($a==$arrayData123["collegeprofileID"])
                                {

                                    $b.=$arrayData123["degreeName"]." ,";
                                    $c.=$arrayData123["functionalareaName"].'|'.$arrayData123["courseName"]." ,";
                                    $i++;
                                }
                            }
                            $i--;
                            $json_str1.='"functionalareaName": "'.trim($b," ,").'","degreeName": "'.trim($c," ,").'"},';
                            // echo '<br>';

                        }else{
                            continue;
                        }
                    }
                    $json_str1=trim($json_str1,",");
                    $json_str1.= "]";
                    //echo $json_str1;die;
                    $encodeJson = json_encode('{"functionalareaName":'.$json_str1.'}');
                    $decodeJson1 = json_decode($json_str1);
                    json_encode($decodeJson1);
        }elseif( !empty($storedegreeID) AND !empty($storeFuncID) AND empty($storecourseID) ){
            foreach ($getTotalCollegeDataObj as $exportExcelData) {
                        $arrayData12[] = json_decode(json_encode($exportExcelData),TRUE);

                    }
                    $json_str1='[';
                    $not_length = count($getTotalCollegeDataObj);
                    for ($i=0; $i < $not_length; $i++) {
                        $a=$arrayData12[$i]['collegeprofileID'];
                        $json_str1.='{"collegeprofileID": "'.$a.'",';
                        $json_str1.='"usersId": "'.$arrayData12[$i]['usersId'].'",';
                        $json_str1.='"firstname": "'.$arrayData12[$i]['firstname'].'",';
                        $json_str1.='"slug": "'.$arrayData12[$i]['slug'].'",';
                        $json_str1.='"agreement": "'.$arrayData12[$i]['agreement'].'",';
                        $json_str1.='"cityName": "'.$arrayData12[$i]['cityName'].'",';
                        $json_str1.='"stateName": "'.$arrayData12[$i]['stateName'].'",';
                        $json_str1.='"functionalareaID": "'.$arrayData12[$i]['functionalareaID'].'",';
                        $json_str1.='"degreeID": "'.$arrayData12[$i]['degreeID'].'",';
                        $json_str1.='"courseID": "'.$arrayData12[$i]['courseID'].'",';
                        $json_str1.='"courseName": "'.$arrayData12[$i]['courseName'].'",';
                        $json_str1.='"collegemasterID": "'.$arrayData12[$i]['collegemasterID'].'",';
                        $json_str1.='"fees": "'.$arrayData12[$i]['fees'].'",';
                        $json_str1.='"seats": "'.$arrayData12[$i]['seats'].'",';
                        $json_str1.='"galleryName": "'.$arrayData12[$i]['galleryName'].'",';
                        $json_str1.='"caption": "'.$arrayData12[$i]['caption'].'",';
                        $json_str1.='"width": "'.$arrayData12[$i]['width'].'",';
                        $json_str1.='"height": "'.$arrayData12[$i]['height'].'",';
                        $json_str1.='"collegefacilitiesID": "'.$arrayData12[$i]['collegefacilitiesID'].'",';
                        if(!empty($a)){
                            $b="";
                            $c="";
                            foreach($arrayData12 as $arrayData123)
                            {
                                if($a==$arrayData123["collegeprofileID"])
                                {

                                    $b.=$arrayData123["courseName"]." ,";
                                    $c.=$arrayData123["functionalareaName"].'|'.$arrayData123["courseName"]." ,";
                                    $i++;
                                }
                            }
                            $i--;
                            $json_str1.='"functionalareaName": "'.trim($b," ,").'","degreeName": "'.trim($c," ,").'"},';
                            // echo '<br>';

                        }else{
                            continue;
                        }
                    }
                    $json_str1=trim($json_str1,",");
                    $json_str1.= "]";
                    //echo $json_str1;die;
                    $encodeJson = json_encode('{"functionalareaName":'.$json_str1.'}');
                    $decodeJson1 = json_decode($json_str1);
                    json_encode($decodeJson1);
        }elseif( !empty($storedegreeID) AND !empty($storeFuncID) AND !empty($storecourseID)){
            $decodeJson1 = $getTotalCollegeDataObj;
        }else{
            $decodeJson1 = $getTotalCollegeDataObj;
        }

        $tempArrayOfUsersID = array();
        foreach ($getTotalCollegeDataObj as $key => $value) {
            array_push($tempArrayOfUsersID, $value->usersId);
        }
        $implodeUsersId  = implode("','", $tempArrayOfUsersID);

        if( !empty($getTotalCollegeDataObj) ){
            $dataArray = array(
                    'code' => '200',
                    'getTotalCollegeDataObj' => $decodeJson1,
                    'getFilterOutDataObj1' => $implodeUsersId,
                );
        }else{
            $dataArray = array(
                    'code' => '401',
                    'getTotalCollegeDataObj' => '',
                    'getFilterOutDataObj1' => '',
                );
        }

        return json_encode($dataArray);
        exit;
    }

    public function getAllCollegeAmenitiesView(Request $request)
    {
        $curentCollegeID = $request->curentCollegeID;

        $getAmenitiesObj = DB::table('collegefacilities')
                        ->leftJoin('facilities', 'collegefacilities.facilities_id', '=', 'facilities.id')
                        ->where('collegefacilities.collegeprofile_id', '=', $curentCollegeID)
                        ->select('collegefacilities.id','facilities.id as facilitiesID','facilities.name as facilitiesName', 'collegefacilities.description','facilities.iconname as iconname')
                        ->orderBy('collegefacilities.id', 'DESC')
                        ->get()
                        ;

        if( !empty($getAmenitiesObj) ){
            $dataArray = array(
                    'code' => '200',
                    'getAmenitiesObj' => $getAmenitiesObj,
                );
        }else{
            $dataArray = array(
                    'code' => '401',
                    'getAmenitiesObj' => '',
                );
        }
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function getAllDegreeMultiByStream(Request $request)
    {
        $functionalAreaArray = array();
        $functionalAreaArray[] = $request->functionalareaID;
        $functionalAreaIDS = array();
        foreach($functionalAreaArray as $key ) {
            $functionalAreaIDS = $key;
        }
        if(!empty($functionalAreaIDS)){
            $storeFuncID = implode (", ", $functionalAreaIDS);
            $search1 =  'AND functionalarea.id IN ('.$storeFuncID.')';
        }else{
            $search1 = '';
        }

        if( !empty($search1) ){
            $getAllDegreeObj = Degree::all();
            $getAllCourseObj = Course::all();
        }else{
            $getAllDegreeObj = '';
            $getAllCourseObj = '';
        }

        $dataArray = array(
                    'code' => '200',
                    'getAllDegreeObj' => $getAllDegreeObj,
                    'getAllCourseObj' => $getAllCourseObj,
                );
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit;
    }

    public function filterCollegeData(Request $request)
    {
        // VARIABLES
        $getAllSelectedStates = [];
        $getAllSelectedCities = [];
        $getAllSelectedDegree = [];
        $getAllSelectedBranch = [];

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query = User::orderBy(DB::raw('ABS(collegemaster.fees)'), 'ASC');
            }elseif ($request->get('filterBy') == '2') {
                $query = User::orderBy(DB::raw('ABS(collegemaster.fees)'), 'DESC');
            }elseif($request->get('filterBy') == '3'){
                $query = User::orderBy('collegeprofile.id', 'DESC');
            }else{
                $query = User::orderBy('collegeprofile.id', 'DESC');
            }
        }else{
            $query = User::orderBy('users.firstname', 'ASC');
        }

        $query->join('collegeprofile', 'users.id', '=', 'collegeprofile.users_id');
        $query->join('collegemaster', 'collegeprofile.id', '=', 'collegemaster.collegeprofile_id');
        $query->leftJoin('functionalarea', 'collegemaster.functionalarea_id', '=', 'functionalarea.id');
        $query->leftJoin('degree', 'collegemaster.degree_id', '=', 'degree.id');
        $query->leftJoin('course', 'collegemaster.course_id', '=', 'course.id');
        $query->leftJoin('educationlevel', 'collegemaster.educationlevel_id', '=', 'educationlevel.id');
        $query->join('address', 'collegeprofile.id', '=', 'address.collegeprofile_id');
        $query->leftJoin('city', 'address.city_id', '=', 'city.id');
        $query->leftJoin('state', 'city.state_id', '=', 'state.id');
        $query->leftJoin('country', 'state.country_id', '=', 'country.id');
        $query->leftJoin('gallery', 'users.id', '=', 'gallery.users_id');
        $query->leftJoin('collegefacilities', 'collegemaster.collegeprofile_id', '=', 'collegefacilities.collegeprofile_id');

				if ($request->has('country_id')) {
            $allCountry[] = $request->get('country_id');

						foreach($allCountry as $key ) {
						$countryIDS = $key;
						}
						if(!empty($countryIDS)){
						$storeCountryID = implode (", ", $countryIDS);
						}

						$query->whereIn('country.id', explode(',', $storeCountryID));

            $getAllSelectedStates = DB::select(DB::raw("SELECT id, name FROM state WHERE state.country_id in (".$storeCountryID.") ORDER BY state.name ASC"));
        }

				if ($request->has('state_id')) {
            $allState[] = $request->get('state_id');

						foreach($allState as $key ) {
							$stateIDS = $key;
						}
						if(!empty($stateIDS)){
						$storeStateID = implode (", ", $stateIDS);
						}

						$query->whereIn('state.id', explode(',', $storeStateID));

            $getAllSelectedCities = DB::select(DB::raw("SELECT id, name FROM city WHERE city.state_id in (".$storeStateID.") ORDER BY city.name ASC"));
        }

				if ($request->has('city_id')) {
            $allCity[] = $request->get('city_id');

						foreach($allCity as $key ) {
							$cityIDS = $key;
						}
						if(!empty($cityIDS)){
						$storeCityID = implode (", ", $cityIDS);
						}
						$query->whereIn('city.id', explode(',', $storeCityID));
        }

				if ($request->has('functionalarea_id')) {
						$allFunctionalArea[] = $request->get('functionalarea_id');

						foreach($allFunctionalArea as $key ) {
							$functionalAreaIDS = $key;
						}
						if(!empty($functionalAreaIDS)){
						$storeFunctionalID = implode (", ", $functionalAreaIDS);
						}

						$query->whereIn('collegemaster.functionalarea_id', explode(',', $storeFunctionalID));

						$getAllSelectedDegree = DB::select(DB::raw("SELECT id, name FROM degree WHERE degree.functionalarea_id in (".$storeFunctionalID.") ORDER BY degree.name ASC"));
				}

				if ($request->has('degree_id')) {
						$allDegree[] = $request->get('degree_id');

						foreach($allDegree as $key ) {
							$degreeIDS = $key;
						}
						if(!empty($degreeIDS)){
						$storeDegreeID = implode (", ", $degreeIDS);
						}

						$query->whereIn('collegemaster.degree_id', explode(',', $storeDegreeID));

						$getAllSelectedBranch = DB::select(DB::raw("SELECT id, name FROM course WHERE course.degree_id in (".$storeDegreeID.") ORDER BY course.name ASC"));
				}


        if ($request->has('degree_id')) {
						if ($request->has('course_id')) {
								$allCourse[] = $request->get('course_id');

								foreach($allCourse as $key ) {
									$courseIds = $key;
								}
								if(!empty($courseIds)){
								$storeCourseID = implode (", ", $courseIds);
								}
								$query->whereIn('collegemaster.course_id', explode(',', $storeCourseID));
						}
        }

        if ($request->has('field_id')) {
            $query->where('collegeprofile.id', '=', $request->get('field_id'));
        }

        if($request->has('filterBy')){
            if( $request->get('filterBy') == '1' ){
                $query->where('collegemaster.fees', '>', '1');
            }
        }

        if($request->has('fees')){
            if( $request->get('fees') == '1' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '100000');
            }elseif( $request->get('fees') == '2' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '100000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '200000');
            }elseif( $request->get('fees') == '3' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '200000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '300000');
            }elseif( $request->get('fees') == '4' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '300000');
                $query->where(DB::raw('ABS(collegemaster.fees)'), '<', '500000');
            }elseif( $request->get('fees') == '5' ){
                $query->where(DB::raw('ABS(collegemaster.fees)'), '>', '500000');
            }else{}
        }

        // $query->where('address.addresstype_id', '=', '2');
        $query->where('collegeprofile.review', '=', '1');
        $query->where('collegeprofile.verified', '=', '1');
        $query->where('users.userstatus_id', '!=', '5');
        $query->where('gallery.misc', '=', 'college-logo-img');
        if( !empty(Input::get('functionalarea_id')) ){
            $query->groupBy('collegeprofile.id');
            $query->groupBy('functionalarea.id');
        }else{
            $query->groupBy('collegeprofile.id');
        }

        $getFilterOutDataObj = $query->paginate(10, array('users.id as usersId', 'users.firstname', 'collegeprofile.id as collegeprofileID', 'collegeprofile.slug', 'collegeprofile.agreement','city.name as cityName', 'state.name as stateName','functionalarea.id as functionalareaID', 'functionalarea.name as functionalareaName','degree.id as degreeID', 'degree.name as degreeName','course.id as courseID', 'course.name as courseName','collegemaster.id as collegemasterID','collegemaster.fees','collegemaster.seats','gallery.id as galleryId','gallery.name as galleryName', 'gallery.caption', 'gallery.width', 'gallery.height','collegefacilities.id as collegefacilitiesID'));


        //GET ALL VALUES
        $getFunctionalAreaObj = FunctionalArea::all();
        $getDegreeObj = Degree::all();
        $getCourseObj = Course::all();
        $getEducationLevelObj = EducationLevel::all();
        $getCountryObj = Country::all();

        //GET THE HOME PAGE BANNER AD
        $getCollegeSeachBannerAds = DB::table('ads_managements')
                                ->where('slug', '=', 2)
                                ->where('isactive', '=', 1)
                                ->whereRaw(DB::raw('ads_managements.start <= "'.date('Y-m-d').'"'))
                                ->whereRaw(DB::raw('ads_managements.end >= "'.date('Y-m-d').'"'))
                                ->select('img', 'redirectto')
                                ->orderBy('ads_managements.id', 'ASC')
                                ->take(4)
                                ->get()
                                ;

        //$getCollegeSeachBannerAds = [];                                
        $getListOfAdsManagements = Cache::remember('getListOfAdsManagements', Config::get('systemsetting.CACHE_LIFE_LIMIT'), function () { 
            return  $this->fetchDataServiceController->getListOfAdsManagements(2);
        });


        return view('college/filter.fiter-college-details-test')
                ->with('getFilterOutDataObj', $getFilterOutDataObj)
                ->with('getFunctionalAreaObj', $getFunctionalAreaObj)
                ->with('getDegreeObj', $getDegreeObj)
                ->with('getCourseObj', $getCourseObj)
                ->with('getEducationLevelObj', $getEducationLevelObj)
                ->with('getCountryObj', $getCountryObj)
                ->with('getAllSelectedStates', $getAllSelectedStates)
                ->with('getAllSelectedCities', $getAllSelectedCities)
                ->with('getAllSelectedDegree', $getAllSelectedDegree)
                ->with('getAllSelectedBranch', $getAllSelectedBranch)
                ->with('getCollegeSeachBannerAds', $getCollegeSeachBannerAds)
                ->with('getListOfAdsManagements', $getListOfAdsManagements)
                ;

    }

    public function getFunctionalAreaName(Request $request)
    {
        $functionalareaIdValue = $request->currentID;
        $functionalareaObj = DB::table('functionalarea')
                    ->where('functionalarea.id', '=', $functionalareaIdValue)
                    ->select('functionalarea.id', 'functionalarea.name')
                    ->orderBy('functionalarea.name','ASC')
                    ->take(1)
                    ->get()
                    ;
        if( !empty($functionalareaObj) ){
            $dataArray = array(
                        'code' => '200',
                        'functionalareaObj' => $functionalareaObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'functionalareaObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    public function getUniversityName(Request $request)
    {
        $universityIdValue = $request->currentID;
        $universityObj = DB::table('university')
                    ->where('university.id', '=', $universityIdValue)
                    ->select('university.id', 'university.name')
                    ->orderBy('university.name','ASC')
                    ->take(1)
                    ->get()
                    ;
        if( !empty($universityObj) ){
            $dataArray = array(
                        'code' => '200',
                        'universityObj' => $universityObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'universityObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    public function getAllExamDegreeName(Request $request)
    {
        $examSecIdValue = $request->currentID;

        $degreeObj = DB::table('exam_sections')
                    ->leftjoin('functionalarea', 'exam_sections.functionalarea_id', '=', 'functionalarea.id')
                    ->leftjoin('degree', 'functionalarea.id', '=', 'degree.functionalarea_id')
                    ->where('exam_sections.id', '=', $examSecIdValue)
                    ->select('degree.id as degreeId', 'degree.name')
                    ->orderBy('degree.name','ASC')
                    ->get();

        if( !empty($degreeObj) ){
            $dataArray = array(
                        'code' => '200',
                        'degreeObj' => $degreeObj,
                     );
        }else{
            $dataArray = array(
                        'code' => '401',
                        'degreeObj' => '',
                     );
        }

        header('Content-Type: application/json');
        echo json_encode($dataArray);
        die;
    }

    public function fetchAsssociatedFacultyList(Request $request)
    {
        $courseId = Input::get('courseId');
        $educationlevelId = Input::get('educationlevelId');
        $coursetypeId = Input::get('coursetypeId');
        $slugUrl = Input::get('slugUrl');

        if (!empty($courseId) && !empty($educationlevelId) && !empty($coursetypeId)) {
            $getAllFacultyName = DB::table('faculty_departments')
                    ->leftJoin('collegeprofile', 'faculty_departments.collegeprofile_id', '=', 'collegeprofile.id')
                    ->leftJoin('faculty','faculty_departments.faculty_id','=','faculty.id')
                    ->where('faculty_departments.course_id', '=', $courseId) 
                    ->where('faculty_departments.educationlevel_id', '=', $educationlevelId) 
                    ->where('faculty_departments.coursetype_id', '=', $coursetypeId) 
                    ->where('collegeprofile.slug', '=', $slugUrl)
                    ->where('faculty.name', '<>', '')
                    ->select( 'faculty.id','faculty.name','faculty.suffix','faculty.designation', DB::raw("CONCAT(faculty.suffix,' ',faculty.name,' (Designation - ', faculty.designation,')') as fullname"))
                    ->orderBy('faculty.name', 'ASC')
                    ->get();

            if ( !empty($getAllFacultyName) ){
                $dataArray = [
                            'code'              => '200',
                            'response'          => 'success',
                            'getAllFacultyName'  => $getAllFacultyName,
                        ];
            }else{
                $dataArray = array(
                    'code'              => '401',
                    'response'          => 'failure',
                    'getAllFacultyName'  => '-1',
                );           
            }
        }else{
            $dataArray = array(
                'code'              => '401',
                'response'          => 'failure',
                'getAllFacultyName'  => '-1',
            );           
        }
        return response()->json($dataArray);
    }
}
