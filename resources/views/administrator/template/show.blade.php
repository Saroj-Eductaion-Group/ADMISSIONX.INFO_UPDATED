@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Template'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Template</h2>        
    </div>
    <div class="col-lg-1">
        <a href="{{ url($fetchDataServiceController->routeCall().'/template/') }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $template->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            @endif
        @else
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $template->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
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
                        <table class="table table-hover table-responsive">
                            <tr>
                                <th>ID</th>
                                <th>{{ $template->id }}</th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th class="text-capitalize">{{ $template->name }}</th>
                            </tr>  
                            <tr>
                                <th>Description</th>
                                <th class="text-capitalize">{{ $template->description }}</th>
                            </tr>  
                            <tr>
                                <th>Slug</th>
                                <th class="text-capitalize">{{ $template->slug }}</th>
                            </tr>  
                            <tr>
                                <th>Status</th>
                                <th class="text-capitalize">
                                    @if($template->status == '1')
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </th>
                            </tr>   
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection