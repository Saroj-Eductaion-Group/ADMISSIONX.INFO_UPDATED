@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New College Profile <!-- <a href="{{ url('employee/collegeprofile') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new college profile details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'employee/collegeprofile', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-trigger'=>'change',  'data-parsley-error-message' => 'Please enter the college description ' ]) !!}
                    <!-- <p class="text-danger">(Maximum character limit 700)</p> -->
                </div>

            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Est. Year : </label>
                <div class="col-sm-10">
                     {!! Form::text('estyear', null, ['class' => 'form-control', 'placeholder' => 'Enter est year here', 'data-parsley-error-message' => 'Please enter est year here','data-parsley-type' => 'number', 'data-parsley-trigger'=>'change','data-parsley-min'=>'1050', 'data-parsley-max'=>date("Y")]) !!}
                </div>
            </div>
            <!--  <div class="form-group">
                <label class="col-sm-2 control-label" >Website : </label>
                <div class="col-sm-10">
                    {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Enter website here', 'data-parsley-error-message' => 'Please enter website here', 'required' => '']) !!}
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label" >College Code : </label>
                <div class="col-sm-10">
                    {!! Form::text('collegecode', null, ['class' => 'form-control', 'placeholder' => 'Enter college code here', 'data-parsley-error-message' => 'Please enter college code here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>  
             <div class="form-group">
                <label class="col-sm-2 control-label" >Contact Person Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('contactpersonname', null, ['class' => 'form-control', 'placeholder' => 'Enter contact person name here', 'data-parsley-error-message' => 'Please enter contact person name here', 'data-parsley-trigger'=>'change', 'data-parsley-pattern'=>'^[a-zA-Z\s .]*$']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Contact Person Email : </label>
                <div class="col-sm-10">
                    {!! Form::text('contactpersonemail', null, ['class' => 'form-control', 'placeholder' => 'Enter contact person email here', 'data-parsley-error-message' => 'Please enter contact person email here', 'data-parsley-trigger'=>'change', 'data-parsley-type'=>'email']) !!}
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-2 control-label" >Contact Person Phone : </label>
                <div class="col-sm-10">
                    {!! Form::text('contactpersonnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter contact person phone here', 'data-parsley-error-message' => 'Please enter valid mobile number', 'data-parsley-trigger'=>'change', 'data-parsley-type' =>'digits']) !!} <!-- , 'data-parsley-length'=>'[7, 11]','data-parsley-pattern'=>'^[7-9][0-9]{9}$' -->
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Review : </label>
                <div class="col-sm-10">
                    <select name="review" class="form-control chosen-select" data-placeholder="Choose review ..."  data-parsley-error-message=" Please select review " data-parsley-trigger="change">
                        <option value="" selected disabled >Select Review</option>
                        <option value="1">Reviewed</option>
                        <option value="0">No Reviewed</option>
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Agreement : </label>
                <div class="col-sm-10">
                    <select name="agreement" class="form-control chosen-select" data-placeholder="Choose agreement ..."  data-parsley-error-message=" Please select agreement " data-parsley-trigger="change">
                        <option value="" selected disabled >Select Agreement</option>
                        <option value="1">Agreement Signed</option>
                        <option value="0">No Agreement Signed</option>
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Verified : </label>
                <div class="col-sm-10">
                    <select name="verified" class="form-control chosen-select" data-placeholder="Choose verified ..."  data-parsley-error-message=" Please select verified " data-parsley-trigger="change">
                        <option value="" selected disabled >Select Verified</option>
                        <option value="1">Verified</option>
                        <option value="0">Not Verified</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Advertisement or Not : </label>
                <div class="col-sm-10">
                    <select class="form-control chosen-select" name="advertisement" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select advertisement status</option>
                        <option value="1">Yes</option>
                        <option value="0">No </option>
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label  class="col-sm-2 control-label">Advertisement Time Frame Date</label>
                <div class="col-sm-5">
                    <label>Date From</label>
                    <input type="text" class="form-control" name="advertisementTimeFrame" id="datePickerForSelection" readonly="" placeholder="Select advertisement time frame date here" required="" data-parsley-trigger="change" data-parsley-error-message="Please select advertisement time frame date here">                   
                </div>
                <div class="col-sm-5">
                    <label>Date To</label>
                    <input type="text" class="form-control" name="advertisementTimeFrameEnd" id="datePickerForSelection1" readonly="" placeholder="Select advertisement time frame date here" required="" data-parsley-trigger="change" data-parsley-error-message="Please select advertisement time frame date here">                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Calender Info : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('calenderinfo', null, ['class' => 'form-control', 'placeholder' => 'Enter calender info here', 'data-parsley-error-message' => 'Please enter calender info here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >User Name : </label>
                <div class="col-sm-10">
                    <select name="users_id" class="form-control chosen-select " data-placeholder="Choose user name..."  data-parsley-error-message=" Please select user name" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select User Name</option>  
                        @foreach( $usersObj as $users )
                            <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >University : </label>
                <div class="col-sm-10">
                    <select name="university_id" class="form-control chosen-select " data-placeholder="Choose university name..."  data-parsley-error-message=" Please select university name" data-parsley-trigger="change" >
                        <option value="" selected disabled>Select University Name</option>  
                        
                        @foreach ($universityObj as $university)
                            <option value="{{ $university->id }}">{{ $university->name }} </option>
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >College Type : </label>
                <div class="col-sm-10">
                    <select name="collegetype_id" class="form-control chosen-select " data-placeholder="Choose college type name..."  data-parsley-error-message=" Please select college type name" data-parsley-trigger="change" >
                        <option value="" selected disabled>Select College Type </option>  
                           @foreach ($collegeTypeObj as $college)
                            <option value="{{ $college->id }}">{{ $college->name }} </option>
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