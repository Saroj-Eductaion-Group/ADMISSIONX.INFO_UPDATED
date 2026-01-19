@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Social Media <!-- <a href="{{ url('employee/socialmanagement') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Social Media details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($socialmanagement, [ 'method' => 'PATCH', 'url' => ['employee/socialmanagement', $socialmanagement->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}
             <div class="form-group">
                <label class="col-sm-2 control-label" >Social Media Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Social Media Name here', 'data-parsley-error-message' => 'Please enter Social name here','data-parsley-trigger'=>'change', 'required' => '','readonly']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Url :</label>
                <div class="col-sm-10">
                    {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Enter Url here', 'data-parsley-error-message' => 'Please enter Url here','data-parsley-trigger'=>'change', 'required' => '','data-parsley-pattern'=>'^((http|https):\/\/)?([a-zA-Z0-9]+(\.[a-zA-Z0-9]+)+.*)$']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" >Isactive : </label>
                <div class="col-sm-10">
                    <select name="isActive" class="form-control chosen-select" value="{{ $socialmanagement->isActive }}" data-placeholder="Choose Isactive ..."  data-parsley-error-message=" Please select Isactive " data-parsley-trigger="change" required="">
                        <option value=""  selected disabled>Select Isactive</option>
                            @if( $socialmanagement->isActive == '1')
                                <option selected="" value="1">Active</option>
                                <option value="0">InActive</option>
                            @elseif( $socialmanagement->isActive == '0')
                                <option value="1">Active</option>
                                <option selected="" value="0">InActive</option>
                            @else( $socialmanagement->isActive == '')
                                <option value="" disabled ></option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            @endif                 
                    </select>
                </div>
            </div>      

            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description  here', 'data-parsley-error-message' => 'Please enter Description name here','data-parsley-trigger'=>'change']) !!}
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