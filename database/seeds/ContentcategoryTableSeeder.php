<?php

use Illuminate\Database\Seeder;

class ContentcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contentcategory')->delete();
        $contentcategory = array(
            array(
                'name'      => 'About Us',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Admission Registration Policy',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Advertiser Agreement',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Cancellation Refunds',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'College Partner Agreement',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Contact Us',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Disclaimer',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Counselling',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Payments Terms Of Service',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Policies',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Press',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Privacy Policy',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Student Referral Policy',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Terms Of Service',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Terms and Privacy',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Terms and Conditions',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Trust and Safety',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Student Signup Page',
                'status'      => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('contentcategory')->insert( $contentcategory );
    }
}
