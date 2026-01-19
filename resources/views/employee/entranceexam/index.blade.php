@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Entrance Exam Details <a href="{{ url('employee/entranceexam/create') }}" class="btn btn-primary pull-right btn-sm">Add New Entrance Exam</a></h2>
    </div>
</div> -->

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
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Last Updated By</th>
                            @if($storeEditUpdateAction == '1')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entranceexam as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{ url('employee/entranceexam', $item->id) }}">{{ $item->name }}</a></td>
                            <td>
                                @if( $item->description )
                                    {{ $item->description }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            @if($storeEditUpdateAction == '1')
                            <td>
                                <a href="{{ url('employee/entranceexam/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a><!--  /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['employee/entranceexam', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!} -->
                            </td>  
                            @endif                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $entranceexam->render() !!} </div>
    </div>
</div>
@endsection
