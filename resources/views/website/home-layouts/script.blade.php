<!-- JS Global Compulsory -->
{!! Html::script('home-layout/assets/plugins/jquery/jquery.min.js') !!}
{!! Html::script('home-layout/assets/plugins/jquery/jquery-migrate.min.js') !!}
{!! Html::script('home-layout/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
<!-- JS Implementing Plugins -->
{!! Html::script('home-layout/assets/plugins/back-to-top.js') !!}
{!! Html::script('home-layout/assets/plugins/smoothScroll.js') !!}
{!! Html::script('home-layout/assets/plugins/modernizr.js') !!}
{!! Html::script('home-layout/assets/plugins/jquery.parallax.js') !!}
{!! Html::script('assets/js/app.js') !!}
<!-- {!! Html::script('home-layout/assets/plugins/login-signup-modal-window/js/main.js') !!} -->

{!! Html::script('assets/js/parallax-slider/js/jquery.cslider.js') !!}
{!! Html::script('assets/js/owl-carousel/owl-carousel/owl.carousel.js') !!}
{!! Html::script('assets/js/backstretch/jquery.backstretch.min.js') !!}

<!-- Magnific Popup -->
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

<!-- JS Customization -->
{!! Html::script('home-layout/assets/js/custom.js') !!}
<!-- JS Page Level -->
<!-- JS Validation -->
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js') !!}
{!! Html::script('assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js') !!}
{!! Html::script('assets/js/parsley.min.js') !!}
<!-- JS Customization -->
{!! Html::script('assets/js/custom.js') !!}
{!! Html::script('assets/js/chosen/chosen.jquery.js') !!}
{!! Html::script('assets/js/forms/student-details.js') !!}


<!-- ALL BookMark AJAX -->
{!! Html::script('home-layout/assets/js/all-bookmark.js') !!}
<!-- END -->

{!! Html::script('home-layout/assets/js//jquery-ui/jquery-ui.js') !!}

<!-- College Matrix Counter -->
{!! Html::script('home-layout/assets/plugins/counter/waypoints.min.js') !!}
{!! Html::script('home-layout/assets/plugins/counter/jquery.counterup.min.js') !!}
<script  src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"  ></script>
    
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
<script type="text/javascript">
//     $(".alert").fadeTo(10000, 500).slideUp(500, function(){
//     $(".alert").alert('close');
// });
</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

@yield('scripts')