@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Career Details <a href="{{ url('administrator/career/create') }}" class="btn btn-primary pull-right btn-sm">Add New Career</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/career') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        @if( $careerDataObj )
                            @foreach( $careerDataObj as $item )
                            <tr>
                                <th>Id</th>
                                <td>
                                    @if( $item['careersId'] )
                                        {{ $item['careersId'] }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>
                                    @if( $item['firstname'] )
                                        {{ $item['firstname'] }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td>
                                    @if( $item['email'] )
                                        {{ $item['email'] }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>
                                    @if( $item['phonenumber'] )
                                        {{ $item['phonenumber'] }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    @if( $item['gender'] )
                                        {{ $item['gender'] }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Date Of Birth</th>
                                <td>
                                    @if( $item['dateOfBirth'] != '0000-00-00' )
                                        {{ $item['dateOfBirth'] }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Post For Apply</th>
                                <td>
                                    @if( $item['postappliedfor'] )
                                        {{ $item['postappliedfor'] }}
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Resume</th>
                                <td>
                                    @if( $item['cv'] )
                                        <div class="thumbnail-img">
                                            <div class="overflow-hidden">
                                                @if( $item['ext'] == 'pdf' )
                                                    <a href="{{asset('resume/')}}/{{ $item['cv'] }}" target="_blank" title="Click to view">
                                                        <img class="" src="{{asset('assets/images/pdf.png') }}" alt="{{ $item['cv'] }}" width="120" height="120">    
                                                    </a>
                                                @elseif($item['ext'] == 'doc')
                                                    <a href="{{asset('resume/')}}/{{ $item['cv'] }}" target="_blank" title="Click to view">
                                                        <img class="" src="{{asset('assets/images/doc.png') }}" alt="{{ $item['cv'] }}" width="120" height="120">    
                                                    </a>
                                                @elseif($item['ext'] == 'docx')
                                                    <a href="{{asset('resume/')}}/{{ $item['cv'] }}" target="_blank" title="Click to view">
                                                        <img class="" src="{{asset('assets/images/doc.png') }}" alt="{{ $item['cv'] }}" width="120" height="120">    
                                                    </a>
                                                @else
                                                    <a href="{{asset('resume/')}}/{{ $item['cv'] }}" alt="{{ $item['cv'] }}" class="fancybox" title="{{ $item['cv'] }}">
                                                        <img class="" src="{{asset('resume/')}}/{{ $item['cv'] }}" alt="{{ $item['cv'] }}" width="120" height="120">
                                                    </a>                                        
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Last Updated By</th>
                                <td>
                                    @if($item['eUserId'])
                                    <a href="{{ url('administrator/users', $item['eUserId']) }}">{{ $item['employeeFirstname'] }} {{ $item['employeeMiddlename']}} {{ $item['employeeLastname']}} (ID:- {{ $item['eUserId']}}) Date & Time:- {{ $item['updated_at'] }}</a>
                                    @else
                                        <span class="label label-warning">Not Updated Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>Address</th>
                                <td>
                                    @if( $item['address'] )
                                        {{ $item['address'] }}
                                    @else
                                        Not Updated Yet
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>
                                    @if( $item['cityName'] )
                                        {{ $item['cityName'] }}
                                    @else
                                        Not Updated Yet
                                    @endif
                                </td>
                            </tr>
                             <tr>
                                <th>State</th>
                                <td>
                                    @if( $item['stateName'] )
                                        {{ $item['stateName'] }}
                                    @else
                                        Not Updated Yet
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>
                                    @if( $item['countryName'] )
                                        {{ $item['countryName'] }}
                                    @else
                                        Not Updated Yet
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Pincode</th>
                                <td>
                                    @if( $item['pincode'] )
                                        {{ $item['pincode'] }}
                                    @else
                                        Not Updated Yet
                                    @endif
                                </td>
                            </tr> -->
                            @endforeach     
                        @endif
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>

@endsection