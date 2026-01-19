@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Facultyqualification</div>
                    <div class="panel-body">

                        <a href="{{ url('/administrator/faculty-qualification/create') }}" class="btn btn-primary btn-xs" title="Add New FacultyQualification"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Qualification </th><th> Course </th><th> Sunjects </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($facultyqualification as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->qualification }}</td><td>{{ $item->course }}</td><td>{{ $item->sunjects }}</td>
                                        <td>
                                            <a href="{{ url('/administrator/faculty-qualification/' . $item->id) }}" class="btn btn-success btn-xs" title="View FacultyQualification"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/administrator/faculty-qualification/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit FacultyQualification"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/administrator/faculty-qualification', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete FacultyQualification" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete FacultyQualification',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $facultyqualification->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection