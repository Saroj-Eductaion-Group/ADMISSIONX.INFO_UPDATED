@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Testimonial <!-- <a href="{{ url('employee/testimonial') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Testimonial details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($testimonial, ['method' => 'PATCH', 'url' => ['employee/testimonial', $testimonial->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '','files'=>true, 'enctype' => 'multipart/form-data']) !!}

            <!-- <div class="form-group">
                <label class="col-sm-2 control-label" >Title : </label>
                <div class="col-sm-10">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title here', 'data-parsley-error-message' => 'Please enter title here', 'data-parsley-trigger'=>'change','required' => '']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Author Name : </label>
                <div class="col-sm-10">
                    <select name="author" class="form-control chosen-select " data-placeholder="Choose user name..."  data-parsley-error-message=" Please select user name" data-parsley-trigger="change"  required="">
                        <option value="" selected disabled>Select Author Name</option>  
                        @foreach ($userObj as $user)
                            @if( $testimonial->author == $user->id )
                                <option value="{{ $user->id }}" selected="">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                            @endif
                        @endforeach    
                    </select>     
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Author : </label>
                <div class="col-sm-10">
                    {!! Form::text('author', null, ['class' => 'form-control', 'placeholder' => 'Enter author here', 'data-parsley-error-message' => 'Please enter author here', 'data-parsley-trigger'=>'change', 'data-parsley-pattern'=>'^[a-zA-Z\s .]*$']) !!}
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Testimonial Image</label>
                <div class="col-sm-7">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" name="uploadTestimonialDoc" class="uploadTestimonialDoc form-control" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" required="" >
                     <p class="text-danger hide" id="testimonialImage">(please upload .png, .jpg and .jpeg file only)</p>
                </div>

                <div class="col-sm-3">
                    <img class="img-responsive thumbnail" src="/testimonial/{{ $testimonial->featuredimage }}" width="120" alt="{{ $testimonial->featuredimage }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                     {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here','data-parsley-error-message' => 'Please enter description here maximum 350 character', 'data-parsley-trigger'=>'change','required' => '','data-parsley-maxlength'=>'350','maxlength'=>'350']) !!}
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