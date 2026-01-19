<div class="form-group {{ $errors->has('qualification') ? 'has-error' : ''}}">
    {!! Form::label('qualification', 'Qualification', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('qualification', null, ['class' => 'form-control']) !!}
        {!! $errors->first('qualification', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('course') ? 'has-error' : ''}}">
    {!! Form::label('course', 'Course', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('course', null, ['class' => 'form-control']) !!}
        {!! $errors->first('course', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('sunjects') ? 'has-error' : ''}}">
    {!! Form::label('sunjects', 'Sunjects', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('sunjects', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sunjects', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('collegename') ? 'has-error' : ''}}">
    {!! Form::label('collegename', 'Collegename', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('collegename', null, ['class' => 'form-control']) !!}
        {!! $errors->first('collegename', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('boardName') ? 'has-error' : ''}}">
    {!! Form::label('boardName', 'Boardname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('boardName', null, ['class' => 'form-control']) !!}
        {!! $errors->first('boardName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
    {!! Form::label('year', 'Year', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('year', null, ['class' => 'form-control']) !!}
        {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
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