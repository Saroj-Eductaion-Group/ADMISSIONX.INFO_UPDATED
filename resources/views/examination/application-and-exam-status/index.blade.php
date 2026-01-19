@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Application and exam status details <a href="{{ url('examination/application-and-exam-status/create') }}" class="btn btn-primary pull-right btn-sm">Add New Application and exam status</a></h2>
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Application and exam status</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to('/examination/application-and-exam-status') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
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
                                <input type="radio" id="application" value="Application" name="misc" data-parsley-error-message="Please select misc" data-parsley-trigger="change" @if(Request::get('misc') == 'Application') checked="" @endif>
                                <label for="application"> Application </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="examination" value="Examination" name="misc" data-parsley-error-message="Please select misc" data-parsley-trigger="change" @if(Request::get('misc') == 'Examination') checked="" @endif>
                                 <label for="examination">Examination</label>
                            </div>
                        </div>   
                        @include('common-partials.common-search-employee-fileds-index-partial')                   
                        <div class="col-md-2 pull-right text-right margin-top20">
                            <a href="{{ URL::to('/examination/application-and-exam-status') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Status</th>
                            <th>Misc</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($applicationandexamstatus as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if($item->status == '1')
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-warning">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($item->misc == 'Application')
                                    <span class="label label-primary">Application</span>
                                @elseif($item->misc == 'Examination')
                                    <span class="label label-info">Examination</span>
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $item->eUserId) }}" @endif >{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('examination/application-and-exam-status/' . $item->id) }}">
                                    <button type="submit" class="btn btn-info btn-xs">Show</button>
                                </a> /
                                <a href="{{ url('examination/application-and-exam-status/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                </a> /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['examination/application-and-exam-status', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $applicationandexamstatus->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
@include('common-partials.common-search-employee-index-script-partial')
@endsection


