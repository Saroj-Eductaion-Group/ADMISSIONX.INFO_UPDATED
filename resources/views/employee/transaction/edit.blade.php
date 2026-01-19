@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Application <!-- <a href="{{ url('employee/transaction') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update application details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($transaction, ['method' => 'PATCH','url' => ['employee/transaction', $transaction->id],'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'data-parsley-trigger'=>'change', 'required' => '','data-parsley-pattern'=>'^[a-zA-Z0-9\\/s ().,-]*$']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Payment Status : </label>
                <div class="col-sm-10">
                    <select name="paymentstatus_id" class="form-control chosen-select " data-parsley-error-message=" Please select payment status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Application Status </option>  
                        @foreach ($paymentStatusObj as $payment)
                            @if( $transaction->paymentstatus_id == $payment->id )
                                <option value="{{ $payment->id }}" selected="">{{ $payment->name }} </option>
                            @else
                                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                            @endif
                        @endforeach      
                    </select>     
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" >Card Type : </label>
                <div class="col-sm-10">
                    <select name="cardtype_id" class="form-control chosen-select " data-parsley-error-message=" Please select card type" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Card type</option>  
                        @foreach ($cartTypeobj as $cardtye)
                            @if( $transaction->cardtype_id == $cardtye->id )
                                <option value="{{ $cardtye->id }}" selected="">{{ $cardtye->name }} </option>
                            @else
                                <option value="{{ $cardtye->id }}">{{ $cardtye->name }}</option>
                            @endif
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
                            @if( $transaction->application_id == $application->id )
                                <option value="{{ $application->id }}" selected="">{{ $application->name }} </option>
                            @else
                                <option value="{{ $application->id }}">{{ $application->name }}</option>
                            @endif
                        @endforeach    
                    </select>     
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