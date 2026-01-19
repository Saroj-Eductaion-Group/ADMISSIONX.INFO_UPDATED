@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New User Group <!-- <a href="{{ url('employee/usergroup') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new user group details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'employee/usergroup', 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-7 col-md-offset-3">
                        @if(Session::has('warning'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('warning') }}</strong>
                            </div>                        
                        @endif
                    </div>    
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >User Group Name : </label>
                    <div class="col-sm-9">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter user group name here', 'data-parsley-error-message' => 'Please enter user group here','data-parsley-trigger'=>'change', 'required' => '']) !!}
                    </div>
                </div>
                <div class="form-group">        
                    <label class="col-sm-3 control-label" >Table Name : </label>
                    <div class="col-sm-9">
                        <select class="form-control chosen-select" name="allTableInformation_id[]" multiple="" placeholder ="Select table name here" data-parsley-error-message="Please select table name" data-parsley-trigger="change" required="">
                            @foreach($allTableInfoObj as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
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
@endsection