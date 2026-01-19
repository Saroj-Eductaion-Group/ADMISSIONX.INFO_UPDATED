@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update College Facilities <!-- <a href="{{ url('employee/collegefacilities') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update college facilities details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($collegefacility, [
                'method' => 'PATCH',
                'url' => ['employee/collegefacilities', $collegefacility->id],
                'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data'
            ]) !!}

              <!-- <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                </div>
            </div> -->
             
            <div class="form-group">
                <label class="col-sm-2 control-label" >Facilities : </label>
                <div class="col-sm-10">
                    <select name="facilities_id" class="form-control chosen-select " data-placeholder="Choose facilities..."  data-parsley-error-message=" Please select facilities" data-parsley-trigger="change">
                        <option value="" selected disabled>Select Facilities</option>  
                        @foreach ($facilitiesObj as $facilities)
                            @if( $collegefacility->facilities_id == $facilities->id )
                                <option value="{{ $facilities->id }}" selected="">{{ $facilities->name }} </option>
                            @else
                                <option value="{{ $facilities->id }}">{{ $facilities->name }}</option>
                            @endif
                        @endforeach    
                    </select>     
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >College Profile : </label>
                <div class="col-sm-10">
                    <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose college profile..."  data-parsley-error-message=" Please select college profile" data-parsley-trigger="change">
                        <option value="" selected disabled>Select College Profile</option>  
                        <!-- @foreach( $collegeProfileObj as $college )
                            @if( $college->userRoleId == '2' )
                                @if( $collegefacility->collegeprofile_id == $college->id )
                                    <option value="{{ $college->id }}" selected="">{{ $college->firstname }} {{ $college->middlename }} {{ $college->lastname }} </option>
                                @else
                                    <option value="{{ $college->id }}">{{ $college->firstname }} {{ $college->middlename }} {{ $college->lastname }} </option>
                                @endif
                            @endif
                        @endforeach  -->

                        @if( $collegeObj )
                            <option value="{{ $collegeObj->id }}" selected="">{{ $collegeObj->firstname }}</option>
                        @endif
                       
                        @foreach( $collegeProfileObj as $college )
                            @if( $college->userRoleId == '2' )
                                <option value="{{ $college->id }}">{{ $college->firstname }} {{ $college->middlename }} {{ $college->lastname }} </option>
                            @endif
                        @endforeach 
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-error-message' => 'Please enter description here','data-parsley-trigger'=>'change']) !!}
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
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection