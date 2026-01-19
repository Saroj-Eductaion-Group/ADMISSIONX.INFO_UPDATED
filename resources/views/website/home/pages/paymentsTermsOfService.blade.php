@extends('website/new-design-layouts.master')

@section('content')
<style type="text/css">
	.termna-navbar{ width:unset !important; padding-top:4px !important; text-align:center;  }
	.termna-navbar  li{ display:inline !important; }
	.termna-navbar  li a{ display:inline-block !important;}
</style>
<!-- <div class="container  content-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12 md-margin-bottom-50">
			</div>
		</div>
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
          <ul class="nav navbar-nav termna-navbar">
			<li><a href="{{ URL::to('terms-of-service') }}">Terms Of Service</a></li>
			<li><a href="{{ URL::to('privacy-policy') }}">Privacy Policy</a></li>
			<li><a href="{{ URL::to('payments-refunds-policy') }}" class="active" style="color: #fff;">Payments & Refunds Policy</a></li>
			<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation & Refunds</a></li>
			<!-- <li><a href="{{ URL::to('student-referral-policy') }}">Student referral policy</a></li> -->
			<li><a href="{{ URL::to('admission-registration-policy') }}">Admission Registration Policy</a></li>
			<li><a href="{{ URL::to('advertiser-agreement') }}">Advertiser Agreement</a></li>
			@if(Auth::check())									
				{{--*/   $getLoggedObj = DB::table('users')
						->where('users.id', '=', Auth::id())
	                    ->where('users.userrole_id','=','2')
	                    ->select('users.id')
	                    ->take(1)
	                    ->get()
	                    ;
	        	/*--}}
	        	@if( $getLoggedObj )
	        	<li><a href="{{ URL::to('college-partner-agreement') }}">College Agreement</a></li>								
				@endif
			@endif
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
				<!-- <h4>Refunds</h4>
				<p>Customers agree that we follow a ‘No Refund Policy’ at www.admissionx.com Service providers agree that www.admissionx.com is not responsible for refunding the amount paid for acquiring the enlisting services under the varied packages on the website. The customer support team of www.admissionx.com should be approached in case of any feedback, complaint or suggestions. The Support Team will take responsibility for resolution of a problem within 15 days.</p>
				
				 -->
			</div><!--/row-fluid-->
		</div><!--/container-->
	</div>
</div>
			
@endsection


