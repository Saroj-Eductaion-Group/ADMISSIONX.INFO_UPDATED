@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('City'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-12">
        <h2>City Details @if(Auth::check()) @if(Auth::user()->userrole_id == 1) <a href="{{ url($fetchDataServiceController->routeCall().'/city/create') }}" class="btn btn-primary pull-right btn-sm">Add New City</a> @endif @endif</h2>
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search City</h2>        
                    </div>    
                </div>
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/city') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 for="usr">Country Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select name="country_id" class="form-control chosen-select country_id">
                                <option selected="" disabled="">Country</option>
                                @if( $countryObj )
                                    <option value="99">India</option>
                                    @foreach( $countryObj as $item )
                                        @if( $item->id == '99' )
                                            <option value="99" @if(Request::get('country_id') == '99') selected="" @endif>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}" @if(Request::get('country_id') == $item->id) selected="" @endif>{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            
                        </div> 
                        <div class="col-md-4">
                            <h4 for="usr">State Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select name="stateName" class="form-control chosen-select stateName" data-parsley-trigger="change" data-parsley-error-message="Please select state name">
                                <option selected="" disabled="">Select state name</option>
                                @if(isset($stateObj) && sizeof($stateObj) > 0 )
                                    @foreach( $stateObj as $item )
                                        <option value="{{ $item->id }}" @if(Request::get('stateName') == $item->id) selected="" @endif>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h4 for="usr">City Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control cityName" name="cityName" placeholder="Enter city name here" data-parsley-error-message="Please enter city name" data-parsley-trigger="change" value="{{Request::get('cityName') }}">
                        </div> 
                        
                    </div>
                    <hr>
                    <div class="row">
                        @include('common-partials.common-fileds-index-search-partial')
                        @include('common-partials.common-search-employee-fileds-index-partial')
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/city') }}" class="btn btn-md btn-primary">Clear</a>
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
                <label class="pull-right">Total Result :- {{ $city->total() }}</label>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>City Name</th>
                            <th>City Status</th>
                            <th>State Name</th>
                            <th>Country Name</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($city as $item)
                        <tr>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/city', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/city', $item->id) }}">{{ $item->name }}</a>
                            	@include('common-partials.common-fileds-index-partial')
                            </td>
                             <td>@if($item->cityStatus == '1') 
                                   <span class="label label-success">Active</span> 
                                @else
                                   <span class="label label-warning">Inactive</span> 
                                @endif
                            </td>
                            <td>{{ $item->stateName }}</td>
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
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/city/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>
                                </td>
                                @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        		<div class="pagination">{!! $city->appends(\Input::except('page'))->render() !!}</div>
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

    $('.cityName').on('blur',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('.cityName').val('');
        $('#refresh2').addClass('hide');
    });
    

    $('.stateName').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.stateName').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });

    $('.country_id').on('change',function(){
        $('#refresh3').removeClass('hide');
    });
    $('#refresh3').on('click',function(e){
        $('.country_id').val('').trigger('chosen:updated');
        $('#refresh3').addClass('hide');
        $('.stateName').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });

</script>
<script type="text/javascript">
    $('select[name=country_id]').on('change', function(){
        var countryID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {countryID: countryID},
            url: "{{ URL::to('getAllStateName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">State</option>';
                if( data.code == '200' ){
                    $.each(data.stateObj, function(i, item) {
                        HTML += '<option value="'+data.stateObj[i].stateId+'">'+data.stateObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No state available</option>';
                }

                $('select[name="stateName"]').empty();
                $('select[name="stateName"]').html(HTML);
                $('select[name="stateName"]').trigger('chosen:updated');
            }
        });
    });

    $('select[name=stateName]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCityName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">City</option>';
                if( data.code == '200' ){
                    $.each(data.cityObj, function(i, item) {
                        HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No city available</option>';
                }

                $('select[name="city_id"]').empty();
                $('select[name="city_id"]').html(HTML);
                $('select[name="city_id"]').trigger('chosen:updated');
            }
        });
    });
</script>
@endsection