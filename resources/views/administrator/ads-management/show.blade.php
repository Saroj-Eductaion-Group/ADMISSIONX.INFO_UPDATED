@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AdsManagement'); /*--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">AdsManagement {{ $adsmanagement->id }}</div>
                    <div class="panel-body">
                        @if(Auth::check())
                            @if(Auth::user()->userrole_id == 4)
                                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                <a href="{{ url($fetchDataServiceController->routeCall().'ads-management/' . $adsmanagement->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit AdsManagement"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                @endif
                            @else
                                <a href="{{ url($fetchDataServiceController->routeCall().'ads-management/' . $adsmanagement->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit AdsManagement"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => [$fetchDataServiceController->routeCall().'adsmanagement', $adsmanagement->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete AdsManagement',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    ))!!}
                                {!! Form::close() !!}
                            @endif
                        @endif

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $adsmanagement->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $adsmanagement->title }} </td></tr><tr><th> Img </th><td> {{ $adsmanagement->img }} </td></tr><tr><th> Description </th><td> {{ $adsmanagement->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection