<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('users')->delete();


        $users = array(
            array(
                'suffix'      => 'Mr.',
                'firstname'   => 'Admin',
                'middlename'  => 'Admission',
                'lastname'    => 'X',
                'phone'       => '9810074878',
                'email'       => 'admin@admissionx.com',
                'password'    => '$2y$10$SYIdTMnf7FCg8TragvldweUdOTl3fyWvY2F3JlAG1j3TDGObeBhQq',
                'userstatus_id' => '1',
                'userrole_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'suffix'      => 'Mr.',
                'firstname'   => 'Sub Admin',
                'middlename'  => 'Admission',
                'lastname'    => 'X',
                'phone'       => '111111111',
                'email'       => 'subadmin@admissionx.com',
                'password'    => '$2y$10$SYIdTMnf7FCg8TragvldweUdOTl3fyWvY2F3JlAG1j3TDGObeBhQq',
                'userstatus_id' => '1',
                'userrole_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('users')->insert( $users );
    }
}
