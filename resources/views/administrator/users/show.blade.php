@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Users Details <a href="{{ url('administrator/users/create') }}" class="btn btn-primary pull-right btn-sm">Add New User</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
                <button class="margin-top10 btn  btn-dropbox" data-toggle="modal" data-target="#adminEmailModel" data-whatever="" href=""><i class="fa fa-envelope-o "></i> Notify User</button>
               <!-- <a href="{{ url('administrator/users') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                    @foreach( $users as $user)
                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        
                        @if($user->userrole_id == '2')
                            <tr>
                                <th>College Name</th>
                                <td>
                                    @if($user->firstname)
                                        {{ $user->firstname }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <th>Suffix</th>
                                <td>
                                    @if($user->suffix)
                                        {{ $user->suffix }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td>
                                    @if($user->firstname)
                                        {{ $user->firstname }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Middle Name</th>
                                <td>
                                    @if($user->middlename)
                                        {{ $user->middlename }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>
                                    @if($user->lastname)
                                        {{ $user->lastname }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>Email</th>
                            <td>
                                @if($user->email)
                                    {{ $user->email }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                @if($user->phone)
                                    {{ $user->phone }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Role</th>
                            <td>{{ $user->userRoleName }}</td>
                        </tr>
                        <tr>
                            <th>User Status</th>
                            <td>{{ $user->userStatusName }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($user->eUserId)
                                <a href="{{ url('administrator/users', $user->eUserId) }}">{{ $user->employeeFirstname }} {{ $user->employeeMiddlename}} {{ $user->employeeLastname}} (ID:- {{ $user->eUserId}}) Date & Time:-  {{ $user->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>                    
                </table>
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="adminEmailModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => 'adminSendEmails', 'method' =>'POST','class' => 'sky-form' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
                <div class="modal-header modal-header-design" style="background: #18BA98;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Notify User "{{ $user->firstname }}"</h4>
                </div>
                <div class="modal-body">
                    <div class="margin-bottom-20">
                        <label>Recipient</label>
                        <input class="form-control rounded-right" type="text" value="{{ $user->firstname }}" disabled="">
                    </div>
                    <input type="hidden" name="userEmail" value="{{ $user->email }}">

                    <div class="margin-bottom-20">
                        <label>Subject</label>
                        <input class="form-control rounded-right" type="text" name="subject" placeholder="Enter the subject" required="">
                    </div>
                    <div class="margin-bottom-20">
                        <label>Message</label>
                        <textarea class="form-control" rows="4" placeholder="Enter the message" name="message" required=""></textarea>
                    </div>
                    <div class="row " style="margin-top: 20px;">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn-u btn-block rounded">Submit</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


@endsection