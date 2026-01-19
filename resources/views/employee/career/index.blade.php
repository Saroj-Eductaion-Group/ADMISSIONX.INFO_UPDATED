@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Career Details <a href="{{ url('employee/career/create') }}" class="btn btn-primary pull-right btn-sm">Add New Career</a></h2>
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
                            <th>S.No</th>
                            <th>Name</th>
                           <!--  <th>Middlename</th>
                            <th>Lastname</th> -->
                            <th>Email</th>
                            <th>D.O.B</th>
                            <th>Gender</th>
                            <th>Phone No.</th>
                            <!-- <th>Address</th>
                            <th>Pincode</th> -->
                            <th>Post Apply</th>
                            <th>Last Updated By</th>
                            @if($storeEditUpdateAction == '1')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($career as $item)
                            <tr>
                                <td><a href="{{ url('employee/career', $item->id) }}">{{ $item->id }}</a></td>
                                <td><a href="{{ url('employee/career', $item->id) }}">{{ $item->firstname }}</a></td>
                                <!-- <td>{{ $item->middlename }}</td>
                                <td>{{ $item->lastname }}</td> -->
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->dateOfBirth }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->phonenumber }}</td>
                                <!-- <td>{{ $item->address }}</td>
                                <td>{{ $item->pincode }}</td> -->
                                <td>{{ $item->postappliedfor }}</td>
                                <td>
                                    @if($item->eUserId)
                                    <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                                @if($storeEditUpdateAction == '1')
                                <td>
                                    <a href="{{ url('employee/career/' . $item->id . '/edit') }}">
                                        <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                    </a> /
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['employee/career', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $career->render() !!} </div>
    </div>
</div>
@endsection




