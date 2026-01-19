
@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>User Privilege Details
        <a class="btn btn-primary pull-right btn-sm"  data-toggle="modal" data-target="#userPrivilegesAddTableEmplyeeModal" data-whatever="" href="">Add New Table</a></h2>
        <!-- <h2><a href="{{ url('employee/userprivilege') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2> -->

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
                        <div class="alert alert-success alert-dismissible" role="alert">
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
                            <th>Table Name</th>
                            <th>Employee Name</th>
                            <th>Last Updated By</th>
                            @if($storeEditUpdateAction == '1')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userprivilege as $item)
                        <tr>
                            <td><a href="{{ url('employee/userprivilege', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url('employee/userprivilege', $item->id) }}">{{ $item->tableName }}</a></td>
                            <td>{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) Date & Time:-  {{ $item->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            @if($storeEditUpdateAction == '1')
                            <td>
                                <a href="{{ url('employee/userprivilege/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a> /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['employee/userprivilege', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </td>
                            @endif                          
                        </tr>
                        <div class="modal fade" id="userPrivilegesAddTableEmplyeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="/employee/userprivilege/addtable" data-parsley-validate>
                                        <div class="modal-header modal-header-design" style="background: #18BA98;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Add New Table</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="usersId" value="{{ $item->usersId }}">
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Employee Name :</label>
                                                <div class="col-sm-9">
                                                    {{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}
                                                </div>
                                            </div>
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Table Name : </label>
                                                <div class="col-sm-9">
                                                    <select name="allTableInformation_id" class="form-control" data-parsley-error-message=" Please select table name " data-parsley-trigger="change" required="">
                                                        <option disabled="" selected="">Select Table</option>
                                                        @foreach($allTableInfoObj as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>                            
                                                </div>
                                            </div>
                                            <!-- <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Employee Name  : </label>
                                                <div class="col-sm-9">
                                                    <select name="users_id" class="form-control" data-parsley-error-message=" Please select employee name " data-parsley-trigger="change" required="">
                                                        <option disabled="" selected="">Select Employee</option>
                                                        @foreach($allUsersObj as $item)
                                                            <option value="{{ $item->id }}">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</option>
                                                        @endforeach
                                                    </select>                            
                                                </div>
                                            </div> -->
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Create Action : </label>
                                                <div class="col-sm-9">
                                                    <select name="create" class="form-control" data-placeholder="Choose create option ..."  data-parsley-error-message=" Please select create " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Update Action : </label>
                                                <div class="col-sm-9">
                                                    <select name="edit" class="form-control" data-placeholder="Choose update option ..."  data-parsley-error-message=" Please select update " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >List / Show Action : </label>
                                                <div class="col-sm-9">
                                                    <select name="listOtherAction" class="form-control" data-placeholder="Choose create option ..."  data-parsley-error-message=" Please select index " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No </option>
                                                    </select>
                                                </div>
                                            </div>                    
                                             
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Metrics 1 : </label>
                                                <div class="col-sm-9">
                                                    <select name="metrics1" class="form-control" data-placeholder="Choose metrics 1 ..."  data-parsley-error-message=" Please select metrics 1 " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>  
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Metrics 2 : </label>
                                                <div class="col-sm-9">
                                                    <select name="metrics2" class="form-control" data-placeholder="Choose metrics 2 ..."  data-parsley-error-message=" Please select metrics 2 " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Metrics 3 : </label>
                                                <div class="col-sm-9">
                                                    <select name="metrics3" class="form-control" data-placeholder="Choose metrics 3 ..."  data-parsley-error-message=" Please select metrics 3 " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Metrics 4 : </label>
                                                <div class="col-sm-9">
                                                    <select name="metrics4" class="form-control" data-placeholder="Choose metrics 4 ..."  data-parsley-error-message=" Please select metrics 4 " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>     
                                                
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Metrics 5 : </label>
                                                <div class="col-sm-9">
                                                    <select name="metrics5" class="form-control" data-placeholder="Choose metrics 5 ..."  data-parsley-error-message=" Please select metrics 5 " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Metrics 6 : </label>
                                                <div class="col-sm-9">
                                                    <select name="metrics6" class="form-control" data-placeholder="Choose metrics 6 ..."  data-parsley-error-message=" Please select metrics 6 " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>             
                                            <div class="row padding-top5 padding-bottom5">
                                                <label class="col-sm-3 control-label" >Queries : </label>
                                                <div class="col-sm-9">
                                                    <select name="queries" class="form-control" data-placeholder="Choose Queries ..."  data-parsley-error-message=" Please select Queries " data-parsley-trigger="change">
                                                        <option value="0" selected="" >Select Yes/No</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row padding-top5 padding-bottom5">
                                                <div class="col-sm-offset-10 col-sm-2 text-right">
                                                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $userprivilege->render() !!} </div>
    </div>
</div>
@endsection
