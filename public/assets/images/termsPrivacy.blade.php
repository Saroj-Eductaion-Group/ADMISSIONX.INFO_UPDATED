@extends('website/home-layouts.master')

@section('meta-tags-seo')
<meta property="fb:admins" content="">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="robots" content="index, follow">
<meta name="twitter:card" content="app"> 
<meta name="twitter:app:country" content="IN"> 
<meta name="twitter:app:name:iphone" content="Admission X"> 
<meta name="twitter:app:id:iphone" content=""> 
<meta name="twitter:app:name:ipad" content="Admission X"> 
<meta name="twitter:app:id:ipad" content=""> 
<meta name="twitter:app:name:googleplay" content="Admission X"> 
<meta name="twitter:app:id:googleplay" content="">
<meta name="twitter:app:url:iphone" content=""> 
<meta name="twitter:app:url:ipad" content=""> 
<meta name="twitter:app:url:googleplay" content="">

<meta name="og_title" property="og:title" content="AdmissionX.com">
<meta name="og_site_name" property="og:site_name" content="AdmissionX.com">
<meta name="og_image" property="og:image" content="">
<meta name="og_url" property="og:url" id="og-url" content="https://www.admissionx.com">
@endsection

@section('content')

<div class="container  content-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12 md-margin-bottom-50">
				@foreach(  $getTermsPrivacyPageDataObj as  $pageData )
					<input type="hidden" name="slug" value="{{ $pageData->slug }}">
					<h2 class="title-v2">{{ $pageData->title }}</h2>
					<div>
						{{ $pageData->body }}
					</div>					
				@endforeach
			</div>
		</div>
	</div>
</div>
			
@endsection


