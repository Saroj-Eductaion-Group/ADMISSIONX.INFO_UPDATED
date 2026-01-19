<div class="form-group {{ $errors->has('fromyear') ? 'has-error' : ''}}">
    {!! Form::label('fromyear', 'Fromyear', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('fromyear', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fromyear', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('toyear') ? 'has-error' : ''}}">
    {!! Form::label('toyear', 'Toyear', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('toyear', null, ['class' => 'form-control']) !!}
        {!! $errors->first('toyear', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    {!! Form::label('role', 'Role', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('role', null, ['class' => 'form-control']) !!}
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('organisation') ? 'has-error' : ''}}">
    {!! Form::label('organisation', 'Organisation', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('organisation', null, ['class' => 'form-control']) !!}
        {!! $errors->first('organisation', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    {!! Form::label('city', 'City', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
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