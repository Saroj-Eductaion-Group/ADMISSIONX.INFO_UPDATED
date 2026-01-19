<!-- JS Global Compulsory -->
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
<script  src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"  ></script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		App.init();
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


<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

@yield('scripts')