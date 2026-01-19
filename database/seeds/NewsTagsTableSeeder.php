<?php

use Illuminate\Database\Seeder;

class NewsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_tags')->delete();
        $news_tags = array(
            array(
                'name'      => 'JEE Exam',
                'slug'      => 'jee-exam',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'CAT Exam',
                'slug'      => 'cat-exam',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Admission 2020',
                'slug'      => 'admission-2020',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Engineering',
                'slug'      => 'engineering',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Online Entrance',
                'slug'      => 'online-entrance',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'Medical',
                'slug'      => 'medical',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),     
        );

        DB::table('news_tags')->insert( $news_tags );
    }
}
