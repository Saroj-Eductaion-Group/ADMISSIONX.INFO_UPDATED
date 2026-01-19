@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Bookmark Details <a href="{{ url('employee/bookmarks/create') }}" class="btn btn-primary pull-right btn-sm">Add New Bookmark</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/bookmarks') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $bookmark->id }}</td> 
                        </tr>
                         <tr>
                            <th>Student Profile</th>
                            <td>
                                @if( $bookmark->u1firstname)
                                   <a href="{{ url('employee/studentprofile') }}/{{ $bookmark->studentprofileId }}" title="{{ $bookmark->u1firstname }} {{ $bookmark->u1lastname }}"> {{ $bookmark->u1firstname }} {{ $bookmark->u1lastname }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>College Profile</th>
                            <td>
                                @if( $bookmark->u2firstname)
                                    <a href="{{ url('employee/collegeprofile') }}/{{ $bookmark->collegeprofileId }}" title="{{ $bookmark->u2firstname }} {{ $bookmark->u2lastname }}">{{ $bookmark->u2firstname }} {{ $bookmark->u2lastname }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Courses</th>
                            <td> 
                                @if( $bookmark->courseName)
                                    <a href="{{ url('employee/collegemaster') }}/{{ $bookmark->collegemasterID }}" title="{{ $bookmark->courseName }}">{{ $bookmark->courseName }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Blogs</th>
                            <td> 
                                @if( $bookmark->topic)
                                    <a href="{{ url('employee/blogs') }}/{{ $bookmark->blogsID }}" title="{{ $bookmark->topic }}">{{ $bookmark->topic }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($bookmark->eUserId)
                                <a href="{{ url('employee/users', $bookmark->eUserId) }}">{{ $bookmark->employeeFirstname }} {{ $bookmark->employeeMiddlename}} {{ $bookmark->employeeLastname}} (ID:- {{ $bookmark->eUserId}}) Date & Time:-  {{ $bookmark->updated_at}}</a>
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