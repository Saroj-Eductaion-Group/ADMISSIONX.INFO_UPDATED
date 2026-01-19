{{--*/ 
	$baseWeb = env('APP_URL');
	$pagetitle = 'Discover Colleges, University, Courses, Institutes, Exams, Career for Higher Education in India';
	$description = 'Get Detailed Information on Top Colleges, Courses & Exams in India. Get alerts about Ranking, Cutoff, Placements, Fees & Admissions of 32,100+ Colleges & Universities. Get Question Papers, Syllabus & Important dates of 500+ exams. Our portal is a repository of reliable data from over 32,100+ colleges, and more than 1000+ courses in over 4000+ cities.';
	$keywords = 'AdmissionX, education, colleges, universities, institutes, career, career options, career prospects, engineering, mba, medical, mbbs, study abroad, foreign education, college, university, institute, courses, coaching, technical education, higher education,forum, community, education career experts, ask experts, admissions, results, events, scholarships';
	$firstImage = $baseWeb."/assets/images/admissionx_logo.png";
	$firstImageAlt = Config::get('systemsetting.TITLE');
	$firstImageAltDesc = $pagetitle;
	$canonical = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$canonicalUrl = explode('?', $canonical);
	if (sizeof($canonicalUrl) > 0) {
		$canonical = $canonicalUrl[0];
	}else{
		$canonical = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}

	if(isset($seocontent) && !empty($seocontent) ){
		if(!empty($seocontent->pagetitle)):
			$pagetitle = $seocontent->pagetitle;
		endif;

		if(!empty($seocontent->SEODescription)):
			$description = $seocontent->SEODescription;
		endif;

		if(!empty($seocontent->keyword)):
			$keywords = $seocontent->keyword;
		endif;

		if(!empty($seocontent->canonical)):
			$canonical = $seocontent->canonical;
			$canonicalUrl = explode('?', $canonical);
			if (sizeof($canonicalUrl) > 0) {
				$canonical = $canonicalUrl[0];
			}else{
				$canonical = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			}
		endif;

		if(!empty($seocontent->imagealttext)):
			$firstImageAlt = $seocontent->imagealttext;
		endif;

		if(!empty($seocontent->content)):
			$firstImageAltDesc = $seocontent->content;
		endif;

		if($seocontent->image != '' && file_exists('/seo-content/'.$seocontent->image)):
			$firstImage = $baseWeb."/seo-content/$seocontent->image";
		endif;
	}
/*--}}
@section('meta-tags-seo')
<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>{{ $pagetitle }} | {{ Config::get('systemsetting.TITLE') }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />	
	<meta name="google-site-verification" content="lc2qSbyRhE0de0r8YEYBDxcHE7lhOl4bP_5lQwcuW9A" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
	<meta name="theme-color" content="{{ Config::get('systemsetting.THEMECOLOR') }}">
	<meta name="author" content="{{ Config::get('systemsetting.AUTHOR') }}">
	<meta name="description" content="{{ str_limit(strip_tags($description), 400) }} | {{ Config::get('systemsetting.TITLE') }}">
	<meta name="keywords" content="{{ $keywords }}">
	<link rel="canonical" href="{{ strtolower($canonical) }}" />
	<link rel="alternate" href="{{ URL::current() }}" hreflang="en-in" />

	<?php
	/*@if(!empty(Request::all()))
	<meta name="robots" content="noindex, follow">
	@else
		<meta name="robots" content="index, follow">
	@endif */
	?>
	<meta name="robots" content="index, follow">
	<meta name="subject" content="{{ Config::get('systemsetting.SUBJECT') }}">
	<meta name="copyright" content="{{ Config::get('systemsetting.COPYRIGHT') }}">
	<meta name="language" content="{{ Config::get('systemsetting.LANGUAGE') }}">
	<meta name="coverage" content="{{ Config::get('systemsetting.COVERAGE') }}">
	<meta name="distribution" content="{{ Config::get('systemsetting.DISTRIBUTION') }}">

	<!-- <meta http-equiv="refresh" content="30"> -->
	<meta prefix="og: http://ogp.me/ns#" property="og:title" content="{{ $pagetitle }} | {{ Config::get('systemsetting.TITLE') }}">
	<meta prefix="og: http://ogp.me/ns#" property="og:type" content="business"/>
	<meta prefix="og: http://ogp.me/ns#" property="og:url" content="{{ strtolower($canonical) }}">
	@if(!empty($firstImage))
		<meta prefix="og: http://ogp.me/ns#" property="og:image" content="{{ $firstImage }}" title="{{ $firstImageAlt }}"/>
		<meta property="og:image:url"  content="https://cdn.kapwing.com/static/og-image.png"  />
	@endif
	<meta prefix="og: http://ogp.me/ns#" property="og:image:width" content="400" />
	<meta prefix="og: http://ogp.me/ns#" property="og:image:height" content="300" />
	@if(!empty($firstImageAltDesc))
		<meta prefix="og: http://ogp.me/ns#" property="og:description" content="{{ str_limit(strip_tags($firstImageAltDesc), 400) }}"/>
	@else
		<meta prefix="og: http://ogp.me/ns#" property="og:description" content="{{ str_limit(strip_tags($description), 400) }}"/>
	@endif

	<meta name="og_site_name" property="og:site_name" content="{{ Config::get('systemsetting.TITLE') }}">
	@if(!empty(Config::get('systemsetting.FBPAGEID')))
		<meta property="fb:page_id" content="{{ Config::get('systemsetting.FBPAGEID') }}">
	@endif
	@if(!empty(Config::get('systemsetting.FBADMINID')))
		<meta property="fb:admins" content="{{ Config::get('systemsetting.FBADMINID') }}">
	@endif
	<link rel="preload" type="image/png" href="/assets/images/logo.png" as="image">
	<link rel="shortcut icon" href="/logo/favicon-32x32.png">
	<!-- Appple Touch Icons -->
	<link rel="apple-touch-icon" sizes="57x57" href="/logo/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/logo/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/logo/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/logo/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/logo/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/logo/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/logo/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/logo/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/logo/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/logo/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/logo/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/logo/assets/img/favicon.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/logo/favicon-16x16.png">
	<link rel="manifest" href="/logo/manifest.json">
	<meta name="msapplication-TileColor" content="{{ Config::get('systemsetting.THEMECOLOR') }}">
	<meta name="msapplication-TileImage" content="/logo/ms-icon-144x144.png">
	<!-- Twitter Meta Data -->
	<meta name="twitter:card" content="app">
	<meta name="twitter:title" content="{{ $pagetitle }} | {{ Config::get('systemsetting.TITLE') }}">
	<meta name="twitter:description" content="{{ str_limit(strip_tags($description), 400) }}">
	@if(Config::get('systemsetting.COUNTRY') != "")
		<meta name="twitter:app:country" content="{{ Config::get('systemsetting.COUNTRY') }}">
	@endif
	@if(!empty($firstImage))
	<meta name="twitter:image" content="{{ $firstImage }}" title="{{ $firstImageAlt }}"/>
	@endif
	<meta name="twitter:site" content="{{ Config::get('systemsetting.TITLE') }}">

	@if(Config::get('systemsetting.TITLE') != "")
		<meta name="al:ios:app_name" content="{{ Config::get('systemsetting.TITLE') }}">
	@endif
	
	@if(Config::get('systemsetting.APPSTOREID') != "")
		<meta name="al:ios:app_store_id" content="{{ Config::get('systemsetting.APPSTOREID') }}">
	@endif
	
	@if(Config::get('systemsetting.TITLE') != "")
		<meta name="twitter:app:name:iphone" content="{{ Config::get('systemsetting.TITLE') }}">
	@endif
	
	@if(Config::get('systemsetting.APPSTOREID') != "")
		<meta name="twitter:app:id:iphone" content="{{ Config::get('systemsetting.APPSTOREID') }}">
	@endif
	
	@if(Config::get('systemsetting.SITEURL') != "")
		<meta name="twitter:app:url:iphone" content="{{ Config::get('systemsetting.SITEURL') }}">
	@endif
	
	@if(Config::get('systemsetting.TITLE') != "")
		<meta name="twitter:app:name:ipad" content="{{ Config::get('systemsetting.TITLE') }}">
	@endif
	
	@if(Config::get('systemsetting.APPSTOREID') != "")
		<meta name="twitter:app:id:ipad" content="{{ Config::get('systemsetting.APPSTOREID') }}">
	@endif
	
	@if(Config::get('systemsetting.SITEURL') != "")
		<meta name="twitter:app:url:ipad" content="{{ Config::get('systemsetting.SITEURL') }}">
	@endif
	
	@if(Config::get('systemsetting.TITLE') != "")
		<meta name="twitter:app:name:googleplay" content="{{ Config::get('systemsetting.TITLE') }}">
	@endif
	
	@if(Config::get('systemsetting.GOOGLEPLAYID') != "")
		<meta name="twitter:app:id:googleplay" content="{{ Config::get('systemsetting.GOOGLEPLAYID') }}">
	@endif
	
	@if(Config::get('systemsetting.SITEURL') != "")
		<meta name="twitter:app:url:googleplay" content="{{ Config::get('systemsetting.SITEURL') }}">
	@endif
	
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
	<link rel="dns-prefetch" href="//pagead2.googlesyndication.com">
	<link rel="dns-prefetch" href="//www.googletagmanager.com">
	<link rel="dns-prefetch" href="//www.facebook.com">
	<link rel="dns-prefetch" href="//js.hs-scripts.com">
	<link rel="dns-prefetch" href="//cdn.jsdelivr.net">
	<link rel="dns-prefetch" href="//connect.facebook.net">
	<link rel="dns-prefetch" href="//snap.licdn.com">
	<link rel="dns-prefetch" href="//adservice.google.ca">
	<link rel="dns-prefetch" href="//adservice.google.com">
	<link rel="dns-prefetch" href="//googleads.g.doubleclick.net">
	<link rel="dns-prefetch" href="//embed.tawk.to">
	<link rel="dns-prefetch" href="//px.ads.linkedin.com">
	<link rel="dns-prefetch" href="//js.hsadspixel.net">
	<link rel="dns-prefetch" href="//js.hs-analytics.net">
	<link rel="dns-prefetch" href="//static-v.tawk.to">
	<link rel="dns-prefetch" href="//va.tawk.to">
	<link rel="dns-prefetch" href="//www.linkedin.com">
	<link rel="dns-prefetch" href="//api.hubapi.com">
	<link rel="dns-prefetch" href="//track.hubspot.com">
	<link rel="dns-prefetch" href="//www.admissionx.info">
	<link rel="dns-prefetch" href="//www.admissionx.com">
@endsection