@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Address <!-- <a href="{{ URL::to('employee/address') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update address details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($address, ['method' => 'PATCH','url' => ['employee/address', $address->id],'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter address name here', 'data-parsley-error-message' => 'Please enter valid address name here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Address 1 : </label>
                <div class="col-sm-10">
                    {!! Form::text('address1', null, ['class' => 'form-control', 'placeholder' => 'Enter address 1 here', 'data-parsley-error-message' => 'Please enter valid address 1 here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Address 2 : </label>
                <div class="col-sm-10">
                    {!! Form::text('address2', null, ['class' => 'form-control', 'placeholder' => 'Enter address 2 here', 'data-parsley-error-message' => 'Please enter valid address 2 here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Landmark : </label>
                <div class="col-sm-10">
                    {!! Form::text('landmark', null, ['class' => 'form-control', 'placeholder' => 'Enter landmark here', 'data-parsley-error-message' => 'Please enter valid landmark here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Postal Code : </label>
                <div class="col-sm-10">
                    {!! Form::text('postalcode', null, ['class' => 'form-control', 'placeholder' => 'Enter postal code here', 'data-parsley-error-message' => 'Please enter valid postal code here', 'data-parsley-type'=>'digits', 'data-parsley-trigger' => 'change', 'data-parsley-length' => '[4, 8]', 'data-parsley-error-message'=>'Please enter valid postal code of 4 to 8 digits']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >College Profile : </label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="collegeprofile_id" class="form-control collegeprofile_id chosen-select " data-parsley-error-message=" Please select college profile" data-parsley-trigger="change">
                        <option value="" selected disabled>Select college profile</option>  
                        @foreach ($collegeProfileObj as $college)
                            @if( $address->collegeprofile_id == $college->collegeprofileID )
                                <option value="{{ $college->collegeprofileID }}" selected="">{{ $college->firstname }} </option>
                            @else
                                <option value="{{ $college->collegeprofileID }}">{{ $college->firstname }} </option>
                            @endif
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Student Profile : </label>
                <div class="col-sm-10">
                     <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
                    <select name="studentprofile_id" class="form-control studentprofile_id chosen-select " data-parsley-error-message=" Please select student profile" data-parsley-trigger="change">
                        <option value="" selected disabled>Select student profile</option>  
                        @foreach ($studentProfile as $studentProfile)
                            @if( $address->studentprofile_id == $studentProfile->studentprofileID )
                                <option value="{{ $studentProfile->studentprofileID }}" selected="">{{ $studentProfile->firstname }} {{ $studentProfile->middlename }} {{ $studentProfile->lastname }}</option>
                            @else
                                <option value="{{ $studentProfile->studentprofileID }}">{{ $studentProfile->firstname }} {{ $studentProfile->middlename }} {{ $studentProfile->lastname }}</option>
                            @endif
                        @endforeach    
                    </select>          
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Address Type : </label>
                <div class="col-sm-10">
                    <select name="addresstype_id" class="form-control chosen-select " data-parsley-error-message=" Please select address type" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select address type</option>  
                        @foreach ($addressTypeObj as $address1)
                            @if( $address->addresstype_id == $address1->id )
                                <option value="{{ $address1->id }}" selected="">{{ $address1->name }}</option>
                            @else
                                <option value="{{ $address1->id }}"> {{ $address1->name }}</option>
                            @endif
                        @endforeach    
                    </select>      
                </div>
            </div>
            <div class="row padding-top5 padding-bottom5">
                <label class="col-md-2 control-label">Select Country :</label>
                
                <div class="col-md-10">
                    @foreach(  $addressDataObj as  $countryData )
                        @if( $countryData->countryId )
                          <label> {{ $countryData->countryName }}</label>
                        @endif 
                    @endforeach
                    <select name="countryName" class="form-control chosen-select countryName" id="countryId" data-parsley-trigger="change" data-parsley-error-message="Please select your country" >
                        <option value="" selected disabled>Select country</option> 
                        @foreach(  $addressDataObj as  $countryData )
                           <!--  @if( $countryData->countryId )
                                <option value="{{ $countryData->countryId }}" selected="">{{ $countryData->countryName }}</option>
                            @endif  -->
                          
                            @foreach ($countryObj as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach 
                        @endforeach          
                    </select>

                </div>
            </div>

            <div class="row padding-top5 padding-bottom5">
                <label class="col-md-2 control-label">Select State</label>
                <div class="col-md-10">
                    @foreach(  $addressDataObj as  $cityData )
                        @if( $cityData->stateId )
                        <label>{{ $cityData->stateName }}</label>
                        @endif 
                    @endforeach 
                    <select name="stateName" class="form-control chosen-select stateName" id="stateId" data-parsley-trigger="change" data-parsley-error-message="Please select your state" >
                        <option value="" selected disabled>Select state</option> 
                        @foreach(  $addressDataObj as  $cityData )
                           <!--  @if( $cityData->stateId )
                                <option value="{{ $cityData->stateId }}" selected="">{{ $cityData->stateName }}</option>
                            @endif  -->
                          
                            @foreach ($stateNameObj as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach 
                        @endforeach          
                    </select>

                </div>
            </div>

            <div class="row padding-top5 padding-bottom5">
                <label class="col-md-2 control-label">Select City</label>
                <div class="col-md-10">
                    <select name="city_id" class="form-control chosen-select cityName" data-parsley-trigger="change" data-parsley-error-message="Please select your city" required="">
                        <option value="" selected disabled>Select city</option>  
                        @foreach ($cityNameObj as $city)
                            @if( $address->city_id == $city->id )
                                <option value="{{ $city->id }}" selected=""> {{ $city->name }}</option>
                            @else
                                <option value="{{ $city->id }}"> {{ $city->name }}</option>
                            @endif
                        @endforeach            
                    </select>
                </div>
            </div>
           <!--  <div class="form-group">
                <label class="col-sm-2 control-label" >City : </label>
                <div class="col-sm-10">
                    <select name="city_id" class="form-control chosen-select " data-parsley-error-message=" Please select city" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select city</option>  
                        @foreach ($cityNameObj as $city)
                            @if( $address->city_id == $city->id )
                                <option value="{{ $city->id }}" selected=""> {{ $city->name }}</option>
                            @else
                                <option value="{{ $city->id }}"> {{ $city->name }}</option>
                            @endif
                        @endforeach    
                    </select>   
                </div>
            </div> -->

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){   

        $('.collegeprofile_id').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.collegeprofile_id').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('.studentprofile_id').on('change',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.studentprofile_id').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });

        var countryId = $('.countryId').val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { countryId: countryId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllStateNameData') }}",
                success: function(data) {
                    $.each(data.stateData, function(key, value) {
                        HTML += '<option value='+data.stateData[key].id+'>'+data.stateData[key].name+'</option>';
                    });
                    $('.stateName').html(HTML);
                    $('.stateName').trigger("chosen:updated");
                }
            });   

        $('.countryName').on('change', function(){
            var countryId = $(this).val();
            var HTML = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { countryId: countryId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllStateNameData') }}",
                success: function(data) {
                    $.each(data.stateData, function(key, value) {
                        HTML += '<option value='+data.stateData[key].id+'>'+data.stateData[key].name+'</option>';
                    });
                    $('.stateName').html(HTML);
                    $('.stateName').trigger("chosen:updated");
                }
            });
        });

        var stateId = $('.stateId').val();
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
                    $.each(data.cityData, function(key, value) {
                        HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
                    });
                    $('.cityName').html(HTML);
                    $('.cityName').trigger("chosen:updated");
                }
            });   

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