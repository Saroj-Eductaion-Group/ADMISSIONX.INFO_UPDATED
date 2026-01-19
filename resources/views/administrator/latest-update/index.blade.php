@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('LatestUpdate'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Latest Update details <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update/create') }}" class="btn btn-primary pull-right btn-sm">Add New Latest Update</a></h2>
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Latest Update</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/latest-update') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title name" data-parsley-trigger="change" data-parsley-error-message="Please enter title name" value="{{ Request::get('search') }}">
                        </div>     
                        <div class="col-md-4">
                            <label class="control-label">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Enter description" data-parsley-trigger="change" data-parsley-error-message="Please enter description" value="{{ Request::get('description') }}">
                        </div>                        
                        <div class="col-md-4 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/latest-update') }}" class="btn btn-md btn-primary">Clear</a>
                            <button class="btn btn-danger btn-md">Submit</button>                            
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($latestupdate as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {!! $item->desc !!}
                            </td>
                            <td>{{ date('F dS Y', strtotime($item->date)) }}</td>
                            <td>
                                @if($item->status == '1') Active @else Inactive @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update/' . $item->id) }}">
                                    <button type="submit" class="btn btn-info btn-xs">Show</button>
                                </a>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        /
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                        @endif
                                    @else
                                        / 
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/latest-update/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                @endif
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $latestupdate->render() !!} </div>
    </div>
</div>
@endsection

@section('script')

@endsection


