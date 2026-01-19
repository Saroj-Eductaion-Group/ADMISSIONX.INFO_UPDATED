<?php

use Illuminate\Database\Seeder;

class EntranceexamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   	public function run()
    {
        DB::table('entranceexam')->delete();
        $entranceexam = array(
                array(
                    'name'      => 'IIT JEE – Joint Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'name'      => 'NEET – National Eligibility Cum Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'VITEEE – Vellore Institute of Technology Engineering Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'SSC– Staff Selection Commission',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CLAT– Common Law Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'SRMJEEE – SRM Joint Engineering Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'HPCET – Himachal Pradesh Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'GCET – Goa Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'KEAM – Kerala Engineering, Agricultural and Medical Admission Exam',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'TNEA – Tamil Nadu Engineering Admissions',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'BITSAT – Birla Institute of Technology and Science Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'OJEE – Odisha Joint Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'ACEE – Assam CEE – Assam Combined Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'UPCET – Uttar Pradesh Combined Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'MHT CET – Maharashtra Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'BCECE – Bihar Combined Entrance Competitive Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CG PET – Chhattisgarh Pre-Engineering Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'WBJEE – West Bengal Joint Entrance Exam',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'KCET – Karnataka Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CUET – Common University Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CUET (PG) – Central University Entrance Test – Postgraduate',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'NEET PG – National Eligibility cum Entrance Test for Post Graduate',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AP EAMCET – Andhra Pradesh Engineering, Agricultural, and Medical Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'TS EAMCET – Telangana State Engineering, Agriculture and Medical Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'JEECUP – Joint Entrance Examination Council, Uttar Pradesh',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'COMEDK UGET – Consortium of Medical, Engineering and Dental College of Karnataka',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'PTU Exam – Punjab Technical University Combined Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CMC Vellore – Christian Medical College Vellore',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AP POLYCET – Andhra Pradesh Polytechnic Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'GPAT – Graduate Pharmacy Aptitude Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'JIPMER – Jawaharlal Institute of Postgraduate Medical Education & Research',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'NATA – National Aptitude Test in Architecture',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'JEXPO – Joint Entrance Examination for Polytechnics',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'TS POLYCET – Telangana State Polytechnic Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AFMC – Armed Forces Medical College',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'INI CET – Institute of National Importance Combined Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'JKCET – Jammu and Kashmir Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'UCEED – Undergraduate Common Entrance Examination for Design',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'FMGE – Foreign Medical Graduate Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'DUET – Delhi University Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'TS PGECET – Telangana State Post Graduate Engineering Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'IPU CET – Indraprastha University Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AP PGECET – Andhra Pradesh Post Graduate Engineering Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'UPCATET – Uttar Pradesh Combined Agriculture and Technology Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'KIITEE – Kalinga Institute of Industrial Technology Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'GUJCET – Gujarat Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'NERIST NEE – NERIST Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'TS ECET – Telangana Engineering Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'HP PAT – Himachal Pradesh Polytechnic Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'UPSEE – Uttar Pradesh State Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CPET – Chhattisgarh Pre-Engineering Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'APJEE – Arunachal Pradesh Joint Entrance Exam',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'VOCLET – West Bengal State Council of Vocational Education & Training',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'Assam PAT – Assam Polytechnic Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AP ECET – Andhra Pradesh Engineering Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'BVP CET – Bharati Vidyapeeth Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'IAT – IISER Aptitude Test – Indian Institutes of Science Education and Research Aptitude Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'BVAT – Banasthali Vidyapith Aptitude Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AMET Entrance Exam – Academy of Maritime Education and Training Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'MZUEEE – Mizoram University Engineering Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'SLIET SET – Sant Longowal Institute of Engineering and Technology Entrance Exam',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'OUAT – Orissa University of Agriculture and Technology',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'NEST – National Entrance Screening Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'HITSEEE – Hindustan Institute of Technology and Science Engineering Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'GLAET – GLA University Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CUSAT CAT – Cochin University of Science and Technology Common Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'JET – Jain Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'SET – Symbiosis Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'MP PPT – Madhya Pradesh Pre-Polytechnic Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AMUEEE – Aligarh Muslim University Engineering Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'PESSAT – PES Scholastic Aptitude Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CIEAT – Crescent Institute of Engineering Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'GEEE – Galgotias Engineering Entrance Exam',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'Uni-Gauge-E – Uni Gauge E Entrance Exam',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AIMS CET – Amrita Institute of Medical Sciences Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AIPVT – All India Pre Veterinary Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AME CET – Aircraft Maintenance Engineering Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'Amity JEE – Amity Joint Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AMU CAT – Aligarh Muslim University Common Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'ASSO CET – Association of Management of Unaided Private Medical and Dental Colleges of Maharashtra (AMUPMDC) Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AUEET – Alliance University Engineering Entrance Test or Alliance AUEET',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'AUSAT – Alliance University Scholastic Aptitude Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'BEEE – Bharath Engineering Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CEED – Common Entrance Exam for Design',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CG PPT – Chhattisgarh Pre Polytechnic Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CUET – Christ University Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CMC Ludhiana – Christian Medical College & Hospital Ludhiana',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'CUEE – Centurion University Entrance Examination',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'Delhi CET – Delhi Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'DUMET – Delhi University Medical-Dental Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'GGSIPU CET – Guru Gobind Singh Indraprastha University Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'GITAM GAT – GITAM Admission Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'Gujarat PGCET – Gujarat Post Graduate Common Entrance Test',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),array(
                    'name'      => 'Haryana LEET – Haryana Lateral Entry Entrance Test for Engineering',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                     
        );

        DB::table('entranceexam')->insert( $entranceexam );
    }
}
