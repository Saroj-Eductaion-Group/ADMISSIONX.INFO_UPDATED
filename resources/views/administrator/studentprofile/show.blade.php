@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Student Profile Details <!-- <a href="{{ url('administrator/studentprofile/create') }}" class="btn btn-primary pull-right btn-sm">Add New Student Profile</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/studentprofile') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <div class="row">
                   <div class="col-md-8">
                       <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <th>ID</th>
                                    <td>{{ $studentprofile->id }}</td> 
                                </tr>
                                 <tr>
                                    <th>Last Updated By</th>
                                    <td>
                                        @if($studentprofile->eUserId)
                                        <a href="{{ url('administrator/users', $studentprofile->eUserId) }}">{{ $studentprofile->employeeFirstname }} {{ $studentprofile->employeeMiddlename}} {{ $studentprofile->employeeLastname}} (ID:- {{ $studentprofile->eUserId}}) Date & Time:-  {{ $studentprofile->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{  $studentprofile->created_at->format('F d,Y') }} at {{  $studentprofile->created_at->format('h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Student Name</th>
                                    <td>
                                        <a href="{{ url('administrator/users') }}/{{ $studentprofile->userID }}" title="{{ $studentprofile->firstname }} {{ $studentprofile->lastname }}">{{ $studentprofile->firstname }} {{ $studentprofile->lastname }} </a>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>Parents Name</th>
                                    <td>{{ $studentprofile->parentsname }} </td>
                                </tr>
                                <tr>
                                    <th>Phone No</th>
                                    <td>{{ $studentprofile->parentsnumber }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $studentprofile->gender }}</td>
                                </tr>
                                <tr>
                                    <th>D.O.B</th>
                                    <td>{{ date('M d, Y', strtotime($studentprofile->dateofbirth)) }}</td>
                                </tr>
                                <tr> 
                                    <th>Hobbies</th>
                                    <td>{{ $studentprofile->hobbies }}</td>
                                </tr>
                                <tr>
                                    <th>Interests</th>
                                    <td>{{ $studentprofile->interests }}</td>
                                </tr>
                                <tr>
                                    <th>Entrance Exam Name</th>
                                    <td>
                                        @if( $studentprofile->entranceexamname)
                                            {{ $studentprofile->entranceexamname }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Entrance Exam No/Rank/Percentage</th>
                                     <td>
                                        @if( $studentprofile->entranceexamnumber)
                                            {{ $studentprofile->entranceexamnumber }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Achievements Awards</th>
                                    <td>{{ $studentprofile->achievementsawards }}</td>
                                </tr>
                                <tr>
                                    <th>Projects</th>
                                    <td>{{ $studentprofile->projects }}</td>
                                </tr>
                                <tr>
                                    <th>Permanent Address</th>
                                   <td>
                                        @if( $studentprofile->addresstypeID == '3')
                                            @if( $studentprofile->addressName )
                                                {{ $studentprofile->addressName }}, {{ $studentprofile->address1 }} {{ $studentprofile->address2 }}, {{ $studentprofile->cityName }}, {{ $studentprofile->stateName }}, <strong>{{ $studentprofile->countryName }}</strong>, {{ $studentprofile->postalcode }}</span></p>
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif                                    
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Present Address</th>
                                   <td>
                                        @if( $studentprofile1->addresstypeID == '4')
                                            @if( $studentprofile1->addressName )
                                                {{ $studentprofile1->addressName }}, {{ $studentprofile1->address1 }} {{ $studentprofile1->address2 }}, {{ $studentprofile1->cityName }}, {{ $studentprofile1->stateName }}, <strong>{{ $studentprofile1->countryName }}</strong>, {{ $studentprofile1->postalcode }}</span></p>
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif
                                           
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                
                                
                            </tbody>                        
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Marks - Percentage</th>
                                    <th>Marks Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $getStudentmarksObj as $item )
                                <tr>
                                    <th>{{ $item->marksName }}</th>
                                    <td>{{ $item->marks }} - {{ $item->percentage }}%</td>
                                    <td>{{ $item->studentMarkType }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                   </div>
                   <div class="col-md-4">
                       <p class="text-center"><img class="img-thumbnail img-responsive" src="{{ asset('gallery') }}/{{ $studentprofile->slug }}/{{ $studentprofile->fullimage }}"></p>
                       <p class="text-center"><button class="btn btn-info">Student Status : {{ $studentprofile->userstatusName }}</button></p>
                   </div>
               </div>
                <div class="hr-line-dashed"></div>
                <div class="headline"><h4>Academic Records</h4></div>
                <div class="row detail-page-signup">
                    @if( $getStudentDocumentImages )
                    <div class="col-md-12">
                        <div class="row">
                            @foreach( $getStudentDocumentImages as $item )
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
                                <h4>Student hasn't uploaded their documents yet.</h4>
                            </div>
                        </div>
                    </div>  
                    @endif
                </div>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>

@endsection