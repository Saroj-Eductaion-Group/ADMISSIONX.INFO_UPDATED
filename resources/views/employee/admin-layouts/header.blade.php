<nav class="navbar-default navbar-static-side custom-sidebar-menu" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="top-menuli">&nbsp;</li>
                <li class="nav-header custom-header">
                    <div class="dropdown profile-element"> <span>
                            <a href="{{ URL::to('/employee/dashboard') }}">{!! HTML::image("assets/administrator/images/logo.jpg", "Logo", array( 'width' => 150 )) !!}</a>
                             </span>                    
                    </div>
                    <div class="logo-element">
                        {!! HTML::image("assets/images/favicon.png", "Logo", array( 'class' => 'img-size-small', 'width' => 55 )) !!}
                    </div>
                </li>
                <!-- Menu items -->
                <li>
                    <a href="{{ URL::to('/employee/dashboard') }}"><i class="fa fa-home"></i><span class="nav-label">Home</span> </a>
                </li>
                
                @if(Auth::check())
                <!-- AUTH WITH ROLE PLUS PERMISSIONS -->
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/  
                        $validateUrl = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->get(); 

                        $totalSumAdsLi = $totalSumFirstLi = $totalSumSecondLi = $totalSumThirdLi = $totalSumFourthLi = $totalSumFifthLi = $totalSumSixthLi = $totalSumSeventhLi = $totalSumEighthLi = $totalSumNinthLi = $totalSumTenthLi = $totalSumEleventhLi = $totalSumTwelfthLi = $totalSumThirteenthLi = $totalSumFourteenthLi = $totalSumFifteenthLi = $totalSumSixteenthLi = $totalSumSeventeenthLi = $totalSumEighteenthLi = $totalSumNineteenthLi = $totalSumTwentiethLi = $totalSumTwentyOneLi = $totalSumTwentyTwoLi = $totalSumTwentyThreeLi = $totalSumTwentyFourLi = $totalSumTwentyFiveLi = $totalSumTwentySixLi = $totalSumCollegeAdsLi = $totalSumTransactionAnalyticsLi = $totalSumWebsiteMetricsLi = $totalSumAieaExamLi = 0;
          

                        foreach($validateUrl as $key => $item):
                            if($item->name == "User" || $item->name == "UserRole" || $item->name == "UserStatus" || $item->name == "UserPrivilege" || $item->name == "UserGroup"):
                                $totalSumFirstLi = 1;
                            endif;

                            if($item->name == "StudentProfile" || $item->name == "StudentMark" || $item->name == "Bookmark"):
                                $totalSumSecondLi = 1;
                            endif;

                            if($item->name == "CollegeProfile" || $item->name == "CollegeMaster" || $item->name == "Event" || $item->name == "CollegeFacility" || $item->name == "Faculty" || $item->name == "Placement" || $item->name == "CollegeManagementDetail" || $item->name == "CollegeScholarship" || $item->name == "CollegeCutOff" || $item->name == "CollegeSportsActivity" || $item->name == "CollegeAdmissionProcedure" || $item->name == "CollegeReview" || $item->name == "CollegeFaq"):
                                $totalSumThirdLi = 1;
                            endif;

                            if($item->name == "Document" || $item->name == "Gallery"):
                                $totalSumFourthLi = 1;
                            endif;

                            if($item->name == "Application" || $item->name == "Transaction" || $item->name == "ApplicationStatusMessages"):
                                $totalSumFifthLi = 1;
                            endif;

                            if($item->name == "AddressType" || $item->name == "Address" || $item->name == "City" || $item->name == "State" || $item->name == "Country"):
                                $totalSumSixthLi = 1;
                            endif;

                            if($item->name == "Blog"):
                                $totalSumSeventhLi = 1;
                            endif;

                            if($item->name == "Query"):
                                $totalSumEighthLi = 1;
                            endif;

                            if($item->name == "Subscribe"):
                                $totalSumNinthLi = 1;
                            endif;

                            if($item->name == "Page"):
                                $totalSumTenthLi = 1;
                            endif;

                            if($item->name == "Testimonial"):
                                $totalSumEleventhLi = 1;
                            endif;

                            if($item->name == "Log" || $item->name == "ApplicationStatus" || $item->name == "CardType" || $item->name == "Category" || $item->name == "CollegeType" || $item->name == "EducationLevel" || $item->name == "FunctionalArea" || $item->name == "Degree" || $item->name == "CourseType" || $item->name == "Course" || $item->name == "Facility" || $item->name == "Invite" || $item->name == "PaymentStatus" || $item->name == "University" || $item->name == "EntranceExam" || $item->name == "Career" || $item->name == "SocialManagement"):
                                $totalSumTwelfthLi = 1;
                            endif;

                            if($item->name == "AdsManagement"):
                                $totalSumAdsLi = 1;
                            endif;

                            if($item->name == "RequestForCreateCollegeAccount"):
                                $totalSumThirteenthLi = 1;
                            endif;

                            if($item->name == "SliderManager" || $item->name == "LatestUpdate" || $item->name == "WhatWeOffer"):
                                $totalSumFourteenthLi = 1;
                            endif;

                            if($item->name == "News" || $item->name == "NewsTag" || $item->name == "NewsType"):
                                $totalSumFifteenthLi = 1;
                            endif;

                            if($item->name == "SeoContent"):
                                $totalSumSixteenthLi = 1;
                            endif;
    
                            if($item->name == "Contentcategory" || $item->name == "Content"):
                                $totalSumSeventeenthLi = 1;
                            endif;

                            if($item->name == "ApplicationAndExamStatus" || $item->name == "ApplicationMode" || $item->name == "ExaminationMode" || $item->name == "ExaminationType" || $item->name == "EligibilityCriterion"):
                                $totalSumEighteenthLi = 1;
                            endif;

                            if($item->name == "ExamSection" || $item->name == "TypeOfExamination" || $item->name == "ExamQuestion" || $item->name == "ExamQuestionAnswer" || $item->name == "ExamQuestionAnswerComment"):
                                $totalSumNineteenthLi = 1;
                            endif;

                            if($item->name == "ExamCounsellingForm"):
                                $totalSumTwentiethLi = 1;
                            endif;

                            if($item->name == "CounselingBoard"):
                                $totalSumTwentyOneLi = 1;
                            endif;

                            if($item->name == "CounselingCareerDetail"):
                                $totalSumTwentyTwoLi = 1;
                            endif;

                            if($item->name == "CounselingCoursesDetail"):
                                $totalSumTwentyThreeLi = 1;
                            endif;

                            if($item->name == "CounselingCareerInterest" || $item->name == "CounselingCareerRelevant"):
                                $totalSumTwentyFourLi = 1;
                            endif;

                            if($item->name == "AskQuestionTag" || $item->name == "AskQuestion" || $item->name == "AskQuestionAnswer" || $item->name == "AskQuestionAnswerComment"):
                                $totalSumTwentyFiveLi = 1;
                            endif;

                            if($item->name == "LandingPageQueryForm"):
                                $totalSumTwentySixLi = 1;
                            endif;

                            if($item->name == "AdsTopCollegeList"):
                                $totalSumCollegeAdsLi = 1;
                            endif;

                            if($item->name == "TransactionAnalytics"):
                                $totalSumTransactionAnalyticsLi = 1;
                            endif;

                            if($item->name == "WebsiteMetrics"):
                                $totalSumWebsiteMetricsLi = 1;
                            endif;

                            if($item->name == "AIEA_Exam"):
                                $totalSumAieaExamLi = 1;
                            endif;

                        endforeach;       
                /*--}}

                    @if(sizeof($validateUrl) >= 1 && $totalSumAdsLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "AdsManagement")
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-adn"></i><span class="nav-label">ADS Management<span class="label label-danger pull-right">New</span></a>
                                <ul class="nav nav-third-level">
                                    @if( $item->create == '1' )
                                        <li><a href="{{ URL::to('employee/ads-management/create') }}">Create ADS Management</a></li>    
                                    @endif
                                    @if( $item->index == '1' )
                                        <li><a href="{{ URL::to('employee/ads-management') }}">ADS Management List</a></li>      
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumCollegeAdsLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "AdsTopCollegeList")
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-adn"></i><span class="nav-label">Ads Colleges List<span class="label label-warning pull-right">New</span></a>
                                <ul class="nav nav-third-level">
                                    @if( $item->create == '1' )
                                        <li><a href="{{ URL::to('/employee/ads-top-college-list/create') }}">Create Top Ads Colleges</a></li>    
                                    @endif
                                    @if( $item->index == '1' )
                                        <li><a href="{{ URL::to('/employee/ads-top-college-list') }}">Ads College List</a></li>      
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    @endif
                    
                    @if(sizeof($validateUrl) >= 1 && $totalSumTransactionAnalyticsLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "TransactionAnalytics")
                                @if( $item->index == '1' )
                                <li>
                                    <a href="{{ URL::to('/employee/transaction-analytics') }}"><i class="fa fa-money"></i><span class="nav-label">Transaction Analytics</span> <span class="label label-info pull-right">Updated</span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumWebsiteMetricsLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "WebsiteMetrics")
                                @if( $item->index == '1' )
                                <li>
                                    <a href="{{ URL::to('/employee/website-analytics') }}"><i class="fa fa-desktop"></i><span class="nav-label">Website Metrics</span> <span class="label label-info pull-right">Current</span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                 
                    @if(sizeof($validateUrl) >= 1 && $totalSumFirstLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Members</span><span class="fa arrow"></span></a>
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "User" || $item->name == "UserRole" || $item->name == "UserStatus" || $item->name == "UserPrivilege" || $item->name == "UserGroup")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "User")
                                        <li>
                                            <a href="#">Users<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/users/create') }}">Create User</a></li>
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/users') }}">Users List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                    
                                    @if($item->name == "UserRole")
                                        <li>
                                            <a href="#">User Roles<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/userrole/create') }}">Create User Role</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/userrole') }}">User Roles List</a></li>   
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if($item->name == "UserStatus")
                                        <li>
                                            <a href="#">User Status<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/userstatus/create') }}">Create User Status</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/userstatus') }}">User Status List</a></li>  
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if( $item->name == "UserPrivilege" )
                                        <li>
                                            <a href="#">User Privilege<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/userprivilege/create') }}">Create User Privilege</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/userprivilege') }}">User Privilege List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if($item->name == "UserGroup")
                                        <li>
                                            <a href="#">User Group<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/usergroup/create') }}">Create User Group</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/usergroup') }}">User Group List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumSecondLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Student Profiles</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "StudentProfile" || $item->name == "StudentMark" || $item->name == "Bookmark")
                                    <ul class="nav nav-second-level collapse">
                                    @if($item->name == "StudentProfile")
                                        <li>
                                            <a href="#">Profile Information<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/studentprofile') }}">Profile Information List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    <!-- @if($item->name == "StudentMark")
                                        <li>
                                            <a href="#">Academic Marks<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/studentmarks') }}">Academic Marks List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif -->

                                    @if($item->name == "Bookmark")
                                        <li>
                                            <a href="#">Bookmark<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/bookmarks') }}">Bookmark List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumThirdLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-university"></i> <span class="nav-label">College Profiles</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "CollegeProfile" || $item->name == "CollegeMaster" || $item->name == "Event" || $item->name == "CollegeFacility" || $item->name == "Faculty" || $item->name == "Placement" || $item->name == "CollegeManagementDetail" || $item->name == "CollegeScholarship" || $item->name == "CollegeCutOff" || $item->name == "CollegeSportsActivity" || $item->name == "CollegeAdmissionProcedure" || $item->name == "CollegeReview" || $item->name == "CollegeFaq")
                                    <ul class="nav nav-second-level collapse">
                                    @if($item->name == "CollegeProfile")
                                        <li>
                                            <a href="#">Profile Information<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/collegeprofile') }}">Profile Information List</a></li>
                                                    <li><a href="{{ URL::to('employee/collegeprofile-info/contact-card') }}">College Contact Card</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if($item->name == "CollegeMaster")
                                        <li>
                                            <a href="#">College Course<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/collegemaster/create') }}">Create College Course</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/collegemaster') }}">College Course List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if($item->name == "Event")
                                        <li>
                                            <a href="#">College Events<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/event/create') }}">Create College Events</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/event') }}">College Events List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                    
                                    @if($item->name == "CollegeFacility")
                                        <li>
                                            <a href="#">College Facilities<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/collegefacilities/create') }}">Create College Facilities</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/collegefacilities') }}">College Facilities List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if($item->name == "Faculty")
                                        <li>
                                            <a href="#">Faculty<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                   <!--  <li><a href="{{ URL::to('employee/faculty/create') }}">Create Faculty</a></li> -->                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/faculty') }}">Faculty List</a></li>    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if($item->name == "Placement")
                                    <li>
                                        <a href="#">Placement<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/placement/create') }}">Create Placement</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/placement') }}">Placement List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif

                                    @if($item->name == "CollegeManagementDetail")
                                    <li>
                                        <a href="#">College Management Information<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/college-management-details/create') }}">Create College Management Information</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/college-management-details') }}">College Management Information List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif

                                    @if($item->name == "CollegeScholarship")
                                    <li>
                                        <a href="#">College Scholarship<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/college-scholarship/create') }}">Create College Scholarship</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/college-scholarship') }}">College Scholarship List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif

                                    @if($item->name == "CollegeCutOff")
                                    <li>
                                        <a href="#">College Cut Offs<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/college-cut-offs/create') }}">Create College Cut Offs</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/college-cut-offs') }}">College Cut Offs List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif

                                    @if($item->name == "CollegeSportsActivity")
                                    <li>
                                        <a href="#">College Sports & Activity<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/college-sports-activity/create') }}">Create College Sports & Activity</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/college-sports-activity') }}">College Sports & Activity List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif

                                    @if($item->name == "CollegeAdmissionProcedure")
                                    <li>
                                        <a href="#">College Admission Procedure<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/college-admission-procedure/create') }}">Create College Admission Procedure</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/college-admission-procedure') }}">College Admission Procedure List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif

                                    @if($item->name == "CollegeReview")
                                    <li>
                                        <a href="#">College Reviews<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/college-reviews/create') }}">Create College Reviews</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/college-reviews') }}">College Reviews List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif

                                    @if($item->name == "CollegeFaq")
                                    <li>
                                        <a href="#">College Faqs<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            @if( $item->create == '1' )
                                                <li><a href="{{ URL::to('employee/college-faqs/create') }}">Create College Faqs</a></li>                                  
                                            @endif
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/college-faqs') }}">College Faqs List</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumThirteenthLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "RequestForCreateCollegeAccount")
                                @if( $item->index == '1' )
                                    <li>
                                        <a href="{{ URL::to('/employee/request/create-college-account') }}"><i class="fa fa-list-alt"></i><span class="nav-label">Request to make college profile </span> <span class="blinking label label-danger pull-right">New</span></a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumFourthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Media Information</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "Document" || $item->name == "Gallery")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "Document")
                                        <li>
                                            <a href="#">Documents<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/documents/create') }}">Create Documents</a></li>                   
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/documents') }}">Documents List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif

                                    @if($item->name == "Gallery")
                                        <li>
                                            <a href="#">Gallery &amp; Photos<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/galleries/create') }}">Create Gallery &amp; Photos</a></li>  
                                                    <li><a href="{{ URL::to('/employee/youtube') }}">Youtube Link</a></li>
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/galleries') }}">Gallery &amp; Photos List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumFifthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Application &amp; Payment</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "Application" || $item->name == "Transaction" || $item->name == "ApplicationStatusMessages")
                                    <ul class="nav nav-second-level collapse">
                                        @if($item->name == "Application")
                                            <li>
                                                <a href="#">Application<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/application') }}">Application List</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif

                                        @if($item->name == "ApplicationStatusMessages")
                                            <li>
                                                <a href="#">Application Remarks<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/applicationstatusmessage') }}">Application Remarks </a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif

                                        @if($item->name == "Transaction")
                                            <li>
                                                <a href="#">Transaction<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/transaction') }}">Transaction List</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumSixthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-location-arrow"></i> <span class="nav-label">Address Information</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "AddressType" || $item->name == "Address" || $item->name == "City" || $item->name == "State" || $item->name == "Country")
                                    <ul class="nav nav-second-level collapse">
                                        @if($item->name == "AddressType")
                                            <li>
                                                <a href="#">Address Type<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->create == '1' )
                                                        <li><a href="{{ URL::to('employee/addresstype/create') }}">Create Address Type</a></li>                                  
                                                    @endif
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/addresstype') }}">Address Type List</a></li>                                    
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif

                                        @if($item->name == "Address")
                                            <li>
                                                <a href="#">Address<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/address') }}">Address List</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                        
                                        @if($item->name == "City")
                                            <li>
                                                <a href="#">City<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->create == '1' )
                                                        <li><a href="{{ URL::to('employee/city/create') }}">Create City</a></li>
                                                    @endif
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/city') }}">City List</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                            
                                        @if($item->name == "State")
                                            <li>
                                                <a href="#">State<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->create == '1' )
                                                        <li><a href="{{ URL::to('employee/state/create') }}">Create State</a></li>
                                                    @endif
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/state') }}">State List</a></li>  
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif

                                        @if($item->name == "Country")
                                            <li>
                                                <a href="#">Country<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    @if( $item->create == '1' )
                                                        <li><a href="{{ URL::to('employee/country/create') }}">Create Country</a></li>@endif
                                                    @if( $item->index == '1' )
                                                        <li><a href="{{ URL::to('employee/country') }}">Country List</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumSeventhLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "Blog")
                            <li>
                                <a href="#">Blogs<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    @if( $item->create == '1' )
                                        <li><a href="{{ URL::to('employee/blogs/create') }}">Create Blogs</a></li>
                                    @endif
                                    @if( $item->index == '1' )
                                        <li><a href="{{ URL::to('employee/blogs') }}">Blogs List</a></li>            
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumEighthLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "Query")
                            <li>
                                <a href="#">Query<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    @if( $item->index == '1' )
                                        <li><a href="{{ URL::to('employee/query') }}">Query List</a></li>
                                        <li>
                                            <a href="{{ URL::to('/employee/query-college-student') }}"><i class="fa fa-question-circle"></i><span class="nav-label">Query Between College &amp; Student</span> </a>
                                        </li>
                                        {{--*/    
                                            $getQueryCollegeDataObj = DB::table('query')
                                                                    ->leftJoin('users', 'query.admin_id', '=', 'users.id')
                                                                    ->where('query.admin_id', '!=', '0')
                                                                    ->whereRaw('query.replytoid is NULL')
                                                                    ->where('users.userrole_id','=','1')
                                                                    ->count()
                                                                    ;
                                            if( empty($getQueryCollegeDataObj) ){
                                                $getQueryCollegeDataObj = '';
                                            }

                                        /*--}}
                                        <li>
                                            <a href="{{ URL::to('/employee/query-bya') }}"><i class="fa fa-question"></i><span class="nav-label">Query To Admission X</span>
                                            @if($getQueryCollegeDataObj) 
                                                <span class="label label-info pull-right">
                                                    {{ $getQueryCollegeDataObj }}
                                                </span>
                                            @endif 
                                            </a>
                                        </li>                                    
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumNinthLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "Subscribe")
                            <li>
                                <a href="#">Subscribe<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    @if( $item->create == '1' )
                                        <li><a href="{{ URL::to('employee/subscribe/create') }}">Create Subscribe</a></li>    
                                    @endif
                                    @if( $item->index == '1' )
                                        <li><a href="{{ URL::to('employee/subscribe') }}">Subscribe List</a></li>      
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTenthLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "Page")
                            <!-- <li>
                                <a href="#">Page<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    @if( $item->create == '1' )
                                        <li><a href="{{ URL::to('employee/pages/create') }}">Create Page</a></li> 
                                    @endif
                                    @if( $item->index == '1' )
                                        <li><a href="{{ URL::to('employee/pages') }}">Page List</a></li>
                                    @endif
                                </ul>
                            </li> -->
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumEleventhLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "Testimonial")
                            <li>
                                <a href="#">Testimonial<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    @if( $item->create == '1' )
                                        <li><a href="{{ URL::to('employee/testimonial/create') }}">Create Testimonial</a></li>
                                    @endif
                                    @if( $item->index == '1' )
                                        <li><a href="{{ URL::to('employee/testimonial') }}">Testimonial List</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    @endif
                @endif

                @if(sizeof($validateUrl) >= 1 && $totalSumAieaExamLi > 0)
                    @foreach($validateUrl as $key => $item)
                        @if($item->name == "AIEA_Exam")
                            @if( $item->index == '1' )
                            <li>
                                <a href="{{ URL::to('/employee/all-india-engineer-association') }}"><i class="fa fa-list-alt"></i><span class="nav-label">AIEA Exam</span> </a>
                            </li>
                            @endif
                        @endif
                    @endforeach
                @endif

                @if(Auth::check())
                    @if(sizeof($validateUrl) >= 1 && $totalSumTwelfthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-info"></i> <span class="nav-label">Other Information</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "Log" || $item->name == "ApplicationStatus" || $item->name == "CardType" || $item->name == "Category" || $item->name == "CollegeType" || $item->name == "EducationLevel" || $item->name == "FunctionalArea" || $item->name == "Degree" || $item->name == "CourseType" || $item->name == "Course" || $item->name == "Facility" || $item->name == "Invite" || $item->name == "PaymentStatus" || $item->name == "University" || $item->name == "EntranceExam" || $item->name == "Career" || $item->name == "SocialManagement")
                                    <ul class="nav nav-second-level collapse">
                                        @if($item->name == "Log")
                                        <li>
                                            <a href="#">Logs<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if($item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/logs/create') }}">Create Logs</a></li> 
                                                @endif
                                                @if($item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/logs') }}">Logs List</a></li> 
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "ApplicationStatus")
                                        <li>
                                            <a href="#">Application Status<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/applicationstatus/create') }}">Create Application Status</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/applicationstatus') }}">Application Status List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "CardType")
                                        <li>
                                            <a href="#">Card Type<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/cardtype/create') }}">Create Card Type</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/cardtype') }}">Card Type List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "Category")
                                        <li>
                                            <a href="#">Category<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/category/create') }}">Create Category</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/category') }}">Category List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "CollegeType")
                                        <li>
                                            <a href="#">College Type<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/collegetype/create') }}">Create College Type</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/collegetype') }}">College Type List</a></li> 
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "EducationLevel")
                                        <li>
                                            <a href="#">Education Levels<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/educationlevel/create') }}">Create Education Levels</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/educationlevel') }}">Education Levels List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                        @endif
                                   
                                        @if($item->name == "FunctionalArea")
                                        <li>
                                            <a href="#">Streams<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/functionalarea/create') }}">Create Stream</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/functionalarea') }}">Stream List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif
                                        
                                        @if($item->name == "Degree")
                                        <li>
                                            <a href="#">Degree<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/degree/create') }}">Create Degree</a></li>
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/degree') }}">Degree List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif
                                        
                                        @if($item->name == "CourseType")
                                        <li>
                                            <a href="#">Course Type<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/coursetype/create') }}">Create Course Type</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/coursetype') }}">Course Type List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "Course")
                                        <li>
                                            <a href="#">Course<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/course/create') }}">Create Course</a></li>
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/course') }}">Course List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif                        
                                        
                                        @if($item->name == "Facility")
                                        <li>
                                            <a href="#">Facilities<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/facilities/create') }}">Create Facilities</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/facilities') }}">Facilities List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "Invite")
                                        <li>
                                            <a href="#">Invite<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/invite/create') }}">Create Invite</a></li>
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/invite') }}">Invite List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                        @if($item->name == "PaymentStatus")
                                        <li>
                                            <a href="#">Payment Status<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/paymentstatus/create') }}">Create Payment Status</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/paymentstatus') }}">Payment Status List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                       
                                       @if($item->name == "University")
                                        <li>
                                            <a href="#">Universities<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/university/create') }}">Create University</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/university') }}">Universities List</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endif

                                         
                                       
                                        @if($item->name == "Entranceexam")
                                        <li>
                                            <a href="#">Entrance Exam<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/entranceexam/create') }}">Create Entrance Exam</a></li>                                  
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/entranceexam') }}">Entrance Exam List</a></li>                                    
                                                @endif
                                            </ul>
                                        </li>
                                        @endif 

                                        @if($item->name == "Career")
                                        <li>
                                            <a href="#">Career<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/career/create') }}">Create Career</a></li>
                                                @endif
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/career') }}">Career List</a></li>       
                                                @endif
                                            </ul>
                                        </li>
                                        @endif 

                                        @if($item->name == "SocialManagement")
                                        <li>
                                            <a href="#">Social Management<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <!-- @if( $item->create == '1' )
                                                    <li><a href="{{ URL::to('employee/socialmanagement/create') }}">Create Social Media</a></li>                                
                                                @endif -->
                                                @if( $item->index == '1' )
                                                    <li><a href="{{ URL::to('employee/socialmanagement') }}">Social Media List</a></li>                          
                                                @endif
                                            </ul>
                                        </li>
                                        @endif 

                                        <!-- @if($item->name == "Template")
                                            @if( $item->index == '1' )
                                                <li><a href="{{ URL::to('employee/template') }}">Email Templates</a></li>                          
                                            @endif
                                        @endif  -->
                                    </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif
                @endif

                @if(Auth::check())
                    @if(sizeof($validateUrl) >= 1 && $totalSumFourteenthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-info"></i> <span class="nav-label">Website Content</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "SliderManager" || $item->name == "LatestUpdate" || $item->name == "WhatWeOffer")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "SliderManager")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/slider-manager') }}">Slider Manager</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "WhatWeOffer")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/what-we-offer') }}">What we offer</a></li>
                                        @endif
                                    @endif
                                    @if($item->name == "LatestUpdate")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/latest-update') }}">Latest Update</a></li>
                                        @endif
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumFifteenthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">News</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "News" || $item->name == "NewsTag" || $item->name == "NewsType")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "News")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/news') }}">News</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "NewsTag")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/news-type') }}">News Type</a></li>
                                        @endif
                                    @endif
                                    @if($item->name == "NewsType")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/news-tags') }}">News Tags</a></li>
                                        @endif
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumSixteenthLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "SeoContent")
                                @if( $item->index == '1' ) 
                                <li>
                                    <a href="#"><i class="fa fa-search fa-1x"></i> <span class="nav-label">SEO Content </span><span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level collapse"> 
                                        <li><a href="{{ URL::to('/employee/seo-content') }}"><i class="fa fa-list-alt"></i><span class="nav-label">All Seo Content</span> </a></li>          
                                        <li><a href="{{ URL::to('/employee/custom-seo-content') }}"><i class="fa fa-angle-double-right"></i>Custom Page</a></li>
                                        <li><a href="{{ URL::to('/employee/dynamic-seo-content') }}"><i class="fa fa-angle-double-right"></i>Dynamic SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/blog-seo-content') }}"><i class="fa fa-angle-double-right"></i>Blogs SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/college-seo-content') }}"><i class="fa fa-angle-double-right"></i>College SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/student-seo-content') }}"><i class="fa fa-angle-double-right"></i>Student SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/examination-seo-content') }}"><i class="fa fa-angle-double-right"></i>Examination SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/boards-details-seo-content') }}"><i class="fa fa-angle-double-right"></i>Boards Details SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/career-relevent-seo-content') }}"><i class="fa fa-angle-double-right"></i>Career Stream Details SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/popular-career-seo-content') }}"><i class="fa fa-angle-double-right"></i>Popular Career SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/course-details-seo-content') }}"><i class="fa fa-angle-double-right"></i>Course Details SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/exam-section-seo-content') }}"><i class="fa fa-angle-double-right"></i>Exam Section SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/education-level-seo-content') }}"><i class="fa fa-angle-double-right"></i>Education Level SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/degree-seo-content') }}"><i class="fa fa-angle-double-right"></i>Degree SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/functionalarea-seo-content') }}"><i class="fa fa-angle-double-right"></i>Functionalarea SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/course-seo-content') }}"><i class="fa fa-angle-double-right"></i>Courses SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/university-seo-content') }}"><i class="fa fa-angle-double-right"></i>University SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/country-seo-content') }}"><i class="fa fa-angle-double-right"></i>Country SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/state-seo-content') }}"><i class="fa fa-angle-double-right"></i>State SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/city-seo-content') }}"><i class="fa fa-angle-double-right"></i>City SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/news-seo-content') }}"><i class="fa fa-angle-double-right"></i>News SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/news-tags-seo-content') }}"><i class="fa fa-angle-double-right"></i>News Tags SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/news-type-seo-content') }}"><i class="fa fa-angle-double-right"></i>News Type SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/ask-question-seo-content') }}"><i class="fa fa-angle-double-right"></i>Ask Question SEO Pages</a></li>
                                        <li><a href="{{ URL::to('/employee/ask-question-tag-seo-content') }}"><i class="fa fa-angle-double-right"></i>Ask Tags SEO Pages</a></li>
                                    </ul>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumSeventeenthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-book fa-1x"></i> <span class="nav-label">Page Content </span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "Contentcategory" || $item->name == "Content")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "Contentcategory")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/contentcategory') }}"><i class="fa fa-angle-double-right"></i>Page Types</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "Content")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/content') }}"><i class="fa fa-angle-double-right"></i>Page Contents</a></li>
                                        @endif
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumEighteenthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Examination Information</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "ApplicationAndExamStatus" || $item->name == "ApplicationMode" || $item->name == "ExaminationMode" || $item->name == "ExaminationType" || $item->name == "EligibilityCriterion")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "ApplicationAndExamStatus")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/application-and-exam-status') }}">Application & Exam Status</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "ApplicationMode")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/application-mode') }}">Application Mode</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "ExaminationType")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/examination-type') }}">Examination Type</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "ExaminationMode")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/examination-mode') }}">Examination Mode</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "EligibilityCriterion")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/eligibility-criteria') }}">Eligibility Criteria</a></li>
                                        @endif
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumNineteenthLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Examination Section</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "ExamSection" || $item->name == "TypeOfExamination" || $item->name == "ExamQuestion" || $item->name == "ExamQuestionAnswer" || $item->name == "ExamQuestionAnswerComment")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "ExamSection")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/exam-section') }}">Exam Department</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "TypeOfExamination")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/type-of-examination') }}">List of Examination</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "ExamQuestion")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/all-exam-question') }}">All Exam Questions</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "ExamQuestionAnswer")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/all-exam-answers') }}">All Exam Answer</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "ExamQuestionAnswerComment")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/examination/all-exam-comments') }}">All Exam Comments</a></li>
                                        @endif
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTwentiethLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "ExamCounsellingForm")
                                @if( $item->index == '1' )
                                <li>
                                    <a href="{{ URL::to('/employee/exam-counselling-form') }}"><i class="fa fa-file-text"></i><span class="nav-label">Exam Counselling Form</span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTwentyOneLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "CounselingBoard")
                                @if( $item->index == '1' )
                                <li>
                                    <a href="{{ URL::to('/counseling/counseling-boards') }}"><i class="fa fa-clipboard"></i><span class="nav-label">Education Boards</span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTwentyTwoLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "CounselingCareerDetail")
                                @if( $item->index == '1' )
                                <li>
                                    <a href="{{ URL::to('/counseling/counseling-career-details') }}"><i class="fa fa-clipboard"></i><span class="nav-label">Popular Career Stream Details</span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTwentyThreeLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "CounselingCoursesDetail")
                                @if( $item->index == '1' )
                                <li>
                                    <a href="{{ URL::to('/counseling/counseling-courses-details') }}"><i class="fa fa-clipboard"></i><span class="nav-label">Career Courses Details</span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTwentyFourLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Career Opportunities</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "CounselingCareerInterest" || $item->name == "CounselingCareerRelevant")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "CounselingCareerInterest")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/counseling/counseling-career-interests') }}">Types of career intrest </a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "CounselingCareerRelevant")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/counseling/counseling-career-relevant') }}">Career Relevant Post</a></li>
                                        @endif
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTwentyFiveLi > 0)
                        <li>
                            <a href="#"><i class="fa fa-group"></i> <span class="nav-label">ASk Question & Answer</span><span class="fa arrow"></span></a>
                            @foreach($validateUrl as $key => $item)
                                @if($item->name == "AskQuestionTag" || $item->name == "AskQuestion" || $item->name == "AskQuestionAnswer" || $item->name == "AskQuestionAnswerComment")
                                <ul class="nav nav-second-level collapse">
                                    @if($item->name == "AskQuestionTag")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/ask-question-tags') }}">ASk Question Tags</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "AskQuestion")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/ask-question') }}">All ASk Question</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "AskQuestionAnswer")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/all-ask-answers') }}">All ASk Answer</a></li>
                                        @endif
                                    @endif

                                    @if($item->name == "AskQuestionAnswerComment")
                                        @if( $item->index == '1' )
                                            <li><a href="{{ URL::to('/employee/all-ask-comments') }}">All ASk Comments</a></li>
                                        @endif
                                    @endif
                                </ul>
                                @endif
                            @endforeach
                        </li>
                    @endif

                    @if(sizeof($validateUrl) >= 1 && $totalSumTwentySixLi > 0)
                        @foreach($validateUrl as $key => $item)
                            @if($item->name == "LandingPageQueryForm")
                                @if( $item->index == '1' )
                                <li>
                                    <a href="{{ URL::to('/employee/landing-page-query-form') }}"><i class="fa fa-file-text"></i><span class="nav-label">Landing Page Query Form</span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endif

            </ul>
        </div>
    </nav>
<div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg custome-top-modification" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <button class="margin-top10 btn  btn-dropbox" data-toggle="modal" data-target="#adminEmailModel" data-whatever="" href=""><i class="fa fa-envelope-o "></i> Notify Admin</button>
            <ul class="nav navbar-top-links navbar-right">
                @if(Auth::check())
                    <li>
                        <span class="m-r-sm text-muted welcome-message">{{ Auth::user()->firstname }} {{ Auth::user()->middlename }} {{ Auth::user()->lastname }} | 
                            @if( Auth::user()->userrole_id == '1' )
                                Administrator
                            @endif
                        </span>
                    </li>
                @endif

                <li>
                    <a href="{{ URL::to('logout') }}">
                        <i class="fa fa-sign-out"></i> Log Out
                    </a>
                </li>  
                <li>
                    <button class="btn btn-sm rounded btn-warning" type="button"><a href="/" target="_blank" style="color: #fff;">Go to Website</a></button>
                </li>              
            </ul>

        </nav>
        </div>

<div class="modal fade" id="adminEmailModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => 'employeeSendEmails', 'method' =>'POST','class' => 'sky-form' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
                <div class="modal-header modal-header-design" style="background: #18BA98;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Notify Admin "{{ Auth::user()->firstname }} {{ Auth::user()->middlename }} {{ Auth::user()->lastname }}"</h4>
                </div>
                <div class="modal-body">
                    <div class="margin-bottom-20">
                        <label>Recipient</label>
                        <input class="form-control rounded-right" type="text" value="{{ Auth::user()->firstname }} {{ Auth::user()->middlename }} {{ Auth::user()->lastname }}" disabled="">
                    </div>
                    <div class="margin-bottom-20">
                        <label>Subject</label>
                        <input class="form-control rounded-right" type="text" name="subject" placeholder="Enter the subject" required="">
                    </div>
                    <div class="margin-bottom-20">
                        <label>Message</label>
                        <textarea class="form-control" rows="4" placeholder="Enter the message" name="message" required=""></textarea>
                    </div>
                    <div class="row " style="margin-top: 20px;">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn-u btn-block rounded">Submit</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
