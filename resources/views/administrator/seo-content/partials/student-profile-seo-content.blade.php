@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('SeoContent'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Student Profile Page SEO</h2>        
    </div>    
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Student Profile Page SEO</h2>        
                    </div>    
                </div>
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/student-seo-content') }}" method="GET">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Student Name</label>
                            <select class="form-control userId chosen-select" id="userId" name="userId" data-parsley-error-message="Please select college name">
                                <option disabled="" selected="">Please select</option>
                                 @foreach( $studentProfileObj as $item )
                                    <option value="{{ $item->studentprofileID }}" @if(Request::get('userId') == $item->studentprofileID) selected="" @endif>{{$item->firstname}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    <div class="row margin-top20">
                        <div class="col-md-4">
                            <label class="control-label">Page Title</label>
                            <input type="text" name="pagetitle" class="form-control" value="{{ Request::get('pagetitle') }}">
                        </div>    
                        <div class="col-md-4">
                            <label class="control-label">Meta Keyword</label>
                            <input type="text" name="keyword" class="form-control" value="{{ Request::get('keyword') }}">
                        </div> 
                        <div class="col-md-4">
                            <label class="control-label">H1 Title</label>
                            <input type="text" name="h1title" class="form-control" value="{{ Request::get('h1title') }}">
                        </div> 
                    </div>
                    <div class="row margin-top20">
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/student-seo-content') }}" class="btn btn-md btn-primary">Clear</a>
                            <button class="btn btn-danger btn-md">Submit</button>                            
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
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
                @if( sizeof($seocontent) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page Title</th>
                        <th>H1 Title</th>
                        <th>Keyword</th>
                        <th>SEO On Page</th>
                        <th>Last Updated By</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $seocontent as $key => $item )
                    <tr>
                        <td class="text-capitalize"><a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id) }}">{{ $key+1 }}</a></td>
                        <td class=""><a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id) }}">{{ $item->pagetitle }}</a></td>
                        <td class="">{{ $item->h1title }}</td>
                        <td>{{ $item->keyword }}</td>
                        <td>
                            @if(!empty($item->userId))
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        {{ $item->studentName }}
                                    @else
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/collegeprofile/' . $item->userId) }}">{{ $item->studentName }}</a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($item->eUserId)
                            <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                            @else
                                <span class="label label-warning">Not Updated Yet</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id) }}" title="View Seo Content"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            @if(Auth::check())
                                @if(Auth::user()->userrole_id == 4)
                                    @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id . '/edit') }}" title="Edit Seo Content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    @endif
                                @else
                                    <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/' . $item->id . '/edit') }}" title="Edit Seo Content"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <div class="pagination-wrapper text-right"> {!! $seocontent->appends(\Input::except('page'))->render() !!}</div>
                @else
                    <div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            window.setTimeout(function() { $(".alert-danger").alert('close'); }, 8000);
        });
    </script>
@endsection