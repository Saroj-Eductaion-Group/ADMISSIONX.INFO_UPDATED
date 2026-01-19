    <!-- Mainly scripts -->
    {!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
    {!! Html::script('assets/administrator/js/bootstrap.min.js') !!}
    {!! Html::script('assets/administrator/js/bootstrap-datetimepicker.js') !!}
    {!! Html::script('assets/administrator/js/plugins/metisMenu/jquery.metisMenu.js') !!}
    {!! Html::script('assets/administrator/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}
    {!! Html::script('assets/administrator/js/plugins/jeditable/jquery.jeditable.js') !!}
    <!-- Peity -->
    {!! Html::script('assets/administrator/js/plugins/peity/jquery.peity.min.js') !!}
    {!! Html::script('assets/administrator/js/demo/peity-demo.js') !!}

    <!-- Custom and plugin javascript -->
    {!! Html::script('assets/administrator/js/inspinia.js') !!}
    {!! Html::script('assets/administrator/js/plugins/pace/pace.min.js') !!}
    <!-- START LOAD SPECIAL JS FOR SPECIFIC PAGE -->
    
    <!-- END LOAD SPECIAL JS FOR SPECIFIC PAGE -->
    <!-- jQuery UI -->
    {!! Html::script('assets/administrator/js/plugins/jquery-ui/jquery-ui.min.js') !!}

    {!! Html::script('assets/administrator/js/highlight.min.js') !!}
    {!! Html::script('assets/administrator/js/parsley.js') !!}

    {!! Html::script('assets/administrator/js/plugins/jquery-ui/jquery-ui.min.js') !!}

    <!-- Jquery for Chosen select -->
    {!! Html::script('assets/administrator/js/plugins/chosen/chosen.jquery.js') !!}
    
    {!! Html::script('assets/administrator/js/plugins/jasny/jasny-bootstrap.min.js') !!}
    {!! Html::script('assets/js/ionRangeSlider/ion.rangeSlider.min.js') !!}
    {!! Html::script('assets/js/nouslider/jquery.nouislider.min.js') !!}
    {!! Html::script('assets/js/parsley.min.js') !!}

    {!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

    {!! Html::script('assets/administrator/css/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
    {!! Html::script('assets/administrator/js/plugins/fancy-box.js') !!}

    {!! Html::script('assets/administrator/js/plugins/masonry/jquery.masonry.min.js') !!}
    {!! Html::script('assets/administrator/js/plugins/blog-masonry.js') !!}
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <!-- Jquery Validate -->
    <!-- js/plugins/validate/jquery.validate.min.js -->
    <script type="text/javascript">
        var currentURL = window.location.href;
        $( "#side-menu > li a" ).each( function( index, element ){
            if( currentURL == $( this ).attr('href')){
                $(this).parent().addClass('active');
                $(this).parent().parent().addClass('active');
                $(this).parent().parent().parent().addClass('active');
            }
            
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
        $(".form_datetime").datetimepicker({
            startDate: new Date(),
            Default: true,
            format: 'mm/dd/yyyy HH:ii P',
            autoclose: true,
            todayBtn: true,
        });

        $(".form_datetime1").datetimepicker({
            Default: true,
            format: 'mm/dd/yyyy HH:ii P',
            autoclose: true,
            todayBtn: true,
        });
    </script>
    
    <script type="text/javascript">
        $('button[type=submit]').click(function (e) {
            var button = $(this);
            buttonForm = button.closest('form');
            buttonForm.data('submittedBy', button);
    });
        $('.form-horizontal').submit(function (e) {
        var form = $(this);
        var $myForm = $('.form-horizontal')
        if ($myForm[0].checkValidity()) {
            var submittedBy = form.data('submittedBy');
            $('button[type=submit]').attr('disabled', true);
        }else{
            $('button[type=submit]').attr('disabled', false);
        }
    });
    </script>
    <script type="text/javascript">
        $('.summernote').summernote();
    </script>
     <script type="text/javascript">
        $( "#datePickerForSelection").datepicker({ minDate: new Date(), dateFormat: 'd/m/yy' }); 
    </script>
    <script type="text/javascript">
        $( "#datePickerForSelection1").datepicker({ minDate: new Date(), dateFormat: 'd/m/yy' }); 
    </script>
    
    <script type="text/javascript">
        jQuery(document).ready(function() {
            FancyBox.initFancybox();
        });
    </script>
    @yield('script')