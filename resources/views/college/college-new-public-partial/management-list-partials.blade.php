<div class="school-info section">
    <div class="section-title">
        <h3>Management Information</h3>
    </div>
    <div class="section-content">
        @if( sizeof($fetchCollegeManagementList) > 0 )
        <div class="row">
            @foreach( $fetchCollegeManagementList as $item )
                <div class="col-md-6">
                    <div class="row margin-bottom20 rating_reviews_info">
                        <div class="col-md-3">
                            <div class="padding-top10 padding-bottom10 padding-left10 padding-right10">
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa  fa-picture-o"></i> Profile Picture :  </label> <br>
                                    @if(!empty($item->picture))
                                        <img class="img-circle" src="{{ asset('gallery'.'/'.$slugUrl.'/'.$item->picture) }}" width="120" height="120" alt="{{ $item->name }} Profile Image">
                                    @else
                                        <img src="/assets/images/no-college-logo.jpg" style="width:100%;" alt="{{ $item->name }} Profile Image">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Name : 
                                    @if( $item->name )
                                        {{ $item->name }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-user"></i> Designation : 
                                    @if( $item->designation )
                                        {{ $item->designation }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-envelope"></i> Email : 
                                    @if( $item->emailaddress )
                                        {{ $item->emailaddress }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-phone"></i> Phone : 
                                    @if( $item->phoneno )
                                        {{ $item->phoneno }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa @if($item->gender == "1") fa-male @elseif($item->gender == "2") fa-female @elseif($item->gender == "3") fa-user @endif "></i> Gender : 
                                    @if($item->gender)
                                        @if($item->gender == "1") Male @elseif($item->gender == "2") Female @elseif($item->gender == "3") Other @endif
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-language"></i> Office No : 
                                    @if( $item->landlineNo )
                                        {{ $item->landlineNo }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <h5>No Management listed.</h5>
        @endif
    </div>
</div>