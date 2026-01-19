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

class AddressWiseCollegeCount extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'address-wise-college-count';

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
        $countryRegCollegeCountObj = DB::table('country')
                    ->select('country.id', DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.registeredAddressCountryId = country.id) AS totalCollegeRegAddress'))
                    ->get();

        $this->info('Register Address Country Process Started At : '.date('F d,Y h:i A'));
        foreach ($countryRegCollegeCountObj as $key => $value) {
            $countryId = $value->id;
            $this->info('#######################################################################');
            $this->info('Country Id '.$countryId.' Register Address Country Process Started At : '.date('F d,Y h:i A'));
           
           	$updateCountryObj = Country::findOrFail($countryId);
            $updateCountryObj->totalCollegeRegAddress = $value->totalCollegeRegAddress;
            $updateCountryObj->save();

            $this->info('#######################################################################');
            $this->info('Country Id '.$countryId.' Process End At : '.date('F d,Y h:i A'));
        }
        $this->info('Register Address Country Process Completed At : '.date('F d,Y h:i A'));


        $countryCampusCollegeCountObj = DB::table('country')
                    ->select('country.id', DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.campusAddressCountryId = country.id) AS totalCollegeByCampusAddress'))
                    ->get();

        $this->info('Campus Address Country Process Started At : '.date('F d,Y h:i A'));
        foreach ($countryCampusCollegeCountObj as $key => $value) {
            $countryId = $value->id;
            $this->info('#######################################################################');
            $this->info('Country Id '.$countryId.' Campus Address Country Process Started At : '.date('F d,Y h:i A'));
           
           	$updateCountryObj = Country::findOrFail($countryId);
            $updateCountryObj->totalCollegeByCampusAddress = $value->totalCollegeByCampusAddress;
            $updateCountryObj->save();

            $this->info('#######################################################################');
            $this->info('Country Id '.$countryId.' Process End At : '.date('F d,Y h:i A'));
        }
        $this->info('Campus Address Country Process Completed At : '.date('F d,Y h:i A'));


        $this->info('Register Address State Process Started At : '.date('F d,Y h:i A'));
        $stateRegCollegeCountObj = CollegeProfile::orderBy('id', 'ASC')
                                    ->select('collegeprofile.registeredAddressStateId', DB::raw('count(collegeprofile.registeredAddressStateId) as totalCollegeRegAddress'))
                                    ->groupBy('collegeprofile.registeredAddressStateId')
                                    ->get();
        foreach ($stateRegCollegeCountObj as $key => $value) {
            if (!empty($value->registeredAddressStateId)) {
                $stateId = $value->registeredAddressStateId;
	            $this->info('#######################################################################');
	            $this->info('State Id '.$stateId.' Register Address State Process Started At : '.date('F d,Y h:i A'));
	           
	           	$updateCountryObj = State::findOrFail($stateId);
	            $updateCountryObj->totalCollegeRegAddress = $value->totalCollegeRegAddress;
	            $updateCountryObj->save();

	            $this->info('#######################################################################');
	            $this->info('State Id '.$stateId.' Process End At : '.date('F d,Y h:i A'));
            }
        }
        $this->info('Register Address State Process Completed At : '.date('F d,Y h:i A'));


        $this->info('Campus Address State Process Started At : '.date('F d,Y h:i A'));
        $stateCampusCollegeCountObj = CollegeProfile::orderBy('id', 'ASC')
                                    ->select('collegeprofile.campusAddressStateId', DB::raw('count(collegeprofile.campusAddressStateId) as totalCollegeByCampusAddress'))
                                    ->groupBy('collegeprofile.campusAddressStateId')
                                    ->get();
        foreach ($stateCampusCollegeCountObj as $key => $value) {
            if (!empty($value->campusAddressStateId)) {
                $stateId = $value->campusAddressStateId;
                $this->info('#######################################################################');
                $this->info('State Id '.$stateId.' Campus Address State Process Started At : '.date('F d,Y h:i A'));
               
                $updateCountryObj = State::findOrFail($stateId);
                $updateCountryObj->totalCollegeByCampusAddress = $value->totalCollegeByCampusAddress;
                $updateCountryObj->save();

                $this->info('#######################################################################');
                $this->info('State Id '.$stateId.' Process End At : '.date('F d,Y h:i A'));
            }
        }
        $this->info('Campus Address State Process Completed At : '.date('F d,Y h:i A'));

        $this->info('Register Address City Process Started At : '.date('F d,Y h:i A'));
        $cityRegCollegeCountObj = Address::orderBy('id', 'ASC')
                                    ->where('address.addresstype_id', '=', 1)
                                    ->select('address.city_id', DB::raw('count(address.city_id) as totalCollegeRegAddress'))
                                    ->groupBy('address.city_id')
                                    ->get();
            
        foreach ($cityRegCollegeCountObj as $key => $value) {
            if (!empty($value->city_id)) {
                $cityId = $value->city_id;
                $this->info('#######################################################################');
                $this->info('City Id '.$cityId.' Register Address City Process Started At : '.date('F d,Y h:i A'));
               
                $updateCountryObj = City::findOrFail($cityId);
                $updateCountryObj->totalCollegeRegAddress = $value->totalCollegeRegAddress;
                $updateCountryObj->save();

                $this->info('#######################################################################');
                $this->info('City Id '.$cityId.' Process End At : '.date('F d,Y h:i A'));
            }
        }
        $this->info('Register Address City Process Completed At : '.date('F d,Y h:i A'));


        $this->info('Campus Address City Process Started At : '.date('F d,Y h:i A'));
        $cityCampusCollegeCountObj = Address::orderBy('id', 'ASC')
                                        ->where('address.addresstype_id', '=', 2)
                                        ->select('address.city_id', DB::raw('count(address.city_id) as totalCollegeByCampusAddress'))
                                        ->groupBy('address.city_id')
                                        ->get();
        foreach ($cityCampusCollegeCountObj as $key => $value) {
            if (!empty( $value->city_id)) {
                $cityId = $value->city_id;
                $this->info('#######################################################################');
                $this->info('City Id '.$cityId.' Campus Address City Process Started At : '.date('F d,Y h:i A'));
               
                $updateCountryObj = City::findOrFail($cityId);
                $updateCountryObj->totalCollegeByCampusAddress = $value->totalCollegeByCampusAddress;
                $updateCountryObj->save();

                $this->info('#######################################################################');
                $this->info('City Id '.$cityId.' Process End At : '.date('F d,Y h:i A'));
            }
        }
        
        $this->info('Campus Address City Process Completed At : '.date('F d,Y h:i A'));

       /*
       $this->info('Register Address State Process Started At : '.date('F d,Y h:i A'));
        State::orderBy('id', 'ASC')
            ->select(
                'state.id', 
                DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.registeredAddressStateId = state.id) AS totalCollegeRegAddress')
                )
            ->chunk(100, function ($stateRegCollegeCountObj) {
                foreach ($stateRegCollegeCountObj as $key => $value) {
                    $stateId = $value->id;
                        $this->info('#######################################################################');
                        $this->info('State Id '.$stateId.' Register Address State Process Started At : '.date('F d,Y h:i A'));
                       
                        $updateCountryObj = State::findOrFail($stateId);
                        $updateCountryObj->totalCollegeRegAddress = $value->totalCollegeRegAddress;
                        $updateCountryObj->save();

                        $this->info('#######################################################################');
                        $this->info('State Id '.$stateId.' Process End At : '.date('F d,Y h:i A'));
                }
        });
        $this->info('Register Address State Process Completed At : '.date('F d,Y h:i A'));


        $this->info('Campus Address State Process Started At : '.date('F d,Y h:i A'));
        State::orderBy('id', 'ASC')
            ->select(
                'state.id', 
                DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.campusAddressStateId = state.id) AS totalCollegeByCampusAddress')
                )
            ->chunk(100, function ($stateCampusCollegeCountObj) {
                foreach ($stateCampusCollegeCountObj as $key => $value) {
                    $stateId = $value->id;
                        $this->info('#######################################################################');
                        $this->info('State Id '.$stateId.' Register Address State Process Started At : '.date('F d,Y h:i A'));
                       
                        $updateCountryObj = State::findOrFail($stateId);
                        $updateCountryObj->totalCollegeByCampusAddress = $value->totalCollegeByCampusAddress;
                        $updateCountryObj->save();

                        $this->info('#######################################################################');
                        $this->info('State Id '.$stateId.' Process End At : '.date('F d,Y h:i A'));
                }
        });
        $this->info('Campus Address State Process Completed At : '.date('F d,Y h:i A')); $this->info('Register Address City Process Started At : '.date('F d,Y h:i A'));

        City::orderBy('id', 'ASC')
            ->select('city.id', DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.registeredAddressCityId = city.id) AS totalCollegeRegAddress'))
            ->chunk(100, function ($cityRegCollegeCountObj) {
                foreach ($cityRegCollegeCountObj as $key => $value) {
		           	$cityId = $value->id;
		            $this->info('#######################################################################');
		            $this->info('City Id '.$cityId.' Register Address City Process Started At : '.date('F d,Y h:i A'));
		           
		           	$updateCountryObj = City::findOrFail($cityId);
		            $updateCountryObj->totalCollegeRegAddress = $value->totalCollegeRegAddress;
		            $updateCountryObj->save();

		            $this->info('#######################################################################');
		            $this->info('City Id '.$cityId.' Process End At : '.date('F d,Y h:i A'));
                }
        });
        $this->info('Register Address City Process Completed At : '.date('F d,Y h:i A'));


        $this->info('Campus Address City Process Started At : '.date('F d,Y h:i A'));
        City::orderBy('id', 'ASC')
                ->select('city.id', DB::raw('(SELECT COUNT(collegeprofile.id) FROM collegeprofile WHERE collegeprofile.campusAddressCityId = city.id) AS totalCollegeByCampusAddress'))
        ->chunk(100, function ($cityCampusCollegeCountObj) {
		        foreach ($cityCampusCollegeCountObj as $key => $value) {
		            $cityId = $value->id;
		            $this->info('#######################################################################');
		            $this->info('City Id '.$cityId.' Campus Address City Process Started At : '.date('F d,Y h:i A'));
		           
		           	$updateCountryObj = City::findOrFail($cityId);
		            $updateCountryObj->totalCollegeByCampusAddress = $value->totalCollegeByCampusAddress;
		            $updateCountryObj->save();

		            $this->info('#######################################################################');
		            $this->info('City Id '.$cityId.' Process End At : '.date('F d,Y h:i A'));
		        }
        });
        $this->info('Campus Address City Process Completed At : '.date('F d,Y h:i A'));*/
    }
}
