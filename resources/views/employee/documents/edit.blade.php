@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Student Profile <!-- <a href="{{ url('employee/documents') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update student profile details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($document, [
                'method' => 'PATCH',
                'url' => ['employee/documents', $document->id],
                'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data'
            ]) !!}

            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Your Document</label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" name="uploadCollegeDoc" class="documentName form-control"  value="{{ $document->name }}" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">
                </div>
                 <div class="col-sm-4">
                    <img src="{{ asset('document') }}/{{ $document->slug }}/{{ $document->documentsFullImage }}" class="img-thumbnail img-responsive">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-error-message' => 'Please enter description here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" >User Name : </label>
                <div class="col-sm-10">
                    <select name="users_id" class="form-control chosen-select " data-placeholder="Choose user name..."  data-parsley-error-message=" Please select user name" data-parsley-trigger="change"  required="">
                        <option value="" selected disabled>Select User Name</option>  
                         @foreach ($userObj as $user)
                            @if( $document->users_id == $user->id )
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