@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('State'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>State Details
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/state/create') }}" class="btn btn-primary pull-right btn-sm">Add New State</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/state/create') }}" class="btn btn-primary pull-right btn-sm">Add New State</a>
            @endif
        @endif
        </h2>
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search State</h2>        
                    </div>    
                </div>
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/state') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 for="usr">State Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control stateName" name="stateName" placeholder="Enter state name here" data-parsley-error-message="Please enter state name" data-parsley-trigger="change" value="{{Request::get('stateName') }}">
                        </div> 
                        <div class="col-md-3">
                            <h4 for="usr">Country Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select countryName" name="countryName" data-parsley-trigger="change" data-parsley-error-message="Please select country name">
                                <option value="" disabled="" selected="">Select country name</option>
                                @foreach( $countryObj as $country )
                                        <option value="{{ $country->name }}" @if(Request::get('countryName') == $country->id) selected="" @endif>{{ $country->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                        @include('common-partials.common-fileds-index-search-partial')
                        @include('common-partials.common-search-employee-fileds-index-partial')                      
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/state') }}" class="btn btn-md btn-primary">Clear</a>
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
                <label class="pull-right">Total Result :- {{ $state->total() }}</label>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>State Name</th>
                            <th>Country Name</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($state as $item)
                        <tr>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/state', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/state', $item->id) }}">{{ $item->name }}</a>
                            	@include('common-partials.common-fileds-index-partial')
                            </td>
                            <td>{{ $item->countryName }}</td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    <td>
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->show == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/state/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>
                                </td>
                                @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        		<div class="pagination">pagination">{!! $state->appends(\Input::except('page'))->render() !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('common-partials.common-fileds-index-script-partial')
@include('common-partials.common-search-employee-index-script-partial')
<script type="text/javascript">
    $(".chosen-select").chosen({
        placeholder_text_single: "Select an option",
        no_results_text: "Oops, nothing found!"
    });
    $('.slideDown').hide();
    $('.filterout').on('click',function(){
        $(".slideDown").toggle();
        $(".slideDown").css('visibility', 'visible');
        $(".resetfilter").addClass('hide');
        $(".exportToExcel").addClass('hide');
    });
    var resultZeroValue = $('.result-zero').val();
    if( resultZeroValue == '0' ){
        $('.filterout').addClass('hide');
    }

    $('.stateName').on('blur',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('.stateName').val('');
        $('#refresh2').addClass('hide');
    });
    

    $('.countryName').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.countryName').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });
</script>
@endsection