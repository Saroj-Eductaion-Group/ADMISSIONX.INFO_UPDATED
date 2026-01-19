@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Placement Details <a href="{{ url('administrator/placement/create') }}" class="btn btn-primary pull-right btn-sm">Add New Placement</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/placement') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $placement->id }}</td> 
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($placement->eUserId)
                                <a href="{{ url('administrator/users', $placement->eUserId) }}">{{ $placement->employeeFirstname }} {{ $placement->employeeMiddlename}} {{ $placement->employeeLastname}} (ID:- {{ $placement->eUserId}}) Date & Time:-  {{ $placement->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Number Of Recruiting Company</th>
                            <td>
                                @if($placement->numberofrecruitingcompany)
                                    {{ $placement->numberofrecruitingcompany }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Number Of Placement Last Year</th>
                            <td>
                                @if($placement->numberofplacementlastyear)
                                    {{ $placement->numberofplacementlastyear }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CTC Highest</th>
                            <td>
                                @if($placement->ctchighest)
                                    {{ $placement->ctchighest }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CTC Lowest</th>
                            <td>
                                @if($placement->ctclowest)
                                    {{ $placement->ctclowest }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                         <tr>
                            <th>CTC Average</th>
                            <td>
                                @if($placement->ctcaverage)
                                    {{ $placement->ctcaverage }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>College Profile</th>
                            
                            <td>
                                 @if($placement->collegeUserID) 
                                <a href="{{ url('administrator/users', $placement->collegeUserID) }}">{{ $placement->collegeUserFirstName }}</a>
                                 @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Placement Info</th>
                            <td>
                                @if($placement->placementinfo)
                                    {{ $placement->placementinfo }}
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