<div class="school-info section">
    <div class="section-title">
        <h3>College Info</h3>
    </div>
    <div class="section-content">
        @if( $getCollegeDetailObj )
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">  
                @foreach(  $getCollegeDetailObj as  $item )
                    @if($item->description)
                        <h5 style="text-align: justify;">{{ $item->description }}</h5>                  
                    @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<div class="school-info section">
    <div class="section-title">
        <h3>College Highlights</h3>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-md-6">
                <table class="featured-table table table-striped">
                    <tbody>
                        @foreach($getCollegeDetailObj as  $collegeData)
                        <tr>
                            <td>University</td>
                            <td>
                                @if($collegeData->universityName)
                                    {{ $collegeData->universityName }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>College Type</td>
                            <td>
                                @if($collegeData->collegetypeName)
                                    {{ $collegeData->collegetypeName }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Approved By</td>
                            <td>
                                @if($collegeData->approvedBy)
                                    {{ $collegeData->approvedBy }}
                                @else 
                                --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Establishment Year</td>
                            <td>
                                @if($collegeData->estyear)
                                    {{ $collegeData->estyear }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>College Code</td>
                            <td>
                                @if($collegeData->collegecode)
                                    {{ $collegeData->collegecode }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Medium of Instruction</td>
                            <td>
                                @if($collegeData->mediumOfInstruction)
                                    {{ $collegeData->mediumOfInstruction }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Study From</td>
                            <td>
                                @if($collegeData->studyForm)
                                    {{ $collegeData->studyForm }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Study To</td>
                            <td>
                                @if($collegeData->studyTo)
                                    {{ $collegeData->studyTo }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="featured-table table table-striped">
                    <tbody>
                        @foreach($getCollegeDetailObj as  $collegeData)
                        <tr>
                            <td>Admission Start</td>
                            <td>
                                @if($collegeData->admissionStart)
                                    {{ $collegeData->admissionStart }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Admission End</td>
                            <td>
                                @if($collegeData->admissionEnd)
                                    {{ $collegeData->admissionEnd }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>CCTV Surveillance</td>
                            <td>
                                @if($collegeData->CCTVSurveillance == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>AC Campus</td>
                            <td>
                                @if($collegeData->ACCampus == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>No Of Student</td>
                            <td>
                                @if($collegeData->totalStudent)
                                    {{ $collegeData->totalStudent }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>No of Teachers</td>
                            <td>@if(isset($fetchCollegeManagementList)) {{sizeof($fetchCollegeManagementList)}} @else -- @endif</td>
                        </tr>
                        <tr>
                            <td>No of Courses</td>
                            <td>@if(isset($fetchCollegeCoursesObj)) {{sizeof($fetchCollegeCoursesObj)}} @else -- @endif</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>
                                @if($collegeData->website)
                                   <a href="{{ URL::to($collegeData->website) }}" target="_blank">Go to Website</a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="school-location section">
    <div class="section-title">
        <h3>College Address</h3>
    </div>
    <div class="section-content">
        <div class="row">
            <div class="col-md-6">
                <table class="featured-table table table-striped">
                    <tbody>
                        <h4>Registered College Address : </h4>
                        @foreach($getCollegeAddressObj as  $getAddress)
                            @if( $getAddress->addresstypeId  == '1' )
                            <tr>
                                <td>TItle</td>
                                <td>
                                    {{ $getAddress->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    {{ $getAddress->address1 }} {{ $getAddress->address2 }}
                                </td>
                            </tr>
                            <tr>
                                <td>Landmark</td>
                                <td>
                                    @if($getAddress->landmark)
                                        {{ $getAddress->landmark }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    @if($getAddress->cityName)
                                        {{ $getAddress->cityName }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>
                                    @if($getAddress->stateName)
                                        {{ $getAddress->stateName }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>
                                    @if($getAddress->countryName)
                                        {{ $getAddress->countryName }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>
                                    @if($getAddress->postalcode)
                                        {{ $getAddress->postalcode }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="featured-table table table-striped">
                    <tbody>
                        <h4>Campus College Address : </h4>
                        @foreach($getCollegeAddressObj as  $getAddress)
                            @if( $getAddress->addresstypeId  == '2' )
                            <tr>
                                <td>TItle</td>
                                <td>
                                    {{ $getAddress->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    {{ $getAddress->address1 }} {{ $getAddress->address2 }}
                                </td>
                            </tr>
                            <tr>
                                <td>Landmark</td>
                                <td>
                                    @if($getAddress->landmark)
                                        {{ $getAddress->landmark }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    @if($getAddress->cityName)
                                        {{ $getAddress->cityName }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>
                                    @if($getAddress->stateName)
                                        {{ $getAddress->stateName }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>
                                    @if($getAddress->countryName)
                                        {{ $getAddress->countryName }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>
                                    @if($getAddress->postalcode)
                                        {{ $getAddress->postalcode }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="school-activity-sports section">
    <div class="section-title">
        <h3>College Facilities</h3>
    </div>
    <div class="section-content">
           @if( $collegeFacilityDataObj )
            <div class="row">
                @foreach( $collegeFacilityDataObj as $item )
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                        <p class="tooltips" data-toggle="tooltip" data-placement="right" title="{{ $item->description }}">
                        <img src="/home-layout/assets/img/facility/{{ $item->iconname }}" width="32" alt="{{ $item->facilitiesName }} icon"> 
                        {{ $item->facilitiesName }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="school-activity-sports section">
    <div class="section-title">
        <h3>Sports & Activity</h3>
    </div>
    <div class="section-content">
        <p>Outdoor Sports</p>
        <ul>
            @foreach( $sportsActivityDataObj as $item )
                @if($item->typeOfActivity == 1)
                    <li>{{ $item->name }}</li>
                @endif
            @endforeach
        </ul>

        <p class="padding-top20">Indoor Sports</p>
        <ul>
            @foreach( $sportsActivityDataObj as $item )
                @if($item->typeOfActivity == 2)
                    <li>{{ $item->name }}</li>
                @endif
            @endforeach
        </ul>

        <p class="padding-top20">Co-curricular Activity</p>
        <ul>
            @foreach( $sportsActivityDataObj as $item )
                @if($item->typeOfActivity == 3)
                    <li>{{ $item->name }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
<div class="school-contact section">
    <div class="section-title">
        <h3>Contact Details</h3>
    </div>
    <div class="section-content">
        <div class="section-content">
            <table class="featured-table table table-striped">                    
                <tbody>
                    @foreach($getCollegeDetailObj as  $collegeData)
                        <tr>
                            <td>Contact Person / Administrator Officer Name</td>
                            <td>
                                @if($collegeData->contactpersonname)
                                    {{ $collegeData->contactpersonname }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Contact Person / Administrator Officer Email</td>
                            <td>
                                @if($collegeData->contactpersonemail)
                                    {{ $collegeData->contactpersonemail }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Contact Person / Administrator Officer Phone</td>
                            <td>
                                @if($collegeData->contactpersonnumber)
                                    {{ $collegeData->contactpersonnumber }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Website: </td>
                            <td>
                                @if($collegeData->website)
                                   <a href="{{ URL::to($collegeData->website) }}" target="_blank">Go to Website</a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if(sizeof($collegeGalleryImagesObj) > 0)
<div class="school-gallery section">
    <div class="section-title">
        <h3>College Gallery</h3>
    </div>
    <div class="section-content">
        <div class="school-carousel owl-theme">
            @foreach($collegeGalleryImagesObj as  $item)
                @if(file_exists(public_path().'/gallery/'.$slugUrl.'/'.$item->fullimage))
                {{--*/ 
                    $orientationGalleryImg = '';
                    $filenamePathGallery = $item->fullimage;
                    $filenameGallery = public_path().'/gallery/'.$slugUrl.'/'.$item->fullimage;
                    if (file_exists($filenameGallery) && (!empty($item->fullimage))) {
                        list($widthBlog, $heightBlog) = getimagesize($filenameGallery);
                        //echo "widthBlog:-".$widthBlog; echo "<br>"; echo "heightBlog:- ".$heightBlog; echo "<br>";
                        if ($widthBlog > $heightBlog) {
                            $filenamePathGallery = $item->galleryName;
                            //echo "landscape mode";
                            $orientationGalleryImg  = 'max-height: 300px;';
                        }else if ($widthBlog < $heightBlog) {
                            $filenamePathGallery = $item->fullimage;
                            //echo "portrait mode";
                            $orientationGalleryImg  = 'object-fit: contain; background: #dcdcdc; height: 300px;';
                        }else {
                            $orientationGalleryImg = 'max-height: 300px;';
                            $filenamePathGallery = $item->fullimage;
                        }
                    }
                /*--}}
                <div class="single-slide">
                    <div class="inner">
                       <img src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $filenamePathGallery }}" style="{{$orientationGalleryImg}}" alt="college gallery image">
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endif