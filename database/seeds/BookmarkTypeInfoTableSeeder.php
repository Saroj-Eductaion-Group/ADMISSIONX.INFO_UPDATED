<?php

use Illuminate\Database\Seeder;

class BookmarkTypeInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookmarktypeinfos')->delete();


        $bookmarktypeinfos = array(
            array(
                'name'      => 'College',
                'other'		=> 'College',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Courses',
                'other'		=> 'Courses',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Blog',
                'other'		=> 'Blog',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'News',
                'other'     => 'news',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('bookmarktypeinfos')->insert( $bookmarktypeinfos );
    }
}
