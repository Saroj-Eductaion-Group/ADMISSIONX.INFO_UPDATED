@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>City Details <a href="{{ url('administrator/city/create') }}" class="btn btn-primary pull-right btn-sm">Add New City</a></h2>
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
                        {!! Form::open(['url' => 'search/city-name', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">Country Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="country_id" class="form-control chosen-select country_id">
                                                <option selected="" disabled="">Country</option>
                                                @if( $countryObj )
                                                    <option value="99">India</option>
                                                    @foreach( $countryObj as $item )
                                                        @if( $item->id == '99' )
                                                            <option value="99">{{ $item->name }}</option>
                                                        @else
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            
                                        </div> 
                                        <div class="col-md-4">
                                            <h4 for="usr">State Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="stateName" class="form-control chosen-select stateName" data-parsley-trigger="change" data-parsley-error-message="Please select state name">
                                                <option selected="" disabled="">Select state name</option>
                                                <!-- @if( $stateObj )
                                                    @foreach( $stateObj as $item )
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif -->
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 for="usr">City Name<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control cityName" name="cityName" placeholder="Enter city name here" data-parsley-error-message="Please enter city name" data-parsley-trigger="change">
                                        </div> 
                                        
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-4 text-right pull-right">      
                                            <a href="{{ URL::to('administrator/city') }}" class="btn btn-default btn-sm">Close</a>
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
                        @if( $city == '0' )
                            <input type="text" class="result-zero hide" value="{{ $city }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>City Name</th>
                                    <th>City Status</th>
                                    <th>State Name</th>
                                    <th>Country Name</th>
                                    <th>Last Updated By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($city as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('administrator/city', $item->id) }}">{{ $item->id }}</a></td>
                                    <td><a href="{{ url('administrator/city', $item->id) }}">{{ $item->name }}</a></td>
                                    <td>@if($item->cityStatus == '1') 
                                           <span class="label label-success">Active</span> 
                                        @else
                                           <span class="label label-warning">Inactive</span> 
                                        @endif
                                    </td>
                                    <td>{{ $item->stateName }}</td>
                                    <td>{{ $item->countryName }}</td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:-  {{ $item->updated_at}} </a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/city/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> <!-- /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['administrator/city', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!} -->
                                    </td>                      
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $city->render() !!}</div>
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

            $('.cityName').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.cityName').val('');
                $('#refresh2').addClass('hide');
            });
            

            $('.stateName').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });

            $('.country_id').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.country_id').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
                $('.stateName').val('').trigger('chosen:updated');
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
                        $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>City Name</td><td class='searchFilter'>City Status</td><td class='searchFilter'>State Name</td><td class='searchFilter'>Country Name</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                                
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

                            var cityNameDataText;
                            var stateDataText;
                            var cityStatusText;
                            var lastUpdatedBy;
                            var countryDataText;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.citySearchDataObj, function (key, item) {

                                if( data.citySearchDataObj[key].stateName == ''){
                                     stateDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    stateDataText = data.citySearchDataObj[key].stateName;
                                }

                                if( data.citySearchDataObj[key].name == ''){
                                     cityNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    cityNameDataText = data.citySearchDataObj[key].name;
                                }

                                if( data.citySearchDataObj[key].countryName == ''){
                                     countryDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    countryDataText = data.citySearchDataObj[key].countryName;
                                }

                                if( data.citySearchDataObj[key].cityStatus == '1'){
                                     cityStatusText = '<strong class="label label-success">Active</strong>';
                                }else{
                                    cityStatusText = '<strong class="label label-warning">Inactive</strong>';
                                }

                                if( data.citySearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.citySearchDataObj[key].eUserId +"/') !!}' >"+ data.citySearchDataObj[key].employeeFirstname+' '+data.citySearchDataObj[key].employeeMiddlename+' '+data.citySearchDataObj[key].employeeLastname+' (User Id:- '+data.citySearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.citySearchDataObj[key].updated_at +"</a>";
                                }
                               
                                
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/city/"+ data.citySearchDataObj[key].cityID +"/') !!}' >"+ data.citySearchDataObj[key].cityID +"</a></td><td><a href='{!! URL::to('administrator/city/"+ data.citySearchDataObj[key].cityID +"/') !!}' >"+ cityNameDataText +"</a></td><td>"+ cityStatusText +"</td><td>"+ stateDataText +"</td><td>"+ countryDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/city/"+ data.citySearchDataObj[key].cityID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.citySearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.citySearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.citySearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.citySearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.citySearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.citySearchDataObj1; i++){
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

                            if(data.citySearchDataObj1 == 1){
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
                $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    method: "GET",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    url: "{{ URL::to('search/all-city-name') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>City Name</td><td class='searchFilter'>City Status</td><td class='searchFilter'>State Name</td><td class='searchFilter'>Country Name</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var cityNameDataText;
                            var stateDataText;
                            var cityStatusText;
                            var lastUpdatedBy;
                            var countryDataText;

                            $.each(data, function (key, item) {

                               if( data[key].stateName == ''){
                                     stateDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    stateDataText = data[key].stateName;
                                }

                                if( data[key].name == ''){
                                     cityNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    cityNameDataText = data[key].name;
                                }

                                if( data[key].countryName == ''){
                                     countryDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    countryDataText = data[key].countryName;
                                }

                                if( data[key].cityStatus == '1'){
                                     cityStatusText = '<strong class="label label-success">Active</strong>';
                                }else{
                                    cityStatusText = '<strong class="label label-warning">Inactive</strong>';
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }
                                
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/city/"+ data[key].cityID +"/') !!}' >"+ data[key].cityID +"</a></td><td><a href='{!! URL::to('administrator/city/"+ data[key].cityID +"/') !!}' >"+ cityNameDataText +"</a></td><td>"+ cityStatusText +"</td><td>"+ stateDataText +"</td><td>"+ countryDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/city/"+ data[key].cityID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");

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

            var cityName = $('.cityName').val();
            var stateName = $('.stateName').val();
            var country_id = $('.country_id').val();
                      
            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/city-name') }}",
                    data     : { cityName: cityName,  stateName:stateName, currentNode: currentNode, country_id: country_id},
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>City Name</td><td class='searchFilter'>City Status</td><td class='searchFilter'>State Name</td><td class='searchFilter'>Country Name</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var cityNameDataText;
                            var stateDataText;
                            var cityStatusText;
                            var lastUpdatedBy;
                            var countryDataText;

                            $.each(data.citySearchDataObj, function (key, item) {

                               if( data.citySearchDataObj[key].stateName == ''){
                                     stateDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    stateDataText = data.citySearchDataObj[key].stateName;
                                }

                                if( data.citySearchDataObj[key].name == ''){
                                     cityNameDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    cityNameDataText = data.citySearchDataObj[key].name;
                                }

                                if( data.citySearchDataObj[key].countryName == ''){
                                     countryDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    countryDataText = data.citySearchDataObj[key].countryName;
                                }
                                

                                if( data.citySearchDataObj[key].cityStatus == '1'){
                                     cityStatusText = '<strong class="label label-success">Active</strong>';
                                }else{
                                    cityStatusText = '<strong class="label label-warning">Inactive</strong>';
                                }

                                if( data.citySearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.citySearchDataObj[key].eUserId +"/') !!}' >"+ data.citySearchDataObj[key].employeeFirstname+' '+data.citySearchDataObj[key].employeeMiddlename+' '+data.citySearchDataObj[key].employeeLastname+' (User Id:- '+data.citySearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.citySearchDataObj[key].updated_at +"</a>";
                                }
                                
                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/city/"+ data.citySearchDataObj[key].cityID +"/') !!}' >"+ data.citySearchDataObj[key].cityID +"</a></td><td><a href='{!! URL::to('administrator/city/"+ data.citySearchDataObj[key].cityID +"/') !!}' >"+ cityNameDataText +"</a></td><td>"+ cityStatusText +"</td><td>"+ stateDataText +"</td><td>"+ countryDataText +"</td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('administrator/city/"+ data.citySearchDataObj[key].cityID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
                                    if( data.citySearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.citySearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.citySearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.citySearchDataObj1; i++){
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
                                if( data.citySearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.citySearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.citySearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.citySearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.citySearchDataObj1; i++){
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
        $('select[name=country_id]').on('change', function(){
            var countryID = $(this).val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {countryID: countryID},
                url: "{{ URL::to('getAllStateName') }}",
                success: function(data) {
                    var HTML = '';
                    HTML += '<option selected="" disabled="">State</option>';
                    if( data.code == '200' ){
                        $.each(data.stateObj, function(i, item) {
                            HTML += '<option value="'+data.stateObj[i].stateId+'">'+data.stateObj[i].name+'</option>';
                        }); 
                    }else{
                        HTML += '<option selected="" disabled="">No state available</option>';
                    }

                    $('select[name="stateName"]').empty();
                    $('select[name="stateName"]').html(HTML);
                    $('select[name="stateName"]').trigger('chosen:updated');
                }
            });
        });

        $('select[name=stateName]').on('change', function(){
            var currentID = $(this).val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {currentID: currentID},
                url: "{{ URL::to('getAllCityName') }}",
                success: function(data) {
                    var HTML = '';
                    HTML += '<option selected="" disabled="">City</option>';
                    if( data.code == '200' ){
                        $.each(data.cityObj, function(i, item) {
                            HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
                        }); 
                    }else{
                        HTML += '<option selected="" disabled="">No city available</option>';
                    }

                    $('select[name="city_id"]').empty();
                    $('select[name="city_id"]').html(HTML);
                    $('select[name="city_id"]').trigger('chosen:updated');
                }
            });
        });
    </script>

    @endsection













