@extends('website/new-design-layouts.master')

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
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
							<div class="col-md-12">
								<h2>Website Analytics</h2>		
							</div>							
						</div>
					</div>
					<div class="wrapper wrapper-content animated bounceInRight">
						<div class="row">
					        <div class="col-lg-12">
					            <div class="ibox float-e-margins">
					                <div class="ibox-content text-center p-md">
					                    <h2><span class="text-navy">
					                    @if( $getCollegeProfileObj )
											@foreach( $getCollegeProfileObj as $item )
												{{ $item->firstname }}
											@endforeach
										@endif 
										 - Analytics</span>
					                    is provided with current <br>current status of your profile.</h2>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
					<hr class="hr-gap">
					<div class="row margin-bottom-10">
						<div class="col-sm-4 sm-margin-bottom-20">
							<div class="service-block-v3 service-block-u">
								<i class="icon-users"></i>
								<span class="service-heading">Overall College Visits</span>
								<span class="counter">{{ $getAllCollege }}</span>

								<div class="clearfix margin-bottom-10"></div>

								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Last 24 hours</small>
										<h4 class="counter">{{ $getAllLastTodayCollegeCounter }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Last Week</small>
										<h4 class="counter">{{ $getCurrentWeekCollege }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Current month</small>
										<h4 class="counter">{{ $getCurrentMonthCollege }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Last 3 months</small>
										<h4 class="counter">{{ $getCurrentThreeMonthCollege }}</h4>
									</div>
								</div>
							</div>
						</div>
					
						<div class="col-sm-4">
							<div class="service-block-v3 service-block-blue">
								<i class="icon-notebook"></i>
								<span class="service-heading">Overall Courses Views</span>
								<span class="counter">{{ $getAllCourseCounter }}</span>

								<div class="clearfix margin-bottom-10"></div>

								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Last 24 hours</small>
										<h4 class="counter">{{ $getAllLastTodayCourseCounter }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Last Week</small>
										<h4 class="counter">{{ $getCurrentWeekCourse }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Current month</small>
										<h4 class="counter">{{ $getCurrentMonthCourse }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Last 3 months</small>
										<h4 class="counter">{{ $getCurrentThreeMonthCourse }}</h4>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="service-block-v3 service-block-orange">
								<i class="icon-screen-desktop"></i>
								<span class="service-heading">Overall Application</span>
								<span class="counter">{{ $getAllApplicationCounter }}</span>

								<div class="clearfix margin-bottom-10"></div>

								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Last 24 hours</small>
										<h4 class="counter">{{ $getAllLastTodayApplicationCounter }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Last Week</small>
										<h4 class="counter">{{ $getCurrentWeekApplication }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Current month</small>
										<h4 class="counter">{{ $getCurrentMonthApplication }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Last 3 months</small>
										<h4 class="counter">{{ $getCurrentThreeMonthApplication }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div><!--/end row-->
					<hr class="hr-gap">
					<div class="row margin-bottom-10">
						<div class="col-sm-6">
							<div class="service-block-v3 service-block-brown">
								<i class="icon-notebook"></i>
								<span class="service-heading">Overall Query Views</span>
								<span class="counter">{{ $getAllCollegeQuery }}</span>

								<div class="clearfix margin-bottom-10"></div>

								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Pending Last 24 hours</small>
										<h4 class="counter">{{ $getAllTodayCollegeQueryPending }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Replied Last 24 hours</small>
										<h4 class="counter">{{ $getAllTodayCollegeQueryReply }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Pending Last Week</small>
										<h4 class="counter">{{ $getCurrentweekCollegeQueryPending }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Replied Last Week</small>
										<h4 class="counter">{{ $getCurrentweekCollegeQueryReply }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Pending Current month</small>
										<h4 class="counter">{{ $getCurrentMonthCollegeQueryPending }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Replied Current month</small>
										<h4 class="counter">{{ $getCurrentMonthCollegeQueryReply }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Pending Last 3 months</small>
										<h4 class="counter">{{ $getThreeMonthCollegeQueryPending }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Replied Last 3 months</small>
										<h4 class="counter">{{ $getThreeMonthCollegeQueryReply }}</h4>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="service-block-v3 service-block-aqua">
								<i class="icon-screen-desktop"></i>
								<span class="service-heading">Overall Application</span>
								<span class="counter">{{ $getAllApplicationCounter }}</span>

								<div class="clearfix margin-bottom-10"></div>

								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Approved Last 24 hours</small>
										<h4 class="counter">{{ $getAllAcceptTodayApplicationCounter }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Rejected Last 24 hours</small>
										<h4 class="counter">{{ $getAllRejectTodayApplicationCounter }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Approved Last Week</small>
										<h4 class="counter">{{ $getAllAcceptWeekApplicationCounter }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Rejected Last Week</small>
										<h4 class="counter">{{ $getAllRejectWeekApplicationCounter }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Approved Current month</small>
										<h4 class="counter">{{ $getMonthAcceptApplicationCounter }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Rejected Current month</small>
										<h4 class="counter">{{ $getMonthRejectApplicationCounter }}</h4>
									</div>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-xs-6 service-in">
										<small>Approved Last 3 months</small>
										<h4 class="counter">{{ $getThreeMonthAcceptApplCounter }}</h4>
									</div>
									<div class="col-xs-6 text-right service-in">
										<small>Rejected Last 3 months</small>
										<h4 class="counter">{{ $getThreeMonthRejectApplCounter }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div><!--/end row-->
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection
