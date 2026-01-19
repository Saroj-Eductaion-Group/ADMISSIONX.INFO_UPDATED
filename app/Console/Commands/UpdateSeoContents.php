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
use App\Models\SeoContent;
use App\Models\City;
use App\Models\Country as Country;
use App\Models\State as State;
use App\Models\University;
use App\Models\CollegeProfile as CollegeProfile;
use App\Models\Degree as Degree;
use App\Models\Course as Course;
use App\Models\CourseType as CourseType;
use App\Models\EducationLevel as EducationLevel;
use App\Models\FunctionalArea as FunctionalArea;
use App\Models\Blog;
use App\Models\NewsTag;
use App\Models\NewsType;
use App\Models\News;
use App\Models\CounselingBoard;
use App\Models\ExamSection;
use App\Models\TypeOfExamination;
use App\Models\AskQuestionTag;

class UpdateSeoContents extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-seo-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Product count for sale, rent, auction & all in city table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        University::orderBy('id', 'ASC')
            ->select(
                'university.id',
                'university.name', 
                'university.pageslug'
                )
            ->chunk(100, function ($allUniversityObj) {
                foreach ($allUniversityObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('University Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' -  Fees, Placements ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateUniversityObj = University::findOrFail($value->id);
                    $updateUniversityObj->pagetitle                 = $pagetitle;
                    $updateUniversityObj->pagedescription           = $pagedescription;
                    $updateUniversityObj->save();
                    
                    $seocontentForUniversity = DB::table('seo_contents')
                        ->where('seo_contents.universityId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForUniversity) > 0){
                        foreach ($seocontentForUniversity as $key1 => $item) {
                            $this->info('Update seo content for University Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateUniversityObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateUniversityObj->pagetitle = $pagetitle;
                            $seoContentUpdateUniversityObj->description = $pagedescription;
                            $seoContentUpdateUniversityObj->keyword = $keyword;
                            $seoContentUpdateUniversityObj->h1title = $pagetitle;
                            $seoContentUpdateUniversityObj->h2title = $pagetitle;
                            $seoContentUpdateUniversityObj->h3title = $pagetitle;
                            $seoContentUpdateUniversityObj->imagealttext     = $pagetitle;
                            $seoContentUpdateUniversityObj->content = $pagedescription;
                            $seoContentUpdateUniversityObj->universityId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateUniversityObj->slugurl = $slugUrl;
                            $seoContentUpdateUniversityObj->misc = 'universitypage';
                            $seoContentUpdateUniversityObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for University Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateUniversityObj = New SeoContent();
                        $seoContentCreateUniversityObj->pagetitle = $pagetitle;
                        $seoContentCreateUniversityObj->description = $pagedescription;
                        $seoContentCreateUniversityObj->keyword = $keyword;
                        $seoContentCreateUniversityObj->h1title = $pagetitle;
                        $seoContentCreateUniversityObj->h2title = $pagetitle;
                        $seoContentCreateUniversityObj->h3title = $pagetitle;
                        $seoContentCreateUniversityObj->imagealttext     = $pagetitle;
                        $seoContentCreateUniversityObj->content = $pagedescription;
                        $seoContentCreateUniversityObj->universityId = $value->id;
                        $seoContentCreateUniversityObj->misc = 'universitypage';
                        $seoContentCreateUniversityObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateUniversityObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateUniversityObj->slugurl = $slugUrl;
                        $seoContentCreateUniversityObj->save();
                    }
                    $this->info('University Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        CollegeProfile::orderBy('id', 'ASC')
            ->leftJoin('users', 'collegeprofile.users_id', '=','users.id')
            ->select(
                'collegeprofile.id',
                'users.firstname', 
                'collegeprofile.description'
                )
            ->chunk(100, function ($allCollegeProfileObj) {
                foreach ($allCollegeProfileObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('CollegeProfile Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->firstname.' ';
                    $pagedescription = $value->description.' ';

                    $seocontentForCollegeProfile = DB::table('seo_contents')
                        ->where('seo_contents.collegeId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForCollegeProfile) > 0){
                        foreach ($seocontentForCollegeProfile as $key1 => $item) {
                            $this->info('Update seo content for CollegeProfile Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateCollegeProfileObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateCollegeProfileObj->pagetitle = $pagetitle;
                            $seoContentUpdateCollegeProfileObj->description = $pagedescription;
                            $seoContentUpdateCollegeProfileObj->keyword = $keyword;
                            $seoContentUpdateCollegeProfileObj->h1title = $pagetitle;
                            $seoContentUpdateCollegeProfileObj->h2title = $pagetitle;
                            $seoContentUpdateCollegeProfileObj->h3title = $pagetitle;
                            $seoContentUpdateCollegeProfileObj->imagealttext     = $pagetitle;
                            $seoContentUpdateCollegeProfileObj->content = $pagedescription;
                            $seoContentUpdateCollegeProfileObj->collegeId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateCollegeProfileObj->slugurl = $slugUrl;
                            $seoContentUpdateCollegeProfileObj->misc = 'collegepage';
                            $seoContentUpdateCollegeProfileObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for CollegeProfile Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateCollegeProfileObj = New SeoContent();
                        $seoContentCreateCollegeProfileObj->pagetitle = $pagetitle;
                        $seoContentCreateCollegeProfileObj->description = $pagedescription;
                        $seoContentCreateCollegeProfileObj->keyword = $keyword;
                        $seoContentCreateCollegeProfileObj->h1title = $pagetitle;
                        $seoContentCreateCollegeProfileObj->h2title = $pagetitle;
                        $seoContentCreateCollegeProfileObj->h3title = $pagetitle;
                        $seoContentCreateCollegeProfileObj->imagealttext     = $pagetitle;
                        $seoContentCreateCollegeProfileObj->content = $pagedescription;
                        $seoContentCreateCollegeProfileObj->collegeId = $value->id;
                        $seoContentCreateCollegeProfileObj->misc = 'collegepage';
                        $seoContentCreateCollegeProfileObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateCollegeProfileObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateCollegeProfileObj->slugurl = $slugUrl;
                        $seoContentCreateCollegeProfileObj->save();
                    }
                    $this->info('CollegeProfile Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
    
        Blog::orderBy('id', 'ASC')
            ->select(
                'blogs.id',
                'blogs.topic', 
                'blogs.description'
                )
            ->chunk(100, function ($allBlogObj) {
                foreach ($allBlogObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('Blog Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->topic.' ';
                    $pagedescription = $value->description;

                    $seocontentForBlog = DB::table('seo_contents')
                        ->where('seo_contents.blogId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForBlog) > 0){
                        foreach ($seocontentForBlog as $key1 => $item) {
                            $this->info('Update seo content for Blog Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateBlogObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateBlogObj->pagetitle = $pagetitle;
                            $seoContentUpdateBlogObj->description = $pagedescription;
                            $seoContentUpdateBlogObj->keyword = $keyword;
                            $seoContentUpdateBlogObj->h1title = $pagetitle;
                            $seoContentUpdateBlogObj->h2title = $pagetitle;
                            $seoContentUpdateBlogObj->h3title = $pagetitle;
                            $seoContentUpdateBlogObj->imagealttext     = $pagetitle;
                            $seoContentUpdateBlogObj->content = $pagedescription;
                            $seoContentUpdateBlogObj->blogId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateBlogObj->slugurl = $slugUrl;
                            $seoContentUpdateBlogObj->misc = 'blogpage';
                            $seoContentUpdateBlogObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for Blog Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateBlogObj = New SeoContent();
                        $seoContentCreateBlogObj->pagetitle = $pagetitle;
                        $seoContentCreateBlogObj->description = $pagedescription;
                        $seoContentCreateBlogObj->keyword = $keyword;
                        $seoContentCreateBlogObj->h1title = $pagetitle;
                        $seoContentCreateBlogObj->h2title = $pagetitle;
                        $seoContentCreateBlogObj->h3title = $pagetitle;
                        $seoContentCreateBlogObj->imagealttext     = $pagetitle;
                        $seoContentCreateBlogObj->content = $pagedescription;
                        $seoContentCreateBlogObj->blogId = $value->id;
                        $seoContentCreateBlogObj->misc = 'blogpage';
                        $seoContentCreateBlogObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateBlogObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateBlogObj->slugurl = $slugUrl;
                        $seoContentCreateBlogObj->save();
                    }
                    $this->info('Blog Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        FunctionalArea::orderBy('id', 'ASC')
            ->select(
                'functionalarea.id',
                'functionalarea.name', 
                'functionalarea.pageslug'
                )
            ->chunk(100, function ($allFunctionalAreaObj) {
                foreach ($allFunctionalAreaObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('FunctionalArea Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateFunctionalAreaObj = FunctionalArea::findOrFail($value->id);
                    $updateFunctionalAreaObj->pagetitle                 = $pagetitle;
                    $updateFunctionalAreaObj->pagedescription           = $pagedescription;
                    $updateFunctionalAreaObj->save();
                    
                    $seocontentForFunctionalArea = DB::table('seo_contents')
                        ->where('seo_contents.functionalAreaId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForFunctionalArea) > 0){
                        foreach ($seocontentForFunctionalArea as $key1 => $item) {
                            $this->info('Update seo content for FunctionalArea Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateFunctionalAreaObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateFunctionalAreaObj->pagetitle = $pagetitle;
                            $seoContentUpdateFunctionalAreaObj->description = $pagedescription;
                            $seoContentUpdateFunctionalAreaObj->keyword = $keyword;
                            $seoContentUpdateFunctionalAreaObj->h1title = $pagetitle;
                            $seoContentUpdateFunctionalAreaObj->h2title = $pagetitle;
                            $seoContentUpdateFunctionalAreaObj->h3title = $pagetitle;
                            $seoContentUpdateFunctionalAreaObj->imagealttext     = $pagetitle;
                            $seoContentUpdateFunctionalAreaObj->content = $pagedescription;
                            $seoContentUpdateFunctionalAreaObj->functionalAreaId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateFunctionalAreaObj->slugurl = $slugUrl;
                            $seoContentUpdateFunctionalAreaObj->misc = 'functionalareapage';
                            $seoContentUpdateFunctionalAreaObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for FunctionalArea Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateFunctionalAreaObj = New SeoContent();
                        $seoContentCreateFunctionalAreaObj->pagetitle = $pagetitle;
                        $seoContentCreateFunctionalAreaObj->description = $pagedescription;
                        $seoContentCreateFunctionalAreaObj->keyword = $keyword;
                        $seoContentCreateFunctionalAreaObj->h1title = $pagetitle;
                        $seoContentCreateFunctionalAreaObj->h2title = $pagetitle;
                        $seoContentCreateFunctionalAreaObj->h3title = $pagetitle;
                        $seoContentCreateFunctionalAreaObj->imagealttext     = $pagetitle;
                        $seoContentCreateFunctionalAreaObj->content = $pagedescription;
                        $seoContentCreateFunctionalAreaObj->functionalAreaId = $value->id;
                        $seoContentCreateFunctionalAreaObj->misc = 'functionalareapage';
                        $seoContentCreateFunctionalAreaObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateFunctionalAreaObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateFunctionalAreaObj->slugurl = $slugUrl;
                        $seoContentCreateFunctionalAreaObj->save();
                    }
                    $this->info('FunctionalArea Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
    
        EducationLevel::orderBy('id', 'ASC')
            ->select(
                'educationlevel.id',
                'educationlevel.name', 
                'educationlevel.pageslug'
                )
            ->chunk(100, function ($allEducationLevelObj) {
                foreach ($allEducationLevelObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('EducationLevel Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateEducationLevelObj = EducationLevel::findOrFail($value->id);
                    $updateEducationLevelObj->pagetitle                 = $pagetitle;
                    $updateEducationLevelObj->pagedescription           = $pagedescription;
                    $updateEducationLevelObj->save();
                    
                    $seocontentForEducationLevel = DB::table('seo_contents')
                        ->where('seo_contents.educationLevelId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForEducationLevel) > 0){
                        foreach ($seocontentForEducationLevel as $key1 => $item) {
                            $this->info('Update seo content for EducationLevel Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateEducationLevelObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateEducationLevelObj->pagetitle = $pagetitle;
                            $seoContentUpdateEducationLevelObj->description = $pagedescription;
                            $seoContentUpdateEducationLevelObj->keyword = $keyword;
                            $seoContentUpdateEducationLevelObj->h1title = $pagetitle;
                            $seoContentUpdateEducationLevelObj->h2title = $pagetitle;
                            $seoContentUpdateEducationLevelObj->h3title = $pagetitle;
                            $seoContentUpdateEducationLevelObj->imagealttext     = $pagetitle;
                            $seoContentUpdateEducationLevelObj->content = $pagedescription;
                            $seoContentUpdateEducationLevelObj->educationLevelId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateEducationLevelObj->slugurl = $slugUrl;
                            $seoContentUpdateEducationLevelObj->misc = 'educationlevelpage';
                            $seoContentUpdateEducationLevelObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for EducationLevel Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateEducationLevelObj = New SeoContent();
                        $seoContentCreateEducationLevelObj->pagetitle = $pagetitle;
                        $seoContentCreateEducationLevelObj->description = $pagedescription;
                        $seoContentCreateEducationLevelObj->keyword = $keyword;
                        $seoContentCreateEducationLevelObj->h1title = $pagetitle;
                        $seoContentCreateEducationLevelObj->h2title = $pagetitle;
                        $seoContentCreateEducationLevelObj->h3title = $pagetitle;
                        $seoContentCreateEducationLevelObj->imagealttext     = $pagetitle;
                        $seoContentCreateEducationLevelObj->content = $pagedescription;
                        $seoContentCreateEducationLevelObj->educationLevelId = $value->id;
                        $seoContentCreateEducationLevelObj->misc = 'educationlevelpage';
                        $seoContentCreateEducationLevelObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateEducationLevelObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateEducationLevelObj->slugurl = $slugUrl;
                        $seoContentCreateEducationLevelObj->save();
                    }
                    $this->info('EducationLevel Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
        
        Degree::orderBy('id', 'ASC')
            ->select(
                'degree.id',
                'degree.name', 
                'degree.pageslug'
                )
            ->chunk(100, function ($allDegreeObj) {
                foreach ($allDegreeObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('Degree Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateDegreeObj = Degree::findOrFail($value->id);
                    $updateDegreeObj->pagetitle                 = $pagetitle;
                    $updateDegreeObj->pagedescription           = $pagedescription;
                    $updateDegreeObj->save();
                    
                    $seocontentForDegree = DB::table('seo_contents')
                        ->where('seo_contents.degreeId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForDegree) > 0){
                        foreach ($seocontentForDegree as $key1 => $item) {
                            $this->info('Update seo content for Degree Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateDegreeObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateDegreeObj->pagetitle = $pagetitle;
                            $seoContentUpdateDegreeObj->description = $pagedescription;
                            $seoContentUpdateDegreeObj->keyword = $keyword;
                            $seoContentUpdateDegreeObj->h1title = $pagetitle;
                            $seoContentUpdateDegreeObj->h2title = $pagetitle;
                            $seoContentUpdateDegreeObj->h3title = $pagetitle;
                            $seoContentUpdateDegreeObj->imagealttext     = $pagetitle;
                            $seoContentUpdateDegreeObj->content = $pagedescription;
                            $seoContentUpdateDegreeObj->degreeId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateDegreeObj->slugurl = $slugUrl;
                            $seoContentUpdateDegreeObj->misc = 'degreepage';
                            $seoContentUpdateDegreeObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for Degree Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateDegreeObj = New SeoContent();
                        $seoContentCreateDegreeObj->pagetitle = $pagetitle;
                        $seoContentCreateDegreeObj->description = $pagedescription;
                        $seoContentCreateDegreeObj->keyword = $keyword;
                        $seoContentCreateDegreeObj->h1title = $pagetitle;
                        $seoContentCreateDegreeObj->h2title = $pagetitle;
                        $seoContentCreateDegreeObj->h3title = $pagetitle;
                        $seoContentCreateDegreeObj->imagealttext     = $pagetitle;
                        $seoContentCreateDegreeObj->content = $pagedescription;
                        $seoContentCreateDegreeObj->degreeId = $value->id;
                        $seoContentCreateDegreeObj->misc = 'degreepage';
                        $seoContentCreateDegreeObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateDegreeObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateDegreeObj->slugurl = $slugUrl;
                        $seoContentCreateDegreeObj->save();
                    }
                    $this->info('Degree Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        Course::orderBy('id', 'ASC')
            ->select(
                'course.id',
                'course.name', 
                'course.pageslug'
                )
            ->chunk(100, function ($allCourseObj) {
                foreach ($allCourseObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('Course Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateCourseObj = Course::findOrFail($value->id);
                    $updateCourseObj->pagetitle                 = $pagetitle;
                    $updateCourseObj->pagedescription           = $pagedescription;
                    $updateCourseObj->save();
                    
                    $seocontentForCourse = DB::table('seo_contents')
                        ->where('seo_contents.topCourseId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForCourse) > 0){
                        foreach ($seocontentForCourse as $key1 => $item) {
                            $this->info('Update seo content for Course Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateCourseObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateCourseObj->pagetitle = $pagetitle;
                            $seoContentUpdateCourseObj->description = $pagedescription;
                            $seoContentUpdateCourseObj->keyword = $keyword;
                            $seoContentUpdateCourseObj->h1title = $pagetitle;
                            $seoContentUpdateCourseObj->h2title = $pagetitle;
                            $seoContentUpdateCourseObj->h3title = $pagetitle;
                            $seoContentUpdateCourseObj->imagealttext     = $pagetitle;
                            $seoContentUpdateCourseObj->content = $pagedescription;
                            $seoContentUpdateCourseObj->topCourseId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateCourseObj->slugurl = $slugUrl;
                            $seoContentUpdateCourseObj->misc = 'topcoursepage';
                            $seoContentUpdateCourseObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for Course Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateCourseObj = New SeoContent();
                        $seoContentCreateCourseObj->pagetitle = $pagetitle;
                        $seoContentCreateCourseObj->description = $pagedescription;
                        $seoContentCreateCourseObj->keyword = $keyword;
                        $seoContentCreateCourseObj->h1title = $pagetitle;
                        $seoContentCreateCourseObj->h2title = $pagetitle;
                        $seoContentCreateCourseObj->h3title = $pagetitle;
                        $seoContentCreateCourseObj->imagealttext     = $pagetitle;
                        $seoContentCreateCourseObj->content = $pagedescription;
                        $seoContentCreateCourseObj->topCourseId = $value->id;
                        $seoContentCreateCourseObj->misc = 'topcoursepage';
                        $seoContentCreateCourseObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateCourseObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateCourseObj->slugurl = $slugUrl;
                        $seoContentCreateCourseObj->save();
                    }
                    $this->info('Course Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
        
        NewsTag::orderBy('id', 'ASC')
            ->select(
                'news_tags.id',
                'news_tags.name'
                )
            ->chunk(100, function ($allNewsTagObj) {
                foreach ($allNewsTagObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('NewsTag Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->name.' -  News list in Admissionx';
                    $pagedescription = $value->name.' Latest News of Colleges, Examination, counselling, career in Admissionx';

                    $seocontentForNewsTag = DB::table('seo_contents')
                        ->where('seo_contents.newsTagId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'News in '.$value->name;
                    if(sizeof($seocontentForNewsTag) > 0){
                        foreach ($seocontentForNewsTag as $key1 => $item) {
                            $this->info('Update seo content for NewsTag Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateNewsTagObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateNewsTagObj->pagetitle = $pagetitle;
                            $seoContentUpdateNewsTagObj->description = $pagedescription;
                            $seoContentUpdateNewsTagObj->keyword = $keyword;
                            $seoContentUpdateNewsTagObj->h1title = $pagetitle;
                            $seoContentUpdateNewsTagObj->h2title = $pagetitle;
                            $seoContentUpdateNewsTagObj->h3title = $pagetitle;
                            $seoContentUpdateNewsTagObj->imagealttext     = $pagetitle;
                            $seoContentUpdateNewsTagObj->content = $pagedescription;
                            $seoContentUpdateNewsTagObj->newsTagId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateNewsTagObj->slugurl = $slugUrl;
                            $seoContentUpdateNewsTagObj->misc = 'newstagpage';
                            $seoContentUpdateNewsTagObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for NewsTag Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateNewsTagObj = New SeoContent();
                        $seoContentCreateNewsTagObj->pagetitle = $pagetitle;
                        $seoContentCreateNewsTagObj->description = $pagedescription;
                        $seoContentCreateNewsTagObj->keyword = $keyword;
                        $seoContentCreateNewsTagObj->h1title = $pagetitle;
                        $seoContentCreateNewsTagObj->h2title = $pagetitle;
                        $seoContentCreateNewsTagObj->h3title = $pagetitle;
                        $seoContentCreateNewsTagObj->imagealttext     = $pagetitle;
                        $seoContentCreateNewsTagObj->content = $pagedescription;
                        $seoContentCreateNewsTagObj->newsTagId = $value->id;
                        $seoContentCreateNewsTagObj->misc = 'newstagpage';
                        $seoContentCreateNewsTagObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateNewsTagObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateNewsTagObj->slugurl = $slugUrl;
                        $seoContentCreateNewsTagObj->save();
                    }
                    $this->info('NewsTag Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        NewsType::orderBy('id', 'ASC')
            ->select(
                'news_types.id',
                'news_types.name'
                )
            ->chunk(100, function ($allNewsTypeObj) {
                foreach ($allNewsTypeObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('NewsType Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->name.' -  News list in Admissionx';
                    $pagedescription = $value->name.' Latest News of Colleges, Examination, counselling, career in Admissionx';

                    $seocontentForNewsType = DB::table('seo_contents')
                        ->where('seo_contents.newsTypeId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'News in '.$value->name;
                    if(sizeof($seocontentForNewsType) > 0){
                        foreach ($seocontentForNewsType as $key1 => $item) {
                            $this->info('Update seo content for NewsType Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateNewsTypeObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateNewsTypeObj->pagetitle = $pagetitle;
                            $seoContentUpdateNewsTypeObj->description = $pagedescription;
                            $seoContentUpdateNewsTypeObj->keyword = $keyword;
                            $seoContentUpdateNewsTypeObj->h1title = $pagetitle;
                            $seoContentUpdateNewsTypeObj->h2title = $pagetitle;
                            $seoContentUpdateNewsTypeObj->h3title = $pagetitle;
                            $seoContentUpdateNewsTypeObj->imagealttext     = $pagetitle;
                            $seoContentUpdateNewsTypeObj->content = $pagedescription;
                            $seoContentUpdateNewsTypeObj->newsTypeId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateNewsTypeObj->slugurl = $slugUrl;
                            $seoContentUpdateNewsTypeObj->misc = 'newstypepage';
                            $seoContentUpdateNewsTypeObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for NewsType Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateNewsTypeObj = New SeoContent();
                        $seoContentCreateNewsTypeObj->pagetitle = $pagetitle;
                        $seoContentCreateNewsTypeObj->description = $pagedescription;
                        $seoContentCreateNewsTypeObj->keyword = $keyword;
                        $seoContentCreateNewsTypeObj->h1title = $pagetitle;
                        $seoContentCreateNewsTypeObj->h2title = $pagetitle;
                        $seoContentCreateNewsTypeObj->h3title = $pagetitle;
                        $seoContentCreateNewsTypeObj->imagealttext     = $pagetitle;
                        $seoContentCreateNewsTypeObj->content = $pagedescription;
                        $seoContentCreateNewsTypeObj->newsTypeId = $value->id;
                        $seoContentCreateNewsTypeObj->misc = 'newstypepage';
                        $seoContentCreateNewsTypeObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateNewsTypeObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateNewsTypeObj->slugurl = $slugUrl;
                        $seoContentCreateNewsTypeObj->save();
                    }
                    $this->info('NewsType Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        AskQuestionTag::orderBy('id', 'ASC')
            ->select(
                'ask_question_tags.id',
                'ask_question_tags.name'
                )
            ->chunk(100, function ($allAskQuestionTagObj) {
                foreach ($allAskQuestionTagObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('AskQuestionTag Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->name.' -  News list in Admissionx';
                    $pagedescription = $value->name.' Latest News of Colleges, Examination, counselling, career in Admissionx';

                    $seocontentForAskQuestionTag = DB::table('seo_contents')
                        ->where('seo_contents.askTagId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'Ask Question in '.$value->name;
                    if(sizeof($seocontentForAskQuestionTag) > 0){
                        foreach ($seocontentForAskQuestionTag as $key1 => $item) {
                            $this->info('Update seo content for AskQuestionTag Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateAskQuestionTagObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateAskQuestionTagObj->pagetitle = $pagetitle;
                            $seoContentUpdateAskQuestionTagObj->description = $pagedescription;
                            $seoContentUpdateAskQuestionTagObj->keyword = $keyword;
                            $seoContentUpdateAskQuestionTagObj->h1title = $pagetitle;
                            $seoContentUpdateAskQuestionTagObj->h2title = $pagetitle;
                            $seoContentUpdateAskQuestionTagObj->h3title = $pagetitle;
                            $seoContentUpdateAskQuestionTagObj->imagealttext     = $pagetitle;
                            $seoContentUpdateAskQuestionTagObj->content = $pagedescription;
                            $seoContentUpdateAskQuestionTagObj->askTagId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateAskQuestionTagObj->slugurl = $slugUrl;
                            $seoContentUpdateAskQuestionTagObj->misc = 'asktagpage';
                            $seoContentUpdateAskQuestionTagObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for AskQuestionTag Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateAskQuestionTagObj = New SeoContent();
                        $seoContentCreateAskQuestionTagObj->pagetitle = $pagetitle;
                        $seoContentCreateAskQuestionTagObj->description = $pagedescription;
                        $seoContentCreateAskQuestionTagObj->keyword = $keyword;
                        $seoContentCreateAskQuestionTagObj->h1title = $pagetitle;
                        $seoContentCreateAskQuestionTagObj->h2title = $pagetitle;
                        $seoContentCreateAskQuestionTagObj->h3title = $pagetitle;
                        $seoContentCreateAskQuestionTagObj->imagealttext     = $pagetitle;
                        $seoContentCreateAskQuestionTagObj->content = $pagedescription;
                        $seoContentCreateAskQuestionTagObj->askTagId = $value->id;
                        $seoContentCreateAskQuestionTagObj->misc = 'asktagpage';
                        $seoContentCreateAskQuestionTagObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateAskQuestionTagObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateAskQuestionTagObj->slugurl = $slugUrl;
                        $seoContentCreateAskQuestionTagObj->save();
                    }
                    $this->info('AskQuestionTag Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
        
        CounselingBoard::orderBy('id', 'ASC')
            ->select(
                'counseling_boards.id',
                'counseling_boards.name', 
                'counseling_boards.title'
                )
            ->chunk(100, function ($allCounselingBoardObj) {
                foreach ($allCounselingBoardObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('CounselingBoard Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->name.' board details ';
                    $pagedescription = $value->name.' '.$value->title.' board details';

                    $seocontentForCounselingBoard = DB::table('seo_contents')
                        ->where('seo_contents.boardId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForCounselingBoard) > 0){
                        foreach ($seocontentForCounselingBoard as $key1 => $item) {
                            $this->info('Update seo content for CounselingBoard Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateCounselingBoardObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateCounselingBoardObj->pagetitle = $pagetitle;
                            $seoContentUpdateCounselingBoardObj->description = $pagedescription;
                            $seoContentUpdateCounselingBoardObj->keyword = $keyword;
                            $seoContentUpdateCounselingBoardObj->h1title = $pagetitle;
                            $seoContentUpdateCounselingBoardObj->h2title = $pagetitle;
                            $seoContentUpdateCounselingBoardObj->h3title = $pagetitle;
                            $seoContentUpdateCounselingBoardObj->imagealttext     = $pagetitle;
                            $seoContentUpdateCounselingBoardObj->content = $pagedescription;
                            $seoContentUpdateCounselingBoardObj->boardId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateCounselingBoardObj->slugurl = $slugUrl;
                            $seoContentUpdateCounselingBoardObj->misc = 'boardpage';
                            $seoContentUpdateCounselingBoardObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for CounselingBoard Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateCounselingBoardObj = New SeoContent();
                        $seoContentCreateCounselingBoardObj->pagetitle = $pagetitle;
                        $seoContentCreateCounselingBoardObj->description = $pagedescription;
                        $seoContentCreateCounselingBoardObj->keyword = $keyword;
                        $seoContentCreateCounselingBoardObj->h1title = $pagetitle;
                        $seoContentCreateCounselingBoardObj->h2title = $pagetitle;
                        $seoContentCreateCounselingBoardObj->h3title = $pagetitle;
                        $seoContentCreateCounselingBoardObj->imagealttext     = $pagetitle;
                        $seoContentCreateCounselingBoardObj->content = $pagedescription;
                        $seoContentCreateCounselingBoardObj->boardId = $value->id;
                        $seoContentCreateCounselingBoardObj->misc = 'boardpage';
                        $seoContentCreateCounselingBoardObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateCounselingBoardObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateCounselingBoardObj->slugurl = $slugUrl;
                        $seoContentCreateCounselingBoardObj->save();
                    }
                    $this->info('CounselingBoard Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        TypeOfExamination::orderBy('id', 'ASC')
            ->select(
                'type_of_examinations.id',
                'type_of_examinations.sortname', 
                'type_of_examinations.name'
                )
            ->chunk(100, function ($allTypeOfExaminationObj) {
                foreach ($allTypeOfExaminationObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('TypeOfExamination Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->sortname.' '.$value->name.' examination ';
                    $pagedescription = $value->sortname.' '.$value->name.' examination details';

                    $seocontentForTypeOfExamination = DB::table('seo_contents')
                        ->where('seo_contents.examId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForTypeOfExamination) > 0){
                        foreach ($seocontentForTypeOfExamination as $key1 => $item) {
                            $this->info('Update seo content for TypeOfExamination Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateTypeOfExaminationObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateTypeOfExaminationObj->pagetitle = $pagetitle;
                            $seoContentUpdateTypeOfExaminationObj->description = $pagedescription;
                            $seoContentUpdateTypeOfExaminationObj->keyword = $keyword;
                            $seoContentUpdateTypeOfExaminationObj->h1title = $pagetitle;
                            $seoContentUpdateTypeOfExaminationObj->h2title = $pagetitle;
                            $seoContentUpdateTypeOfExaminationObj->h3title = $pagetitle;
                            $seoContentUpdateTypeOfExaminationObj->imagealttext     = $pagetitle;
                            $seoContentUpdateTypeOfExaminationObj->content = $pagedescription;
                            $seoContentUpdateTypeOfExaminationObj->examId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateTypeOfExaminationObj->slugurl = $slugUrl;
                            $seoContentUpdateTypeOfExaminationObj->misc = 'examinationpage';
                            $seoContentUpdateTypeOfExaminationObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for TypeOfExamination Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateTypeOfExaminationObj = New SeoContent();
                        $seoContentCreateTypeOfExaminationObj->pagetitle = $pagetitle;
                        $seoContentCreateTypeOfExaminationObj->description = $pagedescription;
                        $seoContentCreateTypeOfExaminationObj->keyword = $keyword;
                        $seoContentCreateTypeOfExaminationObj->h1title = $pagetitle;
                        $seoContentCreateTypeOfExaminationObj->h2title = $pagetitle;
                        $seoContentCreateTypeOfExaminationObj->h3title = $pagetitle;
                        $seoContentCreateTypeOfExaminationObj->imagealttext     = $pagetitle;
                        $seoContentCreateTypeOfExaminationObj->content = $pagedescription;
                        $seoContentCreateTypeOfExaminationObj->examId = $value->id;
                        $seoContentCreateTypeOfExaminationObj->misc = 'examinationpage';
                        $seoContentCreateTypeOfExaminationObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateTypeOfExaminationObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateTypeOfExaminationObj->slugurl = $slugUrl;
                        $seoContentCreateTypeOfExaminationObj->save();
                    }
                    $this->info('TypeOfExamination Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        ExamSection::orderBy('id', 'ASC')
            ->select(
                'exam_sections.id',
                'exam_sections.name', 
                'exam_sections.title'
                )
            ->chunk(100, function ($allExamSectionObj) {
                foreach ($allExamSectionObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('ExamSection Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = $value->name.' '.$value->title.' examination ';
                    $pagedescription = $value->name.' '.$value->title.' examination details';

                    $seocontentForExamSection = DB::table('seo_contents')
                        ->where('seo_contents.examSectionId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForExamSection) > 0){
                        foreach ($seocontentForExamSection as $key1 => $item) {
                            $this->info('Update seo content for ExamSection Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateExamSectionObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateExamSectionObj->pagetitle = $pagetitle;
                            $seoContentUpdateExamSectionObj->description = $pagedescription;
                            $seoContentUpdateExamSectionObj->keyword = $keyword;
                            $seoContentUpdateExamSectionObj->h1title = $pagetitle;
                            $seoContentUpdateExamSectionObj->h2title = $pagetitle;
                            $seoContentUpdateExamSectionObj->h3title = $pagetitle;
                            $seoContentUpdateExamSectionObj->imagealttext     = $pagetitle;
                            $seoContentUpdateExamSectionObj->content = $pagedescription;
                            $seoContentUpdateExamSectionObj->examSectionId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateExamSectionObj->slugurl = $slugUrl;
                            $seoContentUpdateExamSectionObj->misc = 'examsectionpage';
                            $seoContentUpdateExamSectionObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for ExamSection Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateExamSectionObj = New SeoContent();
                        $seoContentCreateExamSectionObj->pagetitle = $pagetitle;
                        $seoContentCreateExamSectionObj->description = $pagedescription;
                        $seoContentCreateExamSectionObj->keyword = $keyword;
                        $seoContentCreateExamSectionObj->h1title = $pagetitle;
                        $seoContentCreateExamSectionObj->h2title = $pagetitle;
                        $seoContentCreateExamSectionObj->h3title = $pagetitle;
                        $seoContentCreateExamSectionObj->imagealttext     = $pagetitle;
                        $seoContentCreateExamSectionObj->content = $pagedescription;
                        $seoContentCreateExamSectionObj->examSectionId = $value->id;
                        $seoContentCreateExamSectionObj->misc = 'examsectionpage';
                        $seoContentCreateExamSectionObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateExamSectionObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateExamSectionObj->slugurl = $slugUrl;
                        $seoContentCreateExamSectionObj->save();
                    }
                    $this->info('ExamSection Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
        
        Country::orderBy('id', 'ASC')
            ->select(
                'country.id',
                'country.name', 
                'country.pageslug'
                )
            ->chunk(100, function ($allCountryObj) {
                foreach ($allCountryObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('Country Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' -  Fees, Placements ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateCountryObj = Country::findOrFail($value->id);
                    $updateCountryObj->pagetitle                 = $pagetitle;
                    $updateCountryObj->pagedescription           = $pagedescription;
                    $updateCountryObj->save();
                    
                    $seocontentForCountry = DB::table('seo_contents')
                        ->where('seo_contents.countryId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForCountry) > 0){
                        foreach ($seocontentForCountry as $key1 => $item) {
                            $this->info('Update seo content for Country Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateCountryObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateCountryObj->pagetitle = $pagetitle;
                            $seoContentUpdateCountryObj->description = $pagedescription;
                            $seoContentUpdateCountryObj->keyword = $keyword;
                            $seoContentUpdateCountryObj->h1title = $pagetitle;
                            $seoContentUpdateCountryObj->h2title = $pagetitle;
                            $seoContentUpdateCountryObj->h3title = $pagetitle;
                            $seoContentUpdateCountryObj->imagealttext     = $pagetitle;
                            $seoContentUpdateCountryObj->content = $pagedescription;
                            $seoContentUpdateCountryObj->countryId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateCountryObj->slugurl = $slugUrl;
                            $seoContentUpdateCountryObj->misc = 'countrypage';
                            $seoContentUpdateCountryObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for Country Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateCountryObj = New SeoContent();
                        $seoContentCreateCountryObj->pagetitle = $pagetitle;
                        $seoContentCreateCountryObj->description = $pagedescription;
                        $seoContentCreateCountryObj->keyword = $keyword;
                        $seoContentCreateCountryObj->h1title = $pagetitle;
                        $seoContentCreateCountryObj->h2title = $pagetitle;
                        $seoContentCreateCountryObj->h3title = $pagetitle;
                        $seoContentCreateCountryObj->imagealttext     = $pagetitle;
                        $seoContentCreateCountryObj->content = $pagedescription;
                        $seoContentCreateCountryObj->countryId = $value->id;
                        $seoContentCreateCountryObj->misc = 'countrypage';
                        $seoContentCreateCountryObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateCountryObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateCountryObj->slugurl = $slugUrl;
                        $seoContentCreateCountryObj->save();
                    }
                    $this->info('Country Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });

        State::orderBy('id', 'ASC')
            ->select(
                'state.id',
                'state.name', 
                'state.pageslug'
                )
            ->chunk(100, function ($allStateObj) {
                foreach ($allStateObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('State Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' -  Fees, Placements ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateStateObj = State::findOrFail($value->id);
                    $updateStateObj->pagetitle                 = $pagetitle;
                    $updateStateObj->pagedescription           = $pagedescription;
                    $updateStateObj->save();
                    
                    $seocontentForState = DB::table('seo_contents')
                        ->where('seo_contents.stateId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForState) > 0){
                        foreach ($seocontentForState as $key1 => $item) {
                            $this->info('Update seo content for State Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateStateObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateStateObj->pagetitle = $pagetitle;
                            $seoContentUpdateStateObj->description = $pagedescription;
                            $seoContentUpdateStateObj->keyword = $keyword;
                            $seoContentUpdateStateObj->h1title = $pagetitle;
                            $seoContentUpdateStateObj->h2title = $pagetitle;
                            $seoContentUpdateStateObj->h3title = $pagetitle;
                            $seoContentUpdateStateObj->imagealttext     = $pagetitle;
                            $seoContentUpdateStateObj->content = $pagedescription;
                            $seoContentUpdateStateObj->stateId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateStateObj->slugurl = $slugUrl;
                            $seoContentUpdateStateObj->misc = 'statepage';
                            $seoContentUpdateStateObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for State Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateStateObj = New SeoContent();
                        $seoContentCreateStateObj->pagetitle = $pagetitle;
                        $seoContentCreateStateObj->description = $pagedescription;
                        $seoContentCreateStateObj->keyword = $keyword;
                        $seoContentCreateStateObj->h1title = $pagetitle;
                        $seoContentCreateStateObj->h2title = $pagetitle;
                        $seoContentCreateStateObj->h3title = $pagetitle;
                        $seoContentCreateStateObj->imagealttext     = $pagetitle;
                        $seoContentCreateStateObj->content = $pagedescription;
                        $seoContentCreateStateObj->stateId = $value->id;
                        $seoContentCreateStateObj->misc = 'statepage';
                        $seoContentCreateStateObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateStateObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateStateObj->slugurl = $slugUrl;
                        $seoContentCreateStateObj->save();
                    }
                    $this->info('State Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
        
        City::orderBy('id', 'ASC')
            ->where('city.totalCollegeByCampusAddress','>',0)
            ->select(
                'city.id',
                'city.name', 
                'city.pageslug'
                )
            ->chunk(100, function ($allCityObj) {
                foreach ($allCityObj as $key => $value) {
                    $this->info('####################################################################');
                    $this->info('city Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));

                    $pagetitle = 'Top Colleges In '.$value->name.' -  Fees, Placements ';
                    $pagedescription = 'Colleges by Fees, Ranking, Faculty, Facilities, Cutoffs, Admission and Placement in '.$value->name;

                    $updateCityObj = City::findOrFail($value->id);
                    $updateCityObj->pagetitle                 = $pagetitle;
                    $updateCityObj->pagedescription           = $pagedescription;
                    $updateCityObj->save();
                    
                    $seocontentForCity = DB::table('seo_contents')
                        ->where('seo_contents.cityId','=', $value->id)
                        ->select('seo_contents.id')
                        ->orderBy('seo_contents.id' ,'DESC')
                        ->get();

                    $keyword = 'College in '.$value->name;
                    if(sizeof($seocontentForCity) > 0){
                        foreach ($seocontentForCity as $key1 => $item) {
                            $this->info('Update seo content for city Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                            $seoContentUpdateCityObj = SeoContent::findOrFail($item->id);
                            $seoContentUpdateCityObj->pagetitle = $pagetitle;
                            $seoContentUpdateCityObj->description = $pagedescription;
                            $seoContentUpdateCityObj->keyword = $keyword;
                            $seoContentUpdateCityObj->h1title = $pagetitle;
                            $seoContentUpdateCityObj->h2title = $pagetitle;
                            $seoContentUpdateCityObj->h3title = $pagetitle;
                            $seoContentUpdateCityObj->imagealttext     = $pagetitle;
                            $seoContentUpdateCityObj->content = $pagedescription;
                            $seoContentUpdateCityObj->cityId = $value->id;
                            $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$item->id);
                            $slugUrl = strtolower($slugUrl);
                            $seoContentUpdateCityObj->slugurl = $slugUrl;
                            $seoContentUpdateCityObj->misc = 'citypage';
                            $seoContentUpdateCityObj->save();
                        }
                    }else{
                        $this->info('Add New seo content for city Id '.$value->id.' Process Started At : '.date('F d,Y h:i A'));
                        $seoContentCreateCityObj = New SeoContent();
                        $seoContentCreateCityObj->pagetitle = $pagetitle;
                        $seoContentCreateCityObj->description = $pagedescription;
                        $seoContentCreateCityObj->keyword = $keyword;
                        $seoContentCreateCityObj->h1title = $pagetitle;
                        $seoContentCreateCityObj->h2title = $pagetitle;
                        $seoContentCreateCityObj->h3title = $pagetitle;
                        $seoContentCreateCityObj->imagealttext     = $pagetitle;
                        $seoContentCreateCityObj->content = $pagedescription;
                        $seoContentCreateCityObj->cityId = $value->id;
                        $seoContentCreateCityObj->misc = 'citypage';
                        $seoContentCreateCityObj->save();

                        $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $keyword.' '.$seoContentCreateCityObj->id);
                        $slugUrl = strtolower($slugUrl);
                        $seoContentCreateCityObj->slugurl = $slugUrl;
                        $seoContentCreateCityObj->save();
                    }
                    $this->info('city Id '.$value->id.' Process End At : '.date('F d,Y h:i A'));
                    $this->info('####################################################################');
                }
            });
        
    }
}
