{{--*/ 
	$h1title = '';
	$h2title = '';
	$h3title = '';
	$firstImage = '';
	$firstImageAlt = '';
	$firstImageAltDesc = '';
	$pagetitle = '';
	$baseWeb = env('APP_URL');
	if(isset($seocontent) && !empty($seocontent) ){
		$h1title = $seocontent->h1title;
		$h2title = $seocontent->h2title;
		$h3title = $seocontent->h3title;
		$pagetitle = $seocontent->pagetitle;
		if($seocontent->imagealttext != ''):
			$firstImageAlt = $seocontent->imagealttext;
		else:
			$firstImageAlt = Config::get('systemsetting.SUBJECT');
		endif;

		if($seocontent->content != ''):
			$firstImageAltDesc = $seocontent->content;
		else:
			$firstImageAltDesc = Config::get('systemsetting.SUBJECT');
		endif;

		if($seocontent->image != ''):
			$firstImage = $baseWeb."/seo-content/$seocontent->image";
		endif;
	}
/*--}}
<div class="hide hidden">
	<img src="{{ $firstImage }}" alt="{{ $firstImageAlt }}" title="{{ $pagetitle }} | {{ Config::get('systemsetting.TITLE') }}" longdesc="{{ str_limit(strip_tags($firstImageAltDesc), 120) }}">
</div>

