
@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Student Marks Details <a href="{{ url('administrator/studentmarks/create') }}" class="btn btn-primary pull-right btn-sm">Add New Student Marks</a></h2>
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
                            <th>Academic</th>
                            <th>Marks</th>
                            <th>Marks Type</th>
                            <th>Percentage</th>
                            <th>Student Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentmarks as $item)
                        <tr>
                            <td><a href="{{ url('administrator/studentmarks', $item->id) }}">{{ $item->id }}</a></td>
                            <td>
                                @if($item->studentmarksName)
                                    <a href="{{ url('administrator/studentmarks', $item->id) }}">{{ $item->studentmarksName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->marks)
                                    <a href="{{ url('administrator/studentmarks', $item->id) }}">{{ $item->marks }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->studentMarkType)
                                    {{ $item->studentMarkType }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->percentage)
                                    {{ $item->percentage }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->userID)
                                    {{ $item->firstname }} {{ $item->lastname }} 
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('administrator/studentmarks/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a> /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['administrator/studentmarks', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $studentmarks->render() !!} </div>
    </div>
</div>
@endsection

