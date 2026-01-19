@extends('website/new-design-layouts.master')

@section('styles')
@include('website.home.search-pages.search-field-partials.popular-career-search-style-partial')
@endsection

@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="examsentranceBoT">
					<h2 class="text-center padding-bottom15">Popular Career Courses List</h2>
					<div class="examsentranceInput">
						@include('website.home.search-pages.search-field-partials.popular-career-search-partial')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- choose stream start -->
<div class="chooseStreamMain">
	<div class="container">
		<div class="chooseStreamTop">
			<div class="row">
				<div class="col-md-12">
					<div class="chooseWhatNext">
						<h2>Hi, We found {{ $popularCareeerlist->total() }} popular careers courses details</h2>
					</div>
				</div>
			</div>
			<div class="row padding-top30">
				<div class="col-md-12">
					<div class="chooseStreamMech">
						@foreach( $popularCareeerlist as $item )
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
										{{ str_limit(strip_tags($item->description), 200) }}
									</p>
									<div class="selectMoreAbout">
										<a class="btn-lg" target="_blank" href="{{ URL::to('/popular-careers/'.$item->slug) }}">View More</a>
									</div>
								</div>
							</div>
						</div>
						<hr>
						@endforeach
					</div>
				</div>
			</div>
			<div class="row padding-top20 padding-bottom20">
              	<div class="col-xs-12">
					<div class="input_right_text text-center">
						<ul class="pagination">
							<li class="search_text">Search results</li>
							<li><a href="{{$popularCareeerlist->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
							<li class="active"><a href="javascript:void(0);">{{ $popularCareeerlist->lastItem() }}</a></li>
							<li class="search_text" style="width: auto;">of {{ $popularCareeerlist->total() }}</li>
							<li><a href="{{$popularCareeerlist->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
						</ul>
					</div>
              	</div>
            </div>
		</div>
	</div>
</div>
<!-- end choose stream -->


@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.popular-career-search-partial')
@endsection



