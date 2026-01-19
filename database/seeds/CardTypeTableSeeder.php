<?php

use Illuminate\Database\Seeder;

class CardTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('cardtype')->delete();


        $cardtype = array(
            array(
                'name'      => 'Visa',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'MasterCard',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Rupay',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('cardtype')->insert( $cardtype );
    }
}
