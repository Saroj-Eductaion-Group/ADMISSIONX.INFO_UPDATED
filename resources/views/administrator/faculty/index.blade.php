
@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
         <!-- <h2>Faculty Details <a href="{{ url('administrator/faculty/create') }}" class="btn btn-primary pull-right btn-sm">Add New Faculty</a></h2> -->
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
                        <div class="col-md-6 col-md-offset-3">
                            @if(Session::has('noCollegeProfileAvail'))
                                <div class="alert alert-danger alert-dismissable text-center">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ Session::get('noCollegeProfileAvail') }}                        
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12 text-right">   
                            <!-- <a href="javascript:void(0);" class="btn btn-info exportToExcel hide">Export</a>   -->   
                            <a href="javascript:void(0);" class="btn btn-danger resetfilter hide">Reset Filter</a>     
                            <a href="javascript:void(0);" class="btn btn-primary filterout">Filter</a>
                        </div>
                    </div>
                    <div class="slideDown" style="visibility:hidden">
                         <div class="hr-line-dashed"></div>    
                        {!! Form::open(['url' => 'search/college-faculty', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4>Stream<span class="pull-right"> <a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select class="form-control chosen-select functionalarea_id" name="functionalarea_id" data-parsley-trigger="change" data-parsley-error-message="Please select stream">
                                                <option value="" disabled="" selected="">Select stream</option>
                                                @foreach( $functionalAreaObj as $functional )
                                                    <option value="{{ $functional->id }}">{{ $functional->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <h4 for="usr">Degree
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="degree_id" class="form-control degree_id chosen-select search-blocks-textbox" data-parsley-trigger="change" data-parsley-error-message="Please select degree"> 
                                                <option selected="" disabled="">Degree</option>
                                            </select>
                                        </div>    
                                        <div class="col-md-4">
                                            <h4 for="usr">Course
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="course_id" class="form-control course_id chosen-select search-blocks-textbox" data-parsley-trigger="change" data-parsley-error-message="Please select course">
                                                <option selected="" disabled="">Branch</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                     <div class="row">
                                        <div class="col-md-8">
                                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeName" name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                                <option value="" disabled="" selected="">Select college</option>
                                                @foreach( $collegeProfileObj as $college )
                                                    <option value="{{ $college->id }}">{{ $college->firstname }}</option>
                                                @endforeach
                                            </select> 
                                        </div>   
                                        <div class="col-md-4 text-right">      
                                            <a href="{{ URL::to('administrator/faculty') }}" class="btn btn-default btn-sm">Close</a>
                                            <button class="btn btn-primary btn-sm">Search</button>                                       
                                        </div>  
                                    </div>
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class="table-responsive"> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $faculty == '0' )
                            <input type="text" class="result-zero hide" value="{{ $faculty }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Course Detail</th>
                                    <th>College Name</th>
                                    <th>Last Updated By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($faculty as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('administrator/faculty', $item->id) }}">{{ $item->id }}</a></td>
                                    <td>        
                                        <a href="{{ url('administrator/faculty', $item->id) }}">
                                            @if( $item->name )
                                                {{ $item->suffix }} {{ $item->name }}
                                            @else
                                                --
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        @if( $item->description )
                                            {{ $item->description }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    
                                    <td>{{ $item->functionalareaName }} / {{ $item->degreeName }} / {{ $item->courseName }}</td>
                                   
                                    <td><a href="{{ URL('administrator/collegeprofile/'. $item->collegeprofileId) }}">{{ $item->firstname }}</a></td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('administrator/faculty/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> / <a href="{{ url('administrator/faculty', $item->id) }}"><button type="submit" class="btn btn-info btn-xs">Show</button></a>
                                        <!-- /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['administrator/faculty', $item->id],
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
                                <div class="pull-right custom-pagination">{!! $faculty->render() !!}</div>
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

            $('.addresstype_id').on('change', function(){
                var addressTypeId = $(this).val();
                $('.stateHide').css('visibility', 'visible');
            });


            $("#ionrange_1").ionRangeSlider({
                min: 0,
                max: 600000,
                type: 'double',
                prefix: "₹",
                maxPostfix: "+",
                prettify: false,
                hasGrid: true
            });
            
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
            
            

            $('.functionalarea_id').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.functionalarea_id').val('').trigger('chosen:updated');
                $('.course_id').val('').trigger('chosen:updated');
                $('.degree_id').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });

            $('.degree_id').on('change',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.degree_id').val('').trigger('chosen:updated');
                $('#refresh2').addClass('hide');
            });

            $('.course_id').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.course_id').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.collegeName').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.collegeName').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
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
                        $(".thead").append("<tr><td class='searchFilter'> Id</td><td class='searchFilter'>Name</td><td class='searchFilter'>Description</td><td class='searchFilter'>Course Detail</td><td class='searchFilter'>College Profile </td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                                    
                                
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

                            var facultyNameText;
                            var facultyDescriptionText;
                            var courseDetailsText;
                            var lastUpdatedBy;
                            var functionalAreaText;
                            var degreeDataText;
                            var courseDataText;

                           /* if( data.totalCountReturn > 0 ){
                                $('.returnHide').removeClass('hide');
                                $('#returnCountResult').text(data.totalCountReturn);    
                            }*/

                            if( data.getTotalCount[0].totalCount > 0 ){ 
                                $('.returnHide').removeClass('hide');
                                $('#returnCountResult').text(data.getTotalCount[0].totalCount);    
                            }
                            
                           /* $.each(data.getTotalCount, function (key, item) {
                                if( data.getTotalCount[key].totalCount > 0 ){
                                    $('.returnHide').removeClass('hide');
                                    $('#returnCountResult').text(data.getTotalCount[key].totalCount);    
                                }
                            });*/

                            $.each(data.facultyDataObj, function (key, item) {

                                if( data.facultyDataObj[key].facultyName == null){
                                    facultyNameText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        facultyNameText = data.facultyDataObj[key].facultyName;
                                } 

                                if( data.facultyDataObj[key].facultyDescription == null ){
                                    facultyDescriptionText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        facultyDescriptionText = data.facultyDataObj[key].facultyDescription;
                                }            
                                
                                if( data.facultyDataObj[key].functionalareaName == null){
                                    functionalAreaText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    functionalAreaText = data.facultyDataObj[key].functionalareaName;
                                }

                                if(data.facultyDataObj[key].degreeName == null ){
                                    degreeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    degreeDataText = data.facultyDataObj[key].degreeName;
                                }

                                if( data.facultyDataObj[key].courseName == null ){
                                    courseDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDataText = data.facultyDataObj[key].courseName;
                                }            
                               
                                if( data.facultyDataObj[key].collegemasterId == null){
                                    courseDetailsText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDetailsText = "<a class='' href='{!! URL::to('administrator/collegemaster/"+ data.facultyDataObj[key].collegemasterId +"/') !!}' >"+ functionalAreaText +' / '+ degreeDataText +' / '+ courseDataText + "</a>";
                                }

                                if( data.facultyDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.facultyDataObj[key].eUserId +"/') !!}' >"+ data.facultyDataObj[key].employeeFirstname+' '+data.facultyDataObj[key].employeeMiddlename+' '+data.facultyDataObj[key].employeeLastname+' (User Id:- '+data.facultyDataObj[key].eUserId+') <hr> Date & Time :- '+data.facultyDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/faculty/"+ data.facultyDataObj[key].facultyId +"/') !!}' >"+ data.facultyDataObj[key].facultyId +"</a></td><td>"+ facultyNameText +"</td><td>"+ facultyDescriptionText +"</td><td>"+ courseDetailsText +"</td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.facultyDataObj[key].collegeprofileId +"/') !!}' >"+ data.facultyDataObj[key].firstname + "</a></td> <td>"+ lastUpdatedBy +" </td> <td><a href='{!! URL::to('administrator/faculty/"+ data.facultyDataObj[key].facultyId +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/faculty/"+ data.facultyDataObj[key].facultyId +"') !!}' class='btn btn-info btn-xs'>Show</a></td></tr>");
                              
                            });

                            //Create html pagination desgin
                            if( data.facultyDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.facultyDataObj1 < 8 ){
                                    for(var i=2; i <= data.facultyDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.facultyDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.facultyDataObj1-1;
                                    for(var i=lessTwo; i <= data.facultyDataObj1; i++){
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

                            if(data.facultyDataObj1 == 1){
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
                    url: "{{ URL::to('search/all-college-faculty') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'> Id</td><td class='searchFilter'>Name</td><td class='searchFilter'>Description</td><td class='searchFilter'>Course Detail</td><td class='searchFilter'>College Profile </td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var facultyNameText;
                            var facultyDescriptionText;
                            var courseDetailsText;
                            var lastUpdatedBy;
                            var functionalAreaText;
                            var degreeDataText;
                            var courseDataText;

                            $.each(data, function (key, item) {

                               if( data[key].facultyName == null){
                                    facultyNameText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        facultyNameText = data[key].facultyName;
                                } 

                                if( data[key].facultyDescription == null ){
                                    facultyDescriptionText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        facultyDescriptionText = data[key].facultyDescription;
                                } 

                                if( data[key].functionalareaName == null){
                                    functionalAreaText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    functionalAreaText = data[key].functionalareaName;
                                }

                                if(data[key].degreeName == null ){
                                    degreeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    degreeDataText = data[key].degreeName;
                                }

                                if( data[key].courseName == null ){
                                    courseDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDataText = data[key].courseName;
                                }            
                               
                                if( data[key].collegemasterId == null){
                                    courseDetailsText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDetailsText = "<a class='' href='{!! URL::to('administrator/collegemaster/"+ data[key].collegemasterId +"/') !!}' >"+ functionalAreaText +' / '+ degreeDataText +' / '+ courseDataText + "</a>";
                                }          
                               
                                                              
                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/faculty/"+ data[key].facultyId +"/') !!}' >"+ data[key].facultyId +"</a></td><td>"+ facultyNameText +"</td><td>"+ facultyDescriptionText +"</td><td>"+ courseDetailsText +"</td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data[key].collegeprofileId +"/') !!}' >"+ data[key].firstname + "</a></td> <td>"+ lastUpdatedBy +" </td> <td><a href='{!! URL::to('administrator/faculty/"+ data[key].facultyId +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/faculty/"+ data[key].facultyId +"') !!}' class='btn btn-info btn-xs'>Show</a></td></tr>");
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
            var degree_id = $('.degree_id').val();
            var functionalarea_id = $('.functionalarea_id').val();
            var course_id = $('.course_id').val();
            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/college-faculty') }}",
                    data     : { collegeName: collegeName,course_id: course_id, degree_id: degree_id, functionalarea_id:functionalarea_id,  currentNode: currentNode},
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'> Id</td><td class='searchFilter'>Name</td><td class='searchFilter'>Description</td><td class='searchFilter'>Course Detail</td><td class='searchFilter'>College Profile </td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var facultyNameText;
                            var facultyDescriptionText;
                            var courseDetailsText;
                            var lastUpdatedBy;
                            var functionalAreaText;
                            var degreeDataText;
                            var courseDataText;

                            $.each(data.facultyDataObj, function (key, item) {

                               if( data.facultyDataObj[key].facultyName == null){
                                    facultyNameText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        facultyNameText = data.facultyDataObj[key].facultyName;
                                } 

                                if( data.facultyDataObj[key].facultyDescription == null ){
                                    facultyDescriptionText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        facultyDescriptionText = data.facultyDataObj[key].facultyDescription;
                                }            
                                
                                 if( data.facultyDataObj[key].functionalareaName == null){
                                    functionalAreaText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    functionalAreaText = data.facultyDataObj[key].functionalareaName;
                                }

                                if(data.facultyDataObj[key].degreeName == null ){
                                    degreeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    degreeDataText = data.facultyDataObj[key].degreeName;
                                }

                                if( data.facultyDataObj[key].courseName == null ){
                                    courseDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDataText = data.facultyDataObj[key].courseName;
                                }            
                               
                                if( data.facultyDataObj[key].collegemasterId == null){
                                    courseDetailsText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDetailsText = "<a class='' href='{!! URL::to('administrator/collegemaster/"+ data.facultyDataObj[key].collegemasterId +"/') !!}' >"+ functionalAreaText +' / '+ degreeDataText +' / '+ courseDataText + "</a>";
                                }
                                                             
                                if( data.facultyDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.facultyDataObj[key].eUserId +"/') !!}' >"+ data.facultyDataObj[key].employeeFirstname+' '+data.facultyDataObj[key].employeeMiddlename+' '+data.facultyDataObj[key].employeeLastname+' (User Id:- '+data.facultyDataObj[key].eUserId+') <hr> Date & Time :- '+data.facultyDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/faculty/"+ data.facultyDataObj[key].facultyId +"/') !!}' >"+ data.facultyDataObj[key].facultyId +"</a></td><td>"+ facultyNameText +"</td><td>"+ facultyDescriptionText +"</td><td>"+ courseDetailsText +"</td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.facultyDataObj[key].collegeprofileId +"/') !!}' >"+ data.facultyDataObj[key].firstname + "</a></td> <td>"+ lastUpdatedBy +" </td> <td><a href='{!! URL::to('administrator/faculty/"+ data.facultyDataObj[key].facultyId +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/faculty/"+ data.facultyDataObj[key].facultyId +"') !!}' class='btn btn-info btn-xs'>Show</a></td></tr>");
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
                                    if( data.facultyDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.facultyDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.facultyDataObj1-1;
                                    for(var i=lessTwo; i <= data.facultyDataObj1; i++){
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
                                if( data.facultyDataObj1 < 8 ){
                                    for(var i=2; i <= data.facultyDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.facultyDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.facultyDataObj1-1;
                                    for(var i=lessTwo; i <= data.facultyDataObj1; i++){
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
        $('select[name=functionalarea_id]').on('change', function(){
            var currentID = $(this).val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {currentID: currentID},
                url: "{{ URL::to('getAllDegreeName') }}",
                success: function(data) {
                    var HTML = '';
                    HTML += '<option selected="" disabled="">Degree</option>';
                    if( data.code == '200' ){
                        $.each(data.degreeObj, function(i, item) {
                            HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
                        }); 
                    }else{
                        HTML += '<option selected="" disabled="">No degree available for this stream</option>';
                    }

                    $('select[name="degree_id"]').empty();
                    $('select[name="degree_id"]').html(HTML);
                    $('select[name="degree_id"]').trigger('chosen:updated');
                }
            });
        });

        $('select[name=degree_id]').on('change', function(){
            var currentID = $(this).val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {currentID: currentID},
                url: "{{ URL::to('getAllCourseName') }}",
                success: function(data) {
                    var HTML = '';
                    HTML += '<option selected="" disabled="">Branch</option>';
                    if( data.code == '200' ){
                        $.each(data.courseObj, function(i, item) {
                            HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
                        }); 
                    }else{
                        HTML += '<option selected="" disabled="">No course available for this degree</option>';
                    }

                    $('select[name="course_id"]').empty();
                    $('select[name="course_id"]').html(HTML);
                    $('select[name="course_id"]').trigger('chosen:updated');
                }
            });
        });

       
    </script>
    @endsection





