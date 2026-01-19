@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New User <!-- <a href="{{ url('administrator/users') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new user details</h5>                            
            </div>
            <div class="ibox-content">
                {!! Form::open(['url' => 'administrator/users', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-7 col-md-offset-3">
                        @if(Session::has('warning'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('warning') }}</strong>
                            </div>                        
                        @endif
                    </div>    
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Role : </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="userRole" data-parsley-trigger="change" data-parsley-error-message="Please select role for this user" required="">
                            <option value="" disabled="" selected="">Select role for this user</option>
                            @foreach( $userRoleObj as $userRole )
                                <option value="{{ $userRole->id }}">{{ $userRole->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="suffixForm hide">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">Suffix : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="suffix">
                                <option value="" disabled selected>Select suffix</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Mrs.">Mrs.</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="firstNameForm hide">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label collegeOtherName" >First Name : </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="firstName" placeholder="Enter name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your name"  required="">
                            <!-- data-parsley-pattern="^[a-zA-Z\\/s .-]*$" -->
                        </div>
                    </div>
                </div>

                <div class="middleLastForm hide">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Middle Name : </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="middleName" placeholder="Enter middle name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your middle name" >
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Last Name : </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="lastName" placeholder="Enter last name here"  data-parsley-trigger="change" data-parsley-error-message="Please enter your last name">
                        </div>
                    </div>
                </div>

                <div class="restForm hide">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone number here" data-parsley-trigger="change" data-parsley-type="digits"  data-parsley-error-message="Please enter valid phone number" > <!-- data-parsley-length="[7, 12]" data-parsley-maxlength="12" maxlength="12" -->
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email : </label>
                        <div class="col-sm-10">
                            <input class="form-control validateEmailAddress" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address">
                            <p class="text-danger validateEmailAddressMsg hide">This email address is already exist with another user, try again with another email address.</p> 
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password : </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Enter password here" data-parsley-trigger="change" data-parsley-error-message="Please enter at least 6 characters" data-parsley-minlength="6" required="">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="userStatus" data-parsley-trigger="change" data-parsley-error-message="Please select status for this user" required="">
                                <option value="" disabled="" selected="">Select status for this user</option>
                                @foreach( $userStatusObj as $userStatus )
                                    <option value="{{ $userStatus->id }}">{{ $userStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary createUser form-control']) !!}
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
@include('administrator.users.validate-email-script')
<script type="text/javascript">
    $(document).ready(function(){
        window.setTimeout(function() { $(".alert-danger").alert('close'); }, 8000);
    });
</script>

<script type="text/javascript">
    $('select[name=userRole]').on('change', function(){
        var userRole = $(this).val();
        if( userRole == '2' ){
            $('.firstNameForm').removeClass('hide');
            $('.restForm').removeClass('hide');
            $('.restForm').removeClass('hide');
            $('.suffixForm').addClass('hide');
            $('.middleLastForm').addClass('hide');
            $('.collegeOtherName').text('College Name');
            $('input[name=firstName]').attr('placeholder','Please enter your name');
            $('input[name=firstName]').attr('data-parsley-error-message', 'Please enter your name');
        }else{
            $('.suffixForm').removeClass('hide');
            $('.firstNameForm').removeClass('hide');
            $('.middleLastForm').removeClass('hide');
            $('.restForm').removeClass('hide');
            $('.collegeOtherName').text('First Name');
            $('form').parsley();
            $('input[name=firstName]').attr('data-parsley-error-message', 'Please enter your first name');
            $('input[name=firstName]').attr('placeholder','Please enter your name');
        }
    });  
</script>
@endsection