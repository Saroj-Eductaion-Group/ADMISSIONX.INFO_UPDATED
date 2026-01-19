@extends('website/new-design-layouts.master')

@section('content')
<div class="wrapper">
	<div class="container">

		<div class="parallax-bg parallaxBg1">
			<div class="container content parallax-about">
				<div class="title-box-v2">
					<!-- <h3><span class="color-green"> About AdmissionX</span></h3>
					<h2 class="title-v2 title-center margin-bottom-30"></h2>
					<p class="text-justify ">AdmissionX is a first of its kind platform based in New Delhi which helps connect students and institutions for the purpose of admission in different courses. Our portal is a repository of reliable data of over 31100 colleges, more than 50200 courses in over 4000 cities. Whether it is a Diploma course in Computing or a Bachelor’s course in Engineering or Masters Course in Management, Science or IT- we have it all. With the help of the provided information, students can get easy access to detailed information on colleges, admission criteria, eligibility, fees, scholarships and latest updates- all at one place.</p> -->
					@foreach($getPageContentDataObj as $item)
						@if($item->contentslug == 'about-admissionx')
						<h3><span class="color-green">{{ $item->title }}</span></h3>
						<h2 class="title-v2 title-center margin-bottom-30"></h2>
						<div class="textBlock">
							{!! $item->description !!}
						</div>
						@endif
					@endforeach
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="banner-info dark margin-bottom-10">
							<i class="rounded-x icon-bell"></i>
							<div class="overflow-h">
								<!-- <h3>Our Motto</h3>
								<p class="text-justify">We stand for “admission for all” and are developing an online platform where students from all over the country can connect with different institutions and take admission in courses of their choice. We realize that students and institutes both spend a considerable amount of time and money on the admission process.  Our aim is to make this process less time-consuming as well economical for them. We are trying to transform the way students take admission in our country, by making the process of admission as easy as we can.</p> -->
								@foreach($getPageContentDataObj as $item)
									@if($item->contentslug == 'our-motto')
									<h3>{{ $item->title }}</h3>
									{!! $item->description !!}
									@endif
								@endforeach
							</div>
						</div>
						<div class="banner-info dark margin-bottom-10">
							<i class="rounded-x fa fa-magic"></i>
							<div class="overflow-h">
								<!-- <h3>Our vision</h3>
								<p>We want every student that leaves school to have access to higher education in an efficient and affordable manner. We are trying to bridge the gap between colleges and students and bringing college admission within the reach of every student.  With an aim to cut down the role of the long admission process, the long line and hustle for the admission in colleges and other marketing channels which lead to high student acquisition cost - we are here trying to making the admission accessible, affordable and incredible!</p> -->
								@foreach($getPageContentDataObj as $item)
									@if($item->contentslug == 'our-vision')
									<input type="hidden" name="slug" value="{{ $item->contentslug }}">
									<h3>{{ $item->title }}</h3>
									{!! $item->description !!}
									@endif
								@endforeach
							</div>
						</div>
						<div class="margin-bottom-20"></div>
					</div>
					<div class="col-md-6">
						<img class="img-responsive" src="assets/img/main/img3.jpg" alt="about-us">						
					</div>
				</div>
				@foreach($getPageContentDataObj as $item)
					@if(($item->contentslug != 'about-us') && ($item->contentslug != 'our-motto') && ($item->contentslug != 'our-vision'))
						<div class="row">
							<div class="col-md-12">
								<div class="banner-info dark margin-bottom-10">
									<div class="overflow-h">
										<h3>{{ $item->title }}</h3>
										{!! $item->description !!}
									</div>
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div><!--/container-->
				
		</div>
		<div class="container content">
			<div class="row">
				<div class="col-md-6 shadow-wrapper">
					<div class="heading heading-v4">
						<h2 class="text-green-color">Student</h2>
					</div>
					<div class="responsive-video box-shadow shadow-effect-2">
						<!-- @if( !empty($getStudentYoutubeObj[0]->galleryName) )
							
							{{--*/ 
								$explodeYoutubeLink = explode('watch?v=', $getStudentYoutubeObj[0]->galleryName);
							/*--}}
							<iframe width="560" height="315" src="http://www.youtube.com/embed/{{$explodeYoutubeLink[1]}}" frameborder="0" allowfullscreen></iframe>
						@else
							<iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe>	
						@endif -->
						<iframe src="https://player.vimeo.com/video/217462459" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				</div>
				<div class="col-md-6 shadow-wrapper">
					<div class="heading heading-v4">
						<h2 class="text-green-color">College</h2>
					</div>
					<div class="responsive-video box-shadow shadow-effect-2">
						<!-- @if( !empty($getCollegesYoutubeObj[0]->galleryName) )
							
							{{--*/ 
								$explodeYoutubeLink = explode('watch?v=', $getCollegesYoutubeObj[0]->galleryName);
							/*--}}
							<iframe width="560" height="315" src="http://www.youtube.com/embed/{{$explodeYoutubeLink[1]}}" frameborder="0" allowfullscreen></iframe>	
						@else
							<iframe width="100%" src="//www.youtube.com/embed/4dmt7tQG1-w" frameborder="0" allowfullscreen></iframe>
						@endif -->		
						<iframe src="https://player.vimeo.com/video/217462695" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>			
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="parallax-counter-v1 parallaxBg">
		<div class="container">
			<h2 class="title-v2 title-light title-center">SOME FACTS AND SERVICES</h2>
			<p class="space-xlg-hor text-center color-light"></p>

			<div class="margin-bottom-40"></div>

			<div class="row margin-bottom-10">
				<div class="col-sm-4 col-xs-4">
					<div class="counters">
						<span class="counter">31100</span><span> +</span>
						<h4>Colleges Signed Up</h4>
					</div>
				</div>
				<div class="col-sm-4 col-xs-4">
					<div class="counters">
						<span class="counter">50200</span><span> +</span>
						<h4>Courses</h4>
					</div>
				</div>
				<div class="col-sm-4 col-xs-4">
					<div class="counters">
						<span class="counter">4000</span><span> +</span>
						<h4>Cities</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>


@endsection

@section('scripts')
	<!-- {!! Html::script('home-layout/assets/plugins/counter/waypoints.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/counter/jquery.counterup.min.js') !!}
	{!! Html::script('home-layout/assets/plugins/jquery.parallax.js') !!}
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('.counter').counterUp({
				delay: 10,
				time: 1000,
			});
		});
	</script> -->
@endsection