@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Counseling Board {{ $counselingboard->id }} <a href="{{ url('counseling/counseling-boards') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Counseling Board  </h5>
                <a class="pull-right" href="{{ url('counseling/boards/update-form-details/' . $counselingboard->id) }}">
                    <button type="submit" class="btn btn-warning btn-xs">Update More Details</button>
                </a>                            
            </div>
            <div class="ibox-content">
             {!! Form::model($counselingboard, [
                'method' => 'PATCH',
                'url' => ['/counseling/counseling-boards', $counselingboard->id],
                'class' => 'form-horizontal',
                'files' => true,
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data'
            ]) !!}

            @include ('counseling.counseling-boards.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')

@endsection