@extends('website/new-design-layouts.master')

@section('styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials-theme-flat.css" />
@include('website.home.search-pages.search-field-partials.news-search-style-partial')
@endsection

@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('website.home.search-pages.search-field-partials.news-search-partial')
			</div>
		</div>
	</div>
</div>
<div class="bg-color-light">
	<div class="container content-sm">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@if(Session::has('blogs-session-msg'))
					<div class="alert alert-info alert-dismissable text-center">
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                {{ Session::get('blogs-session-msg') }}                        
		            </div>
		    	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				@if(sizeof($getNewsDetailObj) > 0)
					@foreach( $getNewsDetailObj as $item )
						<div class="news-v3 bg-color-white margin-bottom-30">
							@if($item->fullimage != '')
								<img class="img-responsive full-width" src="/news-image/{{ $item->fullimage }}" alt="{{ $item->topic }}">
							@else
								<img class="img-responsive full-width" src="{{asset('/news-image/default.jpg')}}" alt="{{ $item->topic }}">
							@endif
							<div class="news-v3-in">
								<ul class="list-inline posted-info">
									<li>By <a href="#">{{ $item->fullname }}</a></li>
									<li>Posted {!! date('F d, Y', strtotime($item->createdDate)) !!}</li>
									<li>
										@if(!empty($item->newsslug))
											<i class="fa fa-tags"></i> <a class="rounded-3x" href="{{ URL::to('news',['categories',$item->newsslug]) }}" title="{{$item->news_typesname}}">{{$item->news_typesname}}</a>
										@else
											<i class="fa fa-tags"></i> {{$item->news_typesname}}
										@endif
									</li>
								</ul>
								<h2 class="text-uppercase"><a href="{{ URL::to('news', $item->slug) }}">{{ $item->topic }}</a></h2>
								<span class="blog-slider-badge"></span>
                                @if($item->newstagsids) 
                                	 <ul class="list-unstyled list-inline"><i class="fa fa-tags"></i>
                                    @foreach( $tags as $key1 => $item1 )
                                       <li class="margin-bottom10">
                                       	@if(!empty($item1->slug))
                                       		<a href="{{ URL::to('news',['tags',$item1->slug]) }}" title="{{ $item1->name }}"> <span class="label rounded-2x label-info margin-right5 margin-top5"> {{ $item1->name }} </span> </a>
                                       	@else
                                       		 <span class="label rounded-2x label-info margin-right5 margin-top5"> {{ $item1->name }} </span>
                                       	@endif
                                       	</li>
                                    @endforeach
                                    </ul>
                                @endif 
								<div id="share"></div>
								<p style="font-size: 18px;">{!! $s = substr($item->description, 0) !!}</p>
							</div>
						</div>						
					@endforeach
				@else
					<div class="headline text-center"><h3>No data found for Blog Details, please try with different criteria</h3></div>			
				@endif
			</div>
			<div class="col-md-3">
				<div class="headline-v2"><h2>Latest Posts</h2></div>
				<ul class="list-unstyled blog-latest-posts margin-bottom-50">
					@if( $getNewsTopicObj )
						@foreach( $getNewsTopicObj as $blogObj )
						<li>
							<h3><a href="{{ URL::to('news', $blogObj->slug) }}">{{ ucfirst(strtolower($blogObj->topic)) }}</a> | <small>{!! date('F d, Y', strtotime($blogObj->createdDate)) !!}</small></h3>							
							<!-- <p>{!! $s = substr($blogObj->description, 0, (75 - 3)) !!}</p> -->
						</li>
						@endforeach
					@endif
				</ul>
				<!-- Tags v3 -->
				<div class="margin-bottom-20">
					<div class="headline-v2"><h2>Tags</h2></div>

					<ul class="list-inline tags-v3">
						@foreach( $newsTagObj as $item )
							@if(!empty($item->slug))
								<li><a class="rounded-3x" title="{{$item->name}}" href="{{ URL::to('news',['tags',$item->slug]) }}">{{$item->name))}}</a></li>
							@endif
						@endforeach
					</ul>
				</div>
				<!-- End Tags v3 -->

				<!-- Tags v3 -->
				<div class="margin-bottom-20">
					<div class="headline-v2"><h2>News Category</h2></div>

					<ul class="list-inline tags-v3">
						@foreach( $newsTypeObj as $item )
							@if(!empty($item->slug))
								<li><a class="rounded-3x" title="{{$item->name}}" href="{{ URL::to('news',['categories',$item->slug]) }}">{{$item->name))}}</a></li>
							@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
		
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.min.js"></script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.news-search-partial')

<script>
    $("#share").jsSocials({
    	shareIn: 'popup',
        shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest"]
    });
</script>
@endsection