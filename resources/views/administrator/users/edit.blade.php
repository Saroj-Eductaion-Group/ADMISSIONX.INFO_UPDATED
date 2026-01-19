@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update User <!-- <a href="{{ url('administrator/users') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update user details</h5>                            
            </div>
            <div class="ibox-content">
                {!! Form::model($user, ['method' => 'PATCH', 'url' => ['administrator/users', $user->id], 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off' ]) !!}

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
                @if($user->userrole_id == '2')
                    <div class="form-group">
                        <label class="col-sm-2 control-label">College Name : </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="firstName" value="{{ $user->firstname }}" placeholder="Enter first name here" placeholder="Enter first name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your first name" required="">
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Suffix : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="suffix">
                                @if( !empty($user->suffix) )
                                <option value="{{ $user->suffix }}">{{ $user->suffix }}</option>
                                @else
                                <option value="" disabled selected>Select suffix</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Mrs.">Mrs.</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">First Name : </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="firstName" value="{{ $user->firstname }}" placeholder="Enter first name here" placeholder="Enter first name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your first name" required="">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Middle Name : </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="middleName" value="{{ $user->middlename }}" placeholder="Enter middle name here" placeholder="Enter middle name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your middle name" >
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Last Name : </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="lastName" value="{{ $user->lastname }}" placeholder="Enter last name here" placeholder="Enter last name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your last name">
                        </div>
                    </div>
                @endif

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Enter phone number here" placeholder="Enter phone number here" data-parsley-trigger="change" data-parsley-type="digits"  data-parsley-error-message="Please enter valid phone number">
                        <!--  data-parsley-maxlength="12" maxlength="12" data-parsley-length="[7, 12]"-->
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email : </label>
                    <div class="col-sm-10">
                        <input class="form-control change-email-box" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" value="{{ $user->email }}" autocomplete="off" placeholder="Enter email here">
                    </div>
                </div>
                 <div class="hr-line-dashed"></div>
                <div class="form-group">
                     <label class="col-sm-2 control-label">Password : </label>
                    <div class="col-sm-10">
                        <a href="javascript:void(0);" id="changePassword" class="btn btn-primary">Change Password</a>
                        <input type="password" name="password" value="" class="form-control hide change-password-box" placeholder="Enter password here">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Role : </label>
                    <div class="col-sm-10">
                        @if( $user->userrole_id == '2' )
                            <label class="control-label">ROLE_COLLEGE</label>
                        @elseif( $user->userrole_id == '3' )
                            <label class="control-label">ROLE_STUDENT</label>
                        @else
                            <select class="form-control" name="userRole" data-parsley-trigger="change" data-parsley-error-message="Please select role for this user" required="">
                                <option value="" disabled="" selected="">Select role for this user</option>
                                @foreach( $userRoleObj as $userRole )
                                    @if( $user->userrole_id == $userRole->id )
                                        <option value="{{ $userRole->id }}" selected="">{{ $userRole->name }}</option>
                                    @else
                                        <option value="{{ $userRole->id }}">{{ $userRole->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif                        
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status : </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="userStatus" data-parsley-trigger="change" data-parsley-error-message="Please select status for this user" required="">
                            <option value="" disabled="" selected="">Select status for this user</option>
                            @foreach( $userStatusObj as $userStatus )
                                @if( $user->userstatus_id == $userStatus->id )
                                    <option value="{{ $userStatus->id }}" selected="">{{ $userStatus->name }}</option>
                                @else
                                    <option value="{{ $userStatus->id }}">{{ $userStatus->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                
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

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            window.setTimeout(function() { $(".alert-danger").alert('close'); }, 8000);
        });
    </script>
     <script type="text/javascript">
        $('#changePassword').on('click',function(){
            $('#changePassword').addClass('hide');
            $('.change-password-box').val('');
            $('.change-password-box').removeClass('hide');
            $('.change-password-box').addClass('animated');
            $('.change-password-box').addClass('fadeInDown');
            $('.change-password-box').attr('required', 'required');
            $('.change-password-box').attr('data-parsley-error-message', 'Please enter password of minimum 5 characters');
            $('.change-password-box').attr('data-parsley-trigger', 'change');
            $('.change-password-box').attr('data-parsley-minlength', '5');
            $('.change-password-box').attr('data-parsley-maxlength', '20');
        });

        
    </script>
@endsection  