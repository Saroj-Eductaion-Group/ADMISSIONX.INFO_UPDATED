<div class="form-group {{ $errors->has('functionalarea_id') ? 'has-error' : ''}}">
    {!! Form::label('functionalarea_id', 'Functionalarea Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('functionalarea_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('functionalarea_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('educationlevel_id') ? 'has-error' : ''}}">
    {!! Form::label('educationlevel_id', 'Educationlevel Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('educationlevel_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('educationlevel_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('degree_id') ? 'has-error' : ''}}">
    {!! Form::label('degree_id', 'Degree Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('degree_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('degree_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('coursetype_id') ? 'has-error' : ''}}">
    {!! Form::label('coursetype_id', 'Coursetype Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('coursetype_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('coursetype_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('course_id') ? 'has-error' : ''}}">
    {!! Form::label('course_id', 'Course Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('course_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('faculty_id') ? 'has-error' : ''}}">
    {!! Form::label('faculty_id', 'Faculty Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('faculty_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('faculty_id', '<p class="help-block">:message</p>') !!}
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