@extends('website/new-design-layouts.master')

@section('content')
<div class="bg-color-light">
	<div class="container content-sm">
		
		<div class="row">
		<div class="headline "><h2>Our Testimonials</h2></div>
			<div class="col-md-12">
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
							<div class="col-md-2">
								<img src="/testimonial/{{ $item->featuredimage }}" class="img-responsive hover-effect" alt="{{ $item->title }}">
							</div>
							<div class="col-md-10">
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
		</div>
	</div>
</div>
		
@endsection
@section('scripts')


@endsection