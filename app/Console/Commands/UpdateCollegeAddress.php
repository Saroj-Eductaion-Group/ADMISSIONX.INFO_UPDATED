<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\User;
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
use Config;
use Storage;
use DateTime;
use DateTimeZone;
use PDF;
use File;
use App\Models\Mailrecord;
use App\Models\Smsrecord;
use App\Models\CollegeProfile;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class UpdateCollegeAddress extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-college-address';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        ini_set('memory_limit', '-1');
        $collegeProfileObj = DB::table('collegeprofile')
                    ->orderBy('collegeprofile.id', 'ASC')
                    ->get();

        $this->info('Process Started At : '.date('F d,Y h:i A'));
        foreach ($collegeProfileObj as $key => $value) {
            $collegeProfileId = $value->id;
            $this->info('#######################################################################');
            $this->info('College Profile Id '.$collegeProfileId.' Process Started At : '.date('F d,Y h:i A'));
            $collegeRegisteredAddress = DB::table('address')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->where('address.collegeprofile_id', '=', $collegeProfileId)
                        ->where('address.addresstype_id','=','1')
                        ->select('address.name as addressName','address.address1','address.address2','address.postalcode','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.id as countryId','country.name as countryName')
                        ->get();

            foreach ($collegeRegisteredAddress as $key1 => $value1) {
                if(!empty($value1->addressName)){ 
                    $com_addressName = $value1->addressName.',';
                }else{
                    $com_addressName = '';
                }

                if(!empty($value1->address1)){ 
                    $com_address1 = $value1->address1;
                }else{
                    $com_address1 = '';
                }
                
                if(!empty($value1->address2)) { 
                    $com_address2 = ','. $value1->address2; 
                } else{
                    $com_address2 = '';
                }
                if(!empty($value1->landmark)) { 
                    $com_landmark = ','. $value1->landmark; 
                } else{
                    $com_landmark = '';
                }
                if(!empty($value1->cityName)) { 
                    $com_cityName = ','. $value1->cityName;
                    $sort_cityName = $value1->cityName;
                } else{
                    $com_cityName = '';
                    $sort_cityName = '';
                }
                if(!empty($value1->stateName)) { 
                    $com_stateName = ','. $value1->stateName; 
                    $sort_stateName = ', '. $value1->stateName; 
                }else{
                    $com_stateName = '';
                    $sort_stateName = '';
                }
                if(!empty($value1->countryName)) { 
                    $com_countryName = ','. $value1->countryName; 
                    $sort_countryName = ', '. $value1->countryName; 
                } else{
                    $com_countryName = '';
                    $sort_countryName = '';
                }
                if(!empty($value1->postalcode)){ 
                    $com_postalcode = $value1->postalcode; 
                }else{
                    $com_postalcode = '';
                }

                $registeredFullAddress = $com_addressName.' '.$com_address1.' '.$com_address2.' '.$com_cityName.' '.$com_stateName.' '.$com_countryName.' '.$com_postalcode;

                if(!empty($value1->cityId)) { 
                    $registeredSortAddress =  $sort_cityName.' '.$sort_stateName.' '.$sort_countryName;
                } else{
                    $registeredSortAddress = null;
                }

                $updateCollegeProfileObj = CollegeProfile::findOrFail($collegeProfileId);
                $updateCollegeProfileObj->registeredFullAddress = $registeredFullAddress;
                $updateCollegeProfileObj->registeredSortAddress = $registeredSortAddress;
                $updateCollegeProfileObj->registeredAddressCityId = $value1->cityId;
                $updateCollegeProfileObj->registeredAddressStateId = $value1->stateId;
                $updateCollegeProfileObj->registeredAddressCountryId = $value1->countryId;
                $updateCollegeProfileObj->save();

                $this->info('Update Register Address '.date('F d,Y h:i A'));
            }

            $collegeCampusAddress = DB::table('address')
                        ->leftJoin('addresstype', 'address.addresstype_id', '=', 'addresstype.id')  
                        ->leftJoin('city', 'address.city_id', '=', 'city.id')  
                        ->leftJoin('state','city.state_id','=','state.id')
                        ->leftJoin('country','state.country_id','=','country.id')
                        ->where('address.collegeprofile_id', '=', $collegeProfileId)
                        ->where('address.addresstype_id','=','2')
                        ->select('address.name as addressName','address.address1','address.address2','address.postalcode','city.id as cityId', 'city.name as cityName','state.id as stateId', 'state.name as stateName','country.id as countryId','country.name as countryName')
                        ->get();

            foreach ($collegeCampusAddress as $key2 => $value2) {
                if(!empty($value2->addressName)){ 
                    $com_addressName = $value2->addressName.',';
                }else{
                    $com_addressName = '';
                }

                if(!empty($value2->address1)){ 
                    $com_address1 = $value2->address1;
                }else{
                    $com_address1 = '';
                }
                
                if(!empty($value2->address2)) { 
                    $com_address2 = ','. $value2->address2; 
                } else{
                    $com_address2 = '';
                }
                if(!empty($value2->landmark)) { 
                    $com_landmark = ','. $value2->landmark; 
                } else{
                    $com_landmark = '';
                }
                if(!empty($value2->cityName)) { 
                    $com_cityName = ','. $value2->cityName;
                    $sort_cityName = $value2->cityName;
                } else{
                    $com_cityName = '';
                    $sort_cityName = '';
                }
                if(!empty($value2->stateName)) { 
                    $com_stateName = ','. $value2->stateName; 
                    $sort_stateName = ', '. $value2->stateName; 
                }else{
                    $com_stateName = '';
                    $sort_stateName = '';
                }
                if(!empty($value2->countryName)) { 
                    $com_countryName = ','. $value2->countryName; 
                    $sort_countryName = ', '. $value2->countryName; 
                } else{
                    $com_countryName = '';
                    $sort_countryName = '';
                }
                if(!empty($value2->postalcode)){ 
                    $com_postalcode = $value2->postalcode; 
                }else{
                    $com_postalcode = '';
                }

                $campusFullAddress = $com_addressName.' '.$com_address1.' '.$com_address2.' '.$com_cityName.' '.$com_stateName.' '.$com_countryName.' '.$com_postalcode;

                if(!empty($value2->cityId)) { 
                    $campusSortAddress =  $sort_cityName.' '.$sort_stateName.' '.$sort_countryName;
                } else{
                    $campusSortAddress = null;
                }

                $updateCollegeProfileObj = CollegeProfile::findOrFail($collegeProfileId);
                $updateCollegeProfileObj->campusFullAddress = $campusFullAddress;
                $updateCollegeProfileObj->campusSortAddress = $campusSortAddress;
                $updateCollegeProfileObj->campusAddressCityId = $value2->cityId;
                $updateCollegeProfileObj->campusAddressStateId = $value2->stateId;
                $updateCollegeProfileObj->campusAddressCountryId = $value2->countryId;
                $updateCollegeProfileObj->save();

                $this->info('Update Campus Address '.date('F d,Y h:i A'));
            }

            $this->info('#######################################################################');
            $this->info('College Profile Id '.$collegeProfileId.' Process End At : '.date('F d,Y h:i A'));
        }
        $this->info('Process Completed At : '.date('F d,Y h:i A'));
    }
}
