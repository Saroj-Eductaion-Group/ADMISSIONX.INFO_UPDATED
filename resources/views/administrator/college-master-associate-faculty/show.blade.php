@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CollegeMasterAssociateFaculty {{ $collegemasterassociatefaculty->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('administrator/college-master-associate-faculty/' . $collegemasterassociatefaculty->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit CollegeMasterAssociateFaculty"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['administrator/collegemasterassociatefaculty', $collegemasterassociatefaculty->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete CollegeMasterAssociateFaculty',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $collegemasterassociatefaculty->id }}</td>
                                    </tr>
                                    <tr><th> Functionalarea Id </th><td> {{ $collegemasterassociatefaculty->functionalarea_id }} </td></tr><tr><th> Educationlevel Id </th><td> {{ $collegemasterassociatefaculty->educationlevel_id }} </td></tr><tr><th> Degree Id </th><td> {{ $collegemasterassociatefaculty->degree_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection