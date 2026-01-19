@extends('administrator/admin-layouts.master')

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Event Details <a href="{{ url('administrator/event/create') }}" class="btn btn-primary pull-right btn-sm">Add New Event</a></h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Here are the details</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        
                        <div class="col-md-12 text-right">   
                            <!-- <a href="javascript:void(0);" class="btn btn-info exportToExcel hide">Export</a>   -->   
                            <a href="javascript:void(0);" class="btn btn-danger resetfilter hide">Reset Filter</a>     
                            <a href="javascript:void(0);" class="btn btn-primary filterout">Filter</a>
                        </div>
                    </div>
                    <div class="slideDown" style="visibility:hidden">
                         <div class="hr-line-dashed"></div>    
                        {!! Form::open(['url' => 'search/college-event', 'class' => 'form-horizontal search-form search-form']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeName" name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                                <option value="" disabled="" selected="">Select college</option>
                                                @foreach( $collegeProfileObj as $college )
                                                    <option value="{{ $college->firstname }}">{{ $college->firstname }}</option>
                                                @endforeach
                                            </select> 
                                        </div>   
                                        <div class="col-md-3">
                                            <h4>Event Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control eventName" name="eventName" placeholder="Enter user event name here" data-parsley-error-message="Please enter valid event name" data-parsley-trigger="change">        
                                        </div>
                                        <div class="col-md-6">                                    
                                            <h4 for="usr">Event From &amp; To <span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <div class="form-group" id="data_5">
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" id="txtFromEventDate" class="form-control eventDateStart" name="eventDateStart" value="" placeholder="Event Form">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" id="txtToEventDate" class="form-control eventDateEnd" name="eventDateEnd" value="" placeholder="Event To">
                                                </div>
                                            </div>                                   
                                        </div>     
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">  
                                        <div class="col-md-12 text-right">      
                                            <a href="{{ URL::to('administrator/event') }}" class="btn btn-default btn-sm">Close</a>
                                            <button class="btn btn-primary btn-sm">Search</button>                                        
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class=""> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $event == '0' )
                            <input type="text" class="result-zero hide" value="{{ $event }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Name </th>
                                    <th>Date</th>
                                    <th>Venue</th>
                                    <!-- <th>Link</th> -->
                                    <th>College Profile</th>
                                    <th>Last Updated By</th>
                                    <th>Actions</th>                        
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($event as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('administrator/event', $item->id) }}">{{ $item->id }}</a></td>
                                    <td>
                                        @if( $item->eventName)
                                           <a href="{{ url('administrator/event', $item->id) }}">{{ $item->eventName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                     <td>
                                        @if( $item->datetime)
                                            {{ date('d/m/Y', strtotime($item->datetime)) }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                     <td>
                                        @if( $item->venue)
                                            {{ $item->venue }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <!--  <td>
                                        @if( $item->link)
                                            {{ $item->link }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td> -->
                                    <td> @if( $item->collegeprofileID)
                                            <a href="{{ url('administrator/collegeprofile') }}/{{ $item->collegeprofileID }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->firstname }} {{ $item->lastname }} </a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/event/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['administrator/event', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td> 
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $event->render() !!}</div>
                            </div>
                        </div>
                        @endif

                        <input type="text" class="totalReturnRow hide" value="">
                        <input type="text" class="prevTotalReturnRow hide" value="">
                        <input type="text" class="nextTotalReturnRow hide" value="">

                        <div class="spiner-example hide text-center">
                            <div class="sk-spinner sk-spinner-three-bounce">
                                <div class="sk-bounce1"></div>
                                <div class="sk-bounce2"></div>
                                <div class="sk-bounce3"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <p class="message-no-match center-block label label-danger hide">No Match Found!</p>
                            </div>
                        </div>
                    <!-- <div class="row filterPagination hide">
                        <div class="col-md-offset-9 col-md-3">
                            <nav class="pull-right">
                                <ul class="pager">
                                    <li><a href="javascript:void(0);" class="prevFilter">Previous</a></li>
                                    <li><a href="javascript:void(0);" class="nextFilter">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div> --> 
                    <div class="row numPage hide text-right">
                        <div class="col-md-12 pull-right">
                            <ul class="pagination"><li><span class="currentCounter"></span></li></ul>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{!! Html::script('assets/administrator/js/moment.js') !!}
{!! Html::script('assets/js/plugins/datepicker.js') !!}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   
    $("#txtFromEventDate").datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onSelect: function(selected) {
          $("#txtToEventDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToEventDate").datepicker({ 
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onSelect: function(selected) {
           $("#txtFromEventDate").datepicker("option","maxDate", selected)
        }
    }); 
});


$(document).ready(function(){

            //Activate Chosen for Select
            $(".chosen-select").chosen({
                placeholder_text_single: "Select an option",
                no_results_text: "Oops, nothing found!"
            });
            $('.slideDown').hide();
            $('.filterout').on('click',function(){
                $(".slideDown").toggle();
                $(".slideDown").css('visibility', 'visible');
                $(".resetfilter").addClass('hide');
                $(".exportToExcel").addClass('hide');
            });
            var resultZeroValue = $('.result-zero').val();
            if( resultZeroValue == '0' ){
                $('.filterout').addClass('hide');
            }

            $('.collegeName').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.collegeName').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });

            $('.eventName').on('keydown',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.eventName').val('');
                $('#refresh2').addClass('hide');
            });

            $('#txtFromEventDate').on('blur',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('#txtFromEventDate').val('');
                $('#refresh3').addClass('hide');
            });

            $('#txtToEventDate').on('blur',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('#txtToEventDate').val('');
                $('#refresh3').addClass('hide');
            });
        
            //Search Ajax
            $('.search-form').on('submit',function(e){
                e.preventDefault();
                $(".tbody").empty();
                $('.dataTables_filter').css('display', 'none');
                $('.dataTables_length').css('display', 'none');
                $('.dataTables_info').css('display', 'none');
                $('.dataTables_paginate').css('display', 'none');
                $('.spiner-example').removeClass('hide');
                $('.exportToExcel').removeClass('hide'); 
                $('.message-no-match').addClass('hide');   
                $('.indexPagination').addClass('hide'); 
                //$('.recordsPerPage').addClass('hide'); 
                // $('.recordsData').addClass('hide'); 
                $.ajax({
                    type     : "POST",
                    cache    : false,
                    url      : $(this).attr('action'),
                    data     : $(this).serialize(),
                    dataType : "json",
                    success  : function(data) {
                        $('.indexPagination').hide();
                        $('.filterPagination').removeClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();

                        $(".thead").append("<tr><td class='searchFilter'>Id </td><td class='searchFilter'>Name</td><td class='searchFilter'>Date</td><td class='searchFilter'>Venue</td><td class='searchFilter'>College Profile</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        if( data == 'no' ){
                            $('.message-no-match').removeClass('hide');
                            $('.exportToExcel').addClass('hide');
                            $('.prevFilter').addClass('hide');
                            $('.nextFilter').addClass('hide');
                            $('.returnHide').addClass('hide');
                            //Remove Pagination
                            $('.numPage').addClass('hide');
                        }else{
                            $('.prevFilter').hide();

                            var eventDateText;
                            var eventNameDataText;
                            var venueDataText;
                            var eventLinkDataText;
                            var lastUpdatedBy;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });
                
                            $.each(data.eventSearchDataObj, function (key, item) {

                                if( data.eventSearchDataObj[key].datetime == null ){
                                    eventDateText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventDateText =  moment(data.eventSearchDataObj[key].datetime).format("DD/MM/YYYY");
                                    /*eventDateText = formatClosedDate;*/
                                }

                                if( data.eventSearchDataObj[key].eventName == null ){
                                    eventNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventNameDataText = data.eventSearchDataObj[key].eventName;
                                }

                                if( data.eventSearchDataObj[key].venue == null ){
                                    venueDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    venueDataText = data.eventSearchDataObj[key].venue;
                                }

                                if( data.eventSearchDataObj[key].eventLink == null ){
                                    eventLinkDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventLinkDataText = data.eventSearchDataObj[key].eventLink;
                                }

                                if( data.eventSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.eventSearchDataObj[key].eUserId +"/') !!}' >"+ data.eventSearchDataObj[key].employeeFirstname+' '+data.eventSearchDataObj[key].employeeMiddlename+' '+data.eventSearchDataObj[key].employeeLastname+' (User Id:- '+data.eventSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.eventSearchDataObj[key].updated_at +"</a>";
                                }

                  
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/event/"+ data.eventSearchDataObj[key].eventId +"/') !!}' >"+ data.eventSearchDataObj[key].eventId +"</a></td><td><a href='{!! URL::to('administrator/event/"+ data.eventSearchDataObj[key].eventId +"/') !!}' >"+ eventNameDataText +"</a></td><td>"+ eventDateText +"</td> <td>"+ venueDataText +"</td> <td><a href='{!! URL::to('administrator/collegeprofile/"+ data.eventSearchDataObj[key].collegeprofileID +"/') !!}' >"+ data.eventSearchDataObj[key].firstname + "</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/event/"+ data.eventSearchDataObj[key].eventId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/event/delete/"+ data.eventSearchDataObj[key].eventId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.eventSearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.eventSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.eventSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.eventSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.eventSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.eventSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    } 
                                }
                                 
                                HTML +='</ul>';   
                                $('.filterPagination').addClass('hide'); 
                                $('.numPage').removeClass('hide'); 
                                $('.numPage > div').html(HTML); 
                            }
                            $('.pagination li').filter(function() {
                                return $(this).find('.currentCounter').text().indexOf('1') > -1;
                            }).addClass('active');

                            if(data.eventSearchDataObj == 1){
                                $('.nextFilter').addClass('hide');
                            }else{
                                $('.nextFilter').removeClass('hide');
                                $('.nextFilter').show();
                            }
                            
                            $('.message-no-match').addClass('hide');    
                        }
                    
                        $('.resetfilter').removeClass('hide');
                    }
                });
            });
        
            $('.resetfilter').on('click',function(e){
                
                
                $('.chosen-select').val('').trigger('chosen:updated');
                $('.form-control').val('');
                $('.exportToExcel').addClass('hide');
                $('#refresh1').addClass('hide');
                $('#refresh2').addClass('hide');
                $('#refresh3').addClass('hide');
                $('.returnHide').addClass('hide');
                
                $(".tbody").empty();
                $('.spiner-example').removeClass('hide');
                $('.message-no-match').addClass('hide');  
                $('#txtFromEventDate').datepicker( "refresh" );
                $('#txtToEventDate').datepicker( "refresh" );
                
                $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    method: "GET",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    url: "{{ URL::to('search/all-college-event') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id </td><td class='searchFilter'>Name</td><td class='searchFilter'>Date</td><td class='searchFilter'>Venue</td><td class='searchFilter'>College Profile</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{

                            var eventDateText;
                            var eventNameDataText;
                            var venueDataText;
                            var eventLinkDataText;
                            var lastUpdatedBy;

                            $.each(data, function (key, item) {

                               if( data[key].datetime == null ){
                                    eventDateText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventDateText =  moment(data[key].datetime).format("DD/MM/YYYY");
                                    /*eventDateText = formatClosedDate;*/
                                }

                                if( data[key].eventName == null ){
                                    eventNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventNameDataText = data[key].eventName;
                                }

                                if( data[key].venue == null ){
                                    venueDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    venueDataText = data[key].venue;
                                }

                                if( data[key].eventLink == null ){
                                    eventLinkDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventLinkDataText = data[key].eventLink;
                                }


                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                  
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/event/"+ data[key].eventId +"/') !!}' >"+ data[key].eventId +"</a></td><td><a href='{!! URL::to('administrator/event/"+ data[key].eventId +"/') !!}' >"+ eventNameDataText +"</a></td><td>"+ eventDateText +"</td> <td>"+ venueDataText +"</td> <td><a href='{!! URL::to('administrator/collegeprofile/"+ data[key].collegeprofileID +"/') !!}' >"+ data[key].firstname + "</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/event/"+ data[key].eventId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/event/delete/"+ data[key].eventId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
                            });
                            $('.indexPagination').show();
                            $('.indexPagination').removeClass('hide');
                            $('.filterPagination').addClass('hide');
                            $('.message-no-match').addClass('hide');  
                            $('.numPage').addClass('hide');  
                        }
                    
                        
                        $('.resetfilter').removeClass('hide');
                    }
                });

            });

            $('.resetCancel').on('click',function(e){
                $('.form-control').val('');
                $('.chosen-select').val('').trigger('chosen:updated');
                $('.slideDown').hide();
                location.reload();
            });
           
            
        });  
    </script>

    <script type="text/javascript">
        $(document).on('click','.pagination > li > .currentCounter',function(){
            var currentNode = $(this).text();
            
            $(".tbody").empty();
            $('.spiner-example').removeClass('hide');
            $('.exportToExcel').removeClass('hide');

            var eventDateStart = $('.eventDateStart').val();
            var eventDateEnd = $('.eventDateEnd').val();
            var collegeName = $('.collegeName').val();
            var eventName = $('.eventName').val();

            var endCounter = 20;
            
            if( $( '.message-no-match' ).hasClass( 'hide' ) ){                
            }else{
                $('.nextFilter').removeClass('hide');
                $('.nextFilter').show();
            }

            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/college-event') }}",
                    data     : { currentNode:currentNode,eventDateStart:eventDateStart, eventDateEnd: eventDateEnd, collegeName: collegeName, eventName: eventName },
                    dataType : "json",
                    success: function(data) {
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id </td><td class='searchFilter'>Name</td><td class='searchFilter'>Date</td><td class='searchFilter'>Venue</td><td class='searchFilter'>College Profile</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.message-no-match').removeClass('hide');
                            $('.exportToExcel').addClass('hide');
                            //$('.nextFilter').hide();
                        }else{

                            var eventDateText;
                            var eventNameDataText;
                            var venueDataText;
                            var eventLinkDataText;
                            var lastUpdatedBy;


                            $.each(data.eventSearchDataObj, function (key, item) {

                               if( data.eventSearchDataObj[key].datetime == null ){
                                    eventDateText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventDateText =  moment(data.eventSearchDataObj[key].datetime).format("DD/MM/YYYY");
                                    /*eventDateText = formatClosedDate;*/
                                }

                                if( data.eventSearchDataObj[key].eventName == null ){
                                    eventNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventNameDataText = data.eventSearchDataObj[key].eventName;
                                }

                                if( data.eventSearchDataObj[key].venue == null ){
                                    venueDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    venueDataText = data.eventSearchDataObj[key].venue;
                                }

                                if( data.eventSearchDataObj[key].eventLink == null ){
                                    eventLinkDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    eventLinkDataText = data.eventSearchDataObj[key].eventLink;
                                }

                                if( data.eventSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.eventSearchDataObj[key].eUserId +"/') !!}' >"+ data.eventSearchDataObj[key].employeeFirstname+' '+data.eventSearchDataObj[key].employeeMiddlename+' '+data.eventSearchDataObj[key].employeeLastname+' (User Id:- '+data.eventSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.eventSearchDataObj[key].updated_at +"</a>";
                                }

                  
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/event/"+ data.eventSearchDataObj[key].eventId +"/') !!}' >"+ data.eventSearchDataObj[key].eventId +"</a></td><td><a href='{!! URL::to('administrator/event/"+ data.eventSearchDataObj[key].eventId +"/') !!}' >"+ eventNameDataText +"</a></td><td>"+ eventDateText +"</td> <td>"+ venueDataText +"</td> <td><a href='{!! URL::to('administrator/collegeprofile/"+ data.eventSearchDataObj[key].collegeprofileID +"/') !!}' >"+ data.eventSearchDataObj[key].firstname + "</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/event/"+ data.eventSearchDataObj[key].eventId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/event/delete/"+ data.eventSearchDataObj[key].eventId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
                            });     
                            
                            if( data.currentNode >= 8 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                for(var i=1; i <= 2; i++){
                                    HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                } 
                                HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';

                                //Center 9 elements
                                var subtractCurrentNode = data.currentNode-4;console.log(subtractCurrentNode);
                                for( var sub=subtractCurrentNode; sub<= data.currentNode; sub++ ){
                                    HTML +='<li><span class="currentCounter">'+ sub +'</span></li>';   
                                }

                                var addInCurrentNode = parseInt(data.currentNode)+ 4;
                                var plusOne = parseInt(data.currentNode) + 1;
                                for( var adds = plusOne; adds <= addInCurrentNode; adds++ ){
                                    if( data.eventSearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.eventSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.eventSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.eventSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    } 
                                }

                                HTML +='</ul>'; 
                                $('.numPage > div').html(HTML); 
                            }

                            if( data.currentNode == 1 || data.currentNode == 2 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.eventSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.eventSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.eventSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.eventSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.eventSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    } 
                                }

                                HTML +='</ul>';    
                                $('.numPage > div').html(HTML); 
                            }

                            $('.numPage div .pagination').find('li').removeClass('active');                            
                            $('.numPage div .pagination').find('li').css('pointer-events', ''); 
                            $('.pagination li').filter(function() {
                                return $(this).find('.currentCounter').text().indexOf(data.currentNode) > -1;
                            }).addClass('active');
                            $('.pagination li').filter(function() {
                                return $(this).find('.currentCounter').text().indexOf(data.currentNode) > -1;
                            }).css('pointer-events','none');                      
                            
                            $('.message-no-match').addClass('hide');    
                        }
                        
                        $('.resetfilter').removeClass('hide');
                    }
                });           
        });
    </script>
@endsection








