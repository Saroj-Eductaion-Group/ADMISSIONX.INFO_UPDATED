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
					<h2 class="text-center padding-bottom15">Careers Opportunities</h2>
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
					<h2>explore careers opportunities</h2>
					<p class="padding-top5">BROWSE ({{ sizeof($functionalAreaObj) }}) Careers Opportunities Stream</p>	
				</div>
			</div>
		</div>
		<div class="row margin-top30 margin-bottom30">
			<div class="notificationTop margin-bottom20">
				<h2>Careers Opportunities Stream</h2>
			</div>
			@foreach( $functionalAreaObj as $item )
			<div class="col-md-4">
				<div class="notificationBot clientContactDetails">
					<div class="row">
          				<div class="col-md-1 margin-left15" style="cursor: pointer;">
          					<div class="detailCoursebotIcon">
	          					<a target="_blank" href="{{ URL::to('/careers/opportunities/'.$item->pageslug) }}">
	          						<i class="fa fa-book"></i>
	          					</a>
          					</div>
          				</div>
          				<div class="col-md-9">
          					<div class="detailCoursebotContent">
          						<a target="_blank" href="{{ URL::to('/careers/opportunities/'.$item->pageslug) }}">
          							<h2 style="font-size: 15px !important;">{{ $item->name }}</h2>
          						</a>		
          					</div>
          				</div>
          			</div>
  					<div class="detailApplyNow text-center">
  						<a class="" style="display: inline-block; padding-left: 10px; padding-right: 10px;" target="_blank" href="{{ URL::to('/careers/opportunities/'.$item->pageslug) }}">VIew Details</a>
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
	
@endsection