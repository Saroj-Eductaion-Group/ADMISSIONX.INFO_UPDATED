@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('CounselingCoursesDetail'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <h2>Counseling Courses Details details <a href="{{ url('counseling/counseling-courses-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Courses Details</a></h2>
                @endif
            @else
                <h2>Counseling Courses Details details <a href="{{ url('counseling/counseling-courses-details/create') }}" class="btn btn-primary pull-right btn-sm">Add New Counseling Courses Details</a></h2>
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
                        <h2>Search Counseling Courses Details</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to('/counseling/counseling-courses-details') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Stream<span class="pull-right"> <a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                           <select class="form-control chosen-select functionalarea" name="functionalarea" data-parsley-trigger="change" data-parsley-error-message="Please select stream">
                                <option value="" disabled="" selected="">Select stream</option>
                                @foreach( $functionalAreaObj as $functional )
                                    <option value="{{ $functional->id }}" @if(Request::get('functionalarea') == $functional->id) checked="" @endif>{{ $functional->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title" data-parsley-trigger="change" data-parsley-error-message="Please enter title" value="{{ Request::get('search') }}">
                        </div> 
                        @include('common-partials.common-search-employee-fileds-index-partial')
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to('/counseling/counseling-courses-details') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Stream</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($counselingcoursesdetails as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->functionalAreaName }}</td>
                            <td>{{ $item->title }}</td>
                            <td> 
                                @if( $item->image )
                                    <img class="img-responsive thumbnail" src="/counselingimages/{{ $item->image }}" width="120" alt="{{ $item->image }}">
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
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
                                            <a class="" href="{{ url('counseling/courses/update-form-details/' . $item->id) }}"><button type="submit" class="btn btn-warning btn-xs">Update More Details</button></a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                            / <a href="{{ url('counseling/counseling-courses-details/' . $item->id) }}">
                                                <button type="submit" class="btn btn-info btn-xs">Show</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                            / <a href="{{ url('counseling/counseling-courses-details/' . $item->id . '/edit') }}">
                                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                            </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                            / {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['counseling/counseling-courses-details', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Eligibility Criteria',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                ))!!}
                                            {!! Form::close() !!}
                                        @endif
                                    @else
                                        <a class="" href="{{ url('counseling/courses/update-form-details/' . $item->id) }}"><button type="submit" class="btn btn-warning btn-xs">Update More Details</button></a>/
                                        <a href="{{ url('counseling/counseling-courses-details/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a> /
                                        <a href="{{ url('counseling/counseling-courses-details/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['counseling/counseling-courses-details', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete Eligibility Criteria',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
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
        <div class="pagination"> {!! $counselingcoursesdetails->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
@include('common-partials.common-search-employee-index-script-partial')
<script type="text/javascript">
    $('.functionalarea').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.functionalarea').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });
</script>
@endsection


