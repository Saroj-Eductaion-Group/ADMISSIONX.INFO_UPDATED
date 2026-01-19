@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Content'); /*--}}
{{--*/ $validateUserRoleCallSeoContent = $fetchDataServiceController->validateUserRoleCall('SeoContent'); /*--}}

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-6">
        <h2>Manage Content</h2>        
    </div>
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCallSeoContent)) && (sizeof($validateUserRoleCallSeoContent) > 0) && ($validateUserRoleCallSeoContent[0]->edit == '1'))
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $content->contentcategory_id.'/edit') }}" title="View content"><button class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a>
            </div>
            @endif
                
            <div class="col-lg-1">
                <a href="{{ URL::previous() }}" class="btn btn-info btn-sm" title="Edit content"><i class="fa fa-arrow-left"></i> Previous</a>
            </div> 
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/') }}" class="btn btn-warning btn-sm" title="Edit content"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>  
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $content->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit content"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            @endif
        @else
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $content->contentcategory_id.'/edit') }}" title="View content"><button class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a>
            </div>    
            <div class="col-lg-1">
                <a href="{{ URL::previous() }}" class="btn btn-info btn-sm" title="Edit content"><i class="fa fa-arrow-left"></i> Previous</a>
            </div> 
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/') }}" class="btn btn-warning btn-sm" title="Edit content"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>  
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $content->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit content"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            <div class="col-lg-1">
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => [$fetchDataServiceController->routeCall().'/content', $content->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete content',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
            </div>
        @endif
    @endif

    
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
                        {!! Form::model($content, [
                            'method' => 'PATCH',
                            'url' => [$fetchDataServiceController->routeCall().'/content', $content->id],
                            'class' => '',
                            'files' => true,
                            'data-parsley-validate' => ''
                        ]) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <label>Category Name</label>
                                <select class="form-control" required="" name="contentcategory_id" data-parsley-error-message="Please select content role">
                                    <option disabled="" selected="">Please select category</option>
                                    @foreach( $contentcategoryObj as $item )
                                        @if( $item->id == $content->contentcategory_id )
                                        <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                        @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Content Title</label>
                                <input class="form-control" type="text" name="title" placeholder="Enter Content title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter Content title" required="" value="{{ $content->title }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Description</label>
                                {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter description of content here', 'data-parsley-error-message' => 'Please enter description of content here','data-parsley-trigger'=>'change']) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Status</label>
                                <select class="form-control" name="status" >
                                    <option disabled="" selected="">Please select an option</option>
                                    @if( $content->status == '1' )
                                        <option value="1" selected="">Active</option>
                                        <option value="0" >Inactive</option>
                                    @else
                                        <option value="0" selected="">Inactive</option>   
                                        <option value="1">Active</option>                    
                                    @endif    
                                </select>
                            </div>
                        </div>
                       
                        <div class="text-center margin-top20">
                            <button class="btn btn-primary btn-md">Update</button>
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