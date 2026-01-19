@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Invitation Details <a href="{{ url('administrator/invite/create') }}" class="btn btn-primary pull-right btn-sm">Add New Invitation</a></h2>
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
                        {!! Form::open(['url' => 'search/invite', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">Link<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control link" name="link" placeholder="Enter url here" data-parsley-error-message="Please enter url" data-parsley-trigger="change">
                                        </div> 
                                        <div class="col-md-3">
                                            <h4 for="usr">Referemail<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control referemail" name="referemail" placeholder="Enter referemail here" data-parsley-error-message="Please enter referemail" data-parsley-trigger="change">
                                        </div>  
                                        <div class="col-md-3">                                    
                                            <h4 for="usr">Active<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select name="isactive" class="form-control isactive chosen-select" data-placeholder="Choose isactive ..."  data-parsley-error-message=" Please select status " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select..</option>
                                                <option value="1">YES</option>
                                                <option value="0">NO</option>
                                            </select>                            
                                        </div>    
                                        <div class="col-md-3">
                                            <h4 for="usr">User Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select userName" name="userName" data-parsley-trigger="change" data-parsley-error-message="Please select author">
                                                <option value="" disabled="" selected="">Select author</option>
                                                @foreach( $usersObj as $user )
                                                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                                                @endforeach
                                            </select> 
                                        </div> 
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('administrator/invite') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class=""> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $invite == '0' )
                            <input type="text" class="result-zero hide" value="{{ $invite }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Link</th>
                                    <th>Refer Mail</th>
                                    <th>Active</th>
                                    <th>User Name</th>
                                    <th>Last Updated BY</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($invite as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('administrator/invite', $item->id) }}">{{ $item->id }}</a></td>
                                    <td><a href="{{ url('administrator/invite', $item->id) }}">{{ $item->link }}</a></td>
                                    <td>{{ $item->referemail }}</td>
                                    <td>
                                        @if( $item->isactive == '1' )
                                            <span class="label label-success">YES</span>
                                        @else
                                            <span class="label label-danger">NO</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ url('administrator/users') }}/{{ $item->userID }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->firstname }} {{ $item->lastname }} </a></td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/invite/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['administrator/invite', $item->id],
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
                                <div class="pull-right custom-pagination">{!! $invite->render() !!}</div>
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

            $('.link').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.link').val('');
                $('#refresh2').addClass('hide');
            });

            $('.referemail').on('blur',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.referemail').val('');
                $('#refresh4').addClass('hide');
            });

            $('.userName').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.userName').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.isactive').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.isactive').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
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
                        $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Link</td><td class='searchFilter'>Referemail</td><td class='searchFilter'>Active</td><td class='searchFilter'>User name</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                                
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

                            var verifyDataText;
                            var referEmailDataText;
                            var linkDataText;
                            var usernameDataText;
                            var lastUpdatedBy;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.inviteSearchDataObj, function (key, item) {

                                if( data.inviteSearchDataObj[key].link == ''){
                                     linkDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    linkDataText = data.inviteSearchDataObj[key].link;
                                }

                                if( data.inviteSearchDataObj[key].referemail == ''){
                                     referEmailDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    referEmailDataText = data.inviteSearchDataObj[key].referemail;
                                }

                                if( data.inviteSearchDataObj[key].isactive == ''){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.inviteSearchDataObj[key].isactive == '1' ){
                                        verifyDataText = '<span class="label label-success">'+ "YES" +'</span>';
                                    }else{
                                        verifyDataText = '<span class="label label-danger">'+ "NO" +'</span>';
                                    }
                                } 

                                if( data.inviteSearchDataObj[key].userID == null){
                                    usernameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    usernameDataText = data.inviteSearchDataObj[key].firstname+''+data.inviteSearchDataObj[key].middlename+''+data.inviteSearchDataObj[key].lastname;
                                   /* usernameDataText = data.inviteSearchDataObj[key].firstname;*/
                                }

                                if( data.inviteSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.inviteSearchDataObj[key].eUserId +"/') !!}' >"+ data.inviteSearchDataObj[key].employeeFirstname+' '+data.inviteSearchDataObj[key].employeeMiddlename+' '+data.inviteSearchDataObj[key].employeeLastname+' (User Id:- '+data.inviteSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.inviteSearchDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/invite/"+ data.inviteSearchDataObj[key].inviteId +"/') !!}' >"+ data.inviteSearchDataObj[key].inviteId +"</a></td><td><a href='{!! URL::to('administrator/invite/"+ data.inviteSearchDataObj[key].inviteId +"/') !!}' >"+ linkDataText +"</a></td><td>"+ referEmailDataText +"</td><td>"+ verifyDataText +"</td><td><a href='{!! URL::to('administrator/user/"+ data.inviteSearchDataObj[key].userID +"/') !!}' >"+ usernameDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/invite/"+ data.inviteSearchDataObj[key].inviteId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/invite/delete/"+ data.inviteSearchDataObj[key].inviteId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.inviteSearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.inviteSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.inviteSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.inviteSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.inviteSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.inviteSearchDataObj1; i++){
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

                            if(data.inviteSearchDataObj1 == 1){
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
                    url: "{{ URL::to('search/all-invite') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Link</td><td class='searchFilter'>Referemail</td><td class='searchFilter'>Active</td><td class='searchFilter'>User name</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var verifyDataText;
                            var referEmailDataText;
                            var linkDataText;
                            var usernameDataText;
                            var lastUpdatedBy;

                            $.each(data, function (key, item) {

                               if( data[key].link == ''){
                                     linkDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    linkDataText = data[key].link;
                                }

                                if( data[key].referemail == ''){
                                     referEmailDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    referEmailDataText = data[key].referemail;
                                }

                                if( data[key].isactive == ''){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data[key].isactive == '1' ){
                                        verifyDataText = '<span class="label label-success">'+ "YES" +'</span>';
                                    }else{
                                        verifyDataText = '<span class="label label-danger">'+ "NO" +'</span>';
                                    }
                                } 

                                if( data[key].userID == null){
                                    usernameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    usernameDataText = data[key].firstname+''+data[key].middlename+''+data[key].lastname;
                                    /*usernameDataText = data[key].firstname;*/
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/invite/"+ data[key].inviteId +"/') !!}' >"+ data[key].inviteId +"</a></td><td><a href='{!! URL::to('administrator/invite/"+ data[key].inviteId +"/') !!}' >"+ linkDataText +"</a></td><td>"+ referEmailDataText +"</td><td>"+ verifyDataText +"</td><td><a href='{!! URL::to('administrator/user/"+ data[key].userID +"/') !!}' >"+ usernameDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/invite/"+ data[key].inviteId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/invite/delete/"+ data[key].inviteId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
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

            var link = $('.link').val();
            var referemail = $('.referemail').val();
            var isactive = $('.isactive').val();
            var userName = $('.userName').val();

            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/invite') }}",
                    data     : { link: link, isactive: isactive , referemail:referemail,userName:userName, currentNode: currentNode },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Link</td><td class='searchFilter'>Referemail</td><td class='searchFilter'>Active</td><td class='searchFilter'>User name</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var verifyDataText;
                            var referEmailDataText;
                            var linkDataText;
                            var usernameDataText;
                            var lastUpdatedBy;

                            $.each(data.inviteSearchDataObj, function (key, item) {

                               if( data.inviteSearchDataObj[key].link == ''){
                                     linkDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    linkDataText = data.inviteSearchDataObj[key].link;
                                }

                                if( data.inviteSearchDataObj[key].referemail == ''){
                                     referEmailDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    referEmailDataText = data.inviteSearchDataObj[key].referemail;
                                }

                                if( data.inviteSearchDataObj[key].isactive == ''){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.inviteSearchDataObj[key].isactive == '1' ){
                                        verifyDataText = '<span class="label label-success">'+ "YES" +'</span>';
                                    }else{
                                        verifyDataText = '<span class="label label-danger">'+ "No" +'</span>';
                                    }
                                } 

                                if( data.inviteSearchDataObj[key].userID == null){
                                    usernameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    usernameDataText = data.inviteSearchDataObj[key].firstname+''+data.inviteSearchDataObj[key].middlename+''+data.inviteSearchDataObj[key].lastname;
                                    /*usernameDataText = data.inviteSearchDataObj[key].firstname;*/
                                }

                                if( data.inviteSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.inviteSearchDataObj[key].eUserId +"/') !!}' >"+ data.inviteSearchDataObj[key].employeeFirstname+' '+data.inviteSearchDataObj[key].employeeMiddlename+' '+data.inviteSearchDataObj[key].employeeLastname+' (User Id:- '+data.inviteSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.inviteSearchDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/invite/"+ data.inviteSearchDataObj[key].inviteId +"/') !!}' >"+ data.inviteSearchDataObj[key].inviteId +"</a></td><td><a href='{!! URL::to('administrator/invite/"+ data.inviteSearchDataObj[key].inviteId +"/') !!}' >"+ linkDataText +"</a></td><td>"+ referEmailDataText +"</td><td>"+ verifyDataText +"</td><td><a href='{!! URL::to('administrator/user/"+ data.inviteSearchDataObj[key].userID +"/') !!}' >"+ usernameDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/invite/"+ data.inviteSearchDataObj[key].inviteId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a>/<a href='{!! URL::to('administrator/invite/delete/"+ data.inviteSearchDataObj[key].inviteId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
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
                                    if( data.inviteSearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.inviteSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.inviteSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.inviteSearchDataObj1; i++){
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
                                if( data.inviteSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.inviteSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.inviteSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.inviteSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.inviteSearchDataObj1; i++){
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








