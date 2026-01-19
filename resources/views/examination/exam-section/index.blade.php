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
        <h2>Exam Section details <a href="{{ url('examination/exam-section/create') }}" class="btn btn-primary pull-right btn-sm">Add New Exam Section</a></h2>
    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search Exam Section</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to('/examination/exam-section') }}" method="GET">
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

                        <div class="col-md-3">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter title" data-parsley-trigger="change" data-parsley-error-message="Please enter title" value="{{ Request::get('search') }}">
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
                        @include('common-partials.common-exam-fileds-index-search-partial')
                        @include('common-partials.common-search-employee-fileds-index-partial')                                                         
                        <div class="col-md-3 pull-right text-right margin-top20">
                            <a href="{{ URL::to('/examination/exam-section') }}" class="btn btn-md btn-primary">Clear</a>
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
                            <!-- <th>Name</th> -->
                            <th>Title</th>
                            <th>Icon Image</th>
                            <th>Status</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($examsection as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->functionalAreaName }}</td>
                            <!-- <td>{{ $item->name }}</td> -->
                            <td>
                                {{ $item->title }}
                                @include('common-partials.common-exam-fileds-index-partial')
                            </td>
                            <td> 
                                @if( $item->iconImage )
                                    <img class="img-responsive thumbnail" src="/examinationicon/{{ $item->iconImage }}" width="120" alt="{{ $item->iconImage }}">
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif 
                            </td>
                            <td>
                                @if($item->status == '1')
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-warning">Inactive</span>
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
                                <a href="{{ url('examination/exam-section/' . $item->id) }}">
                                    <button type="submit" class="btn btn-info btn-xs">Show</button>
                                </a> /
                                <a href="{{ url('examination/exam-section/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                                </a> /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['examination/exam-section', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete Eligibility Criteria',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    ))!!}
                                {!! Form::close() !!}
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $examsection->render() !!} </div>
    </div>
</div>
@endsection

@section('script')
@include('common-partials.common-exam-fileds-index-script-partial')
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


