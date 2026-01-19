
@extends('administrator/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Address Details <a href="{{ url('administrator/address/create') }}" class="btn btn-primary pull-right btn-sm">Add New Address</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/address') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $address->id }}</td> 
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($address->eUserId)
                                <a href="{{ url('administrator/users', $address->eUserId) }}">{{ $address->employeeFirstname }} {{ $address->employeeMiddlename}} {{ $address->employeeLastname}} (ID:- {{ $address->eUserId}}) Date & Time:-  {{ $address->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                @if( $address->name )
                                   {{ $address->name }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Address 1</th>
                            <td>
                                @if( $address->address1 )
                                   {{ $address->address1 }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Address 2</th>
                            <td>
                                @if( $address->address2 )
                                   {{ $address->address2 }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Landmark</th>
                            <td>
                                @if( $address->landmark )
                                   {{ $address->landmark }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr> 
                            <th>Postal Code</th>
                            <td>
                                @if( $address->postalcode )
                                   {{ $address->postalcode }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Address Type</th>
                            <td>
                                @if( $address->addressType )
                                   {{ $address->addressType }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>
                                @if( $address->cityName )
                                   {{ $address->cityName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                         <tr>
                            <th>State</th>
                            <td>
                                @if( $address->stateName )
                                   {{ $address->stateName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                         <tr>
                            <th>Country</th>
                            <td>
                                @if( $address->countryName )
                                   {{ $address->countryName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Student Profile</th>
                            <td>
                                @if( $address->studentUserID )
                                   <a href="{{ url('administrator/users', $address->studentUserID) }}">{{ $address->studentUserFirstName }} {{ $address->studentUserLastName }}</a>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>College Profile</th>
                             <td>
                                @if( $address->collegeUserID )
                                   <a href="{{ url('administrator/users', $address->collegeUserID) }}">{{ $address->collegeUserFirstName }}</a>
                                @else
                                    --
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