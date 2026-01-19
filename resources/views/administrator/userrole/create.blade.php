@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New User Role <!-- <a href="{{ url('administrator/userrole') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new user role details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/userrole', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name" placeholder="Enter user role here" data-parsley-trigger="change" data-parsley-error-message="Please enter user role" required="">
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