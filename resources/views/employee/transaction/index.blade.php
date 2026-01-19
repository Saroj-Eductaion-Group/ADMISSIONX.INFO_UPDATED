@extends('employee/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
         <h2>Transaction Details <a href="{{ url('employee/transaction/create') }}" class="btn btn-primary pull-right btn-sm">Add New Transaction</a></h2>
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
                        <div class="col-md-6">   
                            <h3>Total collection <span class="label label-danger"><i class="fa fa-rupee"></i> {{ $getSumOfTransaction }}/-</span> till {{ date('d/M/Y h:i A') }}</h3>
                        </div>
                        <div class="col-md-6 text-right">   
                            <!-- <a href="javascript:void(0);" class="btn btn-info exportToExcel hide">Export</a>   -->   
                            <a href="javascript:void(0);" class="btn btn-danger resetfilter hide">Reset Filter</a>     
                            <a href="javascript:void(0);" class="btn btn-primary filterout">Filter</a>
                        </div>
                    </div>
                    <div class="slideDown" style="visibility:hidden">
                         <div class="hr-line-dashed"></div>    
                        {!! Form::open(['url' => 'search/employee-transaction', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control transactionName" name="transactionName" placeholder="Enter name here" data-parsley-error-message="Please enter name" data-parsley-trigger="change">
                                        </div> 
                                        <div class="col-md-3">
                                            <h4 for="usr">Application No<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select applicationName" name="applicationName" data-parsley-trigger="change" data-parsley-error-message="Please select application number">
                                                <option value="" disabled="" selected="">Select application number</option>
                                                @foreach( $applicationObj as $app )
                                                    <option value="{{ $app->id }}">{{ $app->applicationID }}</option>
                                                @endforeach
                                            </select> 
                                        </div>  
                                        <div class="col-md-3">                                    
                                            <h4 for="usr">Card Type<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select cardType" name="cardType" data-parsley-trigger="change" data-parsley-error-message="Please select card type">
                                                <option value="" disabled="" selected="">Select card type</option>
                                                @foreach( $cartTypeobj as $card )
                                                    <option value="{{ $card->id }}">{{ $card->name }}</option>
                                                @endforeach
                                            </select>         
                                        </div>    
                                        <div class="col-md-3">
                                            <h4 for="usr">Payment Status<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select name="paymentStatus" class="form-control paymentStatus chosen-select" data-placeholder="Choose Payment Status ..."  data-parsley-error-message=" Please select payment status " data-parsley-trigger="change" >
                                                <option value="" disabled="" selected="">Select payment status</option>
                                                @foreach( $paymentStatusObj as $payment )
                                                    <option value="{{ $payment->id }}">{{ $payment->name }} </option>
                                                @endforeach
                                            </select>              
                                        </div> 
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('employee/transaction') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class="table-responsive"> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $transaction == '0' )
                            <input type="text" class="result-zero hide" value="{{ $transaction }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Name </th>
                                    <th>Application No</th>
                                    <th>Transaction Date</th>
                                    <th>Total Fee</th>
                                    <th>Paid Amount</th>
                                    <th>Rest Amount</th>
                                    <th>Card Type</th>
                                    <th>Payment Status</th>
                                    <th>Last Updated bY</th>
                                    <!-- @if($storeEditUpdateAction == '1')
                                    <th>Actions</th>
                                    @endif -->
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($transaction as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('employee/transaction', $item->id) }}">{{ $item->id }}</a></td>
                                    <td><a href="{{ url('employee/transaction', $item->id) }}">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</a></td>
                                    <td><a href="{{ url('employee/application', $item->applicationId) }}">{{ $item->applicationID }}</a></td>
                                    <td>{{ $item->created_at }}</td>
                                    <td style="width: 90px;"><i class="fa fa-rupee"></i> {{ $item->totalfees }}</td>
                                    <td style="width: 90px;"><i class="fa fa-rupee"></i> {{ $item->byafees }}</td>
                                    <td style="width: 90px;"><i class="fa fa-rupee"></i> {{ $item->restfees }}</td>
                                    <td>@if($item->cardtypeName)
                                            {{ $item->cardtypeName }}
                                         @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->paymentstatusName }}</td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <!-- @if($storeEditUpdateAction == '1')
                                    <td>
                                        <a href="{{ url('employee/transaction/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['employee/transaction', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td>         
                                    @endif    -->                    
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $transaction->render() !!}</div>
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

            $('.transactionName').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.transactionName').val('');
                $('#refresh2').addClass('hide');
            });

            $('.applicationName').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.applicationName').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });

            $('.cardType').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.cardType').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.paymentStatus').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.paymentStatus').val('').trigger('chosen:updated');
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
                        $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Name</td><td class='searchFilter'>Application No</td><td class='searchFilter'>Transaction Date</td><td class='searchFilter'>Total Fee</td><td class='searchFilter'>Paid Amount</td><td class='searchFilter'>Rest Amount</td><td class='searchFilter'>Card Type</td><td class='searchFilter'>Payment Status</td><td class='searchFilter'>Last Updated By</td></tr>");
                        /*<td class='searchFilter'>Actions</td>*/
                                
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

                            var transactionNameDataText;
                            var applicationNameDataText;
                            var paymentStatusDataText;
                            var cardTypeDataText;
                            var lastUpdatedBy;
                            var transcationDate;
                            var totalfee;
                            var paidamount;
                            var restamount;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.transactionSearchDataObj, function (key, item) {

                                if( data.transactionSearchDataObj[key].paymentstatusName == null){
                                     paymentStatusDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    paymentStatusDataText = data.transactionSearchDataObj[key].paymentstatusName;
                                }

                                if( data.transactionSearchDataObj[key].applicationID == null){
                                     applicationNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationNameDataText = data.transactionSearchDataObj[key].applicationID;
                                }

                                if( data.transactionSearchDataObj[key].firstname == ''){
                                     transactionNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    transactionNameDataText = data.transactionSearchDataObj[key].firstname+' '+data.transactionSearchDataObj[key].middlename+' '+data.transactionSearchDataObj[key].lastname;
                                }  

                                if( data.transactionSearchDataObj[key].cardtypeName == null){
                                    cardTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    cardTypeDataText = data.transactionSearchDataObj[key].cardtypeName;
                                }

                                if( data.transactionSearchDataObj[key].created_at == null){
                                    transcationDate = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    transcationDate = data.transactionSearchDataObj[key].created_at;
                                }

                                if( data.transactionSearchDataObj[key].totalfees == null){
                                    totalfee = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    totalfee = data.transactionSearchDataObj[key].totalfees;
                                }

                                if( data.transactionSearchDataObj[key].byafees == null){
                                    paidamount = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    paidamount = data.transactionSearchDataObj[key].byafees;
                                }

                                if( data.transactionSearchDataObj[key].restfees == null){
                                    restamount = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    restamount = data.transactionSearchDataObj[key].restfees;
                                }

                                if( data.transactionSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.transactionSearchDataObj[key].eUserId +"/') !!}' >"+ data.transactionSearchDataObj[key].employeeFirstname+' '+data.transactionSearchDataObj[key].employeeMiddlename+' '+data.transactionSearchDataObj[key].employeeLastname+' (User Id:- '+data.transactionSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.transactionSearchDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/transaction/"+ data.transactionSearchDataObj[key].transactionID +"/') !!}' >"+ data.transactionSearchDataObj[key].transactionID +"</a></td><td><a href='{!! URL::to('employee/transaction/"+ data.transactionSearchDataObj[key].transactionID +"/') !!}' >"+ transactionNameDataText +"</a></td><td><a href='{!! URL::to('employee/application/"+ data.transactionSearchDataObj[key].applicationId +"/') !!}' >"+ applicationNameDataText +"</a></td><td>"+ transcationDate +"</td><td>"+ totalfee +"</td><td>"+ paidamount +"</td><td>"+ restamount +"</td><td>"+ cardTypeDataText +"</td><td>"+ paymentStatusDataText +"</td><td>"+ lastUpdatedBy +" </td></tr>");
                                
                            });

                            /*<td><a href='{!! URL::to('employee/transaction/"+ data.transactionSearchDataObj[key].transactionID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td>*/

                            //Create html pagination desgin
                            if( data.transactionSearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.transactionSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.transactionSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.transactionSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.transactionSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.transactionSearchDataObj1; i++){
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

                            if(data.transactionSearchDataObj1 == 1){
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
                    url: "{{ URL::to('search/employee-all-transaction') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Name</td><td class='searchFilter'>Application No</td><td class='searchFilter'>Transaction Date</td><td class='searchFilter'>Total Fee</td><td class='searchFilter'>Paid Amount</td><td class='searchFilter'>Rest Amount</td><td class='searchFilter'>Card Type</td><td class='searchFilter'>Payment Status</td><td class='searchFilter'>Last Updated By</td></tr>");

                       /*<td class='searchFilter'>Actions</td>*/

                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var transactionNameDataText;
                            var applicationNameDataText;
                            var paymentStatusDataText;
                            var cardTypeDataText;
                            var lastUpdatedBy;
                            var transcationDate;
                            var totalfee;
                            var paidamount;
                            var restamount;

                            $.each(data, function (key, item) {

                               if( data[key].paymentstatusName == null){
                                     paymentStatusDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    paymentStatusDataText = data[key].paymentstatusName;
                                }

                                if( data[key].applicationID == null){
                                     applicationNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationNameDataText = data[key].applicationID;
                                }

                                if( data[key].firstname == ''){
                                     transactionNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    transactionNameDataText = data[key].firstname+' '+data[key].middlename+' '+data[key].lastname;
                                }  


                                if( data[key].cardtypeName == null){
                                    cardTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    cardTypeDataText = data[key].cardtypeName;
                                }

                                if( data[key].created_at == null){
                                    transcationDate = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    transcationDate = data[key].created_at;
                                }

                                if( data[key].totalfees == null){
                                    totalfee = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    totalfee = data[key].totalfees;
                                }

                                if( data[key].byafees == null){
                                    paidamount = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    paidamount = data[key].byafees;
                                }

                                if( data[key].restfees == null){
                                    restamount = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    restamount = data[key].restfees;
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/transaction/"+ data[key].transactionID +"/') !!}' >"+ data[key].transactionID +"</a></td><td><a href='{!! URL::to('employee/transaction/"+ data[key].transactionID +"/') !!}' >"+ transactionNameDataText +"</a></td><td><a href='{!! URL::to('employee/application/"+ data[key].applicationId +"/') !!}' >"+ applicationNameDataText +"</a></td><td>"+ transcationDate +"</td><td>"+ totalfee +"</td><td>"+ paidamount +"</td><td>"+ restamount +"</td><td>"+ cardTypeDataText +"</td><td>"+ paymentStatusDataText +"</td><td>"+ lastUpdatedBy +" </td></tr>");

                                /*<td><a href='{!! URL::to('employee/transaction/"+ data[key].transactionID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td>*/
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

            var transactionName = $('.transactionName').val();
            var applicationName = $('.applicationName').val();
            var paymentStatus = $('.paymentStatus').val();
            var cardType = $('.cardType').val();

            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/employee-transaction') }}",
                    data     : { transactionName: transactionName, paymentStatus: paymentStatus , applicationName:applicationName,cardType:cardType, currentNode: currentNode },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Name</td><td class='searchFilter'>Application No</td><td class='searchFilter'>Transaction Date</td><td class='searchFilter'>Total Fee</td><td class='searchFilter'>Paid Amount</td><td class='searchFilter'>Rest Amount</td><td class='searchFilter'>Card Type</td><td class='searchFilter'>Payment Status</td><td class='searchFilter'>Last Updated By</td></tr>");

                       /*<td class='searchFilter'>Actions</td>*/

                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var transactionNameDataText;
                            var applicationNameDataText;
                            var paymentStatusDataText;
                            var cardTypeDataText;
                            var lastUpdatedBy;
                            var transcationDate;
                            var totalfee;
                            var paidamount;
                            var restamount;

                            $.each(data.transactionSearchDataObj, function (key, item) {

                               if( data.transactionSearchDataObj[key].paymentstatusName == null){
                                     paymentStatusDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    paymentStatusDataText = data.transactionSearchDataObj[key].paymentstatusName;
                                }

                                if( data.transactionSearchDataObj[key].applicationID == null){
                                     applicationNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    applicationNameDataText = data.transactionSearchDataObj[key].applicationID;
                                }

                                if( data.transactionSearchDataObj[key].firstname == ''){
                                     transactionNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    transactionNameDataText = data.transactionSearchDataObj[key].firstname+' '+data.transactionSearchDataObj[key].middlename+' '+data.transactionSearchDataObj[key].lastname;
                                }  


                                if( data.transactionSearchDataObj[key].cardtypeName == null){
                                    cardTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    cardTypeDataText = data.transactionSearchDataObj[key].cardtypeName;
                                }

                                if( data.transactionSearchDataObj[key].created_at == null){
                                    transcationDate = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    transcationDate = data.transactionSearchDataObj[key].created_at;
                                }

                                if( data.transactionSearchDataObj[key].totalfees == null){
                                    totalfee = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    totalfee = data.transactionSearchDataObj[key].totalfees;
                                }

                                if( data.transactionSearchDataObj[key].byafees == null){
                                    paidamount = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    paidamount = data.transactionSearchDataObj[key].byafees;
                                }

                                if( data.transactionSearchDataObj[key].restfees == null){
                                    restamount = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    restamount = data.transactionSearchDataObj[key].restfees;
                                }

                                if( data.transactionSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.transactionSearchDataObj[key].eUserId +"/') !!}' >"+ data.transactionSearchDataObj[key].employeeFirstname+' '+data.transactionSearchDataObj[key].employeeMiddlename+' '+data.transactionSearchDataObj[key].employeeLastname+' (User Id:- '+data.transactionSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.transactionSearchDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/transaction/"+ data.transactionSearchDataObj[key].transactionID +"/') !!}' >"+ data.transactionSearchDataObj[key].transactionID +"</a></td><td><a href='{!! URL::to('employee/transaction/"+ data.transactionSearchDataObj[key].transactionID +"/') !!}' >"+ transactionNameDataText +"</a></td><td><a href='{!! URL::to('employee/application/"+ data.transactionSearchDataObj[key].applicationId +"/') !!}' >"+ applicationNameDataText +"</a></td><td>"+ transcationDate +"</td><td>"+ totalfee +"</td><td>"+ paidamount +"</td><td>"+ restamount +"</td><td>"+ cardTypeDataText +"</td><td>"+ paymentStatusDataText +"</td><td>"+ lastUpdatedBy +" </td></tr>");
                            });

                            /*<td><a href='{!! URL::to('employee/transaction/"+ data.transactionSearchDataObj[key].transactionID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td>*/

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
                                    if( data.transactionSearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.transactionSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.transactionSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.transactionSearchDataObj1; i++){
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
                                if( data.transactionSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.transactionSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.transactionSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.transactionSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.transactionSearchDataObj1; i++){
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













