<?php

use Illuminate\Database\Seeder;

class EducationLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('educationlevel')->delete();


        $educationlevel = array(
                
                array(
                    'name'      => 'Graduate / Bachelors',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Post Graduate / Masters',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Diploma',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => '10th',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => '12th',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Post Graduate Diploma',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Certification Course',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                )            
        );

        DB::table('educationlevel')->insert( $educationlevel );
    }
}
