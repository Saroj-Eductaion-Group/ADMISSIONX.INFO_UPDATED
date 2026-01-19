@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Student Profile <!-- <a href="{{ url('employee/galleries') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update student profile details</h5>                            
            </div>
            <div class="ibox-content">

            {!! Form::model($gallery, ['method' => 'PATCH','url' => ['employee/galleries', $gallery->id],'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Your Gallery</label>
                <div class="col-sm-7">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" name="uploadCollegeImg" class="galleryName form-control"  value="" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change", data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" >
                </div>
                <div class="col-sm-3">
                    @if( $gallery->galleryFullImage )
                        <img src="{{ asset('gallery') }}/{{ $gallery->slug }}/{{ $gallery->galleryFullImage }}" class="img-thumbnail 
                        img-responsive">
                    @else
                        <img src="{{ asset('assets/images/no-college-logo.png') }}" class="img-thumbnail img-responsive">
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Caption : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="caption" value="{{ $gallery->caption }}" placeholder="Enter caption here" data-parsley-trigger="change" data-parsley-error-message="Please enter caption" >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" >User Name : </label>
                <div class="col-sm-10">
                    <select name="usersName" class="form-control chosen-select " data-parsley-error-message=" Please select user name" data-parsley-trigger="change"  required="">
                        <option value="" selected disabled>Select User Name</option>  
                         @foreach ($userObj as $user)
                            @if( $gallery->users_id == $user->id )
                                <option value="{{ $user->id }}" selected="">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
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