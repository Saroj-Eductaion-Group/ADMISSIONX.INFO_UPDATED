@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Application <!-- <a href="{{ URL::to('administrator/application') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update application details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($application, ['method' => 'PATCH', 'url' => ['administrator/application', $application->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}

            <!-- <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Application Status : </label>
                <div class="col-sm-10">
                    <select name="applicationstatus_id" class="form-control chosen-select " data-parsley-error-message=" Please select application status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select application status </option>  
                        @foreach ($applicationStatusObj as $app)
                            @if( $application->applicationstatus_id == $app->id )
                                <option value="{{ $app->id }}" selected="">{{ $app->name }} </option>
                            @else
                                <option value="{{ $app->id }}">{{ $app->name }}</option>
                            @endif
                        @endforeach     
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Remarks : </label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="4" placeholder="Enter the remarks" name="message" data-parsley-trigger="change" data-parsley-error-message="Please enter remarks"></textarea>
                </div>
            </div>
          <!--  <div class="form-group">
                <label class="col-sm-2 control-label" >College Profile : </label>
                <div class="col-sm-10">
                    <select name="collegeprofile_id" class="form-control chosen-select " data-parsley-error-message=" Please select college profile" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select college profile</option>  
                        @if( $collegeObj )
                            <option value="{{ $collegeObj->id }}" selected="">{{ $collegeObj->firstname }}</option>
                        @endif
                         @foreach ($collegeProfileObj as $college)
                                <option value="{{ $college->id }}">{{ $college->firstname }}</option>
                        @endforeach    
                    </select>     
                </div>
            </div> -->
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label" >User Name : </label>
                <div class="col-sm-10">
                    <select name="users_id" class="form-control chosen-select " data-parsley-error-message=" Please select user name" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select User Name</option> 
                        @foreach ($userObj as $user)
                            @if( $application->users_id == $user->id )
                                <option value="{{ $user->id }}" selected="">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                            @endif
                        @endforeach   
                    </select>     
                </div>
            </div> -->


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-3">
                    <!-- {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!} -->
                    <button class="btn btn-primary" type="submit">Update</button>
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