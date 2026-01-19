<?php

use Illuminate\Database\Seeder;

class WhatWeOffersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('what_we_offers')->delete();
        
		\DB::table('what_we_offers')->insert(array (
			0 => 
			array (
				'id' => 1,
				'title' => 'Find Best College',
				'iconImage' => '1592208810-1.png',
				'bannerText' => '',
				'bannerImage' => '',
				'description' => '<p>Find Best Top College in your city by Level, Board, Area, Pincode, Facilities&nbsp;</p>
',
				'status' => 1,
				'slug' => 'find-best-college-1',
				'created_at' => '2020-04-11 10:37:24',
				'updated_at' => '2020-06-15 08:30:37',
				'employee_id' => 8233,
				'pageurl' => 'https://www.admissionx.com:2020/top-colleges',
			),
			1 => 
			array (
				'id' => 2,
				'title' => 'Explore Exams',
				'iconImage' => '1592209028-2.png',
				'bannerText' => '',
				'bannerImage' => '',
				'description' => '<p>All information about the exams that will get you into your dream school.</p>
',
				'status' => 1,
				'slug' => 'explore-exams-2',
				'created_at' => '2020-04-11 10:40:14',
				'updated_at' => '2020-06-15 08:30:15',
				'employee_id' => 8233,
				'pageurl' => 'https://www.admissionx.com:2020/examination',
			),
			2 => 
			array (
				'id' => 3,
				'title' => 'Get Admission',
				'iconImage' => '1592209013-3.png',
				'bannerText' => '',
				'bannerImage' => '',
				'description' => '<p>Find Information about the admission procedure and School fees.</p>
',
				'status' => 1,
				'slug' => 'get-admission-3',
				'created_at' => '2020-04-11 10:42:28',
				'updated_at' => '2020-06-15 08:31:37',
				'employee_id' => 8233,
				'pageurl' => 'https://www.admissionx.com:2020/search',
			),
			3 => 
			array (
				'id' => 4,
				'title' => 'Get Latest Updates',
				'iconImage' => '1592208962-4.png',
				'bannerText' => '',
				'bannerImage' => '',
				'description' => '<p>Stay informed about the latest updates of school, exam, courses.</p>
',
				'status' => 1,
				'slug' => 'get-latest-updates-4',
				'created_at' => '2020-04-11 10:44:28',
				'updated_at' => '2020-06-15 08:32:06',
				'employee_id' => 8233,
				'pageurl' => 'https://www.admissionx.com:2020/latest-updates',
			),
			4 => 
			array (
				'id' => 5,
				'title' => 'Top Courses',
				'iconImage' => '1592208950-5.png',
				'bannerText' => '',
				'bannerImage' => '',
				'description' => '<p>Learn about various mix of courses offered across the country.</p>
',
				'status' => 1,
				'slug' => 'top-courses-5',
				'created_at' => '2020-04-11 10:46:25',
				'updated_at' => '2020-06-15 08:29:17',
				'employee_id' => 8233,
				'pageurl' => 'https://www.admissionx.com:2020/top-courses',
			),
			5 => 
			array (
				'id' => 6,
				'title' => 'Top Reviews',
				'iconImage' => '1592208936-6.png',
				'bannerText' => '',
				'bannerImage' => '',
				'description' => '<p>Know what others have to say about the schools you are searching.</p>
',
				'status' => 1,
				'slug' => 'top-reviews-6',
				'created_at' => '2020-04-11 10:49:20',
				'updated_at' => '2020-06-15 08:28:51',
				'employee_id' => 8233,
				'pageurl' => 'https://www.admissionx.com:2020/reviews',
			),
		));
	}

}
