<?php

use Illuminate\Database\Seeder;

class CounselingBoardsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('counseling_boards')->delete();
        
		\DB::table('counseling_boards')->insert(array (
			0 => 
			array (
				'id' => 1,
				'title' => 'Central Board of Secondary Education',
				'name' => 'CBSE',
				'misc' => 'National',
				'status' => 1,
				'slug' => 'cbse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 11:55:57',
				'updated_at' => '2020-04-23 12:08:52',
			),
			1 => 
			array (
				'id' => 2,
				'title' => 'Indian Certificate of Secondary Education',
				'name' => 'ICSE',
				'misc' => 'National',
				'status' => 1,
				'slug' => 'icse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 11:57:15',
				'updated_at' => '2020-04-23 12:08:10',
			),
			2 => 
			array (
				'id' => 3,
				'title' => 'National Institute of Open Schooling',
				'name' => 'NIOS',
				'misc' => 'National',
				'status' => 1,
				'slug' => 'nios',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 11:57:28',
				'updated_at' => '2020-04-23 12:06:10',
			),
			3 => 
			array (
				'id' => 4,
				'title' => 'Jammu and Kashmir Board of School Education',
				'name' => 'JKBOSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'jkbose',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:09:27',
				'updated_at' => '2020-04-23 12:09:27',
			),
			4 => 
			array (
				'id' => 5,
			'title' => 'Board of Secondary Education Rajasthan (BSER)',
				'name' => 'RBSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'rbse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:10:01',
				'updated_at' => '2020-04-23 12:10:01',
			),
			5 => 
			array (
				'id' => 6,
				'title' => 'Punjab School Education Board',
				'name' => 'PSEB ',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'pseb',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:10:43',
				'updated_at' => '2020-04-23 12:10:43',
			),
			6 => 
			array (
				'id' => 7,
				'title' => 'Bihar School Examination Board',
				'name' => 'BSEB',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'bseb',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:11:13',
				'updated_at' => '2020-04-23 12:11:13',
			),
			7 => 
			array (
				'id' => 8,
				'title' => 'Uttar Pradesh Madhyamik Shiksha Parishad',
				'name' => 'UPMSP',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'upmsp',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:12:21',
				'updated_at' => '2020-04-23 12:12:21',
			),
			8 => 
			array (
				'id' => 9,
				'title' => 'Gujarat Secondary and Higher Secondary Education Board',
				'name' => 'GSEB',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'gseb',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:12:49',
				'updated_at' => '2020-04-23 12:12:49',
			),
			9 => 
			array (
				'id' => 10,
				'title' => 'Himachal Pradesh Board of School Education',
				'name' => 'HPBOSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'hpbose',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:13:25',
				'updated_at' => '2020-04-23 12:13:25',
			),
			10 => 
			array (
				'id' => 11,
				'title' => 'Madhya Pradesh Board of Secondary Education',
				'name' => 'MPBSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'mpbse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:13:56',
				'updated_at' => '2020-04-23 12:13:56',
			),
			11 => 
			array (
				'id' => 12,
				'title' => 'Board of Intermediate Education Andhra Pradesh',
				'name' => 'BIEAP',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'bieap',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:14:23',
				'updated_at' => '2020-04-23 12:14:23',
			),
			12 => 
			array (
				'id' => 13,
				'title' => 'West Bengal Council of Higher Secondary Education',
				'name' => 'WBCHSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'wbchse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:14:53',
				'updated_at' => '2020-04-23 12:14:53',
			),
			13 => 
			array (
				'id' => 14,
				'title' => 'West Bengal Board of Secondary Education',
				'name' => 'WBBSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'wbbse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:15:29',
				'updated_at' => '2020-04-23 12:15:29',
			),
			14 => 
			array (
				'id' => 15,
				'title' => 'Chhattisgarh Board of Secondary Education',
				'name' => 'CGBSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'cgbse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:16:14',
				'updated_at' => '2020-04-23 12:16:14',
			),
			15 => 
			array (
				'id' => 16,
			'title' => 'Haryana Board of School Education (HBSE)',
				'name' => 'BSEH',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'bseh',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:17:08',
				'updated_at' => '2020-04-23 12:17:08',
			),
			16 => 
			array (
				'id' => 17,
				'title' => 'Maharashtra State Board Of Secondary and Higher Secondary Education',
				'name' => 'MSBSHSE',
				'misc' => 'State',
				'status' => 1,
				'slug' => 'msbshse',
				'employee_id' => 8233,
				'created_at' => '2020-04-23 12:18:17',
				'updated_at' => '2020-04-23 12:18:17',
			),
		));
	}

}
