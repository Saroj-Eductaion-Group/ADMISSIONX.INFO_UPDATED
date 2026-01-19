@extends('administrator/admin-layouts.master')
@section('styles')
{!! Html::style('/assets/administrator/css/plugins/sweetalert/sweetalert.css') !!}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Users Details <a href="{{ url('administrator/users/create') }}" class="btn btn-primary pull-right btn-sm">Add New User</a></h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                     <h5>Here are the details</h5>              
                </div>
                <div class="row margin-top10">
                    <div class="col-md-7 col-md-offset-3">
                        @if(Session::has('warning'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('warning') }}</strong>
                            </div>                        
                        @endif
                    </div>    
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
                        {!! Form::open(['url' => 'search/user', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <h4 for="usr">User First Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control userFirstName" name="userFirstName" placeholder="Enter user first name here" data-parsley-error-message="Please enter valid first name" data-parsley-trigger="change" >
                                            <!-- data-parsley-pattern="^[a-zA-Z\s .]*$" -->                                    
                                        </div> 
                                           
                                        <div class="col-md-4">                                    
                                            <h4 for="usr">User Last Name<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control userLastName" name="userLastName" placeholder="Enter user last name here" data-parsley-error-message="Please enter valid last name" data-parsley-trigger="change" >
                                            <!-- data-parsley-pattern="^[a-zA-Z\s .]*$" -->                                    
                                        </div>  
                                        <div class="col-md-4">
                                            <h4 for="usr">User Email Address<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control userEmailAddress" name="userEmailAddress" placeholder="Enter user email address here" data-parsley-error-message="Please enter valid email address" data-parsley-trigger="change" data-parsley-type="email" >
                                            
                                        </div>      
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">Phone Number<span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control phoneNumber" name="phoneNumber" data-parsley-error-message="Please enter valid phone number" data-parsley-trigger="change" data-parsley-type="number" placeholder="Enter enter phone number here">
                                            
                                        </div>    
                                        <div class="col-md-4">
                                            <h4>User Role
                                            <span class="pull-right"> <a href="javascript:void(0);" id="refresh" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select class="form-control userrole_id" name="userrole_id" data-parsley-trigger="change" data-parsley-error-message="Please select role for this user">
                                                <option value="" disabled="" selected="">Select role for this user</option>
                                                @foreach( $userRoleObj as $userRole )
                                                    <option value="{{ $userRole->id }}">{{ $userRole->name }}</option>
                                                @endforeach
                                            </select>
                                           
                                        </div>                                
                                        <div class="col-md-4">
                                            <h4 for="usr">User Status
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control userstatus_id" name="userstatus_id" data-parsley-trigger="change" data-parsley-error-message="Please select status for this user">
                                                <option value="" disabled="" selected="">Select status for this user</option>
                                                @foreach( $userStatusObj as $userStatus )
                                                    <option value="{{ $userStatus->id }}">{{ $userStatus->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('administrator/users') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class="table-responsive"> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $users == '0' )
                            <input type="text" class="result-zero hide" value="{{ $users }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>User Status</th>
                                    <th>Last Update By</th>
                                    <th>Actions</th>                       
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($users as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('administrator/users', $item->id) }}">{{ $item->id }}</a></td>
                                        <td><a href="{{ url('administrator/users', $item->id) }}">{{ $item->firstname }}</a></td>
                                        <td>
                                            @if($item->lastname)
                                                {{ $item->lastname }}
                                            @else
                                                @if( $item->userRoleId == '2' )
                                                    --
                                                @else
                                                    <span class="label label-warning">Not Updated Yet</span>
                                                @endif
                                            @endif
                                        </td>
                                         <td>
                                            @if($item->phone)
                                                {{ $item->phone }}
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif
                                        </td>
                                         <td>
                                            @if($item->email)
                                                {{ $item->email }}
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->userRoleName }}</td>
                                        <td>{{ $item->userStatusName }}</td>
                                        <td>
                                            @if($item->eUserId)
                                            <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('administrator/users/' . $item->id . '/edit') }}">
                                                <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                            </a> /
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['administrator/users', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::submit('Soft Delete', ['class' => 'btn btn-danger btn-xs']) !!}

                                            {!! Form::close() !!} /
                                            <a href="javascript:void(0);" class="deleteAdminUsers btn btn-danger btn-xs"  id="{{$item->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i> Permanently Delete</a>
                                        </td>                          
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $users->render() !!}</div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Html::script('/assets/administrator/js/plugins/sweetalert/sweetalert.min.js') !!}
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

            $('.userrole_id').on('change',function(){
                $('#refresh').removeClass('hide');
            });
            $('#refresh').on('click',function(e){
                $('.userrole_id').val('').trigger('chosen:updated');
                $('#refresh').addClass('hide');
            });

            $('.userstatus_id').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.userstatus_id').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });


            $('.userEmailAddress').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.userEmailAddress').val('');
                $('#refresh2').addClass('hide');
            });

            $('.userFirstName').on('blur',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.userFirstName').val('');
                $('#refresh3').addClass('hide');
            });

            $('.userLastName').on('blur',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.userLastName').val('');
                $('#refresh4').addClass('hide');
            });
            
            $('.phoneNumber').on('blur',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('.phoneNumber').val('');
                $('#refresh5').addClass('hide');
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
                        $(".thead").append("<tr><td class='searchFilter'>User Id</td><td class='searchFilter'>First Name</td><td class='searchFilter'>Last Name</td><td class='searchFilter'>Phone</td><td class='searchFilter'>Email</td><td class='searchFilter'>User Type </td><td class='searchFilter'>User Status</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        if( data == 'no' ){
                            $('.message-no-match').removeClass('hide');
                            $('.returnHide').addClass('hide');
                            $('.exportToExcel').addClass('hide');
                            $('.prevFilter').addClass('hide');
                            $('.nextFilter').addClass('hide');
                            //Remove Pagination
                            $('.numPage').addClass('hide');
                        }else{
                            $('.prevFilter').hide();

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });
                            var userStatusDataText;
                            var lastUpdatedBy;
                                
                            $.each(data.userDataObj, function (key, item) {

                                if( data.userDataObj[key].userstatusID == '5' ){
                                    userStatusDataText = '<strong class="label label-danger">Deleted</strong>';
                                }else{
                                    userStatusDataText = data.userDataObj[key].userStatusName;
                                }

                               
                                if( data.userDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.userDataObj[key].eUserId +"/') !!}' >"+ data.userDataObj[key].employeeFirstname+' '+data.userDataObj[key].employeeMiddlename+' '+data.userDataObj[key].employeeLastname+' (User Id:- '+data.userDataObj[key].eUserId+') <hr> Date & Time :- '+data.userDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/users/"+ data.userDataObj[key].id +"/') !!}' >"+ data.userDataObj[key].id +"</a></td><td><a href='{!! URL::to('administrator/users/"+ data.userDataObj[key].id +"/') !!}' >"+ data.userDataObj[key].firstname +"</a></td><td>"+ data.userDataObj[key].lastname +"</td><td>"+ data.userDataObj[key].phone +"</td> <td>"+ data.userDataObj[key].email +"</td><td>"+ data.userDataObj[key].userRoleName +"</td><td>"+ userStatusDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/users/"+ data.userDataObj[key].id +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/users/delete/"+ data.userDataObj[key].id +"') !!}' class='btn btn-danger btn-xs'>Soft Delete</a>/<a href='javascript:void(0);' class='deleteAdminUsers btn btn-danger btn-xs'  id="+ data.userDataObj[key].id +"><i class='fa fa-trash-o' aria-hidden='true'></i> Permanently Delete</a></td></tr>");
                                
                             
                            });

                            //Create html pagination desgin
                            if( data.userDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.userDataObj1 < 8 ){
                                    for(var i=2; i <= data.userDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.userDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.userDataObj1-1;
                                    for(var i=lessTwo; i <= data.userDataObj1; i++){
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

                            if(data.userDataObj1 == 1){
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
                $('#refresh').addClass('hide');
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
                    url: "{{ URL::to('search/all-users') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>User Id</td><td class='searchFilter'>First Name</td><td class='searchFilter'>Last Name</td><td class='searchFilter'>Phone</td><td class='searchFilter'>Email</td><td class='searchFilter'>User Type </td><td class='searchFilter'>User Status</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            var userStatusDataText;
                            var lastUpdatedBy;

                               
                            $.each(data, function (key, item) {

                                if( data[key].userstatusID == '5' ){
                                    userStatusDataText = '<strong class="label label-danger">Deleted</strong>';
                                }else{
                                    userStatusDataText = data[key].userStatusName;
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                               $("tbody").append("<tr><td><a href='{!! URL::to('administrator/users/"+ data[key].id +"/') !!}' >"+ data[key].id +"</a></td><td><a href='{!! URL::to('administrator/users/"+ data[key].id +"/') !!}' >"+ data[key].firstname +"</a></td><td>"+ data[key].lastname +"</td><td>"+ data[key].phone +"</td> <td>"+ data[key].email +"</td><td>"+ data[key].userRoleName +"</td><td>"+ userStatusDataText +"</td><td>"+ lastUpdatedBy +"</td><td><a href='{!! URL::to('administrator/users/"+ data[key].id +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/users/delete/"+ data[key].id +"') !!}' class='btn btn-danger btn-xs'>Soft Delete</a>/<a href='javascript:void(0);' class='deleteAdminUsers btn btn-danger btn-xs'  id="+ data[key].id +"><i class='fa fa-trash-o' aria-hidden='true'></i> Permanently Delete</a></td></tr>");
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

            var userFirstName = $('.userFirstName').val();
            var userLastName = $('.userLastName').val();
            var phoneNumber = $('.phoneNumber').val();
            var userEmailAddress = $('.userEmailAddress').val();
            var userstatus_id = $('.userstatus_id').val();
            var userrole_id = $('.userrole_id').val();
            
            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/user') }}",
                    data     : { userFirstName: userFirstName,userLastName: userLastName, phoneNumber: phoneNumber, userEmailAddress:userEmailAddress, userstatus_id:userstatus_id , userrole_id:userrole_id, currentNode: currentNode },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>User Id</td><td class='searchFilter'>First Name</td><td class='searchFilter'>Last Name</td><td class='searchFilter'>Phone</td><td class='searchFilter'>Email</td><td class='searchFilter'>User Type </td><td class='searchFilter'>User Status</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            var userStatusDataText;
                            var lastUpdatedBy;
                                
                            $.each(data.userDataObj, function (key, item) {
                                if( data.userDataObj[key].userstatusID == '5' ){
                                    userStatusDataText = '<strong class="label label-danger">Deleted</strong>';
                                }else{
                                    userStatusDataText = data.userDataObj[key].userStatusName;
                                }

                                if( data.userDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.userDataObj[key].eUserId +"/') !!}' >"+ data.userDataObj[key].employeeFirstname+' '+data.userDataObj[key].employeeMiddlename+' '+data.userDataObj[key].employeeLastname+' (User Id:- '+data.userDataObj[key].eUserId+') <hr> Date & Time :- '+data.userDataObj[key].updated_at +"</a>";
                                }

                              $("tbody").append("<tr><td><a href='{!! URL::to('administrator/users/"+ data.userDataObj[key].id +"/') !!}' >"+ data.userDataObj[key].id +"</a></td><td><a href='{!! URL::to('administrator/users/"+ data.userDataObj[key].id +"/') !!}' >"+ data.userDataObj[key].firstname +"</a></td><td>"+ data.userDataObj[key].lastname +"</td><td>"+ data.userDataObj[key].phone +"</td> <td>"+ data.userDataObj[key].email +"</td><td>"+ data.userDataObj[key].userRoleName +"</td><td>"+ userStatusDataText +"</td><td>"+ lastUpdatedBy +"</td><td><a href='{!! URL::to('administrator/users/"+ data.userDataObj[key].id +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/users/delete/"+ data.userDataObj[key].id +"') !!}' class='btn btn-danger btn-xs'>Soft Delete</a>/<a href='javascript:void(0);' class='deleteAdminUsers btn btn-danger btn-xs'  id="+ data.userDataObj[key].id +"><i class='fa fa-trash-o' aria-hidden='true'></i> Permanently Delete</a></td></tr>");
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
                                    if( data.userDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.userDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.userDataObj1-1;
                                    for(var i=lessTwo; i <= data.userDataObj1; i++){
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
                                if( data.userDataObj1 < 8 ){
                                    for(var i=2; i <= data.userDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.userDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.userDataObj1-1;
                                    for(var i=lessTwo; i <= data.userDataObj1; i++){
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
    <script type="text/javascript">
        $(document).on('click', '.deleteAdminUsers', function(){
            var id = $(this).attr('id');
            var onpage = $('#field_id1').val();
            swal({   title: "Are you sure you want to delete this user account?",   
                text: "Are you sure to proceed? As you click on the delete button, all the records of the user will be deleted and cannot be recovered again.",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#d43f3a",   
                confirmButtonText: "Delete user account",   
                cancelButtonText: "No",   
                closeOnConfirm: false,   
                closeOnCancel: false }, 
                function(isConfirm){
                    if (isConfirm) 
                    {   
                        var section = onpage;
                        var url ='';
                        url += '/administrator/permanently-delete-user';
                        dataType: "json",
                        $.ajax({
                            type: "POST",  
                            url: url,
                            data: { section: section, id: id },
                            success: function(data){
                                if(data.code == 200){
                                    swal("User Deleted", "This acccount has been deleted successfully?!", "success");   

                                    toastr.success("Your user account has been deleted successfully.");
                                    window.location.reload();
                                }else if(data.code == 201){
                                    swal("User Deleted", data.message, "warning");   
                                    toastr.warning(data.message);
                                }else {
                                    swal("User Deleted", "You want to delete but not you authorized person for this user account!", "danger");   
                                    toastr.error("You want to delete but not you authorized person for this user account!");
                                }
                            }
                        });
                        
                    } 
                    else{     
                        swal("Hurray", "Deletion not done!", "error");   
                    }   
                }
            );
        });
    </script>
    @endsection
