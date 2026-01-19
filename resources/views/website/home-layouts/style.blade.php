<!-- Web Fonts -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

<!-- CSS Global Compulsory -->
{!! Html::style('home-layout/assets/css/plugins/bootstrap/css/bootstrap.min.css') !!}
{!! Html::style('home-layout/assets/css/style.css') !!}

<!-- CSS Header and Footer -->
{!! Html::style('home-layout/assets/css/headers/header-v8.css') !!}
{!! Html::style('home-layout/assets/css/footers/footer-v2.css') !!}

<!-- CSS Implementing Plugins -->
{!! Html::style('home-layout/assets/css/plugins/animate.css') !!}
{!! Html::style('home-layout/assets/plugins/line-icons/line-icons.css') !!}
{!! Html::style('home-layout/assets/plugins/font-awesome/css/font-awesome.css') !!}
{!! Html::style('home-layout/assets/plugins/login-signup-modal-window/css/style.css') !!}
{!! Html::style('home-layout/assets/plugins/brand-buttons/css/brand-buttons.min.css') !!}

{!! Html::style('assets/css/blocks.css') !!}
{!! Html::style('assets/css/pages/page_search.css') !!}

<!-- magnific-popup -->
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- CSS Theme -->
{!! Html::style('home-layout/assets/css/theme-skins/dark.css') !!}

<!-- CSS Customization -->
{!! Html::style('home-layout/assets/css/homeLayoutCustom.css') !!}


<!-- CSS Validation -->
{!! Html::style('assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css') !!}
{!! Html::style('assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css') !!}

<!-- CSS Customization -->
{!! Html::style('assets/css/customstyle.css') !!}
{!! Html::style('assets/css/chosen/chosen.css') !!}
{!! Html::style('home-layout/assets/js/jquery-ui/jquery-ui.min.js') !!}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
</style>
@yield('styles')