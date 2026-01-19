@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Student Profile <!-- <a href="{{ url('administrator/studentprofile') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new student profile details</h5>                            
            </div>
            <div class="ibox-content">

            {!! Form::open(['url' => 'administrator/studentprofile', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                <label class="col-sm-2 control-label" >Student Name : </label>
                <div class="col-sm-10">
                    <select name="usersName" class="form-control chosen-select " data-placeholder="Choose student name..."  data-parsley-error-message=" Please select student name" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Student Name</option>  
                        @foreach( $userObj as $users )
                            <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                        @endforeach   
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Parent Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('parentsname', null, ['class' => 'form-control', 'placeholder' => 'Enter parent name here', 'data-parsley-error-message' => 'Please enter your parent name', 'required' => '','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Parent Phone No : </label>
                <div class="col-sm-10">
                    {!! Form::text('parentsnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter parent phone no here', 'data-parsley-error-message' => 'Please enter your parent phone no', 'required' => '','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Gender : </label>
                <div class="col-sm-10">
                    <select name="gender" class="form-control chosen-select" data-placeholder="Choose sex ..." data-parsley-error-message=" Please select sex " data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>      
            <div class="form-group">
                <label  class="col-sm-2 control-label">Date Of Birth</label>
                <div class="col-sm-10">
                     {!! Form::date('dateofbirth', null, ['class' => 'form-control', 'id' => 'datepicker', 'placeholder' => 'Enter date of birth here ', 'data-parsley-error-message' => 'Please enter your date of birth', 'required' => '','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Hobbies : </label>
                <div class="col-sm-10">
                    {!! Form::text('hobbies', null, ['class' => 'form-control', 'placeholder' => 'Enter hobbies here', 'data-parsley-error-message' => 'Please enter your hobbies','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Interest : </label>
                <div class="col-sm-10">
                    {!! Form::text('interests', null, ['class' => 'form-control', 'placeholder' => 'Enter interests here', 'data-parsley-error-message' => 'Please enter your interests','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Entrance Exam Name : </label>
                <div class="col-sm-10">
                     <select name="entranceexamname" class="form-control chosen-select" data-parsley-trigger="change" data-parsley-error-message="Please select your entrance exam" >
                        @foreach ($entranceExam as $entrance)
                            @if( $studentprofile->entranceexamname == $entrance->id )
                                <option value="{{ $entrance->id }}" selected="">{{ $entrance->name }} </option>
                            @else
                                <option value="{{ $entrance->id }}">{{ $entrance->name }}</option>
                            @endif
                        @endforeach    
                   </select>  
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Entrance Exam No : </label>
                <div class="col-sm-10">
                    {!! Form::text('entranceexamnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter entrance exam number here', 'data-parsley-error-message' => 'Please enter your entrance exam number', 'required' => '','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Achievement Awards : </label>
                <div class="col-sm-10">
                     {!! Form::textarea('achievementsawards', null, ['class' => 'form-control', 'placeholder' => 'Enter achievement awards here', 'data-parsley-error-message' => 'Please enter your achievement awards','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" >Projects : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('projects', null, ['class' => 'form-control', 'placeholder' => 'Enter projects here', 'data-parsley-error-message' => 'Please enter your projects', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
           
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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
@section('script')

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
  $(function() {
    $("#datepicker").datepicker({ minDate: 0, dateFormat: 'dd/mm/yy' }).datepicker("setDate", new Date());
  });

</script>
@endsection