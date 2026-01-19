@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <!--  <div class="col-lg-12">
        <h2>Application Status Message Details <a href="{{ url('administrator/applicationstatusmessage/create') }}" class="btn btn-primary pull-right btn-sm">Add New Application Status Message</a></h2>
    </div> -->
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
                        {!! Form::open(['url' => 'search/application-remarks', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeName" name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                                <option value="" disabled="" selected="">Select college</option>
                                                @foreach( $userObj as $college )
                                                    @if( $college->userRoleId == '2' )
                                                        <option value="{{ $college->id }}">{{ $college->firstname }}</option>
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                        <div class="col-md-3">
                                            <h4>Student Name
                                            <span class="pull-right"> <a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select class="form-control chosen-select studentName" name="studentName" data-parsley-trigger="change" data-parsley-error-message="Please select college type">
                                                <option value="" disabled="" selected="">Select Student</option>
                                                @foreach( $userObj as $college )
                                                    @if( $college->userRoleId == '3' )
                                                        <option value="{{ $college->id }}">{{ $college->firstname }} {{ $college->middlename }}  {{ $college->lastname }}  </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>     
                                         <div class="col-md-3">
                                            <h4 for="usr">Application Status<span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="applicationstatus" class="form-control chosen-select applicationstatus" data-placeholder="Choose application status ..."  data-parsley-error-message=" Please select application status " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select Application Status</option>
                                                @foreach( $applicationStatusObj as $app )
                                                    <option value="{{ $app->name }}">{{ $app->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>    
                                        <div class="col-md-3">                                    
                                            <h4 for="usr">Remark Application<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select name="remarkApplication" class="form-control remarkApplication chosen-select" data-placeholder="Choose remark application ..."  data-parsley-error-message=" Please select remark application " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select Remark Application</option>
                                                <option value="Admin Remarks">Admin Remarks</option>
                                                <option value="Employee Remarks">Employee Remarks</option>
                                                <option value="College Remarks">College Remarks</option>
                                                <option value="Student Remarks">Student Remarks</option>
                                            </select>                              
                                        </div>  
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 for="usr">Application Applied From &amp; To <span class="pull-right"><a href="javascript:void(0);" id="refresh8" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <div class="form-group" id="data_5">
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" id="txtFromCreateDate1" class="form-control createdDateStart" name="createdDateStart" value="" placeholder="Application Applied Created Form" data-parsley-trigger="change" data-parsley-error-message="Please select application applied created date from">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" id="txtToCreateDate1" class="form-control createdDateEnd" name="createdDateEnd" value="" placeholder="Application Applied Created To" data-parsley-trigger="change" data-parsley-error-message="Please select application applied created date to">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>  
                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('administrator/applicationstatusmessage') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class=""> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $applicationstatusmessage == '0' )
                            <input type="text" class="result-zero hide" value="{{ $applicationstatusmessage }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <!-- <div>
                            <select <select style="background: #fff; margin-bottom: 10px;">
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div> -->
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>S.No</th>
                                    <th>Application Id</th>
                                    <th>Student Name</th>
                                    <th>College Name</th>
                                    <th>Application Status</th>
                                    <th>Remark Application</th>
                                    <th>Last Updated By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($applicationstatusmessage as $item)
                                <tr class="gradeX">
                                    <td>
                                        <a href="{{ url('administrator/applicationstatusmessage', $item->id) }}">{{ $item->id }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/application', $item->applicationId) }}">{{ $item->applicationID }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/studentprofile', $item->studentprofileId) }}">{{ $item->studentUserFirstName }} {{ $item->studentUserMiddleName }} {{ $item->studentUserLastName }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/collegeprofile', $item->collegeprofileID) }}">{{ $item->collegeUserFirstName }}</a>
                                    </td>
                                    <td>
                                        @if( $item->applicationStatus =='Approved' )
                                            <button class="btn btn-w-m btn-primary">{{ $item->applicationStatus }}</button>
                                        @elseif( $item->applicationStatus =='Pending' )
                                            <button class="btn btn-w-m btn-warning">{{ $item->applicationStatus }}</button>
                                        @elseif( $item->applicationStatus =='Rejected' )
                                            <button class="btn btn-w-m btn-info">{{ $item->applicationStatus }}</button>
                                        @else
                                            <button class="btn btn-w-m btn-danger">{{ $item->applicationStatus }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->others )
                                          {{ $item->others }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a></a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/applicationstatusmessage', $item->id) }}">
                                            <button type="submit" class="btn btn-info btn-xs">Show</button>
                                        </a>
                                    </td>
                                   <!--  <td>
                                        <a href="{{ url('administrator/applicationstatusmessage/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['administrator/applicationstatusmessage', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td> -->                          
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $applicationstatusmessage->render() !!}</div>
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

           

            $('.university_id').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.university_id').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });


            $('.userEmailAddress').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.userEmailAddress').val('');
                $('#refresh2').addClass('hide');
            });

            $('.collegeName').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.collegeName').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.remarkApplication').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.remarkApplication').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });
            
            $('.applicationstatus').on('change',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('.applicationstatus').val('').trigger('chosen:updated');
                $('#refresh5').addClass('hide');
            });

            $('.studentName').on('change',function(){
                $('#refresh6').removeClass('hide');
            });
            $('#refresh6').on('click',function(e){
                $('.studentName').val('').trigger('chosen:updated');
                $('#refresh6').addClass('hide');
            });

            $('.verified').on('change',function(){
                $('#refresh7').removeClass('hide');
            });
            $('#refresh7').on('click',function(e){
                $('.verified').val('').trigger('chosen:updated');
                $('#refresh7').addClass('hide');
            });

             $('#txtFromCreateDate1').on('blur',function(){
                $('#refresh8').removeClass('hide');
            });
            $('#refresh8').on('click',function(e){
                $('#txtFromCreateDate1').val('');
                $('#refresh8').addClass('hide');
            });

            $('#txtToCreateDate1').on('blur',function(){
                $('#refresh8').removeClass('hide');
            });
            $('#refresh8').on('click',function(e){
                $('#txtToCreateDate1').val('');
                $('#refresh8').addClass('hide');
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
                        $(".thead").append("<tr><td class='searchFilter'>S.No</td><td class='searchFilter'>Application Id</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>College Name</td><td class='searchFilter'>Application Status</td><td class='searchFilter'>Remark Application</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Action</td></tr>");

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

                            var remarksApplicationDataText;
                            var applicationStatusText;
                            var studentnameDataText;
                            var collegeNameDataText;
                            var applicationIdDataText;
                            var lastUpdatedBy;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.applicationRemarkSearchDataObj, function (key, item) {

                                if(data.applicationRemarkSearchDataObj[key].applicationId == null ){
                                    applicationIdDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationIdDataText = data.applicationRemarkSearchDataObj[key].applicationID;
                                }

                                if( data.applicationRemarkSearchDataObj[key].collegeprofileID == null){
                                    collegeNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeNameDataText = data.applicationRemarkSearchDataObj[key].collegeUserFirstName;
                                }

                                if( data.applicationRemarkSearchDataObj[key].studentprofileId == null){
                                    studentnameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentnameDataText = data.applicationRemarkSearchDataObj[key].studentUserFirstName+' '+data.applicationRemarkSearchDataObj[key].studentUserMiddleName+' '+data.applicationRemarkSearchDataObj[key].studentUserLastName;
                                }

                                if( data.applicationRemarkSearchDataObj[key].applicationStatus =='Approved' )
                                {
                                 applicationStatusText =   '<button class="btn btn-w-m btn-primary">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }
                                else if( data.applicationRemarkSearchDataObj[key].applicationStatus =='Pending' )
                                {
                                   applicationStatusText = '<button class="btn btn-w-m btn-warning">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }
                                else if( data.applicationRemarkSearchDataObj[key].applicationStatus =='Rejected' )
                                {
                                   applicationStatusText = '<button class="btn btn-w-m btn-info">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }
                                else{
                                   applicationStatusText = '<button class="btn btn-w-m btn-danger">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }


                                if( data.applicationRemarkSearchDataObj[key].others == null){
                                    remarksApplicationDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    remarksApplicationDataText = data.applicationRemarkSearchDataObj[key].others;
                                }

                                if( data.applicationRemarkSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.applicationRemarkSearchDataObj[key].eUserId +"/') !!}' >"+ data.applicationRemarkSearchDataObj[key].employeeFirstname+' '+data.applicationRemarkSearchDataObj[key].employeeMiddlename+' '+data.applicationRemarkSearchDataObj[key].employeeLastname+' (User Id:- '+data.applicationRemarkSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.applicationRemarkSearchDataObj[key].updated_at +"</a>";
                                }

                               
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/applicationstatusmessage/"+ data.applicationRemarkSearchDataObj[key].id +"/') !!}' >"+ data.applicationRemarkSearchDataObj[key].id +"</a></td><td><a href='{!! URL::to('administrator/application/"+ data.applicationRemarkSearchDataObj[key].applicationId +"/') !!}' >"+ applicationIdDataText +"</a></td><td><a href='{!! URL::to('administrator/studentprofile/"+ data.applicationRemarkSearchDataObj[key].studentprofileId +"/') !!}' >"+ studentnameDataText +"</a></td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.applicationRemarkSearchDataObj[key].collegeprofileID +"/') !!}' >"+ collegeNameDataText +"</a></td><td>"+ applicationStatusText +"</td> <td>"+ remarksApplicationDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/applicationstatusmessage/"+ data.applicationRemarkSearchDataObj[key].id +"/') !!}' class='btn btn-primary btn-xs'>Show</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.applicationRemarkSearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.applicationRemarkSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.applicationRemarkSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.applicationRemarkSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.applicationRemarkSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.applicationRemarkSearchDataObj1; i++){
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

                            if(data.applicationRemarkSearchDataObj1 == 1){
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
                $('#refresh5').addClass('hide');
                $('#refresh6').addClass('hide');
                $('#refresh7').addClass('hide');
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
                    url: "{{ URL::to('search/all-application-remarks') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>S.No</td><td class='searchFilter'>Application Id</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>College Name</td><td class='searchFilter'>Application Status</td><td class='searchFilter'>Remark Application</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Action</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var remarksApplicationDataText;
                            var applicationStatusText;
                            var studentnameDataText;
                            var collegeNameDataText;
                            var applicationIdDataText;
                            var lastUpdatedBy;
                            $.each(data, function (key, item) {

                               if(data[key].applicationId == null ){
                                    applicationIdDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationIdDataText = data[key].applicationID;
                                }

                                if( data[key].collegeprofileID == null){
                                    collegeNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeNameDataText = data[key].collegeUserFirstName;
                                }

                                if( data[key].studentprofileId == null){
                                    studentnameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentnameDataText = data[key].studentUserFirstName+' '+data[key].studentUserMiddleName+' '+data[key].studentUserLastName;
                                }

                                if( data[key].applicationStatus =='Approved' )
                                {
                                 applicationStatusText =   '<button class="btn btn-w-m btn-primary">'+ data[key].applicationStatus +'</button>';
                                }
                                else if( data[key].applicationStatus =='Pending' )
                                {
                                   applicationStatusText = '<button class="btn btn-w-m btn-warning">'+ data[key].applicationStatus +'</button>';
                                }
                                else if( data[key].applicationStatus =='Rejected' )
                                {
                                   applicationStatusText = '<button class="btn btn-w-m btn-info">'+ data[key].applicationStatus +'</button>';
                                }
                                else{
                                   applicationStatusText = '<button class="btn btn-w-m btn-danger">'+ data[key].applicationStatus +'</button>';
                                }


                                if( data[key].others == null){
                                    remarksApplicationDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    remarksApplicationDataText = data[key].others;
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                               
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/applicationstatusmessage/"+ data[key].id +"/') !!}' >"+ data[key].id +"</a></td><td><a href='{!! URL::to('administrator/application/"+ data[key].applicationId +"/') !!}' >"+ applicationIdDataText +"</a></td><td><a href='{!! URL::to('administrator/studentprofile/"+ data[key].studentprofileId +"/') !!}' >"+ studentnameDataText +"</a></td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data[key].collegeprofileID +"/') !!}' >"+ collegeNameDataText +"</a></td><td>"+ applicationStatusText +"</td> <td>"+ remarksApplicationDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/applicationstatusmessage/"+ data[key].id +"/') !!}' class='btn btn-primary btn-xs'>Show</a></td></tr>");
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
            var remarkApplication = $('.remarkApplication').val();
            var applicationstatus = $('.applicationstatus').val();
            var studentName = $('.studentName').val();
            

            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/application-remarks') }}",
                    data     : { collegeName: collegeName,remarkApplication: remarkApplication,applicationstatus: applicationstatus, studentName:studentName, currentNode: currentNode },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>S.No</td><td class='searchFilter'>Application Id</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>College Name</td><td class='searchFilter'>Application Status</td><td class='searchFilter'>Remark Application</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Action</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var remarksApplicationDataText;
                            var applicationStatusText;
                            var studentnameDataText;
                            var collegeNameDataText;
                            var applicationIdDataText;
                            var lastUpdatedBy;

                            $.each(data.applicationRemarkSearchDataObj, function (key, item) {

                               if(data.applicationRemarkSearchDataObj[key].applicationId == null ){
                                    applicationIdDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationIdDataText = data.applicationRemarkSearchDataObj[key].applicationID;
                                }

                                if( data.applicationRemarkSearchDataObj[key].collegeprofileID == null){
                                    collegeNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeNameDataText = data.applicationRemarkSearchDataObj[key].collegeUserFirstName;
                                }

                                if( data.applicationRemarkSearchDataObj[key].studentprofileId == null){
                                    studentnameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentnameDataText = data.applicationRemarkSearchDataObj[key].studentUserFirstName+' '+data.applicationRemarkSearchDataObj[key].studentUserMiddleName+' '+data.applicationRemarkSearchDataObj[key].studentUserLastName;
                                }

                                if( data.applicationRemarkSearchDataObj[key].applicationStatus =='Approved' )
                                {
                                 applicationStatusText =   '<button class="btn btn-w-m btn-primary">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }
                                else if( data.applicationRemarkSearchDataObj[key].applicationStatus =='Pending' )
                                {
                                   applicationStatusText = '<button class="btn btn-w-m btn-warning">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }
                                else if( data.applicationRemarkSearchDataObj[key].applicationStatus =='Rejected' )
                                {
                                   applicationStatusText = '<button class="btn btn-w-m btn-info">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }
                                else{
                                   applicationStatusText = '<button class="btn btn-w-m btn-danger">'+ data.applicationRemarkSearchDataObj[key].applicationStatus +'</button>';
                                }


                                if( data.applicationRemarkSearchDataObj[key].others == null){
                                    remarksApplicationDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    remarksApplicationDataText = data.applicationRemarkSearchDataObj[key].others;
                                }

                                if( data.applicationRemarkSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.applicationRemarkSearchDataObj[key].eUserId +"/') !!}' >"+ data.applicationRemarkSearchDataObj[key].employeeFirstname+' '+data.applicationRemarkSearchDataObj[key].employeeMiddlename+' '+data.applicationRemarkSearchDataObj[key].employeeLastname+' (User Id:- '+data.applicationRemarkSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.applicationRemarkSearchDataObj[key].updated_at +"</a>";
                                }

                               
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/applicationstatusmessage/"+ data.applicationRemarkSearchDataObj[key].id +"/') !!}' >"+ data.applicationRemarkSearchDataObj[key].id +"</a></td><td><a href='{!! URL::to('administrator/application/"+ data.applicationRemarkSearchDataObj[key].applicationId +"/') !!}' >"+ applicationIdDataText +"</a></td><td><a href='{!! URL::to('administrator/studentprofile/"+ data.applicationRemarkSearchDataObj[key].studentprofileId +"/') !!}' >"+ studentnameDataText +"</a></td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.applicationRemarkSearchDataObj[key].collegeprofileID +"/') !!}' >"+ collegeNameDataText +"</a></td><td>"+ applicationStatusText +"</td> <td>"+ remarksApplicationDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/applicationstatusmessage/"+ data.applicationRemarkSearchDataObj[key].id +"/') !!}' class='btn btn-primary btn-xs'>Show</a></td></tr>");
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
                                    if( data.applicationRemarkSearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.applicationRemarkSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.applicationRemarkSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.applicationRemarkSearchDataObj1; i++){
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
                                if( data.applicationRemarkSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.applicationRemarkSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.applicationRemarkSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.applicationRemarkSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.applicationRemarkSearchDataObj1; i++){
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





