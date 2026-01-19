@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Examination Type {{ $examinationtype->id }} <a href="{{ url('examination/examination-type') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update examination type details</h5>                            
            </div>
            <div class="ibox-content">
             {!! Form::model($examinationtype, [
                'method' => 'PATCH',
                'url' => ['/examination/examination-type', $examinationtype->id],
                'class' => 'form-horizontal',
                'files' => true,
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data'
            ]) !!}

            @include ('examination.examination-type.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')

@endsection