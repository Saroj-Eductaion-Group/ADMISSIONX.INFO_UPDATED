<?php

use Illuminate\Database\Seeder;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('addresstype')->delete();


        $addresstype = array(
            array(
                'name'      => 'Registered Address',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Campus Address',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Permanent Address',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Present Address',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('addresstype')->insert( $addresstype );
    }
}
