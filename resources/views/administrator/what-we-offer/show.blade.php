@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('WhatWeOffer'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>What We Offer Details {{ $whatweoffer->id }}  <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $whatweoffer->id }}</td> 
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $whatweoffer->title }} </td>
                        </tr>
                        <tr>
                            <th>Icon Image</th>
                            <td> 
                                @if(isset($whatweoffer) && !empty($whatweoffer->iconImage))
                                    <img class="img-responsive thumbnail" width="200" src="/whatweoffer/{{ $whatweoffer->iconImage }}" alt="{{ $whatweoffer->iconImage }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Banner Text</th>
                            <td>{{ $whatweoffer->bannerText}}</td>
                        </tr>
                        <tr>
                            <th>Banner Image</th>
                            <td>
                                @if(isset($whatweoffer) && !empty($whatweoffer->bannerImage))
                                    <img class="img-responsive thumbnail" width="200" src="/whatweoffer/{{ $whatweoffer->bannerImage }}" alt="{{ $whatweoffer->bannerImage }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Page URL</th>
                            <td><a href="{{$whatweoffer->pageurl}}" target="_blank">{{$whatweoffer->pageurl}}</a></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $whatweoffer->description !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $whatweoffer->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($whatweoffer->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $whatweoffer->eUserId) }}" @endif>{{ $whatweoffer->employeeFirstname }} {{ $whatweoffer->employeeMiddlename}} {{ $whatweoffer->employeeLastname}} (ID:- {{ $whatweoffer->eUserId}}) Date & Time:-  {{ $whatweoffer->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>

@endsection