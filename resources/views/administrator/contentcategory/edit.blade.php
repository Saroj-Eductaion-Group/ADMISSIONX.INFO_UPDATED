@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Contentcategory'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Contentcategory</h2>        
    </div>    
    <div class="col-lg-1">
        <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/') }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                <div class="col-lg-1">
                    <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $contentcategory->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            @endif
        @else
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $contentcategory->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>
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
                        {!! Form::model($contentcategory, [
                            'method' => 'PATCH',
                            'url' => [$fetchDataServiceController->routeCall().'/contentcategory', $contentcategory->id],
                            'class' => '',
                            'files' => true,
                            'data-parsley-validate' => ''
                        ]) !!}

                         <div class="row">
                            <div class="col-md-12">
                                <label>Category Name</label>
                                <input type="text" name="name" class="form-control" required="" data-parsley-error-message="Please enter contentcategory name" value="{{ $contentcategory->name }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Status</label>
                                <select class="form-control" name="status" >
                                    <option disabled="" selected="">Please select an option</option>
                                    @if( $contentcategory->status == '1' )
                                        <option value="1" selected="">Active</option>
                                        <option value="0" >Inactive</option>
                                    @else
                                        <option value="0" selected="">Inactive</option>   
                                        <option value="1">Active</option>                    
                                    @endif    
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-md-12">
                               <div class="headline"><h2>SEO Content</h2></div>
                                <input type="hidden" name="pagename" value="contentpage">
                                @if(sizeof($seocontent) > 0)
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
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>
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