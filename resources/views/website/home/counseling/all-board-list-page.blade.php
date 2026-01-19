@extends('website/new-design-layouts.master')

@section('styles')
@include('website.home.search-pages.search-field-partials.board-search-style-partial')

<style type="text/css">
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
@endsection

@section('content')
@include('website.home.search-pages.search-field-partials.board-search-partial')
<!--explore category start-->
<div class="exploreCategory padding-top50 padding-bottom50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="exploreCategoryTop text-center padding-bottom15">
					<h2>explore examination boards</h2>
					<p class="padding-top5">BROWSE ({{ sizeof($nationalBoards) + sizeof($stateBoards) }}) BOARDS</p>	
				</div>
			</div>
		</div>
		<div class="row margin-top30 margin-bottom30">
			<div class="notificationTop margin-bottom20">
				<h2>National Boards</h2>
			</div>
			@foreach( $nationalBoards as $item )
			<div class="col-md-4">
				<div class="notificationBot clientContactDetails">
					<div class="row">
          				<div class="col-md-1 margin-left15" style="cursor: pointer;">
          					<div class="detailCoursebotIcon">
          						@if(!empty($item->image))
          						<a target="_blank" href="{{ URL::to('/board/national/'.$item->slug) }}">
          							<img class="" width="40" src="/counselingimages/{{ $item->image }}" width="120" alt="{{ $item->title }}">
          						</a>
          						@else
	          					<a target="_blank" href="{{ URL::to('/board/national/'.$item->slug) }}">
	          						<i class="fa fa-university"></i>
	          					</a>
	          					@endif
          					</div>
          				</div>
          				<div class="col-md-9">
          					<div class="detailCoursebotContent">
          						<a target="_blank" href="{{ URL::to('/board/national/'.$item->slug) }}">
          							<h2 style="font-size: 15px !important;">{{ $item->name }}</h2>
          						</a>		
          					</div>
          				</div>
          			</div>
					<h2 style="margin-top:0px; font-size: 12px !important;">{{$item->title}}</h2>
  					<div class="detailApplyNow text-center">
  						<a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/board/national/'.$item->slug) }}">VIew Details</a>
  					</div>
				</div>
			</div>
			@endforeach
		</div>	
		<div class="row margin-top30 margin-bottom30">
			<div class="notificationTop margin-bottom20">
				<h2>State Boards</h2>
			</div>
			@foreach( $stateBoards as $item )
			<div class="col-md-4" style="min-height: 200px;">
				<div class="notificationBot clientContactDetails">
					<div class="row">
          				<div class="col-md-1 margin-left15" style="cursor: pointer;">
          					<div class="detailCoursebotIcon">
          						@if(!empty($item->image))
          						<a target="_blank" href="{{ URL::to('/board/state/'.$item->slug) }}">
          							<img class="" width="40" src="/counselingimages/{{ $item->image }}" width="120" alt="{{ $item->title }}">
          						</a>
          						@else
	          					<a target="_blank" href="{{ URL::to('/board/state/'.$item->slug) }}">
	          						<i class="fa fa-university"></i>
	          					</a>
	          					@endif
          					</div>
          				</div>
          				<div class="col-md-9">
          					<div class="detailCoursebotContent">
          						<a target="_blank" href="{{ URL::to('/board/state/'.$item->slug) }}">
          							<h2 style="font-size: 15px !important;">{{ $item->name }}</h2>
          						</a>		
          					</div>
          				</div>
          			</div>
					<h2 style="margin-top:0px; font-size: 12px !important;">{{$item->title}}</h2>
  					<div class="detailApplyNow text-center">
  						<a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/board/state/'.$item->slug) }}">VIew Details</a>
  					</div>
				</div>
			</div>
			@endforeach
		</div>	
	</div>
</div>
<!--end explore category-->
@endsection
@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.examination-boards-search-partial')
@endsection