@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Eligibility Criteria <a href="{{ url('examination/eligibility-criteria') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new eligibility criteria details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'examination/eligibility-criteria', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            @include ('examination.eligibility-criteria.form')
            
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')


@endsection