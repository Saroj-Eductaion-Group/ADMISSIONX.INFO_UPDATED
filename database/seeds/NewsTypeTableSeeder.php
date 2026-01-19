<?php

use Illuminate\Database\Seeder;

class NewsTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_types')->delete();
        $news_types = array(
            array(
                'name'      => 'Latest News',
                'slug'      => 'latest-news',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Exam News',
                'slug'      => 'exam-news',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'College News',
                'slug'      => 'college-news',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Admission News',
                'slug'      => 'admission-news',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Result News',
                'slug'      => 'result-news',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Featured News',
                'slug'      => 'featured-news',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
           
        );

        DB::table('news_types')->insert( $news_types );
    }
}
