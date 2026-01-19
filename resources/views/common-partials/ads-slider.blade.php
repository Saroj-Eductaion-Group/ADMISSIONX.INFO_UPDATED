@if(sizeof($getListOfAdsManagements) > 0)
<div class="{{ isset($addonClass) ? $addonClass : 'margin-top20' }}">
    <div class="row">
        <div class="col-md-12">
        	<div class="ads-carousel">
	        	@foreach($getListOfAdsManagements as $key => $item)
	        		@if($ads_position == $item->ads_position)
	        		<div class="single-slide">
                		<div class="inner">
		            		<a href="{{ $item->redirectto }}" target="_blank" title="View Now">
		                		<img src="{{ asset('/assets/ads-banner/'.$item->img) }}" class="img-responsive img-thumbnail">
		            		</a>
		            	</div>
		            </div>
		            @endif
	            @endforeach
        	</div>
        </div>
    </div>
</div>
@endif