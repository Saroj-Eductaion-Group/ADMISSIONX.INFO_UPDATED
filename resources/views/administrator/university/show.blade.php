@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>University Details <a href="{{ url('administrator/university/create') }}" class="btn btn-primary pull-right btn-sm">Add New University</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('administrator/university') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $university->id }}</td>
                        </tr>
                        <tr>
                            <th>University Name</th>
                            <td>{{ $university->name }}</td>
                        </tr>
                        @include('common-partials.common-fileds-details-partial')
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($university->eUserId)
                                <a href="{{ url('administrator/users', $university->eUserId) }}">{{ $university->employeeFirstname }} {{ $university->employeeMiddlename}} {{ $university->employeeLastname}} (ID:- {{ $university->eUserId}}) Date & Time:-  {{ $university->updated_at}}</a>
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