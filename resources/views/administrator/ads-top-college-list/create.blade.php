@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<style type="text/css">
    
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Ads Top College List <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add New Ads Top College List details</h5>                            
            </div>
            <div class="ibox-content">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @if(Session::has('flash_message'))
                <div class="row margin-top20 margin-botttom20">
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
            {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/ads-top-college-list', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                @include ('administrator.ads-top-college-list.form')
            
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
@include('administrator.ads-top-college-list.scripts')
@include('common-partials.ads-autocomplete-college-list-script')
<script type="text/javascript">
    $('select[name=page_name_id]').on('change', function(){
        $('.collegeName1').val('');
        $('.collegeId1').val('');
        $('.collegeName2').val('');
        $('.collegeId2').val('');
        $('.collegeName3').val('');
        $('.collegeId3').val('');
    });
</script>
@endsection