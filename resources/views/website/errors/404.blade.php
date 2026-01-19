@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
{{--*/ 
$slugName = '404-page';
$seocontent = $fetchDataServiceController->seoContentDetailsByMisc($slugName);

/*--}}
    
@extends('website/new-design-layouts.master')

@section('styles')
<!-- CSS Page Style -->
{!! Html::style('/home-layout/assets/css/pages/page_log_reg_v3.css') !!}

<style type="text/css">
    .sky-form .state-error + em{margin-top: -20px !important; margin-bottom: 20px !important;color: #A52222 !important;}
    .parsley-errors-list{list-style: none !important; text-align: left !important; float: left !important; padding-left: 0px !important;}
    .parsley-custom-error-message{color: #A52222 !important; font-size: 11px;}
    .input-box-style{ border-color: rgba(255,255,255,0.7);  color: #fff;    background: transparent;    height: 45px;    border-radius: 5px;
    padding: 10px;}
    .input-box-style-black{ border-color: #f2f2f2;  color: #000;    background: transparent;    height: 45px;    border-radius: 5px;
    padding: 10px;}
    .input-box-style-border{border: 1px solid #f2f2f2 !important;color: #000; background: transparent; height: 45px; border-radius: 5px;
    padding: 10px;}
    input::-webkit-input-placeholder{color: #000 !important;}
    input:-moz-placeholder{color: #000 !important;} 
    input::-moz-placeholder{color: #000 !important;}
    input:-ms-input-placeholder{color: #000 !important;}
    .sky-form-no-block{border: none !important;}

    .form-block .btn {text-transform: unset; font-size: 14px; padding-top: 12px; padding-bottom: 12px;}
    .colorbackground { background: #dddddd;  color: #555555; }
    .login-block {background: #ffffffba;}
    .login-block h2 {color: #010000; font-family: 900;}
    .error-desc{color: #000;font-size: 15px;}

    @media (max-width: 768px) {
        .form-block {
            min-width: 320px;
        }
    }
</style>
@endsection

@section('content')
<div class="forms-wrapper">
    <div class="container content-md">
        <div class="margin-bottom-60 head">
            <h1>Sorry!</h1>
        </div>
        @if(Session::has('flash_message'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>{{ Session::get('flash_message') }}</strong>
                    </div>
                </div>
            </div>
        @endif
        <!--login Block-->
        <div class="form-block login-block rounded-left equal-height-column">
            <h2>404</h2><h3 class="font-bold">Url not found</h3>

            <div class="error-desc">
                Sorry, The requested URL was not found on the server.
            </div>
            <p class="margin-top10">
                <a href="{{ URL::to('/') }}" class="btn btn-md btn-primary">Login</a>
            </p>
        </div>
        <!--End login Block-->
    </div><!--/container-->
</div>


@endsection


@section('scripts')
{!! Html::script('/assets/js/parsley.min.js') !!}
{!! Html::script('/assets/js/forms/login.js') !!}
{!! Html::script('/assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js') !!}
{!! Html::script('/assets/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js') !!}
{!! Html::script('/assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js') !!}
{!! Html::script('/assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js') !!}
<script type="text/javascript">
    jQuery(document).ready(function() {
        LoginForm.initLoginForm();
    });
</script>

<script type="text/javascript">
    $('body').addClass('padding-bottom0');
    // $(".image-block").backstretch([
    //  "/assets/images/bg/1.jpg",
    // ]);
</script>
<script type="text/javascript">
    $('form').parsley();
</script>

@endsection