@extends('employee/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Application Details <a href="{{ url('employee/application/create') }}" class="btn btn-primary pull-right btn-sm">Add New Application</a></h2>
    </div>
</div> -->
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
                        {!! Form::open(['url' => 'search/employee-application', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <div class="col-md-3">
                                            <h4 for="usr">Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control applicationName" name="applicationName" placeholder="Enter name here" data-parsley-error-message="Please enter name" data-parsley-trigger="change">
                                        </div>  -->
                                        <div class="col-md-4">
                                            <h4 for="usr">Application Status<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select applicationStatus" name="applicationStatus" data-parsley-trigger="change" data-parsley-error-message="Please select application status">
                                                <option value="" disabled="" selected="">Select application status</option>
                                                @foreach( $applicationStatusObj as $app )
                                                    <option value="{{ $app->id }}">{{ $app->name }}</option>
                                                @endforeach
                                            </select> 
                                        </div>  
                                        <div class="col-md-4">                                    
                                            <h4 for="usr">User Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select userName" name="userName" data-parsley-trigger="change" data-parsley-error-message="Please select users">
                                                <option value="" disabled="" selected="">Select users</option>
                                                @foreach( $userObj as $user )
                                                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                                                @endforeach
                                            </select>         
                                        </div>    
                                        <div class="col-md-4">
                                            <h4 for="usr">College Profile<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select name="collegeProfile" class="form-control collegeProfile chosen-select" data-placeholder="Choose college profile ..."  data-parsley-error-message=" Please select college profile " data-parsley-trigger="change" >
                                                <option value="" disabled="" selected="">Select college</option>
                                                @foreach( $collegeProfileObj as $college )
                                                    <option value="{{ $college->id }}">{{ $college->firstname }} </option>
                                                @endforeach
                                            </select>              
                                        </div> 
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 for="usr">Application Applied From &amp; To <span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <div class="form-group" id="data_5">
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" id="txtFromCreateDate1" class="form-control createdDateStart" name="createdDateStart" value="" placeholder="Application Applied Created Form" data-parsley-trigger="change" data-parsley-error-message="Please select application applied created date from" >
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" id="txtToCreateDate1" class="form-control createdDateEnd" name="createdDateEnd" value="" placeholder="Application Applied Created To" data-parsley-trigger="change" data-parsley-error-message="Please select application applied created date to" >
                                                </div>
                                            </div> 
                                        </div>
                                    </div>  
                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('employee/application') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class="table-responsive"> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $application == '0' )
                            <input type="text" class="result-zero hide" value="{{ $application }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Application Date</th>
                                    <th>Student Name</th>
                                    <th>Application Status</th>
                                    <th>D.O.B</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>College Profile</th>
                                    <th>Course </th>
                                    <th>Last Updated By</th>
                                    @if($storeEditUpdateAction == '1')
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($application as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('employee/application', $item->id) }}">{{ $item->applicationID }}</a></td>
                                    <td>
                                        @if($item->created_at)
                                            {{ date('d F Y', strtotime($item->created_at)) }}
                                        @else
                                            <span class="label label-warning">Not updated yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->applicationFirstName )
                                           <a href="{{ url('employee/application', $item->id) }}">{{ $item->applicationFirstName }} {{ $item->applicationMiddleName }} {{ $item->applicationLastname }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->applicationstatusId =='1' )
                                            <button class="btn btn-w-m btn-primary">{{ $item->applicationstatusName }}</button>
                                        @elseif( $item->applicationstatusId =='2' )
                                            <button class="btn btn-w-m btn-warning">{{ $item->applicationstatusName }}</button>
                                        @elseif( $item->applicationstatusId =='3' )
                                            <button class="btn btn-w-m btn-info">{{ $item->applicationstatusName }}</button>
                                        @else
                                            <button class="btn btn-w-m btn-danger">{{ $item->applicationstatusName }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->dob )
                                           {{ $item->dob }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->email )
                                           {{ $item->email }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->phone )
                                           {{ $item->phone }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->gender )
                                           {{ $item->gender }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->collegeUserFirstName )
                                           <a href="{{ url('employee/collegeprofile', $item->collegeprofileID) }}">{{ $item->collegeUserFirstName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->collegemasterId )
                                        <a href="{{ url('employee/collegemaster', $item->collegemasterId) }}">
                                           {{ $item->functionalareaName }} / {{ $item->degreeName }} / {{ $item->courseName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    @if($storeEditUpdateAction == '1')
                                    <td>
                                        <a href="{{ url('employee/application/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> <!-- /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['employee/application', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!} -->
                                    </td>   
                                     @endif                                           
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $application->render() !!}</div>
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
{!! Html::script('js/moment.js') !!}
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

            $('.applicationName').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.applicationName').val('');
                $('#refresh2').addClass('hide');
            });

            $('.applicationStatus').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.applicationStatus').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });

            $('.userName').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.userName').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.collegeProfile').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.collegeProfile').val('').trigger('chosen:updated');
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
                        $(".thead").append("<tr><td class='searchFilter'>Id</td><th class='searchFilter'>Application Date</th><td class='searchFilter'>Student Name</td><td class='searchFilter'>Application Status</td><td class='searchFilter'>D.O.B</td><td class='searchFilter'>Email</td><td class='searchFilter'>Phone</td><td class='searchFilter'>Gender</td><td class='searchFilter'>College Profile</td><td class='searchFilter'>Course</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                                
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

                            var emailAddressDataText;
                            var applicationDateDataText;
                            var applicationStatusDataText;
                            var collegeProfileDataText;
                            var usernameDataText;
                            var dobDataText;
                            var phoneDataText;
                            var genderDataText;
                            var courseNameDataText;
                            var lastUpdatedBy;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.applicationSearchDataObj, function (key, item) {

                                if( data.applicationSearchDataObj[key].collegeUserID == null){
                                     collegeProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeProfileDataText = data.applicationSearchDataObj[key].collegeUserFirstName;
                                }

                                if( data.applicationSearchDataObj[key].created_at == null ){
                                    applicationDateDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationDateDataText = date('d F Y', strtotime(data.applicationSearchDataObj[key].created_at));
                                }     


                                if( data.applicationSearchDataObj[key].applicationstatusId =='1' )
                                {
                                 applicationStatusDataText =   '<button class="btn btn-w-m btn-primary">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                else if( data.applicationSearchDataObj[key].applicationstatusId =='2' )
                                {
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-warning">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                else if( data.applicationSearchDataObj[key].applicationstatusId =='3' )
                                {
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-info">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                else{
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-danger">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                

                                /*if( data.applicationSearchDataObj[key].applicationstatusName == null){
                                     applicationStatusDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationStatusDataText = data.applicationSearchDataObj[key].applicationstatusName;
                                }*/

                                if( data.applicationSearchDataObj[key].phone == ''){
                                    phoneDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    phoneDataText = data.applicationSearchDataObj[key].phone;
                                }

                                if( data.applicationSearchDataObj[key].gender == ''){
                                    genderDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    genderDataText = data.applicationSearchDataObj[key].phone;
                                }

                                if(data.applicationSearchDataObj[key].dob == '0000-00-00' ){
                                    dobDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    dobDataText = data.applicationSearchDataObj[key].dob;
                                }

                                if( data.applicationSearchDataObj[key].email == ''){
                                    emailAddressDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    emailAddressDataText = data.applicationSearchDataObj[key].email;
                                }

                                if( data.applicationSearchDataObj[key].studentUserID == null){
                                    usernameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    usernameDataText = data.applicationSearchDataObj[key].studentUserFirstName+' '+data.applicationSearchDataObj[key].studentUserMiddleName+''+data.applicationSearchDataObj[key].studentUserLastName;
                                }


                                if(  data.applicationSearchDataObj[key].collegemasterId == null){
                                   courseNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }
                                else{
                                   courseNameDataText = data.applicationSearchDataObj[key].functionalareaName+' / '+data.applicationSearchDataObj[key].degreeName+'/'+data.applicationSearchDataObj[key].courseName;
                                }
                                

                                if( data.applicationSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.applicationSearchDataObj[key].eUserId +"/') !!}' >"+ data.applicationSearchDataObj[key].employeeFirstname+' '+data.applicationSearchDataObj[key].employeeMiddlename+' '+data.applicationSearchDataObj[key].employeeLastname+' (User Id:- '+data.applicationSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.applicationSearchDataObj[key].updated_at +"</a>";
                                }
                                    

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/application/"+ data.applicationSearchDataObj[key].applicationId +"/') !!}' >"+ data.applicationSearchDataObj[key].applicationID +"</a></td><td>"+ applicationDateDataText +"</td><td><a href='{!! URL::to('employee/users/"+ data.applicationSearchDataObj[key].studentUserID +"/') !!}' >"+ usernameDataText +"</a></td><td>"+ applicationStatusDataText +"</td><td>"+ dobDataText +"</td><td>"+ emailAddressDataText +"</td><td>"+ phoneDataText +"</td><td>"+ genderDataText +"</td><td><a href='{!! URL::to('employee/collegeprofile/"+ data.applicationSearchDataObj[key].collegeprofileID +"/') !!}' >"+ collegeProfileDataText +"</a></td><td><a href='{!! URL::to('employee/collegemaster/"+ data.applicationSearchDataObj[key].collegemasterId +"/') !!}' >"+ courseNameDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/application/"+ data.applicationSearchDataObj[key].applicationId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.applicationSearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.applicationSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.applicationSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.applicationSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.applicationSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.applicationSearchDataObj1; i++){
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

                            if(data.applicationSearchDataObj1 == 1){
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
                    url: "{{ URL::to('search/employee-all-application') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><th class='searchFilter'>Application Date</th><td class='searchFilter'>Student Name</td><td class='searchFilter'>Application Status</td><td class='searchFilter'>D.O.B</td><td class='searchFilter'>Email</td><td class='searchFilter'>Phone</td><td class='searchFilter'>Gender</td><td class='searchFilter'>College Profile</td><td class='searchFilter'>Course</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var emailAddressDataText;
                            var applicationDateDataText;
                            var applicationStatusDataText;
                            var collegeProfileDataText;
                            var usernameDataText;
                            var dobDataText;
                            var phoneDataText;
                            var genderDataText;
                            var courseNameDataText;
                            var lastUpdatedBy;

                            $.each(data, function (key, item) {

                               if( data[key].collegeUserID == null){
                                     collegeProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeProfileDataText = data[key].collegeUserFirstName;
                                }

                                if( data[key].created_at == null ){
                                    applicationDateDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationDateDataText = date('d F Y', strtotime(data[key].created_at));
                                }     


                                if( data[key].applicationstatusId =='1' )
                                {
                                 applicationStatusDataText =   '<button class="btn btn-w-m btn-primary">'+ data[key].applicationstatusName +'</button>';
                                }
                                else if( data[key].applicationstatusId =='2' )
                                {
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-warning">'+ data[key].applicationstatusName +'</button>';
                                }
                                else if( data[key].applicationstatusId =='3' )
                                {
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-info">'+ data[key].applicationstatusName +'</button>';
                                }
                                else{
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-danger">'+ data[key].applicationstatusName +'</button>';
                                }
                                

                                /*if( data[key].applicationstatusName == null){
                                     applicationStatusDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationStatusDataText = data[key].applicationstatusName;
                                }*/

                                if( data[key].phone == ''){
                                    phoneDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    phoneDataText = data[key].phone;
                                }

                                if( data[key].gender == ''){
                                    genderDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    genderDataText = data[key].phone;
                                }

                                if(data[key].dob == '0000-00-00' ){
                                    dobDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    dobDataText = data[key].dob;
                                }

                                if( data[key].email == ''){
                                    emailAddressDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    emailAddressDataText = data[key].email;
                                }

                                if( data[key].studentUserID == null){
                                    usernameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    usernameDataText = data[key].studentUserFirstName+' '+data[key].studentUserMiddleName+''+data[key].studentUserLastName;
                                }


                                if(  data[key].collegemasterId == null){
                                   courseNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }
                                else{
                                   courseNameDataText = data[key].functionalareaName+' / '+data[key].degreeName+'/'+data[key].courseName;
                                }
                                        
                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }    

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/application/"+ data[key].applicationId +"/') !!}' >"+ data[key].applicationID +"</a></td><td>"+ applicationDateDataText +"</td><td><a href='{!! URL::to('employee/users/"+ data[key].studentUserID +"/') !!}' >"+ usernameDataText +"</a></td><td>"+ applicationStatusDataText +"</td><td>"+ dobDataText +"</td><td>"+ emailAddressDataText +"</td><td>"+ phoneDataText +"</td><td>"+ genderDataText +"</td><td><a href='{!! URL::to('employee/collegeprofile/"+ data[key].collegeprofileID +"/') !!}' >"+ collegeProfileDataText +"</a></td><td><a href='{!! URL::to('employee/collegemaster/"+ data[key].collegemasterId +"/') !!}' >"+ courseNameDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/application/"+ data[key].applicationId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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

            var applicationName = $('.applicationName').val();
            var applicationStatus = $('.applicationStatus').val();
            var collegeProfile = $('.collegeProfile').val();
            var userName = $('.userName').val();

            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/employee-application') }}",
                    data     : { applicationName: applicationName, collegeProfile: collegeProfile , applicationStatus:applicationStatus,userName:userName, currentNode: currentNode },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><th class='searchFilter'>Application Date</th><td class='searchFilter'>Student Name</td><td class='searchFilter'>Application Status</td><td class='searchFilter'>D.O.B</td><td class='searchFilter'>Email</td><td class='searchFilter'>Phone</td><td class='searchFilter'>Gender</td><td class='searchFilter'>College Profile</td><td class='searchFilter'>Course</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var emailAddressDataText;
                            var applicationDateDataText;
                            var applicationStatusDataText;
                            var collegeProfileDataText;
                            var usernameDataText;
                            var dobDataText;
                            var phoneDataText;
                            var genderDataText;
                            var courseNameDataText;
                            var lastUpdatedBy;

                            $.each(data.applicationSearchDataObj, function (key, item) {

                               if( data.applicationSearchDataObj[key].collegeUserID == null){
                                     collegeProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeProfileDataText = data.applicationSearchDataObj[key].collegeUserFirstName;
                                }

                                if( data.applicationSearchDataObj[key].created_at == null ){
                                    applicationDateDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationDateDataText = date('d F Y', strtotime(data.applicationSearchDataObj[key].created_at));
                                } 

                                if( data.applicationSearchDataObj[key].applicationstatusId =='1' )
                                {
                                 applicationStatusDataText =   '<button class="btn btn-w-m btn-primary">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                else if( data.applicationSearchDataObj[key].applicationstatusId =='2' )
                                {
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-warning">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                else if( data.applicationSearchDataObj[key].applicationstatusId =='3' )
                                {
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-info">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                else{
                                   applicationStatusDataText = '<button class="btn btn-w-m btn-danger">'+ data.applicationSearchDataObj[key].applicationstatusName +'</button>';
                                }
                                

                                /*if( data.applicationSearchDataObj[key].applicationstatusName == null){
                                     applicationStatusDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationStatusDataText = data.applicationSearchDataObj[key].applicationstatusName;
                                }*/

                                if( data.applicationSearchDataObj[key].phone == ''){
                                    phoneDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    phoneDataText = data.applicationSearchDataObj[key].phone;
                                }

                                if( data.applicationSearchDataObj[key].gender == ''){
                                    genderDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    genderDataText = data.applicationSearchDataObj[key].phone;
                                }

                                if(data.applicationSearchDataObj[key].dob == '0000-00-00' ){
                                    dobDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    dobDataText = data.applicationSearchDataObj[key].dob;
                                }

                                if( data.applicationSearchDataObj[key].email == ''){
                                    emailAddressDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    emailAddressDataText = data.applicationSearchDataObj[key].email;
                                }

                                if( data.applicationSearchDataObj[key].studentUserID == null){
                                    usernameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    usernameDataText = data.applicationSearchDataObj[key].studentUserFirstName+' '+data.applicationSearchDataObj[key].studentUserMiddleName+''+data.applicationSearchDataObj[key].studentUserLastName;
                                }


                                if(  data.applicationSearchDataObj[key].collegemasterId == null){
                                   courseNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }
                                else{
                                   courseNameDataText = data.applicationSearchDataObj[key].functionalareaName+' / '+data.applicationSearchDataObj[key].degreeName+'/'+data.applicationSearchDataObj[key].courseName;
                                }
                                 
                                if( data.applicationSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.applicationSearchDataObj[key].eUserId +"/') !!}' >"+ data.applicationSearchDataObj[key].employeeFirstname+' '+data.applicationSearchDataObj[key].employeeMiddlename+' '+data.applicationSearchDataObj[key].employeeLastname+' (User Id:- '+data.applicationSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.applicationSearchDataObj[key].updated_at +"</a>";
                                }       

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/application/"+ data.applicationSearchDataObj[key].applicationId +"/') !!}' >"+ data.applicationSearchDataObj[key].applicationID +"</a></td><td>"+ applicationDateDataText +"</td><td><a href='{!! URL::to('employee/users/"+ data.applicationSearchDataObj[key].studentUserID +"/') !!}' >"+ usernameDataText +"</a></td><td>"+ applicationStatusDataText +"</td><td>"+ dobDataText +"</td><td>"+ emailAddressDataText +"</td><td>"+ phoneDataText +"</td><td>"+ genderDataText +"</td><td><a href='{!! URL::to('employee/collegeprofile/"+ data.applicationSearchDataObj[key].collegeprofileID +"/') !!}' >"+ collegeProfileDataText +"</a></td><td><a href='{!! URL::to('employee/collegemaster/"+ data.applicationSearchDataObj[key].collegemasterId +"/') !!}' >"+ courseNameDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/application/"+ data.applicationSearchDataObj[key].applicationId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
                                    if( data.applicationSearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.applicationSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.applicationSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.applicationSearchDataObj1; i++){
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
                                if( data.applicationSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.applicationSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.applicationSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.applicationSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.applicationSearchDataObj1; i++){
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










