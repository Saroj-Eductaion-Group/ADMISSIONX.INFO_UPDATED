@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Query Details <!-- <a href="{{ url('administrator/query/create') }}" class="btn btn-primary pull-right btn-sm">Add New Query</a> --></h2>
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
                        <div class="col-md-6">
                            <h2>Chat Between College &amp; Student</h2>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="javascript:void(0);" class="btn btn-danger resetfilter hide">Reset Filter</a>     
                            <a href="javascript:void(0);" class="btn btn-primary filterout">Filter</a>
                        </div>
                    </div>
                    <div class="slideDown" style="visibility:hidden">
                         <div class="hr-line-dashed"></div>    
                        {!! Form::open(['url' => 'search/query', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">Subject<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control subject" name="subject" placeholder="Enter subject here" data-parsley-error-message="Please enter subject" data-parsley-trigger="change">
                                        </div> 
                                        <div class="col-md-4">
                                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeName" name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                                <option value="" disabled="" selected="">Select college</option>
                                                @foreach( $userObj as $college )
                                                    @if( $college->userRoleId == '2' )
                                                        <option value="{{ $college->id }}">{{ $college->firstname }}</option>
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                        <div class="col-md-4">
                                            <h4 for="usr">Student Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select studentName" name="studentName" data-parsley-trigger="change" data-parsley-error-message="Please select student">
                                                <option value="" disabled="" selected="">Select Student </option>
                                                @foreach( $userObj as $student )
                                                    @if( $student->userRoleId == '3' )
                                                        <option value="{{ $student->id }}">{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }}</option>
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 for="usr">Query From &amp; To <span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <div class="form-group" id="data_5">
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" id="txtFromCreateDate1" class="form-control createdDateStart" name="createdDateStart" value="" placeholder="Query Created Form" data-parsley-trigger="change" data-parsley-error-message="Please select query created date from">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" id="txtToCreateDate1" class="form-control createdDateEnd" name="createdDateEnd" value="" placeholder="Query Created To" data-parsley-trigger="change" data-parsley-error-message="Please select query created date to">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>  
                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('administrator/query') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class=""> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $query == '0' )
                            <input type="text" class="result-zero hide" value="{{ $query }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Subject </th>
                                    <th>College Name</th>
                                    <th>Student Name</th>
                                    <th>Chat Direction</th>
                                    <th>Last Updated By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($query as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ URL('/administrator/query', $item->id) }}">{{ $item->id }}</a></td>
                                    <td>
                                        @if( $item->subject )
                                           <a href="{{ URL('/administrator/query-details', [$item->chatkey, $item->id]) }}">{{ $item->subject }}</a>
                                        @else
                                           --
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->collegeprofileID )
                                          <a href="{{ url('administrator/collegeprofile', $item->collegeprofileID) }}">{{ $item->U2FirstName }} {{ $item->U2LastName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->U3Id )
                                          <a href="{{ url('administrator/studentprofile', $item->studentprofileID) }}">{{ $item->U3FirstName }} {{ $item->U3MiddleName }} {{ $item->U3LastName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-info text-uppercase">{{ str_slug($item->queryflowtype, ' ') }}</span></td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- <a href="{{ URL('/administrator/query-details', [$item->chatkey, $item->id]) }}" class="btn btn-xs btn-info">Show</a> -->
                                        <a href="{{ url('administrator/query/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['administrator/query', $item->id],
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
                                <div class="pull-right custom-pagination">{!! $query->render() !!}</div>
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
                        </div>  -->

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
   <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            
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

            $('.subject').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.subject').val('');
                $('#refresh2').addClass('hide');
            });
            

            $('.collegeName').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.collegeName').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });

            $('.administratorName').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.administratorName').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });


            $('.studentName').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.studentName').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });

            $('#txtFromCreateDate1').on('blur',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('#txtFromCreateDate1').val('');
                $('#refresh5').addClass('hide');
            });

            $('#txtToCreateDate1').on('blur',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('#txtToCreateDate1').val('');
                $('#refresh5').addClass('hide');
            });

            $("#txtFromCreateDate1").datepicker({
                numberOfMonths: 1,
                onSelect: function(selected) {
                  $("#txtToCreateDate1").datepicker("option","minDate", selected)
                }
            });
            $("#txtToCreateDate1").datepicker({ 
                numberOfMonths: 1,
                onSelect: function(selected) {
                   $("#txtFromCreateDate1").datepicker("option","maxDate", selected)
                }
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
                        $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Subject</td><td class='searchFilter'>College Name</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>Chat Direction</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        /*<td class='searchFilter'>Administrator Name</td>*/
                                
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

                            var adminDataText;
                            var collegeDataText;
                            var studentDataText;
                            var subjectDataText;
                            var chatDirectionText;
                            var lastUpdatedBy;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.querySearchDataObj, function (key, item) {

                                if( data.querySearchDataObj[key].subject == ''){
                                     subjectDataText = '--';
                                }else{
                                    subjectDataText = data.querySearchDataObj[key].subject;
                                }

                                if( data.querySearchDataObj[key].U1FirstName == null){
                                     adminDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    adminDataText = data.querySearchDataObj[key].U1FirstName;
                                }

                                if( data.querySearchDataObj[key].U2FirstName == null){
                                     collegeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeDataText = data.querySearchDataObj[key].U2FirstName;
                                }

                                if( data.querySearchDataObj[key].U3FirstName == null){
                                     studentDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentDataText = data.querySearchDataObj[key].U3FirstName+' '+data.querySearchDataObj[key].U3MiddleName+' '+data.querySearchDataObj[key].U3LastName;
                                }

                                if( data.querySearchDataObj[key].queryflowtype == null){
                                     chatDirectionText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    chatDirectionText = '<span class="badge badge-info text-uppercase">'+data.querySearchDataObj[key].queryflowtype+'</span>';
                                }

                                if( data.querySearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.querySearchDataObj[key].eUserId +"/') !!}' >"+ data.querySearchDataObj[key].employeeFirstname+' '+data.querySearchDataObj[key].employeeMiddlename+' '+data.querySearchDataObj[key].employeeLastname+' (User Id:- '+data.querySearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.querySearchDataObj[key].updated_at +"</a>";
                                }
                               
                                
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/query/"+ data.querySearchDataObj[key].queryID +"/') !!}' >"+ data.querySearchDataObj[key].queryID +"</a></td><td><a href='{!! URL::to('administrator/query-details/"+ data.querySearchDataObj[key].chatkey+"/"+data.querySearchDataObj[key].queryID +"/') !!}' >"+ subjectDataText +"</a></td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.querySearchDataObj[key].collegeprofileID +"/') !!}' >"+ collegeDataText +"</a></td><td><a href='{!! URL::to('administrator/studentprofile/"+ data.querySearchDataObj[key].studentprofileID +"/') !!}' >"+ studentDataText +"</a></td><td>"+ chatDirectionText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/query/"+ data.querySearchDataObj[key].queryID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/query/delete/"+ data.querySearchDataObj[key].queryID +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></td></tr>");
                                /*<td><a href='{!! URL::to('administrator/user/"+ data.querySearchDataObj[key].U1Id +"/') !!}' >"+ adminDataText +"</a></td>*/
                                
                            });

                            //Create html pagination desgin
                            if( data.querySearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.querySearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.querySearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.querySearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.querySearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.querySearchDataObj1; i++){
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

                            if(data.querySearchDataObj1 == 1){
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
                $('#refresh4').addClass('hide');
                $('.returnHide').addClass('hide');
                                                               
                $(".tbody").empty();
                $('.spiner-example').removeClass('hide');
                $('.message-no-match').addClass('hide');                 
                $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    method: "GET",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    url: "{{ URL::to('search/all-query') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Subject</td><td class='searchFilter'>College Name</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>Chat Direction</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                       /*<td class='searchFilter'>Administrator Name</td>*/
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var adminDataText;
                            var collegeDataText;
                            var studentDataText;
                            var subjectDataText;
                            var chatDirectionText;
                            var lastUpdatedBy;

                            $.each(data, function (key, item) {

                               if( data[key].subject == ''){
                                     subjectDataText = '--';
                                }else{
                                    subjectDataText = data[key].subject;
                                }

                                if( data[key].U1FirstName == null){
                                     adminDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    adminDataText = data[key].U1FirstName;
                                }

                                if( data[key].U2FirstName == null){
                                     collegeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeDataText = data[key].U2FirstName;
                                }

                                if( data[key].U3FirstName == null){
                                     studentDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentDataText = data[key].U3FirstName+' '+data[key].U3MiddleName+' '+data[key].U3LastName;
                                }

                                if( data[key].queryflowtype == null){
                                     chatDirectionText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    chatDirectionText = '<span class="badge badge-info text-uppercase">'+data[key].queryflowtype+'</span>';
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }
                                
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/query/"+ data[key].queryID +"/') !!}' >"+ data[key].queryID +"</a></td><td><a href='{!! URL::to('administrator/query-details/"+ data[key].chatkey+"/"+data[key].queryID +"/') !!}' >"+ subjectDataText +"</a></td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data[key].collegeprofileID +"/') !!}' >"+ collegeDataText +"</a></td><td><a href='{!! URL::to('administrator/studentprofile/"+ data[key].studentprofileID +"/') !!}' >"+ studentDataText +"</a></td><td>"+ chatDirectionText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/query/"+ data[key].queryID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/query/delete/"+ data[key].queryID +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
                                /*<td><a href='{!! URL::to('administrator/user/"+ data[key].U1Id +"/') !!}' >"+ adminDataText +"</a></td>*/

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
            
            var totalPages = $('.totalReturnRow').val();
            $(".tbody").empty();
            $('.spiner-example').removeClass('hide');
            $('.prevFilter').removeClass('hide');
            $('.exportToExcel').removeClass('hide');

            var collegeName = $('.collegeName').val();
            var subject = $('.subject').val();
            var administratorName = $('.administratorName').val();
            var studentName = $('.studentName').val();
                      
            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/query') }}",
                    data     : { collegeName: collegeName, administratorName: administratorName , subject:subject, currentNode: currentNode, studentName:studentName },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Subject</td><td class='searchFilter'>College Name</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>Chat Direction</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        /*<td class='searchFilter'>Administrator Name</td>*/
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var adminDataText;
                            var collegeDataText;
                            var studentDataText;
                            var subjectDataText;
                            var chatDirectionText;
                            var lastUpdatedBy;

                            $.each(data.querySearchDataObj, function (key, item) {

                              if( data.querySearchDataObj[key].subject == ''){
                                     subjectDataText = '--';
                                }else{
                                    subjectDataText = data.querySearchDataObj[key].subject;
                                }

                                if( data.querySearchDataObj[key].U1FirstName == null){
                                     adminDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    adminDataText = data.querySearchDataObj[key].U1FirstName;
                                }

                                if( data.querySearchDataObj[key].U2FirstName == null){
                                     collegeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeDataText = data.querySearchDataObj[key].U2FirstName;
                                }

                                if( data.querySearchDataObj[key].U3FirstName == null){
                                     studentDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentDataText = data.querySearchDataObj[key].U3FirstName+' '+data.querySearchDataObj[key].U3MiddleName+' '+data.querySearchDataObj[key].U3LastName;
                                }

                                if( data.querySearchDataObj[key].queryflowtype == null){
                                     chatDirectionText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    chatDirectionText = '<span class="badge badge-info text-uppercase">'+data.querySearchDataObj[key].queryflowtype+'</span>';
                                }

                                if( data.querySearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.querySearchDataObj[key].eUserId +"/') !!}' >"+ data.querySearchDataObj[key].employeeFirstname+' '+data.querySearchDataObj[key].employeeMiddlename+' '+data.querySearchDataObj[key].employeeLastname+' (User Id:- '+data.querySearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.querySearchDataObj[key].updated_at +"</a>";
                                }
                                
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/query/"+ data.querySearchDataObj[key].queryID +"/') !!}' >"+ data.querySearchDataObj[key].queryID +"</a></td><td><a href='{!! URL::to('administrator/query-details/"+ data.querySearchDataObj[key].chatkey+"/"+data.querySearchDataObj[key].queryID +"/') !!}' >"+ subjectDataText +"</a></td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.querySearchDataObj[key].collegeprofileID +"/') !!}' >"+ collegeDataText +"</a></td><td><a href='{!! URL::to('administrator/studentprofile/"+ data.querySearchDataObj[key].studentprofileID +"/') !!}' >"+ studentDataText +"</a></td><td>"+ chatDirectionText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/query/"+ data.querySearchDataObj[key].queryID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/query/delete/"+ data.querySearchDataObj[key].queryID +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");

                                /*<td><a href='{!! URL::to('administrator/user/"+ data.querySearchDataObj[key].U1Id +"/') !!}' >"+ adminDataText +"</a></td>*/
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
                                    if( data.querySearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.querySearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.querySearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.querySearchDataObj1; i++){
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
                                if( data.querySearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.querySearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.querySearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.querySearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.querySearchDataObj1; i++){
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












