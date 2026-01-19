@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Address Type Details <a href="{{ url('employee/addresstype/create') }}" class="btn btn-primary pull-right btn-sm">Add New Address Type</a></h2>
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
                            <th>ID</th>
                            <th>Type Of Address</th>
                            @if($storeEditUpdateAction == '1')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($addresstype as $item)
                        <tr>
                            <td><a href="{{ url('employee/addresstype', $item->id) }}">{{ $item->id }}</a></td>
                            <td><a href="{{ url('employee/addresstype', $item->id) }}">{{ $item->name }}</a></td>
                            @if($storeEditUpdateAction == '1')
                            <td>
                                <a href="{{ url('employee/addresstype/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a><!--  /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['employee/addresstype', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!} -->
                                {!! Form::close() !!}
                            </td> 
                            @endif                                   
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $addresstype->render() !!} </div>
    </div>
</div>
@endsection

