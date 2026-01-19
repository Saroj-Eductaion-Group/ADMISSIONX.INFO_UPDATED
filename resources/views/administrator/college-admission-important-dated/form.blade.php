<div class="form-group {{ $errors->has('fromdate') ? 'has-error' : ''}}">
    {!! Form::label('fromdate', 'Fromdate', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('fromdate', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fromdate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('todate') ? 'has-error' : ''}}">
    {!! Form::label('todate', 'Todate', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('todate', null, ['class' => 'form-control']) !!}
        {!! $errors->first('todate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('eventName') ? 'has-error' : ''}}">
    {!! Form::label('eventName', 'Eventname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('eventName', null, ['class' => 'form-control']) !!}
        {!! $errors->first('eventName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('collegeAdmissionProcedure_id') ? 'has-error' : ''}}">
    {!! Form::label('collegeAdmissionProcedure_id', 'Collegeadmissionprocedure Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('collegeAdmissionProcedure_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('collegeAdmissionProcedure_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('users_id') ? 'has-error' : ''}}">
    {!! Form::label('users_id', 'Users Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('users_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('users_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('collegeprofile_id') ? 'has-error' : ''}}">
    {!! Form::label('collegeprofile_id', 'Collegeprofile Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('collegeprofile_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('collegeprofile_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : ''}}">
    {!! Form::label('employee_id', 'Employee Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('employee_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>