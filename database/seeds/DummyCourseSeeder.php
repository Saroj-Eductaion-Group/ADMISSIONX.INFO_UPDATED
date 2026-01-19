<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyCourseSeeder extends Seeder
{
    public function run()
    {
        // Insert basic lookup data first
        $this->insertLookupData();
        
        // Insert college profile
        $collegeProfileId = $this->insertCollegeProfile();
        
        // Insert college master (course)
        $this->insertCollegeMaster($collegeProfileId);
    }
    
    private function insertLookupData()
    {
        $timestamp = date('Y-m-d H:i:s');
        
        // Insert education level
        try {
            DB::table('educationlevel')->insert([
                'id' => 1,
                'name' => 'Undergraduate',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert functional area
        try {
            DB::table('functionalarea')->insert([
                'id' => 1,
                'name' => 'Engineering',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert degree
        try {
            DB::table('degree')->insert([
                'id' => 1,
                'name' => 'Bachelor of Technology',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert course type
        try {
            DB::table('coursetype')->insert([
                'id' => 1,
                'name' => 'Full Time',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert course
        try {
            DB::table('course')->insert([
                'id' => 1,
                'name' => 'Computer Science Engineering',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert college type
        try {
            DB::table('collegetype')->insert([
                'id' => 1,
                'name' => 'Private',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert user role
        try {
            DB::table('userrole')->insert([
                'id' => 2,
                'name' => 'College',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert user status
        try {
            DB::table('userstatus')->insert([
                'id' => 1,
                'name' => 'Active',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert application status
        try {
            DB::table('applicationstatus')->insert([
                'id' => 1,
                'name' => 'Pending',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        try {
            DB::table('applicationstatus')->insert([
                'id' => 2,
                'name' => 'Submitted',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        // Insert payment status
        try {
            DB::table('paymentstatus')->insert([
                'id' => 1,
                'name' => 'Success',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
        
        try {
            DB::table('paymentstatus')->insert([
                'id' => 7,
                'name' => 'Pending',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        } catch (Exception $e) {}
    }
    
    private function insertCollegeProfile()
    {
        $timestamp = date('Y-m-d H:i:s');
        
        // Check if user already exists
        $existingUser = DB::table('users')->where('email', 'demo@college.com')->first();
        
        if ($existingUser) {
            $userId = $existingUser->id;
        } else {
            // Insert dummy college user
            $userId = DB::table('users')->insertGetId([
                'firstname' => 'Demo',
                'lastname' => 'College',
                'email' => 'demo@college.com',
                'password' => bcrypt('password'),
                'phone' => '9876543210',
                'userrole_id' => 2,
                'userstatus_id' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        }
        
        // Check if college profile already exists
        $existingProfile = DB::table('collegeprofile')->where('users_id', $userId)->first();
        
        if ($existingProfile) {
            return $existingProfile->id;
        }
        
        // Insert college profile
        $collegeProfileId = DB::table('collegeprofile')->insertGetId([
            'description' => 'Demo College for Testing Payment System',
            'estyear' => '2000',
            'website' => 'https://democollege.com',
            'collegecode' => 'DEMO001',
            'contactpersonname' => 'John Doe',
            'contactpersonemail' => 'contact@democollege.com',
            'contactpersonnumber' => '9876543210',
            'slug' => 'demo-college',
            'users_id' => $userId,
            'collegetype_id' => 1,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);
        
        return $collegeProfileId;
    }
    
    private function insertCollegeMaster($collegeProfileId)
    {
        $timestamp = date('Y-m-d H:i:s');
        
        // Insert college master (course offering)
        DB::table('collegemaster')->insert([
            'twelvemarks' => '75',
            'others' => 'Entrance exam required',
            'fees' => '150000',
            'seats' => '60',
            'collegeprofile_id' => $collegeProfileId,
            'educationlevel_id' => 1,
            'functionalarea_id' => 1,
            'degree_id' => 1,
            'coursetype_id' => 1,
            'course_id' => 1,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);
    }
}