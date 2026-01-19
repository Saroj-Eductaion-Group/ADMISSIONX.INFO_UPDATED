@extends('administrator/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Category Details <a href="{{ url('administrator/category/create') }}" class="btn btn-primary pull-right btn-sm">Add New Category</a></h2>
    </div>
</div>
 -->
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $item)
                        <tr>
                            <td><a href="{{ url('administrator/category', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url('administrator/category', $item->id) }}">{{ $item->name }}</a></td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}})  <hr> Date & Time:-  {{ $item->updated_at}} </a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('administrator/category/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a> <!-- /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['administrator/category', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!} -->
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach    
                    </tbody>
                </table>
                <div class="pagination"> {!! $category->render() !!} </div>
            </div>
        </div>
    </div>
</div>
@endsection
