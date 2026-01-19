@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Query <!-- <a href="{{ url('employee/query') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update query details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($query, ['method' => 'PATCH', 'url' => ['employee/query', $query->id],'class' => 'form-horizontal','data-parsley-validate' => '']) !!}

             <div class="form-group">
                <label class="col-sm-2 control-label" >Subject : </label>
                <div class="col-sm-10">
                    {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Enter subject here', 'data-parsley-error-message' => 'Please enter subject here']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Message : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Enter message here', 'data-parsley-error-message' => 'Please enter message here', 'required' => '']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Administrator Name : </label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="admin_id" class="form-control admin_id chosen-select">
                        <option value="" selected="" disabled="">Please select administrator</option>
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '1' )
                                @if( $query->admin_id == $users->id )
                                    <option value="{{ $users->id }}" selected="">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                                @else
                                    <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >College Name : </label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="college_id" class="form-control college_id chosen-select">
                        <option value="" selected="" disabled="">Please select college</option>
                        <!-- @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '2' )
                                @if( $query->college_id == $users->id )
                                    <option value="{{ $users->id }}" selected="">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                                @else
                                    <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                                @endif
                            @endif
                        @endforeach -->
                        @if( $collegeProfileObj )
                            @if( $collegeProfileObj->userRoleId == '2' )
                            <option value="{{ $collegeProfileObj->id }}" selected="">{{ $collegeProfileObj->firstname }}</option>
                            @endif
                        @endif
                        @foreach ($usersObj as $users)
                            @if( $users->userRoleId == '2' )
                             <option value="{{ $users->id }}">{{ $users->firstname }} </option>
                            @endif
                        @endforeach 
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Student Name : </label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh3"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="student_id" class="form-control student_id chosen-select" data-parsley-error-message="Please select student"  >
                        <option value="" selected="" disabled="">Please select student</option>
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '3' )
                                @if( $query->student_id == $users->id )
                                    <option value="{{ $users->id }}" selected="">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                                @else
                                    <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>



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

        $('.admin_id').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.admin_id').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('.college_id').on('change',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.college_id').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });

        $('.student_id').on('change',function(){
            $('#refresh3').removeClass('hide');
        });
        $('#refresh3').on('click',function(e){
            $('.student_id').val('').trigger('chosen:updated');
            $('#refresh3').addClass('hide');
        });

    });
</script>

@endsection