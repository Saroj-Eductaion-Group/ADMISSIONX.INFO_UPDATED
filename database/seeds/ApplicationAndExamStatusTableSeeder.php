<?php

use Illuminate\Database\Seeder;

class ApplicationAndExamStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('application_and_exam_statuses')->delete();


        $application_and_exam_statuses = array(
            array(
                'name'              => 'UPCOMING APPLICATION FORM DATE',
                'status'            => 1,
                'misc'              => 'Application',
                'slug'              => 'upcoming-application-form-date',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'name'              => 'UPCOMING EXAMS',
                'status'            => 1,
                'misc'              => 'Examination',
                'slug'              => 'upcoming-exams',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'name'              => 'APPLICATION FORM IN PROCESS',
                'status'            => 1,
                'misc'              => 'Application',
                'slug'              => 'application-form-in-process',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'name'              => 'EXAM IN PROCESS',
                'status'            => 1,
                'misc'              => 'Examination',
                'slug'              => 'exam-in-process',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
        );






        DB::table('application_and_exam_statuses')->insert( $application_and_exam_statuses );
    }
}
