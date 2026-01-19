@extends('employee/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Blogs Details <a href="{{ url('employee/blogs/create') }}" class="btn btn-primary pull-right btn-sm">Add New Blogs</a></h2>
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
                        {!! Form::open(['url' => 'search/employee-blogs', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">Topic<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control topic" name="topic" placeholder="Enter topic here" data-parsley-error-message="Please enter topic" data-parsley-trigger="change">
                                        </div>  
                                        
                                        <div class="col-md-4">
                                            <h4 for="usr">Author Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeName" name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select author">
                                                <option value="" disabled="" selected="">Select author</option>
                                                @foreach( $usersObj as $college )
                                                    <option value="{{ $college->firstname }}">{{ $college->firstname }} {{ $college->middlename }} {{ $college->lastname }}</option>
                                                @endforeach
                                            </select> 
                                        </div> 
                                        
                                         <div class="col-md-4">                                    
                                            <h4 for="usr">Publish or Not<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select name="isactive" class="form-control isactive chosen-select" data-placeholder="Choose isactive ..."  data-parsley-error-message=" Please select publish or not " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select..</option>
                                                <option value="1">Published</option>
                                                <option value="0">Not Published</option>
                                            </select>                            
                                        </div>    
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('employee/blogs') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class=""> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $blogs == '0' )
                            <input type="text" class="result-zero hide" value="{{ $blogs }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Topic </th>
                                    <!-- <th>Description</th> -->
                                    <th>Publish or Not</th>
                                    <th>Author</th>
                                    <th>Last Updated By</th>
                                    @if($storeEditUpdateAction == '1')
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($blogs as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('employee/blogs', $item->id) }}">{{ $item->id }}</a></td>
                                    <td><a href="{{ url('employee/blogs', $item->id) }}">{{ $item->topic }}</a></td>
                                    <!-- <td>{{ str_limit($item->description, $limit = 100, $end = '...') }}</td> -->
                                    <td>
                                        @if( $item->isactive == '1' )
                                            <span class="label label-success">Published</span>
                                        @else
                                            <span class="label label-danger">Not Published</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ url('employee/users', $item->userID ) }}">{{ $item->firstname }} {{ $item->lastname }}</a></td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('employee/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    @if($storeEditUpdateAction == '1')
                                    <td>
                                        <a href="{{ url('employee/blogs/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a><!--  /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['employee/blogs', $item->id],
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
                                <div class="pull-right custom-pagination">{!! $blogs->render() !!}</div>
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

            $('.topic').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.topic').val('');
                $('#refresh2').addClass('hide');
            });

            $('.collegeName').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.collegeName').val('').trigger('chosen:updated');
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
                        $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Topic</td><td class='searchFilter'>Publish or Not</td><td class='searchFilter'>Author</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                                
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
                            var topicsDataText;
                            var lastUpdatedBy;

                            $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });

                            $.each(data.blogsSearchDataObj, function (key, item) {

                                if( data.blogsSearchDataObj[key].topic == ''){
                                     topicsDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    topicsDataText = data.blogsSearchDataObj[key].topic;
                                }

                                if( data.blogsSearchDataObj[key].isactive == null){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.blogsSearchDataObj[key].isactive == '1' ){
                                        verifyDataText = '<span class="label label-success">'+ "Published" +'</span>';
                                    }else{
                                        verifyDataText = '<span class="label label-danger">'+ "Not Published" +'</span>';
                                    }
                                }

                                if( data.blogsSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.blogsSearchDataObj[key].eUserId +"/') !!}' >"+ data.blogsSearchDataObj[key].employeeFirstname+' '+data.blogsSearchDataObj[key].employeeMiddlename+' '+data.blogsSearchDataObj[key].employeeLastname+' (User Id:- '+data.blogsSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.blogsSearchDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/blogs/"+ data.blogsSearchDataObj[key].blogsId +"/') !!}' >"+ data.blogsSearchDataObj[key].blogsId +"</a></td><td><a href='{!! URL::to('employee/blogs/"+ data.blogsSearchDataObj[key].blogsId +"/') !!}' >"+ topicsDataText +"</a></td><td>"+ verifyDataText +"</td><td><a href='{!! URL::to('employee/user/"+ data.blogsSearchDataObj[key].userID +"/') !!}' >"+ data.blogsSearchDataObj[key].firstname +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/blogs/"+ data.blogsSearchDataObj[key].blogsId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.blogsSearchDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.blogsSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.blogsSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.blogsSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.blogsSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.blogsSearchDataObj1; i++){
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

                            if(data.blogsSearchDataObj1 == 1){
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
                    url: "{{ URL::to('search/employee-all-blogs') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Topic</td><td class='searchFilter'>Publish or Not</td><td class='searchFilter'>Author</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var verifyDataText;
                            var topicsDataText;
                            var lastUpdatedBy;
                            $.each(data, function (key, item) {

                               if( data[key].topic == ''){
                                     topicsDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    topicsDataText = data[key].topic;
                                }

                                if( data[key].isactive == null){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data[key].isactive == '1' ){
                                        verifyDataText = '<span class="label label-success">'+ "Published" +'</span>';
                                    }else{
                                        verifyDataText = '<span class="label label-danger">'+ "Not Published" +'</span>';
                                    }
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/blogs/"+ data[key].blogsId +"/') !!}' >"+ data[key].blogsId +"</a></td><td><a href='{!! URL::to('employee/blogs/"+ data[key].blogsId +"/') !!}' >"+ topicsDataText +"</a></td><td>"+ verifyDataText +"</td><td><a href='{!! URL::to('employee/user/"+ data[key].userID +"/') !!}' >"+ data[key].firstname +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/blogs/"+ data[key].blogsId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
            var topic = $('.topic').val();
            var isactive = $('.isactive').val();
            
            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/employee-blogs') }}",
                    data     : { collegeName: collegeName, isactive: isactive , topic:topic, currentNode: currentNode },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>Id</td><td class='searchFilter'>Topic</td><td class='searchFilter'>Publish or Not</td><td class='searchFilter'>Author</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var verifyDataText;
                            var topicsDataText;
                            var lastUpdatedBy;

                            $.each(data.blogsSearchDataObj, function (key, item) {

                               if( data.blogsSearchDataObj[key].topic == ''){
                                     topicsDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    topicsDataText = data.blogsSearchDataObj[key].topic;
                                }

                                if( data.blogsSearchDataObj[key].isactive == null){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.blogsSearchDataObj[key].isactive == '1' ){
                                        verifyDataText = '<span class="label label-success">'+ "Published" +'</span>';
                                    }else{
                                        verifyDataText = '<span class="label label-danger">'+ "Not Published" +'</span>';
                                    }
                                }

                                if( data.blogsSearchDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.blogsSearchDataObj[key].eUserId +"/') !!}' >"+ data.blogsSearchDataObj[key].employeeFirstname+' '+data.blogsSearchDataObj[key].employeeMiddlename+' '+data.blogsSearchDataObj[key].employeeLastname+' (User Id:- '+data.blogsSearchDataObj[key].eUserId+') <hr> Date & Time :- '+data.blogsSearchDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/blogs/"+ data.blogsSearchDataObj[key].blogsId +"/') !!}' >"+ data.blogsSearchDataObj[key].blogsId +"</a></td><td><a href='{!! URL::to('employee/blogs/"+ data.blogsSearchDataObj[key].blogsId +"/') !!}' >"+ topicsDataText +"</a></td><td>"+ verifyDataText +"</td><td><a href='{!! URL::to('employee/user/"+ data.blogsSearchDataObj[key].userID +"/') !!}' >"+ data.blogsSearchDataObj[key].firstname +"</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/blogs/"+ data.blogsSearchDataObj[key].blogsId +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
                                    if( data.blogsSearchDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.blogsSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.blogsSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.blogsSearchDataObj1; i++){
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
                                if( data.blogsSearchDataObj1 < 8 ){
                                    for(var i=2; i <= data.blogsSearchDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.blogsSearchDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.blogsSearchDataObj1-1;
                                    for(var i=lessTwo; i <= data.blogsSearchDataObj1; i++){
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







