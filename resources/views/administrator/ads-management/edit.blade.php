@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<style type="text/css">
    .parsley-custom-error-message{
        font-weight: 400;
        font-size: 13px;
    }
</style>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Ads Management <a href="{{ url($fetchDataServiceController->routeCall().'/ads-management') }}" class="btn btn-warning pull-right btn-sm">Back</a></h2>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        @if(Session::has('wrongFileUpload'))
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="alert alert-danger alert-dismissable text-center">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        {{ Session::get('wrongFileUpload') }}                        
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            {!! Form::model($adsmanagement, [ 'method' => 'PATCH', 'url' => [$fetchDataServiceController->routeCall().'/ads-management', $adsmanagement->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '','files' => true]) !!}
                                {{--*/ $slug        = $adsmanagement->slug /*--}}
                                {{--*/ $img         = $adsmanagement->img /*--}}
                                {{--*/ $isactive    = $adsmanagement->isactive /*--}}
                                {{--*/ $redirectto  = $adsmanagement->redirectto /*--}}
                                {{--*/ $start       = $adsmanagement->start /*--}}
                                {{--*/ $end         = $adsmanagement->end /*--}}
                                {{--*/ $ads_position = $adsmanagement->ads_position /*--}}
                                @include ('administrator/ads-management.form', ['submitButtonText' => 'Update'])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $("#txtFromCreateDate1").datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onSelect: function(selected) {
          $("#txtToCreateDate1").datepicker("option","minDate", selected)
        }
    });
    $("#txtToCreateDate1").datepicker({ 
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onSelect: function(selected) {
           $("#txtFromCreateDate1").datepicker("option","maxDate", selected)
        }
    });

    $(".form_datetime_pick").datetimepicker({
        startDate: new Date(),
        Default: true,
        format: 'mm/dd/yyyy HH:ii P',
        autoclose: true,
        todayBtn: true,
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){   
        var slug_page = "{{ $adsmanagement->slug }}";
        check_ads_position(slug_page);
        $('.slug_page').on('change', function(){
            var slug_page = $(this).val();
            check_ads_position(slug_page);
        });
    });

    function check_ads_position(slug_page){
        if(slug_page == 3 || slug_page == 1){
            $('.ads_position_2').addClass('hide');
            $('#ads_position_1').prop("checked", true);
        }else{
            $('.ads_position_2').removeClass('hide');
        }
    }
</script>
@endsection