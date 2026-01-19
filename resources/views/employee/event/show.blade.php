@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Event Details <a href="{{ url('employee/event/create') }}" class="btn btn-primary pull-right btn-sm">Add New Event</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/event') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $event->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                @if( $event->eventName)
                                    {{ $event->eventName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>
                                @if( $event->datetime)
                                    {{ $event->datetime }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr> 
                            <th>Venue</th>
                            <td>
                                @if( $event->venue)
                                    {{ $event->venue }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                             <td>
                                @if( $event->description)
                                    {{ $event->description }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Event URL</th>
                             <td>
                                @if( $event->link)
                                    {{ $event->link }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>College Profile</th>
                            <td> @if( $event->collegeprofileID)
                                    <a href="{{ url('employee/collegeprofile') }}/{{ $event->collegeprofileID }}" title="{{ $event->firstname }} {{ $event->lastname }}">{{ $event->firstname }} {{ $event->lastname }} </a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($event->eUserId)
                                <a href="{{ url('employee/users', $event->eUserId) }}">{{ $event->employeeFirstname }} {{ $event->employeeMiddlename}} {{ $event->employeeLastname}} (ID:- {{ $event->eUserId}}) Date & Time:-  {{ $event->updated_at}}</a>
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