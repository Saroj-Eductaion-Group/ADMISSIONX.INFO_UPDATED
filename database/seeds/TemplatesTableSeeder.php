<?php

use Illuminate\Database\Seeder;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->delete();
        $templates = array(
            array(
                'name'          => 'Details of the requested form to create a new college profile : Admissionx',
                'description'   => '<p>Hello [NAME] , <br><br><br></p> <p>New college profile from submitted.</p><p>Details are : </p><p>[COMMENTS]</p>',
                'slug'          => 'college_profile_request_form',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'Your college profile request has been submitted',
                'description'   => '<p>Hello [NAME],</p><p>You request have been send successfully.</p><p>Details are : </p><p>[COMMENTS]</p><p> Thanks for interesting to join [TITLE]. We will notify you shortly.</p>',
                'slug'          => 'reply_college_profile_requester',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'You got a follow up email for College Profile',
                'description'   => '<p>Hello [NAME],</p><p>Your college account has been created.</p><p>Details are : </p><p>[COMMENTS]</p>',
                'slug'          => 'after_college_account_created_notification_email',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'Examination counselling forms Details : Admissionx',
                'description'   => '<p><h3>Hi [NAME],</h3></p><p>You have received a new examination counselling forms details.</p><p>Details are : </p><p>[COMMENTS]</p>',
                'slug'          => 'examination_counselling_forms',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'You got a response email',
                'description'   => '<p><h3>Hi [NAME],</h3></p><p>Your details has been submitted successfully. Thanks for visiting&nbsp;[TITLE].</p><p>Details are : </p><p>[COMMENTS]</p>',
                'slug'          => 'send_response_email',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'You got a new ask question/answer/comment email',
                'description'   => '<p><h3>Hi [NAME],</h3></p><p>You have received a new ask question/answer/comment details.</p><p>Details are : </p><p>[COMMENTS]</p>',
                'slug'          => 'submit_question_answer_comment',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'You got a new review email',
                'description'   => '<p><h3>Hi [NAME],</h3></p><p>You have received a new college review forms details.</p><p>Details are : </p><p>[COMMENTS]</p>',
                'slug'          => 'submit_college_review',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'You got a new landing page query',
                'description'   => '<p><h3>Hi [NAME],</h3></p><p>You have received a new landing page query.</p><p>Details are : </p><p>[COMMENTS]</p>',
                'slug'          => 'submit_landing_page_query',
                'status'        => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('templates')->insert( $templates );
    
    }
}
