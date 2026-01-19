@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Content</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ url($fetchDataServiceController->routeCall().'/content/') }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
    </div>        
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/content', 'class' => '', 'files' => true, 'data-parsley-validate' => '']) !!}

                        <div class="row">
                            <div class="col-md-12">
                                <label>Category Name</label>
                                <select class="form-control" required="" name="contentcategory_id" data-parsley-error-message="Please select user role">
                                    <option disabled="" selected="">Please select category</option>
                                    @foreach( $contentcategoryObj as $item )
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Content Title</label>
                                 <input class="form-control" type="text" name="title" placeholder="Enter Content title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter Content title" required="">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Description</label>
                                {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter description of content here', 'data-parsley-error-message' => 'Please enter description of content here', 'data-parsley-trigger'=>'change']) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Status</label>
                                <select class="form-control" name="status" >
                                    <option disabled="" selected="">Please select an option</option>
                                        <option value="1" selected="">Active</option>
                                        <option value="0" >Inactive</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-primary btn-md">Create</button>
                        </div>
                        <hr>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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