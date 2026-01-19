@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AdsManagement'); /*--}}
@section('page-title-name')
Home - Admissionx
@endsection


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Ads Management 
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                <a href="{{ url($fetchDataServiceController->routeCall().'/ads-management/create') }}" class="btn btn-primary pull-right btn-sm">Add New AD</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/ads-management/create') }}" class="btn btn-primary pull-right btn-sm">Add New AD</a>
            @endif
        @endif                
        </h2>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" >
                                    <thead class="thead">
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th style="width: 100px">View on Page</th>
                                            <th style="width: 400px;">Banner Image</th>
                                            <th style="width: 10px">Status</th>
                                            <th style="width: 10px">Adx Position</th>
                                            <th style="width: 50px">Redirect To</th>
                                            <th style="width: 50px">Start - End</th>
                                            @if(Auth::check())
                                                @if(Auth::user()->userrole_id == 4)
                                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                                    <th style="width: 10px">Actions</th>
                                                    @endif
                                                @else
                                                    <th style="width: 10px">Actions</th>
                                                @endif
                                            @endif                
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        @foreach($adsmanagement as $item)
                                        <tr>
                                            <td style="width: 10px">{{ $item->id }}</td>
                                            <td style="width: 100px">
                                                @if( $item->slug == 1)
                                                    <button class="btn btn-xs btn-outline btn-danger">Home Page</button>
                                                @elseif( $item->slug == 2)
                                                    <button class="btn btn-xs btn-outline btn-info">Search Page</button>
                                                @elseif( $item->slug == 3)
                                                    <button class="btn btn-xs btn-outline btn-primary">College Detail Page</button>
                                                @endif
                                            </td>
                                            <td style="width: 400px">
                                                <a href="{{ asset('assets/ads-banner/'.$item->img) }}" target="_blank">
                                                    <div style="background-image: url({{ asset('assets/ads-banner/'.$item->img) }});    height: 100px;background-repeat: no-repeat;background-size: contain;width: 100%;"></div>
                                                </a>
                                            </td>
                                            <td style="width: 10px">
                                            @if( $item->isactive == 0)
                                                <span class="badge badge-danger">In-Active</span>
                                            @else
                                                <span class="badge badge-info">Active</span>
                                            @endif
                                            </td>
                                            <td style="width: 10px">{{ ucfirst($item->ads_position) }}</td>
                                            <td><a href="{{ $item->redirectto }}" target="_blank" title="View Redirect Url">{{ $item->redirectto }}</a></td>
                                            <td>{{ date('d/m/Y h:i A', strtotime($item->start)) }} - {{ date('d/m/Y h:i A', strtotime($item->end)) }}</td>
                                            @if(Auth::check())
                                                @if(Auth::user()->userrole_id == 4)
                                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                                    <td style="width: 10px">
                                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ads-management/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Ad"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                                    </td>
                                                    @endif
                                                @else
                                                    <td style="width: 10px">
                                                        <!-- <a href="{{ url($fetchDataServiceController->routeCall().'/ads-management/' . $item->id) }}" class="btn btn-success btn-xs" title="View AdsManagement"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a> -->
                                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ads-management/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Ad"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                                        {!! Form::open([
                                                            'method'=>'DELETE',
                                                            'url' => [$fetchDataServiceController->routeCall().'/ads-management', $item->id],
                                                            'style' => 'display:inline'
                                                        ]) !!}
                                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete AdsManagement" />', array(
                                                                    'type' => 'submit',
                                                                    'class' => 'btn btn-danger btn-xs',
                                                                    'title' => 'Delete Ad',
                                                                    'onclick'=>'return confirm("Confirm delete?")'
                                                            )) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                @endif
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row indexPagination">
                                    <div class="col-md-12">
                                        <div class="pull-right custom-pagination">{!! $adsmanagement->render() !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection