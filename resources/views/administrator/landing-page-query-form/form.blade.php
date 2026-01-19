<div class="form-group {{ $errors->has('fullname') ? 'has-error' : ''}}">
    {!! Form::label('fullname', 'Fullname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('fullname', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fullname', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('mobilenumber') ? 'has-error' : ''}}">
    {!! Form::label('mobilenumber', 'Mobilenumber', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('mobilenumber', null, ['class' => 'form-control']) !!}
        {!! $errors->first('mobilenumber', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('emailaddress') ? 'has-error' : ''}}">
    {!! Form::label('emailaddress', 'Emailaddress', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('emailaddress', null, ['class' => 'form-control']) !!}
        {!! $errors->first('emailaddress', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    {!! Form::label('subject', 'Subject', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    {!! Form::label('message', 'Message', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('users_id') ? 'has-error' : ''}}">
    {!! Form::label('users_id', 'Users Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('users_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('users_id', '<p class="help-block">:message</p>') !!}
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