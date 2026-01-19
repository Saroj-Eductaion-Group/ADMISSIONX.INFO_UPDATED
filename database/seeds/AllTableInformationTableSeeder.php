<?php

use Illuminate\Database\Seeder;

class AllTableInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('alltableinformations')->delete();


        $alltableinformations = array(
            array('name' => 'Address', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'AddressType', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Album', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Application', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'ApplicationStatus', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Blog', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Bookmark', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'CardType', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Category', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'City', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'CollegeFacility', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'CollegeMaster', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'CollegeProfile', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'CollegeType', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Country', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Course', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'CourseType', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Degree', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Document', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'EducationLevel', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Entranceexam', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Event', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Facility', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Faculty', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'FunctionalArea', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Gallery', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Invite', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Log', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Page', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'PaymentStatus', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Placement', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Query', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'State', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'StudentMark', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'StudentProfile', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Subscribe', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Transaction', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'University', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'UserRole', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'UserStatus', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'User', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'AllTableInformation', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Testimonial', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'Career', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'ApplicationStatusMessages', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'BookmarkTypeInfos', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'SocialManagement', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'UserPrivilege', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),
            array('name' => 'UserGroup', 'description' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime,),

            array('name' => 'AdsManagement','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'AskQuestion','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'AskQuestionAnswer','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'AskQuestionAnswerComment','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'AskQuestionTag','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ApplicationAndExamStatus','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ApplicationMode','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ExaminationMode','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ExaminationType','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'EligibilityCriterion','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CollegeAdmissionProcedure','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CollegeCutOff','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CollegeFaq','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CollegeManagementDetail','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CollegeReview','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CollegeScholarship','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CollegeSportsActivity','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'Contentcategory','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'Content','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'News','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'NewsTag','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'NewsType','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'SliderManager','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'LatestUpdate','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'WhatWeOffer','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'Template','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'SeoContent','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ExamSection','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'TypeOfExamination','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ExamCounsellingForm','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CounselingBoard','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CounselingCareerDetail','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CounselingCoursesDetail','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CounselingCareerInterest','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'CounselingCareerRelevant','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'RequestForCreateCollegeAccount','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'LandingPageQueryForm','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ExamQuestion','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ExamQuestionAnswer','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'ExamQuestionAnswerComment','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'AdsTopCollegeList','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'AIEA_Exam','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'TransactionAnalytics','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),
            array('name' => 'WebsiteMetrics','description' => '','created_at' => new DateTime,'updated_at' => new DateTime,),

            
        );

        DB::table('alltableinformations')->insert( $alltableinformations );
    }
}
