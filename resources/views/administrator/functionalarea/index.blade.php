@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('FunctionalArea'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Stream Details @if(Auth::check()) @if(Auth::user()->userrole_id == 1) <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/create') }}" class="btn btn-primary pull-right btn-sm">Add New Stream</a> @endif @endif</h2>
        <!-- @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                    <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/create') }}" class="btn btn-primary pull-right btn-sm">Add New Stream</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/create') }}" class="btn btn-primary pull-right btn-sm">Add New Stream</a>
            @endif
        @endif
        </h2> -->
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Stream</h2>        
                    </div>    
                </div>
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/functionalarea') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 for="usr">Stream<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control functionalArea" name="functionalArea" placeholder="Enter Stream here" data-parsley-error-message="Please enter Stream" data-parsley-trigger="change" value="{{Request::get('functionalArea') }}">
                        </div> 
                        @include('common-partials.common-fileds-index-search-partial')
                        @include('common-partials.common-search-employee-fileds-index-partial')                      
                        
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/functionalarea') }}" class="btn btn-md btn-primary">Clear</a>
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
                <label class="pull-right">Total Result :- {{ $functionalarea->total() }}</label>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Stream</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($functionalarea as $item)
                        <tr>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea', $item->id) }}">{{ $item->name }}</a>
                                @include('common-partials.common-fileds-index-partial')
                            </td>
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
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    @endif
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                    </td>
                                @else
                                <td>
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $item->id) }}">
                                        <button type="submit" class="btn btn-info btn-xs">Show</button>
                                    </a> /
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/functionalarea/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                    </a>/
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => [$fetchDataServiceController->routeCall().'/functionalarea', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination"> {!! $functionalarea->appends(\Input::except('page'))->render() !!} </div>
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

    $('.functionalArea').on('blur',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.functionalArea').val('');
        $('#refresh1').addClass('hide');
    });
</script>
@endsection