@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AdsTopCollegeList'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Ads Top College List details <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/create') }}" class="btn btn-primary pull-right btn-sm">Add Ads Top College List</a></h2>
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Ads Top College List</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/ads-top-college-list') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="" >Select Method Type : </label>
                            <select class="form-control chosen-select method_type" name="method_type">
                                <option value="" selected disabled >Select method type</option>
                                <option value="Functional Area" @if(Request::get('method_type') == "Functional Area") selected="" @endif>Functional Area (Stream)</option>
                                <option value="Degree" @if(Request::get('method_type') == "Degree") selected="" @endif>Degree</option>
                                <option value="Course" @if(Request::get('method_type') == "Course") selected="" @endif>Course</option>
                                <option value="Country" @if(Request::get('method_type') == "Country") selected="" @endif>Country</option>
                                <option value="State" @if(Request::get('method_type') == "State") selected="" @endif>State</option>
                                <option value="City" @if(Request::get('method_type') == "City") selected="" @endif>City</option>
                                <option value="University" @if(Request::get('method_type') == "University") selected="" @endif>University</option>
                                <option value="Education Level" @if(Request::get('method_type') == "Education Level") selected="" @endif>Education Level</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Select Page Name</label>
                            <select class="form-control chosen-select page_name_id" style="width: 100%" name="page_name_id" data-parsley-error-message=" Please select page name" data-parsley-trigger="change" data-parsley-errors-container="#page-type-validation-error-block">
                                <option value="" selected disabled >Select option</option>
                            </select>
                        </div>     
                        <div class="col-md-4">
                            <label class="" >Status : </label>
                            <select class="form-control chosen-select" name="status">
                                <option value="" selected disabled >Select status</option>
                                <option value="Active" @if(Request::get('status') == 'Active') selected="" @endif>Active</option>
                                <option value="Inactive" @if(Request::get('status') == 'Inactive') selected="" @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @include('common-partials.common-search-employee-fileds-index-partial')                     
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/ads-top-college-list') }}" class="btn btn-md btn-primary">Clear</a>
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
            @if(Session::has('flash_message'))
                <div class="row margin-top20 margin-botttom20">
                    <div class="col-md-12">
                        <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ Session::get('flash_message') }}</strong>
                        </div>
                    </div>
                </div>
            @endif
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Method Type</th>
                            <th>Page Title</th>
                            <th>College List</th>
                            <th>Status</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($adstopcollegelist as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->method_type }}</td>
                            <td>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if(!empty($item->course_id))
                                            {{ $item->courseName }}
                                        @elseif(!empty($item->educationlevel_id))
                                            {{ $item->educationlevelName }}
                                        @elseif(!empty($item->degree_id))
                                            {{ $item->degreeName }}
                                        @elseif(!empty($item->functionalarea_id))
                                            {{ $item->functionalAreaName }}
                                        @elseif(!empty($item->university_id))
                                            {{ $item->universityName }}
                                        @elseif(!empty($item->country_id))
                                            {{ $item->countryName }}
                                        @elseif(!empty($item->state_id))
                                            {{ $item->stateName }}
                                        @elseif(!empty($item->city_id))
                                            {{ $item->cityName }}
                                        @else
                                            --
                                        @endif
                                    @else
                                        @if(!empty($item->course_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/course/' . $item->course_id) }}">{{ $item->courseName }}</a>
                                        @elseif(!empty($item->educationlevel_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/educationlevel/' . $item->educationlevel_id) }}">{{ $item->educationlevelName }}</a>
                                        @elseif(!empty($item->degree_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/degree/' . $item->degree_id) }}">{{ $item->degreeName }}</a>
                                        @elseif(!empty($item->functionalarea_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $item->functionalarea_id) }}">{{ $item->functionalAreaName }}</a>
                                        @elseif(!empty($item->university_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/university/' . $item->university_id) }}">{{ $item->universityName }}</a>
                                        @elseif(!empty($item->country_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/address/' . $item->country_id) }}">{{ $item->countryName }}</a>
                                        @elseif(!empty($item->state_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $item->state_id) }}">{{ $item->stateName }}</a>
                                        @elseif(!empty($item->city_id))
                                            <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $item->city_id) }}">{{ $item->cityName }}</a>
                                        @else
                                            --
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($item->collegeprofile_id) 
                                    @foreach( $item->collegeListObj as $key1 => $item1 )
                                        <a href="{{ url('/college/' . strtolower($item1->slug)) }}" target="_blank" title="Go to Product View"><button class="btn btn-success btn-xs">{{ $item1->fullname }}</button></a> <br>
                                    @endforeach
                                @else 
                                    <span class="badge badge-warning">Not Updated yet</span>
                                @endif
                            </td>
                            <td>
                                <select name="status" class="form-control adsCollegeStatus" id="adsCollegeStatus" data-placeholder="Choose status ..." data-parsley-error-message=" Please select status " data-parsley-trigger="change" style="width: 142px;">
                                <option value="" selected disabled>-- Choose Action -- </option>
                                    <option value="1" @if((isset($item->status)) && $item->status == 1)) selected="" @endif>Active</option>
                                    <option value="0" @if((isset($item->status)) && $item->status == 0)) selected="" @endif>Inactive</option>
                                </select>
                                <input type="hidden" class="adsCollegeId" id="adsCollegeId" name="adsCollegeId" value="{{ $item->id }}">
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/' . $item->id) }}">
                                    <button type="submit" class="btn btn-info btn-xs">Show</button>
                                </a>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        /
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                        @endif
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                                            /
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => [$fetchDataServiceController->routeCall().'/ads-top-college-list', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Ads Top College List',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                ))!!}
                                            {!! Form::close() !!}
                                        @endif
                                    @else
                                        / 
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/ads-top-college-list/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/ads-top-college-list', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete Ads Top College List',
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
        <div class="pagination"> {!! $adstopcollegelist->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){   
        $('.tbody > tr > td > .adsCollegeStatus').on('change', function(){
            var adsCollegeStatus = $(this).val();
            var adsCollegeId = $(this).siblings(".adsCollegeId").val();
            var HTML = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "POST",
                data: { currentStatus: adsCollegeStatus, currentId: adsCollegeId, tableName: "ads_top_college_lists", columnName: "status", },
                url: "/update-on-change-status",
                success: function(data) {
                    if (data.code == '200') {
                        toastr.success("Status Update Successful!");
                    }
                }
            });
        });
    });
</script>
<script type="text/javascript">
    var selectedPageId = '';
    var methodType = '';
    $(document).ready(function(){   
        $('select[name=method_type]').on('change', function(){
            methodType = $(this).val();
            getAllDropdownOptions(methodType, 0);
        });

        $('select[name=page_name_id]').on('change', function(){
            $('.college-section').removeClass('hide');
            selectedPageId = $(this).val();
        });
    });

    @if(!empty(Request::get('method_type')))
        $(document).ready(function(){
            if("{!! Request::get('method_type') !!}" == "Functional Area"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }else if("{!! Request::get('method_type') !!}" == "Degree"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }else if("{!! Request::get('method_type') !!}" == "Course"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }else if("{!! Request::get('method_type') !!}" == "Education Level"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }else if("{!! Request::get('method_type') !!}" == "City"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }else if("{!! Request::get('method_type') !!}" == "State"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }else if("{!! Request::get('method_type') !!}" == "Country"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }else if("{!! Request::get('method_type') !!}" == "University"){
                getAllDropdownOptions("{!! Request::get('method_type') !!}", "{{ Request::get('page_name_id') }}");
            }
            $('.college-section').removeClass('hide' );
        });
    @endif

    function getAllDropdownOptions(actionType, pageNameId){
        selectedPageId = pageNameId;
        methodType = actionType;
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {actionType: actionType},
            url: "{{ URL::to('/getAllDropdownOptions') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Select option</option>';
                if( data.code == '200' ){
                    $.each(data.dataObj, function(i, item) {
                        var selectAttr = '';
                        if(data.dataObj[i].id == pageNameId){
                            selectAttr = 'selected=""';
                        }
                        HTML += '<option value="'+data.dataObj[i].id+'" '+selectAttr+' >'+data.dataObj[i].fullname+'</option>';
                    });
                    $('.selected_method_block').removeClass('hide'); 
                }else{
                    HTML += '<option selected="" disabled="">No option available</option>';
                    $('.selected_method_block').addClass('hide');
                }
                $('select[name="page_name_id"]').empty();
                $('select[name="page_name_id"]').html(HTML);
                $('select[name="page_name_id"]').trigger('chosen:updated');
            }
        });
    }
</script>
@endsection


