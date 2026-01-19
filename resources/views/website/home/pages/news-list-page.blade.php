@extends('website/new-design-layouts.master')

@section('styles')
{!! Html::style('home-layout/assets/css/pages/blog.css') !!}
@include('website.home.search-pages.search-field-partials.news-search-style-partial')

@endsection

@section('content')
<div class="examsentranceTop padding-top60 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('website.home.search-pages.search-field-partials.news-search-partial')
			</div>
		</div>
	</div>
</div>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">{{ ucfirst($slugTagName) }} News</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="{{ URL::to('/') }}">Home</a></li>
			<li class="active">News</li>
		</ul>
	</div>
</div>
<div class="container content">
	<div class="row blog-page">
		<div class="col-md-9 md-margin-bottom-40">
			@if(sizeof($getNewsObj) > 0)
				@foreach( $getNewsObj as $item )
					{{--*/   
						$orientation = 'max-height: 300px; width: auto;';
						if(!empty($item->fullimage)){
  							$imagePath = "/news-image/".$item->fullimage;
  							$filename = public_path().'/news-image/'.$item->fullimage;
							if (file_exists($filename)) {
								list($width, $height) = getimagesize($filename);
								//echo "width:-".$width; echo "<br>"; echo "height:- ".$height; echo "<br>";
								if ($width > $height) {
					                //echo "landscape mode";
								 	$orientation  = 'max-height: 300px; width: auto;';
					            } else if ($width < $height) {
					                //echo "portrait mode";
									$orientation  = 'max-height: 300px; width: auto; object-fit: contain !important; background: #dcdcdc !important;';
					            } else {
					                $orientation = 'max-height: 300px; width: auto;';
					            }
                            }
						}else{
							$imagePath = "/news-image/default.jpg";
						}

                	/*--}}

					<div class="row blog blog-medium margin-bottom-40">
						<div class="col-md-5">
							@if($item->featimage != '')
								<a href="{{ URL::to('news', $item->slug) }}" title="{{ $item->topic }}">
									<img class="img-responsive" style="{{$orientation}}" src="/news-image/{{ $item->featimage }}" alt="{{ $item->topic }}">
								</a>
							@else
								<a href="{{ URL::to('news', $item->slug) }}" title="{{ $item->topic }}">
									<img class="img-responsive" src="{{asset('/news-image/default.jpg')}}" alt="{{ $item->topic }}">
								</a>
							@endif
						</div>
						<div class="col-md-7">
							<h2>
								<span class="text-left">
									<a href="{{ URL::to('news', $item->slug) }}">{{ ucfirst(strtolower($item->topic)) }}</a>
								</span>
							</h2>
							<ul class="list-unstyled list-inline blog-info">
								<li><i class="fa fa-calendar"></i> {!! date('M d, Y', strtotime($item->createdDate)) !!}</li>
								<li><i class="fa fa-user"></i> {{ $item->fullname }}</li>
								<li>
									@if(!empty($item->newsslug))
										<i class="fa fa-tags"></i> <a class="rounded-3x" href="{{ URL::to('news',['categories',$item->newsslug]) }}" title="{{$item->news_typesname}}">{{$item->news_typesname}}</a>
									@else
										<i class="fa fa-tags"></i> {{$item->news_typesname}}
									@endif
								</li>								
							</ul>
							@if($item->newstagsids) 
								<ul class="list-unstyled list-inline">
	                            @foreach( $item->tagname as $key1 => $item1 )
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
							<p style="font-size: 18px;">{{ str_limit(strip_tags($item->description), 200) }}</p>
							<p><a class="btn-u btn-u-sm" href="{{ URL::to('news', $item->slug) }}">Read More <i class="fa fa-angle-double-right margin-left-5" ></i></a></p>
						</div>
					</div>
					<hr class="margin-bottom-40">
				@endforeach
				<div class="text-center">
					{!! $getNewsObj->render() !!}	
				</div>				
			@else
				<div class="headline text-center"><h1>No data found for {{  ucfirst($slugTagName) }} News List, please try with different criteria</h1></div>			
			@endif
		</div>
		
		<div class="col-md-3 bg-color-light">
			<div class="posts margin-bottom-40">
				<div class="headline headline-md"><h2>Recent News</h2></div>
				<ul class="list-unstyled blog-latest-posts margin-bottom-50">
				@if( $getNewsTopicObj )
					@foreach( $getNewsTopicObj as $item )
					<li>
						<h3><a href="{{ URL::to('news', $item->slug) }}">{{ ucfirst(strtolower( $item->topic)) }}</a> | <small>{!! date('F d, Y', strtotime($item->createdDate)) !!}</small></h3>							
						<!-- <p>{!! $s = substr($item->description, 0, (75 - 3)) !!}</p> -->
					</li>
					@endforeach
				@endif
				</ul>
			</div>
			<!-- Tags v3 -->
			<div class="margin-bottom-20">
				<div class="headline-v2"><h2>News Tags</h2></div>
				<ul class="list-inline tags-v3">
					@foreach( $newsTagObj as $item )
						@if(!empty($item->slug))
							<li><a class="rounded-3x" title="{{$item->name}}" href="{{ URL::to('news',['tags',$item->slug]) }}">{{$item->name}}</a></li>
						@endif
					@endforeach
				</ul>
			</div>
			<!-- End Tags v3 -->

			<!-- Tags v3 -->
			<div class="margin-bottom-20">
				<div class="headline-v2"><h2>News Type</h2></div>
				<ul class="list-inline tags-v3">
					@foreach( $newsTypeObj as $item )
						@if(!empty($item->slug))
							<li><a class="rounded-3x" title="{{$item->name}}" href="{{ URL::to('news',['categories',$item->slug]) }}">{{$item->name}}</a></li>
						@endif
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.news-search-partial')
@endsection