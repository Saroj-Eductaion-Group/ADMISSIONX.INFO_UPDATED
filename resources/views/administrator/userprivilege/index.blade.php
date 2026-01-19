
@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>User Privilege Details <a href="{{ url('administrator/userprivilege/create') }}" class="btn btn-primary pull-right btn-sm">Add New User Privilege</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <br />
            <div class="row">
                <div class="col-md-7 col-md-offset-3">
                    @if(Session::has('warning'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ Session::get('warning') }}</strong>
                        </div>                        
                    @endif
                </div>    
            </div>
            <div class="row">
                <div class="col-md-7 col-md-offset-3">
                    @if(Session::has('duplicate'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{!! Session::get('duplicate') !!}</strong>
                        </div>                        
                    @endif
                </div>    
            </div>
            <div class="ibox-content">
               <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Employee Name</th>
                            <th>Last Updated By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--*/ $counter = '0' /*--}}
                        @foreach($userprivilege as $key => $item)
                         {{--*/ $counter++ /*--}}
                        <tr>
                            <td><a href="{{ url('administrator/userprivilege-table-info', $item->usersId) }}">{{ $counter }}</a></td>
                            <td><a href="{{ url('administrator/userprivilege-table-info', $item->usersId) }}">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</a></td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}})  <hr> Date & Time:- {{ $item->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::to('administrator/userprivilege/delete', $item->usersId) }}" class='btn btn-danger btn-xs'>Delete</a>
                            </td>                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $userprivilege->render() !!} </div>
    </div>
</div>
@endsection
