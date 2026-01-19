@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
         <h2>College Course Details <a href="{{ url('administrator/collegemaster/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Course</a></h2>
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
                        {!! Form::open(['url' => 'search/college-master', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh8" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select collegeName" name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                                <option value="" disabled="" selected="">Select college</option>
                                                @foreach( $collegeProfileObj as $college )
                                                    <option value="{{ $college->id }}">{{ $college->firstname }}</option>
                                                @endforeach
                                            </select> 
                                        </div>   
                                        <div class="col-md-3">
                                            <h4>Stream<span class="pull-right"> <a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                           <select class="form-control chosen-select functionalarea_id" name="functionalarea_id" data-parsley-trigger="change" data-parsley-error-message="Please select stream">
                                                <option value="" disabled="" selected="">Select stream</option>
                                                @foreach( $functionalAreaObj as $functional )
                                                    <option value="{{ $functional->id }}">{{ $functional->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <h4 for="usr">Degree Level
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select educationlevel_id" name="educationlevel_id" data-parsley-trigger="change" data-parsley-error-message="Please select degree level">
                                                <option value="" disabled="" selected="">Select degree level</option>
                                                @foreach( $educationLevelObj as $education )
                                                    <option value="{{ $education->id }}">{{ $education->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="col-md-3">
                                            <h4 for="usr">Degree
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select degree_id" name="degree_id" data-parsley-trigger="change" data-parsley-error-message="Please select degree">
                                                <option value="" disabled="" selected="">Select degree</option>
                                                @foreach( $degreeObj as $degree )
                                                    <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">Course Type
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select coursetype_id" name="coursetype_id" data-parsley-trigger="change" data-parsley-error-message="Please select course type">
                                                <option value="" disabled="" selected="">Select course type</option>
                                                @foreach( $courseTypeObj as $courseType )
                                                    <option value="{{ $courseType->id }}">{{ $courseType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <h4 for="usr">Course
                                            <span class="pull-right"><a href="javascript:void(0);" id="refresh7" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select class="form-control chosen-select course_id" name="course_id" data-parsley-trigger="change" data-parsley-error-message="Please select course">
                                                <option value="" disabled="" selected="">Select course</option>
                                                @foreach( $courseObj as $course )
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="col-md-3">
                                            <h4 for="usr">12th Marks<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control twelvemarks" name="twelvemarks" placeholder="Enter marks here" data-parsley-error-message="Please enter valid marks" data-parsley-trigger="change" data-parsley-type="number">
                                        </div> 
                                        <div class="col-md-3">
                                            <h4 for="usr">Others<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control otherMarks" name="otherMarks" placeholder="Enter others here" data-parsley-error-message="Please enter others" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                     <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">Total Seats<span class="pull-right"><a href="javascript:void(0);" id="refresh9" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control seats" name="seats" placeholder="Enter seats here" data-parsley-error-message="Please enter total seats" data-parsley-trigger="change" data-parsley-type="number">
                                        </div> 
                                        <div class="col-md-3">
                                            <h4 for="usr">Seats Allocated To Admission X<span class="pull-right"><a href="javascript:void(0);" id="refresh11" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control seatsallocatedtobya" name="seatsallocatedtobya" placeholder="Enter seats here" data-parsley-error-message="Please enter total seats" data-parsley-trigger="change" data-parsley-type="number">
                                        </div> 
                                        <div class="col-md-6">
                                            <h4 for="usr">Total Fees (in INR)<span class="pull-right"><a href="javascript:void(0);" id="refresh10" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control fees" name="fees" placeholder="Select total fees range here" data-parsley-error-message="Please select total fees range" data-parsley-trigger="change" id="ionrange_1">
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
                                            <h4 for="usr">Country Name<span class="pull-right"><a href="javascript:void(0);" id="refresh15" class="hide"><i class="fa fa-remove"></i></a></span></h4>
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
                                     <div class="row">
                                        <div class="col-md-12 text-right">      
                                            <a href="{{ URL::to('administrator/collegemaster') }}" class="btn btn-default btn-sm">Close</a>
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
                        @if( $collegemaster == '0' )
                            <input type="text" class="result-zero hide" value="{{ $collegemaster }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>12th Marks </th>
                                    <th>Others</th>
                                    <th>Total Fees (per year in inr) </th>
                                    <th>Total Seats </th>
                                    <th>Seats Allocated To Admission X</th>
                                    <th>College Profile </th>
                                    <th>Course Duration</th>
                                    <th>Stream</th>
                                    <th>Degree Level</th>
                                    <th>Degree</th>
                                    <th>Course Type</th>
                                    <th>Course</th>
                                    <th>Last Updated By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($collegemaster as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('administrator/collegemaster', $item->id) }}">{{ $item->id }}</a></td>
                                    <td>
                                        @if( $item->twelvemarks)
                                           <a href="{{ url('administrator/collegemaster', $item->id) }}"> {{ $item->twelvemarks }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->others)
                                           {{ $item->others }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->fees)
                                           {{ $item->fees }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->seats)
                                           {{ $item->seats }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->seatsallocatedtobya)
                                           {{ $item->seatsallocatedtobya }}
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td> @if( $item->collegeprofileID)
                                            <a href="{{ url('administrator/collegeprofile') }}/{{ $item->collegeprofileID }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->firstname }} {{ $item->lastname }} </a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->courseduration)
                                            @if(is_numeric($item->courseduration))
                                                @if( $item->courseduration == '1' )
                                                    {{ $item->courseduration }} Year
                                                @else
                                                    {{ $item->courseduration }} Years
                                                @endif
                                            @else
                                                {{ $item->courseduration }}
                                            @endif
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                        <!-- @if( $item->courseduration == '1')
                                            {{ $item->courseduration }} Year
                                        @elseif( $item->courseduration)
                                            {{ $item->courseduration }} Years
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif -->
                                    </td>
                                    <td>
                                        @if( $item->functionalAreaName)
                                            <a href="{{ url('administrator/functionalarea') }}/{{ $item->functionalareaID }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->functionalAreaName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->educationlevelName)
                                            <a href="{{ url('administrator/educationlevel') }}/{{ $item->educationlevelId }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->educationlevelName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->degreeName)
                                            <a href="{{ url('administrator/degree') }}/{{ $item->degreeId }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->degreeName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->coursetypeName)
                                            <a href="{{ url('administrator/coursetype') }}/{{ $item->coursetypeId }}" title="{{ $item->firstname }} {{ $item->lastname }}">{{ $item->coursetypeName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->courseName)
                                           <a href="{{ url('administrator/course') }}/{{ $item->courseID }}" title="{{ $item->courseName }} {{ $item->lastname }}"> {{ $item->courseName }}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->eUserId)
                                        <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                        @else
                                            <span class="label label-warning">Not Updated Yet</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ url('administrator/collegemaster/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </a> /
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['administrator/collegemaster', $item->id],
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
                                <div class="pull-right custom-pagination">{!! $collegemaster->render() !!}</div>
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
                $('.countryHide').css('visibility', 'visible');
            });


            $("#ionrange_1").ionRangeSlider({
                min: 0,
                max: 5000000,
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

           

            $('.educationlevel_id').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.educationlevel_id').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });


            $('.otherMarks').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.otherMarks').val('');
                $('#refresh2').addClass('hide');
            });

            $('.twelvemarks').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.twelvemarks').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.coursetype_id').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.coursetype_id').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });
            
            $('.degree_id').on('change',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('.degree_id').val('').trigger('chosen:updated');
                $('#refresh5').addClass('hide');
            });

            $('.functionalarea_id').on('change',function(){
                $('#refresh6').removeClass('hide');
            });
            $('#refresh6').on('click',function(e){
                $('.functionalarea_id').val('').trigger('chosen:updated');
                $('#refresh6').addClass('hide');
            });

            $('.course_id').on('change',function(){
                $('#refresh7').removeClass('hide');
            });
            $('#refresh7').on('click',function(e){
                $('.course_id').val('').trigger('chosen:updated');
                $('#refresh7').addClass('hide');
            });

            $('.collegeName').on('change',function(){
                $('#refresh8').removeClass('hide');
            });
            $('#refresh8').on('click',function(e){
                $('.collegeName').val('').trigger('chosen:updated');
                $('#refresh8').addClass('hide');
            });

            $('.seats').on('blur',function(){
                $('#refresh9').removeClass('hide');
            });
            $('#refresh9').on('click',function(e){
                $('.seats').val('');
                $('#refresh9').addClass('hide');
            });

             $('.fees').on('blur',function(){
                $('#refresh10').removeClass('hide');
            });
            $('#refresh10').on('click',function(e){
                $('.fees').val('');
                $('#refresh10').addClass('hide');
            });

             $('.seatsallocatedtobya').on('blur',function(){
                $('#refresh11').removeClass('hide');
            });
            $('#refresh11').on('click',function(e){
                $('.seatsallocatedtobya').val('');
                $('#refresh11').addClass('hide');
            });

            $('.addresstype_id').on('change',function(){
                $('#refresh12').removeClass('hide');
            });
            $('#refresh12').on('click',function(e){
                $('.addresstype_id').val('').trigger('chosen:updated');
                $('#refresh12').addClass('hide');
                $('.country_id').val('').trigger('chosen:updated');
                $('#refresh15').addClass('hide');
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
                $('#refresh15').removeClass('hide');
            });
            $('#refresh15').on('click',function(e){
                $('.country_id').val('').trigger('chosen:updated');
                $('#refresh15').addClass('hide');
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
                        $(".thead").append("<tr><td class='searchFilter'> Id</td><td class='searchFilter'>12th Marks</td><td class='searchFilter'>Others</td><td class='searchFilter'>Total Fees</td><td class='searchFilter'>Total Seats</td><td class='searchFilter'>Seats Allocated To Admission X</td><td class='searchFilter'>College Profile </td><td class='searchFilter'>Stream</td><td class='searchFilter'>Degree Level</td><td class='searchFilter'>Degree</td><td class='searchFilter'>Course Type</td><td class='searchFilter'>Course</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                                    
                                
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

                            var twelveMarksDataText;
                            var otherDataText;
                            var totalFeeText;
                            var totalSeatText;
                            var functionalAreaText;
                            var educationLevelDataText;
                            var degreeDataText;
                            var courseTypeDataText;
                            var courseDataText;
                            var seatsallocatedtobyaDataText;
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

                            $.each(data.collegeMasterDataObj, function (key, item) {

                                if( data.collegeMasterDataObj[key].twelvemarks == null){
                                    twelveMarksDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        twelveMarksDataText = data.collegeMasterDataObj[key].twelvemarks;
                                } 

                                if( data.collegeMasterDataObj[key].others == null ){
                                    otherDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        otherDataText = data.collegeMasterDataObj[key].others;
                                }            

                                if( data.collegeMasterDataObj[key].fees == ''){
                                     totalFeeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    totalFeeText = data.collegeMasterDataObj[key].fees;
                                }

                                if( data.collegeMasterDataObj[key].seats == null ){
                                    totalSeatText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        totalSeatText = data.collegeMasterDataObj[key].seats; 
                                }

                                if( data.collegeMasterDataObj[key].seatsallocatedtobya == null ){
                                    seatsallocatedtobyaDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        seatsallocatedtobyaDataText = data.collegeMasterDataObj[key].seatsallocatedtobya; 
                                }
                               
                                if( data.collegeMasterDataObj[key].functionalAreaName == null){
                                    functionalAreaText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    functionalAreaText = "<a class='' href='{!! URL::to('administrator/functionalarea/"+ data.collegeMasterDataObj[key].functionalareaID +"/') !!}' >"+data.collegeMasterDataObj[key].functionalAreaName+ "</a>";
                                }

                                if(data.collegeMasterDataObj[key].educationlevelName == null ){
                                    educationLevelDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    educationLevelDataText = "<a class='' href='{!! URL::to('administrator/educationlevel/"+ data.collegeMasterDataObj[key].educationlevelId +"/') !!}' >"+data.collegeMasterDataObj[key].educationlevelName + "</a>";
                                }

                                if(data.collegeMasterDataObj[key].degreeName == null ){
                                    degreeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    degreeDataText = "<a class='' href='{!! URL::to('administrator/degree/"+ data.collegeMasterDataObj[key].degreeId +"/') !!}' >"+data.collegeMasterDataObj[key].degreeName+ "</a>";
                                }

                                if(data.collegeMasterDataObj[key].coursetypeName == null ){
                                    courseTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseTypeDataText = "<a class='' href='{!! URL::to('administrator/coursetype/"+ data.collegeMasterDataObj[key].coursetypeId +"/') !!}' >"+data.collegeMasterDataObj[key].coursetypeName+ "</a>";
                                }

                                if( data.collegeMasterDataObj[key].courseName == null ){
                                    courseDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDataText = "<a class='' href='{!! URL::to('administrator/course/"+ data.collegeMasterDataObj[key].courseID +"/') !!}' >"+ data.collegeMasterDataObj[key].courseName + "</a>";
                                }

                                if( data.collegeMasterDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.collegeMasterDataObj[key].eUserId +"/') !!}' >"+ data.collegeMasterDataObj[key].employeeFirstname+' '+data.collegeMasterDataObj[key].employeeMiddlename+' '+data.collegeMasterDataObj[key].employeeLastname+' (User Id:- '+data.collegeMasterDataObj[key].eUserId+') <hr> Date & Time :- '+data.collegeMasterDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/collegemaster/"+ data.collegeMasterDataObj[key].collegemasterId +"/') !!}' >"+ data.collegeMasterDataObj[key].collegemasterId +"</a></td><td><a href='{!! URL::to('administrator/collegemaster/"+ data.collegeMasterDataObj[key].collegemasterId +"/') !!}' >"+ twelveMarksDataText +"</a></td><td>"+ otherDataText +"</td><td>"+ totalFeeText +"</td><td>"+ totalSeatText +"</td><td>"+ seatsallocatedtobyaDataText +"</td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.collegeMasterDataObj[key].collegeprofileID +"/') !!}' >"+ data.collegeMasterDataObj[key].firstname + "</a></td> <td>"+ functionalAreaText +"</td> <td>"+ educationLevelDataText +"</td> <td>"+ degreeDataText +"</td> <td>"+ courseTypeDataText +"</td> <td>"+ courseDataText +"</td><td>"+ lastUpdatedBy +" </td> <td><a href='{!! URL::to('administrator/collegemaster/"+ data.collegeMasterDataObj[key].collegemasterId +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/collegemaster/delete/"+ data.collegeMasterDataObj[key].collegemasterId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
                              
                            });

                            //Create html pagination desgin
                            if( data.collegeMasterDataObj1 > 1 ){
                                var HTML = '';
                                HTML +='<ul class="pagination">';
                                HTML +='<li class="active"><span class="currentCounter">1</span></li>';
                                if( data.collegeMasterDataObj1 < 8 ){
                                    for(var i=2; i <= data.collegeMasterDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }
                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                if( data.collegeMasterDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.collegeMasterDataObj1-1;
                                    for(var i=lessTwo; i <= data.collegeMasterDataObj1; i++){
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

                            if(data.collegeMasterDataObj1 == 1){
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
                $('#refresh9').addClass('hide');
                $('#refresh10').addClass('hide');
                $('#refresh11').addClass('hide');
                $('#refresh12').addClass('hide');
                $('#refresh13').addClass('hide');
                $('#refresh14').addClass('hide');
                $('#refresh15').addClass('hide');
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
                    url: "{{ URL::to('search/all-college-master') }}",
                    success  : function(data) {
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'> Id</td><td class='searchFilter'>12th Marks</td><td class='searchFilter'>Others</td><td class='searchFilter'>Total Fees</td><td class='searchFilter'>Total Seats</td><td class='searchFilter'>Seats Allocated To Admission X</td><td class='searchFilter'>College Profile </td><td class='searchFilter'>Stream</td><td class='searchFilter'>Degree Level</td><td class='searchFilter'>Degree</td><td class='searchFilter'>Course Type</td><td class='searchFilter'>Course</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                
                        if( data.length == '' ){
                            $('.message-no-match').removeClass('hide');
                        }else{
                            
                            var twelveMarksDataText;
                            var otherDataText;
                            var totalFeeText;
                            var totalSeatText;
                            var functionalAreaText;
                            var educationLevelDataText;
                            var degreeDataText;
                            var courseTypeDataText;
                            var courseDataText;
                            var seatsallocatedtobyaDataText;
                            var lastUpdatedBy;

                            $.each(data, function (key, item) {

                               if( data[key].twelvemarks == null){
                                    twelveMarksDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        twelveMarksDataText = data[key].twelvemarks;
                                } 

                                if( data[key].others == null ){
                                    otherDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        otherDataText = data[key].others;
                                }            

                                if( data[key].fees == ''){
                                     totalFeeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    totalFeeText = data[key].fees;
                                }

                                if( data[key].seats == null ){
                                    totalSeatText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        totalSeatText = data[key].seats; 
                                }

                                if( data[key].seatsallocatedtobya == null ){
                                    seatsallocatedtobyaDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        seatsallocatedtobyaDataText = data[key].seatsallocatedtobya; 
                                }
                               
                                if( data[key].functionalAreaName == null){
                                    functionalAreaText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    functionalAreaText = "<a class='' href='{!! URL::to('administrator/functionalarea/"+ data[key].functionalareaID +"/') !!}' >"+data[key].functionalAreaName+ "</a>";
                                }

                                if(data[key].educationlevelName == null ){
                                    educationLevelDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    educationLevelDataText = "<a class='' href='{!! URL::to('administrator/educationlevel/"+ data[key].educationlevelId +"/') !!}' >"+data[key].educationlevelName + "</a>";
                                }

                                if(data[key].degreeName == null ){
                                    degreeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    degreeDataText = "<a class='' href='{!! URL::to('administrator/degree/"+ data[key].degreeId +"/') !!}' >"+data[key].degreeName+ "</a>";
                                }

                                if(data[key].coursetypeName == null ){
                                    courseTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseTypeDataText = "<a class='' href='{!! URL::to('administrator/coursetype/"+ data[key].coursetypeId +"/') !!}' >"+data[key].coursetypeName+ "</a>";
                                }

                                if( data[key].courseName == null ){
                                    courseDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDataText = "<a class='' href='{!! URL::to('administrator/course/"+ data[key].courseID +"/') !!}' >"+ data[key].courseName + "</a>";
                                }

                                if( data[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data[key].eUserId +"/') !!}' >"+ data[key].employeeFirstname+' '+data[key].employeeMiddlename+' '+data[key].employeeLastname+' (User Id:- '+data[key].eUserId+') <hr> Date & Time :- '+data[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/collegemaster/"+ data[key].collegemasterId +"/') !!}' >"+ data[key].collegemasterId +"</a></td><td><a href='{!! URL::to('administrator/collegemaster/"+ data[key].collegemasterId +"/') !!}' >"+ twelveMarksDataText +"</a></td><td>"+ otherDataText +"</td><td>"+ totalFeeText +"</td><td>"+ totalSeatText +"</td><td>"+ seatsallocatedtobyaDataText +"</td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data[key].collegeprofileID +"/') !!}' >"+ data[key].firstname + "</a></td> <td>"+ functionalAreaText +"</td> <td>"+ educationLevelDataText +"</td> <td>"+ degreeDataText +"</td> <td>"+ courseTypeDataText +"</td> <td>"+ courseDataText +"</td><td>"+ lastUpdatedBy +" </td> <td><a href='{!! URL::to('administrator/collegemaster/"+ data[key].collegemasterId +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/collegemaster/delete/"+ data[key].collegemasterId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
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

            var twelvemarks = $('.twelvemarks').val();
            var otherMarks = $('.otherMarks').val();
            var seats = $('.seats').val();
            var fees = $('.fees').val();
            var collegeName = $('.collegeName').val();
            var degree_id = $('.degree_id').val();
            
            var educationlevel_id = $('.educationlevel_id').val();
            var functionalarea_id = $('.functionalarea_id').val();
            var course_id = $('.course_id').val();
            var coursetype_id = $('.coursetype_id').val();
            var seatsallocatedtobya = $('.seatsallocatedtobya').val();
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
                    url      : "{{ URL::to('search/college-master') }}",
                    data     : { twelvemarks: twelvemarks, otherMarks:otherMarks, seats:seats, fees:fees, collegeName: collegeName,course_id: course_id, degree_id: degree_id, educationlevel_id:educationlevel_id, functionalarea_id:functionalarea_id, coursetype_id:coursetype_id, currentNode: currentNode, seatsallocatedtobya:seatsallocatedtobya, addresstype_id:addresstype_id, stateName:stateName, city_id:city_id , country_id: country_id},
                    dataType : "json",
                    success: function(data) {
                        $('.prevFilter').show();
                        $('.spiner-example').addClass('hide');
                        $(".thead").empty();
                        $(".tbody").empty();
                       $(".thead").append("<tr><td class='searchFilter'> Id</td><td class='searchFilter'>12th Marks</td><td class='searchFilter'>Others</td><td class='searchFilter'>Total Fees</td><td class='searchFilter'>Total Seats</td><td class='searchFilter'>Seats Allocated To Admission X</td><td class='searchFilter'>College Profile </td><td class='searchFilter'>Stream</td><td class='searchFilter'>Degree Level</td><td class='searchFilter'>Degree</td><td class='searchFilter'>Course Type</td><td class='searchFilter'>Course</td><td class='searchFilter'>Last Updated By</td><td class='searchFilter'>Actions</td></tr>");
                        $('.spiner-example').addClass('hide');
                        
                        if( data == 'no' ){
                            $('.exportToExcel').addClass('hide');
                            $('.message-no-match').removeClass('hide');
                            $('.nextFilter').hide();
                        }else{
                            
                            var twelveMarksDataText;
                            var otherDataText;
                            var totalFeeText;
                            var totalSeatText;
                            var functionalAreaText;
                            var educationLevelDataText;
                            var degreeDataText;
                            var courseTypeDataText;
                            var courseDataText;
                            var seatsallocatedtobyaDataText;
                            var lastUpdatedBy;

                            $.each(data.collegeMasterDataObj, function (key, item) {

                               if( data.collegeMasterDataObj[key].twelvemarks == null){
                                    twelveMarksDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        twelveMarksDataText = data.collegeMasterDataObj[key].twelvemarks;
                                } 

                                if( data.collegeMasterDataObj[key].others == null ){
                                    otherDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        otherDataText = data.collegeMasterDataObj[key].others;
                                }            

                                if( data.collegeMasterDataObj[key].fees == ''){
                                     totalFeeText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    totalFeeText = data.collegeMasterDataObj[key].fees;
                                }

                                if( data.collegeMasterDataObj[key].seats == null ){
                                    totalSeatText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        totalSeatText = data.collegeMasterDataObj[key].seats; 
                                }

                                if( data.collegeMasterDataObj[key].seatsallocatedtobya == null ){
                                    seatsallocatedtobyaDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                        seatsallocatedtobyaDataText = data.collegeMasterDataObj[key].seatsallocatedtobya; 
                                }
                               
                                if( data.collegeMasterDataObj[key].functionalAreaName == null){
                                    functionalAreaText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    functionalAreaText = "<a class='' href='{!! URL::to('administrator/functionalarea/"+ data.collegeMasterDataObj[key].functionalareaID +"/') !!}' >"+data.collegeMasterDataObj[key].functionalAreaName+ "</a>";
                                }

                                if(data.collegeMasterDataObj[key].educationlevelName == null ){
                                    educationLevelDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    educationLevelDataText = "<a class='' href='{!! URL::to('administrator/educationlevel/"+ data.collegeMasterDataObj[key].educationlevelId +"/') !!}' >"+data.collegeMasterDataObj[key].educationlevelName + "</a>";
                                }

                                if(data.collegeMasterDataObj[key].degreeName == null ){
                                    degreeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    degreeDataText = "<a class='' href='{!! URL::to('administrator/degree/"+ data.collegeMasterDataObj[key].degreeId +"/') !!}' >"+data.collegeMasterDataObj[key].degreeName+ "</a>";
                                }

                                if(data.collegeMasterDataObj[key].coursetypeName == null ){
                                    courseTypeDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseTypeDataText = "<a class='' href='{!! URL::to('administrator/coursetype/"+ data.collegeMasterDataObj[key].coursetypeId +"/') !!}' >"+data.collegeMasterDataObj[key].coursetypeName+ "</a>";
                                }

                                if( data.collegeMasterDataObj[key].courseName == null ){
                                    courseDataText = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    courseDataText = "<a class='' href='{!! URL::to('administrator/course/"+ data.collegeMasterDataObj[key].courseID +"/') !!}' >"+ data.collegeMasterDataObj[key].courseName + "</a>";
                                }

                                if( data.collegeMasterDataObj[key].eUserId == null ){
                                    lastUpdatedBy = '<strong class="label label-warning">Not Updated</strong>';
                                }else{
                                    lastUpdatedBy = "<a class='' href='{!! URL::to('administrator/users/"+ data.collegeMasterDataObj[key].eUserId +"/') !!}' >"+ data.collegeMasterDataObj[key].employeeFirstname+' '+data.collegeMasterDataObj[key].employeeMiddlename+' '+data.collegeMasterDataObj[key].employeeLastname+' (User Id:- '+data.collegeMasterDataObj[key].eUserId+') <hr> Date & Time :- '+data.collegeMasterDataObj[key].updated_at +"</a>";
                                }

                                $("tbody").append("<tr><td><a href='{!! URL::to('administrator/collegemaster/"+ data.collegeMasterDataObj[key].collegemasterId +"/') !!}' >"+ data.collegeMasterDataObj[key].collegemasterId +"</a></td><td><a href='{!! URL::to('administrator/collegemaster/"+ data.collegeMasterDataObj[key].collegemasterId +"/') !!}' >"+ twelveMarksDataText +"</a></td><td>"+ otherDataText +"</td><td>"+ totalFeeText +"</td><td>"+ totalSeatText +"</td><td>"+ seatsallocatedtobyaDataText +"</td><td><a href='{!! URL::to('administrator/collegeprofile/"+ data.collegeMasterDataObj[key].collegeprofileID +"/') !!}' >"+ data.collegeMasterDataObj[key].firstname + "</a></td> <td>"+ functionalAreaText +"</td> <td>"+ educationLevelDataText +"</td> <td>"+ degreeDataText +"</td> <td>"+ courseTypeDataText +"</td> <td>"+ courseDataText +"</td><td>"+ lastUpdatedBy +" </td> <td><a href='{!! URL::to('administrator/collegemaster/"+ data.collegeMasterDataObj[key].collegemasterId +"/edit/') !!}' class='btn btn-primary btn-xs'>Update</a>/<a href='{!! URL::to('administrator/collegemaster/delete/"+ data.collegeMasterDataObj[key].collegemasterId +"') !!}' class='btn btn-danger btn-xs'>Delete</a></td></tr>");
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
                                    if( data.collegeMasterDataObj1 > adds ){
                                        HTML +='<li><span class="currentCounter">'+ adds +'</span></li>';       
                                    }                                    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.collegeMasterDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.collegeMasterDataObj1-1;
                                    for(var i=lessTwo; i <= data.collegeMasterDataObj1; i++){
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
                                if( data.collegeMasterDataObj1 < 8 ){
                                    for(var i=2; i <= data.collegeMasterDataObj1; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }

                                }else{
                                    for(var i=2; i <= 8; i++){
                                        HTML +='<li><span class="currentCounter">'+ i +'</span></li>';
                                    }    
                                }

                                //IF RETURN COUNT IS LESS THAN 8
                                if( data.collegeMasterDataObj1 < 8 ){
                                         
                                }else{
                                    HTML +='<li class="disabled"><span class="currentCounter">...</span></li>';
                                    var lessTwo = data.collegeMasterDataObj1-1;
                                    for(var i=lessTwo; i <= data.collegeMasterDataObj1; i++){
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
    <script type="text/javascript">
       /* $(document).ready(function(){   
            
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

    @endsection




