<?php

use Illuminate\Database\Seeder;

class EligibilityCriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eligibility_criterias')->delete();

        $eligibility_criterias = array(
                
                array(
                    'name'              => 'Graduate / Bachelors',
                    'status'            => 1,
                    'slug'              => 'graduate-bachelors',
                    'employee_id'       => 1,
                    'created_at'        => new DateTime,
                    'updated_at'        => new DateTime,
                ),
                array(
                    'name'              => 'Post Graduate / Masters',
                    'status'            => 1,
                    'slug'              => 'post-graduate-masters',
                    'employee_id'       => 1,
                    'created_at'        => new DateTime,
                    'updated_at'        => new DateTime,
                ),
                array(
                    'name'              => 'Diploma',
                    'status'            => 1,
                    'slug'              => 'diploma',
                    'employee_id'       => 1,
                    'created_at'        => new DateTime,
                    'updated_at'        => new DateTime,
                ),
                array(
                    'name'              => '10th',
                    'status'            => 1,
                    'slug'              => '10th',
                    'employee_id'       => 1,
                    'created_at'        => new DateTime,
                    'updated_at'        => new DateTime,
                ),
                array(
                    'name'              => '12th',
                    'status'            => 1,
                    'slug'              => '12th',
                    'employee_id'       => 1,
                    'created_at'        => new DateTime,
                    'updated_at'        => new DateTime,
                ),
                array(
                    'name'              => 'Post Graduate Diploma',
                    'status'            => 1,
                    'slug'              => 'post-graduate-diploma',
                    'employee_id'       => 1,
                    'created_at'        => new DateTime,
                    'updated_at'        => new DateTime,
                ),
                array(
                    'name'              => 'Certification Course',
                    'status'            => 1,
                    'slug'              => 'certification-course',
                    'employee_id'       => 1,
                    'created_at'        => new DateTime,
                    'updated_at'        => new DateTime,
                )            
        );

        DB::table('eligibility_criterias')->insert( $eligibility_criterias );
    }
}

