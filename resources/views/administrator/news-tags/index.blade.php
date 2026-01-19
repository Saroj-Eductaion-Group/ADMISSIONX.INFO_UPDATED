@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('NewsTag'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage News Tags</h2>        
    </div>    
    <div class="col-lg-2">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/create') }}" class="btn btn-primary btn-sm" title="Add New Newstags">Add New Newstags</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/create') }}" class="btn btn-primary btn-sm" title="Add New Newstags">Add New Newstags</a>
            @endif
        @endif  
    </div>    
</div>
{!! Form::open(['method' => 'GET', 'url' => $fetchDataServiceController->routeCall().'/news-tags', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="Search...">
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit">
            <i class="fa fa-search"></i>
        </button>
    </span>
</div>
{!! Form::close() !!}
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
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $newstags as $item )
                    <tr>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/' . $item->id) }}">{{ $item->id }}</a></td>
                        <td class="text-capitalize">{{ $item->name }}</td>
                        <td>
                            <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/' . $item->id) }}" title="View Newstags"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/' . $item->id . '/edit') }}" title="Edit Newstags"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    @endif
                                @else
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/' . $item->id . '/edit') }}" title="Edit Newstags"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/news-tags', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Newstags',
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
                <div class="pagination-wrapper"> {!! $newstags->appends(\Input::except('page'))->render() !!} </div>
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