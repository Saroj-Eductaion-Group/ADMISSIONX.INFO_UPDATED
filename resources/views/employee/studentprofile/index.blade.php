@extends('employee/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <!-- <div class="col-lg-12">
       <h2>Student Profile Details <a href="{{ url('employee/studentprofile/create') }}" class="btn btn-primary pull-right btn-sm">Add New Student Profile</a></h2>
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
                        {!! Form::open(['url' => 'search/employee-student-profile', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">Student Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select studentName" name="studentName" data-parsley-trigger="change" data-parsley-error-message="Please select student">
                                                <option value="" disabled="" selected="">Select student</option>
                                                @foreach( $studentProfileObj as $student )
                                                    <option value="{{ $student->firstname }}">{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }} </option>
                                                @endforeach
                                            </select> 
                                        </div> 
                                        <div class="col-md-4">
                                            <h4 for="usr">Email Address<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control userEmailAddress" name="userEmailAddress" placeholder="Enter user email address here" data-parsley-error-message="Please enter valid email address" data-parsley-trigger="change" data-parsley-type="email" >
                                        </div>  
                                        
                                        <div class="col-md-4">
                                            <h4>Phone Number
                                            <span class="pull-right"> <a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control userPhoneNumber" name="userPhoneNumber" placeholder="Enter user phone number here" data-parsley-error-message="Please enter valid phone number" data-parsley-trigger="change" data-parsley-type="digits" >
                                        </div>    
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                         <div class="col-md-4">
                                            <h4>Parents Name
                                            <span class="pull-right"> <a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control parentsName" name="parentsName" placeholder="Enter parents name here" data-parsley-error-message="Please enter parents name" data-parsley-trigger="change">
                                        </div> 
                                         <div class="col-md-4">
                                            <h4 for="usr">Gender<span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="gender" class="form-control chosen-select gender" data-placeholder="Choose gender ..."  data-parsley-error-message=" Please select gender " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div> 
                                        <div class="col-md-4 text-right">      
                                            <a href="{{ URL::to('employee/studentprofile') }}" class="btn btn-default btn-sm">Close</a>
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
                        @if( $studentprofile == '0' )
                            <input type="text" class="result-zero hide" value="{{ $studentprofile }}">
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
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Created Date</th>
                                    <th>Phone No</th>
                                    <th>Gender</th>
                                    <th>D.O.B</th>
                                    <th>Last Updated By</th>
                                    <!--<th>Hobbies</th>
                                    <th>Interests</th>
                                     <th>Entrance Exam Name</th>
                                    <th>Entrance Exam Number</th> -->
                                    @if($storeEditUpdateAction == '1')
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($studentprofile as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('employee/studentprofile', $item->id) }}">{{ $item->id }}</a></td>
                                    <td>
                                        @if( $item->userID)
                                            <a href="{{ url('employee/users', $item->userID) }}">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</a>
                                        @else 
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->created_at)
                                            {{  $item->created_at->format('F d,Y') }} at {{  $item->created_at->format('h:i A') }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                     <td>
                                        @if( $item->parentsnumber)
                                            {{ $item->parentsnumber }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->gender)
                                            {{ $item->gender }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->dateofbirth == '0000-00-00')
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @elseif( $item->dateofbirth )
                                            {{ $item->dateofbirth }}   
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
                                   <!-- <td>
                                        @if( $item->hobbies)
                                            {{ $item->hobbies }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->interests)
                                            {{ $item->interests }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                     <td>
                                        @if( $item->entranceexamName)
                                            {{ $item->entranceexamName }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->entranceexamnumber)
                                            {{ $item->entranceexamnumber }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td> -->
                                    @if($storeEditUpdateAction == '1')
                                    <td>
                                        <a href="{{ url('employee/studentprofile/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a>/
                                        <a href="{{ url('employee/studentprofile/' . $item->id) }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Show</button>
                                        </a> <!-- /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['employee/studentprofile', $item->id],
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
                                <div class="pull-right custom-pagination">{!! $studentprofile->render() !!}</div>
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

            $('.userEmailAddress').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.userEmailAddress').val('');
                $('#refresh2').addClass('hide');
            });

            $('.studentName').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.studentName').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.parentsName').on('blur',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.parentsName').val('');
                $('#refresh4').addClass('hide');
            });

            $('.gender').on('change',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('.gender').val('').trigger('chosen:updated');
                $('#refresh5').addClass('hide');
            });

            $('.userPhoneNumber').on('blur',function(){
                $('#refresh6').removeClass('hide');
            });
            $('#refresh6').on('click',function(e){
                $('.userPhoneNumber').val('');
                $('#refresh6').addClass('hide');
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
                        $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>Created Date</td><td class='searchFilter'>Phone No</td><td class='searchFilter'>Email Address </td><td class='searchFilter'>Gender</td><td class='searchFilter'>D.O.B</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");

                                
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

                            var genderDataText;
                            var studentNameDataText;
                            var userPhoneText;
                            var userEmailAddressText;
                            var parentsNameDataText;
                            var studentDOBDataText;
                            var lastUpdatedBy;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.studentProfileDataObj, function (key, item) {

                                if(data.studentProfileDataObj[key].dateofbirth == '0000-00-00' ){
                                    studentDOBDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentDOBDataText = data.studentProfileDataObj[key].dateofbirth;
                                }

                                if( data.studentProfileDataObj[key].created_at == ''){
                                    parentsNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    parentsNameDataText = data.studentProfileDataObj[key].created_at;
                                }

                                if( data.studentProfileDataObj[key].email == ''){
                                    userEmailAddressText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    userEmailAddressText = data.studentProfileDataObj[key].email;
                                }

                                if( data.studentProfileDataObj[key].phone == ''){
                                     userPhoneText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    userPhoneText = data.studentProfileDataObj[key].phone;
                                }

                                if( data.studentProfileDataObj[key].gender == ''){
                                     genderDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    genderDataText = data.studentProfileDataObj[key].gender;
                                }

                                if( data.studentProfileDataObj[key].userID == ''){
                                     studentNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentNameDataText = data.studentProfileDataObj[key].firstname+' '+data.studentProfileDataObj[key].middlename+' '+data.studentProfileDataObj[key].lastname;
                                }

                                if( data.studentProfileDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.studentProfileDataObj[key].eUserId +"/') !!}' >"+ data.studentProfileDataObj[key].employeeFirstname+' '+data.studentProfileDataObj[key].employeeMiddlename+' '+data.studentProfileDataObj[key].employeeLastname+' (User Id:- '+data.studentProfileDataObj[key].eUserId+') <hr> Date & Time :- '+data.studentProfileDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/user/"+ data.studentProfileDataObj[key].userID +"/') !!}' >"+ data.studentProfileDataObj[key].studentprofileId +"</a></td><td><a href='{!! URL::to('employee/studentprofile/"+ data.studentProfileDataObj[key].studentprofileId +"/') !!}' >"+ studentNameDataText +"</a></td><td>"+ parentsNameDataText +"</td><td>"+ userPhoneText +"</td> <td>"+ userEmailAddressText +"</td><td>"+ genderDataText +"</td><td>"+ studentDOBDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/studentprofile/"+ data.studentProfileDataObj[key].studentprofileId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.studentProfileDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.studentProfileDataObj1 < 8 ){
                                    for(var i=2; i <= data.studentProfileDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.studentProfileDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.studentProfileDataObj1-1;
                                    for(var i=lessTwo; i <= data.studentProfileDataObj1; i++){
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

                            if(data.studentProfileDataObj1 == 1){
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
                $('#refresh2').addClass('hide');
                $('#refresh3').addClass('hide');
                $('#refresh4').addClass('hide');
                $('#refresh5').addClass('hide');
                $('#refresh6').addClass('hide');
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
                    url: "{{ URL::to('search/employee-all-student-profile') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>Created Date</td><td class='searchFilter'>Phone No</td><td class='searchFilter'>Email Address </td><td class='searchFilter'>Gender</td><td class='searchFilter'>D.O.B</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var genderDataText;
                            var studentNameDataText;
                            var userPhoneText;
                            var userEmailAddressText;
                            var parentsNameDataText;
                            var studentDOBDataText;
                            var lastUpdatedBy;
                            $.each(data, function (key, item) {

                               if(data[key].dateofbirth == '0000-00-00' ){
                                    studentDOBDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentDOBDataText = data[key].dateofbirth;
                                }

                                if( data[key].created_at == ''){
                                    parentsNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    parentsNameDataText = data[key].created_at;
                                }

                                if( data[key].email == ''){
                                    userEmailAddressText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    userEmailAddressText = data[key].email;
                                }

                                if( data[key].phone == ''){
                                     userPhoneText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    userPhoneText = data[key].phone;
                                }

                                if( data[key].gender == ''){
                                     genderDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    genderDataText = data[key].gender;
                                }

                                if( data[key].userID == ''){
                                     studentNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentNameDataText = data[key].firstname+' '+data[key].middlename+' '+data[key].lastname;
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/user/"+ data[key].userID +"/') !!}' >"+ data[key].studentprofileId +"</a></td><td><a href='{!! URL::to('employee/studentprofile/"+ data[key].studentprofileId +"/') !!}' >"+ studentNameDataText +"</a></td><td>"+ parentsNameDataText +"</td><td>"+ userPhoneText +"</td> <td>"+ userEmailAddressText +"</td><td>"+ genderDataText +"</td><td>"+ studentDOBDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/studentprofile/"+ data[key].studentprofileId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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

            var studentName = $('.studentName').val();
            var parentsName = $('.parentsName').val();
            var gender = $('.gender').val();
            var userEmailAddress = $('.userEmailAddress').val();
            var userPhoneNumber = $('.userPhoneNumber').val();
                        
            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/employee-student-profile') }}",
                    data     : { studentName: studentName, parentsName: parentsName, gender: gender, userEmailAddress:userEmailAddress,  userPhoneNumber:userPhoneNumber, currentNode: currentNode },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Student Name</td><td class='searchFilter'>Created Date</td><td class='searchFilter'>Phone No</td><td class='searchFilter'>Email Address </td><td class='searchFilter'>Gender</td><td class='searchFilter'>D.O.B</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var genderDataText;
                            var studentNameDataText;
                            var userPhoneText;
                            var userEmailAddressText;
                            var parentsNameDataText;
                            var studentDOBDataText;
                            var lastUpdatedBy;

                            $.each(data.studentProfileDataObj, function (key, item) {

                               if(data.studentProfileDataObj[key].dateofbirth == '0000-00-00' ){
                                    studentDOBDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentDOBDataText = data.studentProfileDataObj[key].dateofbirth;
                                }

                                if( data.studentProfileDataObj[key].created_at == ''){
                                    parentsNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    parentsNameDataText = data.studentProfileDataObj[key].created_at;
                                }

                                if( data.studentProfileDataObj[key].email == ''){
                                    userEmailAddressText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    userEmailAddressText = data.studentProfileDataObj[key].email;
                                }

                                if( data.studentProfileDataObj[key].phone == ''){
                                     userPhoneText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    userPhoneText = data.studentProfileDataObj[key].phone;
                                }

                                if( data.studentProfileDataObj[key].gender == ''){
                                     genderDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    genderDataText = data.studentProfileDataObj[key].gender;
                                }

                                if( data.studentProfileDataObj[key].userID == ''){
                                     studentNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentNameDataText = data.studentProfileDataObj[key].firstname+' '+data.studentProfileDataObj[key].middlename+' '+data.studentProfileDataObj[key].lastname;
                                }

                                if( data.studentProfileDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.studentProfileDataObj[key].eUserId +"/') !!}' >"+ data.studentProfileDataObj[key].employeeFirstname+' '+data.studentProfileDataObj[key].employeeMiddlename+' '+data.studentProfileDataObj[key].employeeLastname+' (User Id:- '+data.studentProfileDataObj[key].eUserId+') <hr> Date & Time :- '+data.studentProfileDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/user/"+ data.studentProfileDataObj[key].userID +"/') !!}' >"+ data.studentProfileDataObj[key].studentprofileId +"</a></td><td><a href='{!! URL::to('employee/studentprofile/"+ data.studentProfileDataObj[key].studentprofileId +"/') !!}' >"+ studentNameDataText +"</a></td><td>"+ parentsNameDataText +"</td><td>"+ userPhoneText +"</td> <td>"+ userEmailAddressText +"</td><td>"+ genderDataText +"</td><td>"+ studentDOBDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/studentprofile/"+ data.studentProfileDataObj[key].studentprofileId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
                                    if( data.studentProfileDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.studentProfileDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.studentProfileDataObj1-1;
                                    for(var i=lessTwo; i <= data.studentProfileDataObj1; i++){
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
                                if( data.studentProfileDataObj1 < 8 ){
                                    for(var i=2; i <= data.studentProfileDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.studentProfileDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.studentProfileDataObj1-1;
                                    for(var i=lessTwo; i <= data.studentProfileDataObj1; i++){
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


