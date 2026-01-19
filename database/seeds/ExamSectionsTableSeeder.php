<?php

use Illuminate\Database\Seeder;

class ExamSectionsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('exam_sections')->delete();
        
		\DB::table('exam_sections')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Engineering',
				'title' => 'Engineering Exams, Dates, Application Form & Alerts',
				'iconImage' => 'engineering-1.png',
				'status' => 1,
				'slug' => 'engineering',
				'employee_id' => 8233,
				'functionalarea_id' => 1,
				'created_at' => '2020-04-15 13:49:53',
				'updated_at' => '2020-04-15 13:52:21',
			),
			1 => 
			array (
				'id' => 2,
				'name' => 'Management',
				'title' => 'Management Exams, Dates, Application Form & Alerts',
				'iconImage' => 'management-2.png',
				'status' => 1,
				'slug' => 'management',
				'employee_id' => 8233,
				'functionalarea_id' => 6,
				'created_at' => '2020-04-15 13:53:14',
				'updated_at' => '2020-04-15 13:53:14',
			),
			2 => 
			array (
				'id' => 3,
				'name' => 'Science',
				'title' => 'Science Exams, Dates, Application Form & Alerts',
				'iconImage' => 'science-3.png',
				'status' => 1,
				'slug' => 'science',
				'employee_id' => 8233,
				'functionalarea_id' => 8,
				'created_at' => '2020-04-15 14:19:42',
				'updated_at' => '2020-04-15 14:19:42',
			),
			3 => 
			array (
				'id' => 4,
				'name' => 'Computer Applications',
				'title' => 'Computer Applications Exams, Dates, Application Form & Alerts',
				'iconImage' => 'computer-applications-4.png',
				'status' => 1,
				'slug' => 'computer-applications',
				'employee_id' => 8233,
				'functionalarea_id' => 15,
				'created_at' => '2020-04-15 14:21:12',
				'updated_at' => '2020-04-15 14:21:12',
			),
			4 => 
			array (
				'id' => 5,
				'name' => 'Law',
				'title' => 'Law Exams, Dates, Application Form & Alerts',
				'iconImage' => 'law-5.png',
				'status' => 1,
				'slug' => 'law',
				'employee_id' => 8233,
				'functionalarea_id' => 14,
				'created_at' => '2020-04-15 14:41:30',
				'updated_at' => '2020-04-15 14:41:30',
			),
			5 => 
			array (
				'id' => 6,
				'name' => 'Pharmacy',
				'title' => 'Pharmacy Exams, Dates, Application Form & Alerts',
				'iconImage' => 'pharmacy-6.png',
				'status' => 1,
				'slug' => 'pharmacy',
				'employee_id' => 8233,
				'functionalarea_id' => 11,
				'created_at' => '2020-04-15 15:01:14',
				'updated_at' => '2020-04-15 15:01:14',
			),
			6 => 
			array (
				'id' => 7,
				'name' => 'Arts',
				'title' => 'Arts Exams, Dates, Application Form & Alerts',
				'iconImage' => 'arts-7.png',
				'status' => 1,
				'slug' => 'arts',
				'employee_id' => 8233,
				'functionalarea_id' => 2,
				'created_at' => '2020-04-15 15:01:45',
				'updated_at' => '2020-04-15 15:01:45',
			),
			7 => 
			array (
				'id' => 8,
				'name' => 'Education & Languages',
				'title' => 'Education Exams, Dates, Application Form & Alerts',
				'iconImage' => 'education-8.png',
				'status' => 1,
				'slug' => 'education',
				'employee_id' => 8233,
				'functionalarea_id' => 4,
				'created_at' => '2020-04-15 15:02:20',
				'updated_at' => '2020-04-15 15:02:20',
			),
			8 => 
			array (
				'id' => 9,
				'name' => 'Commerce',
				'title' => 'Commerce Exams, Dates, Application Form & Alerts',
				'iconImage' => 'commerce-9.png',
				'status' => 1,
				'slug' => 'commerce',
				'employee_id' => 8233,
				'functionalarea_id' => 5,
				'created_at' => '2020-04-15 15:02:49',
				'updated_at' => '2020-04-15 15:02:49',
			),
			9 => 
			array (
				'id' => 10,
				'name' => 'Architecture',
				'title' => 'Architecture Exams, Dates, Application Form & Alerts',
				'iconImage' => 'architecture-10.png',
				'status' => 1,
				'slug' => 'architecture',
				'employee_id' => 8233,
				'functionalarea_id' => 17,
				'created_at' => '2020-04-15 15:03:20',
				'updated_at' => '2020-04-15 15:03:20',
			),
			10 => 
			array (
				'id' => 11,
				'name' => 'Medical',
				'title' => 'Medical Exams, Dates, Application Form & Alerts',
				'iconImage' => 'medical-11.png',
				'status' => 1,
				'slug' => 'medical',
				'employee_id' => 8233,
				'functionalarea_id' => 10,
				'created_at' => '2020-04-15 15:04:29',
				'updated_at' => '2020-04-15 15:04:29',
			),
			11 => 
			array (
				'id' => 12,
				'name' => 'Design',
				'title' => 'Design Exams, Dates, Application Form & Alerts',
				'iconImage' => 'design-12.png',
				'status' => 1,
				'slug' => 'design',
				'employee_id' => 8233,
				'functionalarea_id' => 19,
				'created_at' => '2020-04-15 15:05:01',
				'updated_at' => '2020-04-15 15:05:01',
			),
			12 => 
			array (
				'id' => 13,
				'name' => 'Agriculture',
				'title' => 'Agriculture Exams, Dates, Application Form & Alerts',
				'iconImage' => 'agriculture-13.png',
				'status' => 1,
				'slug' => 'agriculture',
				'employee_id' => 8233,
				'functionalarea_id' => 16,
				'created_at' => '2020-04-15 15:05:43',
				'updated_at' => '2020-04-15 15:05:43',
			),
			13 => 
			array (
				'id' => 14,
				'name' => 'Hotel Management',
				'title' => 'Hotel Management Exams, Dates, Application Form & Alerts',
				'iconImage' => 'hotel-management-14.png',
				'status' => 1,
				'slug' => 'hotel-management',
				'employee_id' => 8233,
				'functionalarea_id' => 7,
				'created_at' => '2020-04-15 15:06:25',
				'updated_at' => '2020-04-15 15:06:25',
			),
			14 => 
			array (
				'id' => 15,
				'name' => 'Paramedical',
				'title' => 'Paramedical Exams, Dates, Application Form & Alerts',
				'iconImage' => 'paramedical-15.png',
				'status' => 1,
				'slug' => 'paramedical',
				'employee_id' => 8233,
				'functionalarea_id' => 12,
				'created_at' => '2020-04-15 15:07:03',
				'updated_at' => '2020-04-15 15:07:03',
			),
			15 => 
			array (
				'id' => 16,
				'name' => 'Veterinary Sciences',
				'title' => 'Veterinary Sciences Exams, Dates, Application Form & Alerts',
				'iconImage' => 'veterinary-sciences-16.png',
				'status' => 1,
				'slug' => 'veterinary-sciences',
				'employee_id' => 8233,
				'functionalarea_id' => 13,
				'created_at' => '2020-04-15 15:07:48',
				'updated_at' => '2020-04-15 15:07:48',
			),
			16 => 
			array (
				'id' => 17,
				'name' => 'Mass Communication & Media',
				'title' => 'Mass Communications Exams, Dates, Application Form & Alerts',
				'iconImage' => 'mass-communications-17.png',
				'status' => 1,
				'slug' => 'mass-communications',
				'employee_id' => 8233,
				'functionalarea_id' => 3,
				'created_at' => '2020-04-15 15:08:30',
				'updated_at' => '2020-04-15 15:08:30',
			),
			17 => 
			array (
				'id' => 18,
				'name' => 'Dental',
				'title' => 'Dental Exams, Dates, Application Form & Alerts',
				'iconImage' => 'dental-20.png',
				'status' => 1,
				'slug' => 'dental',
				'employee_id' => 8233,
				'functionalarea_id' => 9,
				'created_at' => '2020-04-15 15:09:50',
				'updated_at' => '2020-04-15 15:09:50',
			),
			18 => 
			array (
				'id' => 19,
				'name' => 'Beauty & Healthcare',
				'title' => 'Vocational Courses Exams, Dates, Application Form & Alerts',
				'iconImage' => 'beauty-healthcare-19.png',
				'status' => 1,
				'slug' => 'beauty-healthcare',
				'employee_id' => 8233,
				'functionalarea_id' => 21,
				'created_at' => '2020-07-20 13:59:05',
				'updated_at' => '2020-07-20 13:59:05',
			),
			19 => 
			array (
				'id' => 20,
				'name' => 'Engineering and Management',
				'title' => 'Study abroad Entrance',
				'iconImage' => 'engineering-and-management-20.png',
				'status' => 1,
				'slug' => 'engineering-and-management',
				'employee_id' => 8233,
				'functionalarea_id' => 37,
				'created_at' => '2020-07-20 14:01:58',
				'updated_at' => '2020-07-20 14:01:58',
			),
		));
	}

}
