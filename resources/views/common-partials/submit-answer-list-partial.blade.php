@extends('website/new-design-layouts.master')

@section('page-title-name')
Lists of Answer has been submitted on your behalf
@endsection

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
	<style type="text/css">
	.rating_reviews_info{background-color: #fff; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	</style>
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to($userroleslug.'/dashboard/edit/'.$slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-9">
								@if($userroleslug == 'college')
								<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
								@elseif($userroleslug == 'student')
								<h2>{!! App\Models\StudentProfile::getStudentName($slug) !!}</h2>
								@endif
								<span><strong>Answer has been submitted on your behalf</strong></span>
							</div>				
						</div>
					</div>
					<hr class="hr-gap">
					<div class="detail-page-signup margin-bottom40 table-responsive">
						<div class="headline"><h2>Here is the list of answer submitted by you</h2></div>
						<!-- Updated Course List -->
						@if( sizeof($listOfSubmitAnswers) > 0 )
							@foreach( $listOfSubmitAnswers as $item )
								<div class="row blog blog-medium margin-bottom-40 clientContactDetails">
									<div class="col-md-12">
										<h2>
											<span class="text-left">
												Question : @if($item->status == 1)<a  href="{{ URL::to('ask', $item->slug) }}" target="_blank">{!! $item->question !!}</a> @else {!! $item->question !!} @endif
											</span>
										</h2>
										<ul class="list-unstyled list-inline blog-info">
											<li><i class="fa fa-calendar"></i> {!! date('M d, Y', strtotime($item->questionDate)) !!}</li>
											<li><i class="fa fa-user"></i> {{ $item->fullname }}</li>
											<li><i class="fa fa-eye"></i> {{$item->views}} Views</li>
											<li><i class="fa fa-thumbs-up"></i> {{$item->likes}} Likes</li>
											<li><i class="fa fa-share-alt"></i> {{$item->share}} Share</li>
										</ul>
				                        <ul class="list-inline posted-info">
				                        	<i class="fa fa-tags"></i>
											@if($item->askQuestionTagIds) 
					                            @foreach( $item->tagname as $key1 => $item1 )
					                                <li class="margin-bottom10"> 
					                               	@if(!empty($item1->slug))
					                               		<a @if($item->status == 1) href="{{ URL::to('ask',['tags',$item1->slug]) }}" @else href="javascript:void(0);" @endif  title="{{ $item1->name }}"> <span class="label label-info rounded-2x margin-top5"> {{ $item1->name }} </span> </a>
					                               	@else
					                               		 <span class="label label-info rounded-2x margin-top5"> {{ $item1->name }} </span>
					                               	@endif
					                               	</li>
					                            @endforeach
					                        @endif 	
										</ul>						
										<p>
											<a class="btn btn-danger btn-md" @if($item->status == 1) href="{{ URL::to('ask', $item->slug) }}" @else href="javascript:void(0);" @endif>View More <i class="fa fa-angle-double-right margin-left-5" ></i></a>
											@if($item->totalAnswerCount > 0)
											<a class="btn btn-info btn-md" @if($item->status == 1) href="{{ URL::to('ask', $item->slug) }}" @else href="javascript:void(0);" @endif>View Total {{$item->totalAnswerCount}} Answers <i class="fa fa-eye margin-left-5" ></i></a>
											@endif
											@if($item->totalCommentsCount > 0)
											<a class="btn btn-warning btn-md" @if($item->status == 1) href="{{ URL::to('ask', $item->slug) }}" @else href="javascript:void(0);" @endif>View Total {{$item->totalCommentsCount}} Comments <i class="fa fa-eye margin-left-5" ></i></a>
											@endif
											<a class="btn btn-success btn-md" @if($item->status == 1) href="{{ URL::to('ask', $item->slug) }}" @else href="javascript:void(0);" @endif>Answer<i class="fa fa-plus margin-left-5" ></i></a>
										</p>
										<h4>
											<span class="text-left">
												Your Answer : @if($item->status == 1)<a  href="{{ URL::to('ask', $item->slug) }}" target="_blank">{!! $item->answer !!}</a> @else {!! $item->answer !!} @endif
											</span>
										</h4>
										<ul class="list-unstyled list-inline blog-info">
											<li><i class="fa fa-calendar"></i> Answer Date : {{ date('d F Y h:s a', strtotime($item->answerDate)) }}</li>
										</ul>
									</div>
								</div>
							@endforeach
							<div class="row indexPagination">
                				<div class="col-md-12 text-center">
                                <div class="custom-pagination">{!! $listOfSubmitAnswers->render() !!}</div>
	                            </div>
	                        </div>
						@else
							<h5>No Faculty listed.</h5>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection