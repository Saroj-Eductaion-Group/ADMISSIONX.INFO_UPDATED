@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Exam Section Details {{ $examsection->id }}  <a href="{{ url('examination/exam-section/create') }}" class="btn btn-primary pull-right btn-sm">Add New Exam Section</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url('examination/exam-section') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <a href="{{ url('examination/exam-section/' . $examsection->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Eligibility Criteria"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['examination/exam-section', $examsection->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'title' => 'Delete Eligibility Criteria',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $examsection->id }}</td> 
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>{{ $examsection->functionalAreaName }}</td>
                        </tr>
                        <!-- <tr>
                            <th>Name</th>
                            <td>{{ $examsection->name }} </td>
                        </tr> -->
                        <tr>
                            <th>Title</th>
                            <td>{{ $examsection->title }} </td>
                        </tr>
                        <tr>
                            <th>Icon Image</th>
                            <td> 
                                @if(isset($examsection) && !empty($examsection->iconImage))
                                    <img class="img-responsive thumbnail" width="200" src="/examinationicon/{{ $examsection->iconImage }}" alt="{{ $examsection->iconImage }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $examsection->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        @include('common-partials.common-exam-fileds-details-partial')
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($examsection->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $examsection->eUserId) }}" @endif>{{ $examsection->employeeFirstname }} {{ $examsection->employeeMiddlename}} {{ $examsection->employeeLastname}} (ID:- {{ $examsection->eUserId}}) Date & Time:-  {{ $examsection->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>

@endsection