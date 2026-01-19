<?php

use Illuminate\Database\Seeder;

class AskQuestionTagsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('ask_question_tags')->delete();
        
		\DB::table('ask_question_tags')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Engineering',
				'slug' => 'engineering',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			1 => 
			array (
				'id' => 2,
				'name' => 'Arts',
				'slug' => 'arts',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			2 => 
			array (
				'id' => 3,
				'name' => 'Media, Films & Mass Communication',
				'slug' => 'media-films-mass-communication',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			3 => 
			array (
				'id' => 4,
				'name' => 'Education & Languages',
				'slug' => 'education-languages',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			4 => 
			array (
				'id' => 5,
				'name' => 'Commerce',
				'slug' => 'commerce',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			5 => 
			array (
				'id' => 6,
				'name' => 'Management',
				'slug' => 'management',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			6 => 
			array (
				'id' => 7,
				'name' => 'Hotel Management',
				'slug' => 'hotel-management',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			7 => 
			array (
				'id' => 8,
				'name' => 'Science',
				'slug' => 'science',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			8 => 
			array (
				'id' => 9,
				'name' => 'Dental',
				'slug' => 'dental',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			9 => 
			array (
				'id' => 10,
				'name' => 'Medical',
				'slug' => 'medical',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			10 => 
			array (
				'id' => 11,
				'name' => 'Pharmacy',
				'slug' => 'pharmacy',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			11 => 
			array (
				'id' => 12,
				'name' => 'Paramedical',
				'slug' => 'paramedical',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			12 => 
			array (
				'id' => 13,
				'name' => 'Veterinary Sciences',
				'slug' => 'veterinary-sciences',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			13 => 
			array (
				'id' => 14,
				'name' => 'Law',
				'slug' => 'law',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			14 => 
			array (
				'id' => 15,
				'name' => 'Computer Applications',
				'slug' => 'computer-applications',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			15 => 
			array (
				'id' => 16,
				'name' => 'Agriculture',
				'slug' => 'agriculture',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			16 => 
			array (
				'id' => 17,
				'name' => 'Architecture',
				'slug' => 'architecture',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			17 => 
			array (
				'id' => 18,
				'name' => 'Aviation',
				'slug' => 'aviation',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			18 => 
			array (
				'id' => 19,
				'name' => 'Design',
				'slug' => 'design',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			19 => 
			array (
				'id' => 20,
				'name' => 'Tourism',
				'slug' => 'tourism',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			20 => 
			array (
				'id' => 21,
				'name' => 'Beauty & Healthcare',
				'slug' => 'beauty-healthcare',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			21 => 
			array (
				'id' => 22,
				'name' => 'Diploma in Pharmacy',
				'slug' => 'diploma-in-pharmacy',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			22 => 
			array (
				'id' => 23,
				'name' => 'Clinical Professional',
				'slug' => 'clinical-professional',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			23 => 
			array (
				'id' => 24,
				'name' => 'Teaching',
				'slug' => 'teaching',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
			24 => 
			array (
				'id' => 25,
				'name' => 'Retail',
				'slug' => 'retail',
				'created_at' => '2020-05-29 11:19:27',
				'updated_at' => '2020-05-29 11:19:27',
			),
		));
	}

}
