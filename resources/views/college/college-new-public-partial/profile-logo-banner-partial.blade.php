<div class="header-section"></div>
<div class="header-bg-section">
    @if(sizeof($getCollegeDetailObj) > 0)
        @foreach( $getCollegeDetailObj as $item )
            @if( $item->bannerimage != '' )
                <img src="{{ asset('/gallery') }}/{{ $slugUrl }}/{{ $item->bannerimage }}" alt="{{$collegeFullName}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/schools-in-dehradun-ecole.jpg" alt="{{$collegeFullName}} logo" style="max-width: 100%;">
            @endif
        @endforeach
    @endif
</div>
<div class="header-wrapper d-flex">
    <div class="listing-logo">
        @if(sizeof($getCollegeLogoObj) > 0)
            @foreach( $getCollegeLogoObj as $logoObj )
                @if(file_exists(public_path().'/gallery/'.$slugUrl.'/'.$logoObj->galleryName))
                    @if( $logoObj->galleryName != '' )
                        <img src="{{ asset('/gallery') }}/{{ $slugUrl }}/{{ $logoObj->galleryName }}" alt="{{$collegeFullName}} logo">
                    @else
                        <img src="/new-assets/img/school.png" alt="{{$collegeFullName}} logo">
                    @endif
                @else
                    <img src="/new-assets/img/school.png" alt="{{$collegeFullName}} logo">
                @endif
            @endforeach
        @else
            <img src="/new-assets/img/school.png" alt="{{ $collegeFullName }} logo">
        @endif
    </div>

    <div class="listing-content">
        <a href="#">
            <h3>{{$collegeFullName}}</h3>
        </a>
        <div class="review-star">
            <ul class="list-unstyled list-inline">
                <li class="nomargin-nopadding "><p class="tooltips" data-toggle="tooltip" data-placement="right" title="Rating {{ $ratingStar}}/5 This College">{{$ratingStar}}/5 </p></li>
                <li class="nomargin-nopadding"><i id="showRateCounter"></i></li>
                @if($totlaUserRating > 0)
                <li class="nomargin-nopadding tooltips" data-toggle="tooltip" data-placement="right" title="Based On {{ $totlaUserRating}} Student Ratings Claim This College">Based On ({{$totlaUserRating}}) Student</li>
                @endif  
            </ul>
        </div>
        @if(sizeof($fetchCollegeSocialMediaLinks) > 0)
        <div class="school-social-link">
            @foreach( $fetchCollegeSocialMediaLinks as $key => $item)
                @if(!empty($item->url) && $item->isActive == 1) 
                    @if($item->other == 'Facebook')
                        <a title="Facebook" href="{{ $item->url }}" target="_blank"  alt="{{$item->other}}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    @endif
                    @if($item->other == 'Twitter')
                        <a title="Twitter" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    @endif
                    @if($item->other == 'Instagram')
                        <a title="Instagram" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    @endif
                    @if($item->other == 'Pinterest')
                      <a title="Pinterest" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    @endif
                    @if($item->other == 'Linkedin')
                        <a title="Linkedin" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    @endif
                    @if($item->other == 'Youtube')
                        <a title="Youtube" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    @endif
                @endif
            @endforeach
            <div class="pull-right">
                <div class="fb-share-button" data-href="{{ env('APP_URL') }}/college/{{$slugUrl}}" data-layout="button" data-size="large" data-mobile-iframe="true">
                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F{{$slugUrl}}&amp;src=sdkpreparse"><img src="/home-layout/assets/img/icons/other/share-on-facebook.png"></a>
                </div>
            </div>
        </div>
        @endif

        @if(Auth::check())
            {{--*/  
                $getTheRoleStatus = DB::table('users')->where('id', '=', Auth::id())->select('userrole_id', 'userstatus_id')->take(1)->get();
            /*--}}
            
            @if( $getTheRoleStatus[0]->userrole_id == '3' )
                @if( $getTheRoleStatus[0]->userstatus_id == '1' )
                    <div class="applynow"> 
                        <a class="btn-ApplyNow collegeProfileApplyNowBtn padding-right10" href="#courses">Apply Now</a>

                        <a class="btn-ApplyNow" data-toggle="modal" data-target="#queryStutoColModel" data-whatever="" href="javascript:void(0);"><i class="fa fa-envelope"></i> Quick Inquiry</a>
                    </div>
                @endif
            @endif
        @else
            <div class="applynow"> 
                <a class="btn-ApplyNow collegeProfileApplyNowBtn padding-right10" href="#courses">Apply Now</a>
                <a href="{{ URL::to('/query-search-login', $slugUrl) }}"  class="btn-ApplyNow"><i class="fa fa-envelope"></i> Quick Inquiry</a>
            </div>
        @endif
        
        <ul class="list-inline @if($agent->isMobile()) @else text-center pull-right @endif">
            @if( $getCollegeDetailObj )
                @foreach( $getCollegeDetailObj as $getCollegeName )
                    @if( $getCollegeName->review == '1' )
                        <li><a href="javascript:void(0);" class="badgesSize" title="This profile is successfully reviewed">
                            <img src="/home-layout/assets/img/icons/other/like.png" alt="like icon" width="32">
                        </a></li>
                    @else
                        <li><a href="javascript:void(0);" class="badgesSize" title="This profile is under review">
                            <img src="/home-layout/assets/img/icons/other/dislike.png" alt="dislike icon" width="32">
                        </a></li>
                    @endif

                    @if( $getCollegeName->verified == '0' )
                        <li><a href="javascript:void(0);" class="badgesSize" title="This profile is not verified">
                            <img src="/home-layout/assets/img/icons/other/envelope.png" alt="verified icon" width="32">
                        </a></li>
                    @endif
                @endforeach
            @endif
            <li>
            @if(isset($getBookMarkedCollegeStaus))
                @if( $getBookMarkedCollegeStaus )
                    <a href="javascript:void(0);" class="bookmarkedHeartIcon">
                        <input type="hidden" name="bookmarkTableID" value="{{ $getBookMarkedCollegeStaus[0]->id }}">
                        <input type="hidden" class="collegeName" name="collegeName" value="{{ $slugUrl }}">
                        <input type="hidden" name="collegeURL" value="{{ URL::to('college', $slugUrl) }}">
                        <span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
                            <i class="bookmarkHeart rounded-x icon-heart fa-2x"></i>
                        </span>
                    </a>
                @else
                    <a href="javascript:void(0);" class="collegeBookMarkButton">
                        <input type="hidden" class="collegeName" name="collegeName" value="{{ $slugUrl }}">
                        <input type="hidden" name="collegeURL" value="{{ URL::to('college', $slugUrl) }}">
                        <span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
                            <i class="bookmarkHeart rounded-x icon-heart fa-2x"></i>
                        </span>
                    </a>
                @endif                          
            @elseif(isset($getCourseBookmarkedStatus))
                @if( $getCourseBookmarkedStatus )
                    <a href="javascript:void(0);" class="bookmarkedHeartIcon">
                        <input type="hidden" name="bookmarkTableID" value="{{ $getCourseBookmarkedStatus[0]->id }}">
                        <input type="hidden" class="courseName" name="courseName" value="{{ $collegemasterId }}">
                        <input type="hidden" name="collegeURL" value="{{ URL::to('college/detail-course', [$collegemasterId,$slugUrl]) }}">
                        <span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
                            <i class="bookmarkHeart rounded-x icon-heart"></i>
                        </span>
                    </a>
                @else
                    <a href="javascript:void(0);" class="courseBookMarkButton">
                        <input type="hidden" class="courseName" name="courseName" value="{{ $collegemasterId }}">
                        <input type="hidden" name="collegeURL" value="{{ URL::to('college/detail-course', [$collegemasterId,$slugUrl]) }}">
                        <span title="The Featured showcase features some of the most popular colleges in each city across budgets and courses" class="white-bg">
                            <i class="bookmarkHeart rounded-x icon-heart"></i>
                        </span>
                    </a>
                @endif
            @endif
            </li>
        </ul>
    </div>
</div>
<div class="modal fade" id="queryStutoColModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => '/student-for-college', 'method' =>'POST','class' => 'sky-form' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
                <div class="modal-header modal-header-design" style="background: #d3070c;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Write a Query to "{{ $collegeFullName }}"</h4>
                    <input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
                </div>
                <div class="modal-body">
                    <div class="margin-bottom-20">
                        <label>Recipient</label>
                        <input class="form-control rounded-right" type="text" value="{{ $collegeFullName }}" disabled="">
                    </div>

                    <div class="margin-bottom-20">
                        <label>Subject</label>
                        <input class="form-control rounded-right" type="text" name="subject" maxlength="100" placeholder="Enter the subject" required="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subject" >
                    </div>
                    <div class="margin-bottom-20">
                        <label>Message</label>
                        <textarea class="form-control" rows="3" placeholder="Enter the message" name="message" required="" maxlength="250"></textarea>
                        <p class="text-danger margin-top-20">(Place your query in 250 characters. Thanks Team Admission X)</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn-u btn-block rounded">Submit</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>