<!-- JS Global Compulsory -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> 
{!! Html::script('assets/js/jquery.min.js') !!}
{!! Html::script('assets/js/jquery-migrate.min.js') !!}
{!! Html::script('assets/css/bootstrap/js/bootstrap.min.js') !!}

<!-- JS Implementing Plugins -->
{!! Html::script('assets/js/back-to-top.js') !!}
{!! Html::script('assets/js/smoothScroll.js') !!}
{!! Html::script('assets/js/parallax-slider/js/modernizr.js') !!}
{!! Html::script('assets/js/parallax-slider/js/jquery.cslider.js') !!}
{!! Html::script('assets/js/owl-carousel/owl-carousel/owl.carousel.js') !!}
{!! Html::script('assets/js/app.js') !!}
{!! Html::script('assets/js/backstretch/jquery.backstretch.min.js') !!}

<!-- JS Validation -->
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js') !!}
{!! Html::script('assets/js/parsley.min.js') !!}
<!-- JS Customization -->
{!! Html::script('assets/js/custom.js') !!}
{!! Html::script('assets/js/chosen/chosen.jquery.js') !!}
{!! Html::script('assets/administrator/js/parsley.js') !!}
<!-- Magnific Popup -->
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('assets/js/forms/student-details.js') !!}
{!! Html::script('home-layout/assets/js/all-bookmark.js') !!}
{!! Html::script('home-layout/assets/js/jquery-ui/jquery-ui.js') !!}
<!-- College Matrix Counter -->
{!! Html::script('home-layout/assets/plugins/counter/waypoints.min.js') !!}
{!! Html::script('home-layout/assets/plugins/counter/jquery.counterup.min.js') !!}
<script  src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"  ></script>
{!! Html::script('new-assets/js/owl.carousel.min.js') !!}
{!! Html::script('new-assets/js/slicknav.min.js') !!}
<script type="text/javascript">
	jQuery(document).ready(function() {
		App.init();
        App.initCounter();
	});
	</script>

	<script type="text/javascript">
        $(document).ready(function(){
            var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"100%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        });
    </script>
    <script>
        window.onscroll = function() {myFunction()};
            var header = document.getElementById("fixedHeader");
            var sticky = header.offsetTop;
            function myFunction() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("stickyHeader");
                } else {
                    header.classList.remove("stickyHeader");
                }
            }
    </script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
        		"use strict";
        		//  TESTIMONIALS CAROUSEL HOOK
		        $('#customers-testimonials').owlCarousel({
		            loop: true,
		            center: true,
		            items: 1,
		            margin: 0,
		            // autoplay: true,
		            dots:true,
		            autoplayTimeout: 8500,
		            smartSpeed: 450,
		            responsive: {
		              0: {
		                items: 1
		              },
		              360: {
		                items: 2
		              },
		              1200: {
		                items: 2
		              }
		            }
		        });
        	});

</script>
<script type="text/javascript">
	$(".js-example-placeholder-multiple").select2({
    	placeholder: "Location"
	});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"100%"}
            }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    });
</script>
<script type="text/javascript">
    $(document).on('mouseenter', '[data-toggle="tab"]', function () {
        //$(this).tab('show');
        // setTimeout(function(){
        // }, 500);
    });
</script>
<script type="text/javascript">
$('.dropdownhover').on('click', function(){
    $('.dropdownmenu').toggleClass('active');
});
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/65abec678d261e1b5f55e7f6/1hkjp6ti2';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
@yield('scripts')