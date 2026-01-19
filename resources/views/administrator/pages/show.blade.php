@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Page Details <a href="{{ url('administrator/pages/create') }}" class="btn btn-primary pull-right btn-sm">Add New Page</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/pages') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $page->id }}</td> 
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $page->title }} </td>
                        </tr>
                        <tr>
                            <th>Body</th>
                            <td>{!! $page->body !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $page->status == '1')
                                   Published
                                @else
                                    Unpublished
                                @endif    
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($page->eUserId)
                                <a href="{{ url('administrator/users', $page->eUserId) }}">{{ $page->employeeFirstname }} {{ $page->employeeMiddlename}} {{ $page->employeeLastname}} (ID:- {{ $page->eUserId}}) Date & Time:-  {{ $page->updated_at}}</a>
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