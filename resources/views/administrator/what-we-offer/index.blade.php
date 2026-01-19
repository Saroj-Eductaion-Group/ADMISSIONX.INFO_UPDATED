@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('WhatWeOffer'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
            <div class="col-lg-12">
                <h2>What we offer details <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer/create') }}" class="btn btn-primary pull-right btn-sm">Add New What we offer</a></h2>
            </div>
            @endif
        @else
            <div class="col-lg-12">
                <h2>What we offer details <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer/create') }}" class="btn btn-primary pull-right btn-sm">Add New What we offer</a></h2>
            </div>
        @endif
    @endif
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search What we offer</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/what-we-offer') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title name" data-parsley-trigger="change" data-parsley-error-message="Please enter title name" value="{{ Request::get('search') }}">
                        </div>                        
                        <div class="col-md-4 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/what-we-offer') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Title</th>
                            <th>Icon Image</th>
                            <th>Page URL</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($whatweoffer as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td> 
                                @if( $item->iconImage )
                                    <img class="img-responsive thumbnail" src="/whatweoffer/{{ $item->iconImage }}" width="120" alt="{{ $item->iconImage }}">
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif 
                            </td>
                            <td><a href="{{ $item->pageurl }}" target="_blank">{{ $item->pageurl }}</a></td>
                            <td>
                                {!! $item->description !!}
                            </td>
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
                                <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer/' . $item->id) }}">
                                    <button type="submit" class="btn btn-info btn-xs">Show</button>
                                </a> 
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        /
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                        @endif
                                    @else
                                        /
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer/' . $item->id . '/edit') }}">
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
        <div class="pagination"> {!! $whatweoffer->render() !!} </div>
    </div>
</div>
@endsection

@section('script')

@endsection


