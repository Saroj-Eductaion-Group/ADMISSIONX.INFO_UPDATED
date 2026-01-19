@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Application Profile <!-- <a href="{{ url('employee/transaction') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new application details</h5>                            
            </div>
            <div class="ibox-content">

            {!! Form::open(['url' => 'employee/transaction', 'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'data-parsley-trigger'=>'change', 'required' => '','data-parsley-pattern'=>'^[a-zA-Z0-9\\/s ().,-]*$']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Payment Status : </label>
                <div class="col-sm-10">
                    <select name="paymentstatus_id" class="form-control chosen-select" data-parsley-error-message=" Please select payment status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select payment status </option>  
                        @foreach ($paymentStatusObj as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                        @endforeach    
                    </select>     
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" >Card Type : </label>
                <div class="col-sm-10">
                    <select name="cardtype_id" class="form-control chosen-select " data-parsley-error-message=" Please select card type" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select card type</option>  
                        @foreach ($cartTypeobj as $cardtye)
                            <option value="{{ $cardtye->id }}">{{ $cardtye->name }}</option>
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Application : </label>
                <div class="col-sm-10">
                    <select name="application_id" class="form-control chosen-select " data-parsley-error-message=" Please select application name" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Application Name</option>  
                        @foreach ($applicationObj as $application)
                            <option value="{{ $application->id }}">{{ $application->name }} </option>
                        @endforeach    
                    </select>     
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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