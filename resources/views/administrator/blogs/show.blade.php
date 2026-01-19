@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Blog Details <a href="{{ url('administrator/blogs/create') }}" class="btn btn-primary pull-right btn-sm">Add New Blog</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/blogs') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $blog->id }}</td> 
                        </tr>
                        <tr>
                            <th>Topic</th>
                            <td>{{ $blog->topic }} </td>
                        </tr>
                        <tr>
                            <th>Blog Featured Image</th>
                            <td> @if( $blog->featimage )
                                {{--*/ $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $blog->firstname.' '.$blog->users_id); /*--}}
                                {{--*/ $slugUrl = strtolower($slugUrl); /*--}}
                                <img class="img-responsive thumbnail" src="/blogs/{{ $blog->featimage }}" width="120" alt="{{ $blog->featimage }}">
                                @else
                                    <img class="img-responsive thumbnail" src="{{ asset('blogs/default.jpg') }}" width="120" alt="">
                                @endif 
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $blog->description !!}</td>
                        </tr>
                        <tr>
                            <th>Publish or Not</th>
                            <td>
                                @if( $blog->isactive == '1' )
                                    <span class="label label-success">Published</span>
                                @else
                                    <span class="label label-danger">Not Published</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Author Name</th>
                            <td><a href="{{ url('administrator/users' , $blog->userID) }}">{{ $blog->firstname }} {{ $blog->lastname }}</a></td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($blog->eUserId)
                                <a href="{{ url('administrator/users', $blog->eUserId) }}">{{ $blog->employeeFirstname }} {{ $blog->employeeMiddlename}} {{ $blog->employeeLastname}} (ID:- {{ $blog->eUserId}}) Date & Time:-  {{ $blog->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        
                    </tbody>                        
                </table>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>
@endsection