@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('SliderManager'); /*--}}

<div class="row wrapper border-bottom white-bg page-heading">
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                <div class="col-lg-12">
                    <h2>Slider Manager details <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager/create') }}" class="btn btn-primary pull-right btn-sm">Add New Slider Manager</a></h2>
                </div>
            @endif
        @else
            <div class="col-lg-12">
                <h2>Slider Manager details <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager/create') }}" class="btn btn-primary pull-right btn-sm">Add New Slider Manager</a></h2>
            </div>
        @endif
    @endif
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Slider Manager</h2>        
                    </div>    
                </div>
                <form action="{{ URL::to($fetchDataServiceController->routeCall().'/slider-manager') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title name" data-parsley-trigger="change" data-parsley-error-message="Please enter title name" value="{{ Request::get('search') }}">
                        </div>                        
                        <div class="col-md-4 pull-right text-right margin-top20">
                            <a href="{{ URL::to($fetchDataServiceController->routeCall().'/slider-manager') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <th>Title</th>
                            <th>Slider Image</th>
                            <th>Status</th>
                            <th>Is Show Count</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($slidermanager as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->sliderTitle }}</td>
                            <td> 
                                @if( $item->sliderImage )
                                    <img class="img-responsive thumbnail" src="/slider-image/{{ $item->sliderImage }}" width="120" alt="{{ $item->sliderImage }}">
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif 
                            </td>
                            <td>
                                @if($item->status == '1') Active @else Inactive @endif
                            </td>
                            <td>
                                <div class="checkbox checkbox-primary">
                                    <input id="isShowCollegeCount" class="isShowCollegeCount" type="checkbox" sliderId="{{ $item->id }}" name="userstatus_id" @if( $item->isShowCollegeCount == 1) checked="" @endif>
                                    <label for="isShowCollegeCount">Is Show College Count</label>
                                </div>
                                 <div class="checkbox checkbox-info">
                                    <input id="isShowExamCount" class="isShowExamCount" type="checkbox" sliderId="{{ $item->id }}" name="verified" @if( $item->isShowExamCount == 1) checked="" @endif>
                                    <label for="isShowExamCount">Is Show Exam Count</label>
                                </div>
                                <div class="checkbox checkbox-success">
                                    <input id="isShowCourseCount" class="isShowCourseCount" type="checkbox" sliderId="{{ $item->id }}" name="isApproved" @if( $item->isShowCourseCount == 1) checked="" @endif>
                                    <label for="isShowCourseCount">Is Show Course Count</label>
                                </div>
                                <div class="checkbox checkbox-warning">
                                    <input id="isShowBlogCount" class="isShowBlogCount" type="checkbox" sliderId="{{ $item->id }}" name="isApproved" @if( $item->isShowBlogCount == 1) checked="" @endif>
                                    <label for="isShowBlogCount">Is Show Blog Count</label>
                                </div>
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $item->eUserId) }}" @endif>{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager/' . $item->id) }}">
                                    <button type="submit" class="btn btn-info btn-xs">Show</button>
                                </a> 
                                @if(Auth::check())
                                    @if(Auth::user()->userrole_id == 4)
                                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                                        /   <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager/' . $item->id . '/edit') }}">
                                                <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                            </a>
                                        @endif
                                    @else
                                        / <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                        </a>
                                    @endif
                                @endif
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $slidermanager->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowCollegeCount').on('click', function(){
        var id              = $(this).attr('sliderId');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }
        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/slider/isShowCollegeCount') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("Is Show College Count Status has been changes.");
                }
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowExamCount').on('click', function(){
        var id              = $(this).attr('sliderId');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }
        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/slider/isShowExamCount') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("Is Show Exam Count Status has been changes.");
                }
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowCourseCount').on('click', function(){
        var id              = $(this).attr('sliderId');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }
        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/slider/isShowCourseCount') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("Is Show Course Count Status has been changes.");
                }
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowBlogCount').on('click', function(){
        var id              = $(this).attr('sliderId');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }
        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/slider/isShowBlogCount') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("Is Show Blog Count Status has been changes.");
                }
            }
        });
    });
});
</script>

@endsection