<?php

use Illuminate\Database\Seeder;

class ExaminationModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('examination_modes')->delete();


        $examination_modes = array(
            array(
                'name'              => 'ONLINE',
                'status'            => 1,
                'slug'              => 'online',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'name'              => 'OFFLINE',
                'status'            => 1,
                'slug'              => 'offline',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'name'              => 'ONLINE & OFFLINE BOTH',
                'status'            => 1,
                'slug'              => 'online-offline-both',
                'employee_id'       => 1,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
        );

        DB::table('examination_modes')->insert( $examination_modes );
    }
}
