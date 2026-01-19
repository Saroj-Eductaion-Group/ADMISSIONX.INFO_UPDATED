@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New News <a href="{{ url($fetchDataServiceController->routeCall().'/news') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>
@if(Session::has('flash_message'))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>{{ Session::get('flash_message') }}</strong>
            </div>
        </div>
    </div>
@endif
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new news details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/news', 'class' => 'form-horizontal', 'data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label" >Topic of the blog : </label>
                    <div class="">
                        {!! Form::text('topic', null, ['class' => 'form-control', 'placeholder' => 'Enter topic of news here', 'data-parsley-error-message' => 'Please enter topic of news here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <label class="control-label" >Description of the blog : </label>
                    <div class="">
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description of news here', 'data-parsley-error-message' => 'Please enter description of news here', 'data-parsley-trigger'=>'change']) !!}
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <label  class="control-label"> Featured Image</label>
                    <div class="">
                        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
                         <input type="file" class="form-control" name="uploadFeatureImage" class="input input-file featuredImage"  data-parsley-error-message="Please upload only png , jpg or jpeg." onchange="readURL(this);" autofocus="" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">
                         <img  class="img-responsive margin-top15"  id="uploadImage" src="/assets/img/testimonials2.jpg" alt="your image" style="width: 160px; height: 160px; "/>
                        <p class="text-danger hide" id="logoDoc">(please upload .png, .jpg and .jpeg file only)</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="control-label" >Publish or Not : </label>
                    <div class="">
                        <select class="form-control chosen-select" name="isactive" data-parsley-error-message=" Please select news status" data-parsley-trigger="change" required="">
                            <option value="" selected disabled >Select blog status</option>
                            <option value="1">Published</option>
                            <option value="0">Not Published</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="control-label" >Author : </label>
                    <div class="">
                        <select name="users_id" class="form-control chosen-select" data-parsley-error-message="Please select author" data-parsley-trigger="change" required="" >
                            <option value="" selected="" disabled="">Please select author</option>
                            @foreach( $usersObj as $users )
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                   <label class="control-label">News Type</label>
                   <div>
                        <select class="form-control chosen-select newstypeids" name="newstypeids" data-parsley-error-message="Please select news type" data-parsley-trigger="change">
                            <option value="" selected="" disabled="">Please select news types</option>
                            @foreach( $newsTypeObj as $item )
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                     <label class="control-label">News Tags</label>
                     <div>
                        <select class="form-control chosen-select newstagsids" name="newstagsids[]" data-parsley-error-message="Please select news tags" multiple="" data-parsley-trigger="change">
                            <option value="" disabled="">Please select news tags</option>
                            @foreach( $newsTagObj as $item )
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-md-12">
                   <div class="headline"><h2>SEO Content</h2></div>
                    <input type="hidden" name="seopagename" value="newspage">
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
            <hr>
            <div class="row">
                <div class="text-center">
                    <button class="btn btn-primary btn-md">Create</button>
                </div>
            </div>
            <hr>
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
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('#uploadPdfFile').change(function (e)
{  
    var ext = $('#uploadPdfFile').val().split('.').pop().toLowerCase();
    if(ext == 'pdf'){
        $('#documentFile').addClass('hide');
    }else{
        $('input[name=uploadPdfFile]').val('');
        $('#documentFile').removeClass('hide');
        return false;
    }
    //Disable input file
});
</script>

<script type="text/javascript">
    $(function () {
        var myEditor = $('#myTextEditor1');
        myEditor.ckeditor({ 
        height: 200, 
        extraPlugins: 'charcount', 
        maxLength: 1000, 
        toolbar: 'TinyBare', 
        toolbar_TinyBare: [
             ['Bold','Italic','Underline'],
             ['Undo','Redo'],['Cut','Copy','Paste'],
             ['NumberedList','BulletedList','Table'],['CharCount']
        ] 
        }).ckeditor().editor.on('key', function(obj) {
            if (obj.data.keyCode === 8 || obj.data.keyCode === 46) {
                return true;
            }
            if (myEditor.ckeditor().editor.document.getBody().getText().length >= 1000) {
                alert('No more characters possible');
                return false;
            }else { return true; }

        });
    });

     $(function () {
        var myEditor = $('#myTextEditor2');
        myEditor.ckeditor({ 
        height: 200, 
        extraPlugins: 'charcount', 
        maxLength: 1000, 
        toolbar: 'TinyBare', 
        toolbar_TinyBare: [
             ['Bold','Italic','Underline'],
             ['Undo','Redo'],['Cut','Copy','Paste'],
             ['NumberedList','BulletedList','Table'],['CharCount']
        ] 
        }).ckeditor().editor.on('key', function(obj) {
            if (obj.data.keyCode === 8 || obj.data.keyCode === 46) {
                return true;
            }
            if (myEditor.ckeditor().editor.document.getBody().getText().length >= 1000) {
                alert('No more characters possible');
                return false;
            }else { return true; }

        });
    });
</script>
@endsection

