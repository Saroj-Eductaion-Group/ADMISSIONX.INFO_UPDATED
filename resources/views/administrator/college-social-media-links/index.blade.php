@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Collegesocialmedialinks</div>
                    <div class="panel-body">

                        <a href="{{ url('/administrator/college-social-media-links/create') }}" class="btn btn-primary btn-xs" title="Add New CollegeSocialMediaLink"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Title </th><th> Url </th><th> IsActive </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($collegesocialmedialinks as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td><td>{{ $item->url }}</td><td>{{ $item->isActive }}</td>
                                        <td>
                                            <a href="{{ url('/administrator/college-social-media-links/' . $item->id) }}" class="btn btn-success btn-xs" title="View CollegeSocialMediaLink"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/administrator/college-social-media-links/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit CollegeSocialMediaLink"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/administrator/college-social-media-links', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete CollegeSocialMediaLink" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete CollegeSocialMediaLink',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $collegesocialmedialinks->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection