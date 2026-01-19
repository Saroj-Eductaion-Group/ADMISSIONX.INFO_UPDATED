@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('NewsType'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage News Type</h2>        
    </div>
    <div class="col-lg-1">
        <a href="{{ url($fetchDataServiceController->routeCall().'/news-type/') }}" class="btn btn-warning btn-sm" title="NewsType"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/news-type/' . $newstype->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            @endif
        @else
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/news-type/' . $newstype->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            <div class="col-lg-1">
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => [$fetchDataServiceController->routeCall().'/news-type', $newstype->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete NewsType',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
            </div>
        @endif
    @endif
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>{{ $newstype->id }}</th>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $newstype->name }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>

@endsection