
@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <!-- <h2>Bookmark Details <a href="{{ url('administrator/bookmarks/create') }}" class="btn btn-primary pull-right btn-sm">Add New Bookmark</a></h2> -->
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Profile </th>
                            <th>College Name</th>
                            <th>Course Name</th>
                            <th>Blog Name</th>
                            <th>Last Updated By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookmarks as $item)
                        <tr>
                            <td><a href="{{ url('administrator/bookmarks', $item->id) }}">{{ $item->id }}</a></td>
                            <td>
                                @if( $item->u1firstname)
                                    <a href="{{ url('administrator/studentprofile') }}/{{ $item->studentprofileId }}" title="{{ $item->u1firstname }} {{ $item->u1lastname }}"> {{ $item->u1firstname }} {{ $item->u1lastname }} </a>
                                @else
                                    --
                                @endif
                            </td>
                             <td>
                                @if( $item->u2firstname)
                                    <a href="{{ url('administrator/collegeprofile') }}/{{ $item->collegeprofileId }}" title="{{ $item->u2firstname }} {{ $item->u2lastname }}">{{ $item->u2firstname }} {{ $item->u2lastname }} </a>
                                @else
                                    --
                                @endif
                            </td>
                             <td>
                                @if( $item->courseName)
                                    <a href="{{ url('administrator/collegemaster') }}/{{ $item->collegemasterID }}" title="{{ $item->courseName }}">{{ $item->courseName }} </a>
                                @else
                                    --
                                @endif
                            </td>
                             <td>
                                @if( $item->topic)
                                    <a href="{{ url('administrator/blogs') }}/{{ $item->blogsID }}" title="{{ $item->topic }}">{{ $item->topic }} </a>
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td><a href="{{ url('administrator/bookmarks', $item->id) }}"><button class="btn btn-primary btn-xs">Show</button></a> /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['administrator/bookmarks', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}</td>
                            <!-- <td>
                                <a href="{{ url('administrator/bookmarks/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a> /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['administrator/bookmarks', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </td>                                     -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $bookmarks->render() !!} </div>
    </div>
</div>
@endsection


