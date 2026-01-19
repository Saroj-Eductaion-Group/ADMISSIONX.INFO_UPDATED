@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Collegeadmissionimportantdated</div>
                    <div class="panel-body">

                        <a href="{{ url('/administrator/college-admission-important-dated/create') }}" class="btn btn-primary btn-xs" title="Add New CollegeAdmissionImportantDated"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Fromdate </th><th> Todate </th><th> EventName </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($collegeadmissionimportantdated as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->fromdate }}</td><td>{{ $item->todate }}</td><td>{{ $item->eventName }}</td>
                                        <td>
                                            <a href="{{ url('/administrator/college-admission-important-dated/' . $item->id) }}" class="btn btn-success btn-xs" title="View CollegeAdmissionImportantDated"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/administrator/college-admission-important-dated/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit CollegeAdmissionImportantDated"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/administrator/college-admission-important-dated', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete CollegeAdmissionImportantDated" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete CollegeAdmissionImportantDated',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $collegeadmissionimportantdated->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection