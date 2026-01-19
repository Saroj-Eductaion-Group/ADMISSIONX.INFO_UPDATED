@extends('website/new-design-layouts.master')

{{--*/ $blogTitle = '' /*--}}
{{--*/ $blogDesc = '' /*--}}
{{--*/ $blogImg = '' /*--}}
{{--*/ $blogURL = '' /*--}}
{{--*/ $baseWeb = env('APP_URL') /*--}}
@if( $getBlogsObj )
	@foreach( $getBlogsObj as $item )
		{{--*/ $blogTitle = $item->topic /*--}}
		{{--*/ $blogDesc = $item->description /*--}}
		{{--*/ $blogURL = $baseWeb."/blogs/$item->slug" /*--}}

		@if($item->fullimage != '')
			{{--*/ $blogImg = $baseWeb."/blogs/$item->fullimage" /*--}}
		@else
			{{--*/ $blogImg = $baseWeb."/blogs/default.jpg" /*--}}
		@endif
	@endforeach
@endif

@section('styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials-theme-flat.css" />
@include('website.home.search-pages.search-field-partials.blog-search-style-partial')
@endsection

@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('website.home.search-pages.search-field-partials.blog-search-partial')
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
				@if( $getBlogsObj )
					@foreach( $getBlogsObj as $item )
						<div class="news-v3 bg-color-white margin-bottom-30">
							@if($item->fullimage != '')
								<img class="img-responsive full-width" src="/blogs/{{ $item->fullimage }}" alt="{{ $item->topic }}">
							@else
								<img class="img-responsive full-width" src="{{asset('/blogs/default.jpg')}}" alt="{{ $item->topic }}">
							@endif
							<div class="news-v3-in">
								<ul class="list-inline posted-info">
									<li>By <a href="#">{{ $item->firstname }}</a></li>
									<li>Posted {!! date('F d, Y', strtotime($item->createdDate)) !!}</li>
									</ul>
								<h2><a href="{{ URL::to('blogs', $item->slug) }}">{{ ucfirst(strtolower($item->topic)) }}</a></h2>
								<div id="share"></div>
								<p style="font-size: 18px;">{!! $s = substr($item->description, 0) !!}</p>
								<input type="hidden" name="SLUGURL" value="{{ $item->slug }}">

								@if( $bookmarkedBlogId )
									<a href="javascript:void(0);" class="bookmarkedHeartIcon">
										<input type="hidden" name="bookmarkTableID" value="{{ $bookmarkedTableId }}">
  										<input type="hidden" name="blogName" value="{{ $item->slug }}">
  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item->slug) }}">
  										<span title="The Featured showcase features some of the most popular blogs" class="white-bg">
  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
										</span>
									</a>
								@else
									<a href="javascript:void(0);" class="blogBookMarkButton">
  										<input type="hidden" name="blogName" value="{{ $item->slug }}">
  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item->slug) }}">
  										<span title="The Featured showcase features some of the most popular blogs" class="white-bg">
  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
										</span>
									</a>									
								@endif
							</div>
						</div>						
					@endforeach
				@endif
			</div>
			<div class="col-md-3">
				<div class="headline-v2"><h2>Latest Posts</h2></div>
				<ul class="list-unstyled blog-latest-posts margin-bottom-50">
					@if( $getBlogsTopicObj )
						@foreach( $getBlogsTopicObj as $blogObj )
						<li>
							<h3><a href="{{ URL::to('blogs', $blogObj->slug) }}">{{ ucfirst(strtolower($blogObj->topic)) }}</a> | <small>{!! date('F d, Y', strtotime($blogObj->createdDate)) !!}</small></h3>							
							<!-- <p>{!! $s = substr($blogObj->description, 0, (75 - 3)) !!}</p> -->
						</li>
						@endforeach
					@endif
				</ul>

				<!-- <div class="headline-v2"><h2>Newsletter</h2></div>
				<div class="blog-newsletter">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.min.js"></script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.blog-search-partial')

<script>
    $("#share").jsSocials({
    	shareIn: 'popup',
        shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest"]
    });
</script>
@endsection