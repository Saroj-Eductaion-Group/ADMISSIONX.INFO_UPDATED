@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Alltableinformation Details <a href="{{ url('employee/alltableinformation/create') }}" class="btn btn-primary pull-right btn-sm">Add New Alltableinformation</a></h2>
    </div>
</div>
 -->
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
                            <th>Description</th>
                            @if($storeEditUpdateAction == '1')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alltableinformation as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{ url('employee/alltableinformation', $item->id) }}">{{ $item->name }}</a></td>
                            <td>
                                @if( $item->description )
                                    {{ $item->description }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            @if($storeEditUpdateAction == '1')
                            <td>
                                <a href="{{ url('employee/alltableinformation/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a><!--  /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['employee/alltableinformation', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!} -->
                            </td>   
                        @endif       
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $alltableinformation->render() !!} </div>
    </div>
</div>
@endsection
