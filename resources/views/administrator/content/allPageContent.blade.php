@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Content'); /*--}}
{{--*/ $validateUserRoleCallSeoContent = $fetchDataServiceController->validateUserRoleCall('SeoContent'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-7">
        <h2>Manage Content</h2>        
    </div>    
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/create') }}" class="btn btn-primary btn-sm pull-right" title="Add New User">Add New Content</a>
            </div>    
            @endif
            @if((isset($validateUserRoleCallSeoContent)) && (sizeof($validateUserRoleCallSeoContent) > 0) && ($validateUserRoleCallSeoContent[0]->edit == '1'))
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $id.'/edit') }}" title="View content"><button class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a>
            </div>
            @endif
        @else
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/create') }}" class="btn btn-primary btn-sm pull-right" title="Add New User">Add New Content</a>
            </div>    
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $id.'/edit') }}" title="View content"><button class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a>
            </div>
        @endif
    @endif
    
    <div class="col-lg-1">
        <a href="{{ url($fetchDataServiceController->routeCall().'/content/') }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-arrow-left"></i> Back</a>
    </div>   
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
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
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $content as $item )
                    <tr>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $item->id) }}">{{ $item->id }}</a></td>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $item->contentcategory_id) }}">{{ $item->contentcategoryName }}</a></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ strip_tags($item->description) }}</td>
                        <td>
                            @if($item->status == '1')
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>
                            <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $item->id) }}" title="View content"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $item->id . '/edit') }}" title="Edit content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    @endif
                                @else
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $item->id . '/edit') }}" title="Edit content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/content', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete content',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                @endif
                            @endif

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $content->render() !!} </div>
            </div>
        </div>
    </div>
</div>
@endsection