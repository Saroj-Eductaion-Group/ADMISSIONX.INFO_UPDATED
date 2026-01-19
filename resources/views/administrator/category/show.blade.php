@extends('administrator/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Category Details <a href="{{ url('administrator/category/create') }}" class="btn btn-primary pull-right btn-sm">Add New Category</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/category') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Category Name</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated by</th>
                            <td>
                                @if($category->eUserId)
                                <a href="{{ url('administrator/users', $category->eUserId) }}">{{ $category->employeeFirstname }} {{ $category->employeeMiddlename}} {{ $category->employeeLastname}} (ID:- {{ $category->eUserId}}) Date & Time:-  {{ $category->updated_at}}</a>
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