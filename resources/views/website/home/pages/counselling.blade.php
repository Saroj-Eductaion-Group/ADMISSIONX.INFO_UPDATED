@extends('website/new-design-layouts.master')
@section('styles')
<style type="text/css">
	/*FAQ-page
------------------------------------*/
.faq-breadcrumb {
	text-align: center;
	position: relative;
	background: url(assets/img/sliders/10.jpg) no-repeat center;
}

.faq-breadcrumb:before {
	left: 0;
	width: 100%;
	height: 100%;
	content: " ";
	position: absolute;
	background: rgba(0,0,0,0.3);
}

.faq-page .tab-v1 {
	margin-top: 19px;
}

/*.faq-page .tab-v1  .panel-title {
	text-transform: uppercase;
}*/

/*Check-style*/
.faq-page .check-style {
	margin-bottom: 0;
}

.faq-page .check-style li {
	margin-bottom: 10px;
}
.faq-page .check-style li:last-child {
	margin-bottom: 0;
}

.faq-page .check-style i {
	font-size: 18px;
	font-weight: 600;
	vertical-align: middle;
}

/*Check-style in Responsive*/
@media (max-width: 450px) {
	.faq-page .main-check .col-xs-6 {
		width: 100%;
	}
}

/*Faq-add*/
.faq-page .faq-add {
	padding: 15px;
	margin-bottom: 20px;
	border: 2px solid #eee;
}

.faq-page .top-part i {
	float: left;
	color: #777;
	font-size: 20px;
	padding-top: 3px;
	margin-right: 10px;
}

.faq-page .new-title {
	color: #72c02c;
	font-size: 18px;
	margin-bottom: 5px;
}

.faq-page .faq-add p {
	line-height: 1.5;
}

/*ParallaxBg6
------------------------------------*/
/*Title-Box*/
.faq-bg .title-box-v2 h2,
.faq-bg .title-box-v2 p {
	color: #fff;
}

/*Contact Pages
------------------------------------*/
.map {
	width: 100%;
	height: 350px;
	border-top: solid 1px #eee;
	border-bottom: solid 1px #eee;
}

.map-box {
	height: 250px;
}

.map-box-space {
	margin-top: 15px;
}

.map-box-space1 {
	margin-top: 7px;
}


</style>
@endsection
@section('content')

<!-- <div class="container  content-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12 md-margin-bottom-50">
				
			</div>
		</div>
	</div>
</div> -->
		
@if(Session::has('confirmHelpCenter'))
<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
	<strong>{{ Session::get('confirmHelpCenter') }}</strong>
</div>
@endif
<div class="breadcrumbs-v2 faq-breadcrumb margin-bottom-20">
	<div class="breadcrumbs-v2-in">
		<h1>Career Counselling</h1>
		<!-- <ul class="breadcrumb-v2 list-inline">
			<li><a href="#"><i class="rounded-x fa fa-angle-right"></i>Home</a></li>
			<li><a href="#"><i class="rounded-x fa fa-angle-right"></i>Page</a></li>
			<li class="active"><i class="rounded-x fa fa-angle-right"></i>F.A.Q</li>
		</ul> -->
	</div>
</div>

<div class="container content faq-page">

	<!-- FAQ Content -->
	<div class="row">
		<!-- Begin Tab v1 -->
		<div class="col-md-12">
			<div class="tab-v1">
				<ul class="nav nav-tabs margin-bottom-20">
					@foreach($getPageContentDataObj as $key => $item)
						<li class="@if($key == 0) active @endif"><a data-toggle="tab" href="#counselling{{$key}}">{{ $item->title }}</a></li>
					@endforeach
				</ul>
				<div class="tab-content">
					@foreach($getPageContentDataObj as $key => $item)
						<div id="counselling{{$key}}" class="tab-pane fade @if($key == 0) in active @endif">
							<div id="accordion-v1" class="panel-group acc-v1">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a href="#collapse-One" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
												{{ $item->title }}
											</a>
										</h4>
									</div>
									<div class="panel-collapse collapse in" id="collapse-One">
										<div class="panel-body">
											{!! $item->description !!}
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div><!--/col-md-6-->
		<!--End Tab v1-->
	</div>
	<!-- End FAQ Content -->
</div>

@endsection

			