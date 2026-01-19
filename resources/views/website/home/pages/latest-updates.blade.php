@extends('website/new-design-layouts.master')

@section('styles')
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
					<h2 class="text-center padding-bottom15">Latest Updates </h2>
				</div>
			</div>
		</div>
	</div>
</div>
<!--explore category start-->
<div class="exploreCategory padding-top50 padding-bottom50">
	<div class="container">
		<div class="row margin-top30 margin-bottom30">
			<div class="notificationTop margin-bottom20">
				<h2>All Latest Updates</h2>
			</div>
			@foreach( $latestUpdates as $item )
			<div class="col-md-6 margin-bottom20">
				<div class="notificationBot clientContactDetails">
  					<div class="detailCoursebotContent">
  						<p style="color: #000;">{{$item->desc}}</p>
            			<span style="color: red;" class="padding-left15">{{$item->name}}</span>, <span style="color: red;">{{ date('F dS Y', strtotime($item->date)) }}</span>	
  					</div>
				</div>
			</div>
			@endforeach
		</div>	
		<div class="row padding-top20 padding-bottom20">
	      	<div class="col-xs-12">
				<div class="input_right_text text-center">
					<ul class="pagination">
						<li class="search_text">Search results</li>
						<li><a href="{{$latestUpdates->appends(\Input::except('page'))->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a></li>
						<li class="active"><a href="javascript:void(0);">{{ $latestUpdates->lastItem() }}</a></li>
						<li class="search_text" style="width: auto;">of {{ $latestUpdates->total() }}</li>
						<li><a href="{{$latestUpdates->appends(\Input::except('page'))->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a></li>
					</ul>
				</div>
	      	</div>
	    </div>
	</div>
</div>
<!--end explore category-->
@endsection
@section('scripts')
	
@endsection