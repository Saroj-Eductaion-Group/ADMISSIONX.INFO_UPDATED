@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Transaction Lists
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
								<span><strong>Transaction Lists</strong></span>
							</div>				
						</div>
					</div>
					<hr class="hr-gap">
					<div class="detail-page-signup margin-bottom40 table-responsive">
						<div class="headline"><h2>Manage Your College Transaction Lists</h2></div>
						<!-- Updated Course List -->
						@if( sizeof($getApplicationsDataObj) > 0 )
							@foreach( $getApplicationsDataObj as $item )
								<div class="row margin-bottom20 rating_reviews_info">
						            <div class="col-md-9">
						                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa fa-list"></i> Application Id : 
						                        @if( $item->applicationID )
													<a  class="text-lightblue" href="{{ URL::to('college/application-detail', [$slug, $item->applicationID]) }}" title="View">{{ $item->applicationID }}</a>
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course Name : 
												@if( $item->courseName )
													<a  class="text-lightblue" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}" title="View">{{ $item->functionalareaName }} / {{ $item->degreeName }} / {{ $item->courseName }}</a>
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa fa-user"></i> Student Name : 
						                        @if( $item->userFirsrName )
													<a href="{{ URL::to('college/application-detail', [$slug, $item->applicationID]) }}">{{ ucfirst($item->userFirsrName) }} {{ $item->userMiddleName }} {{ $item->userLastName }}</a>
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa fa-flag"></i> Application Status : 
						                        @if( $item->applicationstatusId =='1' )
													@if( $item->paymentstatusID =='1' )
														<button class="btn-u btn-block btn-u-green btn-u-xs">{{ $item->applicationstatusName }}</button>
													@else
														<a  class="btn-u btn-block btn-u-yellow btn-u-xs text-light" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}">Pending</a>
													@endif
												@elseif( $item->applicationstatusId =='2' )
													<a  class="btn-u btn-block btn-u-yellow btn-u-xs text-light" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}">{{ $item->applicationstatusName }}</a>
												@elseif( $item->applicationstatusId =='3' )
													<button class="btn-u btn-block btn-u-aqua btn-u-xs">{{ $item->applicationstatusName }}</button>
												@else
													<button class="btn-u btn-u-red btn-block btn-u-xs">{{ $item->applicationstatusName }}</button>
												@endif
						                        </label>
						                    </div>
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa fa-calendar"></i> Application Date : 
						                        @if($item->created_at)
													{{ date('d F Y h:i a', strtotime($item->created_at)) }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
						                </div>
						            </div>
						            <div class="col-md-3">
						                <div class=" padding-top10 padding-bottom10 padding-left10 padding-right10">
						                    <div>
						                    	<a class="btn btn-info btn-sm btn-block" href="{{ URL::to('college/application-detail', [$slug, $item->id]) }}"><i class="fa fa-eye"></i> View Application Details</a>
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseTransactionHistory{{$item->id}}" aria-expanded="flase" class="btn-block btn btn-sm btn-warning" title="view"><i class="fa fa-exchange"></i> Transaction History</a>
						                    </div>
						                </div>
						            </div>
						        	@include('college.college-profile-partial.transaction-history')
						        </div>
							@endforeach
							<div class="row indexPagination">
                				<div class="col-md-12 text-center">
                                <div class="custom-pagination">{!! $getApplicationsDataObj->render() !!}</div>
	                            </div>
	                        </div>
						@else
							<h5>No Transaction Listed.</h5>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection