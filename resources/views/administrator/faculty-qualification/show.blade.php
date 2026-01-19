@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">FacultyQualification {{ $facultyqualification->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('administrator/faculty-qualification/' . $facultyqualification->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit FacultyQualification"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['administrator/facultyqualification', $facultyqualification->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete FacultyQualification',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $facultyqualification->id }}</td>
                                    </tr>
                                    <tr><th> Qualification </th><td> {{ $facultyqualification->qualification }} </td></tr><tr><th> Course </th><td> {{ $facultyqualification->course }} </td></tr><tr><th> Sunjects </th><td> {{ $facultyqualification->sunjects }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection