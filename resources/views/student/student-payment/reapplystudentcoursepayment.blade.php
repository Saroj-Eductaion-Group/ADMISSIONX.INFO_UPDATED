@extends('website/new-design-layouts.master')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
{!! Html::style('home-layout/assets/css/shop.style.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style type="text/css">
	/* text-based popup styling */
	.white-popup {
	  position: relative;
	  background: #FFF;
	  padding: 25px;
	  width: auto;
	  max-width: 800px;
	  margin: 0 auto;
	}

	/* 

	====== Zoom effect ======

	*/
	.mfp-zoom-in {
	  /* start state */
	  /* animate in */
	  /* animate out */
	}
	.mfp-zoom-in .mfp-with-anim {
	  opacity: 0;
	  transition: all 0.2s ease-in-out;
	  transform: scale(0.8);
	}
	.mfp-zoom-in.mfp-bg {
	  opacity: 0;
	  transition: all 0.3s ease-out;
	}
	.mfp-zoom-in.mfp-ready .mfp-with-anim {
	  opacity: 1;
	  transform: scale(1);
	}
	.mfp-zoom-in.mfp-ready.mfp-bg {
	  opacity: 0.8;
	}
	.mfp-zoom-in.mfp-removing .mfp-with-anim {
	  transform: scale(0.8);
	  opacity: 0;
	}
	.mfp-zoom-in.mfp-removing.mfp-bg {
	  opacity: 0;
	}

	body.header-fixed-space-v2 {
	    padding-top: 114px;
	}

	.course-details { color: #000; }
</style>
@endsection

@section('content')
<div class="breadcrumbs-v4">
	<div class="container">
		<span class="page-name">Check Out</span>
		<h1>Book <span class="shop-green">Your</span> Admission</h1>				
	</div><!--/end container-->
</div>


<div class="content-md margin-bottom-30">
	<div class="container">
		<!-- <form class="shopping-cart" action="{!! env('PAYU_BASE_URL') !!}" method="POST"> -->
		<form class="shopping-cart" action="/student-payment-process-start/{{ $encryptApplicationId }}" method="POST" accept-charset="UTF-8">
			<section>
				<div class="row">
				
					<div class="col-md-12">
						<h2 class="title-type">Frequently asked questions For : <span class="shop-green">{{ $studentName }}</span></h2>
						<!-- Accordion -->
						<!--<div class="accordion-v2 plus-toggle">
							<div class="panel-group" id="accordion-v2">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion-v2" href="#collapseOne-v2">
												What payments methods can I use?
											</a>
										</h4>
									</div>
									<div id="collapseOne-v2" class="panel-collapse collapse in">
										<div class="panel-body">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseTwo-v2">
												Can I use gift card to pay for my purchase?
											</a>
										</h4>
									</div>
									<div id="collapseTwo-v2" class="panel-collapse collapse">
										<div class="panel-body">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseThree-v2">
												Will I be charged when I place my order?
											</a>
										</h4>
									</div>
									<div id="collapseThree-v2" class="panel-collapse collapse">
										<div class="panel-body">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseFour-v2">
												How long will it take to get my order?
											</a>
										</h4>
									</div>
									<div id="collapseFour-v2" class="panel-collapse collapse">
										<div class="panel-body">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, felis vel tincidunt sodales, urna metus rutrum leo, sit amet finibus velit ante nec lacus. Cras erat nunc, pulvinar nec leo at, rhoncus elementum orci. Nullam ut sapien ultricies, gravida ante ut, ultrices nunc.
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<!-- End Accordion -->
					<!-- </div>

					<div class="col-md-6"> -->
						<h2 class="title-type">Payment information</h2>
						<ul class=" total-result"><!-- list-inline -->
							<li>
								<h4>College Annual Fee:</h4>
								<div class="total-result-in">
									<span>Rs. {{ $totalFees }}/-</span>
								</div>
							</li>
							<li>
								<h4>Fee Payable To College For First Year:</h4>
								<div class="total-result-in">
									<span class="text-right">Rs. {{ $restfees }}/-</span>
								</div>
							</li>
							<li class="divider"></li>
							<li class="total-price">
								<h4>Total Amount Payable:</h4>
								<div class="total-result-in">
									<span>Rs. {{ $byafees }}/-</span>
								</div>
							</li>
						</ul>
						<div class="row margin-top20">
							<input type="hidden" name="currentApplicationID" value="{{ $currentApplicationID }}">

							<input type="hidden" name="key" value="{{ $key }}">
							<input type="hidden" name="hash" value="{{ $hash }}">
							<input type="hidden" name="txnid" value="{{ $txnid }}">
							<input type="hidden" name="amount" value="{{ $amount }}">
							<input type="hidden" name="productinfo" value="{{ $productinfo }}">
							<input type="hidden" name="firstname" value="{{ $firstname }}">
							<input type="hidden" name="email" value="{{ $email }}">
							<input type="hidden" name="phone" value="">
							<input type="hidden" name="surl" value="{{ $surl }}" size="64">
							<input type="hidden" name="furl" value="{{ $furl }}" size="64">
							<input type="hidden" name="service_provider" value="{{ $service_provider }}" size="64">
							

							<div class="col-md-6 pull-right"><button class="btn-u btn-block">Pay Now</button></div>
						</div>
					</div>
				</div>
			</section>
		</form>
	</div>
</div>

@endsection

@section('scripts')

{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

@endsection





