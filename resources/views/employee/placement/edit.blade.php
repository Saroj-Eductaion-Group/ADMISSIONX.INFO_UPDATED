@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Address Type <!-- <a href="{{ url('employee/addresstype') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Address Type details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($placement, ['method' => 'PATCH','url' => ['employee/placement', $placement->id],'class' => 'form-horizontal','data-parsley-validate' => '']) !!}

            <div class="form-group">
                <label class="col-sm-3 control-label" >Number Of Recruiting Company : </label>
                <div class="col-sm-9">
                    {!! Form::text('numberofrecruitingcompany', null, ['class' => 'form-control', 'placeholder' => 'Enter number of recruiting company here', 'data-parsley-error-message' => 'Please enter number of recruiting company here', 'required' => '','data-parsley-type'=>'number','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" >Number Of Placement Last Year : </label>
                <div class="col-sm-9">
                    {!! Form::text('numberofplacementlastyear', null, ['class' => 'form-control', 'placeholder' => 'Enter number of placement last year here', 'data-parsley-error-message' => 'Please enter number of placement last year here', 'required' => '','data-parsley-type'=>'number','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
           <div class="form-group">
                <label class="col-sm-3 control-label" >CTC Highest : </label>
                <div class="col-sm-9">
                    {!! Form::text('ctchighest', null, ['class' => 'form-control', 'placeholder' => 'Enter ctc highest here', 'data-parsley-error-message' => 'Please enter ctc highest here', 'required' => '','data-parsley-pattern'=> '^[0-9a-zA-Z\s.,]*$','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" >CTC Lowest : </label>
                <div class="col-sm-9">
                    {!! Form::text('ctclowest', null, ['class' => 'form-control', 'placeholder' => 'Enter ctc lowest here', 'data-parsley-error-message' => 'Please enter ctc lowest here', 'required' => '','data-parsley-pattern'=> '^[0-9a-zA-Z\s.,]*$','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" >CTC Average : </label>
                <div class="col-sm-9">
                    {!! Form::text('ctcaverage', null, ['class' => 'form-control', 'placeholder' => 'Enter ctc average here', 'data-parsley-error-message' => 'Please enter ctc average here', 'required' => '','data-parsley-pattern'=> '^[0-9a-zA-Z\s.,]*$','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" >Placement Info : </label>
                <div class="col-sm-9">
                    {!! Form::textarea('placementinfo', null, ['class' => 'form-control', 'placeholder' => 'Enter placement info here', 'data-parsley-error-message' => 'Please enter placement info here', 'required' => '','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" >College Profile : </label>
                <div class="col-sm-9">
                    <select name="collegeprofile_id" class="form-control chosen-select " data-parsley-error-message=" Please select college profile" data-parsley-trigger="change">
                        <option value="" selected disabled>Select college profile</option>  
                        @foreach ($collegeProfileObj as $college)
                            @if( $placement->collegeprofile_id == $college->collegeprofileID )
                                <option value="{{ $college->collegeprofileID }}" selected="">{{ $college->firstname }} </option>
                            @else
                                <option value="{{ $college->collegeprofileID }}">{{ $college->firstname }}</option>
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