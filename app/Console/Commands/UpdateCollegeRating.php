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

class UpdateCollegeRating extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-college-rating';

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
            $slugUrl = $value->slug;
            $this->info('#######################################################################');
            $this->info('College Profile Id '.$collegeProfileId.' Process Started At : '.date('F d,Y h:i A'));

            $collegeRatingObj = DB::table('college_reviews')
                    ->leftJoin('collegeprofile', 'college_reviews.collegeprofile_id', '=', 'collegeprofile.id')
                    ->leftJoin('users', 'collegeprofile.users_id', '=', 'users.id')
                    ->where('collegeprofile.slug', '=', $slugUrl)
                    ->select(DB::Raw('(SELECT count(votes) from college_reviews where votes=1 and college_reviews.users_id= users.id) AS totalLikes'),
                        DB::Raw('(SELECT count(votes) from college_reviews where votes=2 and college_reviews.users_id= users.id) AS totalDislike'),
                        DB::Raw('(Count(college_reviews.id)) AS totalCount'),
                        DB::Raw('(SUM(academic)) AS totalAcademic'),
                        DB::Raw('(SUM(academic)/Count(academic)) AS totalAcademicStar'),
                        DB::Raw('(SUM(accommodation)) AS totalAccommodation'),
                        DB::Raw('(SUM(accommodation)/Count(accommodation)) AS totalAccommodationStar'),
                        DB::Raw('(SUM(faculty)) AS totalFaculty'),
                        DB::Raw('(SUM(faculty)/Count(faculty)) AS totalFacultyStar'),
                        DB::Raw('(SUM(infrastructure)) AS totalInfrastructure'),
                        DB::Raw('(SUM(infrastructure)/Count(infrastructure)) AS totalInfrastructureStar'),
                        DB::Raw('(SUM(placement)) AS totalPlacement'),
                        DB::Raw('(SUM(placement)/Count(placement)) AS totalPlacementStar'),
                        DB::Raw('(SUM(social)) AS totalSocial'),
                        DB::Raw('(SUM(social)/Count(social)) AS totalSocialStar')
                    )
                    ->orderBy('college_reviews.id', 'ASC')
                    ->get();

            if (sizeof($collegeRatingObj) > 0) {
                if ($collegeRatingObj[0]->totalCount > 0) {
                    //$rating = round(($collegeRatingObj[0]->totalAcademic + $collegeRatingObj[0]->totalAccommodation + $collegeRatingObj[0]->totalFaculty + $collegeRatingObj[0]->totalInfrastructure + $collegeRatingObj[0]->totalPlacement + $collegeRatingObj[0]->totalSocial) / ($collegeRatingObj[0]->totalAcademicStar + $collegeRatingObj[0]->totalAccommodationStar + $collegeRatingObj[0]->totalFacultyStar + $collegeRatingObj[0]->totalInfrastructureStar + $collegeRatingObj[0]->totalPlacementStar + $collegeRatingObj[0]->totalSocialStar), 2);

                    $totalUserRating = $collegeRatingObj[0]->totalAcademic + $collegeRatingObj[0]->totalAccommodation + $collegeRatingObj[0]->totalFaculty + $collegeRatingObj[0]->totalInfrastructure + $collegeRatingObj[0]->totalPlacement + $collegeRatingObj[0]->totalSocial;

                    $totalAllStarCount = $collegeRatingObj[0]->totalAcademicStar + $collegeRatingObj[0]->totalAccommodationStar + $collegeRatingObj[0]->totalFacultyStar + $collegeRatingObj[0]->totalInfrastructureStar + $collegeRatingObj[0]->totalPlacementStar + $collegeRatingObj[0]->totalSocialStar;

                    $totalRatingUser  = $collegeRatingObj[0]->totalCount;
                    $ratingStar = round(($totalUserRating) / ($totalRatingUser), 2);
                    $rating = round(($ratingStar) / 6, 1);

                    $this->info('Actual Rating College Profile Id '.$collegeProfileId.' Rating : '.$rating);
                    $this->info('Actual User Rating  College Profile Id '.$collegeProfileId.' Rating : '.$totalRatingUser);
                }else{
                    $min = 3.5;
                    $max = 5;
                    $rating = mt_rand ($min * 10, $max * 10) / 10;
                    $totalRatingUser  = rand(10,20);

                    $this->info('Virtual Rating College Profile Id '.$collegeProfileId.' Rating : '.$rating);
                    $this->info('Virtual User Rating  College Profile Id '.$collegeProfileId.' Rating : '.$totalRatingUser);
                }
            }else{
                $min = 3.5;
                $max = 5;
                $rating = mt_rand ($min * 10, $max * 10) / 10;
                $totalRatingUser  = rand(10,20);

                $this->info('Virtual Rating College Profile Id '.$collegeProfileId.' Rating : '.$rating);
                $this->info('Virtual User Rating  College Profile Id '.$collegeProfileId.' Rating : '.$totalRatingUser);
            }

            $updateCollegeProfileObj = CollegeProfile::findOrFail($collegeProfileId);
            $updateCollegeProfileObj->rating = $rating;
            $updateCollegeProfileObj->totalRatingUser = $totalRatingUser;
            $updateCollegeProfileObj->save();

            $this->info('#######################################################################');
            $this->info('College Profile Id '.$collegeProfileId.' Process End At : '.date('F d,Y h:i A'));
        }
        $this->info('Process Completed At : '.date('F d,Y h:i A'));
    }
}
