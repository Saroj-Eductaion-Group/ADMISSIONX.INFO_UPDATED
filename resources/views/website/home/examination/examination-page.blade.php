@extends('website/new-design-layouts.master')
@section('styles')
@include('website.home.search-pages.search-field-partials.exam-search-style-partial')
@endsection
@section('content')
<!-- entrance exams start -->
<div class="examsentranceTop padding-top60 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('website.home.search-pages.search-field-partials.exam-search-partial')
			</div>
		</div>
	</div>
</div>
<!-- end entrance exams -->

<!--explore category start-->
<div class="exploreCategory padding-top50 padding-bottom50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="exploreCategoryTop text-center padding-bottom15">
					<h2>explore Category</h2>
					<p class="padding-top5">BROWSE {{$listofexaminationCount}}+ ENTRANCE EXAMS</p>	
				</div>
			</div>
		</div>
		<div class="row explorecat-main margin-top30 margin-bottom30">
			@foreach($examsection as $key => $item)
			<a href="{{ URL::to('/examination-list/'.$item->slug) }}">
			<div class="col-md-6 exploreCategorybotEngg margin-top15 margin-bottom15">
				<div class="row">
					<div class="exploreCategorybot margin-right10">
						<div class="col-md-4">
							<div class="exploreCategorybotleft padding-top80 padding-bottom80">
                                <img src="/examinationicon/{{ $item->iconImage }}" alt="{{ $item->iconImage }}">
								<h3 class="padding-top10">{{ strtoupper($item->name) }}</h3>	
							</div>
						</div>
						<div class="col-md-8">
							<div class="exploreCategorybotRight padding-top20">
								@if(sizeof($item->listofexamination) > 0)
									@foreach($item->listofexamination as $key1 => $item1)
										<ul>
											<li style="font-size: 12px;">
												<a href="{{ URL::to('/examination-details/'.$item->slug.'/'.$item1->slug) }}"> <i class="fa fa-arrow-right"></i> {{$item1->sortname}} - {{ $item1->name}}</a>
											</li>
											@if($key1 == 5)
					 							{{--*/ break; /*--}}
					  						@endif		
										</ul>
									@endforeach
									@if(sizeof($item->listofexamination) > 5)
					 					<a href="{{ URL::to('/examination-list/'.$item->slug) }}">{{sizeof($item->listofexamination) - 6 }} More Exam</a>
					 				@endif
								@else
									<p>Not Updated Yet</p>
								@endif
							</div>
							<div class="exploreCategorybotRightDesign padding-top10">
								@foreach($item->examListMultipleDegreeObj as $key2 => $item2)
									<a class="btn-sm btn btn-warning margin-bottom5" href="{{ URL::to('/examination-list/'.$item->slug.'/'.$item2->degreeSlug) }}"> {{ $item2->degreeName }} </a>
									@if($key2 == 5)
			 							{{--*/ break; /*--}}
			  						@endif	
								@endforeach
		  						@if(sizeof($item->examListMultipleDegreeObj) > 6)
		  							<br>
				 					<a href="{{ URL::to('/examination-list/'.$item->slug) }}">{{sizeof($item->examListMultipleDegreeObj) - 6 }} More Exam</a>
				 				@endif	
							</div>
						</div>
					</div>
				</div>
			</div></a>
			@endforeach
		</div>
	</div>
</div>
<!--end explore category-->
@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.examination-search-partial')
@endsection



