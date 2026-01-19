<?php

use Illuminate\Database\Seeder;

class DegreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
         DB::table('degree')->delete();
        $degree = array(
                array('name' => 'Bachelor of Business Administration (BBA)', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Arts (BA)', 'functionalarea_id' => 2, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Business Administration (MBA)', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Dental Science (BDS)', 'functionalarea_id' => 9, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Dental Science (MDS)', 'functionalarea_id' => 9, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Veterinary Sciences', 'functionalarea_id' => 13, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Veterinary Science', 'functionalarea_id' => 13, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Homeopathic Medical Science (BHMS)', 'functionalarea_id' => 10, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Laws (LL.B.)', 'functionalarea_id' => 14, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Laws (LL.M.)', 'functionalarea_id' => 14, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Fine Arts (BFA)', 'functionalarea_id' => 2, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'MBBS', 'functionalarea_id' => 10, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Arts (MA)', 'functionalarea_id' => 2, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Surgery (MS)', 'functionalarea_id' => 22, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Computer Applications (BCA)', 'functionalarea_id' => 15, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Computer Applications (MCA)', 'functionalarea_id' => 15, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Pharmacy (M.Pharm)', 'functionalarea_id' => 11, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Pharmacy (B.Pharm)', 'functionalarea_id' => 11, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Architecture (B.Arch)', 'functionalarea_id' => 17, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Doctor of Philosophy  (M.Phil / PHD)', 'functionalarea_id' => 2, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Architecture (M.Arch)', 'functionalarea_id' => 16, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Executive Master of Business Administration (Executive MBA)', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Planning', 'functionalarea_id' => 16, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Mass Media (BMM)', 'functionalarea_id' => 3, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Physical Education (B.P.Ed)', 'functionalarea_id' => 4, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Education (B.Ed)', 'functionalarea_id' => 4, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Hotel Management (BHM)', 'functionalarea_id' => 7, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Education (M.Ed)', 'functionalarea_id' => 4, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Physical Education (M.P.Ed)', 'functionalarea_id' => 4, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Commerce (M.Com)', 'functionalarea_id' => 5, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Science (M.Sc)', 'functionalarea_id' => 8, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Commerce (B.Com)', 'functionalarea_id' => 5, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Design (B.Des.)', 'functionalarea_id' => 19, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Design (M.Des.)', 'functionalarea_id' => 19, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Science (B.Sc)', 'functionalarea_id' => 8, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Technology (BE/B.Tech)', 'functionalarea_id' => 1, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Technology (ME/M.Tech)', 'functionalarea_id' => 1, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Graduate Diploma in Management (PGDM)', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Engineering', 'functionalarea_id' => 1, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Arts', 'functionalarea_id' => 2, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Media', 'functionalarea_id' => 3, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Graduate Diploma', 'functionalarea_id' => 8, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Education (D.Ed)', 'functionalarea_id' => 4, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master of Architecture (M.Arch)', 'functionalarea_id' => 17, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Pharmacy (D.Pharma)', 'functionalarea_id' => 11, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Computer Application (DCA)', 'functionalarea_id' => 15, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Graduate Diploma in Computer Application (PGDCA)', 'functionalarea_id' => 15, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Medical Laboratory Technology (DMLT)', 'functionalarea_id' => 12, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Paramedical', 'functionalarea_id' => 12, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Graduate Diploma ', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Graduate Diploma ', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Programming', 'functionalarea_id' => 15, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'CLINICAL DOMAIN TRAINING', 'functionalarea_id' => 24, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Graduate Diploma in Pharmacy', 'functionalarea_id' => 11, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Management', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor of Education', 'functionalarea_id' => 25, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Master in Management Studies', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Science', 'functionalarea_id' => 8, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Diploma', 'functionalarea_id' => 8, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Hospitality Studies', 'functionalarea_id' => 7, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Certificate course', 'functionalarea_id' => 7, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Ayurved', 'functionalarea_id' => 22, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Allied Health Science', 'functionalarea_id' => 22, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Physiotherepy', 'functionalarea_id' => 12, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Vetenary Science', 'functionalarea_id' => 13, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Bachelor in Computer ', 'functionalarea_id' => 15, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Aircraft Maintenance Engineering ', 'functionalarea_id' => 18, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Private Pilot License ', 'functionalarea_id' => 18, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Post Graduate Program in Management (PGPM)', 'functionalarea_id' => 6, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma', 'functionalarea_id' => 22, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Diploma in Medical', 'functionalarea_id' => 22, 'created_at' => new DateTime,'updated_at' => new DateTime,),
                array('name' => 'Emergency medical Services (Basic)', 'functionalarea_id' => 22, 'created_at' => new DateTime,'updated_at' => new DateTime,)
        );
        DB::table('degree')->insert( $degree );
    }
}
