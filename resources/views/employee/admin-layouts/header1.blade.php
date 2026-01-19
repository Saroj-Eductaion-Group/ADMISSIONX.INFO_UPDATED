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
                <li>
                    <a href="{{ URL::to('/employee/transaction-analytics') }}"><i class="fa fa-money"></i><span class="nav-label">Transaction Analytics</span> <span class="label label-info pull-right">Updated</span></a>
                </li>
                <li>
                    <a href="{{ URL::to('/employee/website-analytics') }}"><i class="fa fa-desktop"></i><span class="nav-label">Website Metrics</span> <span class="label label-info pull-right">Current</span></a>
                </li>

                @if(Auth::check())
                <!-- AUTH WITH ROLE PLUS PERMISSIONS -->
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlUsers = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'User')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlUserRole = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'UserRole')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlUserStatus = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'UserStatus')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlUserPrivilege = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'UserPrivilege')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlUserGroup = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'UserGroup')
                                    ->count()
                                    ;
                /*--}}

                {{--*/
                     $totalSumFirstLi = $validateUrlUsers + $validateUrlUserRole + $validateUrlUserStatus + $validateUrlUserPrivilege + $validateUrlUserGroup 
                /*--}}
                    @if( $totalSumFirstLi >= 1  )
                    <li>
                        <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Members</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @if( $validateUrlUsers == 1 )
                                <li>
                                <a href="#">Users<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlUsersCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'User')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlUsersCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/users/create') }}">Create User</a></li>                                  
                                    @endif
                                    @if( $validateUrlUsersCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/users') }}">Users List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                            
                            @if( $validateUrlUserRole == 1 )
                                <li>
                                <a href="#">User Roles<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlUserRolesCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'UserRole')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlUserRolesCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/userrole/create') }}">Create User Role</a></li>                                  
                                    @endif
                                    @if( $validateUrlUserRolesCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/userrole') }}">User Roles List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlUserStatus == 1 )
                                <li>
                                <a href="#">User Status<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlUserStatusCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'UserStatus')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlUserStatusCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/userstatus/create') }}">Create User Status</a></li>                                  
                                    @endif
                                    @if( $validateUrlUserStatusCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/userstatus') }}">User Status List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlUserPrivilege == 1 )
                                <li>
                                <a href="#">User Privilege<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlUserPrivilegeCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'UserPrivilege')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlUserPrivilegeCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/userprivilege/create') }}">Create User Privilege</a></li>                                  
                                    @endif
                                    @if( $validateUrlUserPrivilegeCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/userprivilege') }}">User Privilege List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlUserGroup == 1 )
                                <li>
                                <a href="#">User Group<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlUserGroupCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'UserGroup')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlUserGroupCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/usergroup/create') }}">Create User Group</a></li>                                  
                                    @endif
                                    @if( $validateUrlUserGroupCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/usergroup') }}">User Group List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endif
                
                @if(Auth::check())
                <!-- AUTH WITH ROLE PLUS PERMISSIONS -->
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlStudentProfile = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'StudentProfile')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlStudentMark = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'StudentMark')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlBookmark = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Bookmark')
                                    ->count()
                                    ;
                /*--}}
                {{--*/ $totalSumSecondLi = $validateUrlStudentProfile + $validateUrlStudentMark + $validateUrlBookmark /*--}}
                    @if( $totalSumSecondLi >= 1  )
                    <li>
                        <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Student Profiles</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @if( $validateUrlStudentProfile == 1 )
                                <li>
                                <a href="#">Profile Information<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlStudentProfileCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'StudentProfile')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    <!-- @if( $validateUrlStudentProfileCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/studentprofile/create') }}">Create Profile Information</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlStudentProfileCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/studentprofile') }}">Profile Information List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlStudentMark == 1 )
                                <li>
                                <a href="#">Academic Marks<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlStudentMarksCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'StudentMark')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                   <!--  @if( $validateUrlStudentMarksCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/studentmarks/create') }}">Create Academic Marks</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlStudentMarksCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/studentmarks') }}">Academic Marks List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlBookmark == 1 )
                                <li>
                                <a href="#">Bookmark<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlBookmark = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Bookmark')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                   <!--  @if( $validateUrlBookmark[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/bookmarks/create') }}">Create Bookmark</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlBookmark[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/bookmarks') }}">Bookmark List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                        </ul>
                    </li>  
                    @endif
                @endif

                @if(Auth::check())
                <!-- AUTH WITH ROLE PLUS PERMISSIONS -->
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlCollegeProfile = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'CollegeProfile')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCollegeMaster = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'CollegeMaster')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlEvent = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Event')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCollegeFacility = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'CollegeFacility')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlFaculty = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Faculty')
                                    ->count()
                                    ;
                /*--}}

                {{--*/ $totalSumThirdLi = $validateUrlCollegeProfile + $validateUrlCollegeMaster + $validateUrlEvent + $validateUrlCollegeFacility + $validateUrlFaculty /*--}}
                    @if( $totalSumThirdLi >= 1  )
                    <li>
                        <a href="#"><i class="fa fa-university"></i> <span class="nav-label">College Profiles</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">

                            @if( $validateUrlCollegeProfile == 1 )
                                <li>
                                <a href="#">Profile Information<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlCollegeProfile = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'CollegeProfile')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                   <!--  @if( $validateUrlCollegeProfile[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/collegeprofile/create') }}">Create Profile Information</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlCollegeProfile[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/collegeprofile') }}">Profile Information List</a></li>
                                        <li><a href="{{ URL::to('employee/collegeprofile-info/contact-card') }}">College Contact Card</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlCollegeMaster == 1 )
                                <li>
                                <a href="#">College Course<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlCollegeMaster = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'CollegeMaster')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlCollegeMaster[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/collegemaster/create') }}">Create College Course</a></li>                                  
                                    @endif
                                    @if( $validateUrlCollegeMaster[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/collegemaster') }}">College Course List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlEvent == 1 )
                                <li>
                                <a href="#">College Events<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlCollegeEvent = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Event')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlCollegeEvent[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/event/create') }}">Create College Events</a></li>                                  
                                    @endif
                                    @if( $validateUrlCollegeEvent[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/event') }}">College Events List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                            
                            @if( $validateUrlCollegeFacility == 1 )
                                <li>
                                <a href="#">College Facilities<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlCollegeFacilities = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'CollegeFacility')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlCollegeFacilities[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/collegefacilities/create') }}">Create College Facilities</a></li>                                  
                                    @endif
                                    @if( $validateUrlCollegeFacilities[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/collegefacilities') }}">College Facilities List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlFaculty == 1 )
                                <li>
                                <a href="#">Faculty<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlCollegeFaculty = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Faculty')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlCollegeFaculty[0]->create == '1' )
                                       <!--  <li><a href="{{ URL::to('employee/faculty/create') }}">Create Faculty</a></li> -->                                  
                                    @endif
                                    @if( $validateUrlCollegeFaculty[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/faculty') }}">Faculty List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endif
                

                @if(Auth::check())
                <!-- AUTH WITH ROLE PLUS PERMISSIONS -->
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlDocument = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Document')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlGallery = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Gallery')
                                    ->count()
                                    ;
                /*--}}

                {{--*/ $totalSumFourthLi = $validateUrlDocument + $validateUrlGallery /*--}}
                    @if( $totalSumFourthLi >= 1  )
                    <li>
                        <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Media Information</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @if( $validateUrlDocument == 1 )
                                <li>
                                <a href="#">Documents<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlDocumentsCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Document')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlDocumentsCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/documents/create') }}">Create Documents</a></li>                                  
                                    @endif
                                    @if( $validateUrlDocumentsCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/documents') }}">Documents List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlGallery == 1 )
                                <li>
                                <a href="#">Gallery &amp; Photos<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlGalleryCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Gallery')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlGalleryCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/galleries/create') }}">Create Gallery &amp; Photos</a></li>  
                                        <li><a href="{{ URL::to('/employee/youtube') }}">Youtube Link</a></li>                                
                                    @endif
                                    @if( $validateUrlGalleryCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/galleries') }}">Gallery &amp; Photos List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endif 

                @if(Auth::check())
                <!-- AUTH WITH ROLE PLUS PERMISSIONS -->
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlApplication = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Application')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlTransaction = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Transaction')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlApplicationRemarks = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'ApplicationStatusMessages')
                                    ->count()
                                    ;
                /*--}}

                {{--*/ $totalSumFifthLi = $validateUrlApplication + $validateUrlTransaction + $validateUrlApplicationRemarks /*--}}
                    @if( $totalSumFifthLi >= 1  )
                    <li>
                        <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Application &amp; Payment</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @if( $validateUrlApplication == 1 )
                                <li>
                                <a href="#">Application<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlApplicationCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Application')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                   <!--  @if( $validateUrlApplicationCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/application/create') }}">Create Application</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlApplicationCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/application') }}">Application List</a></li>
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlApplicationRemarks == 1 )
                                <li>
                                <a href="#">Application Remarks<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlApplicationRemarksCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'ApplicationStatusMessages')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                   <!--  @if( $validateUrlApplicationRemarksCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/applicationstatusmessage/create') }}">Create Application</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlApplicationRemarksCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/applicationstatusmessage') }}">Application Remarks </a></li>
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlTransaction == 1 )
                                <li>
                                <a href="#">Transaction<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlTransactionCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Transaction')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                   <!--  @if( $validateUrlTransactionCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/transaction/create') }}">Create Transaction</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlTransactionCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/transaction') }}">Transaction List</a></li>                                    
                                    @endif

                                </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endif


                @if(Auth::check())
                <!-- AUTH WITH ROLE PLUS PERMISSIONS -->
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlAddressType = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'AddressType')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlAddress = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Address')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCity = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'City')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlState = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'State')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCountry = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Country')
                                    ->count()
                                    ;
                /*--}}

                {{--*/ $totalSumSixthLi = $validateUrlAddressType + $validateUrlAddress + $validateUrlCity + $validateUrlState + $validateUrlCountry /*--}}
                    @if( $totalSumSixthLi >= 1  )
                    <li>
                        <a href="#"><i class="fa fa-location-arrow"></i> <span class="nav-label">Address Information</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            
                            @if( $validateUrlAddressType == '1' )
                                <li>
                                <a href="#">Address Type<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlAddressTypeCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'AddressType')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlAddressTypeCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/addresstype/create') }}">Create Address Type</a></li>                                  
                                    @endif
                                    @if( $validateUrlAddressTypeCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/addresstype') }}">Address Type List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlAddress == '1' )
                                <li>
                                <a href="#">Address<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlAddressCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Address')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    <!-- @if( $validateUrlAddressCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/address/create') }}">Create Address</a></li>                                  
                                    @endif -->
                                    @if( $validateUrlAddressCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/address') }}">Address List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                            
                            @if( $validateUrlCity == '1' )
                                <li>
                                <a href="#">City<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlCityCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'City')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlCityCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/city/create') }}">Create City</a></li>                                  
                                    @endif
                                    @if( $validateUrlCityCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/city') }}">City List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                                
                            @if( $validateUrlState == 1 )
                                <li>
                                <a href="#">State<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlStateCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'State')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlStateCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/state/create') }}">Create State</a></li>                                  
                                    @endif
                                    @if( $validateUrlStateCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/state') }}">State List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif

                            @if( $validateUrlCountry == 1 )
                                <li>
                                <a href="#">Country<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    {{--*/    $validateUrlCountryCreate = DB::table('users')
                                                        ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                        ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                        ->where('users.id', '=', $currentLoggedIn)
                                                        ->where('alltableinformations.name', '=', 'Country')
                                                        ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                        ->take(1)
                                                        ->get()
                                                        ;
                                    /*--}}
                                    @if( $validateUrlCountryCreate[0]->create == '1' )
                                        <li><a href="{{ URL::to('employee/country/create') }}">Create Country</a></li>                                  
                                    @endif
                                    @if( $validateUrlCountryCreate[0]->index == '1' )
                                        <li><a href="{{ URL::to('employee/country') }}">Country List</a></li>                                    
                                    @endif
                                </ul>
                                </li>
                            @endif
                            
                        </ul>
                    </li>
                    @endif
                @endif        
                
                @if(Auth::check())
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlBlog = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Blog')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlQuery = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Query')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlSubscribe = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Subscribe')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlPage = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Page')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlTestimonial = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Testimonial')
                                    ->count()
                                    ;
                /*--}}

                {{--*/ $totalSumSeventhLi = $validateUrlBlog + $validateUrlQuery + $validateUrlSubscribe + $validateUrlPage + $validateUrlTestimonial /*--}}
                    @if( $totalSumSeventhLi >= 1  )
                        @if( $validateUrlBlog == 1 )
                            <li>
                            <a href="#">Blogs<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlBlogCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Blog')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlBlogCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/blogs/create') }}">Create Blogs</a></li>                                  
                                @endif
                                @if( $validateUrlBlogCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/blogs') }}">Blogs List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlQuery == 1 )
                            <li>
                            <a href="#">Query<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlQueryCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Query')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlQueryCreate[0]->create == '1' )
                                    <!-- <li><a href="{{ URL::to('employee/query/create') }}">Create Query</a></li> -->                                  
                                @endif
                                @if( $validateUrlQueryCreate[0]->index == '1' )
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
                        
                        @if( $validateUrlSubscribe == 1 )
                            <li>
                            <a href="#">Subscribe<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlSubscribeCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Subscribe')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlSubscribeCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/subscribe/create') }}">Create Subscribe</a></li>                                  
                                @endif
                                @if( $validateUrlSubscribeCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/subscribe') }}">Subscribe List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlPage == 1 )
                            <li>
                            <a href="#">Page<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlPageCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Page')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlPageCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/pages/create') }}">Create Page</a></li>                                  
                                @endif
                                @if( $validateUrlPageCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/pages') }}">Page List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlTestimonial == 1 )
                            <li>
                            <a href="#">Testimonial<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlTestimonialCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Testimonial')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlTestimonialCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/testimonial/create') }}">Create Testimonial</a></li>                                  
                                @endif
                                @if( $validateUrlTestimonialCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/testimonial') }}">Testimonial List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        
                    @endif
                @endif  
                <li>
                    <a href="{{ URL::to('/employee/all-india-engineer-association') }}"><i class="fa fa-list-alt"></i><span class="nav-label">AIEA Exam</span> </a>
                </li>
                @if(Auth::check())
                {{--*/ $currentLoggedIn = Auth::id() /*--}}
                {{--*/    $validateUrlLogs = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Log')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlApplicationStatus = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'ApplicationStatus')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCardType = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'CardType')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCategory = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Category')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCollegeType = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'CollegeType')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlEducationLevel = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlFunctionalArea = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlDegree = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Degree')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCourseType = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'CourseType')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCourse = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Course')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlFacilities = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Facility')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlInvite = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Invite')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlPaymentStatus = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'PaymentStatus')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlUniversity = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'University')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlPlacement = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Placement')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlEntranceExam = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'EntranceExam')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlCarrer = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'Career')
                                    ->count()
                                    ;
                /*--}}

                {{--*/    $validateUrlSocialManagement = DB::table('users')
                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                    ->where('users.id', '=', $currentLoggedIn)
                                    ->where('alltableinformations.name', '=', 'SocialManagement')
                                    ->count()
                                    ;
                /*--}}

                {{--*/ $totalSumLastLi = $validateUrlLogs + $validateUrlApplicationStatus + $validateUrlCardType + $validateUrlCategory + $validateUrlCollegeType + $validateUrlEducationLevel + $validateUrlFunctionalArea + $validateUrlDegree + $validateUrlCourseType + $validateUrlCourse + $validateUrlFacilities + $validateUrlInvite + $validateUrlPaymentStatus + $validateUrlUniversity + $validateUrlPlacement + $validateUrlEntranceExam + $validateUrlCarrer + $validateUrlSocialManagement /*--}}                

                @if( $totalSumLastLi >= 1 )
                <li>
                    <a href="#"><i class="fa fa-info"></i> <span class="nav-label">Other Information</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @if( $validateUrlLogs == 1 )
                            <li>
                            <a href="#">Logs<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlLogsCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Log')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlLogsCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/logs/create') }}">Create Logs</a></li>                                  
                                @endif
                                @if( $validateUrlLogsCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/logs') }}">Logs List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlApplicationStatus == 1 )
                            <li>
                            <a href="#">Application Status<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlApplicationStatusCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'ApplicationStatus')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlApplicationStatusCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/applicationstatus/create') }}">Create Application Status</a></li>                                  
                                @endif
                                @if( $validateUrlApplicationStatusCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/applicationstatus') }}">Application Status List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlCardType == 1 )
                            <li>
                            <a href="#">Card Type<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlCardTypeCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'CardType')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlCardTypeCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/cardtype/create') }}">Create Card Type</a></li>                                  
                                @endif
                                @if( $validateUrlCardTypeCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/cardtype') }}">Card Type List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlCategory == 1 )
                            <li>
                            <a href="#">Category<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlCategoryCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Category')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlCategoryCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/category/create') }}">Create Category</a></li>                                  
                                @endif
                                @if( $validateUrlCategoryCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/category') }}">Category List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlCollegeType == 1 )
                            <li>
                            <a href="#">College Type<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlCollegeTypeCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'CollegeType')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlCollegeTypeCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/collegetype/create') }}">Create College Type</a></li>                                  
                                @endif
                                @if( $validateUrlCollegeTypeCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/collegetype') }}">College Type List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif


                        @if( $validateUrlEducationLevel == 1 )
                            <li>
                            <a href="#">Education Levels<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlEducationLevelsCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'EducationLevel')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlEducationLevelsCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/educationlevel/create') }}">Create Education Levels</a></li>                                  
                                @endif
                                @if( $validateUrlEducationLevelsCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/educationlevel') }}">Education Levels List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif
                       
                        @if( $validateUrlFunctionalArea == 1 )
                            <li>
                            <a href="#">Streams<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlFunctionalAreaCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'FunctionalArea')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlFunctionalAreaCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/functionalarea/create') }}">Create Stream</a></li>                                  
                                @endif
                                @if( $validateUrlFunctionalAreaCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/functionalarea') }}">Stream List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif
                        
                        @if( $validateUrlDegree == 1 )
                            <li>
                            <a href="#">Degree<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlDegreeCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Degree')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlDegreeCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/degree/create') }}">Create Degree</a></li>                                  
                                @endif
                                @if( $validateUrlDegreeCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/degree') }}">Degree List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif
                        
                        @if( $validateUrlCourseType == 1 )
                            <li>
                            <a href="#">Course Type<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlCourseTypeCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'CourseType')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlCourseTypeCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/coursetype/create') }}">Create Course Type</a></li>                                  
                                @endif
                                @if( $validateUrlCourseTypeCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/coursetype') }}">Course Type List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlCourse == 1 )
                            <li>
                            <a href="#">Course<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlCourseCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Course')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlCourseCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/course/create') }}">Create Course</a></li>                                  
                                @endif
                                @if( $validateUrlCourseCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/course') }}">Course List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif                        
                        
                        @if( $validateUrlFacilities == 1 )
                            <li>
                            <a href="#">Facilities<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlFacilityCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Facility')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlFacilityCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/facilities/create') }}">Create Facilities</a></li>                                  
                                @endif
                                @if( $validateUrlFacilityCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/facilities') }}">Facilities List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlInvite == 1 )
                            <li>
                            <a href="#">Invite<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlInviteCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Invite')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlInviteCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/invite/create') }}">Create Invite</a></li>                                  
                                @endif
                                @if( $validateUrlInviteCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/invite') }}">Invite List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlPaymentStatus == 1 )
                            <li>
                            <a href="#">Payment Status<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlPaymentStatusCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'PaymentStatus')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlPaymentStatusCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/paymentstatus/create') }}">Create Payment Status</a></li>                                  
                                @endif
                                @if( $validateUrlPaymentStatusCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/paymentstatus') }}">Payment Status List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                       
                       @if( $validateUrlUniversity == 1 )
                            <li>
                            <a href="#">Universities<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlUniversityCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'University')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlUniversityCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/university/create') }}">Create University</a></li>                                  
                                @endif
                                @if( $validateUrlUniversityCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/university') }}">Universities List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif

                        @if( $validateUrlPlacement == 1 )
                            <li>
                            <a href="#">Placement<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlPlacementCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Placement')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlPlacementCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/placement/create') }}">Create Placement</a></li>                                  
                                @endif
                                @if( $validateUrlPlacementCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/placement') }}">Placement List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif 
                       
                        @if( $validateUrlEntranceExam == 1 )
                            <li>
                            <a href="#">Entrance Exam<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlEntranceExamCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Entranceexam')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlEntranceExamCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/entranceexam/create') }}">Create Entrance Exam</a></li>                                  
                                @endif
                                @if( $validateUrlEntranceExamCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/entranceexam') }}">Entrance Exam List</a></li>                                    
                                @endif
                            </ul>
                            </li>
                        @endif 

                        @if( $validateUrlCarrer == 1 )
                            <li>
                            <a href="#">Career<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlCarrerCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'Career')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                @if( $validateUrlCarrerCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/career/create') }}">Create Career</a></li>                                  
                                @endif
                                @if( $validateUrlCarrerCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/career') }}">Career List</a></li>                          
                                @endif
                            </ul>
                            </li>
                        @endif 

                        @if( $validateUrlSocialManagement == 1 )
                            <li>
                            <a href="#">Social Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                {{--*/    $validateUrlSocialmediaCreate = DB::table('users')
                                                    ->join('userprivileges','users.id','=', 'userprivileges.users_id')
                                                    ->join('alltableinformations','userprivileges.allTableInformation_id','=', 'alltableinformations.id')
                                                    ->where('users.id', '=', $currentLoggedIn)
                                                    ->where('alltableinformations.name', '=', 'SocialManagement')
                                                    ->select('userprivileges.id', 'userprivileges.index', 'userprivileges.create')
                                                    ->take(1)
                                                    ->get()
                                                    ;
                                /*--}}
                                <!-- @if( $validateUrlSocialmediaCreate[0]->create == '1' )
                                    <li><a href="{{ URL::to('employee/socialmanagement/create') }}">Create Social Media</a></li>                                
                                @endif -->
                                @if( $validateUrlSocialmediaCreate[0]->index == '1' )
                                    <li><a href="{{ URL::to('employee/socialmanagement') }}">Social Media List</a></li>                          
                                @endif
                            </ul>
                            </li>
                        @endif 
                       
                    </ul>
                </li>
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
