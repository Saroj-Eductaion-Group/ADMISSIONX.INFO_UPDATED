@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Faculty Details
@endsection

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
	<style type="text/css">
	.rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	</style>
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/faculty/', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-9">
								<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
								<span><strong>Faculty Details</strong></span>
							</div>				
							<div class="col-md-3">
								<h2 class="text-right"><a class="btn btn-u" href="{{ URL::to('college/faculty/'.$slug.'/create') }}" style="left: unset;bottom: unset;margin-left: unset;text-align: unset;position: unset;"><i class="fa fa-plus"></i> Create</a></h2>
							</div>
						</div>
					</div>
					<hr class="hr-gap">
					<div class="detail-page-signup margin-bottom40 table-responsive">
						<div class="headline"><h2>Faculty Details</h2> 
							<ul class="list-inline padding-bottom5 pull-right">
								<li>
									<a class="btn btn-warning text-white btn-xs border-radius15" href="{{ URL::to('college/faculty/'.$slug.'/edit/'.$getFacultyObj->id) }}"><i class="fa fa-pencil"></i> Edit</a>
								</li>
								<li> | </li>
								<li>
									<form method="POST" action="{{ URL::to('college/faculty/'.$slug.'/remove/'.$getFacultyObj->id) }}">
										<button type="submit" class="btn btn-danger text-white btn-xs border-radius15" onclick="return confirm('Are you sure to delete this faculty member?')"><i class="fa fa-trash"></i> Delete</button>
									</form>
								</li>
							</ul>
						</div>
						<!-- Updated Course List -->
						@if(!empty($getFacultyObj))
							<div class="row margin-bottom20 rating_reviews_info">
					            <div class="col-md-3">
					                <div class="padding-top10 padding-bottom10 padding-left10 padding-right10">
					                	<div>
					                        <label class="font-noraml"><i class="fa-fw fa  fa-picture-o"></i> Profile Picture :  </label> <br>
					                        @if(!empty($getFacultyObj->imagename))
												<img class="img-circle" src="{{ asset('gallery'.'/'.$slug.'/'.$getFacultyObj->imagename) }}" width="120" height="120">
											@else
												<img src="/assets/images/no-college-logo.jpg" style="width:100%;">
											@endif
					                    </div>
					                </div>
					            </div>
					            <div class="col-md-5">
					                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
					                	<h4 class=""><strong>Personal Information</strong></h4>
					                    <!-- <div>
					                        <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Suffix : 
					                        @if($getFacultyObj->suffix)
												{{ $getFacultyObj->suffix }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div> -->
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Name : 
					                        @if( $getFacultyObj->name )
												{{ $getFacultyObj->suffix }} {{ $getFacultyObj->name }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa fa-user"></i> Designation : 
											@if( $getFacultyObj->designation )
												{{ $getFacultyObj->designation }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa fa-envelope"></i> Email : 
					                        @if( $getFacultyObj->email )
												{{ $getFacultyObj->email }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa fa-phone"></i> Phone : 
					                        @if( $getFacultyObj->phone )
												{{ $getFacultyObj->phone }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa @if($getFacultyObj->gender == "1") fa-male @elseif($getFacultyObj->gender == "2") fa-female @elseif($getFacultyObj->gender == "3") fa-user @endif "></i> Gender : 
					                        @if($getFacultyObj->gender)
												@if($getFacultyObj->gender == "1") Male @elseif($getFacultyObj->gender == "2") Female @elseif($getFacultyObj->gender == "3") Other @endif
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa fa-calendar"></i> Date Of Birth : 
					                        @if($getFacultyObj->dob)
												{{ date('d F Y', strtotime($getFacultyObj->dob)) }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa fa-language"></i> Language Known : 
					                        @if( $getFacultyObj->languageKnown )
												{{ $getFacultyObj->languageKnown }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                </div>
					            </div>
					            <div class="col-md-4">
					                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
					                	<h4 class=""><strong>Address Information</strong></h4>
					                	<div>
		                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Address Line 1 : 
		                                    @if($getFacultyObj->addressline1)
		                                        {{ $getFacultyObj->addressline1 }}
		                                    @else
		                                        <span class="label label-warning">Not updated yet</span>
		                                    @endif
		                                    </label>
		                                </div>
		                                <div>
		                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Address Line 2 : 
		                                    @if($getFacultyObj->addressline2)
		                                        {{ $getFacultyObj->addressline2 }}
		                                    @else
		                                        <span class="label label-warning">Not updated yet</span>
		                                    @endif
		                                    </label>
		                                </div>
		                                <div>
		                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Landmark : 
		                                    @if($getFacultyObj->landmark)
		                                        {{ $getFacultyObj->landmark }}
		                                    @else
		                                        <span class="label label-warning">Not updated yet</span>
		                                    @endif
		                                    </label>
		                                </div>
		                                <div>
		                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> City : 
		                                    @if($getFacultyObj->cityName)
		                                        {{ $getFacultyObj->cityName }}
		                                    @else
		                                        <span class="label label-warning">Not updated yet</span>
		                                    @endif
		                                    </label>
		                                </div>
		                                <div>
		                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> State : 
		                                    @if($getFacultyObj->stateName)
		                                        {{ $getFacultyObj->stateName }}
		                                    @else
		                                        <span class="label label-warning">Not updated yet</span>
		                                    @endif
		                                    </label>
		                                </div>
		                                <div>
		                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Country : 
		                                    @if($getFacultyObj->countryName)
		                                        {{ $getFacultyObj->countryName }}
		                                    @else
		                                        <span class="label label-warning">Not updated yet</span>
		                                    @endif
		                                    </label>
		                                </div>
		                                <div>
		                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Pincode : 
		                                    @if($getFacultyObj->pincode)
		                                        {{ $getFacultyObj->pincode }}
		                                    @else
		                                        <span class="label label-warning">Not updated yet</span>
		                                    @endif
		                                    </label>
		                                </div>
					                </div>
					            </div>
					            <hr>	
								<div class="col-md-12">
								    <div class="white-bg">
							            <div class="panel-body">
							                <h4 class=""><strong>Qualification Details</strong></h4>
							                @if(sizeof($qualificationsObj) > 0)
							                <div class="ibox-content table-responsive">
							                    <table class="table table-hover table-bordered table-striped">
							                        <thead>
							                            <tr>
							                                <th>Qualification</th>
							                                <th>Course</th>
							                                <th>Subject</th>
							                                <th>Passing Year</th>
							                                <th>College Name</th>
							                                <th>Board Name</th>
							                            </tr>
							                        </thead>
							                        <tbody>
							                            @foreach($qualificationsObj as $key1 => $item1)
							                            <tr>
							                                <td>{{ $item1->qualification }}</td>
							                                <td>{{ $item1->course }}</td>
							                                <td>{{ $item1->subjects }}</td>
							                                <td>{{ $item1->year }}</td>
							                                <td>{{ $item1->collegename }}</td>
							                                <td>{{ $item1->boardName }}</td>
							                            </tr>
							                            @endforeach
							                        </tbody>
							                    </table>
							                </div>
							                @else
							                <div class="profile-bio">
							                    <div class="row">
							                        <div class="col-md-12">
							                            <div class="headline text-center">
							                                <h2 class="">No Faculty Qualification Added...</h2>
							                            </div>
							                        </div>                          
							                    </div>
							                </div>
							                @endif
							            </div>
								    </div>
								</div>
								<hr>
								<div class="col-md-12">
								    <div class="white-bg">
							            <div class="panel-body">
							                <h4 class=""><strong>Experience Details</strong></h4>
							                @if(sizeof($experienceObj) > 0)
							                <div class="ibox-content table-responsive">
							                    <table class="table table-hover table-bordered table-striped">
							                        <thead>
							                            <tr>
							                                <th>Organization Name</th>
							                                <th>Role</th>
							                                <th>Form Year</th>
							                                <th>To Year</th>
							                                <th>City</th>
							                            </tr>
							                        </thead>
							                        <tbody>
							                            @foreach($experienceObj as $key1 => $item2)
							                            <tr>
							                                <td>{{ $item2->organisation }}</td>
							                                <td>{{ $item2->role }}</td>
							                                <td>{{ $item2->fromyear }}</td>
							                                <td>{{ $item2->toyear }}</td>
							                                <td>{{ $item2->city }}</td>
							                            </tr>
							                            @endforeach
							                        </tbody>
							                    </table>
							                </div>
							                @else
							                <div class="profile-bio">
							                    <div class="row">
							                        <div class="col-md-12">
							                            <div class="headline text-center">
							                                <h2 class="">No Faculty Experience Added...</h2>
							                            </div>
							                        </div>                          
							                    </div>
							                </div>
							                @endif
							            </div>
								    </div>
								</div>
								<hr>
								<div class="col-md-12">
								    <div class="white-bg">
							            <div class="panel-body">
							                <h4 class=""><strong>List of all the departments with which you are connected</strong></h4>
							                @if(sizeof($facultyDepartmentObj) > 0)
							                <div class="ibox-content table-responsive">
							                    <table class="table table-hover table-bordered table-striped">
							                        <thead>
							                            <tr>
							                                <th>Stream</th>
							                                <th>Degree</th>
							                                <th>Course</th>
							                                <th>Degree Level</th>
							                                <th>Course Type</th>
							                            </tr>
							                        </thead>
							                        <tbody>
							                            @foreach($facultyDepartmentObj as $key1 => $item3)
							                            <tr>
							                                <td>{{ $item3->functionalareaName }}</td>
							                                <td>{{ $item3->degreeName }}</td>
							                                <td>{{ $item3->courseName }}</td>
							                                <td>{{ $item3->educationlevelName }}</td>
							                                <td>{{ $item3->coursetypeName }}</td>
							                            </tr>
							                            @endforeach
							                        </tbody>
							                    </table>
							                </div>
							                @else
							                <div class="profile-bio">
							                    <div class="row">
							                        <div class="col-md-12">
							                            <div class="headline text-center">
							                                <h2 class="">No Faculty Associate Department Added...</h2>
							                            </div>
							                        </div>                          
							                    </div>
							                </div>
							                @endif
							            </div>
								    </div>
								</div>
					        </div>
						@else
							<h5>Faculty Detaails Not Found.</h5>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection