@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Youtube Link<a href="{{ url('employee/galleries') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Youtube Link Details</h5>                            
            </div>

            <div class="ibox-content">
                <table class="table table-bordered">
                    <thead>
                        <th>ID</th>
                        <th>Youtube Url</th>
                        <th>Last Updated By</th>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach( $oldYoutubeLink1 as $item )
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }} (Student Section Video)</td>  
                                <td>
                                    @if($item->eUserId)
                                    <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}})  Date & Time:-  {{ $item->updated_at}}</a>
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            @endforeach    
                        </tr>
                        <tr>
                            @foreach( $oldYoutubeLink2 as $item )
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }} (College Section Video)</td> 
                                <td>
                                    @if($item->eUserId)
                                    <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}})  Date & Time:-  {{ $item->updated_at}}</a>
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>                              
                            @endforeach    
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update youtube link</h5>                            
            </div>

            <div class="ibox-content">
            {!! Form::open(['url' => 'employee/youtube-create', 'class' => 'form-horizontal','data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @if(Session::has('successUpdateYoutube'))
                        <div class="alert alert-success alert-dismissable text-center">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ Session::get('successUpdateYoutube') }}                        
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Youtube Section Name : </label>
                <div class="col-sm-10">
                    <select name="youtubesection" class="form-control chosen-select " data-parsley-error-message=" Please select section name" data-parsley-trigger="change"  required="">
                        <option value="" selected disabled>Select Section Name</option>  
                        <option value="collegeyoutubeurl">College Youtube URL</option>
                        <option value="studentyoutubeurl">Student Youtube URL</option>
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Youtube Link : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="youtubeurl" placeholder="Enter youtube url here" data-parsley-trigger="change" data-parsley-error-message="Please enter youtube url" required="" >
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@endsection

