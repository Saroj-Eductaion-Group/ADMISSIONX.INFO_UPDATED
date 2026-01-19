<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserStatusTableSeeder');
        $this->call('UserRoleTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('PaymentStatusTableSeeder');
        $this->call('CardTypeTableSeeder');
        $this->call('AddressTypeTableSeeder');
        $this->call('CountryTableSeeder');
        $this->call('StateTableSeeder');
        $this->call('CityTableSeeder');
        $this->call('ApplicationStatusTableSeeder');
        $this->call('EducationLevelTableSeeder');
        $this->call('FunctionalAreaTableSeeder');
        //$this->call('DegreeTableSeeder');
        $this->call('CourseTypeTableSeeder');
        //$this->call('CourseTableSeeder');
        //$this->call('UniversityTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('CollegeTypeTableSeeder');
        $this->call('FacilitiesTableSeeder');
        $this->call('AllTableInformationTableSeeder');
        $this->call('BookmarkTypeInfoTableSeeder');
        Model::reguard();
    	$this->call('WhatWeOffersTableSeeder');
        $this->call('ExaminationTypeTableSeeder');
        $this->call('ApplicationAndExamStatusTableSeeder');
        $this->call('ApplicationModeTableSeeder');
        $this->call('ExaminationModeTableSeeder');
        $this->call('EligibilityCriteriaTableSeeder');
		$this->call('ExamSectionsTableSeeder');
		$this->call('CounselingBoardsTableSeeder');
		$this->call('CounselingBoardDetailsTableSeeder');
        $this->call('ContentcategoryTableSeeder'); 
        $this->call('SeoContentTableSeeder');
		$this->call('SliderManagersTableSeeder');
        $this->call('NewsTypeTableSeeder');
        $this->call('NewsTagsTableSeeder');
		$this->call('AskQuestionTagsTableSeeder');
		$this->call('ContentsTableSeeder');
        $this->call('TemplatesTableSeeder');
        $this->call('EntranceexamTableSeeder');
	}
}
