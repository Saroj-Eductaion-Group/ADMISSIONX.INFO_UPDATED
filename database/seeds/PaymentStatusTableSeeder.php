<?php

use Illuminate\Database\Seeder;

class PaymentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('paymentstatus')->delete();


        $paymentstatus = array(
            array(
                'name'      => 'Success',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Failed',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Pending',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Cancelled',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
            ,
            array(
                'name'      => 'Pending Refund',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
            ,
            array(
                'name'      => 'Refunded',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Not Paid',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('paymentstatus')->insert( $paymentstatus );
    }
}
