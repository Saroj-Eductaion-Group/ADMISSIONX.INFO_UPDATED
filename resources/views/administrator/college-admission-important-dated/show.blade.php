@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CollegeAdmissionImportantDated {{ $collegeadmissionimportantdated->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('administrator/college-admission-important-dated/' . $collegeadmissionimportantdated->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit CollegeAdmissionImportantDated"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['administrator/collegeadmissionimportantdated', $collegeadmissionimportantdated->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete CollegeAdmissionImportantDated',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $collegeadmissionimportantdated->id }}</td>
                                    </tr>
                                    <tr><th> Fromdate </th><td> {{ $collegeadmissionimportantdated->fromdate }} </td></tr><tr><th> Todate </th><td> {{ $collegeadmissionimportantdated->todate }} </td></tr><tr><th> EventName </th><td> {{ $collegeadmissionimportantdated->eventName }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection