<?php

use Illuminate\Database\Seeder;

class CollegeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('collegetype')->delete();


        $collegetype = array(
                array(
                    'name'      => 'Private College',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),            
                array(
                    'name'      => 'Government College',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                )
        );

        DB::table('collegetype')->insert( $collegetype );
    }
}
