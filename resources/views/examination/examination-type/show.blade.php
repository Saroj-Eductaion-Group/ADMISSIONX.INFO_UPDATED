@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Examination Type Details {{ $examinationtype->id }}  <a href="{{ url('examination/examination-type/create') }}" class="btn btn-primary pull-right btn-sm">Add New Examination Type</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url('examination/examination-type') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <a href="{{ url('examination/examination-type/' . $examinationtype->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Examination Type"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['examination/examination-type', $examinationtype->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'title' => 'Delete Examination Type',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $examinationtype->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $examinationtype->name }} </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $examinationtype->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($examinationtype->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url('administrator/users', $examinationtype->eUserId) }}" @endif>{{ $examinationtype->employeeFirstname }} {{ $examinationtype->employeeMiddlename}} {{ $examinationtype->employeeLastname}} (ID:- {{ $examinationtype->eUserId}}) Date & Time:-  {{ $examinationtype->updated_at}} </a></a>
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