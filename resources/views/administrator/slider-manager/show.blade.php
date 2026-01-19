@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('SliderManager'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Slider Manager Details {{ $slidermanager->id }}  <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                            <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager/' . $slidermanager->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit SliderManager"><i class="fa fa-pencil"></i> Edit</a>
                        @endif
                    @else
                        <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager/' . $slidermanager->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit SliderManager"><i class="fa fa-pencil"></i> Edit</a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/slider-manager', $slidermanager->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete SliderManager',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
                 
               <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <table class="table table-bordered">
                    <tbody class="tbody">
                        <tr>
                            <th>ID</th>
                            <td>{{ $slidermanager->id }}</td> 
                        </tr>
                        <tr>
                            <th>Slider Title</th>
                            <td>{{ $slidermanager->sliderTitle }} </td>
                        </tr>
                        <tr>
                            <th>Slider Image</th>
                            <td> 
                                @if(isset($slidermanager) && !empty($slidermanager->sliderImage))
                                    <img class="img-responsive thumbnail" src="/slider-image/{{ $slidermanager->sliderImage }}" alt="{{ $slidermanager->sliderImage }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Bottom Text</th>
                            <td>{{ $slidermanager->bottomText}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $slidermanager->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Scroller First Text</th>
                            <td>{{ $slidermanager->scrollerFirstText }} </td>
                        </tr>
                        <tr>
                            <th>Is Show Count</th>
                            <td>
                                <div class="checkbox checkbox-primary">
                                    <input id="isShowCollegeCount" class="isShowCollegeCount" type="checkbox" sliderId="{{ $slidermanager->id }}" name="userstatus_id" @if( $slidermanager->isShowCollegeCount == 1) checked="" @endif>
                                    <label for="isShowCollegeCount">Is Show College Count</label>
                                </div>
                                 <div class="checkbox checkbox-info">
                                    <input id="isShowExamCount" class="isShowExamCount" type="checkbox" sliderId="{{ $slidermanager->id }}" name="verified" @if( $slidermanager->isShowExamCount == 1) checked="" @endif>
                                    <label for="isShowExamCount">Is Show Exam Count</label>
                                </div>
                                <div class="checkbox checkbox-success">
                                    <input id="isShowCourseCount" class="isShowCourseCount" type="checkbox" sliderId="{{ $slidermanager->id }}" name="isApproved" @if( $slidermanager->isShowCourseCount == 1) checked="" @endif>
                                    <label for="isShowCourseCount">Is Show Course Count</label>
                                </div>
                                <div class="checkbox checkbox-warning">
                                    <input id="isShowBlogCount" class="isShowBlogCount" type="checkbox" sliderId="{{ $slidermanager->id }}" name="isApproved" @if( $slidermanager->isShowBlogCount == 1) checked="" @endif>
                                    <label for="isShowBlogCount">Is Show Blog Count</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Scroller Last Text</th>
                            <td>{{ $slidermanager->scrollerLastText }} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($slidermanager->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $slidermanager->eUserId) }}" @endif>{{ $slidermanager->employeeFirstname }} {{ $slidermanager->employeeMiddlename}} {{ $slidermanager->employeeLastname}} (ID:- {{ $slidermanager->eUserId}}) Date & Time:-  {{ $slidermanager->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
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