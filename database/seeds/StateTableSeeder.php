<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('state')->delete();


        $state = array(
            array(
                'name'      => 'Andaman & Nicobar Islands',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Andhra Pradesh',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Arunachal Pradesh',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Assam',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Bihar',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Chandigarh',
                'created_at' => new DateTime,
                'updated_at' => new DateTime, 
                'country_id' => 99,
            ),
            array(
                'name'      => 'Chhattisgarh',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Dadra & Nagar Haveli',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Daman & Diu',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Delhi/NCR',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Goa',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Gujarat',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ), 
            array(
                'name'      => 'Haryana',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Himachal Pradesh',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Jammu & Kashmir',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Jharkhand',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Karnataka',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Kerala',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Lakshadweep',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Madhya Pradesh',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Maharashtra',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Manipur',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Meghalaya',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Mizoram',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Nagaland',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Orissa',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Pondicherry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Punjab',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Rajasthan',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Sikkim',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Tamil Nadu',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Telangana',
                'created_at' => new DateTime,
                'updated_at' => new DateTime, 
                'country_id' => 99,
            ),
            array(
                'name'      => 'Tripura',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Uttar Pradesh',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'Uttarakhand',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'country_id' => 99,
            ),
            array(
                'name'      => 'West Bengal',
                'created_at' => new DateTime,
                'updated_at' => new DateTime, 
                'country_id' => 99,
            )
        );

        DB::table('state')->insert( $state );
    }
}
