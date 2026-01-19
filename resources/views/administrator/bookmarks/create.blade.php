@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Bookmark <!-- <a href="{{ url('administrator/bookmarks') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new bookmark details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/bookmarks', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Student Name : </label>
                <div class="col-sm-10">
                    <select name="studentProfile" class="form-control chosen-select " data-placeholder="Choose student name..."  data-parsley-error-message=" Please select student name" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Student Name</option>  
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '3' )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endif
                        @endforeach    
                    </select>     
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" >Type of Bookmark : </label>
                <div class="col-sm-10">
                    <select class="form-control typeOfBookmark " data-parsley-error-message=" Please select type of bookmark" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Type Of Bookmark</option>  
                        <option value="1">College</option>
                        <option value="2">Course</option>
                        <option value="3">Blog</option>
                    </select>     
                </div>
            </div>

            <div class="form-group collegeProfileBlock hide">
                <label class="col-sm-2 control-label" >College Name : </label>
                <div class="col-sm-10">
                    <select name="collegeProfile" class="form-control" >
                        <option value="" selected disabled>Select College Name</option>  
                         @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '2' )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endif
                        @endforeach   
                    </select>     
                </div>
            </div>
            <div class="form-group courseNameBlock hide">
                <label class="col-sm-2 control-label" >Courses : </label>
                <div class="col-sm-10">
                    <select name="courseName">
                        <option value="" selected disabled>Select Courses</option>  
                        @foreach ($course as $courses)
                            <option value="{{ $courses->id }}">{{ $courses->name }}</option>
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group blogNameBlock hide">
                <label class="col-sm-2 control-label" >Blogs : </label>
                <div class="col-sm-10">
                    <select name="blogName" class="form-control" >
                        <option value="" selected disabled>Select Blogs</option>  
                        @foreach ($blog as $blog)
                            <option value="{{ $blog->id }}">{{ $blog->topic }}</option>
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
        $('.typeOfBookmark').on('change', function(){

            $('.collegeProfileBlock').addClass('hide');
            $('.courseNameBlock').addClass('hide');
            $('.blogNameBlock').addClass('hide');

            var listId = $('.typeOfBookmark option:selected').val();
            if( listId == '1' ){
                $('.collegeProfileBlock').removeClass('hide');
            }else if( listId == '2' ){
                $('.courseNameBlock').removeClass('hide');
            }else{
                $('.blogNameBlock').removeClass('hide');
            }
        });
    });
</script>
@endsection