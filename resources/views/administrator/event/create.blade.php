@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Event <!-- <a href="{{ url('administrator/event') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new event details</h5>                            
            </div>
            <div class="ibox-content">

            {!! Form::open(['url' => 'administrator/event', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                <label class="col-sm-2 control-label" >Event Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter event name here', 'data-parsley-error-message' => 'Please enter event name here', 'required' => '', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label">Date</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="datetime" id="datePickerForSelection" readonly="" placeholder="Select date here" required="" data-parsley-trigger="change" data-parsley-error-message="Please select date here">
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-sm-2 control-label" >Venue : </label>
                <div class="col-sm-10">
                    {!! Form::text('venue', null, ['class' => 'form-control', 'placeholder' => 'Enter venue here', 'data-parsley-error-message' => 'Please enter venue here',  'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <label  class="col-sm-2 control-label">Event URL</label>
                <div class="col-sm-10">
                    {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Enter event url', 'data-parsley-type' => 'url', 'data-parsley-error-message' => 'Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)','data-parsley-trigger' =>'change', 'pattern' => "^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$"]) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-error-message' => 'Please enter description here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >College Profile : </label>
                <div class="col-sm-10">
                    <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose college profile..." data-parsley-error-message=" Please select college profile" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select College Profile</option>  
                        @foreach( $collegeProfileObj as $users )
                            @if( $users->userRoleId == '2' )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endif
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