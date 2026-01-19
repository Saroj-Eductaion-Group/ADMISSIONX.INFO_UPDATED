@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update News <a href="{{ URL::to($fetchDataServiceController->routeCall().'/news') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
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
                <h5>Update news details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($news, ['method' => 'PATCH','url' => [$fetchDataServiceController->routeCall().'/news', $news->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-sm-12">
                    <label>Topic of the news : </label>
                    {!! Form::text('topic', null, ['class' => 'form-control', 'placeholder' => 'Enter topic of news here', 'data-parsley-error-message' => 'Please enter topic of news here','data-parsley-trigger'=>'change']) !!}
                </div>
                <div class="col-sm-12">
                    <label class="control-label" >Description of the news : </label>
                    {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter description of news here', 'data-parsley-error-message' => 'Please enter description of news here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <hr>
            
            <div class="row">
                <div class="col-sm-6">
                    <label class="control-label" >Publish or Not : </label>
                    <select class="form-control chosen-select" name="isactive" data-parsley-error-message=" Please select news status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select news status</option>
                        @if( $news->isactive == '1' )
                            <option value="{{ $news->isactive }}" selected="">Published</option>
                            <option value="0">Not Published</option>
                        @else
                            <option value="1">Published</option>
                            <option value="{{ $news->isactive }}" selected="">Not Published</option>
                        @endif
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="control-label" >Author : </label>
                    <select name="users_id" class="form-control chosen-select" data-parsley-error-message="Please select author" data-parsley-trigger="change"  >
                        <option value="" selected="" disabled="">Please select author</option>
                        @foreach( $usersObj as $users )
                            @if( $news->users_id == $users->id )
                                <option value="{{ $users->id }}" selected="">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                            @else
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                            @endif
                        @endforeach
                    </select> 
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <label  class="control-label">Featured Image</label>
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" class="form-control" name="uploadFeatureImage" class="input input-file featuredImage"  data-parsley-trigger="change" data-parsley-error-message="Please upload only png , jpg or jpeg.">
                    <p class="text-danger hide" id="logoDoc">(please upload .png, .jpg and .jpeg file only)</p>
                </div>
                <div class="col-sm-6">
                    @if( $news->featimage )
                    <img class="img-responsive thumbnail" src="/news-image/{{ $news->featimage }}" width="180" alt="{{ $news->featimage }}">
                    @else
                        <span class="label label-warning">Not Updated Yet</span>
                    @endif 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                   <label class="control-label">News Type</label>
                   <div>
                        <select class="form-control chosen-select newstypeids" name="newstypeids" data-parsley-error-message="Please select news type" data-parsley-trigger="change" >
                            <option value="" selected="" disabled="">Please select news types</option>
                            @foreach( $newsTypeObj as $item )
                                @if($news->newstypeids == $item->id)
                                    <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                     <label class="control-label">News Tags</label>
                     <div>
                        {{--*/
                            $newsTagArray = explode(',', $news->newstagsids);                            
                        /*--}}
                        <select class="form-control chosen-select newstagsids" name="newstagsids[]" data-parsley-error-message="Please select news tags" multiple="" data-parsley-trigger="change" >
                            <option value="" disabled="">Please select news tags</option>
                            @foreach( $newsTagObj as $item )
                                {{--*/ $flagNews = 0; /*--}}
                                @foreach($newsTagArray as $obj)
                                    @if( $obj == $item->id )
                                        {{--*/ $flagNews = 1; /*--}}
                                        <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                        {{--*/ break; /*--}}
                                    @endif                                    
                                @endforeach
                                @if($flagNews == 0)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
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
                    <button class="btn btn-primary btn-sm">Update</button>
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