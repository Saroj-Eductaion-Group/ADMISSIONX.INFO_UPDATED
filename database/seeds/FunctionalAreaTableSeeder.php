<?php

use Illuminate\Database\Seeder;

class FunctionalAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('functionalarea')->delete();


        $functionalarea = array(
                array(
                    'name'      => 'Engineering',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Arts',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Media, Films & Mass Communication',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Education & Languages',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Commerce',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Management',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                    array(
                    'name'      => 'Hotel Management',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Science',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Dental',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Medical',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Pharmacy',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Paramedical',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Veterinary Sciences',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Law',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Computer Applications',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                    array(
                    'name'      => 'Agriculture',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Architecture',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Aviation',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                )
                ,
                array(
                    'name'      => 'Design',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Tourism',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Beauty & Healthcare',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Diploma in Pharmacy',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Clinical Professional',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Teaching',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'Retail',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
        );

        DB::table('functionalarea')->insert( $functionalarea );
    }
}
