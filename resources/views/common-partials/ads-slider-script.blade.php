<script type="text/javascript">
	jQuery(document).ready(function($) {
		"use strict";
		//  ADS CAROUSEL HOOK
        $('.ads-carousel').owlCarousel({
            loop: true,
            center: true,
            items: 1,
            margin: 0,
            autoplay: true,
            dots:false,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
              0: {
                items: 1
              },
              360: {
                items: 1
              },
              1200: {
                items: 1
              }
            }
        });
	});

</script>