@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AskQuestionTag'); /*--}}
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Ask Question Tag</h2>        
    </div>
    <div class="col-lg-1">
        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question-tags/') }}" class="btn btn-warning btn-sm" title="Ask Question Tag"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question-tags/' . $askquestiontag->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            @endif
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
            <div class="col-lg-1">
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => [$fetchDataServiceController->routeCall().'/ask-question-tags', $askquestiontag->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Ask Question Tag',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
            </div>
            @endif
        @else
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question-tags/' . $askquestiontag->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            <div class="col-lg-1">
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => [$fetchDataServiceController->routeCall().'/ask-question-tags', $askquestiontag->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Ask Question Tag',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
            </div>
        @endif
    @endif
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>{{ $askquestiontag->id }}</th>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $askquestiontag->name }} </td>
                        </tr>
                        <tr>
                            <th> Slug </th>
                            <td> {{ $askquestiontag->slug }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection