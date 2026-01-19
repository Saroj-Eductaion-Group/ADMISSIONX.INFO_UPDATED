<?php

use Illuminate\Database\Seeder;

class CourseTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('coursetype')->delete();


        $coursetype = array(
                array(
                    'name'      => 'Full Time',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Part Time',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Distance / Correspondence',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Online',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Weekend',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Management',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                )    

        );

        DB::table('coursetype')->insert( $coursetype );
    }
}
