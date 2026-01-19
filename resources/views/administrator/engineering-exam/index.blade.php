@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Engineeringexam</div>
                    <div class="panel-body">

                        <a href="{{ url('/engineering-exam/create') }}" class="btn btn-primary btn-xs" title="Add New EngineeringExam"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Title </th><th> Firstname </th><th> Middlename </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($engineeringexam as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td><td>{{ $item->firstname }}</td><td>{{ $item->middlename }}</td>
                                        <td>
                                            <a href="{{ url('/engineering-exam/' . $item->id) }}" class="btn btn-success btn-xs" title="View EngineeringExam"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/engineering-exam/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit EngineeringExam"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/engineering-exam', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete EngineeringExam" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete EngineeringExam',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $engineeringexam->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection