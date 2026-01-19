@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
               <a href="{{ url('employee/all-india-engineer-association') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $engineeringexam->id }}</td>
                        </tr>
                        <tr>
                            <th>Application ID</th>
                            <td>{{ $engineeringexam->applicationId }}</td>
                        </tr>
                        
                        <tr>
                            <th> Student Name </th>
                            <td> {{ $engineeringexam->title }} {{ $engineeringexam->firstname }} {{ $engineeringexam->middlename }} {{ $engineeringexam->lastname }}</td>
                        </tr>
                        <tr>
                            <th> Father Name </th>
                            <td> {{ $engineeringexam->fathername }} </td>
                        </tr>
                        <tr>
                            <th> Category </th>
                            <td> {{ $engineeringexam->category }} </td>
                        </tr>
                        <tr>
                            <th> Gender </th>
                            <td> {{ $engineeringexam->gender }} </td>
                        </tr>
                        <tr>
                            <th> Email </th>
                            <td> {{ $engineeringexam->email }} </td>
                        </tr>
                        <tr>
                            <th> Phone  </th>
                            <td> {{ $engineeringexam->phone }} </td>
                        </tr>
                        <tr>
                            <th> Nationality  </th>
                            <td> {{ $engineeringexam->nationality }} </td>
                        </tr>
                        <tr>
                            <th> Center Choice First  </th>
                            <td> {{ $engineeringexam->choice1st }} </td>
                        </tr>
                        <tr>
                            <th> Center Choice Second  </th>
                            <td> {{ $engineeringexam->choice2nd }} </td>
                        </tr>
                        <tr>
                            <th> Center Choice Third  </th>
                            <td> {{ $engineeringexam->choice3rd }} </td>
                        </tr>

                        
                        <tr>
                            <th> Place  </th>
                            <td> {{ $engineeringexam->place }} </td>
                        </tr>
                        <tr>
                            <th> Date  </th>
                            <td> {{ $engineeringexam->date }} </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($engineeringexam->eUserId)
                                <a href="{{ url('administrator/users', $engineeringexam->eUserId) }}">{{ $engineeringexam->employeeFirstname }} {{ $engineeringexam->employeeMiddlename}} {{ $engineeringexam->employeeLastname}} (ID:- {{ $engineeringexam->eUserId}})  Date & Time:-  {{ $engineeringexam->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" border="1" cellpadding="1" cellspacing="1">
                    <H2>Qualification Deatils</H2>
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Board</th>
                            <th>Subjects</th>
                            <th>Passing Year</th>
                            <th>CGPA</th>
                            <th>Division</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Matriculation</td>
                            <td>@if( !empty($engineeringexam->board1) ) {{ $engineeringexam->board1 }} @endif</td>
                            <td>@if( !empty($engineeringexam->subject1) ) {{ $engineeringexam->subject1 }} @endif</td>
                            <td>@if( !empty($engineeringexam->passingyr1) ) {{ $engineeringexam->passingyr1 }} @endif</td>
                            <td>@if( !empty($engineeringexam->cgpa1) ) {{ $engineeringexam->cgpa1 }} @endif</td>
                            <td>@if( !empty($engineeringexam->division1) ) {{ $engineeringexam->division1 }} @endif</td>
                        </tr>
                        <tr>
                            <td>Intermediate</td>
                            <td>@if( !empty($engineeringexam->board2) ) {{ $engineeringexam->board2 }} @endif</td>
                            <td>@if( !empty($engineeringexam->subject2) ) {{ $engineeringexam->subject2 }} @endif</td>
                            <td>@if( !empty($engineeringexam->passingyr2) ) {{ $engineeringexam->passingyr2 }} @endif</td>
                            <td>@if( !empty($engineeringexam->cgpa2) ) {{ $engineeringexam->cgpa2 }} @endif</td>
                            <td>@if( !empty($engineeringexam->division2) ) {{ $engineeringexam->division2 }} @endif</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" border="1" cellpadding="1" cellspacing="1">
                    <H2>Address Deatils</H2>
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>Address 1</th>
                            <th>Address 2</th>
                            <th>Address 3</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Pincode</th>
                            <th>Contact No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Correspondence</td>
                            <td>@if( !empty($engineeringexam->firstaddress1) ) {{ $engineeringexam->firstaddress1 }} @endif</td>
                            <td>@if( !empty($engineeringexam->firstaddress2) ) {{ $engineeringexam->firstaddress2 }} @endif</td>
                            <td>@if( !empty($engineeringexam->firstaddress3) ) {{ $engineeringexam->firstaddress3 }} @endif</td>
                            <td>@if( !empty($engineeringexam->firstcity) ) {{ $engineeringexam->firstcity }} @endif</td>
                            <td>@if( !empty($engineeringexam->firststate) ) {{ $engineeringexam->firststate }} @endif</td>
                            <td>@if( !empty($engineeringexam->firstpincode) ) {{ $engineeringexam->firstpincode }} @endif</td>
                            <td>@if( !empty($engineeringexam->firstcontact) ) {{ $engineeringexam->firstcontact }} @endif</td>
                        </tr>
                        <tr>
                            <td>Permanent</td>
                            <td>@if( !empty($engineeringexam->secondaddress1) ) {{ $engineeringexam->secondaddress1 }} @endif</td>
                            <td>@if( !empty($engineeringexam->secondaddress2) ) {{ $engineeringexam->secondaddress2 }} @endif</td>
                            <td>@if( !empty($engineeringexam->secondaddress3) ) {{ $engineeringexam->secondaddress3 }} @endif</td>
                            <td>@if( !empty($engineeringexam->secondcity) ) {{ $engineeringexam->secondcity }} @endif</td>
                            <td>@if( !empty($engineeringexam->secondstate) ) {{ $engineeringexam->secondstate }} @endif</td>
                            <td>@if( !empty($engineeringexam->secondpincode) ) {{ $engineeringexam->secondpincode }} @endif</td>
                            <td>@if( !empty($engineeringexam->secondcontact) ) {{ $engineeringexam->secondcontact }} @endif</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" border="1" cellpadding="1" cellspacing="1">
                    <H2>Transaction Deatils</H2>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Name</th>
                            <th>Student Name</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Transcation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>@if( !empty($engineeringexam->examtransactionId) ) {{ $engineeringexam->examtransactionId }} @endif</td>
                            <td>@if( !empty($engineeringexam->examtransactionname) ) {{ $engineeringexam->examtransactionname }} @endif</td>
                            <td>@if( !empty($engineeringexam->studentname) ) {{ $engineeringexam->studentname }} @endif</td>
                            <td>@if( !empty($engineeringexam->amount) ) {{ $engineeringexam->amount }} @endif</td>
                            <td>@if( !empty($engineeringexam->paymentstatusName) ) {{ $engineeringexam->paymentstatusName }} @endif</td>
                            <td>@if( !empty($engineeringexam->transactiondate) ) {{ $engineeringexam->transactiondate }} @endif</td>
                        </tr>
                    </tbody>
                </table>
                

            </div>
        </div>
    </div>
</div>

@endsection