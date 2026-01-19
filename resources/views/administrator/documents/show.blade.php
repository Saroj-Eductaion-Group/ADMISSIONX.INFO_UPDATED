@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Document Details <a href="{{ url('administrator/documents/create') }}" class="btn btn-primary pull-right btn-sm">Add New Document</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('administrator/documents') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                    @foreach( $document as $document)
                        <tr>
                            <th>ID</th>
                            <td>{{ $document->id }}</td> 
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($document->eUserId)
                                <a href="{{ url('administrator/users', $document->eUserId) }}">{{ $document->employeeFirstname }} {{ $document->employeeMiddlename}} {{ $document->employeeLastname}} (ID:- {{ $document->eUserId}}) Date & Time:-  {{ $document->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>College / Student Name</th>
                            <td>@if( $document->userID)
                                    <a href="{{ url('administrator/users') }}/{{ $document->userID }}" title="{{ $document->firstname }} {{ $document->lastname }}">{{ $document->firstname }} {{ $document->lastname }} </a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                @if( $document->documentsName == 'no-image-upload')
                                    <img class="img-responsive thumbnail" src="http://placehold.it/120x120" alt="">
                                    
                                @elseif( $document->width != '0' && $document->height != '0')
                                    @if( $document->documentsName )
                                        {{--*/ $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $document->firstname.' '.$document->users_id); /*--}}
                                        {{--*/ $slugUrl = strtolower($slugUrl); /*--}}
                                        <img class="img-responsive thumbnail" src="/document/{{ $slugUrl }}/{{ $document->documentsName }}" width="120" alt="{{ $document->documentsName }}">
                                    @else
                                        <label> Not Updated Yet</label>
                                    @endif
                                @else 
                                    @if( $document->documentsName )
                                        {{--*/ $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $document->firstname.' '.$document->userID); /*--}}
                                        {{--*/ $slugUrl = strtolower($slugUrl); /*--}}
                                        <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $document->documentsName }}" alt="{{ $document->documentsName }}" download="Document">
                                            <img class="" src="{{asset('assets/images/pdf.png') }}" alt="{{ $document->documentsName }}" width="120"> 
                                        </a>
                                    @else
                                        <label> Not Updated Yet</label>
                                    @endif                                           
                                @endif
                            </td>
                        </tr>
                        
                         <tr>
                            <th>Caption</th>
                            <td>
                                @if( $document->description)
                                    {{ $document->description }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>

@endsection