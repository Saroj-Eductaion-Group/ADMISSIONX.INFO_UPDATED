@extends('employee/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Profile Details <a href="{{ url('employee/collegeprofile/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Profile</a></h2>
    </div>
</div> -->

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                     <h5>Here are the details</h5>              
                </div>
                <br />
                <div class="row">
                    <div class="col-md-7 col-md-offset-3">
                        @if(Session::has('sendEmailMsg'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('sendEmailMsg') }}</strong>
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
                        {!! Form::open(['url' => 'search/employee-college-profile', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeName" name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                                <option value="" disabled="" selected="">Select college</option>
                                                @foreach( $collegeProfileObj as $college )
                                                    <option value="{{ $college->firstname }}">{{ $college->firstname }}</option>
                                                @endforeach
                                            </select> 
                                        </div> 
                                        <div class="col-md-4">
                                            <h4 for="usr">Email Address<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control userEmailAddress" name="userEmailAddress" placeholder="Enter user email address here" data-parsley-error-message="Please enter valid email address" data-parsley-trigger="change" data-parsley-type="email" >
                                        </div>  
                                        
                                        <div class="col-md-4">
                                            <h4>College Type
                                            <span class="pull-right"> <a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select class="form-control chosen-select collegetype_id" name="collegetype_id" data-parsley-trigger="change" data-parsley-error-message="Please select college type">
                                                <option value="" disabled="" selected="">Select college type</option>
                                                @foreach( $collegeTypeObj as $collegeType )
                                                    <option value="{{ $collegeType->id }}">{{ $collegeType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">University
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select university_id" name="university_id" data-parsley-trigger="change" data-parsley-error-message="Please select university">
                                                <option value="" disabled="" selected="">Select university</option>
                                                @foreach( $universityObj as $university )
                                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <h4 for="usr">Review<span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="review" class="form-control chosen-select review" data-placeholder="Choose review ..."  data-parsley-error-message=" Please select review " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select Review</option>
                                                <option value="1">Reviewed</option>
                                                <option value="0">Not Reviewed</option>
                                            </select>
                                            
                                        </div>    
                                        <div class="col-md-3">                                    
                                            <h4 for="usr">Agreement<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select name="agreement" class="form-control agreement chosen-select" data-placeholder="Choose agreement ..."  data-parsley-error-message=" Please select agreement " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select Agreement</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No  </option>
                                            </select>                              
                                        </div>  
                                        <div class="col-md-3">                                    
                                            <h4 for="usr">Verified<span class="pull-right"><a href="javascript:void(0);" id="refresh7" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select name="verified" class="form-control verified chosen-select" data-placeholder="Choose verified ..."  data-parsley-error-message=" Please select verified " data-parsley-trigger="change" >
                                                <option value="" selected disabled >Select Verified</option>
                                                <option value="1">Verified</option>
                                                <option value="0">Not Verified</option>
                                            </select>                            
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">Address Type<span class="pull-right"><a href="javascript:void(0);" id="refresh12" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select addresstype_id" name="addresstype_id" data-parsley-trigger="change" data-parsley-error-message="Please select address type">
                                                <option value="" disabled="" selected="">Select address type</option>
                                                <option value="1">Registered Address</option>
                                                <option value="2">Campus Address</option>       
                                            </select> 
                                        </div> 
                                       <div class="col-md-3 countryHide" style="visibility: hidden;">
                                            <h4 for="usr">Country Name<span class="pull-right"><a href="javascript:void(0);" id="refresh8" class="hide"><i class="fa fa-remove"></i></a></span></h4>
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
                                        <div class="col-md-3 stateHide" style="visibility: hidden;">
                                            <h4 for="usr">Select State<span class="pull-right"><a href="javascript:void(0);" id="refresh14" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="stateName" class="form-control chosen-select stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select state name">
                                                <option selected="" disabled="">Select state name</option>
                                                <!-- @if( $stateNameObj )
                                                    @foreach( $stateNameObj as $state )
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                @endif -->
                                            </select>
                                        </div>
                                      
                                        <div class="col-md-3 cityHide" style="visibility: hidden;">
                                            <h4 for="usr">City<span class="pull-right"><a href="javascript:void(0);" id="refresh13" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select city_id cityName" name="city_id" data-parsley-trigger="change" data-parsley-error-message="Please select city">
                                                 <option value="" disabled="" selected="">Select city</option>
                                                <!-- @foreach( $cityNameObj as $city )
                                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                @endforeach -->
                                            </select> 
                                        </div>
                                        
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="col-md-12 text-right">      
                                        <a href="{{ URL::to('employee/collegeprofile') }}" class="btn btn-default btn-sm">Close</a>
                                        <button class="btn btn-primary btn-sm">Search</button>                                            
                                    </div>  
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class="table-responsive"> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $collegeprofile == '0' )
                            <input type="text" class="result-zero hide" value="{{ $collegeprofile }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                   <!--  <th>Established Year</th> -->
                                    <th>Created Date</th>
                                    <!--<th>Description</th>
                                     <th>Website</th> -->
                                    <th>College Name</th>
                                    <th>University</th>
                                    <th>College Type</th>
                                    <th>Verified</th>
                                    <th>Review</th>
                                    <th>Agreement</th>
                                    <th>Document</th>
                                    <th>Email</th>
                                    <th>Last Updated BY</th>
                                    @if($storeEditUpdateAction == '1')
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($collegeprofile as $item)
                                <tr class="gradeX">
                                    <td>
                                        <a href="{{ url('employee/users') }}/{{ $item->userID }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->id }}</a>
                                    </td>
                                   <!--  <td>
                                        @if( $item->description)
                                            <a href="{{ url('employee/collegeprofile', $item->id) }}">{{ str_limit($item->description, $limit = 50, $end = '...') }}</a>
                                        @else
                                            <a href="{{ url('employee/collegeprofile', $item->id) }}"><span class="label label-warning">Not Updated Yet</span></a>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if( $item->website)
                                            <a href="{{ url('employee/collegeprofile', $item->id) }}">{{ $item->website }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td> --> 
                                    <!-- <td>
                                        @if( $item->estyear)
                                            <a href="{{ url('employee/collegeprofile', $item->id) }}">{{ $item->estyear }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td> -->
                                     <td>
                                        @if( $item->created_at)
                                            {{  $item->created_at->format('F d,Y') }} at {{  $item->created_at->format('h:i A') }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->userID)
                                            <a href="{{ url('employee/collegeprofile', $item->id) }}">{{ $item->firstname }} {{ $item->lastname }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                     <td>
                                        @if( $item->universityName)
                                            {{ $item->universityName }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>

                                     <td>
                                        @if( $item->collegetypeName)
                                            {{ $item->collegetypeName }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->verified == '1')
                                            Verified
                                        @else
                                            Not Verified
                                        @endif    
                                    </td>
                                    <td>
                                        @if( $item->review == '1')
                                            Reviewed
                                        @else
                                            Not Reviewed
                                        @endif    
                                    </td>
                                    <td>
                                        @if( $item->agreement == '1')
                                            Yes
                                        @else
                                            No 
                                        @endif    
                                    </td>
                                    <td>
                                        @if( $item->galleryName && $item->misc == 'affiliationLettersImage')
                                           Yes
                                        @else
                                            No 
                                        @endif    
                                    </td>
                                    <td>
                                        <a href="{{ url('/employee/sendWelcomeEmail/' . $item->id) }}">
                                            <button type="submit" class="btn btn-outline btn-sm btn-primary">Send welcome email</button>
                                        </a>
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
                                        <a href="{{ url('employee/collegeprofile/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> <!-- /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['employee/collegeprofile', $item->id],
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
                                <div class="pull-right custom-pagination">{!! $collegeprofile->render() !!}</div>
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

           $('.addresstype_id').on('change', function(){
                var addressTypeId = $(this).val();
                $('.countryHide').css('visibility', 'visible');
            });

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

            $('.agreement').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.agreement').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });
            
            $('.review').on('change',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('.review').val('').trigger('chosen:updated');
                $('#refresh5').addClass('hide');
            });

            $('.collegetype_id').on('change',function(){
                $('#refresh6').removeClass('hide');
            });
            $('#refresh6').on('click',function(e){
                $('.collegetype_id').val('').trigger('chosen:updated');
                $('#refresh6').addClass('hide');
            });

            $('.verified').on('change',function(){
                $('#refresh7').removeClass('hide');
            });
            $('#refresh7').on('click',function(e){
                $('.verified').val('').trigger('chosen:updated');
                $('#refresh7').addClass('hide');
            });

            $('.addresstype_id').on('change',function(){
                $('#refresh12').removeClass('hide');
            });
            $('#refresh12').on('click',function(e){
                $('.addresstype_id').val('').trigger('chosen:updated');
                $('#refresh12').addClass('hide');
                $('.country_id').val('').trigger('chosen:updated');
                $('#refresh8').addClass('hide');
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh14').addClass('hide');
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
            });

            $('.city_id').on('change',function(){
                $('#refresh13').removeClass('hide');
            });
            $('#refresh13').on('click',function(e){
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
            });

            $('.stateName').on('change',function(){
                $('#refresh14').removeClass('hide');
            });
            $('#refresh14').on('click',function(e){
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh14').addClass('hide');
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
            });

            $('.country_id').on('change',function(){
                $('#refresh8').removeClass('hide');
            });
            $('#refresh8').on('click',function(e){
                $('.country_id').val('').trigger('chosen:updated');
                $('#refresh8').addClass('hide');
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh14').addClass('hide');
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
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
                        $(".thead").append("<tr><td class='searchFilter'>College Id</td><td class='searchFilter'>Created Date</td><td class='searchFilter'>College Name</td><td class='searchFilter'>University</td><td class='searchFilter'>College Type </td><td class='searchFilter'>Verified</td><td class='searchFilter'>Review</td><td class='searchFilter'>Agreement</td><td class='searchFilter'>Email</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");

                                
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
                            var agreementDataText;
                            var reviewDataText;
                            var collegeCodeText;
                            var universityText;
                            var collegeTypeText;
                            var estYearDataText;
                            var lastUpdatedBy;

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

                            $.each(data.collegeProfileDataObj, function (key, item) {

                                if(data.collegeProfileDataObj[key].estyear == '' ){
                                    estYearDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    estYearDataText = data.collegeProfileDataObj[key].estyear;
                                }

                                if( data.collegeProfileDataObj[key].collegetypeName == null){
                                    collegeTypeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeTypeText = data.collegeProfileDataObj[key].collegetypeName;
                                }

                                if( data.collegeProfileDataObj[key].universityName == null){
                                    universityText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    universityText = data.collegeProfileDataObj[key].universityName;
                                }

                                if( data.collegeProfileDataObj[key].created_at == ''){
                                     collegeCodeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeCodeText = data.collegeProfileDataObj[key].created_at;
                                }

                                if( data.collegeProfileDataObj[key].verified == null){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.collegeProfileDataObj[key].verified == '1' ){
                                        verifyDataText = "Verified";
                                    }else{
                                        verifyDataText = "Not Verified";
                                    }
                                } 

                                if( data.collegeProfileDataObj[key].agreement == null ){
                                    agreementDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.collegeProfileDataObj[key].agreement == '1' ){
                                        agreementDataText = "Yes";
                                    }else{
                                        agreementDataText = "No ";
                                    }
                                }            

                                if( data.collegeProfileDataObj[key].review == null ){
                                    reviewDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.collegeProfileDataObj[key].review == '1' ){
                                        reviewDataText = "Reviewed";
                                    }else{
                                        reviewDataText = "Not Reviewed";
                                    }
                                }

                                if( data.collegeProfileDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.collegeProfileDataObj[key].eUserId +"/') !!}' >"+ data.collegeProfileDataObj[key].employeeFirstname+' '+data.collegeProfileDataObj[key].employeeMiddlename+' '+data.collegeProfileDataObj[key].employeeLastname+' (User Id:- '+data.collegeProfileDataObj[key].eUserId+') <hr> Date & Time :- '+data.collegeProfileDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/users/"+ data.collegeProfileDataObj[key].userID +"/') !!}' >"+ data.collegeProfileDataObj[key].collegeprofileID +"</a></td><td>"+ collegeCodeText +"</td><td><a href='{!! URL::to('employee/collegeprofile/"+ data.collegeProfileDataObj[key].collegeprofileID +"/') !!}' >"+ data.collegeProfileDataObj[key].firstname +"</a></td><td>"+ universityText +"</td> <td>"+ collegeTypeText +"</td><td>"+ verifyDataText +"</td><td>"+ reviewDataText +"</td><td>"+ agreementDataText +"</td><td><a href='{!! URL::to('employee/sendWelcomeEmail/"+ data.collegeProfileDataObj[key].collegeprofileID +"/') !!}' class='btn btn-outline btn-sm btn-primary'>Send welcome email</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/collegeprofile/"+ data.collegeProfileDataObj[key].collegeprofileID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
                                
                            });

                            //Create html pagination desgin
                            if( data.collegeProfileDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.collegeProfileDataObj1 < 8 ){
                                    for(var i=2; i <= data.collegeProfileDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.collegeProfileDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.collegeProfileDataObj1-1;
                                    for(var i=lessTwo; i <= data.collegeProfileDataObj1; i++){
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

                            if(data.collegeProfileDataObj1 == 1){
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
                $('#refresh8').addClass('hide');
                $('#refresh12').addClass('hide');
                $('#refresh13').addClass('hide');
                $('#refresh14').addClass('hide');
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
                    url: "{{ URL::to('search/employee-all-college-profile') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>College Id</td><td class='searchFilter'>Created Date</td><td class='searchFilter'>College Name</td><td class='searchFilter'>University</td><td class='searchFilter'>College Type </td><td class='searchFilter'>Verified</td><td class='searchFilter'>Review</td><td class='searchFilter'>Agreement</td><td class='searchFilter'>Email</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var verifyDataText;
                            var agreementDataText;
                            var reviewDataText;
                            var collegeCodeText;
                            var universityText;
                            var collegeTypeText;
                            var estYearDataText;
                            var lastUpdatedBy;
                            $.each(data, function (key, item) {

                               if(data[key].estyear == '' ){
                                    estYearDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    estYearDataText = data[key].estyear; 
                                }

                                if( data[key].collegetypeName == null){
                                    collegeTypeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeTypeText = data[key].collegetypeName;
                                }

                                if( data[key].universityName == null){
                                    universityText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    universityText = data[key].universityName;
                                }

                                if( data[key].created_at == ''){
                                     collegeCodeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeCodeText = data[key].created_at;
                                }


                                if( data[key].verified == null){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data[key].verified == '1' ){
                                        verifyDataText = "Verified";
                                    }else{
                                        verifyDataText = "Not Verified";
                                    }
                                } 

                                if( data[key].agreement == null ){
                                    agreementDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data[key].agreement == '1' ){
                                        agreementDataText = "Yes";
                                    }else{
                                        agreementDataText = "No ";
                                    }
                                }            

                                if( data[key].review == null ){
                                    reviewDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data[key].review == '1' ){
                                        reviewDataText = "Reviewed";
                                    }else{
                                        reviewDataText = "Not Reviewed";
                                    }
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }


                              $("tbody").append("<tr><td><a href='{!! URL::to('employee/users/"+ data[key].userID +"/') !!}' >"+ data[key].collegeprofileID +"</a></td><td>"+ collegeCodeText +"</td><td><a href='{!! URL::to('employee/collegeprofile/"+ data[key].collegeprofileID +"/') !!}' >"+ data[key].firstname +"</a></td><td>"+ universityText +"</td> <td>"+ collegeTypeText +"</td><td>"+ verifyDataText +"</td><td>"+ reviewDataText +"</td><td>"+ agreementDataText +"</td><td><a href='{!! URL::to('employee/sendWelcomeEmail/"+ data[key].collegeprofileID +"/') !!}' class='btn btn-outline btn-sm btn-primary'>Send welcome email</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/collegeprofile/"+ data[key].collegeprofileID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
            var agreement = $('.agreement').val();
            var review = $('.review').val();
            var userEmailAddress = $('.userEmailAddress').val();
            var university_id = $('.university_id').val();
            var collegetype_id = $('.collegetype_id').val();
            var verified = $('.verified').val();
            var addresstype_id = $('.addresstype_id').val();
            var stateName = $('.stateName').val();
            var city_id = $('.city_id').val();
            var country_id = $('.country_id').val();
            
            var endCounter = 20;
            //beginCounter = beginCounter + endCounter;
            $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type     : "POST",
                    cache    : false,
                    url      : "{{ URL::to('search/employee-college-profile') }}",
                    data     : { collegeName: collegeName,agreement: agreement,verified: verified ,review: review, userEmailAddress:userEmailAddress, university_id:university_id , collegetype_id:collegetype_id,addresstype_id:addresstype_id, stateName:stateName, city_id:city_id, currentNode: currentNode, country_id: country_id },
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'>College Id</td><td class='searchFilter'>Created Date</td><td class='searchFilter'>College Name</td><td class='searchFilter'>University</td><td class='searchFilter'>College Type </td><td class='searchFilter'>Verified</td><td class='searchFilter'>Review</td><td class='searchFilter'>Agreement</td><td class='searchFilter'>Email</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var verifyDataText;
                            var agreementDataText;
                            var reviewDataText;
                            var collegeCodeText;
                            var universityText;
                            var collegeTypeText;
                            var estYearDataText;
                            var lastUpdatedBy;

                            $.each(data.collegeProfileDataObj, function (key, item) {

                               if(data.collegeProfileDataObj[key].estyear == '' ){
                                    estYearDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    estYearDataText = data.collegeProfileDataObj[key].estyear; 
                                }

                                if( data.collegeProfileDataObj[key].collegetypeName == null){
                                    collegeTypeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeTypeText = data.collegeProfileDataObj[key].collegetypeName;
                                }

                                if( data.collegeProfileDataObj[key].universityName == null){
                                    universityText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    universityText = data.collegeProfileDataObj[key].universityName;
                                }

                                if( data.collegeProfileDataObj[key].created_at == ''){
                                     collegeCodeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    collegeCodeText = data.collegeProfileDataObj[key].created_at;
                                }


                                if( data.collegeProfileDataObj[key].verified == null){
                                    verifyDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.collegeProfileDataObj[key].verified == '1' ){
                                        verifyDataText = "Verified";
                                    }else{
                                        verifyDataText = "Not Verified";
                                    }
                                } 

                                if( data.collegeProfileDataObj[key].agreement == null ){
                                    agreementDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.collegeProfileDataObj[key].agreement == '1' ){
                                        agreementDataText = "Yes";
                                    }else{
                                        agreementDataText = "No ";
                                    }
                                }            

                                if( data.collegeProfileDataObj[key].review == null ){
                                    reviewDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    if( data.collegeProfileDataObj[key].review == '1' ){
                                        reviewDataText = "Reviewed";
                                    }else{
                                        reviewDataText = "Not Reviewed";
                                    }
                                }

                                if( data.collegeProfileDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('employee/users/"+ data.collegeProfileDataObj[key].eUserId +"/') !!}' >"+ data.collegeProfileDataObj[key].employeeFirstname+' '+data.collegeProfileDataObj[key].employeeMiddlename+' '+data.collegeProfileDataObj[key].employeeLastname+' (User Id:- '+data.collegeProfileDataObj[key].eUserId+') <hr> Date & Time :- '+data.collegeProfileDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('employee/users/"+ data.collegeProfileDataObj[key].userID +"/') !!}' >"+ data.collegeProfileDataObj[key].collegeprofileID +"</a></td><td>"+ collegeCodeText +"</td><td><a href='{!! URL::to('employee/collegeprofile/"+ data.collegeProfileDataObj[key].collegeprofileID +"/') !!}' >"+ data.collegeProfileDataObj[key].firstname +"</a></td><td>"+ universityText +"</td> <td>"+ collegeTypeText +"</td><td>"+ verifyDataText +"</td><td>"+ reviewDataText +"</td><td>"+ agreementDataText +"</td><td><a href='{!! URL::to('employee/sendWelcomeEmail/"+ data.collegeProfileDataObj[key].collegeprofileID +"/') !!}' class='btn btn-outline btn-sm btn-primary'>Send welcome email</a></td><td>"+ lastUpdatedBy +" </td><td><a href='{!! URL::to('employee/collegeprofile/"+ data.collegeProfileDataObj[key].collegeprofileID +"/edit/') !!}' class='btn btn-primary btn-xs'>update</a></td></tr>");
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
                                    if( data.collegeProfileDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.collegeProfileDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.collegeProfileDataObj1-1;
                                    for(var i=lessTwo; i <= data.collegeProfileDataObj1; i++){
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
                                if( data.collegeProfileDataObj1 < 8 ){
                                    for(var i=2; i <= data.collegeProfileDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.collegeProfileDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.collegeProfileDataObj1-1;
                                    for(var i=lessTwo; i <= data.collegeProfileDataObj1; i++){
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
        /*$(document).ready(function(){   
            
            $('.stateName').on('change', function(){
                $('.cityHide').css('visibility', 'visible');
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
                    url: "{{ URL::to('/selectCityNameData') }}",
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
        });*/
    </script>
    <script type="text/javascript">
        $('select[name=country_id]').on('change', function(){
                
            $('.stateHide').css('visibility', 'visible');
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
            $('.cityHide').css('visibility', 'visible');
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


