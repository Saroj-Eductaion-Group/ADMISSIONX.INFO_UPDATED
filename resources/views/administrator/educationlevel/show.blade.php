@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Education Level Details <a href="{{ url('administrator/educationlevel/create') }}" class="btn btn-primary pull-right btn-sm">Add New Education Level</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
              <!--  <a href="{{ url('administrator/educationlevel') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $educationlevel->id }}</td>
                        </tr>
                        <tr>
                            <th>Education Level Name</th>
                            <td>{{ $educationlevel->name }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($educationlevel->eUserId)
                                <a href="{{ url('administrator/users', $educationlevel->eUserId) }}">{{ $educationlevel->employeeFirstname }} {{ $educationlevel->employeeMiddlename}} {{ $educationlevel->employeeLastname}} (ID:- {{ $educationlevel->eUserId}}) Date & Time:-  {{ $educationlevel->updated_at}}</a>
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