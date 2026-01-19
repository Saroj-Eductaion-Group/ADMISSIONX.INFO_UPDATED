<div class="school-info section">
    <div class="section-title">
        <h3>College Courses</h3>
    </div>
    <div class="section-content">
        @if( sizeof($fetchCollegeCoursesObj) > 0 )
            @foreach( $fetchCollegeCoursesObj as $item )
                <div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
                    <div class="col-md-6">
                        <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
                            
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Stream : 
                                @if($item->functionalareaName)
                                    {{ $item->functionalareaName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Degree : 
                                @if($item->degreeName)
                                    {{ $item->degreeName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa fa-list"></i> Degree Level : 
                                @if($item->educationlevelName)
                                    {{ $item->educationlevelName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course Type : 
                                @if($item->coursetypeName)
                                    {{ $item->coursetypeName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course : 
                                @if($item->courseName)
                                    {{ $item->courseName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-calendar"></i> Course Duration : 
                                @if($item->courseduration)
                                    @if( $item->courseduration == '1')
                                        {{ $item->courseduration }}
                                    @else
                                        {{ $item->courseduration }}
                                    @endif
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
                            
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa fa-percent"></i> 12th Marks : 
                                @if($item->twelvemarks)
                                    {{ $item->twelvemarks }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Course Eligibility : 
                                @if( $item->others )
                                    {{ $item->others }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa fa-money"></i> Total Fees (per year) : 
                                Rs.
                                @if( $item->fees )
                                    {{ $item->fees }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa fa-ticket"></i> Seats : 
                                @if( $item->seats )
                                    {{ $item->seats }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <!-- <div>
                                <label class="font-noraml"><i class="fa-fw fa fa-ticket"></i> Seats Allocated To Admission X : 
                                @if( $item->seatsallocatedtobya == '0')
                                    <span class="label label-success">All Seats Full</span>
                                @elseif( $item->seatsallocatedtobya )
                                    {{ $item->seatsallocatedtobya }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div> -->
                            @if(!empty($item->degreeName) && !empty($item->courseName))
                            <ul class="list-inline padding-bottom5">
                                <li class="padding0">
                                    <a class="btn btn-info text-white btn-xs border-radius15" href="{{ url('college/detail-course/') }}/{{ $item->collegemasterId }}/{{ $slugUrl }}" target="_blank"><i class="fa fa-eye"></i> View Details</a>
                                </li>
                                @if($item->agreement == '1')
                                <li class="padding0">|</li>
                                <li class="padding0">
                                    <a class="btn btn-danger text-white btn-xs border-radius15" href="{{ url('college/detail-course/') }}/{{ $item->collegemasterId }}/{{ $slugUrl }}" target="_blank"><i class="fa fa-ticket"></i> Admission</a>
                                </li>
                                @endif
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="headline text-center">
                    <h4>College hasn't added their courses.</h4>
                </div>
            </div>
        @endif
    </div>
</div>