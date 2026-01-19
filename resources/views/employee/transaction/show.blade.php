@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Transaction Details <a href="{{ url('employee/transaction/create') }}" class="btn btn-primary pull-right btn-sm">Add New Transaction</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url('employee/transaction') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $transaction->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $transaction->name }} </td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>{{ $transaction->paymentstatusName }} </td>
                        </tr>
                        <tr>
                            <th>Transaction Date</th>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Total Fee</th>
                            <td>{{ $transaction->totalfees }}</td>
                        </tr>
                        <tr>
                            <th>Paid Amount</th>
                            <td>{{ $transaction->byafees }}</td>
                        </tr>
                        <tr>
                            <th>Rest Amount</th>
                            <td>{{ $transaction->restfees }}</td>
                        </tr>
                       
                        <tr>
                            <th>Card Type</th>
                            <td>
                                @if($transaction->cardtypeName)
                                    {{ $transaction->cardtypeName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Application</th>
                            <td><a href="{{ url('employee/application', $transaction->applicationID) }}">{{ $transaction->applicationIDs }}</a></td>
                        </tr> 
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($transaction->eUserId)
                                <a href="{{ url('employee/users', $transaction->eUserId) }}">{{ $transaction->employeeFirstname }} {{ $transaction->employeeMiddlename}} {{ $transaction->employeeLastname}} (ID:- {{ $transaction->eUserId}}) Date & Time:-  {{ $transaction->updated_at}}</a>
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