<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('category')->delete();


        $category = array(
            array(
                'name'      => 'Gallery Common Photos',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'College Document',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
            ,
            array(
                'name'      => 'Student Document',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
            ,
            array(
                'name'      => 'College Logo',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Resume',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )

        );

        DB::table('category')->insert( $category );
    }
}
