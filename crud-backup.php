<?php

php artisan crud:generate WhatWeOffer --fields="title#string; iconImage#string; bannerText#string; bannerImage#string; desctiption#text; status#boolean; slug#string;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate SeoContent --fields="pagetitle#string; description#text; keyword#string; misc#string; slugurl#string; h1title#string; canonical#string; h2title#string; h3title#string; image#string; imagealttext#string; content#string; pageId#integer; userId#integer; collegeId#integer; examId#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate ExaminationType --fields="name#string; status#boolean; slug#string;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ApplicationAndExamStatus --fields="name#string; misc#string; status#boolean; slug#string;" --view-path=examination  --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ApplicationMode --fields="name#string; status#boolean; slug#string;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExaminationMode --fields="name#string; status#boolean; slug#string;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate EligibilityCriteria --fields="name#string; status#boolean; slug#string;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExaminationImportantLinks --fields="title#string; url#text; examinationDetailsId#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamSection --fields="name#string; title#string; iconImage#string; status#boolean; slug#string;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate TypeOfExamination --fields="sortname#string; name#string; status#boolean; slug#string;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExaminationDetails --fields="title#string; description#text; functionalarea_id#integer; courses_id#string; slug#string; applicationFrom#string; applicationTo#string; exminationDate#string; resultAnnounce#string; image#string; imagealttext#string; content#string; getMoreInfoLink#string; userId#integer; status#boolean; totalLikes#integer; totalViews#integer; totalApplicationClick#integer; examEligibilityCriteria#longtext;  examDates#longtext; mockTestDesc#longtext; admidCardDesc#longtext; admidCardInstructions#longtext; examResultDesc#longtext; examAnalysisDesc#longtext;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamApplicationProcess --fields="modeofapplication#integer; modeofpayment#integer; desctiption#longtext; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamApplicationFee --fields="category#string; quota#string; mode#integer; gender#integer; amount#string; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamEligibility --fields="degreeId#integer; degreeName#integer; desctiption#longtext; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamDates --fields="degreeId#integer; degreeName#integer; eventName#text; eventDate#text; eventStatus#string; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamSyllabusPaper --fields="degreeId#integer; degreeName#integer; paperName#string; totalMark#text; desctiption#longtext; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamSyllabusPaperMarks --fields="degreeId#integer; degreeName#integer; unitName#string; topicname#Text; topicDesc#longtext; examSyllabusPaperId#integer; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamPattern --fields="degreeId#integer; degreeName#integer; modeOfExam#integer; examDuration#string; totalQuestion#integer; totalMarks#integer; section#string; markingSchem#text; languageofpaper#string;  typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamAdmitCard --fields="degreeId#integer; degreeName#integer; description#longtext; rebemberPoints#text; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamResult --fields="degreeId#integer; degreeName#integer; description#longtext; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamCutOffs --fields="degreeId#integer; degreeName#integer; description#longtext; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamCounselling --fields="degreeId#integer; degreeName#integer; modeofcounselling#integer; description#longtext;  counsellingProcedure#longtext; documentsRequired#longtext; websiteLink#text; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamCounsellingDates --fields="degreeId#integer; degreeName#integer; modeofcounselling#integer; eventName#string; eventDate#string; examCounsellingId#integer; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamCounsellingContacts --fields="degreeId#integer; degreeName#integer; contactPersonName#string; contactNumber#string; examCounsellingId#integer; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamPreprationTips --fields="degreeId#integer; degreeName#integer; description#longtext; booksName#text; importantTopics#text; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamAnalysisRecords --fields="degreeId#integer; degreeName#integer; description#longtext; papername#text; files#text; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamAnswerKey --fields="degreeId#integer; degreeName#integer; description#longtext; importantDesc#longtext; papername#text; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamAnswerKeyEvent --fields="degreeId#integer; degreeName#integer; paperName#string; dates#string;  files#string; links#string; examAnswerKeyID#integer; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamFaq --fields="question#text; answe#longtext; refLinks#string; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamQuestion --fields="questionDate#datetime; question#text; userId#integer; typeOfExaminations_id#integer; employee_id#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamQuestionAnswer --fields="answerDate#datetime; answer#text; questionId#integer; userId#integer; typeOfExaminations_id#integer; employee_id#integer; likes#integer; share#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id

php artisan crud:generate ExamQuestionAnswerComment --fields="answerDate#datetime; replyanswer#text; answerId#integer; questionId#integer; userId#integer; typeOfExaminations_id#integer; employee_id#integer; likes#integer; share#integer;" --view-path=examination --controller-namespace=examination --route-group=examination --pk=id


php artisan crud:generate CounselingBoards --fields="title#string; status#boolean; slug#string;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardDetails --fields="title#string; description#text; image#string; aboutBoard#longtext; admissionDesc#longtext; boardDesc#longtext; syllabusDesc#longtext; samplePaper#longtext; admitCardDetails#longtext; preprationTips#longtext; resultDesc#longtext; entranceExam#longtext; chooseRightCollege#longtext; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardImpDates --fields="dates#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardLatestUpdates --fields="dates#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardHighlights --fields="title#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardExamDates --fields="class#string; dates#string; subject#string; setting#string;  counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardSamplePapers --fields="class#string; subject#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardSyllabus --fields="class#string; subject#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardAdmissionDates --fields="place#string; dates#string; fees#string; class#string; subjects#string; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerInterests --fields="title#string; description#text; image#string; status#boolean; functionalarea_id#integer; slug#string;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerRelevant  --fields="title#string; description#text; image#string; status#boolean; salery#string; stream#string; mandatorySubject#string; academicDifficulty#string; careerInterest#integer; functionalarea_id#integer; slug#string;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerDetails --fields="title#string; description#text; image#string; jobProfileDesc#longtext; totalLikes#integer; pros#text; cons#text; futureGrowthPurpose#longtext; employeeOpportunities#longtext; studyMaterial#longtext; whereToStudy#text; functionalarea_id#integer; slug#string; careerRelevantId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerSkillRequirement --fields="title#string; careerDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerWhereToStudy --fields="instituteName#string; instituteUrl#string; city#string; programmeFees#string; careerDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerJobRoleSalery --fields="title#string; avgSalery#string; topCompany#text;careerDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCoursesDetails --fields="title#string; description#text; image#string; bestChoiceOfCourse#longtext; jobsCareerOpportunityDesc#longtext; slug#string; educationlevel_id#integer; functionalarea_id#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCoursesEducationLevel --fields="educationlevel_id#integer; functionalarea_id#integer; coursesDetailsId#integer; educationLevelSlug#string;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCoursesJobCareer --fields="courseName#string; jobProfiles#string; avgSalery#string; topCompany#text; coursesDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCoursesMoreTitles --fields="title#string; coursesDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCoursesMoreDetails --fields="title#string; description#text; popularCities#string; specialisations#string; entranceExamsName#string; moreTitlesId#integer; coursesDetailsId#integer; functionalarea_id#integer; degree_id#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

=> career opportinuties
	stream > (science, commerce, arts etc...)
		->career interests types (image, title, desc, status)
			->types of blogs (title, logo,desc, salery,stream, Mandatory Subject, career intest,Academic Difficulty)


php artisan crud:generate CounselingCareerInterests --fields="title#string; description#text; image#string; status#boolean; functionalarea_id#integer; slug#string;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerRelevant  --fields="title#string; description#text; image#string; status#boolean; salery#string; stream#string; mandatorySubject#string; academicDifficulty#string; careerInterest#integer; functionalarea_id#integer; slug#string;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id


=> careers after 12th direct open details page  (career/{slug})
title, description, image, job proffile desc, likes, pros, cons, future growth purpose, employee opportunities,
Books and other Study Material,

#one to many
#skill requirement : title
#where to study :- institute name, logo, link, place Rank of College,Name of College, City, Programme Fees
#job role & salaery : title, avg salery, top company

php artisan crud:generate CounselingCareerDetails --fields="title#string; description#text; image#string; jobProfileDesc#longtext; totalLikes#integer; pros#text; cons#text; futureGrowthPurpose#longtext; employeeOpportunities#longtext; studyMaterial#longtext; whereToStudy#text; functionalarea_id#integer; slug#string; careerRelevantId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerSkillRequirement --fields="title#string; careerDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerWhereToStudy --fields="instituteName#string; instituteUrl#string; city#string; programmeFees#string; careerDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCareerJobRoleSalaery --fields="title#string; avgSalery#string; topCompany#text;careerDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id


//=>Courses after 12th  page details cources/{slug}
//title,images,desc,Making the Best Choice of Course & Career after 12th Science, More Details of Popular Course after 10+2 with PCM (Course name, desc) , Jobs and Career Opportunity desc,

#Jobs and Career Opportunity : course name,Job Profiles and Career Opportunities

php artisan crud:generate CounselingCoursesDetails --fields="title#string; description#text; image#string; bestChoiceOfCourse#longtext; jobsCareerOpportunityDesc; slug#string; educationlevel_id#integer; functionalarea_id#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCoursesJobCareer --fields="courseName#string; jobProfiles#string; avgSalery#string; topCompany#text; coursesDetailsId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingCoursesMoreDetails --fields="title#string; description#text; popularCities#string; specialisations#string; entranceExamsName#string; coursesDetailsId#integer; functionalarea_id#integer; degree_id#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id*/


//=> National Boards (boards/{slug})
//title, image,desc, about board, admission desc, board desc, syllabus desc, samplepaper desc, admit card details, prepration tips, result desc,Entrance exams for College Admissions,Choose the right college after Class XII 

# 1:M
#importnnt dates : dates, title
#latest updates : dates, title
#higlights : name, title
#NIOS Related Dates:  Block for Online Admission,	Dates of Online Admission Stream-1,	Fee
#syllabus : class , subjects
#sample paper : class , subjects
#examination Dates:  class, dates, subject , setting

php artisan crud:generate CounselingBoards --fields="title#string; status#boolean; slug#string;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardDetails --fields="title#string; description#text; image#string; aboutBoard#longtext; admissionDesc#longtext; boardDesc#longtext; syllabusDesc#longtext; samplePaper#longtext; admitCardDetails#longtext; preprationTips#longtext; resultDesc#longtext; entranceExam#longtext; chooseRightCollege#longtext; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardImpDates --fields="dates#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardLatestUpdates --fields="dates#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardHighlights --fields="title#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardExamDates --fields="class#string; dates#string; subject#string; setting#string;  counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardSamplePapers --fields="class#string; subject#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardSyllabus --fields="class#string; subject#string; description#text; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate CounselingBoardAdmissionDates --fields="place#string; dates#string; fees#string; class#string; subjects#string; counselingBoardId#integer;" --view-path=counseling --controller-namespace=counseling --route-group=counseling --pk=id

php artisan crud:generate SliderManager --fields="slidetTitle#string; bottomText#string; sliderImage#string; bottomLink#text; status#boolean; isShowCollegeCount#boolean; isShowExamCount#boolean; isShowCourseCount#boolean; isShowBlogCount#boolean; scrollerFirstText#string; scrollerLastText#string;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate LatestUpdate --fields="name#string; date#string; desc#text; status#boolean; users_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate AskQuestion --fields="question#text; questionDate#datetime; userId#integer; status#boolean; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate AskQuestionAnswer --fields="answer#text; answerDate#datetime; questionId#integer; userId#integer; employee_id#integer; status#boolean; likes#integer; share#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate AskQuestionAnswerComment --fields="replyanswer#text; answerDate#datetime; answerId#integer; questionId#integer; userId#integer; employee_id#integer; status#boolean; likes#integer; share#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate AskQuestionTags --fields="name#string; slug#string;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate CollegeManagementDetails --fields="name#string; designation#string; gender#integer; picture#string; emailaddress#string; phoneno#string; landlineNo#string; about#text; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate CollegeScholarship --fields="title#string; description#text; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate CollegeSocialMediaLinks --fields="title#string; url#text; isActive#boolean; other#string; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate CollegeCutOffs --fields="title#string; description#text; functionalarea_id#integer; degree_id#integer; coursetype_id#integer; course_id#integer; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate CollegeReviews --fields="title#string; description#text; votes#integer; academic#integer; accommodation#integer; faculty#integer; infrastructure#integer; placement#integer; social#integer; guestUserId#integer; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate FacultyExperience --fields="fromyear#integer; toyear#integer; role#string; organisation#string; city#string; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator

php artisan crud:generate FacultyQualification --fields="qualification#string; course#string; sunjects#string; collegename#string; boardName#string; year#integer; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator

php artisan crud:generate CollegeFaqs --fields="question#text; answer#longtext; refLinks#string; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate CollegeSportsActivity --fields="typeOfActivity#text; name#longtext; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate FacultyDepartment --fields="functionalarea_id#integer; educationlevel_id#integer; degree_id#integer; coursetype_id#integer; course_id#integer; faculty_id#integer; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id


php artisan crud:generate CollegeAdmissionProcedure --fields="title#string; description#text; functionalarea_id#integer; educationlevel_id#integer; degree_id#integer; coursetype_id#integer; course_id#integer; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate CollegeAdmissionImportantDated --fields="fromdate#string; todate#string; eventName#text; collegeAdmissionProcedure_id#integer; users_id#integer; collegeprofile_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate ExamCounsellingForm --fields="name#string; email#string; phone#string; city_id#integer; course_id#integer; exam_id#integer; users_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate RequestForCreateCollegeAccount --fields="collegeName#string; email#string; phone#string; contactPersonName#string; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

php artisan crud:generate LandingPageQueryForm --fields="fullname#string; mobilenumber#string; emailaddress#string; subject#string; message#text; users_id#integer; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id



/****************** All updated query *****************************************/
ALTER TABLE `exam_analysis_records` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_answer_keys` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_syllabus_papers` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_answer_key_events` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_prepration_tips` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_counselling_contacts` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_counselling_dates` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_counsellings` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_cut_offs` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_results` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_admit_cards` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_patterns` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_syllabus_paper_marks` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_dates` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `exam_eligibilities` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `exam_analysis_records` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_answer_keys` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_syllabus_papers` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_answer_key_events` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_prepration_tips` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_counselling_contacts` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_counselling_dates` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_counsellings` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_cut_offs` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_results` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_admit_cards` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_patterns` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_syllabus_paper_marks` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_dates` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `exam_eligibilities` CHANGE `degreeName` `degreeName` VARCHAR(255) NULL DEFAULT NULL;

ALTER TABLE `counseling_career_details` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `counseling_career_details` ADD `status` BOOLEAN NULL DEFAULT FALSE AFTER `cons`;

ALTER TABLE `transaction` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL , CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL ;
ALTER TABLE `transaction` ADD `transactionHashKey` VARCHAR(255) NULL DEFAULT NULL AFTER `application_id`;

ALTER TABLE `application` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL; ALTER TABLE `application` ADD `transactionHashKey` VARCHAR(255) NULL DEFAULT NULL AFTER `applicationID`

ALTER TABLE `engineeringexams` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `engineeringexams` ADD `examTransactionHashKey` VARCHAR(255) NULL DEFAULT NULL AFTER `updated_at`;

ALTER TABLE `examtransaction` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `examtransaction` ADD `examTransactionHashKey` VARCHAR(255) NULL DEFAULT NULL AFTER `engineeringexams_id`;

ALTER TABLE `collegeprofile` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `collegeprofile` ADD `registeredSortAddress` TEXT NULL DEFAULT NULL AFTER `isShowOnHome`, ADD `registeredFullAddress` TEXT NULL DEFAULT NULL AFTER `registeredSortAddress`, ADD `campusSortAddress` TEXT NULL DEFAULT NULL AFTER `registeredFullAddress`, ADD `campusFullAddress` TEXT NULL DEFAULT NULL AFTER `campusSortAddress`;
ALTER TABLE `collegeprofile` ADD `registeredAddressCityId` INT NULL DEFAULT NULL AFTER `registeredFullAddress`, ADD `registeredAddressStateId` INT NULL DEFAULT NULL AFTER `registeredAddressCityId`, ADD `registeredAddressCountryId` INT NULL DEFAULT NULL AFTER `registeredAddressStateId`;

ALTER TABLE `collegeprofile` ADD `campusAddressCityId` INT NULL DEFAULT NULL AFTER `campusFullAddress`, ADD `campusAddressStateId` INT NULL DEFAULT NULL AFTER `campusAddressCityId`, ADD `campusAddressCountryId` INT NULL DEFAULT NULL AFTER `campusAddressStateId`;

ALTER TABLE `city` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `city` ADD `totalCollegeRegAddress` INT NULL DEFAULT NULL AFTER `isShowOnHome`, ADD `totalCollegeByCampusAddress` INT NULL DEFAULT NULL AFTER `totalCollegeRegAddress`;

ALTER TABLE `state` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `state` ADD `totalCollegeRegAddress` INT NULL DEFAULT NULL AFTER `isShowOnHome`, ADD `totalCollegeByCampusAddress` INT NULL DEFAULT NULL AFTER `totalCollegeRegAddress`;

ALTER TABLE `country` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `country` ADD `totalCollegeRegAddress` INT NULL DEFAULT NULL AFTER `isShowOnHome`, ADD `totalCollegeByCampusAddress` INT NULL DEFAULT NULL AFTER `totalCollegeRegAddress`;

ALTER TABLE `city` CHANGE `totalCollegeByCampusAddress` `totalCollegeByCampusAddress` INT(11) NULL DEFAULT '0';
ALTER TABLE `state` CHANGE `totalCollegeByCampusAddress` `totalCollegeByCampusAddress` INT(11) NULL DEFAULT '0';
ALTER TABLE `country` CHANGE `totalCollegeByCampusAddress` `totalCollegeByCampusAddress` INT(11) NULL DEFAULT '0';
ALTER TABLE `city` CHANGE `totalCollegeRegAddress` `totalCollegeRegAddress` INT(11) NULL DEFAULT '0';
ALTER TABLE `state` CHANGE `totalCollegeRegAddress` `totalCollegeRegAddress` INT(11) NULL DEFAULT '0';
ALTER TABLE `country` CHANGE `totalCollegeRegAddress` `totalCollegeRegAddress` INT(11) NULL DEFAULT '0';

ALTER TABLE `seo_contents` ADD `newsId` INT NULL DEFAULT NULL AFTER `cityId`;
ALTER TABLE `seo_contents` ADD `newsTagId` INT NULL DEFAULT NULL AFTER `newsId`;
ALTER TABLE `seo_contents` ADD `newsTypeId` INT NULL DEFAULT NULL AFTER `newsTagId`;
ALTER TABLE `seo_contents` ADD `askQuestionId` INT NULL DEFAULT NULL AFTER `newsTypeId`;
ALTER TABLE `seo_contents` ADD `askTagId` INT NULL DEFAULT NULL AFTER `askQuestionId`;

ALTER TABLE `subscribe` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `subscribe` ADD `name` VARCHAR(255) NULL DEFAULT NULL AFTER `email`;

ALTER TABLE `faculty_departments` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `faculty_departments` ADD `collegemaster_id` INT NOT NULL AFTER `id`;


ALTER TABLE `functionalarea` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE `course` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `educationlevel` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `degree` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;


ALTER TABLE `address` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE users ADD FULLTEXT (`firstname`);
ALTER TABLE functionalarea ADD FULLTEXT (`name`);
ALTER TABLE degree ADD FULLTEXT (`name`);
ALTER TABLE course ADD FULLTEXT (`name`);
ALTER TABLE educationlevel ADD FULLTEXT (`name`);
ALTER TABLE country ADD FULLTEXT (`name`);
ALTER TABLE state ADD FULLTEXT (`name`);
ALTER TABLE city ADD FULLTEXT (`name`);
ALTER TABLE address ADD FULLTEXT (`name`);
ALTER TABLE address ADD FULLTEXT (`address1`);
ALTER TABLE address ADD FULLTEXT (`address2`);
ALTER TABLE address ADD FULLTEXT (`landmark`);

/**************************************************************************************************/

INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'AdsManagement', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'AskQuestion', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'AskQuestionAnswer', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'AskQuestionAnswerComment', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'AskQuestionTag', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ApplicationAndExamStatus', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ApplicationMode', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ExaminationMode', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ExaminationType', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'EligibilityCriterion', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CollegeAdmissionProcedure', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CollegeCutOff', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CollegeFaq', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CollegeManagementDetail', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CollegeReview', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CollegeScholarship', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CollegeSportsActivity', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'Contentcategory', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'Content', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'News', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'NewsTag', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'NewsType', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'SliderManager', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'LatestUpdate', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'WhatWeOffer', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'Template', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'SeoContent', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ExamSection', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'TypeOfExamination', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ExamCounsellingForm', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CounselingBoard', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CounselingCareerDetail', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CounselingCoursesDetail', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CounselingCareerInterest', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'CounselingCareerRelevant', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'RequestForCreateCollegeAccount', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'LandingPageQueryForm', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ExamQuestion', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ExamQuestionAnswer', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);
INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'ExamQuestionAnswerComment', '', '2020-10-01 03:12:32', '2020-10-01 03:12:32', NULL);



////////////////////////////////
ALTER TABLE `ads_managements` ADD `ads_position` VARCHAR(255) NULL DEFAULT 'default' AFTER `end`
UPDATE `ads_managements` SET `title` = 'Home Page' WHERE `ads_managements`.`slug` = 1;
UPDATE `ads_managements` SET `title` = 'Search Page' WHERE `ads_managements`.`slug` = 2;
UPDATE `ads_managements` SET `title` = 'College Detail Page' WHERE `ads_managements`.`slug` = 3;

INSERT INTO `alltableinformations` (`id`, `name`, `description`, `created_at`, `updated_at`, `employee_id`) VALUES (NULL, 'AdsTopCollegeList', '', '2024-02-13 03:12:32', '2024-02-13 03:12:32', NULL);

php artisan crud:generate AdsTopCollegeList --fields="collegeprofile_id#string; functionalarea_id#integer; degree_id#integer; course_id#integer; educationlevel_id#integer; city_id#integer; state_id#integer; country_id#integer; university_id#integer; status#boolean; employee_id#integer;" --view-path=administrator --controller-namespace=administrator --route-group=administrator --pk=id

ALTER TABLE `ads_top_college_lists` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;