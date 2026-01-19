@extends('administrator/admin-layouts.master')

@section('content')
<style type="text/css">
    .detail-page-signup {
        color: #555;
        padding: 30px;
        background: #fefefe;
        border: solid 1px #eee;
        box-shadow: 0 0 3px #eee;
    }
    .bg-color-green1 {
        background-color: #2ecc71 !important;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Profile Details <a href="{{ url('administrator/collegeprofile/' . $collegeprofile->id . '/edit') }}" class="btn btn-primary pull-right btn-sm"><i class="fa fa-pencil"></i> Update College Profile</a></h2>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
                
            </div>
            <div class="ibox-content">                
               <!-- <a href="{{ url('administrator/collegeprofile') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->

                <div class="headline"><h2>College Information <a href="{{ url('administrator/collegeprofile/' . $collegeprofile->id . '/edit') }}" class="pull-right"><button type="submit" class="btn btn-primary btn-xs">Edit College Profile</button></a></h2></div>
                @if($collegeprofile->bannerimage != '')
                <div class="row margin-bottom10">
                    <div class="col-sm-12">
                        <label>College Banner Image</label>
                        <img class="img-thumbnail img-responsive" src="{{ asset('gallery') }}/{{ $collegeprofile->slug }}/{{ $collegeprofile->bannerimage }}">
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>College Profile ID</th>
                                    <td>{{ $collegeprofile->id }}</td> 
                                </tr>
                                <tr>
                                    <th>Last Updated By</th>
                                    <td>
                                        @if($collegeprofile->eUserId)
                                        <a href="{{ url('administrator/users', $collegeprofile->eUserId) }}">{{ $collegeprofile->employeeFirstname }} {{ $collegeprofile->employeeMiddlename}} {{ $collegeprofile->employeeLastname}} (ID:- {{ $collegeprofile->eUserId}}) Date & Time:-  {{ $collegeprofile->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{  $collegeprofile->created_at->format('F d,Y') }} at {{  $collegeprofile->created_at->format('h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>College Name</th>
                                    <td>
                                        @if( $collegeprofile->userID)
                                            <a href="{{ url('administrator/users') }}/{{ $collegeprofile->userID }}" title="{{ $collegeprofile->firstname }} {{ $collegeprofile->lastname }}">{{ $collegeprofile->firstname }} {{ $collegeprofile->lastname }} </a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>
                                        @if( $collegeprofile->description)
                                            {{ $collegeprofile->description }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                  <tr>
                                    <th>Est. Year</th>
                                    <td>
                                        @if( $collegeprofile->estyear)
                                            {{ $collegeprofile->estyear }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Approved By</th>
                                    <td>
                                        @if( $collegeprofile->approvedBy)
                                            {{ $collegeprofile->approvedBy }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>
                                        @if( $collegeprofile->website)
                                            {{ $collegeprofile->website }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                 <tr>
                                    <th>College Code</th>
                                     <td>
                                        @if( $collegeprofile->collegecode)
                                            {{ $collegeprofile->collegecode }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <!-- <tr class="hide">
                                    <th>Calender Info</th>
                                    <td>
                                        @if( $collegeprofile->calenderinfo)
                                            {{ $collegeprofile->calenderinfo }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr> -->
                                
                                <tr>
                                    <th>University Name</th>
                                     <td>
                                        @if( $collegeprofile->universityName)
                                            {{ $collegeprofile->universityName }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>College Type</th>
                                   <td>
                                        @if( $collegeprofile->collegetypeName)
                                            {{ $collegeprofile->collegetypeName }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Registered Address</th>
                                   <td>
                                        @if( $collegeprofile->addresstypeID == '1')
                                            @if( $collegeprofile->addressName )
                                                {{ $collegeprofile->addressName }}, {{ $collegeprofile->address1 }} {{ $collegeprofile->address2 }}, {{ $collegeprofile->cityName }}, {{ $collegeprofile->stateName }}, <strong>{{ $collegeprofile->countryName }}</strong>, {{ $collegeprofile->postalcode }}</span></p>
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif                                    
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Campus Address</th>
                                   <td>
                                        @if( $collegeProfile1->addresstypeID == '2')
                                            @if( $collegeProfile1->addressName )
                                                {{ $collegeProfile1->addressName }}, {{ $collegeProfile1->address1 }} {{ $collegeProfile1->address2 }}, {{ $collegeProfile1->cityName }}, {{ $collegeProfile1->stateName }}, <strong>{{ $collegeProfile1->countryName }}</strong>, {{ $collegeProfile1->postalcode }}</span></p>
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif
                                           
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Medium of Instruction</th>
                                    <td>
                                        @if($collegeprofile->mediumOfInstruction)
                                            {{ $collegeprofile->mediumOfInstruction }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Study From</th>
                                    <td>
                                        @if($collegeprofile->studyForm)
                                            {{ $collegeprofile->studyForm }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Study To</th>
                                    <td>
                                        @if($collegeprofile->studyTo)
                                            {{ $collegeprofile->studyTo }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Admission Start</th>
                                    <td>
                                        @if($collegeprofile->admissionStart)
                                            {{ $collegeprofile->admissionStart }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Admission End</th>
                                    <td>
                                        @if($collegeprofile->admissionEnd)
                                            {{ $collegeprofile->admissionEnd }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>CCTV Surveillance</th>
                                    <td>
                                        @if($collegeprofile->CCTVSurveillance == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>AC Campus</th>
                                    <td>
                                        @if($collegeprofile->ACCampus == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>No Of Student</th>
                                    <td>
                                        @if($collegeprofile->totalStudent)
                                            {{ $collegeprofile->totalStudent }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Social Media Links
                                    </th>
                                    <td>
                                        @if(sizeof($socialMediaLinksDataObj) > 0)
                                        <div class="school-social-link">
                                            @foreach( $socialMediaLinksDataObj as $key => $item)
                                                @if(!empty($item->url) && $item->isActive == 1) 
                                                    @if($item->other == 'Facebook')
                                                        <a class="padding20" title="Facebook" href="{{ $item->url }}" target="_blank"  alt="{{$item->other}}"><i class="fa fa-2x fa-facebook" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if($item->other == 'Twitter')
                                                        <a class="padding20" title="Twitter" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if($item->other == 'Instagram')
                                                        <a class="padding20" title="Instagram" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-2x fa-instagram" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if($item->other == 'Pinterest')
                                                      <a class="padding20" title="Pinterest" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-2x fa-pinterest" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if($item->other == 'Linkedin')
                                                        <a class="padding20" title="Linkedin" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-2x fa-linkedin" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if($item->other == 'Youtube')
                                                        <a class="padding20" title="Youtube" href="{{ $item->url }}" target="_blank" alt="{{$item->other}}"><i class="fa fa-2x fa-youtube-play" aria-hidden="true"></i></a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <p class="text-center">
                            @if( $galleryCollegeLogo )
                                <img src="{{ asset('gallery') }}/{{ $galleryCollegeLogo[0]->slug }}/{{ $galleryCollegeLogo[0]->fullimage }}" class="img-thumbnail img-responsive">
                            @else
                                <img src="{{asset('assets/images/')}}/no-college-logo.png" class="img-thumbnail img-responsive">
                            @endif
                        </p>                    
                        <p class="text-center">
                            <button class="btn btn-sm btn-info">Current College Status : {{ $collegeprofile->userstatusName }}</button>
                        </p>
                    </div>
                </div>

                <div class="headline"><h2>Authorized Person</h2></div>
                <table class="table table-bordered">
                    <tbody>
                       
                        <tr>
                            <th>Contact Person Name</th>
                            <td>
                                @if( $collegeprofile->contactpersonname)
                                    {{ $collegeprofile->contactpersonname }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Contact Person Emails</th>
                            <td>
                                @if( $collegeprofile->contactpersonemail)
                                    {{ $collegeprofile->contactpersonemail }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Contact Person Number</th>
                            <td>
                                @if( $collegeprofile->contactpersonnumber)
                                    {{ $collegeprofile->contactpersonnumber }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>

                <div class="headline"><h2>AdmissionX Reviewed</h2></div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Verified</th>
                            <td>
                                @if( $collegeprofile->verified == '1')
                                    Verified
                                @else
                                    Not Verified
                                @endif    
                            </td>
                        </tr>
                        <tr>
                            <th>Review</th>
                            <td>
                                @if( $collegeprofile->review == '1')
                                    Reviewed
                                @else
                                    Not Reviewed
                                @endif    
                            </td>
                        </tr>
                        <tr>
                            <th>Agreement</th>
                            <td>
                                @if( $collegeprofile->agreement == '1')
                                    Agreement Signed
                                @else
                                    No Agreement Signed
                                @endif    
                            </td>
                        </tr> 
                        <tr>
                            <th>Advertisement</th>
                            <td>
                                @if( $collegeprofile->advertisement == '1')
                                    Yes
                                @else
                                    No
                                @endif    
                            </td>
                        </tr>
                       <tr>
                            <th>Advertisement Time Frame Start Date</th>
                            <td>
                                @if( $collegeprofile->advertisementTimeFrame != 0000-00-00 && $collegeprofile->advertisementTimeFrame != '')
                                    {{ date('d-m-Y', strtotime($collegeprofile->advertisementTimeFrame)) }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Advertisement Time Frame End Date</th>
                            <td>
                                @if( $collegeprofile->advertisementTimeFrameEnd != 0000-00-00 && $collegeprofile->advertisementTimeFrameEnd != '')
                                    {{ date('d-m-Y', strtotime($collegeprofile->advertisementTimeFrameEnd)) }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>                   
                        <tr>
                            <th>Is Show On Top College</th>
                            <td>
                                @if( $collegeprofile->isShowOnTop == '1')
                                    <label class="label label-success">Enabled</label>
                                @else
                                    <label class="label label-warning">Disable</label>
                                @endif   
                            </td>
                        </tr>
                        <tr>
                            <th>Is Show On Home</th>
                            <td>
                                @if( $collegeprofile->isShowOnHome == '1')
                                    <label class="label label-success">Enabled</label>
                                @else
                                    <label class="label label-warning">Disable</label>
                                @endif    
                            </td>
                        </tr>
                    </tbody>                        
                </table>
                <div class="detail-page-signup">
                    <div class="row padding-top5 padding-bottom5">
                        <div class="col-md-12">
                            <div class="headline">
                                <h2>Rating & Reviews
                                    @if($collegeRatingObj[0]->totalLikes > 0)
                                        <span class="label label-success rounded"><i class="fa fa-thumbs-up"></i> {{$collegeRatingObj[0]->totalLikes}}</span>
                                    @endif
                                    @if($collegeRatingObj[0]->totalDislike > 0)
                                        <span class="label label-danger rounded"><i class="fa fa-thumbs-down"></i> {{$collegeRatingObj[0]->totalDislike}}</span>
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row bg-color-green1">
                        <div class="col-md-8">
                            <h4 class="h4">Based On {{ $collegeRatingObj[0]->totalCount}} Student Ratings Claim This College</h4>
                        </div>
                        <div class="col-md-4">
                            <h4 class="h4 text-right"> {{ $collegeRatingObj[0]->totlaUserRating }}/5</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="rating_reviews_block">
                                <h5>Academic</h5>
                                <h3>{{ round(($collegeRatingObj[0]->totalAcademicStar), 2)}} / 5</h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="rating_reviews_block">
                                <h5>Accommodation</h5>
                                <h3>{{ round(($collegeRatingObj[0]->totalAccommodationStar), 2)}} / 5</h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="rating_reviews_block">
                                <h5>Faculty</h5>
                                <h3>{{ round(($collegeRatingObj[0]->totalFacultyStar), 2)}} / 5</h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="rating_reviews_block">
                                <h5>Infrastructure</h5>
                                <h3>{{ round(($collegeRatingObj[0]->totalInfrastructureStar), 2)}} / 5</h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="rating_reviews_block">
                                <h5>Placement</h5>
                                <h3>{{ round(($collegeRatingObj[0]->totalPlacementStar), 2)}} / 5</h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="rating_reviews_block">
                                <h5>Social</h5>
                                <h3>{{ round(($collegeRatingObj[0]->totalSocialStar), 2)}} / 5</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="headline"><h2>Affiliation / Accreditation Letters</h2></div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th> Affiliation / Accreditation Letters</th>
                            <td>
                                @if( $getAffiliattionLettersObj )
                                <ol>
                                    @foreach( $getAffiliattionLettersObj as $item )
                                        <li>
                                            <a href="{{asset('gallery/')}}/{{ $item['slug'] }}/{{ $item['galleryFullImage'] }}" alt="{{ $item['galleryFullImage'] }}" download="Affiliation-Document"><i class="fa fa-angle-right"></i>
                                            @if( $item['caption'] )
                                                {{ $item['caption'] }}
                                            @else
                                                Click to download
                                            @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ol>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                         
                    </tbody>                        
                </table>
                <div class="hr-line-dashed"></div>
                <div class="headline"><h2>Photos & Videos</h2></div>
                <div class="row detail-page-signup">
                    @if( $getOldUploadedImages )
                        @foreach( $getOldUploadedImages as $item )
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="blockOnGalleryImg" style="background-image: url('{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->fullimage }}');">
                                    <a href="{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->fullimage }}" rel="gallery" class="fancybox img-hover-v1" title="{{ $item->caption }}">
                                        <span><img class="visibilityHiddenBlock" src="{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->galleryName }}" alt="" ></span>
                                    </a>    
                                </div>                  
                            </div>
                        @endforeach
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="headline text-center">
                                <h4>College hasn't uploaded their images.</h4>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="hr-line-dashed"></div>
                    @if( $getOldUploadedVideos )
                    <div class="row">
                        <hr>
                        <div class="col-md-12">
                            <div class="headline">
                                <h4>College videos</h4>
                            </div>
                            @foreach( $getOldUploadedVideos as $item )
                                <div class="col-md-4 margin-top20">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/{{ $item->galleryName }}" border="1"></iframe>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="hr-line-dashed"></div>
                <div class="headline"><h4>Awards &amp; Achivements Photos</h4></div>
                <div class="row detail-page-signup">
                    @if( $getCollegeDocumentImages )
                    <div class="col-md-12">
                        <div class="row">
                            @foreach( $getCollegeDocumentImages as $item )
                                @if( $item['documentsName'] )
                                    @if( $item['documentsName'] != 'no-image-upload' )
                                        @if( $item['ext'] != 'pdf' )
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                                <div class="blockOnGalleryImg" style="background-image: url('{{asset('document/')}}/{{ $item['slug'] }}/{{ $item['documentsName'] }}');">
                                                    <a href="{{asset('document/')}}/{{ $item['slug'] }}/{{ $item['documentsName'] }}" rel="gallery" class="fancybox img-hover-v1" title="">
                                                        <span><img class="visibilityHiddenBlock" src="{{asset('document/')}}/{{ $item['slug'] }}/{{ $item['documentsName'] }}" alt="" ></span>
                                                    </a>    
                                                </div>                  
                                            </div>
                                        @else
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                                <a href="{{asset('document/')}}/{{ $item['slug'] }}/{{ $item['documentsName'] }}" target="_blank" title="Click to view">
                                                    <img class="" src="{{asset('assets/images/pdf.png') }}" alt="{{ $item['documentsName'] }}" width="160" height="160">    
                                                </a> 
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="headline text-center">
                                <h4>College hasn't uploaded their documents yet.</h4>
                            </div>
                        </div>
                    </div>  
                    @endif
                </div>

                <div class="hr-line-dashed"></div>
                <div class="headline"><h4>Awards &amp; Achivements Description</h4></div>
                @if( $getOldUploadedDescription )
                <div class="row detail-page-signup margin-bottom40">        
                    <div class="col-md-12">
                        <ul>
                            @foreach( $getOldUploadedDescription as $item )
                                <li>{{ $item->description }}</li>
                                <hr class="hr-line-dashed"></hr>
                            @endforeach    
                        </ul>                        
                    </div>        
                </div>
                @endif
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>
@endsection

@section('script')


@endsection