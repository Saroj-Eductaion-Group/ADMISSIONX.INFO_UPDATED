<?php

use Illuminate\Database\Seeder;

class ApplicationStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('applicationstatus')->delete();


        $applicationstatus = array(
            array(
                'name'      => 'Approved',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Pending',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Rejected',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Cancelled',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('applicationstatus')->insert( $applicationstatus );
    }
}
