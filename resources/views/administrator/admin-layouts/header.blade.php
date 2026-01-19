<style type="text/css">
    .blinking{
        animation:blinkingText 1s infinite;
    }
    @keyframes blinkingText{
        0%{     color: #fff; }
        49%{    color: transparent; }
        50%{    color: transparent; }
        99%{    color:transparent;  }
        100%{   color: #fff;    }
    }
</style>
<nav class="navbar-default navbar-static-side custom-sidebar-menu" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="top-menuli">&nbsp;</li>
                <li class="nav-header custom-header">
                    <div class="dropdown profile-element"> <span>
                            <a href="{{ URL::to('/administrator/dashboard') }}">{!! HTML::image("assets/administrator/images/logo.jpg", "Logo", array( 'width' => 150 )) !!}</a>
                             </span>                    
                    </div>
                    <div class="logo-element">
                        {!! HTML::image("assets/images/favicon.png", "Logo", array( 'class' => 'img-size-small', 'width' => 55 )) !!}
                    </div>
                </li>
                <!-- Menu items -->
                <li>
                    <a href="{{ URL::to('/administrator/dashboard') }}"><i class="fa fa-home"></i><span class="nav-label">Home</span> </a>
                </li>
                <li>
                    <a href="{{ URL::to('administrator/ads-management') }}"><i class="fa fa-adn"></i><span class="nav-label">ADS Management<span class="label label-danger pull-right">New</span></a>
                </li>
                <li>
                    <a href="{{ URL::to('administrator/ads-top-college-list') }}"><i class="fa fa-adn"></i><span class="nav-label">ADS Colleges List<span class="label label-warning pull-right">New</span></a>
                </li>
                <li>
                    <a href="{{ URL::to('/administrator/transaction-analytics') }}"><i class="fa fa-money"></i><span class="nav-label">Transaction Analytics</span> <span class="label label-info pull-right">Updated</span></a>
                </li>

                <li>
                    <a href="{{ URL::to('/administrator/website-analytics') }}"><i class="fa fa-desktop"></i><span class="nav-label">Website Metrics</span> <span class="label label-info pull-right">Current</span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Members</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/users') }}">Users</a></li>
                        <li><a href="{{ URL::to('/administrator/userrole') }}">User Roles</a></li>                       
                        <li><a href="{{ URL::to('/administrator/userstatus') }}">User Status</a></li> 
                         <li><a href="{{ URL::to('/administrator/userprivilege') }}">User Privilege</a></li>
                        <li><a href="{{ URL::to('/administrator/usergroup') }}">User Group</a></li>

                    </ul>
                </li>
                
                <li>
                    <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Student Profiles</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/studentprofile') }}">Profile Information</a></li>
                        <!-- <li><a href="{{ URL::to('/administrator/studentmarks') }}">Academic Marks </a></li>                  -->
                        <li><a href="{{ URL::to('/administrator/bookmarks') }}">Bookmarks </a></li>
                    </ul>
                </li>  

                <li>
                    <a href="#"><i class="fa fa-university"></i> <span class="nav-label">College Profiles</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/collegeprofile-info/contact-card') }}">College Contact Card</a></li>
                        <li><a href="{{ URL::to('/administrator/collegeprofile') }}">Profile Information</a></li>
                        <li><a href="{{ URL::to('/administrator/college-management-details') }}">College Management Information</a></li>
                        <li><a href="{{ URL::to('/administrator/collegemaster') }}">College Course</a></li> 
                        <li><a href="{{ URL::to('/administrator/event') }}">College Events</a></li>
                        <li><a href="{{ URL::to('/administrator/collegefacilities') }}">College Facilities</a></li>
                        <li><a href="{{ URL::to('/administrator/faculty') }}">College Faculty</a></li> 
                        <li><a href="{{ URL::to('/administrator/placement') }}">College Placement</a></li>
                        <li><a href="{{ URL::to('/administrator/college-scholarship') }}"> College Scholarship</a></li>
                        <li><a href="{{ URL::to('/administrator/college-cut-offs') }}"> College Cut Offs</a></li>
                        <li><a href="{{ URL::to('/administrator/college-sports-activity') }}"> College Sports & Activity</a></li> 
                        <li><a href="{{ URL::to('/administrator/college-admission-procedure') }}"> College Admission Procedure</a></li> 
                        <li><a href="{{ URL::to('/administrator/college-reviews') }}"> College Reviews</a></li> 
                        <li><a href="{{ URL::to('/administrator/college-faqs') }}"> College Faqs</a></li> 
                        <!--  
                        <li><a href="{{ URL::to('/administrator/faculty-qualification') }}"> Faculty</a></li> 
                        <li><a href="{{ URL::to('/administrator/faculty-department') }}"> Faculty</a></li> 
                        <li><a href="{{ URL::to('/administrator/faculty-experience') }}"> Faculty</a></li> 
                        <li><a href="{{ URL::to('/administrator/college-master-associate-faculty') }}"> Faculty</a></li> 
                          -->


                    </ul>
                </li>
                <li>
                    <a href="{{ URL::to('/administrator/request/create-college-account') }}"><i class="fa fa-list-alt"></i><span class="nav-label">Request to make college profile </span> <span class="blinking label label-danger pull-right">New</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Media Information</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/documents') }}">Documents</a></li>
                        <li><a href="{{ URL::to('/administrator/galleries') }}">Gallery &amp; Photos</a></li>
                        <li><a href="{{ URL::to('/administrator/youtube') }}">Youtube Link</a></li>
                    </ul>
                </li> 

                <li>
                    <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Application &amp; Payment</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/application') }}">Application</a></li>
                        <li><a href="{{ URL::to('/administrator/transaction') }}">Transaction</a></li>
                        <li><a href="{{ URL::to('/administrator/applicationstatusmessage') }}">Application Remarks </a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-location-arrow"></i> <span class="nav-label">Address Information</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/addresstype') }}">Address Type</a></li>
                        <li><a href="{{ URL::to('/administrator/address') }}">Address</a></li>
                        <li><a href="{{ URL::to('/administrator/city') }}">City</a></li>
                        <li><a href="{{ URL::to('/administrator/state') }}">State</a></li>
                        <li><a href="{{ URL::to('/administrator/country') }}">Country</a></li>
                    </ul>
                </li> 
                
                

                <li>
                    <a href="{{ URL::to('/administrator/blogs') }}"><i class="fa fa-rss"></i><span class="nav-label">Blogs</span> </a>
                </li>

                <li>
                    <a href="{{ URL::to('/administrator/query') }}"><i class="fa fa-question"></i><span class="nav-label">Query</span> </a>
                </li>
                 <li>
                    <a href="{{ URL::to('/administrator/query-college-student') }}"><i class="fa fa-question-circle"></i><span class="nav-label">Query Between College &amp; Student</span> </a>
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
                    <a href="{{ URL::to('/administrator/query-bya') }}"><i class="fa fa-question"></i><span class="nav-label">Query To Admission X</span>
                    @if($getQueryCollegeDataObj) 
                        <span class="label label-info pull-right">
                            {{ $getQueryCollegeDataObj }}
                        </span>
                    @endif 
                    </a>
                </li>

                <li>
                    <a href="{{ URL::to('/administrator/subscribe') }}"><i class="fa fa-paper-plane-o"></i><span class="nav-label">Subscribe</span></a>
                </li>

               <!--  <li>
                    <a href="{{ URL::to('/administrator/pages') }}"><i class="fa fa-file-text"></i><span class="nav-label">Pages</span> </a>
                </li> -->
                <li>
                    <a href="{{ URL::to('/administrator/testimonial') }}"><i class="fa fa-list-alt"></i><span class="nav-label">Testimonial</span> </a>
                </li>
                <li>
                    <a href="{{ URL::to('/administrator/reports') }}"><i class="fa fa-list-alt"></i><span class="nav-label">Reports</span> </a>
                </li>
                <li>
                    <a href="{{ URL::to('/administrator/all-india-engineer-association') }}"><i class="fa fa-list-alt"></i><span class="nav-label">AIEA Exam</span> </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-info"></i> <span class="nav-label">Other Information</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/logs') }}">Logs</a></li> 
                        <li><a href="{{ URL::to('/administrator/applicationstatus') }}">Application Status</a></li>
                        <li><a href="{{ URL::to('/administrator/cardtype') }}">Card Type</a></li>
                        <li><a href="{{ URL::to('/administrator/category') }}">Category</a></li>
                        <li><a href="{{ URL::to('/administrator/collegetype') }}">College Type</a></li>
                        <li><a href="{{ URL::to('/administrator/educationlevel') }}">Education Levels</a></li>
                        <li><a href="{{ URL::to('/administrator/functionalarea') }}">Stream</a></li>
                        <li><a href="{{ URL::to('/administrator/degree') }}">Degrees</a></li>
                        <li><a href="{{ URL::to('/administrator/coursetype') }}">Course Type</a></li>
                        <li><a href="{{ URL::to('/administrator/course') }}">Course</a></li>
                        <li><a href="{{ URL::to('/administrator/facilities') }}">Facilities</a></li>
                        <li><a href="{{ URL::to('/administrator/invite') }}">Invite</a></li>                        
                       <li><a href="{{ URL::to('/administrator/paymentstatus') }}">Payment Status</a></li> 
                       <li><a href="{{ URL::to('/administrator/university') }}">Universities</a></li> 
                       <li><a href="{{ URL::to('/administrator/entranceexam') }}">Entrance Exam</a></li> 
                       <li><a href="{{ URL::to('/administrator/career') }}">Career</a></li>
                       <li><a href="{{ URL::to('/administrator/socialmanagement') }}">Social Management</a></li>
                       <!-- <li><a href="{{ URL::to('/administrator/template') }}"> Email Templates</a></li> -->
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-info"></i> <span class="nav-label">Website Content</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/slider-manager') }}">Slider Manager</a></li>
                        <li><a href="{{ URL::to('/administrator/what-we-offer') }}">What we offer</a></li>
                        <li><a href="{{ URL::to('/administrator/latest-update') }}">Latest Update</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">News</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/news') }}">News</a></li>
                        <li><a href="{{ URL::to('/administrator/news-type') }}">News Type</a></li>
                        <li><a href="{{ URL::to('/administrator/news-tags') }}">News Tags</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-search fa-1x"></i> <span class="nav-label">SEO Content </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">  
                        <li><a href="{{ URL::to('/administrator/seo-content') }}"><i class="fa fa-list-alt"></i><span class="nav-label">All Seo Content</span> </a></li>          
                        <li><a href="{{ URL::to('/administrator/custom-seo-content') }}"><i class="fa fa-angle-double-right"></i>Custom Page</a></li>
                        <li><a href="{{ URL::to('/administrator/dynamic-seo-content') }}"><i class="fa fa-angle-double-right"></i>Dynamic SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/blog-seo-content') }}"><i class="fa fa-angle-double-right"></i>Blogs SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/college-seo-content') }}"><i class="fa fa-angle-double-right"></i>College SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/student-seo-content') }}"><i class="fa fa-angle-double-right"></i>Student SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/examination-seo-content') }}"><i class="fa fa-angle-double-right"></i>Examination SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/boards-details-seo-content') }}"><i class="fa fa-angle-double-right"></i>Boards Details SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/career-relevent-seo-content') }}"><i class="fa fa-angle-double-right"></i>Career Stream Details SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/popular-career-seo-content') }}"><i class="fa fa-angle-double-right"></i>Popular Career SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/course-details-seo-content') }}"><i class="fa fa-angle-double-right"></i>Course Details SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/exam-section-seo-content') }}"><i class="fa fa-angle-double-right"></i>Exam Section SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/education-level-seo-content') }}"><i class="fa fa-angle-double-right"></i>Education Level SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/degree-seo-content') }}"><i class="fa fa-angle-double-right"></i>Degree SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/functionalarea-seo-content') }}"><i class="fa fa-angle-double-right"></i>Functionalarea SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/course-seo-content') }}"><i class="fa fa-angle-double-right"></i>Courses SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/university-seo-content') }}"><i class="fa fa-angle-double-right"></i>University SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/country-seo-content') }}"><i class="fa fa-angle-double-right"></i>Country SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/state-seo-content') }}"><i class="fa fa-angle-double-right"></i>State SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/city-seo-content') }}"><i class="fa fa-angle-double-right"></i>City SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/news-seo-content') }}"><i class="fa fa-angle-double-right"></i>News SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/news-tags-seo-content') }}"><i class="fa fa-angle-double-right"></i>News Tags SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/news-type-seo-content') }}"><i class="fa fa-angle-double-right"></i>News Type SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/ask-question-seo-content') }}"><i class="fa fa-angle-double-right"></i>Ask Question SEO Pages</a></li>
                        <li><a href="{{ URL::to('/administrator/ask-question-tag-seo-content') }}"><i class="fa fa-angle-double-right"></i>Ask Tags SEO Pages</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-book fa-1x"></i> <span class="nav-label">Page Content </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">            
                        <li><a href="{{ URL::to('/administrator/contentcategory') }}"><i class="fa fa-angle-double-right"></i>Page Types</a></li>
                        <li><a href="{{ URL::to('/administrator/content') }}"><i class="fa fa-angle-double-right"></i>Page Contents</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Examination Information</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/examination/application-and-exam-status') }}">Application & Exam Status</a></li>                       
                        <li><a href="{{ URL::to('/examination/application-mode') }}">Application Mode</a></li> 
                        <li><a href="{{ URL::to('/examination/examination-type') }}">Examination Type</a></li>
                        <li><a href="{{ URL::to('/examination/examination-mode') }}">Examination Mode</a></li>
                        <li><a href="{{ URL::to('/examination/eligibility-criteria') }}">Eligibility Criteria</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Examination Section</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/examination/exam-section') }}">Exam Department</a></li>
                        <li><a href="{{ URL::to('/examination/type-of-examination') }}">List of Examination</a></li>
                        <li><a href="{{ URL::to('/examination/all-exam-question') }}">All Exam Questions</a></li>
                        <li><a href="{{ URL::to('/examination/all-exam-answers') }}">All Exam Answer</a></li>
                        <li><a href="{{ URL::to('/examination/all-exam-comments') }}">All Exam Comments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ URL::to('/administrator/exam-counselling-form') }}"><i class="fa fa-file-text"></i><span class="nav-label">Exam Counselling Form</span></a>
                </li>
                <li>
                    <a href="{{ URL::to('/counseling/counseling-boards') }}"><i class="fa fa-clipboard"></i><span class="nav-label">Education Boards</span></a>
                </li>
                <li>
                    <a href="{{ URL::to('/counseling/counseling-career-details') }}"><i class="fa fa-clipboard"></i><span class="nav-label">Popular Career Stream Details</span></a>
                </li>
                <li>
                    <a href="{{ URL::to('/counseling/counseling-courses-details') }}"><i class="fa fa-clipboard"></i><span class="nav-label">Career Courses Details</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Career Opportunities</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/counseling/counseling-career-interests') }}">Types of career intrest </a></li>
                        <li><a href="{{ URL::to('/counseling/counseling-career-relevant') }}">Career Relevant Post</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Counseling Section</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/counseling/counseling-boards') }}">Counseling Board Details</a></li>
                        <li><a href="{{ URL::to('/counseling/counseling-courses-details') }}">Career Courses Details</a></li>
                        <li><a href="{{ URL::to('/counseling/counseling-career-interests') }}">Types of career intrest </a></li>
                        <li><a href="{{ URL::to('/counseling/counseling-career-relevant') }}">Career Relevant Post</a></li>
                        <li><a href="{{ URL::to('/counseling/counseling-career-details') }}">Popular Career Stream Details</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label">ASk Question & Answer</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ URL::to('/administrator/ask-question-tags') }}">ASk Question Tags</a></li>
                        <li><a href="{{ URL::to('/administrator/ask-question') }}">All ASk Question</a></li>
                        <li><a href="{{ URL::to('/administrator/all-ask-answers') }}">All ASk Answer</a></li>
                        <li><a href="{{ URL::to('/administrator/all-ask-comments') }}">All ASk Comments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ URL::to('/administrator/landing-page-query-form') }}"><i class="fa fa-file-text"></i><span class="nav-label">Landing Page Query Form</span></a>
                </li>
            </ul>
        </div>
    </nav>
<div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg custome-top-modification" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
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
