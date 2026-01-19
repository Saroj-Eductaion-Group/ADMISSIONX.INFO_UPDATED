@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Facultyexperience</div>
                    <div class="panel-body">

                        <a href="{{ url('/administrator/faculty-experience/create') }}" class="btn btn-primary btn-xs" title="Add New FacultyExperience"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Fromyear </th><th> Toyear </th><th> Role </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($facultyexperience as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->fromyear }}</td><td>{{ $item->toyear }}</td><td>{{ $item->role }}</td>
                                        <td>
                                            <a href="{{ url('/administrator/faculty-experience/' . $item->id) }}" class="btn btn-success btn-xs" title="View FacultyExperience"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/administrator/faculty-experience/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit FacultyExperience"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/administrator/faculty-experience', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete FacultyExperience" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete FacultyExperience',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $facultyexperience->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection