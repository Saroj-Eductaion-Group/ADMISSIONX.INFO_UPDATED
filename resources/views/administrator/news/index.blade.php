@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('News'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-12">
        <h2>News Details 
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                <a href="{{ url($fetchDataServiceController->routeCall().'/news/create') }}" class="btn btn-primary pull-right btn-sm">Add New News</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/news/create') }}" class="btn btn-primary pull-right btn-sm">Add New News</a>
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
                        <h2>Search News Details</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/news') }}" method="GET">
                    <div class="row">
                        <div class="" id="data_5">
                            <div class="input-daterange" id="datepicker">
                                <div class="col-md-4">
                                    <label>Start Date</label>
                                    <input type="text" id="txtFromCreateDate" class="form-control startRange" style="text-align: left;" name="startdate" placeholder="Enter start date" data-parsley-trigger="change" data-parsley-error-message="Please enter start date" readonly="" value="{{ Request::get('startdate') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>End Date</label>
                                    <input type="text" id="txtToCreateDate" class="form-control endRange" style="text-align: left;" name="enddate" placeholder="Enter end date" data-parsley-trigger="change" data-parsley-error-message="Please enter end date" readonly="" value="{{ Request::get('enddate') }}">   
                                </div> 
                                <div class="col-md-4">
                                    <label class="control-label">User Name</label>
                                    <select class="form-control chosen-select"  name="userId" data-parsley-error-message="Please select User">
                                        <option disabled="" selected="">Please select</option>
                                        @foreach( $usersObj as $item )
                                            @if( Request::get('userId') == $item->UserID )
                                                <option value="{{ $item->UserID }}" selected="">{{ $item->firstName }} {{ $item->lastName}}</option>
                                            @else
                                                <option value="{{ $item->UserID }}">{{ $item->firstName }} {{ $item->lastName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>                        
                            </div>
                        </div> 
                    </div>
                    <div class="row margin-top20">
                        <div class="col-md-6">
                           <label class="control-label">News Type</label>
                           <div>
                                <select class="form-control chosen-select newstypeids" name="newstypeids" data-parsley-error-message="Please select news type" data-parsley-trigger="change" >
                                    <option value="" selected="" disabled="">Please select news types</option>
                                    @foreach( $newsTypeObj as $item )
                                        @if(Request::get('newstypeids') == $item->id)
                                            <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <label class="control-label">News Tags</label>
                             <div>
                                {{--*/
                                    $newsTagArray = Request::get('newstagsids'); 
                                /*--}}
                                <select class="form-control chosen-select newstagsids" name="newstagsids[]" data-parsley-error-message="Please select news tags" data-parsley-trigger="change">
                                    <option value="" selected="" disabled="">Please select news tags</option>
                                    @foreach( $newsTagObj as $item )
                                        @if(!empty(Request::get('newstagsids')))
                                            {{--*/ $flagNews = 0; /*--}}
                                            @foreach($newsTagArray as $obj)
                                                @if( $obj == $item->id )
                                                    {{--*/ $flagNews = 1; /*--}}
                                                    <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                                    {{--*/ break; /*--}}
                                                @endif                                    
                                            @endforeach
                                            @if($flagNews == 0)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top20">
                        <div class="col-md-6">
                            <h4>Topic <span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" name="topic" class="form-control name" value="{{ Request::get('topic') }}">
                        </div>   
                        <div class="col-md-3">
                            <div class="margin-bottom-20">
                                <h4>Status <span class="pull-right"><a href="javascript:void(0);" id="refresh7" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="radio radio-info">
                                            <input type="radio" class="status" id="status1" value="0" name="status" @if(Request::get('status') == '0') checked="" @endif>
                                            <label for="status1"> UNPUBLISHED </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio radio-info">
                                            <input type="radio" class="status" id="status0" value="1" name="status" @if(Request::get('status') == '1') checked="" @endif>
                                            <label for="status0"> PUBLISHED </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/news') }}" class="btn btn-md btn-primary">Clear</a>
                            <button class="btn btn-danger btn-md">Submit</button>                        
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                @if(Session::has('flash_message'))
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ Session::get('flash_message') }}</strong>
                            </div>
                        </div>
                    </div>
                @endif
                @if( sizeof($news) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Topic </th>
                            <th>Description</th>
                            <th>Publish or Not</th>
                            <th>News Type</th>
                            <th>News Tags</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        @foreach( $news as $key => $item )
                        <tr>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/news', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url($fetchDataServiceController->routeCall().'/news', $item->id) }}">{{ $item->topic }}</a></td>
                            <td class="">
                                 <span class="minimize"><p class="no-word-wrap">{{ strip_tags($item->description) }}</p></span>
                            </td>
                            <td>
                                @if( $item->isactive == '1' )
                                    <span class="label label-success">Published</span>
                                @else
                                    <span class="label label-danger">Not Published</span>
                                @endif
                            </td>
                            <td>@if($item->newstypeids) {{ $item->news_typesname }} @else -- @endif </td>
                            <td>
                                @if($item->newstagsids) 
                                    @foreach( $item->tagname as $key1 => $item1 )
                                        <span class="badge badge-info">{{ $item1->name }} </span>
                                    @endforeach
                                @else 
                                    <span class="badge badge-warning">Not Updated yet</span>
                                @endif 
                            </td>
                            <td><a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->userID ) }}" @endif>{{ $item->firstname }} {{ $item->lastname }}</a></td>
                            <td>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/news/' . $item->id) }}">
                                    <button type="submit" class="btn btn-info btn-xs">View</button>
                                </a>
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                            / <a href="{{ url($fetchDataServiceController->routeCall().'/news/' . $item->id . '/edit') }}">
                                                <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                            </a>
                                        @endif
                                    @else
                                        / <a href="{{ url($fetchDataServiceController->routeCall().'/news/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => [$fetchDataServiceController->routeCall().'/news', $item->id],
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
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Topic </th>
                            <th>Description</th>
                            <th>Publish or Not</th>
                            <th>News Type</th>
                            <th>News Tags</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot> 
                    </table>
                </div>
                <div class="pagination-wrapper text-right"> {!! $news->appends(\Input::except('page'))->render() !!}</div>
                @else
                    <div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
    $("#txtFromCreateDate").datepicker({
        numberOfMonths: 1,
        changeMonth: true,
        changeYear: true,
        yearRange:  '1940:2050',
        endDate : 'today',
        onSelect: function(selected) {
          $("#txtToCreateDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToCreateDate").datepicker({ 
        numberOfMonths: 1,
        changeMonth: true,
        changeYear: true,
        yearRange:  '1940:2050',
        endDate : 'today',
        onSelect: function(selected) {
           $("#txtFromCreateDate").datepicker("option","maxDate", selected)
        }
    });

</script>
<script type="text/javascript">
    var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span></span><a href="#" class="more">... <span class="badge badge-danger">Read More</span></a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(100,t.length)+'<br> <a href="#" class="less">... <span class="badge badge-danger">Read Less</span></a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>
@endsection