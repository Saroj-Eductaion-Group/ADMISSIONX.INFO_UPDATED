@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Log <!-- <a href="{{ url('administrator/logs') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new log details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/logs', 'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label" >User Name : </label>
                    <div class="col-sm-10">
                        <select name="users_id" class="form-control chosen-select" data-parsley-error-message="Please select user" data-parsley-trigger="change" required="" >
                            <option value="" selected="" disabled="">Please select user</option>
                            @foreach( $usersObj as $users )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >Event Name : </label>
                    <div class="col-sm-10">
                        {!! Form::text('event', null, ['class' => 'form-control', 'placeholder' => 'Enter event name here', 'data-parsley-error-message' => 'Please enter event name here','data-parsley-trigger'=>'change', 'required' => '']) !!}
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
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