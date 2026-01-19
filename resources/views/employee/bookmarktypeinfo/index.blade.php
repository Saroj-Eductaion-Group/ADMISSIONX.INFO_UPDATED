@extends('layouts.master')

@section('content')

    <h1>Bookmarktypeinfo <a href="{{ url('employee/bookmarktypeinfo/create') }}" class="btn btn-primary pull-right btn-sm">Add New Bookmarktypeinfo</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Name</th><th>Other</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($bookmarktypeinfo as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('employee/bookmarktypeinfo', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->other }}</td>
                    <td>
                        <a href="{{ url('employee/bookmarktypeinfo/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['employee/bookmarktypeinfo', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $bookmarktypeinfo->render() !!} </div>
    </div>

@endsection
