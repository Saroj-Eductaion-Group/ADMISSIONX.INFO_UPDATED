@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Blogs<!--  <a href="{{ url('administrator/blogs') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new blogs details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/blogs', 'class' => 'form-horizontal', 'data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Topic of the blog : </label>
                <div class="col-sm-10">
                    {!! Form::text('topic', null, ['class' => 'form-control', 'placeholder' => 'Enter topic of blogs here', 'data-parsley-error-message' => 'Please enter topic of blogs here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description of the blog : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description of blogs here', 'data-parsley-error-message' => 'Please enter description of blogs here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label"> Featured Image</label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" class="form-control" name="uploadFeatureImage" class="input input-file featuredImage"  data-parsley-trigger="change" data-parsley-error-message="Please upload only png , jpg or jpeg.">
                    <p class="text-danger hide" id="logoDoc">(please upload .png, .jpg and .jpeg file only)</p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" >Publish or Not : </label>
                <div class="col-sm-10">
                    <select class="form-control chosen-select" name="isactive" data-parsley-error-message=" Please select blogs status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select blog status</option>
                        <option value="1">Published</option>
                        <option value="0">Not Published</option>
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Author : </label>
                <div class="col-sm-10">
                    <select name="users_id" class="form-control chosen-select" data-parsley-error-message="Please select author" data-parsley-trigger="change" required="" >
                        <option value="" selected="" disabled="">Please select author</option>
                        @foreach( $usersObj as $users )
                            <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                        @endforeach
                    </select> 
                </div>
            </div>

            <hr>
            <div class="row">
               <div class="col-md-12">
                   <div class="headline"><h2>SEO Content</h2></div>
                    <input type="hidden" name="seopagename" value="blogpage">
                    @if(isset($seocontent) && (sizeof($seocontent) > 0))
                        @if(!empty($seocontent[0]->seoContentId))
                            <input type="hidden" name="seoContentId" value="{{ $seocontent[0]->seoContentId }}">
                        @endif
                        @include ('administrator.seo-content.seo-update-partial')
                    @else
                        @include ('administrator.seo-content.seo-create-partial')
                    @endif
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
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
  $('textarea').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){ 
        
        $('.featuredImage').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.featuredImage').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });


        $('input[name=featuredImage]').change(function (e)
        {  
            var ext = $('input[name=featuredImage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $('#logoDoc').addClass('hide');
            }else{
                $('input[name=featuredImage]').val('');
                $('#logoDoc').removeClass('hide');
                return false;
            }
            //Disable input file
        });  

        $('input[name=uploadFeatureImage]').change(function (e)
        {   
            var ext = $('input[name=uploadFeatureImage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=uploadFeatureImage]").parsley().reset();
            }else{
                $('input[name=uploadFeatureImage]').val('');
                $("input[name=uploadFeatureImage]").parsley().reset();
                return false;
            }
            //Disable input file
        });     
    });
</script>

@endsection