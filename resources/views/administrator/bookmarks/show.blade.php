@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <!-- <h2>Bookmark Details <a href="{{ url('administrator/bookmarks/create') }}" class="btn btn-primary pull-right btn-sm">Add New Bookmark</a></h2> -->
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/bookmarks') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $bookmark->id }}</td> 
                        </tr>
                        <tr>
                            <th>Student Name</th>
                            <td>
                                @if( $bookmark->u1firstname)
                                   <a href="{{ url('administrator/studentprofile') }}/{{ $bookmark->studentprofileId }}" title="{{ $bookmark->u1firstname }} {{ $bookmark->u1lastname }}"> {{ $bookmark->u1firstname }} {{ $bookmark->u1lastname }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>College Name</th>
                            <td>
                                @if( $bookmark->u2firstname)
                                    <a href="{{ url('administrator/collegeprofile') }}/{{ $bookmark->collegeprofileId }}" title="{{ $bookmark->u2firstname }} {{ $bookmark->u2lastname }}">{{ $bookmark->u2firstname }} {{ $bookmark->u2lastname }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td> 
                                @if( $bookmark->courseName)
                                    <a href="{{ url('administrator/collegemaster') }}/{{ $bookmark->collegemasterID }}" title="{{ $bookmark->courseName }}">{{ $bookmark->courseName }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Blog</th>
                            <td> 
                                @if( $bookmark->topic)
                                    <a href="{{ url('administrator/blogs') }}/{{ $bookmark->blogsID }}" title="{{ $bookmark->topic }}">{{ $bookmark->topic }} </a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($bookmark->eUserId)
                                <a href="{{ url('administrator/users', $bookmark->eUserId) }}">{{ $bookmark->employeeFirstname }} {{ $bookmark->employeeMiddlename}} {{ $bookmark->employeeLastname}} (ID:- {{ $bookmark->eUserId}}) Date & Time:-  {{ $bookmark->updated_at}} </a></a>
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