@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Content'); /*--}}
{{--*/ $validateUserRoleCallSeoContent = $fetchDataServiceController->validateUserRoleCall('SeoContent'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Content</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ url($fetchDataServiceController->routeCall().'/content/create') }}" class="btn btn-primary btn-sm" title="Add New User">Add New Content</a>
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
                        <th>Page Name</th>
                        <th>No of contents</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $content as $item )
                    <tr>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/all-page-contents/' . $item->contentcategory_id) }}">{{ $item->id }}</a></td>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/all-page-contents/' . $item->contentcategory_id) }}">{{ $item->contentcategoryName }}</a></td>
                        <th><span class="badge badge-warning">No. Of Content Page {{ $item->count }}</span></th>
                        <td>
                            <a href="{{ url($fetchDataServiceController->routeCall().'/all-page-contents/' . $item->contentcategory_id) }}" title="View content"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View all contents</button></a>

                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCallSeoContent)) && (sizeof($validateUserRoleCallSeoContent) > 0) && ($validateUserRoleCallSeoContent[0]->edit == '1'))
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $item->contentcategory_id.'/edit') }}" title="View content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a> 
                                    @endif
                                        
                                @else
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $item->contentcategory_id.'/edit') }}" title="View content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a> 
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
@section('script')
<script type="text/javascript">
    $(document).ready( function () {
        $('.table').DataTable();
        $('.dataTables_length').addClass('hide');
        $('.dataTables_filter').addClass('hide');
        $('.dataTables_paginate').addClass('hide');
        $('.dataTables_info').addClass('hide');
    } );

    $('.table').dataTable( {
      "pageLength": 50,
      "order":[[0, 'desc']]
    } );
</script>
@endsection