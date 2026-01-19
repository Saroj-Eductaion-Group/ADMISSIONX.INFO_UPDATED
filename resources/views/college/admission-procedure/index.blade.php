@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Admission Procedure
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
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/dashboard/edit', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-9">
								<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
								<span><strong>Admission Procedure Lists</strong></span>
							</div>				
							<div class="col-md-3">
								<h2 class="text-right"><a class="btn btn-u" href="{{ URL::to('college/admission-procedure/'.$slug.'/create') }}" style="left: unset;bottom: unset;margin-left: unset;text-align: unset;position: unset;"><i class="fa fa-plus"></i> Create</a></h2>
							</div>
						</div>
					</div>
					<hr class="hr-gap">
					<div class="detail-page-signup margin-bottom40 table-responsive">
						<div class="headline"><h2>Manage Your College Admission Procedure Lists</h2></div>
						<!-- Updated Course List -->
						@if( sizeof($getAdmissionProcedureObj) > 0 )
							@foreach( $getAdmissionProcedureObj as $item )
								<div class="row margin-bottom20 rating_reviews_info">
						            <div class="col-md-9">
						                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
						                    <div>
							                    <label class="font-noraml"><i class="fa-fw fa  fa-list"></i> Title : 
							                	@if($item->title)
													{{ $item->title }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
							                    </label>
							                </div>
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
						                </div>
						            </div>
						            <div class="col-md-3">
						                <div class=" padding-top10  padding-left10 padding-right10">
						                    <div>
						                    	<ul class="list-inline padding-bottom5">
													<li class="padding0">
														<a class="btn btn-warning text-white btn-xs border-radius15" href="{{ URL::to('college/admission-procedure/'.$slug.'/edit/'.$item->id) }}"><i class="fa fa-pencil"></i> Edit</a>
													</li>
													<li class="padding0">|</li>
													<li class="padding0">
														<a class="btn btn-info text-white btn-xs border-radius15" href="{{ URL::to('college/admission-procedure/'.$slug.'/'.$item->id) }}"><i class="fa fa-eye"></i> Show</a>
													</li>
													<li class="padding0">|</li>
													<li class="padding0">
														<form method="POST" action="{{ URL::to('college/admission-procedure/'.$slug.'/remove/'.$item->id) }}">
															<button type="submit" class="btn btn-danger text-white btn-xs border-radius15" onclick="return confirm('Are you sure to delete this faculty member?')"><i class="fa fa-trash"></i> Delete</button>
														</form>
													</li>
												</ul>
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseImportantDates{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-info" title="view"><i class="fa fa-eye"></i> Important Dates</a>
						                    </div>
						                </div>
						            </div>
						            <div class="col-md-12">
						            	<div class="padding-bottom10 padding-left10 padding-right10">
					                        <label class="font-noraml"><i class="fa-fw fa fa-sticky-note"></i> Admission Procedure Details : </label>
					                        <br>
					                        @if($item->description)
					                            <span class="minimize2">{!! $item->description !!}</span>
					                        @else
					                            <span class="label label-warning">Not updated yet</span>
					                        @endif
					                    </div>
						            </div>
						        	@include('college/admission-procedure.important-dates-partial')
						        </div>
							@endforeach
							<div class="row indexPagination">
                				<div class="col-md-12 text-center">
                                <div class="custom-pagination">{!! $getAdmissionProcedureObj->render() !!}</div>
	                            </div>
	                        </div>
						@else
							<h5>No Admission Procedure listed.</h5>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection