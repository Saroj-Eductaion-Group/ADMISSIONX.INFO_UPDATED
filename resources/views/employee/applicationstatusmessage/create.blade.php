@extends('employee/admin-layouts.master')

@section('content')

    <h1>Create New Applicationstatusmessage</h1>
    <hr/>

    {!! Form::open(['url' => 'employee/applicationstatusmessage', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('application_id') ? 'has-error' : ''}}">
                {!! Form::label('application_id', 'Application Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('application_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('application_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('student_id') ? 'has-error' : ''}}">
                {!! Form::label('student_id', 'Student Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('student_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('student_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('college_id') ? 'has-error' : ''}}">
                {!! Form::label('college_id', 'College Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('college_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('college_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('admin_id') ? 'has-error' : ''}}">
                {!! Form::label('admin_id', 'Admin Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('admin_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('admin_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('applicationStatus') ? 'has-error' : ''}}">
                {!! Form::label('applicationStatus', 'Applicationstatus: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('applicationStatus', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('applicationStatus', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
                {!! Form::label('message', 'Message: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('others') ? 'has-error' : ''}}">
                {!! Form::label('others', 'Others: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('others', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('others', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection