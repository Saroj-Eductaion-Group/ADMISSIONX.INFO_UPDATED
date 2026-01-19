@extends('employee/admin-layouts.master')

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Address Details <a href="{{ url('employee/address/create') }}" class="btn btn-primary pull-right btn-sm">Add New Address</a></h2>
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
                        {!! Form::open(['url' => 'search/employee-address', 'class' => 'form-horizontal search-form search-form', 'data-parsley-validate' => '']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Address Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control addressName" name="addressName" placeholder="Enter address here" data-parsley-error-message="Please enter valid address" data-parsley-trigger="change">        
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeprofile_id" name="collegeprofile_id" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                                <option value="" disabled="" selected="">Select college</option>
                                                    @foreach( $collegeProfileObj as $college )
                                                        @if( $college->userRoleId == '2')
                                                        <option value="{{ $college->firstname }}">{{ $college->firstname }}</option>
                                                        @endif
                                                    @endforeach
                                            </select> 
                                        </div> 
                                        <div class="col-md-4">
                                            <h4 for="usr">Student Name<span class="pull-right"><a href="javascript:void(0);" id="refresh8" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select studentprofile_id" name="collegeprofile_id" data-parsley-trigger="change" data-parsley-error-message="Please select student">
                                                <option value="" disabled="" selected="">Select student</option>
                                                    @foreach( $collegeProfileObj as $student )
                                                        @if( $student->userRoleId == '3') 
                                                        <option value="{{ $student->firstname }}">{{ $student->firstname }}</option>
                                                        @endif
                                                    @endforeach
                                            </select> 
                                        </div> 
                                        <div class="col-md-4">
                                            <h4>Postal Code<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control postalCode" name="postalCode" placeholder="Enter postal code here" data-parsley-error-message="Please enter valid postal code" data-parsley-trigger="change"  data-parsley-type ="number">        
                                        </div>                                             
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">Address Type<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select addresstype_id" name="addresstype_id" data-parsley-trigger="change" data-parsley-error-message="Please select address type" required="">
                                                <option value="" disabled="" selected="">Select address type</option>
                                                @foreach( $addressTypeObj as $addressType )
                                                    <option value="{{ $addressType->id }}">{{ $addressType->name }}</option>
                                                @endforeach
                                            </select> 
                                        </div> 
                                       
                                        <div class="col-md-4">
                                            <h4 for="usr">Select State<span class="pull-right"><a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="stateName" class="form-control chosen-select stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select your state" required="">
                                                <option value="" selected disabled>Select state</option>  
                                                @foreach ($stateNameObj as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach         
                                            </select> 
                                        </div>
                                      
                                        <div class="col-md-4">
                                            <h4 for="usr">City<span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select city_id cityName" name="city_id" data-parsley-trigger="change" data-parsley-error-message="Please select city">
                                                 <option value="" disabled="" selected="">Select city</option>
                                                <!-- @foreach( $cityNameObj as $city )
                                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                @endforeach -->
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">      
                                            <a href="{{ URL::to('employee/address') }}" class="btn btn-default btn-sm">Close</a>
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
                        @if( $address == '0' )
                            <input type="text" class="result-zero hide" value="{{ $address }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Address Type</th>
                                    <th>Name</th>
                                    <th>Address-1</th>
                                    <th>Address-2</th>
                                    <th>Postal Code</th>
                                    
                                    <th>City</th>
                                    <th>Student Profile</th>
                                    <th>College Profile</th>
                                    <th>Last Updated By</th>
                                    @if($storeEditUpdateAction == '1')
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($address as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('employee/address', $item->id) }}">{{ $item->id }}</a></td>
                                    <td>
                                        @if( !empty($item->addressType) )
                                           <a href="{{ url('employee/address', $item->id) }}">{{ $item->addressType }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( !empty($item->name) )
                                           <a href="{{ url('employee/address', $item->id) }}">{{ $item->name }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->address1 )
                                           {{ $item->address1 }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->address2 )
                                           {{ $item->address2 }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->postalcode )
                                           {{ $item->postalcode }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->cityName )
                                           {{ $item->cityName }}, <label>State :-</label> {{ $item->stateName }},<label> Country :-</label> {{ $item->countryName }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( !empty($item->studentUserID) )
                                            <a href="{{ url('employee/users', $item->studentUserID) }}">{{ $item->studentUserFirstName }} {{ $item->studentUserLastName }}</a>
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>
                                        @if( !empty($item->collegeUserID) )
                                            <a href="{{ url('employee/users', $item->collegeUserID) }}">{{ $item->collegeUserFirstName }} </a>
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    @if($storeEditUpdateAction == '1')
                                    <td>
                                        <a href="{{ url('employee/address/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a><!--  /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['employee/address', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!} -->
                                        {!! Form::close() !!}
                                    </td> 
                                    @endif
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $address->render() !!}</div>
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

            $('.collegeprofile_id').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.collegeprofile_id').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });

            $('.addressName').on('keydown',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.addressName').val('');
                $('#refresh2').addClass('hide');
            });

            $('.postalCode').on('keydown',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.postalCode').val('');
                $('#refresh4').addClass('hide');
            });

            $('.addresstype_id').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.addresstype_id').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.city_id').on('change',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh5').addClass('hide');
            });

            $('.stateName').on('change',function(){
                $('#refresh6').removeClass('hide');
            });
            $('#refresh6').on('click',function(e){
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh6').addClass('hide');
            });

             $('.studentprofile_id').on('change',function(){
                $('#refresh8').removeClass('hide');
            });
            $('#refresh8').on('click',function(e){
                $('.studentprofile_id').val('').trigger('chosen:updated');
                $('#refresh8').addClass('hide');
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

                        $(".thead").append("<tr><td class='searchFilter'>Id </td><td class='searchFilter'>Address Type</td><td class='searchFilter'>Name</td><td class='searchFilter'>Address-1</td><td class='searchFilter'>Address-2</td><td class='searchFilter'>Postal Code</td><td class='searchFilter'>City</td><td class='searchFilter'>Student Profile</td> <td class='searchFilter'>College Profile</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
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

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            var addressTypeDataText;
                            var addressNameDataText;
                            var addressDataText1;
                            var addressDataText2;
                            var postalCodeDataText;
                            var cityDataText;
                            var studentProfileDataText;
                            var collegeProfileDataText;
                            var lastUpdatedBy;
                           
                            $.each(data.addressSearchDataObj, function (key, item) {

                                if( data.addressSearchDataObj[key].addressType == null ){
                                    addressTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressTypeDataText = data.addressSearchDataObj[key].addressType;
                                }

                                if( data.addressSearchDataObj[key].addressName == ''){
                                    addressNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressNameDataText = data.addressSearchDataObj[key].addressName;
                                }

                                if( data.addressSearchDataObj[key].address1 == '' ){
                                    addressDataText1 = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressDataText1 = data.addressSearchDataObj[key].address1;
                                }

                                if( data.addressSearchDataObj[key].address2 == '' ){
                                    addressDataText2 = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressDataText2 = data.addressSearchDataObj[key].address2;
                                }

                                if( data.addressSearchDataObj[key].postalcode == '' ){
                                    postalCodeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    postalCodeDataText = data.addressSearchDataObj[key].postalcode;
                                }

                                if( data.addressSearchDataObj[key].cityName == null ){
                                    cityDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    //cityDataText = data.addressSearchDataObj[key].cityName;
                                    cityDataText = data.addressSearchDataObj[key].cityName +', <strong>State :- </strong>'+data.addressSearchDataObj[key].stateName+', <strong>Country :- </strong>'+data.addressSearchDataObj[key].countryName;
                                }

                                if( data.addressSearchDataObj[key].studentUserFirstName == null ){
                                    studentProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentProfileDataText = data.addressSearchDataObj[key].studentUserFirstName;
                                }

                                if( data.addressSearchDataObj[key].collegeUserFirstName == null ){
                                    collegeProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeProfileDataText = data.addressSearchDataObj[key].collegeUserFirstName;
                                }

                                if( data.addressSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.addressSearchDataObj[key].eUserId +"/') !!}' >"+ data.addressSearchDataObj[key].employeeFirstname+' '+data.addressSearchDataObj[key].employeeMiddlename+' '+data.addressSearchDataObj[key].employeeLastname+' (User Id:- '+data.addressSearchDataObj[key].eUserId+')<hr> Date & Time :- '+data.addressSearchDataObj[key].updated_at +"</a>";
                                }
                               
                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/address/"+ data.addressSearchDataObj[key].addressId +"/') !!}' >"+ data.addressSearchDataObj[key].addressId +"</a></td><td><a href='{!! URL::to('employee/address/"+ data.addressSearchDataObj[key].addressId +"/') !!}' >"+ addressTypeDataText +"</a></td><td>"+ addressNameDataText +"</td><td>"+ addressDataText1 +"</td> <td>"+ addressDataText2 +"</td> <td>"+ postalCodeDataText +"</td> <td>"+ cityDataText +"</td><td><a href='{!! URL::to('employee/users/"+ data.addressSearchDataObj[key].studentUserID +"/') !!}' >"+ studentProfileDataText +"</a></td> <td><a href='{!! URL::to('employee/users/"+ data.addressSearchDataObj[key].collegeUserID +"/') !!}' >"+ collegeProfileDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/address/"+ data.addressSearchDataObj[key].addressId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.addressSearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.addressSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.addressSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.addressSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.addressSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.addressSearchDataObj1; i++){
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

                            if(data.addressSearchDataObj == 1){
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
                $('#refresh8').addClass('hide');
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
                    url: "{{ URL::to('search/employee-all-address') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id </td><td class='searchFilter'>Address Type</td><td class='searchFilter'>Name</td><td class='searchFilter'>Address-1</td><td class='searchFilter'>Address-2</td><td class='searchFilter'>Postal Code</td><td class='searchFilter'>City</td><td class='searchFilter'>Student Profile</td> <td class='searchFilter'>College Profile</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{

                            var addressTypeDataText;
                            var addressNameDataText;
                            var addressDataText1;
                            var addressDataText2;
                            var postalCodeDataText;
                            var cityDataText;
                            var studentProfileDataText;
                            var collegeProfileDataText;
                            var lastUpdatedBy;

                            $.each(data, function (key, item) {

                               if( data[key].addressType == null ){
                                    addressTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressTypeDataText = data[key].addressType;
                                }

                                if( data[key].addressName == ''){
                                    addressNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressNameDataText = data[key].addressName;
                                }

                                if( data[key].address1 == '' ){
                                    addressDataText1 = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressDataText1 = data[key].address1;
                                }

                                if( data[key].address2 == '' ){
                                    addressDataText2 = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressDataText2 = data[key].address2;
                                }

                                if( data[key].postalcode == '' ){
                                    postalCodeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    postalCodeDataText = data[key].postalcode;
                                }

                                if( data[key].cityName == null ){
                                    cityDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    //cityDataText = data[key].cityName;
                                    cityDataText = data[key].cityName +', <strong>State :- </strong>'+data[key].stateName+', <strong>Country :- </strong>'+data[key].countryName;
                                }

                                if( data[key].studentUserFirstName == null ){
                                    studentProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentProfileDataText = data[key].studentUserFirstName;
                                }

                                if( data[key].collegeUserFirstName == null ){
                                    collegeProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeProfileDataText = data[key].collegeUserFirstName;
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+')<hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }
                               
                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/address/"+ data[key].addressId +"/') !!}' >"+ data[key].addressId +"</a></td><td><a href='{!! URL::to('employee/address/"+ data[key].addressId +"/') !!}' >"+ addressTypeDataText +"</a></td><td>"+ addressNameDataText +"</td><td>"+ addressDataText1 +"</td> <td>"+ addressDataText2 +"</td> <td>"+ postalCodeDataText +"</td> <td>"+ cityDataText +"</td><td><a href='{!! URL::to('employee/users/"+ data[key].studentUserID +"/') !!}' >"+ studentProfileDataText +"</a></td> <td><a href='{!! URL::to('employee/users/"+ data[key].collegeUserID +"/') !!}' >"+ collegeProfileDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/address/"+ data[key].addressId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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

            var addresstype_id = $('.addresstype_id').val();
            var collegeprofile_id = $('.collegeprofile_id').val();
            var addressName = $('.addressName').val();
            var postalCode = $('.postalCode').val();
            var city_id = $('.city_id').val();
            var stateName = $('.stateName').val();

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
                    url      : "{{ URL::to('search/employee-address') }}",
                    data     : { currentNode:currentNode,addresstype_id:addresstype_id, collegeprofile_id: collegeprofile_id, addressName: addressName,postalCode:postalCode, city_id: city_id, stateName:stateName  },
                    dataType : "json",
                    success: function(data) {
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id </td><td class='searchFilter'>Address Type</td><td class='searchFilter'>Name</td><td class='searchFilter'>Address-1</td><td class='searchFilter'>Address-2</td><td class='searchFilter'>Postal Code</td><td class='searchFilter'>City</td><td class='searchFilter'>Student Profile</td> <td class='searchFilter'>College Profile</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.message-no-match').removeClass('hide');
                            $('.exportToExcel').addClass('hide');
                            //$('.nextFilter').hide();
                        }else{

                            var addressTypeDataText;
                            var addressNameDataText;
                            var addressDataText1;
                            var addressDataText2;
                            var postalCodeDataText;
                            var cityDataText;
                            var studentProfileDataText;
                            var collegeProfileDataText;
                            var lastUpdatedBy;

                            $.each(data.addressSearchDataObj, function (key, item) {

                               if( data.addressSearchDataObj[key].addressType == null ){
                                    addressTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressTypeDataText = data.addressSearchDataObj[key].addressType;
                                }

                                if( data.addressSearchDataObj[key].addressName == ''){
                                    addressNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressNameDataText = data.addressSearchDataObj[key].addressName;
                                }

                                if( data.addressSearchDataObj[key].address1 == '' ){
                                    addressDataText1 = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressDataText1 = data.addressSearchDataObj[key].address1;
                                }

                                if( data.addressSearchDataObj[key].address2 == '' ){
                                    addressDataText2 = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    addressDataText2 = data.addressSearchDataObj[key].address2;
                                }

                                if( data.addressSearchDataObj[key].postalcode == '' ){
                                    postalCodeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    postalCodeDataText = data.addressSearchDataObj[key].postalcode;
                                }

                                if( data.addressSearchDataObj[key].cityName == null ){
                                    cityDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                   // cityDataText = data.addressSearchDataObj[key].cityName;
                                    cityDataText = data.addressSearchDataObj[key].cityName +', <strong>State :- </strong>'+data.addressSearchDataObj[key].stateName+', <strong>Country :- </strong>'+data.addressSearchDataObj[key].countryName;
                                }

                                if( data.addressSearchDataObj[key].studentUserFirstName == null ){
                                    studentProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    studentProfileDataText = data.addressSearchDataObj[key].studentUserFirstName;
                                }

                                if( data.addressSearchDataObj[key].collegeUserFirstName == null ){
                                    collegeProfileDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeProfileDataText = data.addressSearchDataObj[key].collegeUserFirstName;
                                }

                                if( data.addressSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.addressSearchDataObj[key].eUserId +"/') !!}' >"+ data.addressSearchDataObj[key].employeeFirstname+' '+data.addressSearchDataObj[key].employeeMiddlename+' '+data.addressSearchDataObj[key].employeeLastname+' (User Id:- '+data.addressSearchDataObj[key].eUserId+')<hr> Date & Time :- '+data.addressSearchDataObj[key].updated_at +"</a>";
                                }
                               
                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/address/"+ data.addressSearchDataObj[key].addressId +"/') !!}' >"+ data.addressSearchDataObj[key].addressId +"</a></td><td><a href='{!! URL::to('employee/address/"+ data.addressSearchDataObj[key].addressId +"/') !!}' >"+ addressTypeDataText +"</a></td><td>"+ addressNameDataText +"</td><td>"+ addressDataText1 +"</td> <td>"+ addressDataText2 +"</td> <td>"+ postalCodeDataText +"</td> <td>"+ cityDataText +"</td><td><a href='{!! URL::to('employee/users/"+ data.addressSearchDataObj[key].studentUserID +"/') !!}' >"+ studentProfileDataText +"</a></td> <td><a href='{!! URL::to('employee/users/"+ data.addressSearchDataObj[key].collegeUserID +"/') !!}' >"+ collegeProfileDataText +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/address/"+ data.addressSearchDataObj[key].addressId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
                                    if( data.addressSearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.addressSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.addressSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.addressSearchDataObj1; i++){
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
                                if( data.addressSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.addressSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.addressSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.addressSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.addressSearchDataObj1; i++){
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
    $(document).ready(function(){   

        $('.stateName').on('change', function(){
            var stateId = $(this).val();
            var HTML = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { stateId: stateId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllCityNameData') }}",
                success: function(data) {
                    HTML += '<option disabled selected=""> Select City </option>'; 
                    $.each(data.cityData, function(key, value) {

                        HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
                    });
                    $('.cityName').html(HTML);
                    $('.cityName').trigger("chosen:updated");
                }
            });
        });
    });
</script>
@endsection














