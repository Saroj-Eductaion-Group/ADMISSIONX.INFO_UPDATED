@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('LandingPageQueryForm'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Landing Page Query Form {{ $landingpagequeryform->id }} </h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url($fetchDataServiceController->routeCall().'/landing-page-query-form') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => [$fetchDataServiceController->routeCall().'/landing-page-query-form', $landingpagequeryform->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Landing Page Query Form',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                            {!! Form::close() !!}
                        @endif
                    @else
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/landing-page-query-form', $landingpagequeryform->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Landing Page Query Form',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
           
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $landingpagequeryform->id }}</td> 
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td>
                                @if( $landingpagequeryform->fullname )
                                    {{ $landingpagequeryform->fullname }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                @if( $landingpagequeryform->emailaddress )
                                    {{ $landingpagequeryform->emailaddress }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                @if( $landingpagequeryform->mobilenumber )
                                    {{ $landingpagequeryform->mobilenumber }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>
                                @if( $landingpagequeryform->subject )
                                   {{$landingpagequeryform->subject}}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>
                                @if( $landingpagequeryform->message )
                                   {{$landingpagequeryform->message}}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Submit Date</th>
                            <td>{!! date('F d, Y', strtotime($landingpagequeryform->created_at)) !!} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($landingpagequeryform->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $landingpagequeryform->eUserId) }}" @endif>{{ $landingpagequeryform->employeeFirstname }} {{ $landingpagequeryform->employeeMiddlename}} {{ $landingpagequeryform->employeeLastname}} (ID:- {{ $landingpagequeryform->eUserId}}) <hr> Date & Time:-  {{ $landingpagequeryform->updated_at}} </a></a>
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