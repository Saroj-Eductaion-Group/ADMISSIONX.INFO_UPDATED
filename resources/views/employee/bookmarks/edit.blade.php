@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Bookmarks <!-- <a href="{{ url('employee/bookmarks') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update bookmark details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($bookmark, [
                'method' => 'PATCH',
                'url' => ['employee/bookmarks', $bookmark->id],
                'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data'
            ]) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Student Profile : </label>
                <div class="col-sm-10">
                    <select name="studentProfileName" class="form-control chosen-select " data-placeholder="Choose student profile..."  data-parsley-error-message=" Please select student profile" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Student Profile</option>
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '3' )
                                @if( $bookmark->student_id == $users->id )
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
                <label class="col-sm-2 control-label" >College Profile : </label>
                <div class="col-sm-10">
                    <select name="collegeProfile" class="form-control chosen-select " data-placeholder="Choose college profile..."  data-parsley-error-message=" Please select college profile" data-parsley-trigger="change"required="">
                        <option value="" selected disabled>Select College Profile</option>  
                         @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '2' )
                                @if( $bookmark->college_id == $users->id )
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
                <label class="col-sm-2 control-label" >Courses : </label>
                <div class="col-sm-10">
                    <select name="courseName" class="form-control chosen-select " data-placeholder="Choose courses..."  data-parsley-error-message=" Please select courses" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Courses</option>  
                        @foreach ($course as $course)
                            @if( $bookmark->course_id == $course->id )
                                <option value="{{ $course->id }}" selected=""> {{ $course->name }}</option>
                            @else
                                <option value="{{ $course->id }}"> {{ $course->name }}</option>
                            @endif
                        @endforeach  
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Blogs : </label>
                <div class="col-sm-10">
                    <select name="blogName" class="form-control chosen-select " data-placeholder="Choose blog name..."  data-parsley-error-message=" Please select blog name" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Blogs</option>  
                        @foreach ($blog as $blog)
                            @if( $bookmark->blog_id == $blog->id )
                                <option value="{{ $blog->id }}" selected="">{{ $blog->id }} {{ $blog->topic }}</option>
                            @else
                                <option value="{{ $blog->id }}">{{ $blog->id }} {{ $blog->topic }}</option>
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