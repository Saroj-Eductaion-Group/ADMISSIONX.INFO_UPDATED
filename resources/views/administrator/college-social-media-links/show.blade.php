@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CollegeSocialMediaLink {{ $collegesocialmedialink->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('administrator/college-social-media-links/' . $collegesocialmedialink->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit CollegeSocialMediaLink"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['administrator/collegesocialmedialinks', $collegesocialmedialink->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete CollegeSocialMediaLink',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $collegesocialmedialink->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $collegesocialmedialink->title }} </td></tr><tr><th> Url </th><td> {{ $collegesocialmedialink->url }} </td></tr><tr><th> IsActive </th><td> {{ $collegesocialmedialink->isActive }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection