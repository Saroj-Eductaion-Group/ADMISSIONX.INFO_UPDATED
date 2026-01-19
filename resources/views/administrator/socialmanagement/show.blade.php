@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <!-- <h2>Faculty Details <a href="{{ url('administrator/faculty/create') }}" class="btn btn-primary pull-right btn-sm">Add New Faculty</a></h2> -->
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/socialmanagement') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $socialmanagement->id }}</td> 
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $socialmanagement->title }}</td>
                        </tr>
                        <tr>
                            <th>Url</th>
                            <td>{{ $socialmanagement->url }}</td>
                        </tr>
                        <tr>
                            <th>IsActive</th>
                            <td>
                                @if($socialmanagement -> isActive == '0')
                                    <span class="label label-warning"> Inactive</span>
                                @elseif($socialmanagement -> isActive == '1')
                                   <span class="label label-success"> Active</span>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $socialmanagement->description }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($socialmanagement->eUserId)
                                <a href="{{ url('administrator/users', $socialmanagement->eUserId) }}">{{ $socialmanagement->employeeFirstname }} {{ $socialmanagement->employeeMiddlename}} {{ $socialmanagement->employeeLastname}} (ID:- {{ $socialmanagement->eUserId}}) Date & Time:-  {{ $socialmanagement->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>

@endsection