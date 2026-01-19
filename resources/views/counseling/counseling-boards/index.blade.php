@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CounselingBoard'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Counseling boards details <a href="{{ url('counseling/counseling-boards/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling boards</a></h2>
                @endif
            @else
                <h2>Counseling boards details <a href="{{ url('counseling/counseling-boards/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling boards</a></h2>
            @endif
        @endif
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Counseling boards</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to('/counseling/counseling-boards') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter name" data-parsley-trigger="change" data-parsley-error-message="Please enter name" value="{{ Request::get('search') }}">
                        </div>   
                        <div class="col-md-3">
                            <label class="control-label">Status</label>
                            <br>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="FormCreate0" value="1" name="status" data-parsley-error-message="Please select status" data-parsley-trigger="change" @if(Request::get('status') == '1') checked="" @endif>
                                <label for="FormCreate0"> Active </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="FormCreate1" value="0" name="status" data-parsley-error-message="Please select status" data-parsley-trigger="change" @if(Request::get('status') == '0') checked="" @endif>
                                 <label for="FormCreate1">Inactive</label>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <label class="control-label">Misc</label>
                            <br>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="National" value="National" name="misc" data-parsley-error-message="Please select misc" data-parsley-trigger="change" @if(Request::get('misc') == 'National') checked="" @endif>
                                <label for="National"> National </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="State" value="State" name="misc" data-parsley-error-message="Please select misc" data-parsley-trigger="change" @if(Request::get('misc') == 'State') checked="" @endif>
                                 <label for="State">State</label>
                            </div>
                        </div>  
                        @include('common-partials.common-search-employee-fileds-index-partial')
                    
                        <div class="col-md-2 pull-right text-right margin-top20">
                            <a href="{{ URL::to('/counseling/counseling-boards') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Misc</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($counselingboards as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <th>{{ $item->name }}</th>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if($item->status == '1')
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-warning">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($item->misc == 'National')
                                    <span class="label label-primary">National</span>
                                @elseif($item->misc == 'State')
                                    <span class="label label-info">State</span>
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                            <a href="{{ url('counseling/boards/update-form-details/' . $item->id) }}">
                                                <button type="submit" class="btn btn-warning btn-xs">Update More Details</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                            / <a href="{{ url('counseling/counseling-boards/' . $item->id) }}">
                                                <button type="submit" class="btn btn-info btn-xs">Show</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                            / <a href="{{ url('counseling/counseling-boards/' . $item->id . '/edit') }}">
                                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                            / {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['counseling/counseling-boards', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @else
                                        <a href="{{ url('counseling/boards/update-form-details/' . $item->id) }}">
                                            <button type="submit" class="btn btn-warning btn-xs">Update More Details</button>
                                        </a> /
                                        <a href="{{ url('counseling/counseling-boards/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a> /
                                        <a href="{{ url('counseling/counseling-boards/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['counseling/counseling-boards', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $counselingboards->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
@include('common-partials.common-search-employee-index-script-partial')

@endsection


