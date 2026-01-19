<?php

use Illuminate\Database\Seeder;

class SliderManagersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('slider_managers')->delete();
        
		\DB::table('slider_managers')->insert(array (
			0 => 
			array (
				'id' => 1,
				'sliderTitle' => 'FIrst Slider',
				'bottomText' => 'Best College In India',
				'sliderImage' => '1589283543-1.jpg',
				'bottomLink' => 'https://www.admissionx.com:2020/india/college-list',
				'scrollerFirstText' => 'Find Over',
				'scrollerLastText' => 'in our portal',
				'status' => 1,
				'isShowCollegeCount' => 1,
				'isShowExamCount' => 1,
				'isShowCourseCount' => 1,
				'isShowBlogCount' => 1,
				'employee_id' => NULL,
				'created_at' => '2020-05-12 08:40:46',
				'updated_at' => '2020-05-12 11:10:02',
			),
			1 => 
			array (
				'id' => 2,
				'sliderTitle' => 'Second Slider',
				'bottomText' => 'Find top college in India',
				'sliderImage' => '1589282483-2.jpg',
				'bottomLink' => 'https://www.admissionx.com:2020/top-colleges',
				'scrollerFirstText' => 'Search over',
				'scrollerLastText' => 'in our board',
				'status' => 1,
				'isShowCollegeCount' => 1,
				'isShowExamCount' => 1,
				'isShowCourseCount' => 1,
				'isShowBlogCount' => 1,
				'employee_id' => NULL,
				'created_at' => '2020-05-12 09:08:00',
				'updated_at' => '2020-05-12 11:11:31',
			),
			2 => 
			array (
				'id' => 3,
				'sliderTitle' => 'Slider 3',
				'bottomText' => 'Best College In Delhi',
				'sliderImage' => '1589283305-3.jpg',
				'bottomLink' => 'https://www.admissionx.com:2020/india/college-list?state%5B%5D=10&country=',
				'scrollerFirstText' => 'Find Over',
				'scrollerLastText' => 'List',
				'status' => 1,
				'isShowCollegeCount' => 1,
				'isShowExamCount' => 1,
				'isShowCourseCount' => 1,
				'isShowBlogCount' => 1,
				'employee_id' => NULL,
				'created_at' => '2020-05-12 11:35:05',
				'updated_at' => '2020-05-12 11:35:05',
			),
			3 => 
			array (
				'id' => 4,
				'sliderTitle' => 'Slider 4',
				'bottomText' => 'Best College In Punjab',
				'sliderImage' => '1589283402-4.jpg',
				'bottomLink' => 'https://www.admissionx.com:2020/india/college-list?state%5B%5D=28&country=',
				'scrollerFirstText' => 'Find Over',
				'scrollerLastText' => 'Pages',
				'status' => 1,
				'isShowCollegeCount' => 1,
				'isShowExamCount' => 1,
				'isShowCourseCount' => 1,
				'isShowBlogCount' => 1,
				'employee_id' => NULL,
				'created_at' => '2020-05-12 11:36:42',
				'updated_at' => '2020-05-12 11:36:42',
			),
			4 => 
			array (
				'id' => 5,
				'sliderTitle' => 'Slider 5',
				'bottomText' => 'Best College In Mumbai',
				'sliderImage' => '1589283636-5.jpg',
				'bottomLink' => 'https://www.admissionx.com:2020/india/college-list?state%5B%5D=21&country=',
				'scrollerFirstText' => 'List of',
				'scrollerLastText' => 'Pages',
				'status' => 1,
				'isShowCollegeCount' => 1,
				'isShowExamCount' => 1,
				'isShowCourseCount' => 1,
				'isShowBlogCount' => 1,
				'employee_id' => NULL,
				'created_at' => '2020-05-12 11:40:36',
				'updated_at' => '2020-05-12 11:40:36',
			),
		));
	}

}
