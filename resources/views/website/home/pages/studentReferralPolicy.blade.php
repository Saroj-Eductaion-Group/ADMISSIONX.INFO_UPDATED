@extends('website/new-design-layouts.master')

@section('content')

<!-- <div class="container  content-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12 md-margin-bottom-50">
			</div>
		</div>
	</div>
</div> -->

<!-- <div class="collapse navbar-collapse navbar-responsive-collapse navbar-inverse">
	<div class="res-container">
		<ul class="nav navbar-nav">
			<li><a href="{{ URL::to('terms-of-service') }}">Terms of service</a></li>
			<li><a href="{{ URL::to('privacy-policy') }}">Privacy policy</a></li>
			<li><a href="{{ URL::to('payments-terms-of-service') }}">Payments terms of service</a></li>
			<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation & Refunds</a></li>
			<li><a href="{{ URL::to('student-referral-policy') }}">Student referral policy</a></li>
			<li><a href="{{ URL::to('admission-registration-policy') }}">Admission registration policy</a></li>
		</ul>
	</div>
</div> -->
<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
			<li><a href="{{ URL::to('terms-of-service') }}">Terms Of Service</a></li>
			<li><a href="{{ URL::to('privacy-policy') }}">Privacy Policy</a></li>
			<li><a href="{{ URL::to('payments-refunds-policy') }}">Payments & Refunds Policy</a></li>
			<!-- <li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation & Refunds</a></li> -->
			<!-- <li><a href="{{ URL::to('student-referral-policy') }}" class="active" style="color: #fff;">Student Referral Policy</a></li> -->
			<li><a href="{{ URL::to('admission-registration-policy') }}">Admission registration policy</a></li>
			<li><a href="{{ URL::to('college-partner-agreement') }}">College Agreement</a></li>
			<li><a href="{{ URL::to('advertiser-agreement') }}">Advertiser Agreement</a></li>
		</ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
	<div class="col-md-12">
		<div class="container content">
			<div class="row-fluid privacy">
				@foreach($getPageContentDataObj as $item)
					<div class="overflow-h">
						<h3>{{ $item->title }}</h3>
						{!! $item->description !!}
					</div>
				@endforeach
			</div><!--/row-fluid-->
		</div><!--/container-->
	</div>
</div>
			
@endsection


