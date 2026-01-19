@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Facultydepartment</div>
                    <div class="panel-body">

                        <a href="{{ url('/administrator/faculty-department/create') }}" class="btn btn-primary btn-xs" title="Add New FacultyDepartment"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Functionalarea Id </th><th> Educationlevel Id </th><th> Degree Id </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($facultydepartment as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->functionalarea_id }}</td><td>{{ $item->educationlevel_id }}</td><td>{{ $item->degree_id }}</td>
                                        <td>
                                            <a href="{{ url('/administrator/faculty-department/' . $item->id) }}" class="btn btn-success btn-xs" title="View FacultyDepartment"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/administrator/faculty-department/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit FacultyDepartment"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/administrator/faculty-department', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete FacultyDepartment" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete FacultyDepartment',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $facultydepartment->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection