@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>College Profile Details <!-- <a href="{{ url('administrator/collegeprofile/create') }}" class="btn btn-primary pull-right btn-sm">Add New College Profile</a> --></h2>    </div>
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h2>Search College Profile Details</h2>        
                    </div>    
                </div>

                <form action="{{ URL::to('/administrator/collegeprofile') }}" method="GET">
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
                            <div class="row">
                                <div class="col-md-3">                                    
                                    <h4 for="usr">Is Show On Home<span class="pull-right"><a href="javascript:void(0);" id="isShowOnHomeStatus" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                   <select name="isShowOnHome" class="form-control isShowOnHome chosen-select" data-placeholder="Choose isShowOnHome ..."  data-parsley-error-message=" Please select isShowOnHome " data-parsley-trigger="change" >
                                        <option value="" selected disabled >Select status</option>
                                        <option value="1">Enable</option>
                                        <option value="0">Disabled</option>
                                    </select>                              
                                </div>  
                                <div class="col-md-3">                                    
                                    <h4 for="usr">Is Show On Top<span class="pull-right"><a href="javascript:void(0);" id="isShowOnTopStatus" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                   <select name="isShowOnTop" class="form-control isShowOnTop chosen-select" data-placeholder="Choose isShowOnTop ..."  data-parsley-error-message=" Please select isShowOnTop " data-parsley-trigger="change" >
                                        <option value="" selected disabled >Select status</option>
                                        <option value="1">Enable</option>
                                        <option value="0">Disabled</option>
                                    </select> 
                                </div>
                                @include('common-partials.common-search-employee-fileds-index-partial')
                                <div class="col-md-6 text-right">      
                                    <a href="{{ URL::to('/administrator/collegeprofile') }}" class="btn btn-md btn-primary">Clear</a>
                                    <button class="btn btn-danger btn-md">Submit</button>                                            
                                </div>  
                            </div>
                        </div>  
                    </div>                       
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        @if( sizeof($collegeprofile) > 0 )
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                          
            </div>
            <div class="ibox-content table-responsive">
                <label class="pull-right">Total Result :- {{ $collegeprofile->total() }}</label>
                <table class="table table-hover">
                    <thead>
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
                            <th>Last Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($collegeprofile as $item)
                        <tr class="gradeX">
                            <td>
                                <a href="{{ url('administrator/users', $item->userID) }}">{{ $item->id }}</a>
                            </td>
                            <td>
                                @if( $item->created_at)
                                    {{  $item->created_at->format('F d,Y') }} at {{  $item->created_at->format('h:i A') }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            
                            <td>
                                @if( $item->userID)
                                    <a href="{{ url('administrator/collegeprofile', $item->id) }}">{{ $item->firstname }} {{ $item->lastname }}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                                <br>
                                @if($item->userstatus_id == '1' )
                                <a href="{{ url('/college/' . strtolower($item->slug)) }}" target="_blank" title="Go to Product View"><button class="btn btn-success btn-xs"><i class="fa fa-external-link" aria-hidden="true"></i> Profile Page</button></a>
                                @endif
                                @if($item->verified == '1' && $item->review == '1' && $item->agreement == '1')
                                <div class="checkbox checkbox-primary">
                                    <input class="isShowOnHome" type="checkbox" id="{{ $item->id }}" name="isShowOnHome" @if( $item->isShowOnHome == 1) checked="" @endif>
                                    <label>
                                        @if($item->isShowOnHome == 1)
                                            <span class="label label-info isShowOnHomeEnabled{{ $item->id }}">Is Show On Home Enable</span>
                                        @else
                                            <span class="label label-danger isShowOnHomeDisabled{{ $item->id }}">Is Show On Home Disabled</span>
                                        @endif
                                        <span class="label label-info hide isShowOnHomeEnabled1{{ $item->id }}">Is Show On Home Enable</span>
                                        <span class="label label-danger hide isShowOnHomeDisabled1{{ $item->id }}">Is Show On Home Disabled</span>
                                    </label>
                                </div>


                                <div class="checkbox checkbox-primary">
                                    <input class="isShowOnTop" type="checkbox" id="{{ $item->id }}" name="isShowOnTop" @if( $item->isShowOnTop == 1) checked="" @endif>
                                    <label>
                                        @if($item->isShowOnTop == 1)
                                            <span class="label label-info isShowOnTopEnabled{{ $item->id }}">Is Show On Top College Enable</span>
                                        @else
                                            <span class="label label-danger isShowOnTopDisabled{{ $item->id }}">Is Show On Top College Disabled</span>
                                        @endif
                                        <span class="label label-info hide isShowOnTopEnabled1{{ $item->id }}">Is Show On Top College Enable</span>
                                        <span class="label label-danger hide isShowOnTopDisabled1{{ $item->id }}">Is Show On Top College Disabled</span>
                                    </label>
                                </div>
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
                                <a href="{{ url('/administrator/sendWelcomeEmail/' . $item->id) }}">
                                    <button type="submit" class="btn btn-outline btn-sm btn-primary">Send welcome email</button>
                                </a>
                            </td>
                            <td>
                                @if($item->eUserId)
                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) <hr> Date & Time:- {{ $item->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('administrator/collegeprofile/' . $item->id . '/edit') }}">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </a> <!-- /
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['administrator/collegeprofile', $item->id],
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
                        <div class="pull-right custom-pagination">{!! $collegeprofile->render() !!}</div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="headline text-center"><h3>Examination records not found</h3></div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('.addresstype_id').on('change', function(){
        var addressTypeId = $(this).val();
        $('.countryHide').css('visibility', 'visible');
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

    $('.isShowOnHome').on('change',function(){
        $('#isShowOnHomeStatus').removeClass('hide');
    });
    $('#isShowOnHomeStatus').on('click',function(e){
        $('.isShowOnHome').val('').trigger('chosen:updated');
        $('#isShowOnHomeStatus').addClass('hide');
    });

    $('.isShowOnTop').on('change',function(){
        $('#isShowOnTopStatus').removeClass('hide');
    });
    $('#isShowOnTopStatus').on('click',function(e){
        $('.isShowOnTop').val('').trigger('chosen:updated');
        $('#isShowOnTopStatus').addClass('hide');
    });
</script>
<script type="text/javascript">
    $('.exportToExcel').on('click',function(){
        var searchCollegeName = $('.collegeName').val();
        var collegeTypeId = $('.collegetype_id').val();
        if( collegeTypeId == 'null' ){
            collegeTypeId = '';
        }
        var searchEmailAddress = $('.userEmailAddress').val();
        var searchReview = $('.review').val();
        var searchVerified = $('.verified').val();
        var searchAgreement = $('.agreement').val();
        var universityId = $('.university_id').val();
        if( universityId == 'null' ){
            universityId = '';
        }

        var addressTypeID = $('.addresstype_id').val();
        if( addressTypeID == 'null' ){
            addressTypeID = '';
        }

        var cityName = $('.city_id').val();
        if( cityName == 'null' ){
            cityName = '';
        }

        var stateName = $('.stateName').val();
        if( stateName == 'null' ){
            stateName = '';
        }

        window.location = "{{ URL::to('export/search-result') }}?searchCollegeName="+ searchCollegeName +"&collegeTypeId="+ collegeTypeId +"&searchEmailAddress="+ searchEmailAddress +"&searchReview="+ searchReview +"&searchVerified="+ searchVerified +"&searchAgreement="+ searchAgreement +"&universityId="+ universityId +"&addressTypeID="+ addressTypeID +"&cityName="+ cityName +"&stateName="+ stateName+"";
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

<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowOnHome').on('click', function(){
        var id              = $(this).attr('id');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }

        if (currentStatus == 1) {
            $('.isShowOnHomeEnabled'+id).addClass('hide');
            $('.isShowOnHomeDisabled'+id).addClass('hide');
            $('.isShowOnHomeEnabled1'+id).removeClass('hide');
            $('.isShowOnHomeDisabled1'+id).addClass('hide');
        }else if(currentStatus == 0){
            $('.isShowOnHomeEnabled'+id).addClass('hide');
            $('.isShowOnHomeDisabled'+id).addClass('hide');
            $('.isShowOnHomeDisabled1'+id).removeClass('hide');
            $('.isShowOnHomeEnabled1'+id).addClass('hide');
        }

        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/collegeprofile/isShowOnHome') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("College profile is show on home status updated successfully.");
                }
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowOnTop').on('click', function(){
        var id              = $(this).attr('id');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }

        if (currentStatus == 1) {
            $('.isShowOnTopEnabled'+id).addClass('hide');
            $('.isShowOnTopDisabled'+id).addClass('hide');
            $('.isShowOnTopEnabled1'+id).removeClass('hide');
            $('.isShowOnTopDisabled1'+id).addClass('hide');
        }else if(currentStatus == 0){
            $('.isShowOnTopEnabled'+id).addClass('hide');
            $('.isShowOnTopDisabled'+id).addClass('hide');
            $('.isShowOnTopDisabled1'+id).removeClass('hide');
            $('.isShowOnTopEnabled1'+id).addClass('hide');
        }

        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/collegeprofile/isShowOnTop') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("College profile is show on top status updated successfully.");
                }
            }
        });
    });
});
</script>
@include('common-partials.common-search-employee-index-script-partial')

@endsection


