@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
     <div class="col-lg-12">
        <h2>User Groups Details <a href="{{ url('administrator/usergroup/create') }}" class="btn btn-primary pull-right btn-sm">Add New User Group</a></h2>
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
            <div class="ibox-content">
               <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Group Name</th>
                            <th>Group Created By</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--*/ $counter = '0' /*--}}
                        @foreach($usergroup as $key => $item)
                        {{--*/ $counter++ /*--}}
                        <tr>
                            <td><a href="{{ url('administrator/usergroup-table-info', $item->slug) }}">{{ $counter }}</a></td>
                            <td><a href="{{ url('administrator/usergroup-table-info', $item->slug) }}">{{ $item->userGroupName }}</a></td>
                            <td>@if($item->firstname)
                                    {{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}
                                @else
                                    Not Updated Yet
                                @endif
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}})  Date & Time:- {{ $item->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#userGroupUpdateModal_{{ $counter }}" data-whatever="" href="">Update</a> /
                                <a href="{{ URL::to('administrator/usergroup/delete', $item->id) }}" class='btn btn-danger btn-xs'>Delete</a>
                                

                                <div class="modal fade" id="userGroupUpdateModal_{{ $counter }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            {!! Form::model($item, ['method' => 'PATCH', 'url' => ['administrator/usergroup', $item->id], 'class' => 'form-horizontal homeLoginPopupWindow','data-parsley-validate' => '', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off' ]) !!}

                                                <div class="modal-header modal-header-design" style="background: #18BA98;">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Update Group Name</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row padding-top5 padding-bottom5">
                                                        <input type="hidden" name="groupNameId" value="{{ $item->id }}">
                                                        <input type="hidden" name="slugUrl" value="{{ $item->slug }}">
                                                        <div class="col-md-12">
                                                            <label>Group Name</label>
                                                            <input type="text" class="form-control" name="name" placeholder="Enter group name here" data-parsley-trigger="change" data-parsley-error-message="Please enter group here" required="" value="{{ $item->userGroupName }}">
                                                        </div>
                                                    </div>
                                                    <div class="row padding-top5 padding-bottom5">
                                                        <div class="col-sm-offset-10 col-sm-2 text-right">
                                                            {!! Form::submit('Update', ['class' => 'btn btn-primary btn-xs']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </td>                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $usergroup->render() !!} </div>
    </div>
</div>


<!-- END -->
@endsection
