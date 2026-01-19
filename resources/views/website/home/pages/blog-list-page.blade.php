@extends('website/new-design-layouts.master')

@section('styles')
{!! Html::style('home-layout/assets/css/pages/blog.css') !!}
@include('website.home.search-pages.search-field-partials.blog-search-style-partial')

@endsection

@section('content')
<div class="examsentranceTop padding-top60 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('website.home.search-pages.search-field-partials.blog-search-partial')
			</div>
		</div>
	</div>
</div>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">Blogs</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="{{ URL::to('/') }}">Home</a></li>
			<li class="active">Blogs</li>
		</ul>
	</div>
</div>
<div class="container content">
	<div class="row blog-page">
		<div class="col-md-9 md-margin-bottom-40">
			@if( $getBlogsObj )
				@foreach( $getBlogsObj as $item )
					{{--*/ $isChecked = '0'  /*--}}
					{{--*/   
						$orientation = 'max-height: 300px; width: auto;';
						if(!empty($item->fullimage)){
  							$imagePath = "/blogs/".$item->fullimage;
  							$filename = public_path().'/blogs/'.$item->fullimage;
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
								<a href="{{ URL::to('blogs', $item->slug) }}" title="{{ $item->topic }}">
									<img class="img-responsive" src="/blogs/{{ $item->featimage }}" alt="{{ $item->topic }}" style="{{$orientation}}">
								</a>
							@else
								<a href="{{ URL::to('blogs', $item->slug) }}" title="{{ $item->topic }}">
									<img class="img-responsive" src="{{asset('/blogs/default.jpg')}}" alt="{{ $item->topic }}">
								</a>
							@endif
						</div>
						<div class="col-md-7">
							<h2>
								<span class="text-left">
									<a href="{{ URL::to('blogs', $item->slug) }}">{{ ucfirst(strtolower($item->topic)) }}</a>
								</span>
								&nbsp;&nbsp;
								<span class="text-right">
									@if( $studentBookMarkInfoBlogs )
								    	@foreach($studentBookMarkInfoBlogs as $bookmarked)
								    		@if( $bookmarked->blog_id == $item->id )
									    	<a href="javascript:void(0);" class="bookmarkedHeartIcon">
									    		<input type="hidden" name="bookmarkTableID" value="{{ $bookmarked->id }}">
		  										<input type="hidden" name="blogName" value="{{ $item->slug }}">
		  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item->slug) }}">
		  										<span title="The Featured showcase features some of the most popular blogs" class="white-bg">
		  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
												</span>
											</a>
											{{--*/ $isChecked = '1'  /*--}}
											{{--*/ break /*--}}
											@endif
										@endforeach

										@if( $isChecked == '0' )
											<a href="javascript:void(0);" class="blogBookMarkButton">
		  										<input type="hidden" name="blogName" value="{{ $item->slug }}">
		  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item->slug) }}">
		  										<span title="The Featured showcase features some of the most popular blogs" class="white-bg">
		  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
												</span>
											</a>
										@endif
									@else
										<a href="javascript:void(0);" class="blogBookMarkButton">
	  										<input type="hidden" name="blogName" value="{{ $item->slug }}">
	  										<input type="hidden" name="blogURL" value="{{ URL::to('blogs', $item->slug) }}">
	  										<span title="The Featured showcase features some of the most popular blogs" class="white-bg">
	  											<i class="bookmarkHeart blogName rounded-x icon-heart" name="blogName"></i>
											</span>
										</a>
									@endif									
								</span>
							</h2>
							<ul class="list-unstyled list-inline blog-info">
								<li><i class="fa fa-calendar"></i> {!! date('M d, Y', strtotime($item->createdDate)) !!}</li>
								<li><i class="fa fa-user"></i> {{ $item->firstname }}</li>								
							</ul>
							<p style="font-size: 18px;">{{ str_limit(strip_tags($item->description), 250) }}</p>
							<p><a class="btn-u btn-u-sm" href="{{ URL::to('blogs', $item->slug) }}">Read More <i class="fa fa-angle-double-right margin-left-5" ></i></a></p>
						</div>
					</div>
					<hr class="margin-bottom-40">
				@endforeach
				<div class="text-center">
					{!! $getBlogsObj->render() !!}	
				</div>				
			@endif
		</div>
		
		<div class="col-md-3">
			<div class="magazine-sb-social margin-bottom-30">
				<div class="headline headline-md">
					<h2>Social Networks</h2>
				</div>
				<ul class="social-icons social-icons-color">
					<li><a class="social_facebook" data-original-title="Facebook" href="https://www.facebook.com/AdmissionX/" target="_blank"></a></li>
					<li><a class="social_twitter" data-original-title="Twitter" href="https://twitter.com/adxdotcom" target="_blank"></a></li>
					<li><a class="social_linkedin" data-original-title="Linkedin" href="https://in.linkedin.com/company/officialadx"></a></li>
					<li><a class="social_youtube" data-original-title="Youtube" href="https://www.youtube.com/channel/UCyF-Xah1WKGEq5bb0jKXtpg" target="_blank"></a></li>
					<!-- <li><a class="social_rss" data-original-title="Feed" href="#"></a></li> -->
					<!-- <li><a class="social_vimeo" data-original-title="Vimeo" href="#"></a></li> -->
					<!-- <li><a class="social_googleplus" data-original-title="Goole Plus" href="#"></a></li> -->
					<!-- <li><a class="social_pintrest" data-original-title="Pinterest" href="#"></a></li> -->
					<!-- <li><a class="social_dropbox" data-original-title="Dropbox" href="#"></a></li>
					<li><a class="social_picasa" data-original-title="Picasa" href="#"></a></li>
					<li><a class="social_spotify" data-original-title="Spotify" href="#"></a></li>
					<li><a class="social_jolicloud" data-original-title="Jolicloud" href="#"></a></li>
					<li><a class="social_wordpress" data-original-title="Wordpress" href="#"></a></li>
					<li><a class="social_github" data-original-title="Github" href="#"></a></li>
					<li><a class="social_xing" data-original-title="Xing" href="#"></a></li> -->
				</ul>
				<div class="clearfix"></div>
			</div>

			<div class="posts margin-bottom-40">
				<div class="headline headline-md"><h2>Recent Posts</h2></div>
				@if( $getBlogsObj1 )
					@foreach( $getBlogsObj1 as $item )
						<!-- <ul class="list-unstyled">
							<li>
								<a href="{{ URL::to('blogs', $item->slug) }}">{{ $item->topic }}</a>
							</li>
						</ul> -->
						<dl class="dl-horizontal">
							@if($item->featimage)
							<dt><a href="{{ URL::to('blogs', $item->slug) }}" title="{{ $item->topic }}"><img src="/blogs/{{ $item->featimage }}" alt="{{ $item->topic }}"></a></dt>
							@else
								<dt><a href="{{ URL::to('blogs', $item->slug) }}" title="{{ $item->topic }}"><img src="{{asset('/blogs/default.jpg')}}" alt="{{ $item->topic }}"></a></dt>
							@endif
							<dd>
								<p>
									<a href="{{ URL::to('blogs', $item->slug) }}">{{ ucfirst(strtolower($item->topic)) }}</a>
								</p>
							</dd>
						</dl> 
					@endforeach
				@endif
			</div>

			<div class="headline headline-md"><h2>Tabs Widget</h2></div>
			<div class="tab-v2 margin-bottom-40">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home-1" aria-expanded="false">About Us</a></li>
					<li class=""><a data-toggle="tab" href="#home-2" aria-expanded="true">Quick Links</a></li>
				</ul>
				<div class="tab-content">
					<div id="home-1" class="tab-pane active">
						<p>AdmissionX is a first of its kind platform that connects students and institutions for the purpose of admission in different courses. With over 31100 colleges, more than 50200 courses in 4000 cities- AdmissionX aims to be your one stop solution for all things admission.</p>
					</div>
					<div id="home-2" class="tab-pane magazine-sb-categories">
						<div class="row padding15">
							<ul class="list-unstyled col-xs-6">
								<li><a href="{{ URL::to('about') }}" title="About Us">About Us</a></li>
								<li><a href="{{ URL::to('careers') }}" title="Careers">Careers</a></li>
								<li><a href="{{ URL::to('contact-us') }}" title="Contact Us">Contact Us</a></li>
								<li><a href="{{ URL::to('help-center') }}" title="Help Center">Help Center</a></li>
								<li><a href="{{ URL::to('terms-of-service') }}" title="Terms of Service">Terms of Service</a></li>
							</ul>
							<ul class="list-unstyled col-xs-6">
								<li><a href="{{ URL::to('educational-institution') }}" title="College">College</a></li>
								<li><a href="{{ URL::to('counselling') }}" title="Counselling">Counselling</a></li>
								<li><a href="{{ URL::to('education-blogs') }}" title="Blog">Blog</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.blog-search-partial')
@endsection