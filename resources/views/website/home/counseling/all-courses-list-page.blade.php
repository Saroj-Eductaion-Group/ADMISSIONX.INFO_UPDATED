@extends('website/new-design-layouts.master')

@section('styles')
@include('website.home.search-pages.search-field-partials.course-search-style-partial')
<style type="text/css">
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
@endsection
@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="examsentranceBoT">
					<h2 class="text-center padding-bottom15">Counseling Courses List</h2>
					<div class="examsentranceInput">
						@include('website.home.search-pages.search-field-partials.course-search-partial')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--explore category start-->
<div class="exploreCategory padding-top50 padding-bottom50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="exploreCategoryTop text-center padding-bottom15">
					<h2>explore courses list</h2>
				</div>
			</div>
		</div>
		@foreach( $educationLevelObj as $item )
			<div class="row margin-top30 margin-bottom30 clientContactDetails">
				<div class="margin-bottom20">
					<h2>After {{$item->name}}</h2>
				</div>
				@foreach( $item->counselingCoursesObj as $item1 )
					<div class="col-md-4">
						<div class="notificationBot clientContactDetails">
							<div class="row">
		          				<div class="col-md-1 margin-left15" style="cursor: pointer;">
		          					<div class="detailCoursebotIcon">
		          						@if(!empty($item1->image))
		          						<a target="_blank" href="{{ URL::to('/careers-courses/'.$item->educationLevelSlug.'/'.$item1->slug) }}">
		          							<img class="" width="40" src="/counselingimages/{{ $item1->image }}" width="120" alt="{{ $item1->title }}">
		          						</a>
		          						@else
			          					<a target="_blank" href="{{ URL::to('/careers-courses/'.$item->educationLevelSlug.'/'.$item1->slug) }}">
			          						<i class="fa fa-book"></i>
			          					</a>
			          					@endif
		          					</div>
		          				</div>
		          				<div class="col-md-9">
		          					<div class="detailCoursebotContent">
		          						<a target="_blank" href="{{ URL::to('/careers-courses/'.$item->educationLevelSlug.'/'.$item1->slug) }}">
		          							<h2 style="font-size: 15px !important;">{{ $item1->title }}</h2>
		          						</a>		
		          					</div>
		          				</div>
		          			</div>
							<h2 style="margin-top:0px; font-size: 12px !important;">{{$item1->title}}</h2>
		  					<div class="detailApplyNow text-center">
		  						<a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/careers-courses/'.$item->educationLevelSlug.'/'.$item1->slug) }}">VIew Details</a>
		  					</div>
						</div>
					</div>
				@endforeach
			</div>	
		@endforeach
	</div>
</div>
<!--end explore category-->
@endsection
@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.course-search-partial')
@endsection