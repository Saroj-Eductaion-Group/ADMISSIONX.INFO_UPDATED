
@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Course Details <a href="{{ url('administrator/collegemaster/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Course</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/collegemaster') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $collegemaster->id }}</td> 
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($collegemaster->eUserId)
                                <a href="{{ url('administrator/users', $collegemaster->eUserId) }}">{{ $collegemaster->employeeFirstname }} {{ $collegemaster->employeeMiddlename}} {{ $collegemaster->employeeLastname}} (ID:- {{ $collegemaster->eUserId}}) Date & Time:-  {{ $collegemaster->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td> @if( $collegemaster->userID)
                                    <a href="{{ url('administrator/users') }}/{{ $collegemaster->userID }}" title="{{ $collegemaster->firstname }} {{ $collegemaster->lastname }}">{{ $collegemaster->firstname }} {{ $collegemaster->lastname }} </a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>12th Marks </th>
                            <td>
                                @if( $collegemaster->twelvemarks)
                                   {{ $collegemaster->twelvemarks }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Others</th>
                            <td>
                                @if( $collegemaster->others)
                                   {{ $collegemaster->others }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Fees (per year in inr)</th>
                            <td>
                                @if( $collegemaster->fees)
                                   {{ $collegemaster->fees }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Seats </th>
                            <td>
                                @if( $collegemaster->seats)
                                   {{ $collegemaster->seats }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>                            
                        
                        <tr>
                            <th>Seats Allocated To Admission X </th>
                            <td>
                                @if( $collegemaster->seatsallocatedtobya)
                                   {{ $collegemaster->seatsallocatedtobya }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>           
                            
                            
                        
                        <tr>
                            <th>Course Duration</th>
                            <td> @if( $collegemaster->courseduration)
                                    @if(is_numeric($collegemaster->courseduration))
                                        @if( $collegemaster->courseduration == '1' )
                                            {{ $collegemaster->courseduration }} Year
                                        @else
                                            {{ $collegemaster->courseduration }} Years
                                        @endif
                                    @else
                                        {{ $collegemaster->courseduration }}
                                    @endif
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                               
                                <!-- @if( $collegemaster->courseduration == '1')
                                    {{ $collegemaster->courseduration }} Year
                                @elseif( $collegemaster->courseduration)
                                    {{ $collegemaster->courseduration }} Years
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif -->
                            </td>
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td>
                                @if( $collegemaster->functionalAreaName)
                                    <a href="{{ url('administrator/functionalarea') }}/{{ $collegemaster->functionalareaID }}" title="{{ $collegemaster->firstname }} {{ $collegemaster->lastname }}">{{ $collegemaster->functionalAreaName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Degree Level</th>
                            <td>
                                @if( $collegemaster->educationlevelName)
                                    <a href="{{ url('administrator/educationlevel') }}/{{ $collegemaster->educationlevelId }}" title="{{ $collegemaster->firstname }} {{ $collegemaster->lastname }}">{{ $collegemaster->educationlevelName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            
                        </tr>
                        <tr>
                            <th>Degree</th>
                            <td>
                                @if( $collegemaster->degreeName)
                                    <a href="{{ url('administrator/degree') }}/{{ $collegemaster->degreeId }}" title="{{ $collegemaster->firstname }} {{ $collegemaster->lastname }}">{{ $collegemaster->degreeName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td>
                                @if( $collegemaster->courseName)
                                   <a href="{{ url('administrator/course') }}/{{ $collegemaster->courseID }}" title="{{ $collegemaster->courseName }} {{ $collegemaster->lastname }}"> {{ $collegemaster->courseName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course Type</th>
                            <td>
                                @if( $collegemaster->coursetypeName)
                                    <a href="{{ url('administrator/coursetype') }}/{{ $collegemaster->coursetypeId }}" title="{{ $collegemaster->firstname }} {{ $collegemaster->lastname }}">{{ $collegemaster->coursetypeName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            
                        </tr>  
                        <tr>
                            <th>Course Description </th>
                            <td>
                                @if( $collegemaster->courseDescription)
                                   {{ $collegemaster->courseDescription }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>         

                    </tbody>                        
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Faculty Name</th>
                            <th>Educational Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $getFacultyInfo as $item )
                            <tr>
                                <th>
                                    <a href="{{ URL('administrator/faculty/'.$item->id.'/edit') }}">
                                        @if( $item->name )
                                            {{ $item->name }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    @if( $item->description )
                                        {{ $item->description }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection