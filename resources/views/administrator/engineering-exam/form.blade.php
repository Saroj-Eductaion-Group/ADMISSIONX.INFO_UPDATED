<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
    {!! Form::label('firstname', 'Firstname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('middlename') ? 'has-error' : ''}}">
    {!! Form::label('middlename', 'Middlename', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('middlename', null, ['class' => 'form-control']) !!}
        {!! $errors->first('middlename', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
    {!! Form::label('lastname', 'Lastname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
        {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('fathername') ? 'has-error' : ''}}">
    {!! Form::label('fathername', 'Fathername', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('fathername', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fathername', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    {!! Form::label('category', 'Category', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('category', null, ['class' => 'form-control']) !!}
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('gender', null, ['class' => 'form-control']) !!}
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('nationality') ? 'has-error' : ''}}">
    {!! Form::label('nationality', 'Nationality', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nationality', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nationality', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('choice1st') ? 'has-error' : ''}}">
    {!! Form::label('choice1st', 'Choice1st', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('choice1st', null, ['class' => 'form-control']) !!}
        {!! $errors->first('choice1st', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('choice2nd') ? 'has-error' : ''}}">
    {!! Form::label('choice2nd', 'Choice2nd', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('choice2nd', null, ['class' => 'form-control']) !!}
        {!! $errors->first('choice2nd', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('choice3rd') ? 'has-error' : ''}}">
    {!! Form::label('choice3rd', 'Choice3rd', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('choice3rd', null, ['class' => 'form-control']) !!}
        {!! $errors->first('choice3rd', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firstaddress1') ? 'has-error' : ''}}">
    {!! Form::label('firstaddress1', 'Firstaddress1', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstaddress1', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firstaddress1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firstaddress2') ? 'has-error' : ''}}">
    {!! Form::label('firstaddress2', 'Firstaddress2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstaddress2', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firstaddress2', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firstaddress3') ? 'has-error' : ''}}">
    {!! Form::label('firstaddress3', 'Firstaddress3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstaddress3', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firstaddress3', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firstcity') ? 'has-error' : ''}}">
    {!! Form::label('firstcity', 'Firstcity', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstcity', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firstcity', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firststate') ? 'has-error' : ''}}">
    {!! Form::label('firststate', 'Firststate', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firststate', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firststate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firstpincode') ? 'has-error' : ''}}">
    {!! Form::label('firstpincode', 'Firstpincode', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstpincode', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firstpincode', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('firstcontact') ? 'has-error' : ''}}">
    {!! Form::label('firstcontact', 'Firstcontact', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstcontact', null, ['class' => 'form-control']) !!}
        {!! $errors->first('firstcontact', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondaddress1') ? 'has-error' : ''}}">
    {!! Form::label('secondaddress1', 'Secondaddress1', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('secondaddress1', null, ['class' => 'form-control']) !!}
        {!! $errors->first('secondaddress1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondaddress2') ? 'has-error' : ''}}">
    {!! Form::label('secondaddress2', 'Secondaddress2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('secondaddress2', null, ['class' => 'form-control']) !!}
        {!! $errors->first('secondaddress2', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondaddress3') ? 'has-error' : ''}}">
    {!! Form::label('secondaddress3', 'Secondaddress3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('secondaddress3', null, ['class' => 'form-control']) !!}
        {!! $errors->first('secondaddress3', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondcity') ? 'has-error' : ''}}">
    {!! Form::label('secondcity', 'Secondcity', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('secondcity', null, ['class' => 'form-control']) !!}
        {!! $errors->first('secondcity', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondstate') ? 'has-error' : ''}}">
    {!! Form::label('secondstate', 'Secondstate', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('secondstate', null, ['class' => 'form-control']) !!}
        {!! $errors->first('secondstate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondpincode') ? 'has-error' : ''}}">
    {!! Form::label('secondpincode', 'Secondpincode', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('secondpincode', null, ['class' => 'form-control']) !!}
        {!! $errors->first('secondpincode', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secondcontact') ? 'has-error' : ''}}">
    {!! Form::label('secondcontact', 'Secondcontact', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('secondcontact', null, ['class' => 'form-control']) !!}
        {!! $errors->first('secondcontact', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('addresssame') ? 'has-error' : ''}}">
    {!! Form::label('addresssame', 'Addresssame', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('addresssame', null, ['class' => 'form-control']) !!}
        {!! $errors->first('addresssame', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>