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
        <h2>Ads Management <a href="{{ url($fetchDataServiceController->routeCall().'/ads-management') }}" class="btn btn-warning btn-sm pull-right">Back</a></h2>
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
                            {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/ads-management', 'class' => 'form-horizontal', 'data-parsley-validate' => '','files' => true]) !!}
                            {{--*/ $slug = $img = $redirectto = $ads_position = '' /*--}}
                            {{--*/ $start = $end = date('m/d/Y h:i A');  /*--}}
                            {{--*/ $isactive = 0 /*--}}
                            @include ('administrator/ads-management.form')
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
        $('.slug_page').on('change', function(){
            var slug_page = $(this).val();
            if(slug_page == 3 || slug_page == 1){
                $('.ads_position_2').addClass('hide');
                $('#ads_position_1').prop("checked", true);
            }else{
                $('.ads_position_2').removeClass('hide');
            }
        });
    });
</script>
@endsection