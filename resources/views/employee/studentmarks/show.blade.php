@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Student Marks Details <a href="{{ url('employee/studentmarks/create') }}" class="btn btn-primary pull-right btn-sm">Add New Student Marks</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/studentmarks') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $studentmark->id }}</td> 
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                @if($studentmark->studentmarksName)
                                    {{ $studentmark->studentmarksName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Marks</th>
                            <td> @if($studentmark->marks)
                                    {{ $studentmark->marks }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Marks Type</th>
                            <td>
                                @if($studentmark->studentMarkType)
                                    {{ $studentmark->studentMarkType }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Percentage</th>
                            <td>@if($studentmark->percentage)
                                    {{ $studentmark->percentage }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td> @if($studentmark->categoryName)
                                    {{ $studentmark->categoryName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Student Profile</th>
                            <td>
                                @if( $studentmark->userID)
                                    <a href="{{ url('employee/users') }}/{{ $studentmark->userID }}" title="{{ $studentmark->firstname }} {{ $studentmark->lastname }}">{{ $studentmark->firstname }} {{ $studentmark->lastname }} </a> | <a href="{{ url('employee/studentprofile') }}/{{ $studentmark->studentprofileId }}" title="{{ $studentmark->gender }}"> {{ $studentmark->gender }} </a>
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