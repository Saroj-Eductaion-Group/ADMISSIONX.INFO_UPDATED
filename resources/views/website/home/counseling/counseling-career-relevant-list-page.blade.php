@extends('website/new-design-layouts.master')

@section('content')

<!-- choose stream start -->
<div class="chooseStreamMain">
	<div class="container">
		<div class="chooseStreamTop">
			<div class="row">
				<div class="col-md-12">
					<div class="chooseWhatNext">
						<h2>Hi, We found {{ $counselingCareerRelevant->total() }} careers relevant to you based on your stream & interest</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="choosestreamScience">
						<h2>Your Stream:
							<span>{{ ucfirst($stream) }}</span>
							&nbsp;&nbsp;
							<a href="{{ URL::to('/careers/opportunities/') }}">Change</a>
						</h2>
					</div>
				</div>
				<div class="col-md-7">
					<div class="choosestreamScience">
						<h2>Your Career Interest:
							<span>{{ ucfirst($careerInterest) }}</span>
							&nbsp;&nbsp;
							<a href="{{ URL::to('/careers/opportunities/'.$stream) }}">Change</a>
						</h2>
					</div>
				</div>
			</div>
			<div class="row padding-top30">
				<div class="col-md-12">
					<div class="chooseStreamMech">
						@foreach( $counselingCareerRelevant as $item )
						<div class="row">
							<div class="col-md-3">
								@if(!empty($item->image))
	      							<img class="" src="/counselingimages/{{ $item->image }}" alt="{{ $item->title }}" style="width:100%;">
	      						@else
									<img src="/assets/images/no-college-logo.jpg" style="width:100%;" alt="{{ $item->title }}">
	          					@endif
							</div>
							<div class="col-md-9">
								<div class="mechBusiness">
									<h2>{{$item->title}}</h2>	
									<p class="padding-top10">
										{{ str_limit(strip_tags($item->description), 280) }}
									</p>
									<ul class="padding-top15">
										@if(!empty($item->stream))
										<li>
											<a href="javascript:void(0);">
											<i style="color: red;" class="fa fa-book padding-right10" aria-hidden="true"></i>Std XII Stream: <span>{{$item->stream or ''}}</span></a>
										</li>
										@endif
										@if(!empty($item->mandatorySubject))
										<li>
											<a href="javascript:void(0);"><i style="color: red;" class="fa fa-pencil-square-o padding-right10" aria-hidden="true"></i>Mandatory Subjects: <span> {{$item->mandatorySubject or ''}}</span></a>
										</li>
										@endif
										@if(!empty($item->salery))
										<li>
											<a href="javascript:void(0);"><i style="color: red;" class="fa fa-money padding-right10" aria-hidden="true"></i>Salary: <span> <i class="fa fa-rupee" aria-hidden="true"></i> {{$item->salery or ''}}</span></a>
										</li>
										@endif
										@if(!empty($item->interestsTitle))
										<li>
											<a href="javascript:void(0);"><i style="color: red;" class="fa fa-graduation-cap padding-right10" aria-hidden="true"></i>Career Interest: <span>{{$item->interestsTitle or ''}}</span></a>
										</li>
										@endif
										@if(!empty($item->academicDifficulty))
										<li>
											<a href="javascript:void(0);"><i style="color: red;" class="fa fa-bell-o padding-right10" aria-hidden="true"></i>Academic Difficulty: <span>{{$item->academicDifficulty or ''}}</span></a>
										</li>
										@endif
									</ul>
									<div class="selectMoreAbout">
										<a class="btn-lg" target="_blank" href="{{ URL::to('/careers/opportunities/'.$stream.'/'.$item->slug) }}">More About {{$item->title}}</a>
									</div>
								</div>
							</div>
						</div>
						<hr>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end choose stream -->


@endsection

@section('scripts')
	
@endsection



