@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Testimonial Details <a href="{{ url('administrator/testimonial/create') }}" class="btn btn-primary pull-right btn-sm">Add New Testimonial</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
              <!--  <a href="{{ url('administrator/testimonial') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $testimonial->id }}</td> 
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td> {{ $testimonial->author }} </td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{ $testimonial->title }} </td>
                        </tr>
                        <tr>
                            <th>Featured Image</th>
                            <td> 
                                @if( $testimonial->featuredimage )
                                    <img class="img-responsive thumbnail" src="/testimonial/{{ $testimonial->featuredimage }}" width="120" alt="{{ $testimonial->featuredimage }}">
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif 
                            </td>
                        </tr>
                        <tr>
                            <th>Description Details</th>
                            <td>{{ $testimonial->description }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($testimonial->eUserId)
                                <a href="{{ url('administrator/users', $testimonial->eUserId) }}">{{ $testimonial->employeeFirstname }} {{ $testimonial->employeeMiddlename}} {{ $testimonial->employeeLastname}} (ID:- {{ $testimonial->eUserId}}) Date & Time:-  {{ $testimonial->updated_at}}</a>
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