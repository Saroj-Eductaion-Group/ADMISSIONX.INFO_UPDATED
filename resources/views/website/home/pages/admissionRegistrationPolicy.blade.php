@extends('website/new-design-layouts.master')

@section('content')

<style type="text/css">
	.termna-navbar{ width:unset !important; padding-top:4px !important; text-align:center;  }
	.termna-navbar  li{ display:inline !important; }
	.termna-navbar  li a{ display:inline-block !important;}
</style>

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
			<li><a href="{{ URL::to('payments-refunds-policy') }}">Payments & Refunds Policy</a></li>
			<li><a href="{{ URL::to('cancellation-refunds') }}">Cancellation & Refunds</a></li>
			<!-- <li><a href="{{ URL::to('student-referral-policy') }}">Student referral policy</a></li> -->
			<li><a href="{{ URL::to('admission-registration-policy') }}" class="active" style="color: #fff;">Admission Registration Policy</a></li>
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
				<!-- <ul>
					<li>The admission registration will be deemed void if any details provided by the student are false. It is then the institution’s discretion to accept or reject the application.</li><br />
					<li>The annual fee for the student for any academic year, during the entire course, will not exceed annual fee amount mentioned in the provisional admission letter.</li><br />
					<li>If the student fails to report to the institution for document verification and completing the remaining formalities, by the due date, then the provisional admission will be deemed void and any fee paid to AdmissionX shall be forfeited.</li><br />
					<li>At the time of booking admission online, the student pays Rs. 499 as a part of the annual fee of the institution. The institution agrees to deduct this amount from the 1st year fee chargeable to the student.</li><br />
					<li>The institution cannot deny admission to any student who is in possession of a valid provisional admission letter issued by AdmissionX. However, the institution has the right to deny admission to any student who appears after the due date.</li><br />
					<li>The student is NOT entitled to a refund of the amount paid to AdmissionX if they cancel their admission after the generation of the provisional admission letter. However, half the student is entitled to half refund minus transaction charges if he cancels the admission within 3 working days of applying for such admission.</li>
				</ul>
				<br /> -->
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


