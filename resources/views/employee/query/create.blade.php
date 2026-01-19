@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Query <!-- <a href="{{ url('employee/query') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new query details</h5>                            
            </div>
            <div class="ibox-content">

            {!! Form::open(['url' => 'employee/query', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
             <div class="form-group">
                <label class="col-sm-3 control-label" >Subject : </label>
                <div class="col-sm-9">
                    {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Enter subject here', 'data-parsley-error-message' => 'Please enter subject here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" >Message : </label>
                <div class="col-sm-9">
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Enter message here', 'data-parsley-error-message' => 'Please enter message here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" >Administrator Name : </label>
                <div class="col-sm-9">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="admin_id" class="form-control admin_id chosen-select">
                        <option value="" selected="" disabled="">Please select administrator</option>
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '1' )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" >College Name : </label>
                <div class="col-sm-9">
                     <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="college_id" class="form-control college_id chosen-select">
                        <option value="" selected="" disabled="">Please select college</option>
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '2' )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" >Student Name : </label>
                <div class="col-sm-9">
                     <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh3"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="student_id" class="form-control student_id chosen-select" data-parsley-error-message="Please select student"  data-parsley-trigger="change" >
                        <option value="" selected="" disabled="">Please select student</option>
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '3' )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}

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