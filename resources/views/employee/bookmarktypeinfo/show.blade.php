@extends('layouts.master')

@section('content')

    <h1>Bookmarktypeinfo</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Other</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $bookmarktypeinfo->id }}</td> <td> {{ $bookmarktypeinfo->name }} </td><td> {{ $bookmarktypeinfo->other }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection