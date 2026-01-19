@extends('website/new-design-layouts.master')

@section('content')
<div class="bg-color-light">
	<div class="container content-sm">
		
		<div class="row">
		<div class="headline "><h2>Our Testimonials</h2></div>
			<div class="col-md-9">
				@if( $getTestimonialDataObj )
					@foreach( $getTestimonialDataObj as $item )
					<div class="news-v3 bg-color-white margin-bottom-30">
						<!-- <img class="img-responsive " src="/testimonial/{{ $item->featuredimage }}" alt="{{ $item->featuredimage }}">
						<div class="news-v3-in">
							<ul class="list-inline posted-info">
								<li>By <a href="#">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</a></li>
								</ul>
							<h2 class="text-uppercase"><a href="{{ URL::to('testimonial', $item->testimonialsID) }}">{{ $item->title }}</a></h2>
							<p>{!! $s = substr($item->description, 0) !!}</p>
						</div> -->
						<div class="row clients-page">
							<div class="col-md-3">
								<img src="/testimonial/{{ $item->featuredimage }}" class="img-responsive hover-effect" alt="{{ $item->title }}">
							</div>
							<div class="col-md-9">
								<h3><a href="{{ URL::to('testimonial', $item->testimonialsID) }}">{{ $item->title }}</a></h3>
								<ul class="list-inline">
									
									<li><i class="fa fa-user color-green"></i> <a href="#">@if(!empty($item->firstname)) {{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }} @else {{$item->author}} @endif</a></li>
								</ul>
								<p>{!! $s = substr($item->description, 0) !!}</p>
							</div>
						</div>
					</div>
					@endforeach
				@endif
				
			</div>
			<div class="col-md-3">
				@if(sizeof($getTestimonialTopicDataObj) > 0)
				<div class="headline headline-md"><h2>Testimonials</h2></div>
				<ul class="list-unstyled blog-latest-posts margin-bottom-50">
					@foreach( $getTestimonialTopicDataObj as $testimonialTopic )
					<li>
						<h3><a href="{{ URL::to('/testimonial', $testimonialTopic->testimonialsID) }}">{{ $testimonialTopic->title }} <br>@if(!empty($testimonialTopic->firstname)) <i class="fa fa-user color-green"></i> {{ $testimonialTopic->firstname }} {{ $testimonialTopic->middlename }} {{ $testimonialTopic->lastname }} @else {{$testimonialTopic->author}} @endif</a> </h3>							
						<p>{!! $s = substr($testimonialTopic->description, 0, (75 - 3)) !!}</p>
					</li>
					@endforeach
				</ul>
				@endif

				<!-- <div class="headline headline-md"><h2>Newsletter</h2></div>
				<div class="blog-newsletter margin-bottom-40">
					<p>Subscribe to our newsletter for good news, sent out every month.</p>
					<form action="{{ URL::to('mailchimp-blogs') }}" method="POST" data-parsley-validate>
						<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="email" placeholder="Subscribe to our Newsletter" data-parsley-type="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
						<button class="btn-u btn-block margin-top10" type="submit">Subscribe</button>
					</form>					
				</div> -->
			</div>
		</div>
	</div>
</div>
		
@endsection
@section('scripts')


@endsection