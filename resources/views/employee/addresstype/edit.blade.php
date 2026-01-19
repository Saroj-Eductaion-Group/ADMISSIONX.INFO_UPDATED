@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Address Type <!-- <a href="{{ URL::to('employee/addresstype') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Address Type details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($addresstype, ['method' => 'PATCH','url' => ['employee/addresstype', $addresstype->id],'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Type Of Address : </label>
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter address type here', 'data-parsley-error-message' => 'Please enter address type here', 'data-parsley-trigger'=>'change','required' => '','data-parsley-pattern'=>'^[a-zA-Z\s ]*$']) !!}
                    </div>
                </div>


            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection