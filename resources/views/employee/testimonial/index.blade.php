@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <!-- <div class="col-lg-12">
        <h2>Testimonial Details <a href="{{ url('employee/testimonial/create') }}" class="btn btn-primary pull-right btn-sm">Add New Testimonial</a></h2>
    </div> -->
</div>

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
                            <!-- <th>Title</th> -->
                            <th>Author</th>
                            <th>Featured Image</th>
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonial as $item)
                        <tr>
                            <td><a href="{{ url('employee/testimonial', $item->id) }}">{{ $item->id }}</a></td>
                            <!-- <td><a href="{{ url('employee/testimonial', $item->id) }}">{{ $item->title }}</a></td> -->
                            <td><a href="{{ url('employee/testimonial', $item->id) }}">{{ $item->author }}</a></td>
                           
                            <td> 
                                @if( $item->featuredimage )
                                    <img class="img-responsive thumbnail" src="/testimonial/{{ $item->featuredimage }}" width="120" alt="{{ $item->featuredimage }}">
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif 
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('employee/testimonial/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a> <!-- /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['employee/testimonial', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!} -->
                            </td>                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination"> {!! $testimonial->render() !!} </div>
    </div>
</div>
@endsection




