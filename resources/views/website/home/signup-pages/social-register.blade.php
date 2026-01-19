@extends('website/new-design-layouts.master')

@section('styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
    .msg-error {color: #c64848;  padding-left: 15px;}
    .g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
    .login-box1 a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px;
        text-align: center; font-weight: 500; padding: 5px;}
    .login-box1 a span { font-family: open sans, serif;}
    .login-box1 a.active { background: #d40d12;}
    .background-form {background: url(1.jpg) 50% fixed;padding: 60px 0;position: relative;background-size: cover;}
</style>
<!-- CSS Page Style -->
<!-- {!! Html::style('assets/css/pages/page_log_reg_v4.css') !!} -->
@endsection

@section('content')
<!--=== Content Part ===-->
<div class="background-form">
    <div class="container content">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                {!! Form::open(['url' => '/social-fb-google/signup', 'method' => 'POST','class' => 'reg-page detail-page-signup', 'data-parsley-validate' => '']) !!}
                    <div class="reg-header">
                        <a href="{{ URL::to('/') }}">
                            <img class="img-responsive" src="{{asset('assets/images/logo.png')}}" alt="Admission X">
                        </a>
                    </div>

                    <div class="reg-header">
                        <h2>Kindly select your role</h2>
                    </div>
                    <select name="user_role" class="form-control" required="" data-parsley-error-message="Please select your role">
                        <option selected="" disabled="">-- Select your user role</option>
                        <option value="{{ $studentRoleId }}">Student Profile</option>
                    </select>
                    <input type="hidden" name="userObj" value="{{ json_encode($user) }}">
                    <input type="hidden" name="social" value="{{ $social }}">
                    <div class="row margin-bottom-30 margin-top20">
                        <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
                            {!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
                        </div>
                    </div>

                    <button type="submit" class="btn-u btn-block rounded">Confirm</button>

                {!! Form::close() !!}
            </div>
        </div><!--/row-->
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="/home-layout/assets/plugins/backstretch/jquery.backstretch.min.js"></script>
{!! Html::script('assets/js/forms/login.js') !!}
<script type="text/javascript">
    window.onload = function() {
        var $recaptcha = document.querySelector('#g-recaptcha-response');

        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    };
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
    });
</script>
<script type="text/javascript">
    $.backstretch([
        "/assets/img/bg/11.jpg",
        "/assets/img/bg/19.jpg",
        "/assets/css/1.jpg",
        "/assets/img/main/img12.jpg",
        ], {
            fade: 1000,
            duration: 7000
        });
</script>
@endsection
