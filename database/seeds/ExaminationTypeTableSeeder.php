<?php

use Illuminate\Database\Seeder;

class ExaminationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('examination_types')->delete();


        $examination_types = array(
            array(
                'name'              => 'NATIONAL WISE',
                'status'            => 1,
                'slug'              => 'national-wise',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'name'              => 'STATE WISE',
                'status'            => 1,
                'slug'              => 'state-wise',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
        );

        DB::table('examination_types')->insert( $examination_types );
    }
}
