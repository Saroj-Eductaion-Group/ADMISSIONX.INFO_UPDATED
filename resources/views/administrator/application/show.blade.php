@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <!--  <div class="col-lg-12">
        <h2>Application Details <a href="{{ url('administrator/application/create') }}" class="btn btn-primary pull-right btn-sm">Add New Application</a></h2>
    </div>
 --></div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/application') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <div class="row">
                    <div class="col-md-7 col-md-offset-3">
                        @if(Session::has('sendProvisionalLetterMsg'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('sendProvisionalLetterMsg') }}</strong>
                            </div>                        
                        @endif
                    </div>    
                </div>
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $application->id }}</td> 
                        </tr>
                        <tr>
                            <th>Application Date</th>
                            <td>
                                @if($application->created_at)
                                    {{ date('d F Y h:i a', strtotime($application->created_at)) }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($application->eUserId)
                                <a href="{{ url('administrator/users', $application->eUserId) }}">{{ $application->employeeFirstname }} {{ $application->employeeMiddlename}} {{ $application->employeeLastname}} (ID:- {{ $application->eUserId}}) Date & Time:-  {{ $application->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Application ID</th>
                            <td>{{ $application->applicationID }}</td> 
                        </tr>
                        <tr>
                            <th>College Name</th>
                            <td>
                                @if( $application->collegeprofileID )
                                   <a href="{{ url('administrator/collegeprofile', $application->collegeprofileID) }}">{{ $application->collegeUserFirstName }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Student Name</th>
                            <td>
                                @if( $application->applicationFirstName )
                                   {{ $application->applicationFirstName }} {{ $application->applicationMiddleName }} {{ $application->applicationLastname }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td>
                                @if( $application->collegemasterId )
                                   {{ $application->functionalareaName }} / {{ $application->degreeName }} / {{ $application->courseName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Application Status</th>
                            <td>
                                @if( $application->applicationstatusId =='1' )
                                    <button class="btn btn-w-m btn-primary">{{ $application->applicationstatusName }}</button>
                                @elseif( $application->applicationstatusId =='2' )
                                    <button class="btn btn-w-m btn-warning">{{ $application->applicationstatusName }}</button>
                                @elseif( $application->applicationstatusId =='3' )
                                    <button class="btn btn-w-m btn-info">{{ $application->applicationstatusName }}</button>
                                @else
                                    <button class="btn btn-w-m btn-danger">{{ $application->applicationstatusName }}</button>
                                @endif

                                @if( $application->applicationstatusId =='1' )
                                    <a href="{{ url('/administrator/provisional-letter/' . $application->id) }}">
                                        <button type="submit" class="btn btn-info pull-right btn-w-m"><i class="fa fa-arrow-right"></i> GENERATE PROVISIONAL LETTER</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                                                
                        <tr>
                            <th>D.O.B</th>
                            <td>
                                @if( $application->dob )
                                   {{ date('d/m/Y ', strtotime($application->dob)) }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                @if( $application->email )
                                   {{ $application->email }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                @if( $application->phone )
                                   {{ $application->phone }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>
                                @if( $application->gender )
                                   {{ $application->gender }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>  
                        <tr>
                            <th>10th Class Percent</th>
                            <td>
                                @if( $application->percent10 )
                                   {{ $application->percent10 }} %
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                         @if( !empty($application->marksheet10) )
                            {{--*/ $marksheet10 = $application->marksheet10;  /*--}}
                            {{--*/ 
                                $explodeFolderName = explode('-', $marksheet10);
                            /*--}}
                            {{--*/ $URLFormation = $explodeFolderName[0].'-'.$explodeFolderName[1]; /*--}}
                        @endif

                        <tr>
                            <th>10th Class Marksheet</th>
                            <td>
                                @if($application->marksheet10 != '') 
                                    <a href="/application/{{$URLFormation}}/{{ $marksheet10 }}" title="Click to view" target="_blank">Click to view</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>11th Class Percent</th>
                            <td>
                                @if( $application->percent11 )
                                   {{ $application->percent11 }} %
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        @if( !empty($application->marksheet11) )
                            {{--*/ $marksheet11 = $application->marksheet11;  /*--}}
                            {{--*/ 
                                $explodeFolderName = explode('-', $marksheet11);
                            /*--}}
                            {{--*/ $URLFormation = $explodeFolderName[0].'-'.$explodeFolderName[1]; /*--}}
                        @endif
                        <tr>
                            <th>11th Class Marksheet</th>
                            <td>
                                @if($application->marksheet11 != '') 
                                    <a href="/application/{{$URLFormation}}/{{ $marksheet11 }}" title="Click to view" target="_blank">Click to view</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>12th Class Percent</th>
                            <td>
                                @if( $application->percent12 )
                                   {{ $application->percent12 }} %
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 

                        @if( !empty($application->marksheet12) )
                            {{--*/ $marksheet12 = $application->marksheet12;  /*--}}
                            {{--*/ 
                                $explodeFolderName = explode('-', $marksheet12);
                            /*--}}
                            {{--*/ $URLFormation = $explodeFolderName[0].'-'.$explodeFolderName[1]; /*--}}
                        @endif 
                        <tr>
                            <th>12th Class Marksheet</th>
                            <td>
                                @if($application->marksheet12 != '') 
                                    <a href="/application/{{$URLFormation}}/{{ $marksheet12 }}" title="Click to view" target="_blank">Click to view</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Graduation Percent</th>
                            <td>
                                @if( $application->graduationPercent )
                                   {{ $application->graduationPercent }} %
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 

                        @if( !empty($application->graduationMarksheet) )
                            {{--*/ $graduationMarksheet = $application->graduationMarksheet;  /*--}}
                            {{--*/ 
                                $explodeFolderName = explode('-', $graduationMarksheet);
                            /*--}}
                            {{--*/ $URLFormation = $explodeFolderName[0].'-'.$explodeFolderName[1]; /*--}}
                        @endif 
                        <tr>
                            <th>Graduation Marksheet</th>
                            <td>
                                @if($application->graduationMarksheet != '') 
                                    <a href="/application/{{$URLFormation}}/{{ $graduationMarksheet }}" title="Click to view" target="_blank">Click to view</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Parent Name</th>
                            <td>
                                @if( $application->parentname )
                                   {{ $application->parentname }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Parent Number</th>
                            <td>
                                @if( $application->parentnumber )
                                   {{ $application->parentnumber }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        @if( !empty($application->parentidproof) )
                            {{--*/ $parentidproof = $application->parentidproof;  /*--}}
                            {{--*/ 
                                $explodeFolderName = explode('-', $parentidproof);
                            /*--}}
                            {{--*/ $URLFormation = $explodeFolderName[0].'-'.$explodeFolderName[1]; /*--}}
                        @endif
                        <tr>
                            <th>Parent Id Proof</th>
                            <td>
                                @if($application->parentidproof != '') 
                                    <a href="/application/{{$URLFormation}}/{{ $parentidproof }}" title="Click to view" target="_blank">Click to view</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>  
                        <tr>
                            <th>Interest</th>
                            <td>
                                @if( $application->interest )
                                   {{ $application->interest }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Awards</th>
                            <td>
                                @if( $application->awards )
                                   {{ $application->awards }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Projects</th>
                            <td>
                                @if( $application->projects )
                                   {{ $application->projects }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>I Agree Parents</th>
                            <td>
                                @if( $application->iagreeparents == '1' )
                                   Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>I Agree Form</th>
                            <td>
                                @if( $application->iagreeform == '1' )
                                   Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Fees</th>
                            <td>
                                @if( $application->totalfees )
                                 Rs. {{ $application->totalfees }}/-
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Admission X Fees</th>
                            <td>
                                @if( $application->byafees )
                                 Rs. {{ $application->byafees }}/-
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Rest Fees</th>
                            <td>
                                @if( $application->restfees )
                                  Rs. {{ $application->restfees }}/-
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Last Payment Attempt Date</th>
                            <td>
                                @if( $application->lastPaymentAttemptDate )
                                 {{ $application->lastPaymentAttemptDate }}
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