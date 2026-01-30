@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Blogs</h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update blogs details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($blog, ['method' => 'PATCH','url' => ['administrator/blogs', $blog->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Topic of the blog : </label>
                <div class="col-sm-10">
                    {!! Form::text('topic', null, ['class' => 'form-control', 'placeholder' => 'Enter topic of blogs here', 'data-parsley-error-message' => 'Please enter topic of blogs here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description of the blog : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description of blogs here', 'data-parsley-error-message' => 'Please enter description of blogs here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Publish or Not : </label>
                <div class="col-sm-10">
                    <select class="form-control chosen-select" name="isactive" data-parsley-error-message=" Please select blogs status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select blog status</option>
                        @if( $blog->isactive == '1' )
                            <option value="1" selected="">Published</option>
                            <option value="0">Not Published</option>
                        @else
                            <option value="1">Published</option>
                            <option value="0" selected="">Not Published</option>
                        @endif
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Author : </label>
                <div class="col-sm-10">
                    <select name="users_id" class="form-control chosen-select" data-parsley-error-message="Please select author" data-parsley-trigger="change" required="" >
                        <option value="" selected="" disabled="">Please select author</option>
                        @foreach( $usersObj as $users )
                            @if( $blog->users_id == $users->id )
                                <option value="{{ $users->id }}" selected="">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                            @else
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                            @endif
                        @endforeach
                    </select> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Featured Image</label>
                <div class="col-sm-5">
                    <!-- Fixed: Removed duplicate class attribute -->
                    <input type="file" class="form-control" name="uploadFeatureImage" id="uploadFeatureImage" 
                           data-parsley-trigger="change" 
                           data-parsley-error-message="Please upload only png, jpg or jpeg.">
                    <p class="text-muted">Current image will be replaced. Allowed: JPG, JPEG, PNG</p>
                    @if ($errors->has('uploadFeatureImage'))
                        <span class="text-danger">{{ $errors->first('uploadFeatureImage') }}</span>
                    @endif
                    @if (Session::has('error_message'))
                        <span class="text-danger">{{ Session::get('error_message') }}</span>
                    @endif
                </div>
                <div class="col-sm-5">
                    @if( $blog->featimage )
                        <img class="img-responsive thumbnail" src="/blogs/{{ $blog->featimage }}" width="180" alt="{{ $blog->featimage }}">
                        <p class="text-muted mt-2">Current Image</p>
                    @else
                        <span class="label label-warning">No image uploaded yet</span>
                    @endif 
                </div>
            </div>

            <hr>
            <div class="row">
               <div class="col-md-12">
                   <div class="headline"><h2>SEO Content</h2></div>
                    <input type="hidden" name="seopagename" value="blogpage">
                    @if(isset($seocontent) && count($seocontent) > 0)
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
        // File validation
        $('#uploadFeatureImage').change(function (e) {   
            var ext = $(this).val().split('.').pop().toLowerCase();
            var allowed = ['jpg', 'jpeg', 'png'];
            
            if ($.inArray(ext, allowed) == -1) {
                alert('Please upload only jpg, jpeg or png files.');
                $(this).val('');
                return false;
            }
            
            // Check file size (5MB limit)
            if (this.files[0].size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB.');
                $(this).val('');
                return false;
            }
        });     
    });
</script>

@endsection