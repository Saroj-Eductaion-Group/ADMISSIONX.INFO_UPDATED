@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Student Marks <!-- <a href="{{ url('administrator/studentmarks') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new user details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/studentmarks', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Marks : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="marks" placeholder="Enter marks here" data-parsley-trigger="change" data-parsley-error-message="Please enter your marks" required="">
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Percentage : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="percentage" placeholder="Enter percentage here" data-parsley-trigger="change" data-parsley-error-message="Please enter your percentage" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Marks Type </label>
                <div class="col-md-10">
                    <select name="studentMarkType" class="form-control chosen-select" data-placeholder="Choose mark type ..." data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select Mark Type</option>
                        <option value="" disabled ></option>
                        <option value="PCB">PCB</option>
                        <option value="PCM">PCM</option>
                        <option value="BEST 4">BEST 4</option>
                        <option value="BEST 5">BEST 5</option>
                        <option value="BEST 6">BEST 6</option>
                    </select>
                </div>
            </div>
            <div class="form-group hide">
                <label class="col-sm-2 control-label" >Category : </label>
                <div class="col-sm-10">
                    <input type="hidden" name="categoryName" value="3">                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Student Name : </label>
                <div class="col-sm-10">
                    <select name="studentProfileName" class="form-control chosen-select " data-placeholder="Choose student profile..."  data-parsley-error-message=" Please select student profile" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Student Name</option>  
                        @foreach ($studentProfile as $item)
                            <option value="{{ $item->id }}">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</option>
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