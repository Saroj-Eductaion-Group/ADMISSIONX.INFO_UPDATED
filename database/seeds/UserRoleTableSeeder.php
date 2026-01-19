<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('userrole')->delete();


        $userrole = array(
            array(
                'name'      => 'ROLE_ADMIN',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'ROLE_COLLEGE',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'ROLE_STUDENT',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'ROLE_AGENT',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('userrole')->insert( $userrole );
    }
}
