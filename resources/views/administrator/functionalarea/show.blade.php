@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Stream Details <a href="{{ url('administrator/functionalarea/create') }}" class="btn btn-primary pull-right btn-sm">Add New Stream</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <!-- <a href="{{ url('administrator/functionalarea') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $functionalarea->id }}</td>
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>{{ $functionalarea->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($functionalarea->eUserId)
                                <a href="{{ url('administrator/users', $functionalarea->eUserId) }}">{{ $functionalarea->employeeFirstname }} {{ $functionalarea->employeeMiddlename}} {{ $functionalarea->employeeLastname}} (ID:- {{ $functionalarea->eUserId}}) Date & Time:-  {{ $functionalarea->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        @include('common-partials.common-fileds-details-partial')
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