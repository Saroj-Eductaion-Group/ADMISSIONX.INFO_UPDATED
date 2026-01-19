@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Template'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Template</h2>        
    </div>    
    <div class="col-lg-2">
        <!-- <a href="{{ url($fetchDataServiceController->routeCall().'/template/create') }}" class="btn btn-primary btn-sm" title="Add New User">Add New Template</a> -->
    </div>    
</div>
{!! Form::open(['method' => 'GET', 'url' => $fetchDataServiceController->routeCall().'/template', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
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
                        <th>Heading</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $template as $item )
                    <tr>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $item->id) }}">{{ $item->id }}</a></td>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @if($item->status == '1')
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        @if(Auth::check())
                            @if(Auth::user()->userrole_id == 4)
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $item->id) }}" title="View template"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $item->id . '/edit') }}" title="Edit template"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    @endif
                                </td>
                            @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $item->id) }}" title="View template"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $item->id . '/edit') }}" title="Edit template"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                </td>
                            @endif
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $template->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>
        </div>
    </div>
</div>
@endsection